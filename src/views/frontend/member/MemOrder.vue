<template>
  <div class="mem-wrap">
    <h2>商城訂單追蹤</h2>

    <div class="order-history">
      <!-- Loading State -->
      <div v-if="loading" class="loading-container">
        <div class="spinner"></div>
        <p class="loading-message">載入訂單資料中...</p>
      </div>

      <!-- No Orders State -->
      <div v-else-if="orders.length === 0" class="no-orders-message">
        <div class="empty-icon">📦</div>
        <p>目前沒有訂單記錄</p>
      </div>

      <!-- Orders List -->
      <div v-else class="order-list">
      <div class="order-list">

        <!-- Desktop Table View -->
        <div class="desktop-view">
          <div class="order-header">
            <div class="header-item order-id-col">訂單編號</div>
            <div class="header-item order-content-col">訂單內容</div>
            <div class="header-item order-amount-col">訂單金額</div>
            <div class="header-item order-time-col">訂購時間</div>
            <div class="header-item order-status-col">處理狀態</div>
          </div>

          <div class="order-body">
            <div v-for="order in orders" :key="order.orderId" class="order-row">
              <div class="row-item order-id-col">{{ order.orderId }}</div>
              <div class="row-item order-content-col">
                <div v-for="(item, index) in order.items" :key="index" class="order-item-detail">
                  <p class="item-name">{{ item.name }}</p>
                  <!-- <p class="item-spec">規格: {{ item.spec }} 數量: {{ item.quantity }}</p> -->
                  <p class="item-spec"> 數量: {{ item.quantity }}</p>
                </div>
              </div>
              <div class="row-item order-amount-col amount">{{ formatCurrency(order.orderAmount) }}</div>
              <div class="row-item order-time-col">{{ formatDate(order.orderTime) }}</div>
              <div class="row-item order-status-col">
                <span :class="['status-tag', getStatusTagClass(order.status)]">
                  {{ order.status }}
                </span>
              </div>
            </div>
          </div>
        </div>

        <!-- Mobile Card View -->
        <div class="mobile-view">
          <div v-for="order in orders" :key="order.orderId" class="order-card">
            <div class="card-header">
              <div class="order-id">
                <span class="label">訂單編號</span>
                <span class="value">{{ order.orderId }}</span>
              </div>
              <span :class="['status-tag', getStatusTagClass(order.status)]">
                {{ getStatusText(order.status) }}
              </span>
            </div>
            
            <div class="card-content">
              <div class="order-items">
                <div class="label">訂單內容</div>
                <div v-for="(item, index) in order.items" :key="index" class="order-item-detail">
                  <p class="item-name">{{ item.name }}</p>
                  <!-- <p class="item-spec">規格: {{ item.spec }} 數量: {{ item.quantity }}</p> -->
                  <p class="item-spec">數量: {{ item.quantity }}</p>
                </div>
              </div>
              
              <div class="order-meta">
                <div class="meta-item">
                  <span class="label">訂單金額</span>
                  <span class="value amount">{{ formatCurrency(order.orderAmount) }}</span>
                </div>
                <div class="meta-item">
                  <span class="label">訂購時間</span>
                  <span class="value">{{ formatDate(order.orderTime) }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useUserStore } from '@/stores/user'


// 響應式資料
const orders = ref([])
const loading = ref(true)
const userStore = useUserStore()

// 組件掛載後執行
onMounted(async () => {
  await fetchOrders()
})

