<template>
  <div class="Admin_expoWarp">
    <p>當前出展展覽數</p>
    <span>13</span>

  </div>
  
  <div class="Admin_orderWarp">
    <p>尚未出貨訂單</p>
    <span>13</span>
  </div>

  <div class="Admin_under">
    <div class="productSumWarp">
      <p>商品出售總收益<span>9999999999</span></p>
      <div class="rtg"></div>
    </div>
  
    <div class="Admin_donateWarp">
      <p>贊助抽成總收益<span>9999999999</span></p>
      <div class="rtg"></div>
    </div>
  </div>

</template>

<script setup>
// 可根據需求加入邏輯
</script>

<style lang="scss" scoped>
@import '/style.scss';
.Admin_expoWarp{
  width: 200px;
  height: 200px;
  background-color: #ccc;
  color: #fff;
}
.Admin_orderWarp{
  width: 200px;
  height: 200px;
  background-color: $fontWarn;
  color: #fff;
}

.Admin_under{
  display: flex;
  gap: $spacing-5;
  .rtg{
    width: 500px;
    height: 200px;
    background-color: #ccc;
  }
}
</style>
