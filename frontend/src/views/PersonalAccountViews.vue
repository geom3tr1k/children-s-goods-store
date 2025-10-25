<script setup lang="ts">
import Header from '@/components/Header.vue'
import router from '@/router';
import { ref } from 'vue';
const user = ref();

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

async function logOut() {

    localStorage.removeItem('auth')

    router.push('/')
} 


getUser()
</script>
<template>
<div>
        <Header />

    <main class="grid grid-cols-3 gap-4 bg-white w-full mx-auto max-w-[1600px] mt-5 divide-x-4 divide-indigo-500"> 
        <section class=" text-black m-5 ">
            <p class="text-3xl mb-5">Информация о пользователе</p>
            <img :src="`/storage/${user.avatar}`" alt="Аватар пользователя" class="w-40 h-40 rounded-full object-cover" />
            <p class="text-xl mb-5">Имя пользователя: {{ user.firstName }}</p>
            <p class = "text-xl mb-5">Фамилия пользователя: {{ user.lastName }}</p>
            <p class = "text-xl mb-5">Почта: {{ user.email }}</p>
            <p class = "text-xl mb-5">Дата регистрации: </p>
            <button @click="logOut" class="bg-[#3B82F6] text-white font-semibold py-3 rounded-xl hover:bg-[#2563EB] transition shadow-md cursor-pointer w-9/10">
                Выйти
            </button>
        </section>
        <section class="col-span-2">
        </section>
    </main>
</div>

</template>
