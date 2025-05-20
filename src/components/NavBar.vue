<template>
  <nav class="navWrapper">
    <router-link to="/"><img class="logo" src="@/assets/img/TibaArtLogo.svg" alt="" /></router-link>
    <div class="navBar">
      <ul>
        <li><router-link to="/expo">線上展覽</router-link></li>
        <li><router-link to="/sponsor">贊助藝術家</router-link></li>
        <li><router-link to="/application">展覽申請</router-link></li>
        <li><router-link to="/shop">線上商城</router-link></li>
        <li><router-link to="/about">關於我們</router-link></li>
      </ul>
      <div class="memberAction">
        <button class="memberBtn" @click="goToLogin">會員登入</button>
        <button class="registerBtn" @click="goToRegister">註冊會員</button>
      </div>
      <!-- <router-link to="/cart" class="cartIcon">
        <font-awesome-icon :icon="['fas', 'cart-shopping']" />
        <span class="cartCount">0</span>
      </router-link>   -->
    </div>
    <router-link to="/cart" class="cartIcon">
        <font-awesome-icon :icon="['fas', 'cart-shopping']" />
        <span class="cartCount">0</span>
    </router-link>  
  </nav>
</template>

<script setup>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
defineProps()

import { useRouter } from 'vue-router'
const router = useRouter()
const goToLogin = () => {
  router.push('/Login') // 導向 Login.vue
}
const goToRegister = () => {
  router.push('/Register') // 導向 Register.vue
}

</script>

<style scoped>
/* 你可以把 nav 的 CSS 加在這裡或保留在全域 */
</style>
