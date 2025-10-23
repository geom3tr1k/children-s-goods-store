<script setup lang="ts">
import { ref } from 'vue';


const lastName = ref('');
const firstName = ref('');
const email = ref('');
const password = ref('')
</script>


<template>
  <div class="flex items-center justify-center min-h-screen bg-gradient-to-b from-[#A5D8FF] to-[#FFD6E8]">
    <div class="bg-white rounded-3xl shadow-2xl w-[90%] max-w-md p-8">
      <h1 class="text-4xl font-extrabold text-center text-[#3B82F6] mb-6 font-comfortaa">
        Регистрация
      </h1>
      <form @submit.prevent="" class="flex flex-col space-y-5">
        <div>
          <label class="block text-gray-700 mb-1 font-medium">Имя</label>
          <input
            v-model="firstName"
            type="text"
            placeholder="Введите ваше имя"
            required
            class="w-full p-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#3B82F6] transition"
          />
        </div>

        <div>
          <label class="block text-gray-700 mb-1 font-medium">Фамилия</label>
          <input
            v-model="lastName"
            type="text"
            placeholder="Введите ваше имя"
            required
            class="w-full p-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#3B82F6] transition"
          />
        </div>

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
            placeholder="Придумайте пароль"
            required
            class="w-full p-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#3B82F6] transition"
          />
        </div>

        <div>
          <label class="block text-gray-700 mb-1 font-medium">Подтверждение пароля</label>
          <input
            type="password"
            placeholder="Повторите пароль"
            required
            class="w-full p-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#3B82F6] transition"
          />
        </div>
        <button
          type="submit"
          class="bg-[#3B82F6] text-white font-semibold py-3 rounded-xl hover:bg-[#2563EB] transition shadow-md"
        >
          Зарегистрироваться
        </button>
      </form>
      <p class="text-center text-gray-600 mt-6">
        Уже есть аккаунт?
        <RouterLink to="/login" class="text-[#3B82F6] font-semibold hover:underline">
          Войти
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
