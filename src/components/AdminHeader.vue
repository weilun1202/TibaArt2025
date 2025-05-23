<template>

  <div class="adminHeader">
    <p>一般會員管理</p>
    <div class="adminHeaderBtn">
      <button class="btn">回首頁</button>
      <button class="btn">登出</button>
    </div>
    

  </div>
</template>

<script setup>
</script>

<style lang="scss" scoped>
@import '/style.scss';
.adminHeader{
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: calc(100% - 250px);
  height: 60px;
  border-bottom: 2px solid $primaryGreen;
  float: right;
  p{
    padding: $spacing-5;
    font-size: 20px;
    font-weight: 600;
  }
  .btn{
    margin-right: $spacing-5;
  }
}
</style>