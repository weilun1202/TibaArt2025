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
      <p>商品出售總收益<span>$9999999999</span></p>
      <div class="rtg"></div>
    </div>
  
    <div class="Admin_donateWarp">
      <p>贊助抽成總收益<span>$9999999999</span></p>
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
  background-color: $logoColor4;
  color: #fff;
  margin-bottom: $spacing-5;
  p{
    padding: $spacing-4;
  }
  span{
    display: block;
    font-size: 36px;
    text-align: center;
  }
}
.Admin_orderWarp{
  width: 200px;
  height: 200px;
  background-color: $fontWarn;
  color: #fff;
  margin-bottom: $spacing-5;
  p{
    padding: $spacing-4;
  }
  span{
    display: block;
    font-size: 36px;
    text-align: center;
  }
}

.Admin_under{
  display: flex;
  gap: $spacing-5;
  .productSumWarp{
    border: 1px solid $primaryGreen;
    border-top: 5px solid $primaryGreen;
    p{
      padding: 20px 10px;
      border-bottom: 1px solid $primaryGreen;
      span{
        font-size: 24px;
      }
    }
  }

  .Admin_donateWarp{
    border: 1px solid $primaryGreen;
    border-top: 5px solid $primaryGreen;
    p{
      padding: 20px 10px;
      border-bottom: 1px solid $primaryGreen;
      span{
        font-size: 24px;
      }
    }
  }
  .rtg{
    width: 600px;
    height: 200px;
    background-color: #ccc;
  }
}
</style>
