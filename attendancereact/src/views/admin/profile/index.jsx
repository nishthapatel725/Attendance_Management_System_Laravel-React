// /*!
//   _   _  ___  ____  ___ ________  _   _   _   _ ___   
//  | | | |/ _ \|  _ \|_ _|__  / _ \| \ | | | | | |_ _| 
//  | |_| | | | | |_) || |  / / | | |  \| | | | | || | 
//  |  _  | |_| |  _ < | | / /| |_| | |\  | | |_| || |
//  |_| |_|\___/|_| \_\___/____\___/|_| \_|  \___/|___|
                                                                                                                                                                                                                                                                                                                                       
// =========================================================
// * Horizon UI - v1.1.0
// =========================================================

// * Product Page: https://www.horizon-ui.com/
// * Copyright 2023 Horizon UI (https://www.horizon-ui.com/)

// * Designed and Coded by Simmmple

// =========================================================

// * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

// */

// // Chakra imports
// import { Box, Grid } from "@chakra-ui/react";

// // Custom components
// import Banner from "views/admin/profile/components/Banner";
// import General from "views/admin/profile/components/General";
// import Notifications from "views/admin/profile/components/Notifications";
// import Projects from "views/admin/profile/components/Projects";
// import Storage from "views/admin/profile/components/Storage";
// import Upload from "views/admin/profile/components/Upload";

// // Assets
// import banner from "assets/img/auth/banner.png";
// import avatar from "assets/img/avatars/avatar4.png";
// import React from "react";

// export default function Overview() {
//   return (
//     <Box pt={{ base: "130px", md: "80px", xl: "80px" }}>
//       {/* Main Fields */}
//       <Grid
//         templateColumns={{
//           base: "1fr",
//           lg: "1.34fr 1fr 1.62fr",
//         }}
//         templateRows={{
//           base: "repeat(3, 1fr)",
//           lg: "1fr",
//         }}
//         gap={{ base: "20px", xl: "20px" }}>
//         <Banner
//           gridArea='1 / 1 / 2 / 2'
//           banner={banner}
//           avatar={avatar}
//           name='Adela Parkson'
//           job='Product Designer'
//           posts='17'
//           followers='9.7k'
//           following='274'
//         />
//         <Storage
//           gridArea={{ base: "2 / 1 / 3 / 2", lg: "1 / 2 / 2 / 3" }}
//           used={25.6}
//           total={50}
//         />
//         <Upload
//           gridArea={{
//             base: "3 / 1 / 4 / 2",
//             lg: "1 / 3 / 2 / 4",
//           }}
//           minH={{ base: "auto", lg: "420px", "2xl": "365px" }}
//           pe='20px'
//           pb={{ base: "100px", lg: "20px" }}
//         />
//       </Grid>
//       <Grid
//         mb='20px'
//         templateColumns={{
//           base: "1fr",
//           lg: "repeat(2, 1fr)",
//           "2xl": "1.34fr 1.62fr 1fr",
//         }}
//         templateRows={{
//           base: "1fr",
//           lg: "repeat(2, 1fr)",
//           "2xl": "1fr",
//         }}
//         gap={{ base: "20px", xl: "20px" }}>
//         <Projects
//           gridArea='1 / 2 / 2 / 2'
//           banner={banner}
//           avatar={avatar}
//           name='Adela Parkson'
//           job='Product Designer'
//           posts='17'
//           followers='9.7k'
//           following='274'
//         />
//         <General
//           gridArea={{ base: "2 / 1 / 3 / 2", lg: "1 / 2 / 2 / 3" }}
//           minH='365px'
//           pe='20px'
//         />
//         <Notifications
//           used={25.6}
//           total={50}
//           gridArea={{
//             base: "3 / 1 / 4 / 2",
//             lg: "2 / 1 / 3 / 3",
//             "2xl": "1 / 3 / 2 / 4",
//           }}
//         />
//       </Grid>
//     </Box>
//   );
// }
import React, { useState, useEffect } from "react";
import {
  Box,
  Grid,
  Input,
  Button,
  FormControl,
  FormLabel,
  Alert,
  AlertIcon,
  AlertTitle,
  AlertDescription,
  Heading,
} from "@chakra-ui/react";
import axios from "axios";

