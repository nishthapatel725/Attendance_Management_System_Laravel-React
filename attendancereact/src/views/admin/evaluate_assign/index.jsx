import { Box, SimpleGrid } from "@chakra-ui/react";
import DevelopmentTable from "views/admin/lecture_info/components/DevelopmentTable";
import CheckTable from "views/admin/lecture_info/components/CheckTable";
import ColumnsTable from "views/admin/lecture_info/components/ColumnsTable";
import ComplexTable from "views/admin/lecture_info/components/ComplexTable";
import {
  columnsDataDevelopment,
  columnsDataCheck,
  columnsDataColumns,
  columnsDataComplex,
} from "views/admin/lecture_info/";
import tableDataDevelopment from "views/admin/lecture_info/variables/tableDataDevelopment.json";
import tableDataCheck from "views/admin/lecture_info/variables/tableDataCheck.json";
import tableDataColumns from "views/admin/lecture_info/variables/tableDataColumns.json";
import tableDataComplex from "views/admin/lecture_info/variables/tableDataComplex.json";
import React from "react";
import ManageAssign from './components/EvaluateAssign';

export default function Settings() {
  // Chakra Color Mode
  return (
    <Box pt={{ base: "130px", md: "80px", xl: "80px" }}>
      <ManageAssign />
    </Box>
  );
}
