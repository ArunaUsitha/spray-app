import {createRouter, createWebHistory} from "vue-router";
import DefaultLayout from "./components/DefaultLayout.vue";
import Login from "./pages/Login.vue";
import Signup from "./pages/Signup.vue";
import List from "./pages/Machines/List.vue";
import NotFound from "./pages/NotFound.vue";
import Operation from "./pages/Machines/Operation.vue";
import {useUserStore} from "./store/user.js";
import Machine from "./pages/Machines/Machine.vue";

const routes = [
    {
        path: '/',
        component: DefaultLayout,
        children: [
            {path: '/', name: 'Dashboard', component: List},
            {path: '/machine', name: 'Machine', component: Machine},
            {path: '/machine/:id?', name: 'Machine', component: Machine, props: true},
            {path: '/machine/operation', name: 'MachineOperation', component: Operation},
        ],
        beforeEnter: async (to, from, next) => {
            try {
                // Fetch Users
                const userStore = useUserStore();
                await userStore.fetchUser()
                next()
            }catch (error) {
                next(false)
            }
        },
    },
    {
        path: '/login',
        name: 'Login',
        component: Login
    },
    {
        path: '/signup',
        name: 'Signup',
        component: Signup
    },
    { path: '/:pathMatch(.*)*', name: 'NotFound', component: NotFound },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router