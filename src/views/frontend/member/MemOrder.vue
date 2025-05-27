<template>
<div class="memWrap">
        <h2>商城訂單追蹤</h2>

    <div class="order-history">   
     <div class="order-list">
      <div class="order-header">
        <div class="header-item order-id-col">訂單編號</div>
        <div class="header-item order-content-col">訂單內容</div>
        <div class="header-item order-amount-col">訂單金額</div>
        <div class="header-item order-time-col">訂購時間</div>
        <div class="header-item order-status-col">處理狀態</div>
      </div>

      <div v-if="loading" class="loading-message">
        <div class="spinner"></div>
        載入中...
      </div>

      <div v-else-if="orders.length === 0" class="no-orders-message">
        目前沒有任何訂單。
      </div>

      <div v-else class="order-body">
        <div v-for="order in orders" :key="order.orderId" class="order-row">
          <div class="row-item order-id-col">{{ order.orderId }}</div>
          <div class="row-item order-content-col">
            <div v-for="(item, index) in order.items" :key="index" class="order-item-detail">
              <p class="item-name">{{ item.name }}</p>
              <p class="item-spec">規格: {{ item.spec }} 數量: {{ item.quantity }}</p>
            </div>
          </div>
          <div class="row-item order-amount-col amount">{{ formatCurrency(order.orderAmount) }}</div>
          <div class="row-item order-time-col">{{ order.orderTime }}</div>
          <div class="row-item order-status-col">
            <span :class="['status-tag', getStatusTagClass(order.status)]">
              {{ order.status }}
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

// 使用 ref 建立響應式資料，用於儲存訂單列表
const orders = ref([]);
const loading = ref(true); // 控制載入狀態

// onMounted 是一個生命週期鉤子，組件掛載後會執行
onMounted(() => {
  // 在這裡模擬從後端 API 撈取訂單列表
  fetchOrders();
});

// 模擬從後端獲取訂單資料的函數
const fetchOrders = async () => {
  loading.value = true; // 開始載入時顯示載入狀態
  try {
    // 實際應用中，會是類似 axios.get('/api/member/orders') 的請求
    // 這裡使用 setTimeout 模擬非同步請求延遲
    setTimeout(() => {
      const fetchedOrders = [
        {
          orderId: '123456789',
          items: [
            { name: '緯藝 A4 資料夾', spec: '紅', quantity: 1 },
            { name: '緯藝 吉祥物立牌', spec: '紅', quantity: 1 }
          ],
          orderAmount: 2046,
          orderTime: '2025-05-01 00:00',
          status: '已出貨'
        },
        {
          orderId: '987654321', // 假設有第二筆訂單
          items: [
            { name: '緯藝 A4 資料夾', spec: '紅', quantity: 1 }
          ],
          orderAmount: 785,
          orderTime: '2025-05-01 00:00',
          status: '尚未出貨'
        },
        // 可以添加更多模擬訂單
        // {
        //   orderId: '112233445',
        //   items: [
        //     { name: '限定版紀念徽章', spec: '藍', quantity: 2 }
        //   ],
        //   orderAmount: 500,
        //   orderTime: '2025-05-02 10:30',
        //   status: '處理中'
        // }
      ];
      orders.value = fetchedOrders;
    }, 800); // 模擬 800ms 延遲
  } catch (error) {
    console.error('獲取訂單資料失敗:', error);
    // 可以在這裡處理錯誤，例如顯示錯誤訊息給用戶
    alert('載入訂單失敗，請稍後再試。');
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

// 根據訂單狀態返回對應的 CSS class
const getStatusTagClass = (status) => {
  switch (status) {
    case '已出貨':
      return 'status-shipped';
    case '尚未出貨':
      return 'status-pending';
    case '處理中':
      return 'status-processing';
    case '已取消':
      return 'status-cancelled';
    default:
      return '';
  }
};


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

.order-history {
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

.order-list {
  border: 1px solid #e0e0e0;
  border-radius: 6px;
  overflow: hidden;
}

.order-header,
.order-row {
  display: flex;
  align-items: stretch; /* 讓內容高度一致 */
  border-bottom: 1px solid #eee;
}

.order-header {
  background-color: #f8f8f8;
  font-weight: bold;
  color: #555;
  font-size: 15px;
  padding: 12px 0;
}

.order-row:last-child {
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

/* 根據設計稿調整列寬 */
.order-id-col {
  flex: 0 0 100px; /* 訂單編號 */
}

.order-content-col {
  flex: 3; /* 訂單內容佔據較大空間 */
  justify-content: flex-start; /* 內容靠左對齊 */
  padding-left: 20px;
}

.order-amount-col {
  flex: 0 0 100px; /* 訂單金額 */
}

.order-time-col {
  flex: 0 0 150px; /* 訂購時間 */
}

.order-status-col {
  flex: 0 0 100px; /* 處理狀態 */
}

.row-item {
  color: #333;
  font-size: 15px;
  background-color: #fff;
  border-right: 1px solid #eee; /* 每個單元格之間的垂直分割線 */
}

.row-item:last-child {
  border-right: none;
}

.order-item-detail {
  width: 100%; /* 確保訂單項在單元格內佔滿寬度 */
  text-align: left; /* 訂單內容文字靠左 */
}

.item-name {
  margin: 0 0 5px 0;
  font-weight: bold;
}

.item-spec {
  margin: 0;
  font-size: 14px;
  color: #666;
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

.status-shipped {
  background-color: #28a745; /* 綠色 */
}

.status-pending {
  background-color: #ffc107; /* 黃色 */
  color: #333; /* 黃色背景搭配深色文字 */
}

.status-processing {
  background-color: #007bff; /* 藍色 */
}

.status-cancelled {
  background-color: #dc3545; /* 紅色 */
}

/* 載入中和無資料訊息 */
.loading-message,
.no-orders-message {
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