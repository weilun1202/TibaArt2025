<template>
  <div class="orderWarp">
    <p>還有<span>13</span>筆訂單尚未處理</p>
  </div>

  <div class="productSumWarp">
    <p>商品出售總收益<span>9999999999</span></p>
  </div>

  <div class="donateSumWarp">
    <p>贊助抽成總收益<span>9999999999</span></p>
  </div>
</template>

<script setup>
// 可根據需求加入邏輯
</script>

<style lang="scss" scoped>
@import '/style.scss';
.orderWarp{
  width: 500px;
  height: 200px;
  border: 5px solid $fontWarn;
}

</style>
