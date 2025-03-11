// import {
//   Box,
//   Flex,
//   Table,
//   Tbody,
//   Td,
//   Text,
//   Th,
//   Thead,
//   Tr,
//   Button,
//   useColorModeValue,
// } from '@chakra-ui/react';
// import {
//   createColumnHelper,
//   flexRender,
//   getCoreRowModel,
//   getSortedRowModel,
//   useReactTable,
// } from '@tanstack/react-table';
// import * as React from 'react';
// import Card from 'components/card/Card';

// const columnHelper = createColumnHelper();

// export default function UserReports() {
//   // Chakra Color Mode
//   const [tableData, setTableData] = React.useState([]); // Define state for table data
//   const [sorting, setSorting] = React.useState([]);
//   const textColor = useColorModeValue('secondaryGray.900', 'white');
//   const borderColor = useColorModeValue('gray.200', 'whiteAlpha.100');

//   // Fetch data on mount
//   React.useEffect(() => {
//     fetch('http://127.0.0.1:8000/api/sub_allotments')
//       .then((response) => response.json())
//       .then((data) => {
//         const formattedData = data.map((item, index) => ({
//           id: index + 1, // Index for record number
//           course: item.course_id, // Placeholder for course name
//           semester: item.semester.name,
//           subject: item.subject.sub_name,
//         }));
//         setTableData(formattedData); // Set the state properly
//       })
//       .catch((error) => {
//         console.error('Error fetching data:', error);
//       });
//   }, []);

//   const columns = [
//     columnHelper.accessor('id', {
//       id: 'id',
//       header: () => (
//         <Text fontSize={{ sm: '10px', lg: '12px' }} color="gray.400">
//           #
//         </Text>
//       ),
//       cell: (info) => (
//         <Text color={textColor} fontSize="sm" fontWeight="700">
//           {info.getValue()}
//         </Text>
//       ),
//     }),
//     columnHelper.accessor('semester', {
//       id: 'semester',
//       header: () => (
//         <Text fontSize={{ sm: '10px', lg: '12px' }} color="gray.400">
//           Semester
//         </Text>
//       ),
//       cell: (info) => (
//         <Text color={textColor} fontSize="sm" fontWeight="700">
//           {info.getValue()}
//         </Text>
//       ),
//     }),
//     columnHelper.accessor('subject', {
//       id: 'subject',
//       header: () => (
//         <Text fontSize={{ sm: '10px', lg: '12px' }} color="gray.400">
//           Subject
//         </Text>
//       ),
//       cell: (info) => (
//         <Text color={textColor} fontSize="sm" fontWeight="700">
//           {info.getValue()}
//         </Text>
//       ),
//     }),
//     {
//       id: 'actions',
//       header: () => (
//         <Text fontSize={{ sm: '10px', lg: '12px' }} color="gray.400">
//           Actions
//         </Text>
//       ),
//       cell: () => (
//         <Flex gap={2}>
//           <Button colorScheme="blue" size="sm">
//             Insert
//           </Button>
//         </Flex>
//       ),
//     },
//   ];

//   const table = useReactTable({
//     data: tableData, // Use the state here
//     columns,
//     state: {
//       sorting,
//     },
//     onSortingChange: setSorting,
//     getCoreRowModel: getCoreRowModel(),
//     getSortedRowModel: getSortedRowModel(),
//   });

//   return (
//     <Card flexDirection="column" w="100%" px="0px" overflowX={{ sm: 'scroll', lg: 'hidden' }}>
//       <Box>
//         <Table variant="simple" color="gray.500" mb="24px" mt="0px">
//           <Thead>
//             {table.getHeaderGroups().map((headerGroup) => (
//               <Tr key={headerGroup.id}>
//                 {headerGroup.headers.map((header) => (
//                   <Th
//                     key={header.id}
//                     colSpan={header.colSpan}
//                     borderColor={borderColor}
//                     cursor="pointer"
//                     onClick={header.column.getToggleSortingHandler()}
//                   >
//                     <Flex justifyContent="space-between" align="center" fontSize={{ sm: '10px', lg: '12px' }} color="gray.400">
//                       {flexRender(header.column.columnDef.header, header.getContext())}
//                     </Flex>
//                   </Th>
//                 ))}
//               </Tr>
//             ))}
//           </Thead>
//           <Tbody>
//             {table.getRowModel().rows.map((row) => (
//               <Tr key={row.id}>
//                 {row.getVisibleCells().map((cell) => (
//                   <Td
//                     key={cell.id}
//                     fontSize={{ sm: '14px' }}
//                     minW={{ sm: '150px', md: '200px', lg: 'auto' }}
//                     borderColor="transparent"
//                   >
//                     {flexRender(cell.column.columnDef.cell, cell.getContext())}
//                   </Td>
//                 ))}
//               </Tr>
//             ))}
//           </Tbody>
//         </Table>
//       </Box>
//     </Card>
//   );
// }

import React, { useEffect, useState } from 'react';
import {
  Box,
  Flex,
  Table,
  Tbody,
  Td,
  Text,
  Th,
  Thead,
  Tr,
  Button,
  useColorModeValue,
  SimpleGrid,
  useToast 
} from '@chakra-ui/react';
import {
  createColumnHelper,
  flexRender,
  getCoreRowModel,
  getSortedRowModel,
  useReactTable,
} from '@tanstack/react-table';
import Card from 'components/card/Card';
import { Link } from 'react-router-dom';
import DailyTraffic from "views/admin/default/components/DailyTraffic";
import PieChart from "components/charts/PieChart";
import PieCard from "views/admin/default/components/PieCard";
import { pieChartData, pieChartOptions } from "variables/charts";

