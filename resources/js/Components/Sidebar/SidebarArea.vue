<script setup>
import { Link } from '@inertiajs/vue3'

// Menerima kiriman data dari AuthenticatedLayout
defineProps(['sidebarOpened'])
// Mengirim perintah tutup ke AuthenticatedLayout
defineEmits(['close'])
</script>

<template>
  <aside
    :class="sidebarOpened ? 'translate-x-0' : '-translate-x-full'"
    class="fixed left-0 top-0 z-60 flex h-screen w-72.5 flex-col overflow-y-hidden bg-black duration-300 ease-linear dark:bg-boxdark lg:static lg:translate-x-0 overflow-visible"
  >
    <div class="flex items-center justify-between gap-2 px-6 py-5.5 lg:py-6.5">
      <Link href="/">
        <h1 class="text-2xl font-bold text-white tracking-widest">ROMANCE</h1>
      </Link>

      <button class="block lg:hidden text-white" @click="$emit('close')">
        <svg class="fill-current" width="20" height="18" viewBox="0 0 20 18">
          <path d="M19 8.175H2.98748L9.36248 1.6875C9.69998 1.35 9.69998 0.825 9.36248 0.4875C9.02498 0.15 8.49998 0.15 8.16248 0.4875L0.399976 8.3625C0.0624756 8.7 0.0624756 9.225 0.399976 9.5625L8.16248 17.4375C8.31248 17.5875 8.53748 17.7 8.76248 17.7C8.98748 17.7 9.17498 17.5875 9.36248 17.4375C9.69998 17.1 9.69998 16.575 9.36248 16.2375L2.98748 9.825H19C19.45 9.825 19.825 9.45 19.825 9C19.825 8.55 19.45 8.175 19 8.175Z"/>
        </svg>
      </button>
    </div>

    <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
      <nav class="mt-5 py-4 px-4 lg:mt-9 lg:px-6">
        <div>
          <h3 class="mb-4 ml-4 text-sm font-medium text-gray-400">MENU UTAMA</h3>
          <ul class="mb-6 flex flex-col gap-2">
            
            <li>
              <Link 
                href="/dashboard" 
                class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-white duration-300 ease-in-out hover:text-primary"
                :class="{ 'text-primary bg-gray-900': $page.component === 'Dashboard' }"
              >
                Dashboard
              </Link>
            </li>

            <li v-if="$page.props.auth.user.role === 'Admin'">
              <Link
                :href="route('roles.index')"
                class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-white duration-300 ease-in-out hover:text-primary"
                :class="{ 'text-primary bg-gray-900': $page.component.startsWith('Roles/') }"
              >
                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18">
                  <path d="M9 1.5L2.25 4.5V9C2.25 13.1475 5.1375 16.9875 9 18C12.8625 16.9875 15.75 13.1475 15.75 9V4.5L9 1.5Z" />
                </svg>
                Manajemen Role
              </Link>
            </li>

            <li v-if="$page.props.auth.user.role === 'Admin'">
              <Link
                :href="route('branches.index')"
                class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-white duration-300 ease-in-out hover:text-primary"
                :class="{ 'text-primary bg-gray-900': $page.component.startsWith('Branches/') }"
              >
                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18">
                  <path d="M15 12.75V11.25C15 10.425 14.325 9.75 13.5 9.75H9.75V6.75H11.25C12.075 6.75 12.75 6.075 12.75 5.25V2.25C12.75 1.425 12.075 0.75 11.25 0.75H6.75C5.925 0.75 5.25 1.425 5.25 2.25V5.25C5.25 6.075 5.925 6.75 6.75 6.75H8.25V9.75H4.5C3.675 9.75 3 10.425 3 11.25V12.75C1.725 13.05 0.75 14.175 0.75 15.525C0.75 16.875 1.875 18 3.225 18C4.575 18 5.7 16.875 5.7 15.525C5.7 14.175 4.725 13.05 3.45 12.75V11.25H13.05V12.75C11.775 13.05 10.8 14.175 10.8 15.525C10.8 16.875 11.925 18 13.275 18C14.625 18 15.75 16.875 15.75 15.525C15.75 14.175 14.275 13.05 15 12.75Z" />
                </svg>
                Manajemen Cabang
              </Link>
            </li>
            <li v-if="$page.props.auth.user.role === 'Admin'">
              <Link 
                :href="route('users.index')" 
                class="group relative flex items-center gap-2.5 rounded-sm py-2 px-4 font-medium text-white duration-300 ease-in-out hover:text-primary"
                :class="{ 'text-primary bg-gray-900': $page.component.startsWith('Users/') }"
              >
                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18">
                  <path d="M9 8.25C10.6569 8.25 12 6.90685 12 5.25C12 3.59315 10.6569 2.25 9 2.25C7.34315 2.25 6 3.59315 6 5.25C6 6.90685 7.34315 8.25 9 8.25Z" />
                  <path d="M12.375 9.75H5.625C4.3875 9.75 3.375 10.7625 3.375 12V14.25C3.375 15.0784 4.04657 15.75 4.875 15.75H13.125C13.9534 15.75 14.625 15.0784 14.625 14.25V12C14.625 10.7625 13.6125 9.75 12.375 9.75Z" />
                </svg>
                
                Manajemen User
              </Link>
            </li>
            
          </ul>
        </div>
      </nav>
    </div>
  </aside>
</template>