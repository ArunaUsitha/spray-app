import { defineStore } from 'pinia'
import axiosClient from "../axios.js";

export const useUserStore = defineStore('user', {
    state: () => ({
        user: null
    }),
    actions: {
        fetchUser()  {
            return axiosClient.get('/api/user')
                .then( ({data}) => {
                    console.log(data)
                    this.user = data
                })
                .catch(error => {
                    console.log(error)
                })


        },

    },

})

export default useUserStore