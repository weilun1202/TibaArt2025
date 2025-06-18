<template>
  <div>
    <div class="wrapper">
      <header class="animate__animated animate__flipInX">
        <div class="pageTitle">贊助藝術家</div>
      </header>
      <!-- Wrapper 不設 1200px 寬（例如展覽、關於我們頁面應該會滿版），想要限制內容在 1200 的再自己包一個 div 限制 1200  -->
      <!-- 以下供大家編輯 -->
      
      <div class="wrap">
        <div class="reminder">
          <img src="@/assets/img/TibaArtLogo.svg" alt="">
          <span>贊助成功！</span>
          <p>贊助編號：#{{ donateNumber }}<br>
            已經將本次贊助資訊保留在您的紀錄，感謝您的支持。</p>
          <div>
            <button class="btn reminderBtn" @click="goExpo">線上展覽</button>
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

const donateNumber = ref('載入中')

onMounted(() => {
    // 從網址中取得 donate_no
    const donateNoFromQuery = route.query.donate_no
    if (donateNoFromQuery) {
      donateNumber.value = donateNoFromQuery
    } else {
      donateNumber.value = '查無資料'
    }
  })

// const goExpo = () => {
//   router.push('/expoArea') // 依你的路由設定做跳轉
// }

  function goExpo() {
    window.location.href = '/tjd101/g2/front/expo' // 回到線上展覽
  }
  
</script>

<style lang="scss" scoped>
/* 可以把額外的 CSS 加在這裡或保留在全域 */
@import '/style.scss';

// 與 MemRegOK style一樣
.reminder {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 40px;
  gap: 40px;

  height: calc(100vh - 192px);

  img{
    width: 200px;
  } 
  span {
      font-weight: bold;
  }
  p {
      text-align: center;
      line-height: 1.5;
  }
}

@media screen and (max-width:705px){
  .reminderBtn{
    font-size: 1.25rem;
    line-height: 48px;
  }
}


</style>

