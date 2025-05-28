<template>
<div class="memWrap">
        <h2>展覽贊助記錄</h2>
<div class="sponsorship-history">
    <div class="sponsorship-list">
      <div class="sponsorship-header">
        <div class="header-item exhibition-name-col">贊助展覽名稱</div>
        <div class="header-item sponsor-amount-col">贊助金額</div>
        <div class="header-item sponsor-time-col">贊助時間</div>
        <div class="header-item sponsor-status-col">狀態</div>
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
          <div class="row-item sponsor-status-col">
            <span :class="['status-tag', getStatusTagClass(record.status)]">
              {{ record.status }}
            </span>
          </div>
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
    // 實際應用中，會是類似 axios.get('/api/member/sponsorship-history') 的請求
    // 這裡使用 setTimeout 模擬非同步請求延遲
    setTimeout(() => {
      const fetchedRecords = [
        {
          id: 'SP001', // 紀錄的唯一 ID
          exhibitionId: 'EXH001', // 展覽的 ID，用於點擊後跳轉到展覽詳情頁
          exhibitionName: '《靜界焰光》',
          sponsorAmount: 1500,
          sponsorTime: '2025-05-15T10:00:00Z', // 後端傳來的日期時間通常是 ISO 格式
          status: '已完成'
        },
        {
          id: 'SP002',
          exhibitionId: 'EXH002',
          exhibitionName: '《奇幻森林之旅》',
          sponsorAmount: 500,
          sponsorTime: '2025-04-20T14:30:00Z',
          status: '已完成'
        },
        {
          id: 'SP003',
          exhibitionId: 'EXH003',
          exhibitionName: '《城市光影交響》',
          sponsorAmount: 200,
          sponsorTime: '2025-05-25T08:00:00Z',
          status: '處理中' // 模擬待處理的贊助
        },
        // 可以添加更多模擬贊助紀錄
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
    second: '2-digit',
    hour12: false
  }).format(date);
};

// 根據贊助狀態返回對應的 CSS class
const getStatusTagClass = (status) => {
  switch (status) {
    case '已完成':
      return 'status-completed';
    case '處理中':
      return 'status-processing';
    case '已退款':
      return 'status-refunded';
    case '已取消':
      return 'status-cancelled';
    default:
      return '';
  }
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
  max-width: 900px;
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

/* 根據項目內容調整列寬 */
.exhibition-name-col {
  flex: 2; /* 展覽名稱佔據較大空間 */
  justify-content: flex-start; /* 內容靠左對齊 */
  padding-left: 20px;
}

.sponsor-amount-col {
  flex: 0 0 120px; /* 贊助金額 */
}

.sponsor-time-col {
  flex: 0 0 180px; /* 贊助時間 */
}

.sponsor-status-col {
  flex: 0 0 100px; /* 狀態 */
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

.exhibition-link {
  color: #007bff;
  text-decoration: none;
  font-weight: bold;
  transition: color 0.3s ease;
}

.exhibition-link:hover {
  color: #0056b3;
  text-decoration: underline;
}

.amount {
  color: #007bff;
  font-weight: bold;
}

.status-tag {
  display: inline-block;
  padding: 5px 10px;
  border-radius: 4px;
  color: white;
  font-size: 14px;
  font-weight: bold;
}

.status-completed {
  background-color: #28a745; /* 綠色 */
}

.status-processing {
  background-color: #007bff; /* 藍色 */
}

.status-refunded {
  background-color: #6c757d; /* 灰色 */
}

.status-cancelled {
  background-color: #dc3545; /* 紅色 */
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