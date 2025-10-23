<script setup lang="ts">
import router from '@/router';
import { ref } from 'vue';

const email = ref('');
const password = ref('');
const API = 'http://127.0.0.1:8000';
const errors = ref();

async function login() {


    const responce = await fetch(`${API}/login`, {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({
            email: email.value,
            password: password.value
        })
    })

     const result = await responce.json()

        if (result.status === 200) {
            localStorage.setItem('auth', result.token)
            router.push('/')

        } else {
            errors.value = 'Неверный логин или пароль'
        }
    
}
</script>
<template>
  <div class="flex items-center justify-center min-h-screen bg-gradient-to-b from-[#A5D8FF] to-[#FFD6E8]">
    <div class="bg-white rounded-3xl shadow-2xl w-[90%] max-w-md p-8">
      <h1 class="text-4xl font-extrabold text-center text-[#3B82F6] mb-6 font-comfortaa">
        Вход в BabyLand
      </h1>

      <form @submit.prevent="login" class="flex flex-col space-y-5">
        <div>
          <label class="block text-gray-700 mb-1 font-medium">Email</label>
          <input
            v-model="email"
            type="email"
            placeholder="Введите email"
            required
            class="w-full p-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#3B82F6] transition"
          />
        </div>

        <div>
          <label class="block text-gray-700 mb-1 font-medium">Пароль</label>
          <input
            v-model="password"
            type="password"
            placeholder="Введите пароль"
            required
            class="w-full p-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#3B82F6] transition"
          />
        </div>

        <button
          type="submit"
          class="bg-[#3B82F6] text-white font-semibold py-3 rounded-xl hover:bg-[#2563EB] transition shadow-md"
        >
          Войти
        </button>
      </form>

        <div v-if="errors" class="text-[#CD5C5C] text-center text-lg mt-4">
            {{ errors }}
        </div>

      <p class="text-center text-gray-600 mt-6">
        Нет аккаунта?
        <RouterLink to="/register" class="text-[#3B82F6] font-semibold hover:underline">
          Зарегистрироваться
        </RouterLink>
      </p>
    </div>
  </div>
</template>


<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Comfortaa:wght@500;700&display=swap');

.font-comfortaa {
  font-family: 'Comfortaa', cursive;
}

</style>
