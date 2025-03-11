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
    Tabs,
    TabList,
    TabPanels,
    Tab,
    TabPanel,
    Input,
  } from '@chakra-ui/react';
  import {
    createColumnHelper,
    flexRender,
    getCoreRowModel,
    getSortedRowModel,
    useReactTable,
  } from '@tanstack/react-table';
  import * as React from 'react';
  import Card from 'components/card/Card';
  
  const columnHelper = createColumnHelper();
  
  export default function UserReports() {
    // Chakra Color Mode
    const [tableData, setTableData] = React.useState([]); // Define state for table data
    const [sorting, setSorting] = React.useState([]);
    const textColor = useColorModeValue('secondaryGray.900', 'white');
    const borderColor = useColorModeValue('gray.200', 'whiteAlpha.100');
  
    // Fetch data on mount
    React.useEffect(() => {
      fetch('http://127.0.0.1:8000/api/sub_allotments')
        .then((response) => response.json())
        .then((data) => {
          const formattedData = data.map((item, index) => ({
            id: index + 1, // Index for record number
            course: item.course_id, // Placeholder for course name
            semester: item.semester.name,
            subject: item.subject.sub_name,
          }));
          setTableData(formattedData); // Set the state properly
        })
        .catch((error) => {
          console.error('Error fetching data:', error);
        });
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
      {
        id: 'actions',
        header: () => (
          <Text fontSize={{ sm: '10px', lg: '12px' }} color="gray.400">
            Actions
          </Text>
        ),
        cell: () => (
          <Flex gap={2}>
            <Button colorScheme="blue" size="sm">
              Insert
            </Button>
          </Flex>
        ),
      },
    ];
  
    const table = useReactTable({
      data: tableData, // Use the state here
      columns,
      state: {
        sorting,
      },
      onSortingChange: setSorting,
      getCoreRowModel: getCoreRowModel(),
      getSortedRowModel: getSortedRowModel(),
    });
  
    // Form for New section
    const NewForm = () => (
      <Box p={4}>
        <Text fontSize="lg" mb={2}>New Lecture Form</Text>
        <Input placeholder="Course Name" mb={2} />
        <Input placeholder="Semester" mb={2} />
        <Input placeholder="Subject" mb={2} />
        <Button colorScheme="blue" mt={4}>Submit</Button>
      </Box>
    );
  
    // Render component
    return (
      <Card flexDirection="column" w="100%" px="0px" overflowX={{ sm: 'scroll', lg: 'hidden' }}>
        {/* Tabs for navigation */}
        <Tabs variant="line" colorScheme="blue" isFitted>
          <TabList>
            <Tab>Assignment</Tab>
            <Tab>New</Tab>
          </TabList>
  
          <TabPanels>
            {/* Lecture Data Table */}
            <TabPanel>
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
            </TabPanel>
  
            {/* New Form */}
            <TabPanel>
              <NewForm />
            </TabPanel>
  
            {/* Attendance Data Table (reuse Lecture table structure or fetch different data) */}
            <TabPanel>
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
            </TabPanel>
          </TabPanels>
        </Tabs>
      </Card>
    );
  }
  