<template>
  <div class="memWrap">
    <h2>展覽贊助記錄</h2>
    <div v-if="sponsorData" class="sponsor-details" v-for="sponsorData in sponsorData">
      <div class="detail-table">
        <div class="detail-row">
          <div class="detail-label">贊助展覽名稱</div>
          <div class="detail-value">{{ sponsorData.expo_name }}</div>
        </div>

        <div class="detail-row">
          <div class="detail-label">贊助金額</div>
          <div class="detail-value amount">{{ sponsorData.donation }}</div>
        </div>

        <div class="detail-row">
          <div class="detail-label">贊助時間</div>
          <div class="detail-value">{{ sponsorData.donation_date }}</div>
        </div>
      </div>


      <p class="note">
        *贊助記錄僅供查閱，如有疑問請聯繫客服。
      </p>
    </div>
    <div v-else class="sponsor-details">
        <div class="detail-row">
          <p class="detail-value">目前尚無贊助記錄</p>
        </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useUserStore } from '@/stores/user'
import axios from 'axios'

const userStore = useUserStore()
const sponsorData = ref();

onMounted(async () => {
  const memberId = userStore.decodedMemberId
  const type = userStore.memberType
  console.log('會員 ID:', memberId);
  console.log('會員類型:', type);
  
  

  if (memberId) {
    try {
      const { data } = await axios.get(`http://localhost/TIBAART/getMemSponsor.php`, {
      // const { data } = await axios.get(`https://tibamef2e.com/tjd101/g2/api/getMemSponsor.php`, { // 正式版
        params: {
          id: memberId,
          type: type
        }
      })
      console.log('贊助資料：', data)
      if (Array.isArray(data) && data.length > 0) {
        sponsorData.value = data;
      }
    } catch (error) {
      console.error('取得贊助資料失敗:', error)
    }
  } else {
    console.warn('找不到 ID')
  }
})
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

.sponsor-details {
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
  color: $logoYellow;
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
