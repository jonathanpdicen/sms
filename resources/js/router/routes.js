import Routes from '@/constants/routes'
import {
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
    ViewEvent,
} from "@/pages";

export default [
    {
        path: '/login',
        name: Routes.login,
        component: Login,
        meta: {
            guest: true
        }
    },
    {
        path: '/register',
        name: Routes.register,
        component: Register,
        meta: {
            guest: true
        }
    },
    {
        path: '/dashboard',
        name: Routes.dashboard,
        component: Dashboard,
        meta: {
            auth: true
        }
    },
    {
        path: '/user',
        name: Routes.user,
        component: Users,
        meta: {
            auth: true
        }
    },
    {
        path: '/create-user',
        name: Routes.create_user,
        component: CreateUser,
        meta: {
            auth: true
        }
    },
    {
        path: '/user/:id/edit',
        name: Routes.edit_user,
        component: EditUser,
        meta: {
            auth: true
        }
    },
    {
        path: '/user/:id',
        name: Routes.view_user,
        component: ViewUser,
        meta: {
            auth: true
        }
    },
    {
        path: '/course',
        name: Routes.course,
        component: Courses,
        meta: {
            auth: true
        }
    },
    {
        path: '/create-course',
        name: Routes.create_course,
        component: CreateCourse,
        meta: {
            auth: true
        }
    },
    {
        path: '/course/:id/edit',
        name: Routes.edit_course,
        component: EditCourse,
        meta: {
            auth: true
        }
    },
    {
        path: '/course/:id',
        name: Routes.view_course,
        component: ViewCourse,
        meta: {
            auth: true
        }
    },
    {
        path: '/event',
        name: Routes.event,
        component: Events,
        meta: {
            auth: true
        }
    },
    {
        path: '/create-event',
        name: Routes.create_event,
        component: CreateEvent,
        meta: {
            auth: true
        }
    },
    {
        path: '/event/:id/edit',
        name: Routes.edit_event,
        component: EditEvent,
        meta: {
            auth: true
        }
    },
    {
        path: '/event/:id',
        name: Routes.view_event,
        component: ViewEvent,
        meta: {
            auth: true
        }
    }
]