const ProfileForm = () => {
  const [formData, setFormData] = useState({
    first_name: "",
    middle_name: "",
    last_name: "",
    date_of_birth: "",
    contact: "",
    email: "",
    oldPassword: "",
    password: "",
    confirmPassword: "",
  });

  const [alertMessage, setAlertMessage] = useState("");
  const [alertType, setAlertType] = useState("success");

  // Get user email from session storage
  const t_email = sessionStorage.getItem('userEmail');

  // Fetch user data when component mounts
  useEffect(() => {
    axios
      .get(`http://127.0.0.1:8000/api/teachers/${t_email}`)
      .then((response) => {
        const userData = response.data;
        setFormData({
          first_name: userData.first_name || "",
          middle_name: userData.middle_name || "",
          last_name: userData.last_name || "",
          date_of_birth: userData.date_of_birth || "",
          contact: userData.contact || "",
          email: userData.email || "",
          oldPassword: "", // old password and new password will be empty initially
          password: "",
          confirmPassword: "",
        });
      })
      .catch((error) => {
        setAlertMessage("Failed to load user data.");
        setAlertType("error");
      });
  }, [t_email]);

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setFormData({
      ...formData,
      [name]: value,
    });
  };

  const validateForm = () => {
    const {
      first_name,
      middle_name,
      last_name,
      date_of_birth,
      contact,
      email,
      password,
      confirmPassword,
    } = formData;

    if (
      !first_name ||
      !middle_name ||
      !last_name ||
      !date_of_birth ||
      !contact ||
      !email ||
      !password ||
      !confirmPassword
    ) {
      setAlertMessage("All fields are required.");
      setAlertType("error");
      return false;
    }

    if (password !== confirmPassword) {
      setAlertMessage("Passwords do not match.");
      setAlertType("error");
      return false;
    }

    return true;
  };

  const handleSubmit = (e) => {
    e.preventDefault();

    if (validateForm()) {
      axios
        .put(`http://127.0.0.1:8000/api/teachers/update/${t_email}`, {
          ...formData,
          password: formData.oldPassword, // Send old password for verification
        })
        .then((response) => {
          setAlertMessage("Profile updated successfully!");
          setAlertType("success");

          // Reset form data after successful update
          setFormData({
            first_name: "",
            middle_name: "",
            last_name: "",
            date_of_birth: "",
            contact: "",
            email: "",
            oldPassword: "",
            password: "",
            confirmPassword: "",
          });
        })
        .catch((error) => {
          // Error handling based on the backend response
          if (error.response && error.response.data.errors) {
            const errors = error.response.data.errors;
            const errorMessage = Object.values(errors)
              .map((errorArr) => errorArr[0])
              .join(", ");
            setAlertMessage(errorMessage);
          } else {
            setAlertMessage("Failed to update profile. Please try again.");
          }
          setAlertType("error");
        });
    }
  };

  return (
    <Box pt={{ base: "130px", md: "80px", xl: "80px" }}>
      <Grid
        templateColumns={{
          base: "1fr",
          lg: "1.34fr 1fr 1.62fr",
        }}
        templateRows={{
          base: "repeat(3, 1fr)",
          lg: "1fr",
        }}
        gap={{ base: "20px", xl: "20px" }}
      >
        {alertMessage && (
          <Alert status={alertType} mb={4}>
            <AlertIcon />
            <AlertTitle>{alertType === "success" ? "Success" : "Error"}!</AlertTitle>
            <AlertDescription>{alertMessage}</AlertDescription>
          </Alert>
        )}

        <Box gridArea="1 / 1 / 2 / 4" p={5} borderWidth="1px" borderRadius="lg">
          <Heading 
            size="lg" 
            textAlign="center" 
            mb={6} 
            color="#3965ff" 
            fontWeight="bold"  
            fontFamily="'Poppins', sans-serif" 
            textTransform="uppercase"
            letterSpacing="wider"
          >
            Profile Page
          </Heading>
          <form onSubmit={handleSubmit}>
            <Grid templateColumns="repeat(3, 1fr)" gap={4}>
              <FormControl isRequired>
                <FormLabel>First Name</FormLabel>
                <Input
                  type="text"
                  name="first_name"
                  value={formData.first_name}
                  onChange={handleInputChange}
                />
              </FormControl>

              <FormControl isRequired>
                <FormLabel>Middle Name</FormLabel>
                <Input
                  type="text"
                  name="middle_name"
                  value={formData.middle_name}
                  onChange={handleInputChange}
                />
              </FormControl>

              <FormControl isRequired>
                <FormLabel>Last Name</FormLabel>
                <Input
                  type="text"
                  name="last_name"
                  value={formData.last_name}
                  onChange={handleInputChange}
                />
              </FormControl>

              <FormControl isRequired>
                <FormLabel>Date of Birth</FormLabel>
                <Input
                  type="date"
                  name="date_of_birth"
                  value={formData.date_of_birth}
                  onChange={handleInputChange}
                />
              </FormControl>

              <FormControl isRequired>
                <FormLabel>Contact</FormLabel>
                <Input
                  type="text"
                  name="contact"
                  value={formData.contact}
                  onChange={handleInputChange}
                />
              </FormControl>

              <FormControl isRequired>
                <FormLabel>Email</FormLabel>
                <Input
                  type="email"
                  name="email"
                  value={formData.email}
                  onChange={handleInputChange}
                />
              </FormControl>

              <FormControl isRequired>
                <FormLabel>Old Password</FormLabel>
                <Input
                  type="password"
                  name="oldPassword"
                  value={formData.oldPassword}
                  onChange={handleInputChange}
                />
              </FormControl>

              <FormControl isRequired>
                <FormLabel>New Password</FormLabel>
                <Input
                  type="password"
                  name="password"
                  value={formData.password}
                  onChange={handleInputChange}
                />
              </FormControl>

              <FormControl isRequired>
                <FormLabel>Confirm Password</FormLabel>
                <Input
                  type="password"
                  name="confirmPassword"
                  value={formData.confirmPassword}
                  onChange={handleInputChange}
                />
              </FormControl>
            </Grid>

            <Button mt={4} colorScheme="blue" type="submit" w="full">
              Update Profile
            </Button>
          </form>
        </Box>
      </Grid>
    </Box>
  );
};

export default ProfileForm;
