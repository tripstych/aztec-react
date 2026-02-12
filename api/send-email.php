<?php
header('Content-Type: application/json');

// Only allow POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

// --- Mailgun credentials (edit these on the server) ---
$MAILGUN_API_KEY  = 'YOUR_MAILGUN_API_KEY';
$MAILGUN_DOMAIN   = 'YOUR_MAILGUN_DOMAIN';
$MAILGUN_RECIPIENT = ''; // leave blank to send to the customer email
// ------------------------------------------------------

// Read JSON body
$raw  = file_get_contents('php://input');
$data = json_decode($raw, true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON']);
    exit;
}

$customer_first    = $data['customer_first']    ?? '';
$customer_last     = $data['customer_last']     ?? '';
$customer_email    = $data['customer_email']    ?? '';
$customer_phone    = $data['customer_phone']    ?? '';
$sensors           = $data['sensors']           ?? '';
$vin_number        = $data['vin_number']        ?? '';
$additionalInfo    = $data['customer_additionalInfo'] ?? '';
$car_type          = $data['car_type']          ?? '';
$year              = $data['year']              ?? '';
$make              = $data['make']              ?? '';
$model             = $data['model']             ?? '';
$selected_date     = $data['selected_date']     ?? '';
$selected_time     = $data['selected_time']     ?? '';
$estimated_duration = $data['estimated_duration'] ?? '';

// Build service list
$serviceList = '';
if (!empty($data['service']) && is_array($data['service'])) {
    $names = array_map(function($s) { return $s['name'] ?? ''; }, $data['service']);
    $serviceList = implode(', ', array_filter($names));
}

// Build HTML email
$html = "
<h2>New Quote Request</h2>
<p><strong>Name:</strong> {$customer_first} {$customer_last}</p>
<p><strong>Email:</strong> {$customer_email}</p>
<p><strong>Phone:</strong> {$customer_phone}</p>
<hr/>
<p><strong>Car Type:</strong> {$car_type}</p>
<p><strong>Vehicle:</strong> {$year} {$make} {$model}</p>
<p><strong>Service:</strong> {$serviceList}</p>
<p><strong>Sensors:</strong> {$sensors}</p>
<p><strong>Date:</strong> {$selected_date}</p>
<p><strong>Time:</strong> {$selected_time}</p>
<p><strong>Est. Duration:</strong> {$estimated_duration}</p>";

if ($vin_number) {
    $html .= "<p><strong>VIN:</strong> {$vin_number}</p>";
}
if ($additionalInfo) {
    $html .= "<p><strong>Additional Info:</strong> {$additionalInfo}</p>";
}

$recipient = $MAILGUN_RECIPIENT ?: $customer_email;
$subject   = "New Quote - {$customer_first} {$customer_last} - {$year} {$make} {$model}";

// Send via Mailgun REST API using curl
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.mailgun.net/v3/{$MAILGUN_DOMAIN}/messages");
curl_setopt($ch, CURLOPT_USERPWD, "api:{$MAILGUN_API_KEY}");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, [
    'from'    => "Aztec Quote <postmaster@{$MAILGUN_DOMAIN}>",
    'to'      => $recipient,
    'subject' => $subject,
    'html'    => $html,
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result   = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error    = curl_error($ch);
curl_close($ch);

if ($error) {
    http_response_code(500);
    echo json_encode(['error' => "Curl error: {$error}"]);
    exit;
}

if ($httpCode >= 400) {
    http_response_code($httpCode);
    echo json_encode(['error' => "Mailgun error: {$result}"]);
    exit;
}

echo json_encode(['message' => 'Email sent successfully']);
