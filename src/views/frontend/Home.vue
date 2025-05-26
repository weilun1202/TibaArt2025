<template>
  <div>
    <div class="wrapper">
      <header>
        <div class="pageTitle">首頁</div>
      </header>
      <!-- Wrapper 不設 1200px 寬（例如展覽、關於我們頁面應該會滿版），想要限制內容在 1200 的再自己包一個 div 限制 1200  -->
      <!-- 以下供大家編輯 -->
  
     

      <div class="justforfun">
          <div class="tempoBtn">
            <router-link to="/" class="entryLink">前台</router-link>
          </div>        
          <Flashy />
          <div class="tempoBtn">
            <router-link to="/admin" class="adminLink">後台</router-link>
          </div>      
      </div>

      

    </div>
  </div>
</template>

<script setup>
import Flashy from '@/components/Flashy.vue'

</script>

<style lang="scss" scoped>
/* 可以把額外的 CSS 加在這裡或保留在全域 */
@import '/style.scss';

.wrapper {
  background-color: $primaryGreen;
}

.tempoBtn {
  display: flex;
  justify-content: center;
  gap: $spacing-10;

  .entryLink,
  .adminLink {
    display: block;
    width: 180px;
    height: 180px;
    line-height: 180px;
    text-align: center;
    padding: 0 24px;

    text-decoration: none;
    color: $logoColor4;
    font-size: map-get($font, h2);
    background-color: $logoColor6;
    border-radius: 50%;

    &:hover {
      background-color: $logoColor4;
      color: $fontWhite;
    }

  }

}

.yo{
  display: flex;
  justify-content: center;
  align-items: center;
}

.justforfun{
  display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
    box-sizing:border-box;
}

canvas{
  width: 50%;
  border-radius: 80% 0 80% 0;

}
</style>