// 獲取訂單資料
const fetchOrders = async () => {
  loading.value = true
  try {
        // 檢查會員是否登入且有會員 ID
    if (!userStore.isLoggedIn || !userStore.decodedMemberId) {
      alert('請先登入以查看訂單。')
      orders.value = [] // 清空訂單
      return
    }

    const memberId = userStore.decodedMemberId // 獲取已解碼的會員 ID
    
    const response = await fetch(import.meta.env.VITE_GetMemberOrders, {
    // const response = await fetch('https://tibamef2e.com/tjd101/g2/api/getMemberOrders.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        member_id: memberId
      })
    })

    const result = await response.json()

     console.log('後端原始回應 (result):', result);
    console.log('後端原始回應中的第一個訂單 (result.orders[0]):', result.orders[0]);
    
    if (result.success) {
      orders.value = result.orders

      if (orders.value.length > 0) {
        console.log('第一個訂單的 items 陣列:', orders.value[0].items);
        console.log('第一個訂單的 items 陣列類型:', typeof orders.value[0].items);
        console.log('第一個訂單的 items 陣列長度:', orders.value[0].items.length);
      }   
    } else {
      console.error('獲取訂單資料失敗:', result.message)
      alert(`載入訂單失敗: ${result.message}`)
      orders.value = [] // 載入失敗時清空訂單
    }
    // 模擬 API 請求延遲
    // await new Promise(resolve => setTimeout(resolve, 1000))
    // await new Promise(resolve => setTimeout(resolve, 0))
    
    // const fetchedOrders = [
    //   {
    //     orderId: '123456789',
    //     items: [
    //       { name: '緯藝 A4 資料夾', spec: '紅', quantity: 1 },
    //       { name: '緯藝 吉祥物立牌', spec: '紅', quantity: 1 }
    //     ],
    //     orderAmount: 2046,
    //     orderTime: '2025-05-01 00:00',
    //     status: '已出貨'
    //   },
    //   {
    //     orderId: '987654321',
    //     items: [
    //       { name: '緯藝 A4 資料夾', spec: '紅', quantity: 1 }
    //     ],
    //     orderAmount: 785,
    //     orderTime: '2025-05-01 00:00',
    //     status: '未出貨'
    //   },
    //   {
    //     orderId: '112233445',
    //     items: [
    //       { name: '限定版紀念徽章', spec: '藍', quantity: 2 }
    //     ],
    //     orderAmount: 500,
    //     orderTime: '2025-05-02 10:30',
    //     status: '處理中'
    //   }
    // ]
    
    // orders.value = fetchedOrders
  } catch (error) {
    console.error('獲取訂單資料失敗:', error)
    // 可以使用 toast 通知或其他 UI 組件來顯示錯誤
    alert('載入訂單失敗，請稍後再試。')
  } finally {
    loading.value = false
  }
}

// 格式化貨幣
const formatCurrency = (amount) => {
  return new Intl.NumberFormat('zh-TW', {
    style: 'currency',
    currency: 'TWD',
    minimumFractionDigits: 0
  }).format(amount)
}

// 格式化日期
const formatDate = (dateString) => {
  const date = new Date(dateString)
  return date.toLocaleDateString('zh-TW', {
    year: 'numeric',
    month: '2-digit',
    day: '2-digit',
    hour: '2-digit',
    minute: '2-digit',
    hour12: false,
  })
}

// 獲取狀態樣式類別
const getStatusTagClass = (status) => {
  const statusMap = {
    'pending': 'status-pending',
    'confirmed': 'status-confirmed',
    'shipped': 'status-shipped',
    'delivered': 'status-delivered',
    'cancelled': 'status-cancelled'
  }
  return statusMap[status] || ''
}


const getStatusText = (status) => {
  const textMap = {
    'pending': '處理中',
    'confirmed': '已確認',
    'shipped': '已出貨',
    'delivered': '已送達',
    'cancelled': '已取消'
  }
  return textMap[status] || status
}


</script>

<style lang="scss" scoped>
@import '/style.scss';

// 變數定義

$danger-color: #dc3545;
$gray-100: #f8f9fa;
$gray-200: #e9ecef;
$gray-300: #dee2e6;
$gray-500: #6c757d;
$gray-700: #495057;
$gray-900: #212529;

// Breakpoints
$mobile: 810px;
$tablet: 1024px;

.mem-wrap {
  padding: 40px;
  min-height: 100vh;

  @media (min-width: $mobile) {
    padding: 40px 20px;
  }

  h2 {
    font-size: map-get($font, h2);
    font-weight: bold;
    text-align: center;

    @media (max-width: 1200px) {
      font-size: map-get($font, h3);
    }
  }
}

.order-history {
  max-width: 1200px;
  margin: 40px auto;
  background: white;
  border-radius: 12px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  overflow: hidden;

  @media (min-width: $mobile) {
    padding: 30px;
  }
}

// Loading State
.loading-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 60px 20px;
}

