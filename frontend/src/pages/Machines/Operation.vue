<script setup>

import VueDatePicker from "@vuepic/vue-datepicker";
import {onMounted, ref, watch} from "vue";
import axiosClient from "../../axios.js";
import {useRoute} from "vue-router";
import router from "../../router.js";
import useUserStore from "../../store/user.js";

const userStore = useUserStore();
let operationHours = 0;

const route = useRoute()
const data = ref({
  machine_id: '',
  user_id: '',
  operation_date: new Date(),
  operation_hours: 0
})

const operations = ref({
  operation_hours: 0,
  operation_date: ''
})

onMounted(() => {
  const machineId = route.params.id;
  data.value.machine_id = machineId
  data.value.user_id = userStore.user.id

  fetchOperations(machineId)

});

const fetchOperations = (machineId) => {
  if (machineId) {
    axiosClient.get(`/api/machine/operations/${machineId}`)
        .then(response => {
          const machine = response.data;
          data.value.operation_hours = machine.total_operation_hours
          operationHours = machine.total_operation_hours

          operations.value = {...machine.operations};
        }).catch(error => {
      console.error('Error fetching machine data:', error);
    });
  }
}

function submit() {
  axiosClient.post('/api/machine/operation', data.value)
      .then(() => {
        fetchOperations(data.value.machine_id)
      })
}

const resetCount = () => {
  axiosClient.post('/api/machine/operations/reset', {
    user_id: data.value.user_id,
    machine_id: data.value.machine_id
  })
      .then(() => {
        fetchOperations(data.value.machine_id)
      })
}

watch(() => data.value.operation_hours, (newVal, oldVal) => {
  if (newVal < oldVal) {
    data.value.operation_hours = oldVal; // Revert to previous value
  }
});
</script>

<template>
  <!--  Add machine hours-->

  <div class="flex flex-row h-screen">
    <!-- Left Section -->
    <div class="w-1/3 p-4">
      <div class="bg-white p-8 shadow-lg rounded-lg w-full max-w-md">
        <h2 class="text-center text-2xl font-bold tracking-tight text-gray-900">
          Add Hours
        </h2>

        <form @submit.prevent="submit" class="space-y-6 mt-6">
          <div>
            <label for="date" class="block text-sm font-medium text-gray-900">Select Date</label>
            <VueDatePicker v-model="data.operation_date" :global="false"></VueDatePicker>
          </div>

          <div>
            <label for="hours" class="block text-sm font-medium text-gray-900">Hours</label>
            <input v-model="data.operation_hours" type="number"
                   name="hours"
                   id="hours"
                   required
                   class="block w-full rounded-md border-gray-300 px-3 py-2 text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"/>
          </div>

          <button type="submit"
                  class="w-full rounded-md bg-green-600 px-4 py-2 text-white font-semibold shadow-md hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-600">
            Add
          </button>

        </form>

      </div>
    </div>

    <!-- Right Section -->
    <div class="w-2/3 p-4">
      <div class="flex justify-between items-center mb-6">
        <div>
        </div>
        <button v-if="operationHours > 0"
            @click="resetCount"
            class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium py-2 px-4 rounded-lg cursor-pointer"
        >
          Reset Count
        </button>
      </div>
      <div class="overflow-hidden border border-gray-200 rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Hours</th>
          </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="(operation, index) in operations" :key="index">
            <td class="px-6 py-4 text-sm text-gray-900">{{ operation.operation_date }} </td>
            <td class="px-6 py-4 text-sm text-gray-500">
              <span>{{ operation.operation_hours }}</span>
              <span v-if="operation.operation_hours == 0" class="inline-flex rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-red-600/10 ring-inset float-right">Reset</span>
              </td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!-- END Add machine hours-->

</template>

<style scoped>

</style>