// /* eslint-disable */
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

// import React from "react";
// import { NavLink } from "react-router-dom";
// // Chakra imports
// import {
//   Box,
//   Button,
//   Checkbox,
//   Flex,
//   FormControl,
//   FormLabel,
//   Heading,
//   Icon,
//   Input,
//   InputGroup,
//   InputRightElement,
//   Text,
//   useColorModeValue,
// } from "@chakra-ui/react";
// // Custom components
// import { HSeparator } from "components/separator/Separator";
// import DefaultAuth from "layouts/auth/Default";
// // Assets
// import illustration from "assets/img/auth/auth.png";
// import { FcGoogle } from "react-icons/fc";
// import { MdOutlineRemoveRedEye } from "react-icons/md";
// import { RiEyeCloseLine } from "react-icons/ri";

// function SignIn() {
//   // Chakra color mode
//   const textColor = useColorModeValue("navy.700", "white");
//   const textColorSecondary = "gray.400";
//   const textColorDetails = useColorModeValue("navy.700", "secondaryGray.600");
//   const textColorBrand = useColorModeValue("brand.500", "white");
//   const brandStars = useColorModeValue("brand.500", "brand.400");
//   const googleBg = useColorModeValue("secondaryGray.300", "whiteAlpha.200");
//   const googleText = useColorModeValue("navy.700", "white");
//   const googleHover = useColorModeValue(
//     { bg: "gray.200" },
//     { bg: "whiteAlpha.300" }
//   );
//   const googleActive = useColorModeValue(
//     { bg: "secondaryGray.300" },
//     { bg: "whiteAlpha.200" }
//   );
//   const [show, setShow] = React.useState(false);
//   const handleClick = () => setShow(!show);
//   return (
//     <DefaultAuth illustrationBackground={illustration} image={illustration}>
//       <Flex
//         maxW={{ base: "100%", md: "max-content" }}
//         w='100%'
//         mx={{ base: "auto", lg: "0px" }}
//         me='auto'
//         h='100%'
//         alignItems='start'
//         justifyContent='center'
//         mb={{ base: "30px", md: "60px" }}
//         px={{ base: "25px", md: "0px" }}
//         mt={{ base: "40px", md: "14vh" }}
//         flexDirection='column'>
//         <Box me='auto'>
//           <Heading color={textColor} fontSize='36px' mb='10px'>
//             Sign In
//           </Heading>
//           <Text
//             mb='36px'
//             ms='4px'
//             color={textColorSecondary}
//             fontWeight='400'
//             fontSize='md'>
//             Enter your email and password to sign in!
//           </Text>
//         </Box>
//         <Flex
//           zIndex='2'
//           direction='column'
//           w={{ base: "100%", md: "420px" }}
//           maxW='100%'
//           background='transparent'
//           borderRadius='15px'
//           mx={{ base: "auto", lg: "unset" }}
//           me='auto'
//           mb={{ base: "20px", md: "auto" }}>
//           <Button
//             fontSize='sm'
//             me='0px'
//             mb='26px'
//             py='15px'
//             h='50px'
//             borderRadius='16px'
//             bg={googleBg}
//             color={googleText}
//             fontWeight='500'
//             _hover={googleHover}
//             _active={googleActive}
//             _focus={googleActive}>
//             <Icon as={FcGoogle} w='20px' h='20px' me='10px' />
//             Sign in with Google
//           </Button>
//           <Flex align='center' mb='25px'>
//             <HSeparator />
//             <Text color='gray.400' mx='14px'>
//               or
//             </Text>
//             <HSeparator />
//           </Flex>
//           <FormControl>
//             <FormLabel
//               display='flex'
//               ms='4px'
//               fontSize='sm'
//               fontWeight='500'
//               color={textColor}
//               mb='8px'>
//               Email<Text color={brandStars}>*</Text>
//             </FormLabel>
//             <Input
//               isRequired={true}
//               variant='auth'
//               fontSize='sm'
//               ms={{ base: "0px", md: "0px" }}
//               type='email'
//               placeholder='mail@simmmple.com'
//               mb='24px'
//               fontWeight='500'
//               size='lg'
//             />
//             <FormLabel
//               ms='4px'
//               fontSize='sm'
//               fontWeight='500'
//               color={textColor}
//               display='flex'>
//               Password<Text color={brandStars}>*</Text>
//             </FormLabel>
//             <InputGroup size='md'>
//               <Input
//                 isRequired={true}
//                 fontSize='sm'
//                 placeholder='Min. 8 characters'
//                 mb='24px'
//                 size='lg'
//                 type={show ? "text" : "password"}
//                 variant='auth'
//               />
//               <InputRightElement display='flex' alignItems='center' mt='4px'>
//                 <Icon
//                   color={textColorSecondary}
//                   _hover={{ cursor: "pointer" }}
//                   as={show ? RiEyeCloseLine : MdOutlineRemoveRedEye}
//                   onClick={handleClick}
//                 />
//               </InputRightElement>
//             </InputGroup>
//             <Flex justifyContent='space-between' align='center' mb='24px'>
//               <FormControl display='flex' alignItems='center'>
//                 <Checkbox
//                   id='remember-login'
//                   colorScheme='brandScheme'
//                   me='10px'
//                 />
//                 <FormLabel
//                   htmlFor='remember-login'
//                   mb='0'
//                   fontWeight='normal'
//                   color={textColor}
//                   fontSize='sm'>
//                   Keep me logged in
//                 </FormLabel>
//               </FormControl>
//               <NavLink to='/auth/forgot-password'>
//                 <Text
//                   color={textColorBrand}
//                   fontSize='sm'
//                   w='124px'
//                   fontWeight='500'>
//                   Forgot password?
//                 </Text>
//               </NavLink>
//             </Flex>
//             <Button
//               fontSize='sm'
//               variant='brand'
//               fontWeight='500'
//               w='100%'
//               h='50'
//               mb='24px'>
//               Sign In
//             </Button>
//           </FormControl>
//           <Flex
//             flexDirection='column'
//             justifyContent='center'
//             alignItems='start'
//             maxW='100%'
//             mt='0px'>
//             <Text color={textColorDetails} fontWeight='400' fontSize='14px'>
//               Not registered yet?
//               <NavLink to='/auth/sign-up'>
//                 <Text
//                   color={textColorBrand}
//                   as='span'
//                   ms='5px'
//                   fontWeight='500'>
//                   Create an Account
//                 </Text>
//               </NavLink>
//             </Text>
//           </Flex>
//         </Flex>
//       </Flex>
//     </DefaultAuth>
//   );
// }

