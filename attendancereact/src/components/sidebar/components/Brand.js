import React from "react";

// Chakra imports
import { Flex, useColorModeValue, Text } from "@chakra-ui/react";

// Custom components
import { HorizonLogo } from "components/icons/Icons";
import { HSeparator } from "components/separator/Separator";

export function SidebarBrand() {
  //   Chakra color mode
  let logoColor = useColorModeValue("navy.700", "white");

  return (
    <Flex align='center' direction='column'>
      <Text 
    fontSize={40} 
    fontWeight="bold" 
    bgGradient="linear(to-r, #422AFB, #422AFB)" 
    bgClip="text" 
    textShadow="2px 2px 10px rgba(0, 112, 243, 0.5)">
    AMS
  </Text>
      {/* <Text fontSize={40} fontWeight={"bold"} >AMS</Text> */}
      {/* <HorizonLogo h='26px' w='175px' my='32px' color={logoColor} /> */}
      <HSeparator mb='20px' />
    </Flex>
  );
}

export default SidebarBrand;
