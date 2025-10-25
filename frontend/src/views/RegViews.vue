<script setup lang="ts">
import router from '@/router';
import { ref } from 'vue';

const lastName = ref('');
const firstName = ref('');
const email = ref('');
const password = ref('');
const accept = ref(false)
const returtPassword = ref('');
const avatar = ref<File | null>(null);

const errors = ref<{
  firstName?: string,
  lastName?: string,
  email?: string,
  password?: string,
  returPassword?: string,
  accept?: string
}>({});

function validate() {
  errors.value = {};
  if (password.value !== returtPassword.value) {
    errors.value.returPassword = 'Пароли не совпадают';
    return false;
  }
  if (!accept.value) {
    errors.value.accept = 'Вы должны согласиться на обработку данных';
    return false; 
  }
  return true;
}

function handleFileChange(event: Event) {
  const target = event.target as HTMLInputElement;
  if (target.files && target.files[0]) {
    avatar.value = target.files[0];
  }
}

async function register() {
  if (!validate()) return;

  const formData = new FormData();
  formData.append('email', email.value);
  formData.append('password', password.value);
  formData.append('firstName', firstName.value);
  formData.append('lastName', lastName.value);

  if (avatar.value) {
    formData.append('avatar', avatar.value);
  }

  const response = await fetch('http://127.0.0.1:8000/reg', {
    method: 'POST',
    body: formData
  });

  if (response.ok) {
    const result = await response.json();
    localStorage.setItem('auth', result.token);
    router.push('/account');
  } 
}
</script>


<template>
  <div class="flex flex-col items-center justify-center min-h-screen bg-gradient-to-b from-[#A5D8FF] to-[#FFD6E8] space-y-6">
     <router-link
      to="/"
      class="w-1/10 text-center bg-[#3B82F6] text-white font-semibold py-3 rounded-xl hover:bg-[#2563EB] transition shadow-md "
    >
      Назад
    </router-link>
    <div class="bg-white rounded-3xl shadow-2xl w-[90%] max-w-md p-8">
      <h1 class="text-4xl font-extrabold text-center text-[#3B82F6] mb-6 font-comfortaa">
        Регистрация
      </h1>
      <form @submit.prevent="register" class="flex flex-col space-y-5">
        <div>
          <label class="block text-gray-700 mb-1 font-medium">Имя</label>
          <input
            v-model="firstName"
            type="text"
            placeholder="Введите ваше имя"
            required
            class="text-gray-700 w-full p-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#3B82F6] transition"
          />
        </div>

        <div>
          <label class="block text-gray-700 mb-1 font-medium">Фамилия</label>
          <input
            v-model="lastName"
            type="text"
            placeholder="Введите ваше имя"
            required
            class=" text-gray-700 w-full p-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#3B82F6] transition"
          />
        </div>

        <div>
          <label class="block text-gray-700 mb-1 font-medium">Email</label>
          <input
            v-model="email"
            type="email"
            placeholder="Введите email"
            required
            class=" text-gray-700 w-full p-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#3B82F6] transition"
          />
        </div>

        <div>
          <label class="block text-gray-700 mb-1 font-medium">Пароль</label>
          <input
            v-model="password"
            type="password"
            placeholder="Придумайте пароль"
            required
            class=" text-gray-700 w-full p-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#3B82F6] transition"
          />
        </div>

        <div>
          <label class="block text-gray-700 mb-1 font-medium">Подтверждение пароля</label>
          <input
          v-model="returtPassword"
            type="password"
            placeholder="Повторите пароль"
            required
            class="text-gray-700 w-full p-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#3B82F6] transition"
          />
        </div>
        <div>
           <label class="block text-gray-700 mb-1 font-medium">Фото</label>
          <input
            type="file"
            accept="image/*"
            @change="handleFileChange"
            class=" text-gray-700 w-full p-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#3B82F6] transition"
          />
        </div>

        <div v-if="errors.returPassword" class="text-red-500">
          {{ errors.returPassword }}
        </div>
        <div>
          <label class="flex items-center space-x-2 cursor-pointer">
            <input v-model="accept" type="checkbox" class="cursor-pointer w-4 h-4 accent-[#3B82F6] rounded" />
            <span class="text-gray-700">Я согласен на обработку персональных данных</span>
          </label>
          <p v-if="errors.accept" class="text-red-500 text-sm mt-1">{{ errors.accept }}</p>
        </div>
        <button
          type="submit"
          class="bg-[#3B82F6] text-white font-semibold py-3 rounded-xl hover:bg-[#2563EB] transition shadow-md cursor-pointer"
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