const columnHelper = createColumnHelper();

function Dashboard() {
  const [subjects, setSubjects] = useState([]);
  const [sorting, setSorting] = useState([]);
  const textColor = useColorModeValue('secondaryGray.900', 'white');
  const borderColor = useColorModeValue('gray.200', 'whiteAlpha.100');

  useEffect(() => {
    const teacherId = sessionStorage.getItem('teacherId');

    fetch(`http://127.0.0.1:8000/api/allocate-subject/${teacherId}`)
      .then((response) => response.json())
      .then((data) => {
        const formattedData = data.map((subject, index) => ({
          id: index + 1,
          course: subject.course_name,
          semester: subject.name,
          subject: subject.sub_name,
          course_id: subject.course_id,
          sem_id: subject.sem_id,
          sub_id: subject.sub_id,
        }));
        setSubjects(formattedData);
      })
      .catch((error) => console.error('Error fetching data:', error));
  }, []);

  const columns = [
    columnHelper.accessor('id', {
      id: 'id',
      header: () => (
        <Text fontSize={{ sm: '10px', lg: '12px' }} color="gray.400">
          #
        </Text>
      ),
      cell: (info) => (
        <Text color={textColor} fontSize="sm" fontWeight="700">
          {info.getValue()}
        </Text>
      ),
    }),
    columnHelper.accessor('course', {
      id: 'course',
      header: () => (
        <Text fontSize={{ sm: '10px', lg: '12px' }} color="gray.400">
          Course
        </Text>
      ),
      cell: (info) => (
        <Text color={textColor} fontSize="sm" fontWeight="700">
          {info.getValue()}
        </Text>
      ),
    }),
    columnHelper.accessor('semester', {
      id: 'semester',
      header: () => (
        <Text fontSize={{ sm: '10px', lg: '12px' }} color="gray.400">
          Semester
        </Text>
      ),
      cell: (info) => (
        <Text color={textColor} fontSize="sm" fontWeight="700">
          {info.getValue()}
        </Text>
      ),
    }),
    columnHelper.accessor('subject', {
      id: 'subject',
      header: () => (
        <Text fontSize={{ sm: '10px', lg: '12px' }} color="gray.400">
          Subject
        </Text>
      ),
      cell: (info) => (
        <Text color={textColor} fontSize="sm" fontWeight="700">
          {info.getValue()}
        </Text>
      ),
    }),
    // {
    //   id: 'actions',
    //   header: () => (
    //     <Text fontSize={{ sm: '10px', lg: '12px' }} color="gray.400">
    //       Actions
    //     </Text>
    //   ),
    //   cell: ({ row }) => (
    //     <Flex gap={2}>
    //       <Link
    //         to={`/lecture-information?c_id=${row.original.course_id}&s_id=${row.original.sem_id}&sub_id=${row.original.sub_id}`}
    //       >
    //         <Button colorScheme="blue" size="sm">
    //           Insert
    //         </Button>
    //       </Link>
    //     </Flex>
    //   ),
    // },
  ];

  const table = useReactTable({
    data: subjects,
    columns,
    state: {
      sorting,
    },
    onSortingChange: setSorting,
    getCoreRowModel: getCoreRowModel(),
    getSortedRowModel: getSortedRowModel(),
  });

  return (
    <>
      <Card flexDirection="column" w="100%" px="0px" overflowX={{ sm: 'scroll', lg: 'hidden' }}>
        <Box>
          <Table variant="simple" color="gray.500" mb="24px" mt="0px">
            <Thead>
              {table.getHeaderGroups().map((headerGroup) => (
                <Tr key={headerGroup.id}>
                  {headerGroup.headers.map((header) => (
                    <Th
                      key={header.id}
                      colSpan={header.colSpan}
                      borderColor={borderColor}
                      cursor="pointer"
                      onClick={header.column.getToggleSortingHandler()}
                    >
                      <Flex justifyContent="space-between" align="center" fontSize={{ sm: '10px', lg: '12px' }} color="gray.400">
                        {flexRender(header.column.columnDef.header, header.getContext())}
                      </Flex>
                    </Th>
                  ))}
                </Tr>
              ))}
            </Thead>
            <Tbody>
              {table.getRowModel().rows.map((row) => (
                <Tr key={row.id}>
                  {row.getVisibleCells().map((cell) => (
                    <Td
                      key={cell.id}
                      fontSize={{ sm: '14px' }}
                      minW={{ sm: '150px', md: '200px', lg: 'auto' }}
                      borderColor="transparent"
                    >
                      {flexRender(cell.column.columnDef.cell, cell.getContext())}
                    </Td>
                  ))}
                </Tr>
              ))}
            </Tbody>
          </Table>
        </Box>
      </Card>
      <br />
      {/* <Card>
        <Box clas='p-4'>
          <DailyTraffic />
          <PieChart
            h='100vh'
            w='100vh'
            chartData={pieChartData}
            chartOptions={pieChartOptions}
          />
        </Box> 
      </Card> */}
      <Card>
        <SimpleGrid columns={{ base: 1, md: 2, xl: 2 }} >
          <DailyTraffic />
          <PieCard />
        </SimpleGrid>
      </Card>
    </>
  );
}

export default Dashboard;