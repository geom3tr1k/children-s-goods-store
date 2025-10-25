<script setup lang="ts">
import { ref } from 'vue';

const user = ref(null);

async function getUser() {
  const response = await fetch('http://127.0.0.1:8000/user', {
    method: 'GET',
    headers: { 'Authorization': `Bearer ${localStorage.getItem('auth')}` }
  });

  if (response.ok) {
    const data = await response.json();
    user.value = data; 
  }
}

getUser();
</script>

<template>
  <header class="bg-[#374151] flex justify-around max-w-[1600px] font-fredoka rounded-b-xl mx-auto">
    <div class="w-full px-6 flex justify-between items-center">
      <a href="/" class="flex items-center space-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 160 160" role="img">
          <rect width="80%" height="100%" rx="20" fill="#374151" />
          <g transform="translate(18,22)">
            <path
              d="M44 44c-10 0-18-7-18-16 0-9 8-16 18-16 3 0 6 1 8 2 2-5 7-8 13-8 8 0 15 7 15 16 0 9-7 16-15 16H44z"
              fill="#A5D8FF" stroke="#98C8FF" stroke-width="2"
            />
            <circle cx="38" cy="30" r="2" fill="#374151" />
            <circle cx="52" cy="30" r="2" fill="#374151" />
            <path d="M38 36c2 1 6 1 8 0" stroke="#374151" stroke-width="1.6" stroke-linecap="round" fill="none" />
          </g>
        </svg>
        <span class="text-5xl font-bold text-[#3B82F6]">BabyLand</span>
      </a>

      <nav class="flex text-gray-600 text-xl justify-around flex-1">
        <router-link to="/" class="text-[#FFFDF9] hover:text-[#3B82F6]">Каталог</router-link>
        <router-link to="/" class="text-[#FFFDF9] hover:text-[#3B82F6]">О компании</router-link>
        <router-link to="/" class="text-[#FFFDF9] hover:text-[#3B82F6]">Бонусная программа</router-link>
        <router-link to="/" class="text-[#FFFDF9] hover:text-[#3B82F6]">Контакты</router-link>
      </nav>

      <div class="flex items-center space-x-4">
        <router-link to="/login"
          v-if="!user"
          class="bg-[#A5D8FF] text-white px-10 py-2 rounded-xl hover:bg-[#3B82F6] transition cursor-pointer"
        >
          Войти
        </router-link>
        <router-link to="/account" v-else class="text-[#A5D8FF] font-bold text-xl">
          {{ user.firstName }}
        </router-link>

        <button class="relative text-[#3B82F6] cursor-pointer">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.3 5.3a1 1 0 001 1.2h11.6a1 1 0 001-1.2L17 13M7 13h10M10 21a1 1 0 100-2 1 1 0 000 2zm8 0a1 1 0 100-2 1 1 0 000 2z" />
          </svg>
          <span class="absolute -top-2 -right-2 bg-[#FFD6E8] text-[#374151] text-xs px-1 rounded-full font-fredoka">3</span>
        </button>
      </div>
    </div>
  </header>
</template>
