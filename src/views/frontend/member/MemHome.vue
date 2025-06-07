<template>
    <div class="memWrap">
        <h2>會員基本資料</h2>

 <div class="member-profile-edit">
    <div class="formA">
      <div class="formGroup">
        <label for="name" class="formLabel">姓名</label>
        <input
          type="text"
          id="name"
          name="name"
          placeholder="輸入姓名"
          v-model="memberData.name"
        />
        <span class="formError hidden">格式錯誤</span>
      </div>

      <div class="formGroup">
        <label for="gender" class="formLabel">性別</label>
        <select id="gender" name="gender" class="formSelect" v-model="memberData.gender">
          <option value="">請選擇</option>
          <option value="M">男</option>
          <option value="F">女</option>
        </select>
        <span class="formError hidden">請選擇性別</span>
      </div>

      <div class="formGroup">
        <label for="birthday" class="formLabel">生日</label>
        <input
          type="date"
          id="birthday"
          name="birthday"
          :max="maxBirthdayStr"
          v-model="memberData.birthday"
        />
        <span class="formError hidden">格式錯誤</span>
      </div>

      <div class="formGroup">
        <label for="email" class="formLabel">電子郵件</label>
        <input
          type="email"
          id="email"
          name="email"
          placeholder="輸入電子郵件"
          v-model="memberData.email"
          disabled 
        />
        <span class="formError hidden">格式錯誤</span>
      </div>

      <div class="formGroup">
        <label for="phone" class="formLabel">手機號碼</label>
        <input
          type="tel"
          id="phone"
          name="phone"
          placeholder="輸入手機號碼"
          v-model="memberData.phone"
        />
        <span class="formError hidden">格式錯誤</span>
      </div>

      <!-- <div class="formGroup">
        <label for="bank_account" class="formLabel">銀行帳戶</label>
        <input
          type="text"
          id="bank_account"
          name="bank_account"
          placeholder="輸入銀行帳戶"
          v-model="memberData.bank_account"
          disabled
        />
        <span class="formError hidden">格式錯誤</span>
      </div> -->

      <button class="btn saveBtn" type="button" @click="saveProfile">儲存</button>
    </div>
  </div>




    </div>
</template>

<script setup>

import { reactive, onMounted } from 'vue';

const name = atob('5aCk5aOp6KGj');
console.log(name); // 預期輸出：王小明


const today = new Date()
const maxBirthday = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());
const maxBirthdayStr = maxBirthday.toISOString().split('T')[0]; 

const memberData = reactive({
  name: '',
  gender: '',
  birthday: '',
  email: '',
  phone: '',
});

onMounted(async () => {
  const member = JSON.parse(localStorage.getItem('member'))
  const decodedId = atob(member.id)

  const response = await fetch('http://localhost/TibaTest/getMemberInfo.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ id: decodedId })
  })

  const result = await response.json()
  if (result.success) {
    const info = result.member_info
    memberData.name = info.name
    memberData.email = atob(info.email)
    memberData.phone = atob(info.phone)
    memberData.birthday = atob(info.birthday)
    memberData.gender = atob(info.gender)
  };
})



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