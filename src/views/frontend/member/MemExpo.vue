<template>
 <div class="memWrap">
        <h2>個人展覽資訊</h2>
    <div class="exhibition-details">
     <div class="detail-table">
      <div class="detail-row">
        <div class="detail-label">展覽名稱</div>
        <div class="detail-value">{{ exhibitionData.exhibitionName }}</div>
      </div>

      <div class="detail-row">
        <div class="detail-label">創作者名</div>
        <div class="detail-value">{{ exhibitionData.creatorName }}</div>
      </div>

      <div class="detail-row">
        <div class="detail-label">帳戶</div>
        <div class="detail-value">{{ exhibitionData.account }}</div>
      </div>

      <div class="detail-row">
        <div class="detail-label">展出日期</div>
        <div class="detail-value">{{ exhibitionData.exhibitionDates }}</div>
      </div>

      <div class="detail-row">
        <div class="detail-label">狀態</div>
        <div class="detail-value">{{ exhibitionData.status }}</div>
      </div>

      <div class="detail-row">
        <div class="detail-label">已獲贊助金額*</div>
        <div class="detail-value amount">{{ formatCurrency(exhibitionData.sponsoredAmount) }}</div>
      </div>
    </div>

    <p class="note">
      *贊助金額將會在展期結束後結算，並匯款到您填寫的上述帳戶。
    </p>

    </div>

 </div>

</template>

<script setup>
import { ref, onMounted } from 'vue';

// 使用 ref 建立響應式資料物件，用於綁定展覽資訊
const exhibitionData = ref({
  exhibitionName: '',
  creatorName: '',
  account: '',
  exhibitionDates: '',
  status: '',
  sponsoredAmount: 0 // 初始化為數字，方便格式化
});

// onMounted 是一個生命週期鉤子，組件掛載後會執行
onMounted(() => {
  // 在這裡模擬從後端 API 撈取個人展覽資料
  fetchExhibitionData();
});

// 模擬從後端獲取展覽資料的函數
const fetchExhibitionData = async () => {
  try {
    // 實際應用中，會是類似 axios.get('/api/member/exhibition') 的請求
    // 這裡使用 setTimeout 模擬非同步請求延遲
    setTimeout(() => {
      const fetchedExhibition = {
        exhibitionName: '《靜界焰光》',
        creatorName: '艾莉亞',
        account: 'XXX-XXX-XXX',
        exhibitionDates: '2025-05-12~2025-08-12',
        status: '展覽中',
        sponsoredAmount: 2880
      };
      // 將撈到的資料賦值給 exhibitionData
      exhibitionData.value = fetchedExhibition;
    }, 0); 
  } catch (error) {
    console.error('獲取展覽資料失敗:', error);
    // 可以在這裡處理錯誤，例如顯示錯誤訊息給用戶
  }
};

// 格式化貨幣的函數
const formatCurrency = (amount) => {
  // 使用 Intl.NumberFormat 進行國際化數字格式化
  return new Intl.NumberFormat('zh-TW', {
    style: 'currency',
    currency: 'TWD', // 台灣新台幣
    minimumFractionDigits: 0 // 不顯示小數點，如果您的金額沒有小數
  }).format(amount);
};

// 如果未來需要編輯功能，可以啟用此函數
// const editExhibition = () => {
//   // 導向編輯頁面或顯示編輯表單
//   console.log('編輯展覽資訊');
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

.exhibition-details {
  max-width: 700px;
  margin: 40px auto;
  padding: 30px;
  background-color: #ffffff;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  text-align: center;
}

h2 {
  color: #333;
  margin-bottom: 30px;
  font-size: 28px;
}

.detail-table {
  border: 1px solid #e0e0e0;
  border-radius: 6px;
  overflow: hidden; /* 確保圓角生效 */
  margin-bottom: 20px;
}

.detail-row {
  display: flex;
  border-bottom: 1px solid #eee;
}

.detail-row:last-child {
  border-bottom: none; /* 最後一行不要底線 */
}

.detail-label,
.detail-value {
  padding: 15px 20px;
  font-size: 16px;
  text-align: left;
}

.detail-label {
  flex: 0 0 150px; /* 固定標籤寬度 */
  background-color: #f8f8f8;
  color: #666;
  font-weight: bold;
  border-right: 1px solid #e0e0e0;
}

.detail-value {
  flex: 1; /* 值佔據剩餘空間 */
  color: #333;
  background-color: #fff;
  word-break: break-word; /* 防止長文字溢出 */
}

.detail-value.amount {
  color: #007bff; /* 贊助金額可以特別顏色 */
  font-weight: bold;
}

.note {
  font-size: 14px;
  color: #777;
  text-align: left; /* 備註靠左對齊 */
  padding: 0 20px; /* 與表格對齊 */
}

/* 如果未來啟用編輯按鈕的樣式 */
/*
.btn {
  padding: 12px 20px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 6px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  margin-top: 20px;
}

.btn:hover {
  background-color: #0056b3;
}
*/


</style>