<script setup lang="ts">
import { ref } from 'vue'

interface User {
  id: number
  firstName: string
  lastName: string
  email: string
  avatar?: string
}
const user = ref<User | null>(null)

async function getUser() {
  const response = await fetch('http://127.0.0.1:8000/user', {
    method: 'GET',
    headers: { Authorization: `Bearer ${localStorage.getItem('token')}` },
  })

  if (response.ok) {
    const data = await response.json()
    user.value = data
  }
}

getUser()
</script>

<template>
  <header class="bg-[#fff] flex justify-around max-w-[1600px] font-mont rounded-b-xl mx-auto mb-10">
    <div class="w-full flex justify-between items-center p-8">
      <router-link to="/" class="flex items-center space-x-2">
        <span class="text-5xl font-bold text-[#4ECDC4]">BabyLand</span>
      </router-link>

      <nav class="flex text-2xl justify-around flex-1">
        <router-link to="/catalog" class="text-[#333333] hover:text-[#4ECDC4]">Каталог</router-link>
        <router-link to="/about" class="text-[#333333] hover:text-[#4ECDC4]"
          >О компании</router-link
        >
        <router-link to="/contacts" class="text-[#333333] hover:text-[#4ECDC4]"
          >Контакты</router-link
        >
        <router-link to="/bonus" class="text-[#333333] hover:text-[#4ECDC4]"
          >Бонусная программа</router-link
        >
      </nav>

      <div class="flex items-center space-x-4">
        <router-link
          to="/login"
          v-if="!user"
          class="bg-[#4ECDC4] text-white px-10 py-2 rounded-xl hover:bg-[#333333] transition cursor-pointer"
        >
          Войти
        </router-link>
        <router-link to="/account" v-else class="text-[#4ECDC4] font-bold text-xl">
          {{ user.firstName }}
        </router-link>

        <button class="text-[#333333] cursor-pointer">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.3 5.3a1 1 0 001 1.2h11.6a1 1 0 001-1.2L17 13M7 13h10M10 21a1 1 0 100-2 1 1 0 000 2zm8 0a1 1 0 100-2 1 1 0 000 2z"
            />
          </svg>
        </button>
      </div>
    </div>
  </header>
</template>
