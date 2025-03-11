// import React, { useState } from "react";
// import {
//   Box,
//   Grid,
//   Input,
//   Button,
//   FormControl,
//   FormLabel,
//   Alert,
//   AlertIcon,
//   AlertTitle,
//   AlertDescription,
// } from "@chakra-ui/react";
// import axios from "axios";

// const ProfileForm = () => {
//   const [formData, setFormData] = useState({
//     first_name: "",
//     middle_name: "",
//     last_name: "",
//     date_of_birth: "",
//     contact: "",
//     email: "",
//     oldPassword: "",
//     password: "",
//     confirmPassword: "",
//   });

//   const [alertMessage, setAlertMessage] = useState("");
//   const [alertType, setAlertType] = useState("success");

//   const handleInputChange = (e) => {
//     const { name, value } = e.target;
//     setFormData({
//       ...formData,
//       [name]: value,
//     });
//   };

//   const validateForm = () => {
//     const {
//       first_name,
//       middle_name,
//       last_name,
//       date_of_birth,
//       contact,
//       email,
//       password,
//       confirmPassword,
//     } = formData;

//     if (
//       !first_name ||
//       !middle_name ||
//       !last_name ||
//       !date_of_birth ||
//       !contact ||
//       !email ||
//       !password ||
//       !confirmPassword
//     ) {
//       setAlertMessage("All fields are required.");
//       setAlertType("error");
//       return false;
//     }

//     if (password !== confirmPassword) {
//       setAlertMessage("Passwords do not match.");
//       setAlertType("error");
//       return false;
//     }

//     return true;
//   };

//   const handleSubmit = (e) => {
//     e.preventDefault();

//     if (validateForm()) {
//       axios
//         .post("http://127.0.0.1:8000/api/teacher", {
//           ...formData,
//           // Ensure the old password field matches the backend expectation
//           oldPassword: formData.oldPassword,
//         })
//         .then((response) => {
//           setAlertMessage("Profile updated successfully!");
//           setAlertType("success");

//           setFormData({
//             first_name: "",
//             middle_name: "",
//             last_name: "",
//             date_of_birth: "",
//             contact: "",
//             email: "",
//             oldPassword: "",
//             password: "",
//             confirmPassword: "",
//           });
//         })
//         .catch((error) => {
//           // Handle specific validation errors from Laravel
//           if (error.response && error.response.data.errors) {
//             const errors = error.response.data.errors;
//             const errorMessage = Object.values(errors)
//               .map((errorArr) => errorArr[0])
//               .join(", ");
//             setAlertMessage(errorMessage);
//           } else {
//             setAlertMessage("Failed to update profile. Please try again.");
//           }
//           setAlertType("error");
//         });
//     }
//   };

//   return (
//     <Box pt={{ base: "130px", md: "80px", xl: "80px" }}>
//       <Grid
//         templateColumns={{
//           base: "1fr",
//           lg: "1.34fr 1fr 1.62fr",
//         }}
//         templateRows={{
//           base: "repeat(3, 1fr)",
//           lg: "1fr",
//         }}
//         gap={{ base: "20px", xl: "20px" }}
//       >
//         {alertMessage && (
//           <Alert status={alertType} mb={4}>
//             <AlertIcon />
//             <AlertTitle>{alertType === "success" ? "Success" : "Error"}!</AlertTitle>
//             <AlertDescription>{alertMessage}</AlertDescription>
//           </Alert>
//         )}

//         <Box gridArea="1 / 1 / 2 / 4" p={5} borderWidth="1px" borderRadius="lg">
//           <form onSubmit={handleSubmit}>
//             <Grid templateColumns="repeat(3, 1fr)" gap={4}>
//               <FormControl isRequired>
//                 <FormLabel>First Name</FormLabel>
//                 <Input
//                   type="text"
//                   name="first_name"
//                   value={formData.first_name}
//                   onChange={handleInputChange}
//                 />
//               </FormControl>

//               <FormControl isRequired>
//                 <FormLabel>Middle Name</FormLabel>
//                 <Input
//                   type="text"
//                   name="middle_name"
//                   value={formData.middle_name}
//                   onChange={handleInputChange}
//                 />
//               </FormControl>

//               <FormControl isRequired>
//                 <FormLabel>Last Name</FormLabel>
//                 <Input
//                   type="text"
//                   name="last_name"
//                   value={formData.last_name}
//                   onChange={handleInputChange}
//                 />
//               </FormControl>

//               <FormControl isRequired>
//                 <FormLabel>Date of Birth</FormLabel>
//                 <Input
//                   type="date"
//                   name="date_of_birth"
//                   value={formData.date_of_birth}
//                   onChange={handleInputChange}
//                 />
//               </FormControl>

//               <FormControl isRequired>
//                 <FormLabel>Contact</FormLabel>
//                 <Input
//                   type="text"
//                   name="contact"
//                   value={formData.contact}
//                   onChange={handleInputChange}
//                 />
//               </FormControl>

//               <FormControl isRequired>
//                 <FormLabel>Email</FormLabel>
//                 <Input
//                   type="email"
//                   name="email"
//                   value={formData.email}
//                   onChange={handleInputChange}
//                 />
//               </FormControl>

//               <FormControl isRequired>
//                 <FormLabel>Old Password</FormLabel>
//                 <Input
//                   type="password"
//                   name="oldPassword"
//                   value={formData.oldPassword}
//                   onChange={handleInputChange}
//                 />
//               </FormControl>

//               <FormControl isRequired>
//                 <FormLabel>New Password</FormLabel>
//                 <Input
//                   type="password"
//                   name="password"
//                   value={formData.password}
//                   onChange={handleInputChange}
//                 />
//               </FormControl>

//               <FormControl isRequired>
//                 <FormLabel>Confirm Password</FormLabel>
//                 <Input
//                   type="password"
//                   name="confirmPassword"
//                   value={formData.confirmPassword}
//                   onChange={handleInputChange}
//                 />
//               </FormControl>
//             </Grid>

//             <Button mt={4} colorScheme="blue" type="submit" w="full">
//               Update Profile
//             </Button>
//           </form>
//         </Box>
//       </Grid>
//     </Box>
//   );
// };

// export default ProfileForm;