// export default SignIn;
import React, { useState } from 'react';
import {
  Box,
  Button,
  Checkbox,
  Flex,
  FormControl,
  FormLabel,
  Heading,
  Input,
  InputGroup,
  InputRightElement,
  Text,
  useColorModeValue,
  Icon,
} from '@chakra-ui/react';
import { FcGoogle } from 'react-icons/fc';
import { MdOutlineRemoveRedEye } from 'react-icons/md';
import { RiEyeCloseLine } from 'react-icons/ri';
import { NavLink } from 'react-router-dom';

function SignIn() {
  const [formData, setFormData] = useState({ email: '', password: '' });
  const [error, setError] = useState('');
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [showPassword, setShowPassword] = useState(false);

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError('');
    setIsSubmitting(true);

    try {
      const response = await fetch(
        `http://127.0.0.1:8000/api/users?email=${formData.email}&password=${formData.password}`,
        {
          method: 'GET',
          headers: {
            'Content-Type': 'application/json',
          },
        }
      );

      const data = await response.json();

      if (response.ok) {
        if (data.user.u_type === 0) {
          sessionStorage.setItem('userToken', data.token);
          sessionStorage.setItem('userId', data.user.id);
          sessionStorage.setItem('userName', data.user.name);
          sessionStorage.setItem('userEmail', data.user.email);
          sessionStorage.setItem('userDesig', data.designationName);
          sessionStorage.setItem('teacherId', data.teacherId);
          window.location.href = "http://localhost:3000/admin/dashboard";
        } else {
          setError('You are not authorized to access this area.');
        }
      } else {
        setError(data.message || 'Invalid email or password');
      }
    } catch (error) {
      setError('Something went wrong. Please try again later.');
    } finally {
      setIsSubmitting(false);
    }
  };

  const toggleShowPassword = () => {
    setShowPassword(!showPassword);
  };

  const textColor = useColorModeValue("navy.700", "white");
  const textColorSecondary = "gray.400";
  const textColorBrand = useColorModeValue("brand.500", "white");

  return (
    <Flex
      maxW="100%"
      w="100%"
      h="100%"
      alignItems="center"
      justifyContent="center"
      flexDirection="column"
      p="10px"
    >
      <Box textAlign="center" mb="36px">
        <Heading color={textColor} fontSize="36px" mb="10px">Sign In</Heading>
        <Text color={textColorSecondary} fontWeight="400" fontSize="md">
          Enter your email and password to sign in!
        </Text>
      </Box>
      <Flex
        direction="column"
        w={{ base: "100%", md: "420px" }}
        background="transparent"
        borderRadius="15px"
      >
        {error && (
          <Text color="red.500" mb="24px">
            {error}
          </Text>
        )}
        <FormControl>
          <FormLabel>Email</FormLabel>
          <Input
            name="email"
            type="email"
            placeholder="Enter your email"
            value={formData.email}
            onChange={handleChange}
            mb="24px"
          />
          <FormLabel>Password</FormLabel>
          <InputGroup>
            <Input
              name="password"
              type={showPassword ? "text" : "password"}
              placeholder="Enter your password"
              value={formData.password}
              onChange={handleChange}
              mb="24px"
            />
            <InputRightElement>
              <Icon
                onClick={toggleShowPassword}
                as={showPassword ? RiEyeCloseLine : MdOutlineRemoveRedEye}
              />
            </InputRightElement>
          </InputGroup>
          <Button
            w="100%"
            colorScheme="blue"
            onClick={handleSubmit}
            isLoading={isSubmitting}
          >
            {isSubmitting ? 'Logging in...' : 'Login'}
          </Button>
        </FormControl>
        {/* <Flex justifyContent="space-between" align="center" mt="24px">
          <Checkbox colorScheme="blue">Keep me logged in</Checkbox>
          <NavLink to="/auth/forgot-password">
            <Text color={textColorBrand}>Forgot password?</Text>
          </NavLink>
        </Flex> */}
      </Flex>
    </Flex>
  );
}

export default SignIn;

