<template>
  <div class="memWrap">
    <h2>個人展覽資訊</h2>
    <div v-if="exhibitionData" v-for="exhibitionData in exhibitionData" class="exhibition-details">
      <div class="detail-table">
        <div class="detail-row">
          <div class="detail-label">展覽名稱</div>
          <div class="detail-value">{{ exhibitionData.expo_name }}</div>
        </div>

        <div class="detail-row">
          <div class="detail-label">展出開始日期</div>
          <div class="detail-value">{{ exhibitionData.start }}</div>
        </div>

        <div class="detail-row">
          <div class="detail-label">展出結束日期</div>
          <div class="detail-value">{{ exhibitionData.end }}</div>
        </div>

        <div class="detail-row">
          <div class="detail-label">狀態</div>
          <div class="detail-value">{{ getStatusLabel(exhibitionData.status) }}</div>
        </div>

        <div class="detail-row">
          <div class="detail-label">已獲得贊助</div>
          <div class="detail-value amount">NT$ {{ exhibitionData.total_donation }}</div>
        </div>
      </div>
      <div>
          <p class="note">*贊助金額將會在展期結束後結算，並匯款到您的帳戶。</p>
      </div>
    </div>
    <div v-else>
      <p>尚無展覽資料</p>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useUserStore } from '@/stores/user'
import axios from 'axios'

const userStore = useUserStore()
const exhibitionData = ref(null)

onMounted(async () => {
  if (userStore.isArtistMember && userStore.decodedMemberId) {
    const artistId = userStore.decodedMemberId

    try {
      // const { data } = await axios.get(`http://localhost/TIBAART/getMemExpo.php?id=${artistId}`)
      const baseUrl = import.meta.env.VITE_GetMemExpo
      const { data } = await axios.get(`${baseUrl}/getMemExpo.php`, {
      params: { id: artistId }
      })

      console.log('展覽資料：', data)
      if (Array.isArray(data) && data.length > 0) {
        exhibitionData.value = data
      }
    } catch (error) {
      console.error('取得展覽資料失敗:', error)
    }
  } else {
    console.warn('不是藝術家會員或找不到 ID')
  }
})

// 狀態轉換
const getStatusLabel = (status) => {
  switch (status) {
    case 'expoOn':
      return '展覽中'
    case 'expoOff':
      return '未開展'
    case 'expoExit':
      return '已撤展'
    default:
      return '未知狀態'
  }
}
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

    @media (max-width: 1200px){
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

  @media (max-width:1200px){
    padding:20px;
  }


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

  @media (max-width:1200px){
    flex-direction: column;
  }

}

.detail-row:last-child {
  border-bottom: none; /* 最後一行不要底線 */
}

.detail-label,
.detail-value {
  padding: 15px 20px;
  font-size: 16px;
  text-align: left;
  @media (max-width:1200px){
    text-align: center;
  }
}

.detail-label {
  flex: 0 0 150px; /* 固定標籤寬度 */
  background-color: #f8f8f8;
  color: #666;
  font-weight: bold;
  border-right: 1px solid #e0e0e0;

  @media (max-width:1200px){
    flex: 0;

  }

}

.detail-value {
  flex: 1; /* 值佔據剩餘空間 */
  color: #333;
  background-color: #fff;
  word-break: break-word; /* 防止長文字溢出 */
}

.detail-value.amount {
  color: $logoYellow;
  font-weight: bold;
}

.note {
  font-size: 14px;
  color: #777;
  text-align: left; /* 備註靠左對齊 */
  padding: 0 20px; /* 與表格對齊 */

  @media (max-width:1200px){
    text-align: center;
  }

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