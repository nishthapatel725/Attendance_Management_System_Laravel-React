// import React, { useState, useEffect } from "react";
// // Chakra imports
// import { Box, Flex, Icon, Text, useColorModeValue, Select } from "@chakra-ui/react";
// import BarChart from "components/charts/BarChart";

// // Custom components
// import Card from "components/card/Card.js";
// import {
//   barChartDataDailyTraffic,
//   barChartOptionsDailyTraffic,
// } from "variables/charts";

// // Assets
// import { RiArrowUpSFill } from "react-icons/ri";

// export default function DailyTraffic(props) {
//   const { ...rest } = props;

//   // State to store dropdown options
//   const [timeOptions, setTimeOptions] = useState([]);
//   const [selectedOption, setSelectedOption] = useState("monthly"); // Default selection

//   // Fetch options from the API
//   useEffect(() => {
//     const fetchOptions = async () => {
//       try {
//         const response = await fetch("http://127.0.0.1:8000/api/semester"); // Replace with your API
//         if (!response.ok) throw new Error("Failed to fetch options");
//         const data = await response.json();

//         // Assuming data is an array of objects like [{ id: "daily", name: "Daily" }]
//         setTimeOptions(data);
//       } catch (error) {
//         console.error("Error fetching options:", error);
//       }
//     };

//     fetchOptions();
//   }, []);

//   // Chakra Color Mode
//   const textColor = useColorModeValue("secondaryGray.900", "white");

//   return (
//     <Card align="center" direction="column" w="100%" {...rest}>
//       <Flex justify="space-between" align="start" px="10px" pt="5px">
//         <Flex flexDirection="column" align="start" me="20px">
//           <Flex w="100%">
//             <Text
//               me="auto"
//               color="secondaryGray.600"
//               fontSize="sm"
//               fontWeight="500"
//             >
//               Daily Traffic
//             </Text>
//           </Flex>
//           <Flex align="end">
//             <Text
//               color={textColor}
//               fontSize="34px"
//               fontWeight="700"
//               lineHeight="100%"
//             >
//               2.579
//             </Text>
//             <Text
//               ms="6px"
//               color="secondaryGray.600"
//               fontSize="sm"
//               fontWeight="500"
//             >
//               Visitors
//             </Text>
//           </Flex>
//         </Flex>
//         <Flex align="center">
//           <Select
//             fontSize="sm"
//             variant="subtle"
//             value={selectedOption}
//             onChange={(e) => setSelectedOption(e.target.value)}
//             width="unset"
//             fontWeight="700"
//             placeholder="Select Sem"
//           >
//             {timeOptions.map((option) => (
//               <option key={option.id} value={option.id}>
//                 {option.name}
//               </option>
//             ))}
//           </Select>
//         </Flex>
//       </Flex>
//       <Box h="240px">
//         <BarChart
//           chartData={barChartDataDailyTraffic}
//           chartOptions={barChartOptionsDailyTraffic}
//         />
//       </Box>
//     </Card>
//   );
// }
import React, { useState, useEffect } from "react";
import { Box, Flex, Text, useColorModeValue, Select } from "@chakra-ui/react";
import ReactApexChart from "react-apexcharts";
import BarChart from "components/charts/BarChart";
import Card from "components/card/Card.js";
import {
  barChartDataDailyTraffic as initialChartData,
  barChartOptionsDailyTraffic as initialChartOptions,
} from "variables/charts";

export default function DailyTraffic(props) {
  const { ...rest } = props;

  // State to store dropdown options, selected semester, chart data, and options
  const [timeOptions, setTimeOptions] = useState([]);
  const [selectedOption, setSelectedOption] = useState(1);
  const [totstudent, settotstudent] = useState([]);
  const [course, setcourse] = useState([]);
  const [chartData, setChartData] = useState([
    {
      name: "Attendance Analysis",
      data: [], // Default static data
    },
  ]);
  const [chartOptions, setChartOptions] = useState({
    chart: {
      toolbar: {
        show: false,
      },
    },
    xaxis: {
      categories: [],
    },
    yaxis: {
      labels: {
        style: {
          colors: "#CBD5E0",
          fontSize: "14px",
        },
      },
    },
  });
  console.log(chartData);
  console.log(chartOptions);
  // Fetch options for the dropdown
  useEffect(() => {
    const fetchOptions = async () => {
      try {
        const response = await fetch("http://127.0.0.1:8000/api/semester"); // Replace with your API
        if (!response.ok) throw new Error("Failed to fetch options");
        const data = await response.json();
        // Set dropdown options
        setTimeOptions(data);

        // Set the first semester as the default selected option
        if (data.length > 0) setSelectedOption(data[0].id); // Adjust `id` to match your API response
      } catch (error) {
        console.error("Error fetching options:", error);
      }
    };

    fetchOptions();
  }, []);

  // Fetch chart data when selected semester changes
  useEffect(() => {
    const fetchChartData = async () => {
      if (!selectedOption) return;
  
      try {
        const response = await fetch(
          `http://127.0.0.1:8000/api/student_count/${selectedOption}` // Replace with your API
        );
        if (!response.ok) throw new Error("Failed to fetch chart data");
        const data = await response.json();
        const courses = [];
        const totalStudents = [];
  
        for (let i = 0; i < data.length; i++) {
          courses.push(data[i].course_name); // Store course names
          totalStudents.push(data[i].student_count); // Store student counts
        }
        // Update chart data and options dynamically
        setChartData([
          {
            name: "Total Students",
            data: totalStudents,
          },
        ]);
        
        setChartOptions((prevOptions) => ({
          ...prevOptions,
          xaxis: {
            ...prevOptions.xaxis,
            categories: courses,
          },
        }));

      } catch (error) {
        console.error("Error fetching chart data:", error);
      }
    };
  
    fetchChartData();
  }, [selectedOption]);

  // Chakra Color Mode
  const textColor = useColorModeValue("secondaryGray.900", "white");

  return (
    <Card align="center" direction="column" w="100%" {...rest}>
      <Flex justify="space-between" align="start" px="10px" pt="5px">
        <Flex flexDirection="column" align="start" me="20px">
          <Text color={textColor} fontSize="34px" fontWeight="700" lineHeight="100%">
            All Students
          </Text>
        </Flex>
        <Flex align="center">
          <Select
            fontSize="sm"
            variant="subtle"
            value={selectedOption}
            onChange={(e) => setSelectedOption(e.target.value)}
            width="unset"
            fontWeight="700"
          >
            {timeOptions.map((option) => (
              <option key={option.sem_id} value={option.sem_id}>
                {option.name}
              </option>
            ))}
          </Select>
        </Flex>
      </Flex>
      <Box h="240px">
        {/* <BarChart chartData={chartData} chartOptions={chartOptions} /> */}
        <ReactApexChart
          options={chartOptions}
          series={chartData}
          type="bar" // Ensure this matches the intended chart type
          height={350} // Adjust height as needed
        />
      </Box>
    </Card>
  );
}