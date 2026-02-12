import { faEnvelope, faPhoneAlt } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import React from "react";
import * as styles from "./footer.styles";
import { faFacebook, faInstagram } from "@fortawesome/free-brands-svg-icons";
import { Link } from "react-router-dom";

export function Footer() {
  return (
    <styles.FooterContainer>
      <styles.InnerContainer>
        <styles.SectionContainer>
          <styles.HeaderTitle>Hours & Location</styles.HeaderTitle>
          <styles.HoursGrid>
            <styles.DayColumn>Mon-Fri</styles.DayColumn>
            <styles.TimeColumn>08:30 a.m. – 05:00 p.m.</styles.TimeColumn>
            <styles.DayColumn>Sat</styles.DayColumn>
            <styles.TimeColumn>09:00 a.m. – 04:00 p.m.</styles.TimeColumn>
            <styles.DayColumn>Sun</styles.DayColumn>
            <styles.TimeColumn className="closed">Closed</styles.TimeColumn>
          </styles.HoursGrid>
          <styles.LocationContainer>
            <styles.AddressLine>
              203 - 2914 Kingsview Boulevard SE
            </styles.AddressLine>
            <styles.AddressLine>
              Airdrie, Alberta T4A 0E1, Canada
            </styles.AddressLine>
          </styles.LocationContainer>
        </styles.SectionContainer>
        <styles.SectionContainer>
          <styles.HeaderTitle>Our Links</styles.HeaderTitle>
          <styles.LinksList>
            <styles.ListItem>
              <Link to="/">Home</Link>
            </styles.ListItem>
            <styles.ListItem>
              <Link to="/">About Us</Link>
            </styles.ListItem>
            {/* <styles.ListItem>
              <Link to="/services">Services</Link>
            </styles.ListItem> */}
            <styles.ListItem>
              <Link to="/quote">Get Quote</Link>
            </styles.ListItem>
            <styles.ListItem>
              <Link to="/">Blog</Link>
            </styles.ListItem>
          </styles.LinksList>
        </styles.SectionContainer>
        <styles.SectionContainer>
          <styles.HeaderTitle>Other Links</styles.HeaderTitle>
          <styles.LinksList>
            <styles.ListItem>
              <Link to="/">FAQ</Link>
            </styles.ListItem>
            <styles.ListItem>
              <Link to="/contact">Contact Us</Link>
            </styles.ListItem>
            <styles.ListItem>
              <Link to="/">Support</Link>
            </styles.ListItem>
            <styles.ListItem>
              <Link to="/privacy-policy">Privacy Policy</Link>
            </styles.ListItem>
          </styles.LinksList>
        </styles.SectionContainer>
        <styles.SectionContainer>
          <styles.HeaderTitle>Socials</styles.HeaderTitle>
          <styles.HorizontalContainer>
            <styles.BlueIcon>
              <FontAwesomeIcon icon={faPhoneAlt} />
            </styles.BlueIcon>
            <styles.SmallText>
              <a href="tel:587-966-7636">+1 587-966-7636</a>
            </styles.SmallText>
          </styles.HorizontalContainer>
          <styles.HorizontalContainer>
            <styles.BlueIcon>
              <FontAwesomeIcon icon={faEnvelope} />
            </styles.BlueIcon>
            <styles.SmallText>
              <a href="mailto:quotes@aztecautoglass.ca">
                quotes@aztecautoglass.ca
              </a>
            </styles.SmallText>
          </styles.HorizontalContainer>
          <styles.HorizontalContainer>
            <styles.BlueIcon>
              <FontAwesomeIcon icon={faInstagram} />
            </styles.BlueIcon>
            <styles.SmallText>
              <a href="https://www.instagram.com/aztecautoglass_yyc">
                @aztecautoglass_yyc
              </a>
            </styles.SmallText>
          </styles.HorizontalContainer>
          <styles.HorizontalContainer>
            <styles.BlueIcon>
              <FontAwesomeIcon icon={faFacebook} />
            </styles.BlueIcon>
            <styles.SmallText>
              <a href="https://www.facebook.com/people/Aztec-Autoglass/61550110215034/">
                Aztec Auto Glass
              </a>
            </styles.SmallText>
          </styles.HorizontalContainer>
        </styles.SectionContainer>
      </styles.InnerContainer>
      <styles.BottomContainer>
        <styles.CopyrightText>
          Copyright &copy; {new Date().getFullYear()} Aztec Auto Glass - All
          Rights Reserved.
        </styles.CopyrightText>
      </styles.BottomContainer>
    </styles.FooterContainer>
  );
}
