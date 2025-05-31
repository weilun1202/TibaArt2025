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
          <div class="reminderContent">
            
            <img src="@/assets/img/TibaArtLogo.svg" alt="">
  
            <h2 class="reminderTitle">贊助成功！</h2>
            <p class="reminderText">已經將本次贊助資訊保留在您的紀錄，感謝您的支持。</p>
            
            <div>
              <button class="btn reminderBtn" @click="goExpo">回到線上展覽</button>
            </div>
          </div>  

        </div>

      </div>

    </div>

  </div>

</template>

<script setup>
  import { ref } from 'vue'
  import { useRouter } from 'vue-router'
  function goExpo() {
    window.location.href = '/Expo' // 回到線上展覽
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
  }
  .reminderTitle {
    font-size: 2rem;
  }
  .reminderText{
    padding: $spacing-5;
    max-width: 640px;
    text-align: center;
    line-height: 1.6;
  }
  .reminderBtn{
    box-sizing: border-box;
    margin: $spacing-1;
  }
  img{
    width: 200px;
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

