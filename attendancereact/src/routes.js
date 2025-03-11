import React from 'react';

import { Icon } from '@chakra-ui/react';
import {
  MdBarChart,
  MdPerson,
  MdHome,
  MdLock,
  MdOutlineShoppingCart,
  MdNote,
  MdBook,
  MdRadioButtonChecked,
  MdCheckBox,
  MdSignLanguage,
  MdWork,
  MdEdit,
  MdEditDocument,
  MdEditNote,
} from 'react-icons/md';

// Admin Imports
import Dashboard from 'views/admin/dashboard';
import Lecture_Information from 'views/admin/lecture_info';
import Profile from 'views/admin/profile';

// import Manage_Assignment from 'views/admin/manage_assign';
// import Evaluate_Assign from 'views/admin/evaluate_assign';
// import Manage_Questions from 'views/admin/manage_questions';
// import Manage_Exam from 'views/admin/manage_exam';

// Auth Imports
import SignInCentered from 'views/auth/signIn';

const routes = [
  {
    name: 'Dashboard',
    layout: '/admin',
    path: '/dashboard',
    icon: <Icon as={MdHome} width="20px" height="20px" color="inherit" />,
    component: <Dashboard />,
  },
  {
    name: 'Lecture Information',
    layout: '/admin',
    path: '/lecture_information',
    icon: (
      <Icon
        as={MdNote}
        width="20px"
        height="20px"
        color="inherit"
      />
    ),
    component: <Lecture_Information />,
    secondary: true,
  },
  // {
  //   name: 'Profile',
  //   layout: '/admin',
  //   path: '/profile',
  //   icon: <Icon as={MdPerson} width="20px" height="20px" color="inherit" />,
  //   component: <Profile />,
  // },
  // {
  //   // name: 'Sign In',
  //   layout: '/auth',
  //   path: '/sign-in',
  //   // icon: <Icon as={MdLock} width="20px" height="20px" color="inherit" />,
  //   component: <SignInCentered />,
  // },
  // {
  //   name: 'Manage Assignment',
  //   layout: '/admin',
  //   icon: <Icon as={MdBook} width="20px" height="20px" color="inherit" />,
  //   path: '/manage_assignment',
  //   component: <Manage_Assignment />,
  // },
  // {
  //   name: 'Evaluate Assignment',
  //   layout: '/admin',
  //   icon: <Icon as={MdCheckBox} width="20px" height="20px" color="inherit" />,
  //   path: '/evaluate_assign',
  //   component: <Evaluate_Assign />,
  // },
  // {
  //   name: 'Manage Question',
  //   layout: '/admin',
  //   path: '/manage_questions',
  //   icon: <Icon as={MdEdit} width="20px" height="20px" color="inherit" />,
  //   component: <Manage_Questions />,
  // },
  // {
  //   name: 'Manage Exam',
  //   layout: '/admin',
  //   path: '/manage_exam',
  //   icon: <Icon as={MdEditNote} width="20px" height="20px" color="inherit" />,
  //   component: <Manage_Exam />,
  // },
];

export default routes;
