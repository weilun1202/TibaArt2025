<template>
<div class="memWrap">
        <h2>展覽贊助記錄</h2>
<div class="sponsorship-history">
    <div class="sponsorship-table">
      <div class="sponsorship-header">
        <div class="header-item exhibition-name-col">贊助展覽名稱</div>
        <div class="header-item sponsor-amount-col">贊助金額</div>
        <div class="header-item sponsor-time-col">贊助時間</div>
      </div>

      <div v-if="loading" class="loading-message">
        <div class="spinner"></div>
        載入中...
      </div>

      <div v-else-if="sponsorshipRecords.length === 0" class="no-records-message">
        目前沒有任何贊助紀錄。
      </div>

      <div v-else class="sponsorship-body">
        <div v-for="record in sponsorshipRecords" :key="record.id" class="sponsorship-row">
          <div class="row-item exhibition-name-col">
            <router-link :to="{ name: 'ExhibitionDetail', params: { id: record.exhibitionId } }" class="exhibition-link">
              {{ record.exhibitionName }}
            </router-link>
          </div>
          <div class="row-item sponsor-amount-col amount">{{ formatCurrency(record.sponsorAmount) }}</div>
          <div class="row-item sponsor-time-col">{{ formatDateTime(record.sponsorTime) }}</div>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
// 如果您未來會使用 Vue Router 進行跳轉，可以取消註釋下面這行
// import { useRouter } from 'vue-router';

// 使用 ref 建立響應式資料，用於儲存贊助紀錄列表
const sponsorshipRecords = ref([]);
const loading = ref(true); // 控制載入狀態

// 如果您未來會使用 Vue Router 進行跳轉，可以取消註釋下面這行
// const router = useRouter();

// onMounted 是一個生命週期鉤子，組件掛載後會執行
onMounted(() => {
  // 在這裡模擬從後端 API 撈取贊助紀錄
  fetchSponsorshipRecords();
});

// 模擬從後端獲取贊助紀錄的函數
const fetchSponsorshipRecords = async () => {
  loading.value = true; // 開始載入時顯示載入狀態
  try {
    // 實際應用中，會是類似 axios.get('/api/member/sponsorship-records') 的請求
    // 這裡使用 setTimeout 模擬非同步請求延遲
    setTimeout(() => {
      const fetchedRecords = [
        {
          id: 'SP001', // 紀錄的唯一 ID
          exhibitionId: 'EXH001', // 展覽的 ID，用於點擊後跳轉到展覽詳情頁
          exhibitionName: '《靜界焰光》',
          sponsorAmount: 1500,
          sponsorTime: '2025-05-01T00:00:00Z', // 後端傳來的日期時間通常是 ISO 格式
        },
        // 根據圖片，暫時只顯示一條記錄，您可以自行添加更多
        // {
        //   id: 'SP002',
        //   exhibitionId: 'EXH002',
        //   exhibitionName: '《奇幻森林之旅》',
        //   sponsorAmount: 800,
        //   sponsorTime: '2025-04-25T14:30:00Z',
        // },
      ];
      sponsorshipRecords.value = fetchedRecords;
    }, 800); // 模擬 800ms 延遲
  } catch (error) {
    console.error('獲取贊助紀錄失敗:', error);
    // 可以在這裡處理錯誤，例如顯示錯誤訊息給用戶
    alert('載入贊助紀錄失敗，請稍後再試。');
  } finally {
    loading.value = false; // 載入完成或失敗後隱藏載入狀態
  }
};

// 格式化貨幣的函數
const formatCurrency = (amount) => {
  return new Intl.NumberFormat('zh-TW', {
    style: 'currency',
    currency: 'TWD',
    minimumFractionDigits: 0
  }).format(amount);
};

// 格式化日期時間的函數
const formatDateTime = (dateTimeString) => {
  // 將 ISO 字符串轉換為 Date 物件
  const date = new Date(dateTimeString);
  return new Intl.DateTimeFormat('zh-TW', {
    year: 'numeric',
    month: '2-digit',
    day: '2-digit',
    hour: '2-digit',
    minute: '2-digit',
    hour12: false // 24小時制
  }).format(date);
};

// 如果需要點擊展覽名稱跳轉到展覽詳情頁
// const goToExhibitionDetail = (exhibitionId) => {
//   router.push({ name: 'ExhibitionDetail', params: { id: exhibitionId } });
// };


</script>

<style lang="scss" scoped>
@import '/style.scss';

.memWrap{

    padding-top: 40px;
    text-align: center;


    h2{
        font-size: map-get($font, h2);
        font-weight: bold;
        text-align: center;
    }
}

.sponsorship-history {
  max-width: 700px; /* 調整最大寬度以符合圖片 */
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

.sponsorship-table {
  border: 1px solid #e0e0e0;
  border-radius: 6px;
  overflow: hidden;
  font-size: 15px; /* 調整字體大小 */
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

/* 根據圖片調整列寬 */
.exhibition-name-col {
  flex: 2; /* 展覽名稱佔據較大空間 */
  justify-content: flex-start; /* 內容靠左對齊 */
  padding-left: 20px;
}

.sponsor-amount-col {
  flex: 1; /* 贊助金額 */
}

.sponsor-time-col {
  flex: 1.2; /* 贊助時間 */
}

.row-item {
  color: #333;
  background-color: #fff;
  border-right: 1px solid #eee;
}

.row-item:last-child {
  border-right: none;
}

.exhibition-link {
  color: #333; /* 預設顏色，與圖片接近 */
  text-decoration: none;
  font-weight: normal; /* 與圖片接近 */
  transition: color 0.3s ease;
}

.exhibition-link:hover {
  color: #007bff; /* hover 時可有藍色提示 */
  text-decoration: underline;
}

.amount {
  color: #333; /* 金額顏色與圖片接近 */
  font-weight: normal; /* 金額字體與圖片接近 */
}

/* 載入中和無資料訊息 */
.loading-message,
.no-records-message {
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