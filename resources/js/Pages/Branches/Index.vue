<template>
  <Head title="Manajemen Cabang" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pengaturan Cabang (Branches)</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          
          <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-medium text-gray-900">Daftar Cabang</h3>
            <Link
              :href="route('branches.create')"
              class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition"
            >
              + Tambah Cabang
            </Link>
          </div>

          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 border">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Cabang</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah User</th>
                  <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="branch in branches" :key="branch.id" class="hover:bg-gray-50 transition">
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ branch.id }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 uppercase">
                      {{ branch.code }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ branch.name }}</td>
                  
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                    {{ branch.users_count ?? 0 }} User
                  </td>

                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <Link :href="route('branches.edit', branch.id)" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</Link>
                    <button 
                      @click="confirmDelete(branch.id)" 
                      class="text-red-600 hover:text-red-900"
                    >
                      Hapus
                    </button>
                  </td>
                </tr>
                <tr v-if="branches.length === 0">
                  <td colspan="5" class="px-6 py-10 text-center text-gray-500">Belum ada data cabang.</td>
                </tr>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    branches: Array,
});

const form = useForm({});

const confirmDelete = (id) => {
    if (confirm('Apakah Anda yakin ingin menghapus cabang ini?')) {
        form.delete(route('branches.destroy', id));
    }
};
</script>