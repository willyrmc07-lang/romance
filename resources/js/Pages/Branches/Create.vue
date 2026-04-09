<template>
  <Head title="Tambah Cabang" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Cabang Baru</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <h2 class="text-lg font-medium text-gray-900 mb-4">Informasi Cabang</h2>

          <form @submit.prevent="submit">
            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700">Kode Cabang</label>
              <input 
                v-model="form.code" 
                type="text" 
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 uppercase" 
                placeholder="Contoh: KPP"
              />
              <div v-if="form.errors.code" class="text-red-500 text-xs mt-1">{{ form.errors.code }}</div>
            </div>

            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700">Nama Cabang</label>
              <input 
                v-model="form.name" 
                type="text" 
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                placeholder="Contoh: Kantor Pusat Jakarta"
              />
              <div v-if="form.errors.name" class="text-red-500 text-xs mt-1">{{ form.errors.name }}</div>
            </div>

            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700">Alamat</label>
              <textarea 
                v-model="form.address" 
                rows="3"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                placeholder="Alamat lengkap cabang..."
              ></textarea>
              <div v-if="form.errors.address" class="text-red-500 text-xs mt-1">{{ form.errors.address }}</div>
            </div>

            <div class="flex items-center gap-4">
              <button 
                type="submit" 
                :disabled="form.processing"
                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 disabled:opacity-50"
              >
                Simpan
              </button>
              <Link :href="route('branches.index')" class="text-sm text-gray-600 underline">Batal</Link>
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

const form = useForm({
    code: '',
    name: '',
    address: '',
});

const submit = () => {
    form.post(route('branches.store'));
};
</script>