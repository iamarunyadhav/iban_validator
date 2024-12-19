// src/router/index.js
import { createRouter, createWebHistory } from 'vue-router';
import store from '@/store'; // Import the store
import UserDashboard from '@/views/Iban.vue';
import Login from '@/views/Login.vue';
import Home from '@/views/HomeView.vue';
import Admin from '@/views/Admin.vue';
import Register from '@/views/Register.vue';

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      name: 'Home',
      component: Home,
    },
    {
      path: '/login',
      name: 'Login',
      component: Login,
    },
    {
      path: '/register',
      name: 'Register',
      component: Register,
    },
    {
      path: '/user-dashboard',
      name: 'UserDashboard',
      component: UserDashboard,
      meta: { requiresAuth: true }
    },
    {
      path: '/admin-dashboard',
      name: 'AdminDashboard',
      component: Admin,
      meta: { requiresAuth: true }
    }
  ]
});

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!store.getters.isAuthenticated) {
      next({ name: 'Login' });
    } else {
      next();
    }
  } else {
    next();
  }
});

export default router;
