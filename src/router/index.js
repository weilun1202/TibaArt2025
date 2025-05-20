import { createRouter, createWebHistory } from 'vue-router'
import Home from '@/views/Home.vue'
import Expo from '@/views/Expo.vue'
import Sponsor from '@/views/Sponsor.vue'
import Application from '@/views/Application.vue'
import Shop from '@/views/Shop.vue'
import Cart from '@/views/Cart.vue'
import About from '@/views/About.vue'
import Login from '@/views/Login.vue'
import Register from '@/views/Register.vue'


const routes = [
  { path: '/', component: Home },
  { path: '/expo', component: Expo },
  { path: '/sponsor', component: Sponsor },
  { path: '/application', component: Application },
  { path: '/shop', component: Shop },
  { path: '/cart', component: Cart },
  { path: '/about', component: About },
  { path: '/login', component: Login },
  { path: '/register', component: Register }

]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router






// 專案建成後原先設定

// import { createRouter, createWebHistory } from 'vue-router'
// import HomeView from '../views/HomeView.vue'


// const router = createRouter({
//   history: createWebHistory(import.meta.env.BASE_URL),
//   routes: [
//     {
//       path: '/',
//       name: 'home',
//       component: HomeView,
//     },
//     {
//       path: '/about',
//       name: 'about',
//       // route level code-splitting
//       // this generates a separate chunk (About.[hash].js) for this route
//       // which is lazy-loaded when the route is visited.
//       component: () => import('../views/AboutView.vue'),
//     },
//   ],
// })

// export default router
