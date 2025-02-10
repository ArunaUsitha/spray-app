<script setup>
import {computed, onMounted} from "vue";
import useMachineStore from "../../store/machine.js";
import router from "../../router.js";
import axiosClient from "../../axios.js";

const machineStore = useMachineStore();
const machines = computed(() => machineStore.machines);

const resetMachine = (machine) => {
  console.log("Reset machine:", machine);
};

const deleteMachine = (machine) => {
  axiosClient.delete(`/api/machine/${machine.id}`)
      .then(response => {
        machineStore.fetchMachines();
      }).catch(error => {
    console.error('Error deleting machine:', error);
  });
};

const addMachine = () => {
  router.push({name: 'Dashboard'})
}

const editMachine = (machine) => {
  router.push({ name: 'Machine', params: { id: machine.id } });
}

onMounted(async () => {
  try {
    await machineStore.fetchMachines();
  } catch (error) {
    console.error("Error loading machines:", error);
  }


});
</script>

<template>
  <div class="bg-white shadow-sm rounded-lg p-6">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-6">
      <div>
        <h2 class="text-lg font-semibold text-gray-900">Machines</h2>
        <p class="text-sm text-gray-500">
          A list of all machines available
        </p>
      </div>
      <button
          @click="addMachine"
          class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium py-2 px-4 rounded-lg cursor-pointer"
      >
        Add Machine
      </button>
    </div>

    <!-- Table -->
    <div class="overflow-hidden border border-gray-200 rounded-lg">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Reset Count</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
          <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        <tr v-for="(machine, index) in machines" :key="index">
          <td class="px-6 py-4 text-sm text-gray-900">{{ machine.name }}</td>
          <td class="px-6 py-4 text-sm text-gray-500">{{ machine.purchase_date }}</td>
          <td class="px-6 py-4 text-sm text-gray-500">{{ 0 }}</td>
          <td class="px-6 py-4 text-sm text-gray-500">{{ machine.purchase_price }}</td>
          <td class="px-6 py-4 text-right space-x-2">
            <button @click="resetMachine(machine)" class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-medium py-1 px-2 rounded-lg cursor-pointer">Reset</button>
            <button @click="editMachine(machine)" class="bg-yellow-600 hover:text-yellow-900 text-white text-xs font-medium py-1 px-2 rounded-lg cursor-pointer">Edit</button>
            <button @click="deleteMachine(machine)" class="bg-red-500 hover:text-red-900 text-white text-xs font-medium py-1 px-2 rounded-lg cursor-pointer">Delete</button>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>





<style scoped>

</style>