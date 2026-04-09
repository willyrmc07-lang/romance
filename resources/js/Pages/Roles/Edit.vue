<template>
  <Head title="Edit Role" />

  <AuthenticatedLayout>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <h2 class="text-lg font-medium text-gray-900 mb-4">Edit Role: {{ role.display_name }}</h2>

          <form @submit.prevent="submit">
            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700">Nama Role (System)</label>
              <input 
                v-model="form.name" 
                type="text" 
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
              />
              <div v-if="form.errors.name" class="text-red-500 text-xs mt-1">{{ form.errors.name }}</div>
            </div>

            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700">Display Name</label>
              <input 
                v-model="form.display_name" 
                type="text" 
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
              />
              <div v-if="form.errors.display_name" class="text-red-500 text-xs mt-1">{{ form.errors.display_name }}</div>
            </div>

            <div class="flex items-center justify-between">
              <div class="flex items-center gap-4">
                <button 
                  type="submit" 
                  :disabled="form.processing"
                  class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
                >
                  Update
                </button>
                <Link :href="route('roles.index')" class="text-sm text-gray-600 underline">Kembali</Link>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

const props = defineProps({
    role: Object,
});

const form = useForm({
    name: props.role.name,
    display_name: props.role.display_name,
});

const submit = () => {
    form.put(route('roles.update', props.role.id));
};
</script>