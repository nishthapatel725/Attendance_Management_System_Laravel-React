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
  Select,
  Radio,
  RadioGroup,
  FormLabel,
  useToast
} from '@chakra-ui/react';
import {
  createColumnHelper,
  flexRender,
  getCoreRowModel,
  getSortedRowModel,
  useReactTable,
} from '@tanstack/react-table';
import React, { useState, useEffect } from 'react';
import Card from 'components/card/Card';
import axios from 'axios';

const columnHelper = createColumnHelper();

export default function UserReports() {
  const [tableData, setTableData] = useState([]); // State for table data
  const [sorting, setSorting] = useState([]);
  const textColor = useColorModeValue('secondaryGray.900', 'white');
  const borderColor = useColorModeValue('gray.200', 'whiteAlpha.100');
  const [students, setStudents] = useState([]); // State for fetched students
  const [selectedCourse, setSelectedCourse] = useState(null);
  const [selectedSemester, setSelectedSemester] = useState(null);
  const [selectedTabIndex, setSelectedTabIndex] = useState(0);
  const [LecId, setLecId] = useState(null);
  const [Attendance, setAttendance] = useState("Absent");
  const [attendance, setAttend] = useState({});
  const [editLec, seteditLec] = useState(null);
  
  const [formData, setFormData] = useState({
    lectureDate: '',
    course: '',
    semester: '',
    subject: '',
    topic: '',
    method: '',
    lectureNo: '',
    proxyStatus: '',
    teacher: '',
  });

  const goToThirdTab = () => {
    setSelectedTabIndex(2); // Set to the index of the third tab
  };

  // Fetch lectures on mount
  useEffect(() => {
    fetchLectures();
  }, []);

  const fetchLectures = async () => {
    try {
      const response = await fetch('http://127.0.0.1:8000/api/lectures');
      const data = await response.json();
      const formattedData = data.map((item, index) => ({
        id: index + 1, // Index for record number
        date: item.lec_date, // Lecture date
        subject: item.subject.sub_name, // Subject
        lectutre : item.id
      }));
      setTableData(formattedData);
    } catch (error) {
      console.error('Error fetching data:', error);
    }
  };

  // Table columns
  const columns = [
    columnHelper.accessor('id', {
      id: 'id',
      header: () => (
        <Text fontSize={{ sm: '10px', lg: '12px' }} color="gray.400">#</Text>
      ),
      cell: (info) => (
        <Text color={textColor} fontSize="sm" fontWeight="700">
          {info.getValue()}
        </Text>
      ),
    }),
    columnHelper.accessor('date', {
      id: 'date',
      header: () => (
        <Text fontSize={{ sm: '10px', lg: '12px' }} color="gray.400">Date</Text>
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
        <Text fontSize={{ sm: '10px', lg: '12px' }} color="gray.400">Subject</Text>
      ),
      cell: (info) => (
        <Text color={textColor} fontSize="sm" fontWeight="700">
          {info.getValue()}
        </Text>
      ),
    }),
    columnHelper.accessor('lectutre', {
      id: 'lectutre',
      header: () => (
        <Text fontSize={{ sm: '10px', lg: '12px' }} color="gray.400">Edit</Text>
      ),
      cell: (info) => (
        <Button
        size="sm"
        colorScheme="blue"                                      

        onClick={() => fetchLectureData(info.getValue())} 
        >
          Edit
        </Button>
      ),
    }),
    // {
    //   id: 'actions',
    //   header: () => (
    //     <Text fontSize={{ sm: '10px', lg: '12px' }} color="gray.400">Edit</Text>
    //   ),
    //   cell: () => (
    //     <Flex gap={2}>
    //       <Button colorScheme="blue" size="sm">Edit</Button>
    //     </Flex>
    //   ),
    // },
  ];

  const table = useReactTable({
    data: tableData, // Use the state here
    columns,
    state: { sorting },
    onSortingChange: setSorting,
    getCoreRowModel: getCoreRowModel(),
    getSortedRowModel: getSortedRowModel(),
  });


  // const fetchLectureData = async (lectureId) => {
  //   console.log("lectureId : " + lectureId);
  //   try {
  //     // Fetch lecture data by ID
  //     const lectureResponse = await axios.get(`http://127.0.0.1:8000/api/lectures/${lectureId}`);
  //     const lectureData = lectureResponse.data;

  //     // Set selected course and semester in local state
  //     setSelectedCourse(lectureData.course_id);
  //     setSelectedSemester(lectureData.sem_id);
  
  //     // Fetch students based on selected course and semester
  //     const studentResponse = await axios.get('http://127.0.0.1:8000/api/students', {
  //       params: {
  //         course_id: lectureData.course_id,
  //         sem_id: lectureData.sem_id,
  //       },
  //     });
  
  //     const students = studentResponse.data;
  //     // console.log('Students fetched:', students);

  //     // Initialize attendance for each student
  //     for (const student of students) {
  //       const attendRequestBody = {
  //         lec_id: lectureId, // Use fetched lecture ID
  //         s_id: student.id, // Student ID
  //       };
  
  //       await axios.get('http://127.0.0.1:8000/api/attendance', attendRequestBody);
  //     }
  

  //     // Navigate to Attendance tab
  //     goToThirdTab();
  
  //   } catch (error) {
  //     console.error('Error fetching lecture data:', error);
  //   }
  // };  

  // New Form for Lecture
  
  const fetchLectureData = async (lectureId) => {
    seteditLec(lectureId);
    console.log("lectureId : " + lectureId);
      try {
          // Fetch lecture data by ID
          const lectureResponse = await axios.get(`http://127.0.0.1:8000/api/lectures/${lectureId}`);
          const lectureData = lectureResponse.data;

          // Set selected course and semester in local state
          setSelectedCourse(lectureData.course_id);
          setSelectedSemester(lectureData.sem_id);

          // Fetch students based on selected course and semester
          const studentResponse = await axios.get(`http://127.0.0.1:8000/api/students_attendence/${lectureId}`, {
              params: {
                  course_id: lectureData.course_id,
                  sem_id: lectureData.sem_id,
              },
          });         

          const students = studentResponse.data;
          
          // // Fetch existing attendance data for the lecture
          // const attendanceResponse = await axios.get(`http://127.0.0.1:8000/api/attendance/${lectureId}`);
          // const existingAttendance = attendanceResponse.data.reduce((acc, curr) => {
          //   acc[curr.student_id] = curr.status; // Assuming each attendance record has `student_id` and `status`
          //   return acc;
          // }, {});
          // setAttend(existingAttendance);


          // Navigate to Attendance tab
          goToThirdTab();

      } catch (error) {
          console.error('Error fetching lecture data:', error);
      }
  };
  
  const NewForm = () => {
    const [courses, setCourses] = useState([]);
    const [semesters, setSemesters] = useState([]);
    const [subjects, setSubjects] = useState([]);
    const [teachers, setTeachers] = useState([]);
    const [formData, setFormData] = useState({
      lectureDate: '',
      course: '',
      semester: '',
      subject: '',
      topic: '',
      method: '',
      lectureNo: '',
      proxyStatus: '',
      teacher: '',
    });

    const toast = useToast();

    const showToast = (message) => {
      toast({
        title: "Action!",
        description: message,
        status: "error", // Types: 'success', 'error', 'warning', 'info'
        duration: 5000,    // Duration in milliseconds
        isClosable: true,  // Adds a close button to the toast
        position: "top-right", // 'top', 'top-right', 'bottom-left', etc.
      });
    };

    // Fetch data for dropdowns on component mount
    useEffect(() => {
      const fetchDropdowns = async () => {
        try {
          const courseResponse = await axios.get('http://127.0.0.1:8000/api/course');
          setCourses(courseResponse.data);

          const semesterResponse = await axios.get('http://127.0.0.1:8000/api/semester');
          setSemesters(semesterResponse.data);

          const subjectResponse = await axios.get('http://127.0.0.1:8000/api/subject');
          setSubjects(subjectResponse.data);

          const teacherResponse = await axios.get('http://127.0.0.1:8000/api/teacher');
          setTeachers(teacherResponse.data);
        } catch (error) {
          console.error('Error fetching dropdown data:', error);
        }
      };

      fetchDropdowns();

      // Retrieve stored course and semester from local storage
      const storedCourse = localStorage.getItem('selectedCourse');
      const storedSemester = localStorage.getItem('selectedSemester');
      if (storedCourse) {
        setFormData((prev) => ({ ...prev, course: storedCourse }));
      }
      if (storedSemester) {
        setFormData((prev) => ({ ...prev, semester: storedSemester }));
      }
    }, []);

    const handleChange = (e) => {
      const { name, value } = e.target;
        setFormData({ ...formData, [name]: value });
    };

    const handleSubmit = async () => {
      try {
        const requestBody = {
          lec_date: formData.lectureDate,
          course_id: formData.course,
          sem_id: formData.semester,
          sub_id: formData.subject,
          lec_topic: formData.topic,
          lec_method: formData.method,
          lec_no: formData.lectureNo,
          proxy_status: formData.proxyStatus,
          t_id: formData.teacher,
        };
    
        const response = await axios.post('http://127.0.0.1:8000/api/lectures', requestBody);
        // console.log('Lecture saved:', response.data);
        // console.log(response.data.id);
        seteditLec(response.data.id);

        setSelectedCourse(formData.course);
        setSelectedSemester(formData.semester);

        const studentResponse = await axios.get('http://127.0.0.1:8000/api/students', {
          params: {
            course_id: formData.course,
            sem_id: formData.semester
          }
        });

        const students = studentResponse.data;
        console.log('Students fetched:', students); 

        for (const student of students) {
          const attendRequestBody = {
            lec_id: response.data.id,  // Lecture ID
            s_id: student.id, // Student ID
            p_flag: "A", // Assuming initial attendance status is 'absent'
          };
    
          await axios.post('http://127.0.0.1:8000/api/attendance', attendRequestBody);
        }

        goToThirdTab();// Toggle between 0 and 1
        fetchLectures(); // Refresh the lectures list after saving
        setFormData({ // Reset form data after submission
          lectureDate: '',
          course: '',
          semester: '',
          subject: '',
          topic: '',
          method: '',
          lectureNo: '',
          proxyStatus: '',
          teacher: '',
        });
      } catch (err) {
        let errors = err.response.data.errors;
        for (const [key, messages] of Object.entries(errors)) {
          for (const message of messages) {
            showToast(message); 
          }
        }
      }
    };

    return (
      // <Box maxH="450px" overflowY="auto">
      <>
        <Text fontSize="lg" mb={4}>New Lecture Form</Text>

        <FormLabel htmlFor="lectureDate">Lecture Date</FormLabel>
        <Input
          id="lectureDate"
          placeholder="Lecture Date"
          mb={4}
          name="lectureDate"
          type="date"
          value={formData.lectureDate}
          onChange={handleChange}
        />

        <FormLabel htmlFor="course">Course</FormLabel>
        <Select
          id="course"
          placeholder="Select Course"
          mb={4}
          name="course"
          value={formData.course}
          onChange={handleChange}
        >
          {courses.map((course) => (
            <option key={course.id} value={course.course_id}>{course.course_name}</option>
          ))}
        </Select>

        <FormLabel htmlFor="semester">Semester</FormLabel>
        <Select
          id="semester"
          placeholder="Select Semester"
          mb={4}
          name="semester"
          value={formData.semester}
          onChange={handleChange}
        >
          {semesters.map((semester) => (
            <option key={semester.id} value={semester.sem_id}>{semester.name}</option>
          ))}
        </Select>

        <FormLabel htmlFor="subject">Subject</FormLabel>
        <Select
          id="subject"
          placeholder="Select Subject"
          mb={4}
          name="subject"
          value={formData.subject}
          onChange={handleChange}
        >
          {subjects.map((subject) => (
            <option key={subject.id} value={subject.sub_id}>{subject.sub_name}</option>
          ))}
        </Select>

        <FormLabel htmlFor="topic">Topic</FormLabel>
        <Input
          id="topic"
          placeholder="Topic"
          mb={4}
          name="topic"
          value={formData.topic}
          onChange={handleChange}
        />

        <FormLabel htmlFor="method">Method</FormLabel>
        <Input
          id="method"
          placeholder="Method"
          mb={4}
          name="method"
          value={formData.method}
          onChange={handleChange}
        />

        <FormLabel htmlFor="lectureNo">Lecture No.</FormLabel>
        <Input
          id="lectureNo"
          placeholder="Lecture No."
          mb={4}
          name="lectureNo"
          value={formData.lectureNo}
          onChange={handleChange}
        />

        <FormLabel htmlFor="proxyStatus">Proxy Status</FormLabel>
        <RadioGroup
          id="proxyStatus"
          name="proxyStatus"
          value={formData.proxyStatus}
          onChange={(value) => setFormData({ ...formData, proxyStatus: value })}
          mb={4}
        >
          <Radio value="Own">Own</Radio>
          <Radio value="Proxy">Proxy</Radio>
        </RadioGroup>

        <FormLabel htmlFor="teacher">Teacher</FormLabel>
        <Select
          id="teacher"
          placeholder="Select Teacher"
          mb={4}
          name="teacher"
          value={formData.teacher}
          onChange={handleChange}
        >
          {teachers.map((teacher) => (
            <option key={teacher.id} value={teacher.id}>{teacher.first_name} {teacher.last_name}</option>
          ))}
        </Select>

        <Button colorScheme="blue" onClick={handleSubmit}>
          Submit
        </Button>
        </>
      // </Box>
    );
  };

//   const AttendanceTab = () => {
//     const [students, setStudents] = useState([]);
//     const [attendance, setAttendance] = useState({});

//     // console.log(selectedCourse);
//     // console.log(selectedSemester);

//     useEffect(() => {
//       const fetchStudents = async () => {
//         try {
//           const response = await axios.get(`http://127.0.0.1:8000/api/students?course_id=${selectedCourse}&sem_id=${selectedSemester}`);
          
//           // Sort students by roll_no in ascending order
//           const sortedStudents = response.data.sort((a, b) => a.roll_no - b.roll_no);
          
//           setStudents(sortedStudents); // Assuming response.data is an array of students
//         } catch (error) {
//           console.error('Error fetching students:', error);
//         }
//       };

//       fetchStudents();
//     }, []);

//     var p_flag;

//     const handleAttendanceChange = (rollNo, status) => {
//       // Declare p_flag properly
//       let p_flag = "P";
    
//       // Map the status to 0 or 1
//       if (status === 'Present') {
//         p_flag = 'P';
//       } else if (status === 'Absent') {
//         p_flag = 'A';
//       }
    
//       // console.log("rollNo : " + rollNo + " Attendance : " + p_flag);
    
//       // Update attendance in the state
//       setAttendance((prev) => ({
//         ...prev,
//         [rollNo]: prev[rollNo] === 'Present' ? 'Absent' : 'Present',
//       }));
    
//       // Prepare the payload for the PUT request
//       const payload = {
//         p_flag: p_flag,  
//       };
    
//       // Send the PUT request using axios
//       axios.put(`http://127.0.0.1:8000/api/update_attendance/${rollNo}/${LecId}`, payload)
//         .then((response) => {
//           if (response.data.message === 'Attendance updated successfully!') {
//             console.log('Attendance updated:', response.data.attendance);
//           } else {
//             console.error('Error updating attendance:', response.data.message);
//           }
//         })
//         .catch((error) => {
//           console.error('Network error:', error);
//           console.error(error.response ? error.response.data : error.message); // Log the server error
//         });
//     };

//     // const handleSubmitAttendance = () => {
//     //   // Implement attendance submission logic here
//     //   console.log('Attendance submitted:', attendance);
//     // };

//     // Create header groups dynamically
//     const headerGroups = [
//       { id: 'attendance', headers: [{ id: 'roll_no', header: 'Roll No' }, { id: 'name', header: 'Name' }, { id: 'status', header: 'Status' }] },
//     ];

//     return (
//       <Box maxH="450px" overflowY="auto">
//         <Text fontSize="lg" mb={4}>Attendance</Text>
//         <Table variant="simple">
//           <Thead>
//             <Tr>
//               {headerGroups.map(headerGroup => (
//                 <React.Fragment key={headerGroup.id}>
//                   {headerGroup.headers.map(header => (
//                     <Th key={header.id}>{header.header}</Th>
//                   ))}
//                 </React.Fragment>
//               ))}
//             </Tr>
//           </Thead>
//           <Tbody>
//             {students.map(student => (
//               <Tr key={student.id}>
//                 <Td>{student.roll_no}</Td>
//                 <Td>{`${student.first_name} ${student.middle_name || ''} ${student.last_name}`}</Td>
//                 <Td>
//                     <Button
//                       colorScheme={attendance[student.id] === 'Present' ? 'green' : 'red'}
//                       onClick={() => handleAttendanceChange(student.id, attendance[student.id] === 'Present' ? 'Present' : 'Absent')}
//                     >
//                       {attendance[student.id] === 'Present' ? 'Present' : 'Absent'}
//                     </Button>
//                 </Td>
//               </Tr>
//             ))}
//           </Tbody>
//         </Table>
//       </Box>
//     );
// };
  
  // const AttendanceTab = () => {
  //   const [students, setStudents] = useState([]);
  //   const [attendance, setAttendance] = useState({});
  //   const [buttonState, setButtonState] = useState({});

  //   useEffect(() => {
  //       const fetchStudents = async () => {
  //           try {
  //               // const response = await axios.get(`http://127.0.0.1:8000/api/students?course_id=${selectedCourse}&sem_id=${selectedSemester}`);
  //               const response = await axios.get(`http://127.0.0.1:8000/api/students_attendence/${editLec}?course_id=${selectedCourse}&sem_id=${selectedSemester}`);
                
  //               // Sort students by roll_no in ascending order
  //               const sortedStudents = response.data.sort((a, b) => a.roll_no - b.roll_no);
                
  //               setStudents(sortedStudents);
  //           } catch (error) {
  //               console.error('Error fetching students:', error);
  //           }
  //       };

  //       fetchStudents();
  //   }, [selectedCourse, selectedSemester]); // Fetch students whenever course or semester changes

  //   // const handleAttendanceChange = (studentId, currentStatus) => {
      
  //   //     const newStatus = currentStatus === 'P' ? 'A' : 'P';
        
  //   //     setStudents((prevStudents) =>
  //   //       prevStudents.map((student) =>
  //   //         student.id === studentId
  //   //           ? { ...student, p_flag: newStatus === "P" ? "A" : "P" }
  //   //           : student
  //   //       )
  //   //     );
  //   //     console.log(studentId);
  //   //     setAttendance((prevAttendance) => ({
  //   //       ...prevAttendance,
  //   //       [studentId]: newStatus, 
  //   //     }));

  //   //     const payload = {
  //   //         p_flag: newStatus === 'P' ? 'P' : 'A',
  //   //     };

  //   //     axios.put(`http://127.0.0.1:8000/api/update_attendance/${studentId}/${editLec}`, payload)
  //   //         .then((response) => {
  //   //             if (response.data.message === 'Attendance updated successfully!') {
  //   //                 console.log('Attendance updated:', response.data.attendance);
  //   //             } else {
  //   //                 console.error('Error updating attendance:', response.data.message);
  //   //             }
  //   //         })
  //   //         .catch((error) => {
  //   //             console.error('Network error:', error);
  //   //             console.error(error.response ? error.response.data : error.message);
  //   //         });
  //   // };

  //   const handleAttendanceChange = (studentId, currentStatus) => {
  //     // Toggle attendance status (Present -> Absent or Absent -> Present)
  //     const newStatus = currentStatus === 'P' ? 'A' : 'P';

  //     // Prepare payload for the API request
  //     const payload = { p_flag: newStatus };
  
  //     // Make the API request to update attendance
  //     axios
  //         .put(`http://127.0.0.1:8000/api/update_attendance/${studentId}/${editLec}`, payload)
  //         .then((response) => {
  //             // Check if the response is successful
  //             if (response.data.message === 'Attendance updated successfully!') {
  //                 console.log('Attendance updated successfully:', response.data.attendance);
  //             } else {
  //                 console.error('Error updating attendance:', response.data.message);
  //             }
  //         })
  //         .catch((error) => {
  //             console.error('Network error:', error);
  //             console.error(error.response ? error.response.data : error.message);
  //         });
  //   };
  

  //   const headerGroups = [
  //       { id: 'attendance', headers: [{ id: 'roll_no', header: 'Roll No' }, { id: 'name', header: 'Name' }, { id: 'status', header: 'Status' }] },
  //   ];

  //   return (
  //       <Box maxH="450px" overflowY="auto">
  //           <Text fontSize="lg" mb={4}>Attendance</Text>
  //           <Table variant="simple">
  //               <Thead>
  //                   <Tr>
  //                       {headerGroups.map(headerGroup => (
  //                           <React.Fragment key={headerGroup.id}>
  //                               {headerGroup.headers.map(header => (
  //                                   <Th key={header.id}>{header.header}</Th>
  //                               ))}
  //                           </React.Fragment>
  //                       ))}
  //                   </Tr>
  //               </Thead>
  //               <Tbody>
  //                   {students.map(student => (
  //                       <Tr key={student.student.id}>
  //                           <Td>{student.student.roll_no}</Td>
  //                           <Td>{`${student.student.first_name} ${student.student.middle_name || ''} ${student.student.last_name}`}</Td>
  //                           <Td>
  //                               <Button
  //                                   colorScheme={student.p_flag === 'P' ? 'green' : 'red'}
  //                                   onClick={() => handleAttendanceChange(student.student.id, student.p_flag)}
  //                               >
  //                                   {student.p_flag === 'P' ? 'Present' : 'Absent'}
  //                               </Button>
  //                               {/* <Button
  //                                 colorScheme={attendance[student.id] === 'P' ? 'green' : 'red'}
  //                                 onClick={() =>
  //                                   handleAttendanceChange(
  //                                     student.id,
  //                                     attendance[student.id] === 'P' ? 'A' : 'P'
  //                                   )
  //                                 }
  //                               >
  //                                 {attendance[student.id] === 'P' ? 'Present' : 'Absent'}
  //                               </Button> */}
  //                           </Td>
  //                       </Tr>
  //                   ))}
  //               </Tbody>
  //           </Table>
  //       </Box>
  //   );
  // };

  const AttendanceTab = () => {
    const [students, setStudents] = useState([]);

    useEffect(() => {
        const fetchStudents = async () => {
            try {
                // Fetch students and attendance data
                const response = await axios.get(
                    `http://127.0.0.1:8000/api/students_attendence/${editLec}?course_id=${selectedCourse}&sem_id=${selectedSemester}`
                );

                // Sort students by roll_no in ascending order
                const sortedStudents = response.data.sort((a, b) => a.roll_no - b.roll_no);
                setStudents(sortedStudents);
            } catch (error) {
                console.error("Error fetching students:", error);
            }
        };

        fetchStudents();
    }, [selectedCourse, selectedSemester, editLec]);

    const handleAttendanceChange = (studentId, currentStatus) => {
        const newStatus = currentStatus === "P" ? "A" : "P"; // Toggle status
        const payload = { p_flag: newStatus }; // Prepare payload

        axios
            .put(`http://127.0.0.1:8000/api/update_attendance/${studentId}/${editLec}`, payload)
            .then((response) => {
                if (response.data.message === "Attendance updated successfully!") {
                    console.log("Attendance updated successfully:", response.data.attendance);

                    // Update the local state to reflect the new status
                    setStudents((prevStudents) =>
                        prevStudents.map((student) =>
                            student.student.id === studentId
                                ? { ...student, p_flag: newStatus }
                                : student
                        )
                    );
                } else {
                    console.error("Error updating attendance:", response.data.message);
                }
            })
            .catch((error) => {
                console.error("Network error:", error);
                console.error(error.response ? error.response.data : error.message);
            });
    };

    const headerGroups = [
        { id: "attendance", headers: [{ id: "roll_no", header: "Roll No" }, { id: "name", header: "Name" }, { id: "status", header: "Status" }] },
    ];

    return (
        // <Box maxH="450px" overflowY="auto">
        <>
            <Text fontSize="lg" mb={4}>
                Attendance
            </Text>
            <Table variant="simple">
                <Thead>
                    <Tr>
                        {headerGroups.map((headerGroup) => (
                            <React.Fragment key={headerGroup.id}>
                                {headerGroup.headers.map((header) => (
                                    <Th key={header.id}>{header.header}</Th>
                                ))}
                            </React.Fragment>
                        ))}
                    </Tr>
                </Thead>
                <Tbody>
                    {students.map((student) => (
                        <Tr key={student.student.id}>
                            <Td>{student.student.roll_no}</Td>
                            <Td>{`${student.student.first_name} ${student.student.middle_name || ""} ${student.student.last_name}`}</Td>
                            <Td>
                                <Button
                                    colorScheme={student.p_flag === "P" ? "green" : "red"}
                                    onClick={() => handleAttendanceChange(student.student.id, student.p_flag)}
                                >
                                    {student.p_flag === "P" ? "Present" : "Absent"}
                                </Button>
                            </Td>
                        </Tr>
                    ))}
                </Tbody>
            </Table>
            </>
        // </Box>
    );
};


  return (
    <Card>
      <Tabs variant="line" colorScheme="blue" isFitted index={selectedTabIndex} onChange={setSelectedTabIndex}>
        <TabList>
          <Tab>Lectures</Tab>
          <Tab>New Lecture</Tab>
          <Tab>Attandance</Tab>
        </TabList>

        <TabPanels>
          <TabPanel>
              <Table variant="simple">
                <Thead>
                  <Tr>
                    {table.getHeaderGroups().map(headerGroup => (
                      <React.Fragment key={headerGroup.id}>
                        {headerGroup.headers.map(header => (
                          <Th key={header.id}>
                            {flexRender(header.column.columnDef.header, header.getContext())}
                          </Th>
                        ))}
                        {/* <Th>Edit</Th> */}
                      </React.Fragment>
                    ))}
                  </Tr>
                </Thead>
                <Tbody>
                  {table.getRowModel().rows.map(row => (
                    <Tr key={row.id}>
                      {row.getVisibleCells().map(cell => (
                        <Td key={cell.id} >
                          {flexRender(cell.column.columnDef.cell, cell.getContext())}
                        </Td>
                      ))}
                    </Tr>
                  ))}
                </Tbody>
              </Table>
          </TabPanel>

          <TabPanel>
            <NewForm />
          </TabPanel>
          <TabPanel>
            <AttendanceTab/>
          </TabPanel>
        </TabPanels>
      </Tabs>
    </Card>
  );
}