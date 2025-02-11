import { defineStore } from 'pinia'
import axiosClient from "../axios.js";
import router from "../router.js";

export const useUserStore = defineStore('user', {
    state: () => ({
        user: null,
        isAuthenticated: false
    }),
    actions: {
        async fetchUser() {
            try {
                const response = await axiosClient.get('/api/user') // Laravel Breeze route
                this.user = response.data
                this.isAuthenticated = true
            } catch (error) {
                this.user = null
                this.isAuthenticated = false
            }
        },
        logout() {
            return axiosClient.post('/logout').then(() => {
                this.user = null
                this.isAuthenticated = false
                return  router.push({name:'Login'})
            })
        }
    },
    persist: true
})

export default useUserStore