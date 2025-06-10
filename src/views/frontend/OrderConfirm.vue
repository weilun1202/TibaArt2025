<template>
  <div>
    <div class="wrapper">
      <header class="animate__animated animate__flipInX">
        <div class="pageTitle">訂單確認</div>
      </header>
        <!-- Wrapper 不設 1200px 寬（例如展覽、關於我們頁面應該會滿版），想要限制內容在 1200 的再自己包一個 div 限制 1200  -->
        <!-- 以下供大家編輯 -->
      <div class="wrap">
        <div class="order">
              <img src="@/assets/img/TibaArtLogo.svg" alt="">
              <span>訂單已成立!</span>
              <p>訂單編號：#{{ orderNumber }}<br>
                  我們已發送確認信至您的信箱，您可隨時至「訂單追蹤」頁面查看最新狀態。</p>

              <div class="goBack">
                  <button type="button" class="btn"><router-link to="/front/">回到首頁</router-link></button>
                  <button type="button" class="btn"><router-link to="/member/memOrder">查看訂單</router-link></button>
              </div>
          </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'

const route = useRoute()
const router = useRouter()
const orderNumber = ref('載入中')

onMounted(() => {
  const orderFromQuery = route.query.orderNumber

  if( orderFromQuery ){
    orderNumber.value = orderFromQuery
  }else {
    orderNumber.value = '無法取得訂單編號'
    router/pushScopeId('/front/')
  }

})

</script>