.spinner {
  width: 40px;
  height: 40px;
  border: 4px solid $gray-200;
  border-left-color: $logoOrange;
  border-radius: 50%;
  animation: spin 1s linear infinite;
  margin-bottom: 20px;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.loading-message {
  color: $gray-500;
  font-size: 16px;
  margin: 0;
}

// No Orders State
.no-orders-message {
  text-align: center;
  padding: 60px 20px;
  color: $gray-500;

  .empty-icon {
    font-size: 48px;
    margin-bottom: 16px;
  }

  p {
    font-size: 18px;
    margin: 0;
  }
}

// Desktop View
.desktop-view {
  display: none;

  @media (min-width: $mobile) {
    display: block;
  }
}

.order-list {
  border: 1px solid $gray-300;
  border-radius: 8px;
  overflow: hidden;
}

.order-header,
.order-row {
  display: flex;
  align-items: stretch;
  border-bottom: 1px solid $gray-200;
}

.order-header {
  background: $gray-100;
  font-weight: 600;
  color: $gray-700;
  font-size: 14px;
  padding: 0;

  @media (min-width: $tablet) {
    font-size: 15px;
  }
}

.order-row {
  transition: background-color 0.2s ease;

  &:hover {
    background-color: rgba($logoOrange, 0.02);
  }

  &:last-child {
    border-bottom: none;
  }
}

.header-item,
.row-item {
  padding: 12px 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  box-sizing: border-box;
  border-right: 1px solid $gray-200;

  @media (min-width: $tablet) {
    padding: 15px 12px;
  }

  &:last-child {
    border-right: none;
  }
}

// Column Widths
.order-id-col {
  flex: 0 0 80px;
  
  @media (min-width: $tablet) {
    flex: 0 0 120px;
  }
}

.order-content-col {
  flex: 1;
  justify-content: flex-start;
  padding-left: 15px;
  min-width: 200px;

  @media (min-width: $tablet) {
    flex: 2;
    padding-left: 20px;
  }
}

.order-amount-col {
  flex: 0 0 80px;
  
  @media (min-width: $tablet) {
    flex: 0 0 100px;
  }
}

.order-time-col {
  flex: 0 0 150px;
  
  @media (min-width: $tablet) {
    flex: 0 0 140px;
  }
}

.order-status-col {
  flex: 0 0 80px;
  
  @media (min-width: $tablet) {
    flex: 0 0 100px;
  }
}

.row-item {
  color: $gray-900;
  font-size: 13px;
  background: white;

  @media (min-width: $tablet) {
    font-size: 14px;
  }
}

.order-item-detail {
  width: 100%;
  text-align: left;

  .item-name {
    margin: 0 0 4px 0;
    font-weight: 600;
    font-size: 13px;
    line-height: 1.3;

    @media (min-width: $tablet) {
      font-size: 14px;
    }
  }

  .item-spec {
    margin: 0;
    font-size: 12px;
    color: $gray-500;
    line-height: 1.2;

    @media (min-width: $tablet) {
      font-size: 13px;
    }
  }
}

// Mobile View
.mobile-view {
  display: block;
  padding: 15px;

  @media (min-width: $mobile) {
    display: none;
  }
}

.order-card {
  background: white;
  border: 1px solid $gray-200;
  border-radius: 12px;
  margin-bottom: 16px;
  overflow: hidden;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
  transition: transform 0.2s ease, box-shadow 0.2s ease;

  &:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
  }

  &:last-child {
    margin-bottom: 0;
  }
}

.card-header {
  background: $gray-100;
  padding: 16px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid $gray-200;
}

.order-id {
  display: flex;
  flex-direction: column;

  .label {
    font-size: 12px;
    color: $gray-500;
    margin-bottom: 4px;
  }

  .value {
    font-size: 16px;
    font-weight: 600;
    color: $gray-900;
  }
}

.card-content {
  padding: 16px;
}

.order-items {
  margin-bottom: 16px;

  .label {
    font-size: 14px;
    color: $gray-700;
    font-weight: 600;
    margin-bottom: 8px;
  }

  .order-item-detail {
    margin-bottom: 8px;

    &:last-child {
      margin-bottom: 0;
    }

    .item-name {
      margin: 0 0 4px 0;
      font-weight: 600;
      font-size: 15px;
      color: $gray-900;
    }

    .item-spec {
      margin: 0;
      font-size: 13px;
      color: $gray-500;
    }
  }
}

.order-meta {
  display: flex;
  justify-content: space-between;
  gap: 16px;
}

.meta-item {
  display: flex;
  flex-direction: column;
  flex: 1;

  .label {
    font-size: 12px;
    color: $gray-500;
    margin-bottom: 4px;
  }

  .value {
    font-size: 14px;
    font-weight: 600;
    color: $gray-900;

    &.amount {
      color: $logoDGreen;
      font-size: 16px;
    }
  }
}

// Status Tags
.status-tag {
  display: inline-block;
  padding: 6px 12px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 600;
  text-align: center;
  white-space: nowrap;

  @media (min-width: $mobile) {
    font-size: 13px;
  }
}

.status-shipped {
  background: $logoGreen;
  color: white;
}

.status-pending {
  background: $logoYellow;
  color: $fontWhite;
}

.status-confirmed {
  background: $logoDGreen;
  color: white;
}

.status-cancelled {
  background: $danger-color;
  color: white;
}

.status-delivered {
  background: $logoBlue;
  color: white;
}

.amount {
  color: $logoDGreen;
  font-weight: bold;
}
</style>