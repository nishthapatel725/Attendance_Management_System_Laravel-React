import {
    Avatar,
    Box,
    Flex,
    FormLabel,
    Icon,
    Select,
    SimpleGrid,
    useColorModeValue,
  } from "@chakra-ui/react";
  // Assets
  import React from "react";
  import Home from './components/Home';
  import tableDataDevelopment from 'views/admin/lecture_info/variables/tableDataDevelopment.json';
  import {
    columnsDataDevelopment,
    columnsDataCheck,
    columnsDataColumns,
    columnsDataComplex,
  } from "views/admin/lecture_info/variables/columnsData";
  
  export default function UserReports() {
    // Chakra Color Mode
    const brandColor = useColorModeValue("brand.500", "white");
    const boxBg = useColorModeValue("secondaryGray.300", "whiteAlpha.100");
    return (
      <Box pt={{ base: "130px", md: "80px", xl: "80px" }}>
        <Home
            columnsData={columnsDataDevelopment}
            tableData={tableDataDevelopment}
          />
      </Box>
    );
  }
  