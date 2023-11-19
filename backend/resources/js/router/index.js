import { createWebHistory, createRouter } from 'vue-router'
import store from '@/store'


/* Guest Component */
const Login = () => import('@/components/Login.vue')
const Register = () => import('@/components/Register.vue')
const Payment = () => import('@/components/Payment.vue');
const Profile = () => import('@/components/Profile.vue');
const Exchange = () => import('@/components/Exchange.vue');
const Default = () => import('@/components/layouts/Default.vue');
const PaymentRegistered = () => import('@/components/PaymentRegistered.vue');
/* Guest Component */

/* Layouts */
const DahboardLayout = () => import('@/components/layouts/Default.vue')
/* Layouts */

/* Authenticated Component */
const Dashboard = () => import('@/components/Dashboard.vue')
/* Authenticated Component */


const routes = [
    {
        name: "payment",
        path: "/",
        component: Default,
        children: [
            {
                path: "/",
                name: "main",
                component: Payment,
            },
            {
                path: "exchange",
                name: "exchange",
                component: Exchange,
            },
            {
                path: "register",
                name: "register",
                component: Register,
            },
            {
                path: "login",
                name: "login",
                component: Login,
            },
            {
                path: "profile",
                name: "profile",
                component: Profile,
            }
        ],
        meta: {
            title: `Payment`
        }
    }
]

const router = createRouter({
    history: createWebHistory(),
    mode: "history",
    routes, // short for `routes: routes`
})


export default router