<script setup>
import { ref } from 'vue'
import SidebarArea from '@/Components/Sidebar/SidebarArea.vue'
import HeaderArea from '@/Components/Header/HeaderArea.vue'

const sidebarOpened = ref(false)
</script>

<template>
  <div class="flex h-screen overflow-hidden bg-whiten dark:bg-boxdark-2">
    
    <SidebarArea 
      class="z-[9999]" 
      :sidebar-opened="sidebarOpened" 
      @close="sidebarOpened = false" 
    />

    <div class="flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
      
      <HeaderArea 
        class="z-[999]" 
        @toggle-sidebar="sidebarOpened = !sidebarOpened" 
      />

      <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
          <slot />
        </div>
      </main>
    </div>
  </div>
</template>