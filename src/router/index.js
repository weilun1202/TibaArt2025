import { createRouter, createWebHistory } from 'vue-router'

//layouts
import FrontLayout from '@/layouts/FrontLayout.vue'
import AdminLayout from '@/layouts/AdminLayout.vue'
import MemberLayout from '@/layouts/MemberLayout.vue'
// import EmptyLayout from '@/layouts/EmptyLayout.vue'


// views
//frontend
import Home from '@/views/frontend/Home.vue'
import Expo from '@/views/frontend/Expo.vue'
import ExpoArea from '@/views/frontend/ExpoArea.vue'
import ExpoAreaPage from '@/views/frontend/ExpoAreaPage.vue'
import Sponsor from '@/views/frontend/Sponsor.vue'
import Application from '@/views/frontend/Application.vue'
import Shop from '@/views/frontend/Shop.vue'
import Product from '@/views/frontend/Product.vue'
import Cart from '@/views/frontend/Cart.vue'
import OrderConfirm from '@/views/frontend/OrderConfirm.vue'
import About from '@/views/frontend/About.vue'
import MemLogin from '@/views/frontend/MemLogin.vue'
import MemReg from '@/views/frontend/MemReg.vue'
import MemRegOK from '@/views/frontend/MemRegOK.vue'
import MemForgetPass from '@/views/frontend/MemForgetPass.vue'
import SponsorReminder from '@/views/frontend/SponsorReminder.vue'
import SponsorSuccess from '@/views/frontend/SponsorSuccess.vue'

//frontend/member
import MemHome from '@/views/frontend/member/MemHome.vue'
import MemExpo from '@/views/frontend/member/MemExpo.vue'
import MemOrder from '@/views/frontend/member/MemOrder.vue'
import MemSponsor from '@/views/frontend/member/MemSponsor.vue'

//backend
import Admin from '@/views/backend/Admin.vue'
import AdminMember from '@/views/backend/AdminMember.vue'
import AdminArtist from '@/views/backend/AdminArtist.vue'
import AdminArtwork from '@/views/backend/AdminArtwork.vue'
import AdminExpo from '@/views/backend/AdminExpo.vue'
import AdminProduct from '@/views/backend/AdminProduct.vue'
import AdminOrder from '@/views/backend/AdminOrder.vue'
import AdminDonate from '@/views/backend/AdminDonate.vue'
import LoginAdmin from '@/views/backend/LoginAdmin.vue'


const routes = [
  {
    path: '/',
    component: FrontLayout,
    children: [
      { path: '/', name: 'Home', component: Home },
      { path: 'expo', name: 'Expo', component: Expo },
      { path: 'expoArea', name: 'ExpoArea', component: ExpoArea },
      { path: 'expoAreaPage', name: 'ExpoAreaPage', component: ExpoAreaPage },
      { path: 'sponsor', name: 'Sponsor', component: Sponsor },
      { path: 'application', name: 'Application', component: Application },
      { path: 'shop', name: 'Shop', component: Shop },
      { path: 'cart', name: 'Cart', component: Cart },
      { path: 'orderConfirm', component: OrderConfirm },
      { path: 'about', name: 'About', component: About },
      { path: 'memLogin', name: 'MemLogin', component: MemLogin },
      { path: 'memReg', name: 'MemReg', component: MemReg },
      { path: 'memRegOK', name: 'MemRegOK', component: MemRegOK },
      { path: 'memForgetPass', name: 'MemForgetPass', component: MemForgetPass },
      { path: 'sponsor-reminder', name: 'SponsorReminder', component: SponsorReminder },
      { path: 'sponsorSuccess', name: 'SponsorSuccess', component: SponsorSuccess },
      {
        path: '/product/:id',
        name: 'product',
        component: Product,
        props: true
      }
    ]
  },
  {
    path: '/member',
    component: MemberLayout,
    children: [
      { path: '', name: 'MemHome', component: MemHome },
      { path: 'memExpo', name: 'MemExpo', component: MemExpo },
      { path: 'memOrder', name: 'MemOrder', component: MemOrder },
      { path: 'memSponsor', name: 'MemSponsor', component: MemSponsor },
    ]
  },
  {
    path: '/admin',
    component: AdminLayout,
    children: [
      { path: '', name: 'Admin', component: Admin, meta: { title: '後台首頁' } },
      { path: 'member', name: 'AdminMember', component: AdminMember, meta: { title: '一般會員管理' } },
      { path: 'artist', name: 'AdminArtist', component: AdminArtist, meta: { title: '藝術家會員管理' } },
      { path: 'artwork', name: 'AdminArtwork', component: AdminArtwork, meta: { title: '作品管理' } },
      { path: 'expo', name: 'AdminExpo', component: AdminExpo, meta: { title: '展覽資訊管理' } },
      { path: 'product', name: 'AdminProduct', component: AdminProduct, meta: { title: '商品管理' } },
      { path: 'order', name: 'AdminOrder', component: AdminOrder, meta: { title: '訂單管理' } },
      { path: 'donate', name: 'AdminDonate', component: AdminDonate, meta: { title: '贊助管理' } },
    ]
  },
  {
    path: '/admin/login',
    name: 'LoginAdmin',
    component: LoginAdmin,
    meta: { title: '後台系統登入' }
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
