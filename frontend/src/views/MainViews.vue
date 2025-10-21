<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import Header from '@/components/Header.vue'

const targetDate = new Date('2025-12-31T23:59:59')

const now = ref(new Date())
const timer = ref(null)

const timeLeft = computed(() => {
  const diff = targetDate - now.value
  if (diff <= 0) return { total: 0, days: 0, hours: 0, minutes: 0, seconds: 0 }

  return {
    total: diff,
    days: Math.floor(diff / (1000 * 60 * 60 * 24)),
    hours: Math.floor((diff / (1000 * 60 * 60)) % 24),
    minutes: Math.floor((diff / (1000 * 60)) % 60),
    seconds: Math.floor((diff / 1000) % 60),
  }
})

onMounted(() => {
  timer.value = setInterval(() => {
    now.value = new Date()
  }, 1000)
})

onUnmounted(() => {
  clearInterval(timer.value)
})

const images = [
  { id: 1, src: new URL('../assets/image/image.png', import.meta.url).href, alt: 'Игрушка 1' },
  { id: 2, src: new URL('../assets/image/image.png', import.meta.url).href, alt: 'Игрушка 1' },
  { id: 3, src: new URL('../assets/image/image.png', import.meta.url).href, alt: 'Игрушка 1' },
  { id: 4, src: new URL('../assets/image/image.png', import.meta.url).href, alt: 'Игрушка 1' },
  
]

const activeIndex = ref(0)

function selectImage(index) {
  activeIndex.value = index
}

setInterval(() => {
  activeIndex.value = (activeIndex.value + 1) % images.length
}, 5000)

</script>
<template>
  <div class="container">
      <Header />
     <div class="flex justify-center items-center gap-6 max-w-[1600px] mx-auto p-6">
    <div class="flex flex-col gap-4 w-1/6">
      <div
        v-for="(img, index) in images"
        :key="img.id"
        @click="selectImage(i)"
        class="cursor-pointer border-4 rounded-2xl overflow-hidden transition-all duration-300"
        :class="index === activeIndex ? 'border-blue-400' : 'border-transparent hover:border-blue-200'"
      >
        <img :src="img.src" :alt="img.alt" class="w-full h-full object-cover" />
      </div>
    </div>

    <div class="relative w-5/6 h-[600px] overflow-hidden rounded-3xl shadow-lg">
      <transition name="fade" mode="out-in">
        <img
          :key="images[activeIndex].id"
          :src="images[activeIndex].src"
          :alt="images[activeIndex].alt"
          class="absolute inset-0 w-full h-full object-cover rounded-3xl"
        />
      </transition>
    </div>
  </div>
   <section class="bg-white p-10 max-w-[1600px] rounded-tr-full rounded-bl-full flex flex-col items-center m-auto">
    <p class="text-[#3B82F6] font-fredoka text-7xl pb-10">До конца скидок осталось:</p>
    
    <div class="flex justify-center items-center gap-4 text-3xl font-semibold flex-wrap font-indiana">
      <div class="bg-black p-4 rounded-xl shadow-md text-center text-white w-3xs h-3xs ">
        {{ timeLeft.days }}
        <span class="block text-xl">дней</span>
      </div>

      <div class="bg-black p-4 rounded-xl shadow-md text-center text-white w-3xs h-3xs">
        {{ timeLeft.hours }}
        <span class="block text-xl">часов</span>
      </div>

      <div class="bg-black p-4 rounded-xl shadow-md text-center text-white w-3xs h-3xs">
        {{ timeLeft.minutes }}
        <span class="block text-xl">минут</span>
      </div>

      <div class="bg-black p-4 rounded-xl shadow-md text-center text-white w-3xs h-3xs">
        {{ timeLeft.seconds }}
        <span class="block text-xl">секунд</span>
      </div>
    </div>
   </section>
   <p class="text-3xl text-black">Товары, которые выбирает Ваш ребенок  </p>
   <section class="flex ">
    <div>
      <div></div>
      <div></div>
      <div></div>
    </div>
    <div>

    </div>
   </section>
  </div>
</template>
<style scoped>

.container {
  margin: auto;
}
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

</style>
