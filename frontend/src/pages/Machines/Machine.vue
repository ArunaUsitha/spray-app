<script setup>

import {onMounted, ref, watch} from "vue";
import axiosClient from "../../axios.js";
import {useRoute} from "vue-router";
import router from "../../router.js";
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

const route = useRoute()
const selectedBrand = ref('');
const selectedModel = ref('');
const availableModels = ref([]);

const data = ref({
  id: null,
  name: '',
  brand: '',
  model: '',
  purchase_date: '',
  purchase_price: '',
})

const sprayerBrands = {
  "Hayleys": {
    models: [
      "Hayspray 16L",
      "Agricultural Electric Knapsack Sprayer 16L – 2 in 1",
      "Hayspray 20L"
    ]
  },
  "Hunter": {
    models: [
      "Hunter Knapsack Sprayer Steel 16L",
      "Hunter Knapsack Sprayer Plastic 16L",
      "Hunter Knapsack Sprayer 20L"
    ]
  },
  "Sintek": {
    models: [
      "Sintek Power Sprayer 16L (SS-PS16-AG)",
      "Sintek Power Sprayer 20L",
      "Sintek Battery Operated Sprayer"
    ]
  },
  "Hi-Q-Tools": {
    models: [
      "KNAPSACK Power Sprayer 16L",
      "KNAPSACK Power Sprayer 20L",
      "KNAPSACK Battery Operated Sprayer"
    ]
  },
  "Gardena": {
    models: [
      "Gardena Backpack Sprayer 12L",
      "Gardena Backpack Sprayer 15L",
      "Gardena Backpack Sprayer 20L"
    ]
  },
  "Jacto": {
    models: [
      "Jacto 20L",
      "Jacto 16L",
      "Jacto 25L"
    ]
  },
  "Solo": {
    models: [
      "Solo 475",
      "Solo 456",
      "Solo 473"
    ]
  },
  "Stihl": {
    models: [
      "Stihl SR 430",
      "Stihl SR 200",
      "Stihl SR 450"
    ]
  },
  "Maruyama": {
    models: [
      "Maruyama MS-4000",
      "Maruyama MS-3500",
      "Maruyama MS-5000"
    ]
  },
  "Honda": {
    models: [
      "Honda HP-400",
      "Honda HP-200",
      "Honda HP-500"
    ]
  },
  "Masand Agritech": {
    models: [
      "Masand Agritech Knapsack Sprayer 16L",
      "Masand Agritech Battery Operated Knapsack Sprayer",
      "Masand Agritech Knapsack Sprayer 20L"
    ]
  },
  "KisanKraft": {
    models: [
      "KisanKraft KK-KPS-204B",
      "KisanKraft KK-KPS-204A",
      "KisanKraft KK-KPS-205"
    ]
  },
  "Balwaan": {
    models: [
      "Balwaan 35 CC Knapsack Sprayer",
      "Balwaan 25 CC Knapsack Sprayer",
      "Balwaan 20 CC Knapsack Sprayer"
    ]
  },
  "Foggers India": {
    models: [
      "Foggers India Mars T-02-000060 Sprayer",
      "Foggers India Mars T-02-000080 Sprayer",
      "Foggers India Mars T-02-000100 Sprayer"
    ]
  },
  "KOSHIN": {
    models: [
      "KOSHIN HS-401E Hand Pressure Manual Sprayer",
      "KOSHIN HS-402E Hand Pressure Manual Sprayer",
      "KOSHIN HS-403E Hand Pressure Manual Sprayer"
    ]
  }
};

const updateModels = () => {
  selectedModel.value = '';

  if (selectedBrand.value) {
    availableModels.value = sprayerBrands[selectedBrand.value].models;
    data.value.brand = selectedBrand.value;
  } else {
    availableModels.value = [];
    data.value.brand = '';
  }
};

// Format the date to YYYY-MM-DD
const formatDate = (date) => {
  const newDate = new Date(date);
  return newDate.toISOString().split('T')[0];
};

watch(selectedModel, (newValue) => {
  data.value.model = newValue;
});

onMounted(() => {
  const machineId = route.params.id;
  if (machineId) {
    axiosClient.get(`/api/machine/${machineId}`)
        .then(response => {
          const machine = response.data;
          data.value = {...machine};
          selectedBrand.value = machine.brand;
          updateModels();
          selectedModel.value = machine.model;
        }).catch(error => {
      console.error('Error fetching machine data:', error);
    });
  }
});

function submit() {
  data.value.purchase_date = formatDate(data.value.purchase_date);

  if (data.value.id) {
    axiosClient.put(`/api/machine/${data.value.id}`, data.value)
        .then(() => {
          router.push({name: 'Dashboard'})
        }).catch(error => {
      console.error('Error updating machine:', error);
    });

  } else {
    axiosClient.post('/api/machine', data.value)
        .then(() => {
          router.push({name: 'Dashboard'})
        }).catch(error => {
      console.error('Error adding machine:', error);
    });
  }
}
</script>

<template>
  <div class="flex min-h-screen items-center justify-center bg-gray-100">
    <div class="bg-white p-8 shadow-lg rounded-lg border w-full max-w-md">
      <h2 class="text-center text-2xl font-bold tracking-tight text-gray-900">
        {{ data.id ? 'Edit' : 'Add new' }} Machine
      </h2>

      <form @submit.prevent="submit" class="space-y-6 mt-6">
        <div>
          <label for="name" class="block text-sm font-medium text-gray-900">Name</label>
          <input type="text"
                 name="name"
                 id="name"
                 required
                 v-model="data.name"
                 class="block w-full rounded-md border-gray-300 px-3 py-2 text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"/>
        </div>

        <div>
          <label for="brand" class="block text-sm font-medium text-gray-900">Brand</label>
          <select v-model="selectedBrand" @change="updateModels" id="brand" name="brand"
                  class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <option value="" disabled selected>Select a brand</option>
            <option v-for="brand in Object.keys(sprayerBrands)" :key="brand" :value="brand">{{ brand }}</option>
          </select>
        </div>

        <div>
          <label for="model" class="block text-sm font-medium text-gray-900">Model</label>
          <select v-model="selectedModel" :disabled="!selectedBrand" id="model" name="model"
                  class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <option value="" disabled selected>Select a model</option>
            <option v-for="model in availableModels" :key="model" :value="model">{{ model }}</option>
          </select>
        </div>


        <div>
          <label for="date" class="block text-sm font-medium text-gray-900">Select Date</label>
          <VueDatePicker v-model="data.purchase_date" :global="false" :enable-time-picker="false"></VueDatePicker>
        </div>


        <div>
          <label for="purchasedPrice" class="block text-sm font-medium text-gray-900">Purchased Price</label>
          <input type="text"
                 name="purchasedPrice"
                 id="purchasedPrice"
                 required
                 v-model="data.purchase_price"
                 class="block w-full rounded-md border-gray-300 px-3 py-2 text-gray-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"/>
        </div>

        <button type="submit"
                :class="[
        'w-full rounded-md px-4 py-2 text-white font-semibold shadow-md focus:outline-none focus:ring-2',
        data.id ? 'bg-yellow-600 hover:bg-yellow-800 focus:ring-yellow-600' : 'bg-indigo-600 hover:bg-indigo-800 focus:ring-indigo-600']">
          {{ data.id ? 'Update' : 'Add' }} Machine
        </button>
      </form>

    </div>
  </div>

</template>

<style scoped>

</style>