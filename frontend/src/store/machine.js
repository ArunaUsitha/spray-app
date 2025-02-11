import { defineStore } from 'pinia'
import axiosClient from "../axios.js";

export const useMachineStore = defineStore('machine', {
    state: () => ({
        machines: null
    }),
    actions: {
        fetchMachines()  {
            return axiosClient.get('/api/machine')
                .then( ({data}) => {
                    this.machines = data
                })
                .catch(error => {
                    console.log(error)
                })
        },
    },

})

export default useMachineStore