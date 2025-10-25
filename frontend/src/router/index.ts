import LoginViews from '@/views/LoginViews.vue'
import MainViews from '@/views/MainViews.vue'
import PersonalAccountViews from '@/views/PersonalAccountViews.vue'
import RegViews from '@/views/RegViews.vue'
import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/login',
      name: 'login',
      component: LoginViews,
    },
    {
      path: '/',
      name: 'main',
      component: MainViews,
    },
    {
      path: '/register',
      name: 'register',
      component: RegViews
    },
    {
      path: '/account',
      name: 'account',
      component: PersonalAccountViews
    }

   
  ],
})

export default router
