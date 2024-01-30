const Login = require('@/components/auth/Login').default
const Register = require('@/components/auth/Register').default

const Dashboard = require('@/components/main/pages/Dashboard').default

const Users = require('@/components/main/user/List').default
const CreateUser = require('@/components/main/user/Create').default
const EditUser = require('@/components/main/user/Edit').default
const ViewUser = require('@/components/main/user/View').default

const Courses = require('@/components/main/course/List').default
const CreateCourse = require('@/components/main/course/Create').default
const EditCourse = require('@/components/main/course/Edit').default
const ViewCourse = require('@/components/main/course/View').default

const Events = require('@/components/main/event/List').default
const CreateEvent = require('@/components/main/event/Create').default
const EditEvent = require('@/components/main/event/Edit').default
const ViewEvent = require('@/components/main/event/View').default

export {
    Login,
    Register,
    Dashboard,
    Users,
    CreateUser,
    EditUser,
    ViewUser,
    Courses,
    CreateCourse,
    EditCourse,
    ViewCourse,
    Events,
    CreateEvent,
    EditEvent,
    ViewEvent
}