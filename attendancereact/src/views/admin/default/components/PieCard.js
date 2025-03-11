// // Chakra imports
// import { Box, Flex, Text, Select, useColorModeValue } from "@chakra-ui/react";
// // Custom components
// import Card from "components/card/Card.js";
// import PieChart from "components/charts/PieChart";
// import { pieChartData, pieChartOptions } from "variables/charts";
// import { VSeparator } from "components/separator/Separator";
// import React from "react";

// export default function Conversion(props) {
//   const { ...rest } = props;

//   // Chakra Color Mode
//   const textColor = useColorModeValue("secondaryGray.900", "white");
//   const cardColor = useColorModeValue("white", "navy.700");
//   const cardShadow = useColorModeValue(
//     "0px 18px 40px rgba(112, 144, 176, 0.12)",
//     "unset"
//   );
//   return (
//     <Card p='20px' align='center' direction='column' w='100%' {...rest}>
//       <Flex
//         px={{ base: "0px", "2xl": "10px" }}
//         justifyContent='space-between'
//         alignItems='center'
//         w='100%'
//         mb='8px'>
//         <Text color={textColor} fontSize='md' fontWeight='600' mt='4px'>
//           Attendence Anylsis
//         </Text>
//         <Select
//           fontSize='sm'
//           variant='subtle'
//           defaultValue='monthly'
//           width='unset'
//           fontWeight='700'>
//           <option value='daily'>Daily</option>
//           <option value='monthly'>Monthly</option>
//           <option value='yearly'>Yearly</option>
//         </Select>
//       </Flex>

//       <PieChart
//         h='100%'
//         w='100%'
//         chartData={pieChartData}
//         chartOptions={pieChartOptions}
//       />
//       <Card
//         bg={cardColor}
//         flexDirection='row'
//         boxShadow={cardShadow}
//         w='100%'
//         p='15px'
//         px='20px'
//         mt='15px'
//         mx='auto'>
//         <Flex direction='column' py='5px'>
//           <Flex align='center'>
//             <Box h='8px' w='8px' bg='brand.500' borderRadius='50%' me='4px' />
//             <Text
//               fontSize='xs'
//               color='secondaryGray.600'
//               fontWeight='700'
//               mb='5px'>
//               Your files
//             </Text>
//           </Flex>
//           <Text fontSize='lg' color={textColor} fontWeight='700'>
//             63%
//           </Text>
//         </Flex>
//         <VSeparator mx={{ base: "60px", xl: "60px", "2xl": "60px" }} />
//         <Flex direction='column' py='5px' me='10px'>
//           <Flex align='center'>
//             <Box h='8px' w='8px' bg='#6AD2FF' borderRadius='50%' me='4px' />
//             <Text
//               fontSize='xs'
//               color='secondaryGray.600'
//               fontWeight='700'
//               mb='5px'>
//               System
//             </Text>
//           </Flex>
//           <Text fontSize='lg' color={textColor} fontWeight='700'>
//             25%
//           </Text>
//         </Flex>
//       </Card>
//     </Card>
//   );
// }
import React, { useEffect, useState } from "react";
import axios from "axios";
import { Box, Flex, Text, Select, useColorModeValue } from "@chakra-ui/react";
import Card from "components/card/Card.js";
import PieChart from "components/charts/PieChart";
import { VSeparator } from "components/separator/Separator";

