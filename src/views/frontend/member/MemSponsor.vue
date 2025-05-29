<template>
  <div class="memWrap">
    <h2>展覽贊助記錄</h2>
    <div class="exhibition-details">
      <div class="detail-table">
        <div class="detail-row">
          <div class="detail-label">贊助展覽名稱</div>
          <div class="detail-value">{{ sponsorData.exhibitionName }}</div>
        </div>

        <div class="detail-row">
          <div class="detail-label">贊助金額</div>
          <div class="detail-value amount">{{ formatCurrency(sponsorData.amount) }}</div>
        </div>

        <div class="detail-row">
          <div class="detail-label">贊助時間</div>
          <div class="detail-value">{{ sponsorData.date }}</div>
        </div>
      </div>


      <p class="note">
        *贊助記錄僅供查閱，如有疑問請聯繫客服。
      </p>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

// 贊助資料的響應式變數
const sponsorData = ref({
  exhibitionName: '',
  amount: 0,
  date: '',
});

onMounted(() => {
  fetchSponsorData();
});

// 模擬 API 撈取資料
const fetchSponsorData = () => {
  setTimeout(() => {
    sponsorData.value = {
      exhibitionName: '《微光中的浪潮》',
      amount: 1680,
      date: '2025-05-15 14:35',
    };
  }, 0);
};

// 貨幣格式化函數
const formatCurrency = (amount) => {
  return new Intl.NumberFormat('zh-TW', {
    style: 'currency',
    currency: 'TWD',
    minimumFractionDigits: 0
  }).format(amount);
};
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

    @media (max-width: 1200px) {
      font-size: map-get($font, h3);
    }
  }
}

.exhibition-details {
  max-width: 700px;
  margin: 40px auto;
  padding: 30px;
  background-color: #ffffff;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  text-align: center;

  @media (max-width: 1200px) {
    padding: 20px;
  }
}

.detail-table {
  border: 1px solid #e0e0e0;
  border-radius: 6px;
  overflow: hidden;
  margin-bottom: 20px;
}

.detail-row {
  display: flex;
  border-bottom: 1px solid #eee;

  @media (max-width: 1200px) {
    flex-direction: column;
  }
}

.detail-row:last-child {
  border-bottom: none;
}

.detail-label,
.detail-value {
  padding: 15px 20px;
  font-size: 16px;
  text-align: left;

  @media (max-width: 1200px) {
    text-align: center;
  }
}

.detail-label {
  flex: 0 0 150px;
  background-color: #f8f8f8;
  color: #666;
  font-weight: bold;
  border-right: 1px solid #e0e0e0;

  @media (max-width: 1200px) {
    flex: 0;
  }
}

.detail-value {
  flex: 1;
  color: #333;
  background-color: #fff;
  word-break: break-word;
}

.detail-value.amount {
  color: #007bff;
  font-weight: bold;
}

.note {
  font-size: 14px;
  color: #777;
  text-align: left;
  padding: 0 20px;

  @media (max-width: 1200px) {
    text-align: center;
  }
}
</style>
