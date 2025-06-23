<template>
  <div class="Admin_topWarp">
    <div class="Admin_topItem">
      <p>當前出展展覽數</p>
      <span>13</span>
      
    </div>
    
    <div class="Admin_topItem">
      <p>尚未出貨訂單</p>
      <span>13</span>
    </div>
  </div>

  <div class="Admin_under">
    <div class="Admin_underItem">
      <p>商品出售總收益<span>$9999999999</span></p>
      <div class="rtg"></div>
    </div>
  
    <div class="Admin_underItem">
      <p>贊助抽成總收益<span>$9999999999</span></p>
      <div class="rtg"></div>
    </div>
  </div>

</template>

<script setup>

</script>

<style lang="scss" scoped>
@import '/style.scss';
.Admin_topWarp{
  display: flex;
  gap: $spacing-5;
  margin-bottom: $spacing-5;
  .Admin_topItem{
    width: 200px;
    background-color: $logoColor4;
    color: #fff;
    text-align: center;
    padding: 30px 0;
    span{
      display: block;
      padding-top: $spacing-5;
      font-size: 36px;
    }
    &:last-child{
      background-color: $fontWarn;
    }
  }
}

.Admin_under{
  display: flex;
  flex-direction: column;
  gap: $spacing-5;
  padding-right: 25px;
  .Admin_underItem{
    border: 1px solid $primaryGreen;
    border-top: 5px solid $primaryGreen;
    p{
      padding: 20px 10px;
      border-bottom: 1px solid $primaryGreen;
      span{
        font-size: 24px;
        display: inline-block;
        padding-left: $spacing-5;
      }
    }
  }
  .rtg{
    height: 300px;
    background-color: #ccc;
  }
}
</style>