export default function Conversion(props) {
  const { ...rest } = props;

  // State for dropdown options
  const [semesters, setSemesters] = useState([]);
  const [courses, setCourses] = useState([]);
  const [dates, setDates] = useState([]);
  const [attendanceData, setAttendanceData] = useState({
    present_count: 0,
    absent_count: 0,
  });

  // State for selected values
  const [selectedSemester, setSelectedSemester] = useState("");
  const [selectedCourse, setSelectedCourse] = useState("");
  const [selectedDate, setSelectedDate] = useState("");

  // Chakra Color Mode
  const textColor = useColorModeValue("secondaryGray.900", "white");
  const cardColor = useColorModeValue("white", "navy.700");
  const cardShadow = useColorModeValue(
    "0px 18px 40px rgba(112, 144, 176, 0.12)",
    "unset"
  );

  // Fetch dropdown data
  const fetchDropdownData = async () => {
    try {
      const [semesterRes, courseRes, lectureRes] = await Promise.all([
        axios.get("http://127.0.0.1:8000/api/semester"),
        axios.get("http://127.0.0.1:8000/api/course"),
        axios.get("http://127.0.0.1:8000/api/lectures"),
      ]);

      setSemesters(semesterRes.data);
      setCourses(courseRes.data);
      setDates(
        [...new Set(lectureRes.data.map((lecture) => lecture.lec_date))].sort() // Unique, sorted dates
      );
    } catch (error) {
      console.error("Error fetching dropdown data:", error);
    }
  };

  // Fetch attendance data
  const fetchAttendanceData = async () => {
    if (selectedSemester && selectedCourse && selectedDate) {
      try {
        const response = await axios.get(
          `http://127.0.0.1:8000/api/attendance_count/${selectedSemester}/${selectedCourse}/${selectedDate}`
        );
        setAttendanceData(response.data.data || { present_count: 0, absent_count: 0 });
      } catch (error) {
        console.error("Error fetching attendance data:", error);
      }
    }
  };

  // Fetch dropdown data on mount
  useEffect(() => {
    fetchDropdownData();
  }, []);

  // Fetch attendance data when filters change
  useEffect(() => {
    fetchAttendanceData();
  }, [selectedSemester, selectedCourse, selectedDate]);

  // Calculate percentages
  const calculatePercentages = (present, absent) => {
    const total = present + absent;
    if (total === 0) {
      return [0, 0]; // Avoid division by zero
    }
    const presentPercentage = (present / total) * 100;
    const absentPercentage = (absent / total) * 100;

    // Ensure percentages sum to 100%
    const roundedPresent = Math.round(presentPercentage);
    const roundedAbsent = Math.round(absentPercentage);
    const diff = 100 - (roundedPresent + roundedAbsent);
    return [roundedPresent + diff, roundedAbsent];
  };

  // Prepare data for the pie chart
  const [presentPercentage, absentPercentage] = calculatePercentages(
    attendanceData.present_count,
    attendanceData.absent_count
  );

  const pieChartData = [
    { name: "Present", value: presentPercentage, color: "#6AD2FF" },
    { name: "Absent", value: absentPercentage, color: "#FF6A6A" },
  ];

  return (
    <Card p="20px" align="center" direction="column" w="100%" {...rest}>
      <Flex
        px={{ base: "0px", "2xl": "10px" }}
        justifyContent="space-between"
        alignItems="center"
        w="100%"
        mb="8px"
      >
        {/* Semester Dropdown */}
        <Select
          fontSize="sm"
          variant="subtle"
          placeholder="Select Semester"
          width="unset"
          fontWeight="700"
          onChange={(e) => setSelectedSemester(e.target.value)}
        >
          {semesters.map((semester) => (
            <option key={semester.sem_id} value={semester.sem_id}>
              {semester.name}
            </option>
          ))}
        </Select>

        {/* Course Dropdown */}
        <Select
          fontSize="sm"
          variant="subtle"
          placeholder="Select Course"
          width="unset"
          fontWeight="700"
          onChange={(e) => setSelectedCourse(e.target.value)}
        >
          {courses.map((course) => (
            <option key={course.course_id} value={course.course_id}>
              {course.course_name}
            </option>
          ))}
        </Select>

        {/* Date Dropdown */}
        <Select
          fontSize="sm"
          variant="subtle"
          placeholder="Select Date"
          width="unset"
          fontWeight="700"
          onChange={(e) => setSelectedDate(e.target.value)}
        >
          {dates.map((date) => (
            <option key={date} value={date}>
              {date}
            </option>
          ))}
        </Select>
      </Flex>

      <PieChart
        h="100%"
        w="100%"
        chartData={pieChartData.map((item) => ({
          name: item.name,
          value: item.value,
          color: item.color,
        }))}
        chartOptions={{
          labels: pieChartData.map((item) => item.name),
          colors: pieChartData.map((item) => item.color),
          legend: { position: "bottom" },
        }}
      />

      <Card
        bg={cardColor}
        flexDirection="row"
        boxShadow={cardShadow}
        w="100%"
        p="25px"
        px="20px"
        mt="15px"
        mx="auto"
      >
        <Flex direction="column" py="5px">
          <Flex align="center">
            <Box h="8px" w="8px" bg="#6AD2FF" borderRadius="50%" me="4px" />
            <Text fontSize="xs" color="secondaryGray.600" fontWeight="700" mb="5px">
              Present
            </Text>
          </Flex>
          <Text fontSize="lg" color={textColor} fontWeight="700">
            {attendanceData.present_count}
          </Text>
        </Flex>
        <VSeparator mx={{ base: "60px", xl: "60px", "2xl": "60px" }} />
        <Flex direction="column" py="5px" me="10px">
          <Flex align="center">
            <Box h="8px" w="8px" bg="#FF6A6A" borderRadius="50%" me="4px" />
            <Text fontSize="xs" color="secondaryGray.600" fontWeight="700" mb="5px">
              Absent
            </Text>
          </Flex>
          <Text fontSize="lg" color={textColor} fontWeight="700">
            {attendanceData.absent_count}
          </Text>
        </Flex>
      </Card>
    </Card>
  );
}