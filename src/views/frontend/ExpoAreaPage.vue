<template>
  <div class="expoAreaPage">
    <div class="wrapper">
      <header>
        <div class="pageTitle">展區欣賞</div>
      </header>
      <!-- Wrapper 不設 1200px 寬（例如展覽、關於我們頁面應該會滿版），想要限制內容在 1200 的再自己包一個 div 限制 1200  -->
      <!-- 以下供大家編輯 -->
      <div class="main">
        <img src="/src/assets/img/expoArea-artwork1.png" alt="">
        <div class="artwork-title">
          <h2>凝視遺聲</h2>
          <h5>Gaze of Unspoken</h5>
          <p>size 66x66(m)</p>
          <p>雕塑</p>
        </div>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi magni assumenda eaque necessitatibus beatae
          ipsum cupiditate adipisci reiciendis explicabo fugit pariatur exercitationem vel quo dolores porro maxime
          laborum, dignissimos ducimus nesciunt architecto hic expedita suscipit qui? Laboriosam sint quas voluptates
          rem, eos natus nam officiis nobis asperiores sequi porro explicabo?
        </p>
        <router-link to="/ExpoArea"><button class="btn">返回展區</button></router-link>
      </div>

    </div>
  </div>
</template>

<script setup>

</script>

<style lang="scss" scoped>
/* 可以把額外的 CSS 加在這裡或保留在全域 */
@import '/style.scss';
</style>
