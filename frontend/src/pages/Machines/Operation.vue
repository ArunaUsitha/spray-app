<script setup>

import VueDatePicker from "@vuepic/vue-datepicker";
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
              <VueDatePicker  :global="false" :enable-time-picker="false"></VueDatePicker>
            </div>

            <div>
              <label for="hours" class="block text-sm font-medium text-gray-900">Hours</label>
              <input type="number"
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
      <div class="overflow-hidden border border-gray-200 rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Hours</th>
          </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="(machine, index) in machines" :key="index">
            <td class="px-6 py-4 text-sm text-gray-900">{{  }}</td>
            <td class="px-6 py-4 text-sm text-gray-500">{{ }}</td>
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