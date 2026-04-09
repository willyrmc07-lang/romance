<template>
  <Head title="Tambah User" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah User Baru</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          <form @submit.prevent="form.post(route('users.store'))">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input v-model="form.name" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                <div v-if="form.errors.name" class="text-red-500 text-xs mt-1">{{ form.errors.name }}</div>
              </div>

              <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input v-model="form.email" type="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                <div v-if="form.errors.email" class="text-red-500 text-xs mt-1">{{ form.errors.email }}</div>
              </div>

              <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Role</label>
                <select v-model="form.role_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                  <option value="">Pilih Role</option>
                  <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.display_name }}</option>
                </select>
                <div v-if="form.errors.role_id" class="text-red-500 text-xs mt-1">{{ form.errors.role_id }}</div>
              </div>

              <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Cabang</label>
                <select v-model="form.branch_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                  <option value="">Pilih Cabang</option>
                  <option v-for="branch in branches" :key="branch.id" :value="branch.id">{{ branch.code }} - {{ branch.name }}</option>
                </select>
                <div v-if="form.errors.branch_id" class="text-red-500 text-xs mt-1">{{ form.errors.branch_id }}</div>
              </div>

              <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input v-model="form.password" type="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                <div v-if="form.errors.password" class="text-red-500 text-xs mt-1">{{ form.errors.password }}</div>
              </div>
            </div>

            <div class="flex items-center gap-4 mt-6">
              <button type="submit" :disabled="form.processing" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 disabled:opacity-50">Simpan User</button>
              <Link :href="route('users.index')" class="text-sm text-gray-600 underline">Batal</Link>
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

defineProps({ roles: Array, branches: Array });
const form = useForm({ name: '', email: '', password: '', role_id: '', branch_id: '' });
</script>