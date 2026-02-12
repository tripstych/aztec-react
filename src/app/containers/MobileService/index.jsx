import React from "react";
import styled from "styled-components";
import tw from "twin.macro";
import { Footer } from "../../components/footer";
import { Marginer } from "../../components/marginer";
import TopSection from "./topSection";
import AboutSection from "./aboutSection";

const PageContainer = styled.div`
  ${tw`
  flex
  flex-col
  w-full
  h-full
  items-center
  `}
`;

const MobileService = () => {
  return (
    <PageContainer>
      <TopSection />
      <Marginer direction="vertical" margin="2em" />
      <AboutSection />
      <Footer />
    </PageContainer>
  );
};

export default MobileService;
