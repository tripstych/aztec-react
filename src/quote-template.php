<?php
 /*
        Template Name: Quote Template
*/



$domain = "wordpress-1526935-5904998.cloudwaysapps.com";

$nc = rand();

try {
	$c = file_get_contents( "https://{$domain}/quote-header?nc={$nc}");
	$domHead = new DOMDocument();
	@$domHead->loadHTML($c);

	

	$c = file_get_contents( "http://localhost:3000?uncache={$nc}");
	$domBody = new DOMDocument();
	$domBody->loadHTML($c);

	$c = file_get_contents( "https://{$domain}/footer?nc={$nc}");
	$domFoot = new DOMDocument();
	@$domFoot->loadHTML($c);
} catch(Exception $e) {
	include "index.php";
	exit();
}

/* Clone the <head> from domBody and *prepend* it into domHead */
/*
$headB = $domBody->getElementsByTagName('head')->item(0);
if ($headB) {
    $clonedHead = $headB->cloneNode(true);
    $importedHead = $domHead->importNode($clonedHead, true);
    $domHead->documentElement->insertBefore($importedHead, $domHead->documentElement->firstChild);
}
*/
/* Clone the script tags from domBody into the head of domHead */ 
$scriptTags = $domBody->getElementsByTagName('script');
foreach ($scriptTags as $script) {
    $clonedScript = $script->cloneNode(true);
    $importedScript = $domHead->importNode($clonedScript, true);
    $domHead->getElementsByTagName('head')->item(0)->appendChild($importedScript);
}
/* Clone the link tags from domBody into the head of domHead */
$linkTags = $domBody->getElementsByTagName('link');
foreach ($linkTags as $link) {
    $clonedLink = $link->cloneNode(true);
    $importedLink = $domHead->importNode($clonedLink, true);
    $domHead->getElementsByTagName('head')->item(0)->appendChild($importedLink);
}
/* Clone the style tags from domBody into the head of domHead */
$styleTags = $domBody->getElementsByTagName('style');
foreach ($styleTags as $style) {
    $clonedStyle = $style->cloneNode(true);
    $importedStyle = $domHead->importNode($clonedStyle, true);
    $domHead->getElementsByTagName('head')->item(0)->appendChild($importedStyle);
}

/* clone the <body> from domBody and *prepend* it into the <body> of domHead */
$bodyB = $domBody->getElementsByTagName('body')->item(0);
if ($bodyB) {
    $clonedBody = $bodyB->cloneNode(true);
    $importedBody = $domHead->importNode($clonedBody, true);
    $bodyA = $domHead->getElementsByTagName('body')->item(0);
    //$bodyA->insertBefore($importedBody, $bodyA->firstChild);

}

/* clone the <body> of domFoot and prepend it into the <body> of domHead */
$bodyC = $domFoot->getElementsByTagName('body')->item(0);
if ($bodyC) {
    $clonedBody = $bodyC->cloneNode(true);
    $importedBody = $domHead->importNode($clonedBody, true);
    $bodyA = $domHead->getElementsByTagName('body')->item(0);
    //$bodyA->appendChild($importedBody);
}

$styleElement = $domHead->createElement('style');
$styleElement->nodeValue = "html { background-color: black !important; } #root { height: 2299px !important; }";
$domHead->getElementsByTagName('head')->item(0)->appendChild($styleElement);

//creaet a script element
$scriptElement = $domHead->createElement('script');
//set the innerText of the text node with
//window.onscroll=function() { if (window.scrollY<300) { window.scrollTo(0,300)} ; }
$scriptElement->nodeValue = "
function calculateOffset(width) {
  const width1 = 420;
  const offset1 = 4200;
  const width2 = 1600;
  const offset2 = 3000;

  // The slope of the line
  const slope = (offset2 - offset1) / (width2 - width1);

  // The y-intercept of the line
  const intercept = offset1 - slope * width1;

  // The linear equation: y = mx + b
  const offset = slope * width + intercept;

  return offset;
}
//ehlo
$.get('/footer',function(data) { const dat=$(data); $('body').append($(dat).find('footer')); });


setInterval(function() {
if ($('body').width()<640) {
	return;
	$('#root h2:first').css({'font-size':'3rem'})
	$('#root h3:first').css({'font-size':'2rem'})
	$('#root div:first > div:first > div:eq(1)').css('padding-top','2.6em !important');
} else {
	$('#root h2:first').css({'font-size':'4rem'})
	$('#root h3:first').css({'font-size':'3rem'})
	$('#root div:first > div:first > div:eq(1)').css('padding-top','5.6em !important');
}
	document.getElementsByTagName('body').className='wp-singular page-template-default page page-id-379 wp-theme-jupiterx js elementor-default elementor-kit-4 jupiterx-header-sticky e--ua-blink e--ua-chrome e--ua-webkit jupiterx-header-stick jupiterx-header-sticked';
    const width = window.innerWidth;
    const offset = calculateOffset(width);
    $('footer').css('top', offset + 'px');
}, 100);


";

// append at the end of the dom
$domHead->getElementsByTagName('body')->item(0)->appendChild($scriptElement);


$divElement = $domHead->createElement('div');
$divElement->setAttribute('id','root');

$domHead->getElementsByTagName('body')->item(0)->appendChild($divElement);



the_content();

echo $domHead->saveHTML();