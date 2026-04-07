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
        <h1 class="text-2xl font-bold text-white">ROMANCE</h1>
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
          <h3 class="mb-4 ml-4 text-sm font-medium text-white">MENU</h3>
          <ul>
            <li>
              <Link href="/dashboard" class="text-white hover:text-primary">
                Dashboard
              </Link>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </aside>
</template>