import {createRouter, createWebHistory} from "vue-router";
import DefaultLayout from "./components/DefaultLayout.vue";
import Home from "./pages/Home.vue";
import Login from "./pages/Login.vue";
import Signup from "./pages/Signup.vue";
import List from "./pages/Machines/List.vue";
import NotFound from "./pages/NotFound.vue";
import Operation from "./pages/Machines/Operation.vue";

const routes = [
    {
        path: '/',
        component: DefaultLayout,
        children: [
            {path: '/', name: 'Home', component: Home},
            {path: '/machines', name: 'List', component: List},
            {path: '/machine/operation', name: 'Operation', component: Operation}
        ]
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