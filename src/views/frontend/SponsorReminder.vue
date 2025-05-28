<template>
  <div>
    <div class="wrapper">
      <header>
        <div class="pageTitle">贊助藝術家</div>
      </header>
      <!-- Wrapper 不設 1200px 寬（例如展覽、關於我們頁面應該會滿版），想要限制內容在 1200 的再自己包一個 div 限制 1200  -->
      <!-- 以下供大家編輯 -->
      
      <div class="wrap">

        
        <div class="reminder">
          <img src="../../assets/img/TibaArt-Icon.svg" alt="">

          <h2 class="reminderTitle">您尚未登入會員</h2>
          <p class="reminderText">感謝您的贊助！為了讓我們保留您的紀錄，請先登入會員帳號。</p>
          <button class="btn reminderBtn" @click="goLogin">會員登入</button>
          <button class="btn reminderBtn" @click="goECPay">直接贊助</button>

        </div>

      </div>

    </div>

  </div>

</template>

<script setup>
  import { ref } from 'vue'
  import { useRouter } from 'vue-router'
  function goLogin() {
    window.location.href = '/MemLogin' // 登入頁路徑
  }

  function goECPay() {
    window.location.href = 'https://www.ecpay.com.tw/' // 綠界網址
  }
  
</script>

<style lang="scss" scoped>
/* 可以把額外的 CSS 加在這裡或保留在全域 */
@import '/style.scss';
.reminder {
  
  text-align: center;
  padding: 2rem 0;
  .reminderTitle {
    font-size: 2rem;
  }
  .reminderText{
    padding: $spacing-5;
  }
  .reminderBtn{
    margin: $spacing-1;
  }
  img{
    margin: $spacing-6;
    text-align: center;
    width: 100px;
  }
  
}


</style>

