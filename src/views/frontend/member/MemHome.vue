<template>
    <div class="memWrap">
        <h2>會員基本資料</h2>

 <div class="member-profile-edit">
    <div class="formA">
      <div class="formGroup">
        <label for="memberName" class="formLabel">姓名</label>
        <input
          type="text"
          id="memberName"
          name="memberName"
          placeholder="輸入姓名"
          v-model="memberData.name"
        />
        <span class="formError hidden">格式錯誤</span>
      </div>

      <div class="formGroup">
        <label for="memberGender" class="formLabel">性別</label>
        <select id="memberGender" name="memberGender" class="formSelect" v-model="memberData.gender">
          <option value="">請選擇</option>
          <option value="male">男</option>
          <option value="female">女</option>
        </select>
        <span class="formError hidden">請選擇性別</span>
      </div>

      <div class="formGroup">
        <label for="memberBirthday" class="formLabel">您的生日</label>
        <input
          type="date"
          id="memberBirthday"
          name="memberBirthday"
          v-model="memberData.birthday"
        />
        <span class="formError hidden">格式錯誤</span>
      </div>

      <div class="formGroup">
        <label for="memberEmail" class="formLabel">電子郵件</label>
        <input
          type="email"
          id="memberEmail"
          name="memberEmail"
          placeholder="輸入電子郵件"
          v-model="memberData.email"
          disabled 
        />
        <span class="formError hidden">格式錯誤</span>
      </div>

      <div class="formGroup">
        <label for="memberPhone" class="formLabel">手機號碼</label>
        <input
          type="tel"
          id="memberPhone"
          name="memberPhone"
          placeholder="輸入手機號碼"
          v-model="memberData.phone"
        />
        <span class="formError hidden">格式錯誤</span>
      </div>

      <div class="formGroup">
        <label for="memberAddress" class="formLabel">地址</label>
        <input
          type="text"
          id="memberAddress"
          name="memberAddress"
          placeholder="輸入地址"
          v-model="memberData.address"
        />
        <span class="formError hidden">格式錯誤</span>
      </div>

      <button class="btn saveBtn" type="button" @click="saveProfile">儲存</button>
    </div>
  </div>




    </div>
</template>

<script setup>

import { ref, onMounted } from 'vue';

// 使用 ref 建立響應式資料物件，用於綁定表單欄位
const memberData = ref({
  name: '',
  gender: '',
  birthday: '',
  email: '',
  phone: '',
  address: ''
});

// onMounted 是一個生命週期鉤子，組件掛載後會執行
onMounted(() => {
  // 在這裡模擬從後端 API 撈取會員資料
  // 實際應用中，你會在這裡發送 HTTP 請求
  fetchMemberData();
});

// 模擬從後端獲取會員資料的函數
const fetchMemberData = async () => {
  try {
    // 實際應用中，會是類似 axios.get('/api/member/profile') 的請求
    // 這裡使用 setTimeout 模擬非同步請求延遲
    setTimeout(() => {
      const fetchedData = {
        name: '王小明',
        gender: 'male',
        birthday: '1990-05-20',
        email: 'wangxiaoming@example.com',
        phone: '0912345678',
        address: '台北市信義區忠孝東路一段1號'
      };
      // 將撈到的資料賦值給 memberData
      memberData.value = fetchedData;
    }, 0); 
  } catch (error) {
    console.error('獲取會員資料失敗:', error);
    // 可以在這裡處理錯誤，例如顯示錯誤訊息給用戶
  }
};

// 儲存會員資料的函數
const saveProfile = async () => {
  try {
    // 在這裡將 memberData.value 發送到後端 API 進行更新
    // 實際應用中，會是類似 axios.post('/api/member/updateProfile', memberData.value)
    console.log('正在儲存會員資料:', memberData.value);
    
    // 模擬非同步請求
    setTimeout(() => {
      alert('會員資料儲存成功！');
      // 儲存成功後可以做其他操作，例如導回會員中心首頁
    }, 300);
  } catch (error) {
    console.error('儲存會員資料失敗:', error);
    alert('會員資料儲存失敗，請稍後再試。');
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

        @media (max-width: 1200px){
        font-size: map-get($font, h3);
    }

    }

    .formA{
        // border: 1px solid;
        padding: 60px 0;
    
        .formGroup{
            margin: 0 auto;

          @media (max-width: 560px){
            width: 100%;
            
        
          }

        }
    
    }



}



</style>