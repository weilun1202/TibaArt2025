import { createRouter, createWebHistory } from 'vue-router'

//layouts
import FrontLayout from '@/layouts/FrontLayout.vue'
import AdminLayout from '@/layouts/AdminLayout.vue'
// import EmptyLayout from '@/layouts/EmptyLayout.vue'


// views
import Home from '@/views/Home.vue'
import Expo from '@/views/Expo.vue'
import Sponsor from '@/views/Sponsor.vue'
import Application from '@/views/Application.vue'
import Shop from '@/views/Shop.vue'
import Product from '@/views/Product.vue'
import Cart from '@/views/Cart.vue'
import OrderConfirm from '@/views/OrderConfirm.vue'

import About from '@/views/About.vue'
import Login from '@/views/Login.vue'
import Register from '@/views/Register.vue'
import Admin from '@/views/backend/Admin.vue'


const routes = [
{
  path: '/',
  component: FrontLayout,
  children: [
    { path: '/', name: 'Home', component: Home },
    { path: 'expo', name: 'Expo', component: Expo },
    { path: 'sponsor', name: 'Sponsor', component: Sponsor },
    { path: 'application', name: 'Application', component: Application },
    { path: 'shop', name: 'Shop', component: Shop },
    { path: 'cart', name: 'Cart', component: Cart },
    { path: 'orderConfirm', component: OrderConfirm },
    { path: 'about', name: 'About', component: About },
    { path: 'login', name: 'Login', component: Login },
    { path: 'register', name: 'Register', component: Register },
    {
      path: '/product/:id',
      name: 'product',
      component: Product,
      props: true
    }
  ]
},
{
  path: '/admin',
  component: AdminLayout,
  children: [
    { path: '', name: 'Admin', component: Admin },
  ]
}


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
