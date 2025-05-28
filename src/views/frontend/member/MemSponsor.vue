<template>
<div class="memWrap">
      <h2>展覽贊助記錄</h2>


    <div class="sponsorship-history">   
  <div class="sponsorship-list">
    <div class="sponsorship-header">
      <div class="header-item sponsorship-name-col">贊助展覽名稱</div>
      <div class="header-item sponsorship-amount-col">贊助金額</div>
      <div class="header-item sponsorship-time-col">贊助時間</div>
    </div>

    <div class="sponsorship-body">
      <div v-for="sponsorship in sponsorships" :key="sponsorship.id" class="sponsorship-row">
        <div class="row-item sponsorship-name-col">{{ sponsorship.exhibitionName }}</div>
        <div class="row-item sponsorship-amount-col amount">{{ formatCurrency(sponsorship.amount) }}</div>
        <div class="row-item sponsorship-time-col">{{ sponsorship.time }}</div>
      </div>
    </div>
  </div>
</div>


 </div>



</template>

<script setup>
import { ref } from 'vue'

// 模擬的贊助資料
const sponsorships = ref([
  {
    id: 1,
    exhibitionName: '未來感知展 Future Senses',
    amount: 3000,
    time: '2025-05-20 14:30'
  }
])

// 格式化金額的方法
function formatCurrency(amount) {
  return new Intl.NumberFormat('zh-TW', {
    style: 'currency',
    currency: 'TWD',
    minimumFractionDigits: 0
  }).format(amount)
}

</script>


<style lang="scss" scoped>
@import '/style.scss';

.memWrap {
  padding-top: 40px;
  text-align: center;

  h2 {
    font-size: map-get($font, h2);
    font-weight: bold;
    text-align: center;
  }
}

.sponsorship-history {
  max-width: 700px;
  margin: 40px auto;
  padding: 30px;
  background-color: #ffffff;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

h2 {
  text-align: center;
  color: #333;
  margin-bottom: 30px;
  font-size: 28px;
}

.sponsorship-list {
  border: 1px solid #e0e0e0;
  border-radius: 6px;
  overflow: hidden;
}

.sponsorship-header,
.sponsorship-row {
  display: flex;
  align-items: stretch;
  border-bottom: 1px solid #eee;
}

.sponsorship-header {
  background-color: #f8f8f8;
  font-weight: bold;
  color: #555;
  font-size: 15px;
  padding: 12px 0;
}

.sponsorship-row:last-child {
  border-bottom: none;
}

.header-item,
.row-item {
  padding: 15px 10px;
  text-align: center;
  display: flex;
  align-items: center;
  justify-content: center;
  box-sizing: border-box;
}

/* 欄寬設定 */
.sponsorship-name-col {
  flex: 2; /* 展覽名稱 */
  justify-content: flex-start;
  padding-left: 20px;
}

.sponsorship-amount-col {
  flex: 0 0 120px;
}

.sponsorship-time-col {
  flex: 0 0 200px;
}

.row-item {
  color: #333;
  font-size: 15px;
  background-color: #fff;
  border-right: 1px solid #eee;
}

.row-item:last-child {
  border-right: none;
}

/* 贊助金額特殊樣式 */
.amount {
  color: #007bff;
  font-weight: bold;
}

/* 載入中與無資料樣式 */
.loading-message,
.no-sponsorships-message {
  text-align: center;
  padding: 50px 20px;
  color: #666;
  font-size: 18px;
}

.spinner {
  border: 4px solid rgba(0, 0, 0, 0.1);
  border-left-color: #007bff;
  border-radius: 50%;
  width: 30px;
  height: 30px;
  animation: spin 1s linear infinite;
  margin: 0 auto 15px auto;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}



</style>