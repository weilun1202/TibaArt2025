<template>
  <div>
    <div class="wrapper">
      <header>
        <div class="pageTitle">首頁</div>
      </header>
      <!-- Wrapper 不設 1200px 寬（例如展覽、關於我們頁面應該會滿版），想要限制內容在 1200 的再自己包一個 div 限制 1200  -->
      <!-- 以下供大家編輯 -->

      <div class="tempoBtn">
        <router-link to="/" class="entryLink">前台入口</router-link>
        <router-link to="/admin" class="adminLink">後台入口</router-link>
      </div>


    </div>
  </div>
</template>

<script setup>

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
    width: 240px;
    height: 240px;
    line-height: 240px;
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
</style>
