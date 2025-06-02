<template>
  <div>
    <div class="wrapper">
      <header class="animate__animated animate__flipInX">
        <div class="pageTitle">贊助藝術家</div>
      </header>
      <!-- Wrapper 不設 1200px 寬（例如展覽、關於我們頁面應該會滿版），想要限制內容在 1200 的再自己包一個 div 限制 1200  -->
      <!-- 以下供大家編輯 -->
      
      <!-- <div class="wrapper"> -->

      <div class="reminder">
        <div class="reminderContent">
          
          <img src="@/assets/img/TibaArtLogo.svg" alt="">

          <p>
            <h2 class="reminderTitle">您尚未登入會員</h2>
            <p class="reminderText">感謝您的贊助！為了讓我們保留您的紀錄，請先登入會員帳號。</p>
            <div>
              <button class="btn reminderBtn" @click="goLogin">會員登入</button>
              <button class="btn reminderBtn" @click="goECPay">直接贊助</button>
            </div>
          </p>
          
        </div>  

      </div>

      <!-- </div> -->

    </div>

  </div>

</template>

<script setup>
  import { ref } from 'vue'
  import { useRouter } from 'vue-router'
  function goLogin() {
    window.location.href = '/front/MemLogin' // 登入頁路徑
  }

  // 登入後，自動跳轉回贊助
  // function goLogin() {
  //   const currentPath = '/front/Sponsor'
  //   window.location.href = `/front/MemLogin?redirect=${encodeURIComponent(currentPath)}`
  // }

  function goECPay() {
    window.location.href = 'https://www.ecpay.com.tw/' // 綠界網址
  }
  
</script>

<style lang="scss" scoped>
/* 可以把額外的 CSS 加在這裡或保留在全域 */
@import '/style.scss';

// 與 MemRegOK style一樣
.reminder {
  margin: 0 auto;
  max-width: 1200px;
  height: calc(100vh - 192px);
  padding-top: 60px;

  .reminderContent{
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 40px;
    gap: 40px;

    img{
      width: 200px;
    }

    p{
      max-width: 640px;
      text-align: center;
      line-height: 1.6;
      .reminderTitle {
        font-size: 2rem;
      }
      .reminderText{
        padding: $spacing-5;
      }
      .reminderBtn{
        margin: 0 5px;
        gap: 20px;
      }
    }
  }
}
@media screen and (max-width:705px){
  .reminderContent{
    .reminderBtn{
      font-size: 1.25rem;
      line-height: 48px;
    }
  }
}


</style>

