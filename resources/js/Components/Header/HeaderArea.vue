<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'

// Emit untuk toggle sidebar di mobile
defineEmits(['toggle-sidebar'])

const dropdownOpen = ref(false)
const target = ref(null)

// Mengambil data user secara reaktif dari Inertia
const page = usePage()
const user = computed(() => page.props.auth.user)

// Menutup dropdown jika klik di luar area profil
const closeDropdown = (e) => {
  if (dropdownOpen.value && target.value && !target.value.contains(e.target)) {
    dropdownOpen.value = false
  }
}

onMounted(() => { window.addEventListener('click', closeDropdown) })
onUnmounted(() => { window.removeEventListener('click', closeDropdown) })
</script>

<template>
  <header class="sticky top-0 z-[999] flex w-full bg-white drop-shadow-1 dark:bg-boxdark dark:drop-shadow-none border-b border-stroke overflow-visible">
    <div class="flex flex-grow items-center justify-between py-4 px-4 shadow-2 md:px-6 2xl:px-11 overflow-visible">
      
      <div class="flex items-center gap-2 lg:hidden">
        <button @click.stop="$emit('toggle-sidebar')" class="block rounded-sm border border-stroke bg-white p-1.5 shadow-sm dark:border-strokedark dark:bg-boxdark">
          <svg class="fill-black dark:fill-white" width="20" height="20" viewBox="0 0 20 20">
            <path d="M16.875 10.625H3.125C2.775 10.625 2.5 10.35 2.5 10C2.5 9.65 2.775 9.375 3.125 9.375H16.875C17.225 9.375 17.5 9.65 17.5 10C17.5 10.35 17.225 10.625 16.875 10.625Z" />
            <path d="M16.875 6.25H3.125C2.775 6.25 2.5 5.975 2.5 5.625C2.5 5.275 2.775 5 3.125 5H16.875C17.225 5 17.5 5.275 17.5 5.625C17.5 5.975 17.225 6.25 16.875 6.25Z" />
            <path d="M16.875 15H3.125C2.775 15 2.5 14.725 2.5 14.375C2.5 14.025 2.775 13.75 3.125 13.75H16.875C17.225 13.75 17.5 14.025 17.5 14.375C17.5 14.725 17.225 15 16.875 15Z" />
          </svg>
        </button>
      </div>

      <div class="hidden sm:block"></div>

      <div class="flex items-center gap-3" ref="target">
        <div class="relative z-[1000]">
          <button @click.stop="dropdownOpen = !dropdownOpen" class="flex items-center gap-4 focus:outline-none">
            <span class="hidden text-right lg:block">
              <span class="block text-sm font-medium text-black dark:text-white">{{ user?.name || 'willy' }}</span>
              <span class="block text-xs text-gray-500">MIS Department</span>
            </span>
            <span class="h-12 w-12 rounded-full border border-stroke flex items-center justify-center bg-blue-100 text-blue-600 font-bold shadow-sm">
               {{ user?.name ? user.name.substring(0, 2).toUpperCase() : 'WI' }}
            </span>
            <svg class="fill-current hidden sm:block" :class="dropdownOpen && 'rotate-180'" width="12" height="8" viewBox="0 0 12 8" fill="none">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M0.410765 0.910734C0.736202 0.585297 1.26384 0.585297 1.58928 0.910734L6.00002 5.32148L10.4108 0.910734C10.7362 0.585297 11.2638 0.585297 11.5893 0.910734C11.9147 1.23617 11.9147 1.76381 11.5893 2.08925L6.58928 7.08925C6.26384 7.41469 5.7362 7.41469 5.41077 7.08925L0.410765 2.08925C0.0853277 1.76381 0.0853277 1.23617 0.410765 0.910734Z" fill=""/>
            </svg>
          </button>

          <div v-show="dropdownOpen" class="absolute right-0 mt-4 flex w-62.5 flex-col rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark z-[1001] shadow-xl">
            <ul class="flex flex-col border-b border-stroke dark:border-strokedark">
              <li>
                <Link method="get" as="button" href="/profile" class="flex items-center gap-3.5 px-6 py-4 text-sm font-medium duration-300 ease-in-out hover:text-primary lg:text-base w-full text-left">
                  My Profile
                </Link>
              </li>
              <li>
                <Link method="post" as="button" href="/logout" class="flex items-center gap-3.5 px-6 py-4 text-sm font-medium duration-300 ease-in-out hover:text-primary lg:text-base w-full text-left">
                  Log Out
                </Link>
              </li>
            </ul>
          </div>
        </div>
      </div>

    </div>
  </header>
</template>