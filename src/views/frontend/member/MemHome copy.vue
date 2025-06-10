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
      <span v-if="errors.name" class="formError">{{ errors.name }}</span>
      </div>

      <div class="formGroup">
        <label for="gender" class="formLabel">性別</label>
        <select id="gender" name="gender" class="formSelect" v-model="memberData.gender">
          <option value="">請選擇</option>
          <option value="M">男</option>
          <option value="F">女</option>
          <option value="Other">其他</option>
        </select>
      <span v-if="errors.gender" class="formError">{{ errors.gender }}</span>
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
      <span v-if="errors.birthday" class="formError">{{ errors.birthday }}</span>
      </div>

      <div class="formGroup">
        <label for="email" class="formLabel">電子郵件</label>
        <input
          type="email"
          id="email"
          name="email"
          placeholder="輸入電子郵件"
          v-model="memberData.email"
          readonly 
        />
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
      <span v-if="errors.phone" class="formError">{{ errors.phone }}</span>
      </div>

      <div class="formGroup">
        <label for="password" class="formLabel">修改密碼</label>
        <input
          type="password"
          id="password"
          name="password"
          placeholder="至少 6 碼"
          v-model="memberData.password"
        />
        <span class="formError" v-if="errors.password">{{ errors.password }}</span>
      </div>

      <!-- 確認密碼 -->
      <div class="formGroup">
        <label for="cPassword" class="formLabel">確認新密碼</label>
        <input
          type="password"
          id="cPassword"
          name="cPassword"
          placeholder="再次輸入密碼"
          v-model="memberData.cPassword"
        />
        <span class="formError" v-if="errors.cPassword">{{ errors.cPassword }}</span>
      </div>

      <div class="formGroup" v-if="memberData.bank_account">
        <label for="bank_account" class="formLabel">銀行帳戶</label>
        <input
          type="text"
          id="bank_account"
          name="bank_account"
          placeholder="輸入銀行帳戶"
          v-model="memberData.bank_account"
        />
      <span v-if="errors.bank_account" class="formError">{{ errors.bank_account }}</span>
      </div>

      <button class="btn saveBtn" type="button" @click="saveProfile">儲存修改</button>
    </div>
  </div>




    </div>
</template>

<script setup>

import { reactive, onMounted } from 'vue';

const today = new Date()
const maxBirthday = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());
const maxBirthdayStr = maxBirthday.toISOString().split('T')[0]; 

const memberData = reactive({
  name: '',
  gender: '',
  birthday: '',
  email: '',
  phone: '',
  password: '',     
  cPassword: '',    
  bank_account: '', 
  type: ''          
})


onMounted(async () => {

  const member = JSON.parse(localStorage.getItem('member'))
  const type = localStorage.getItem('memberType') || 'general' 
  const decodedId = atob(member.id)

  const response = await fetch('http://localhost/TIBAART/getMemberInfo.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ id: decodedId, type: type }) 

  })

  const result = await response.json()
  if (result.success) {
    const info = result.member_info
    memberData.name = info.name
    memberData.email = atob(info.email)
    memberData.phone = atob(info.phone)
    memberData.birthday = atob(info.birthday)
    memberData.gender = atob(info.gender)

    if (info.bank_account) {
    memberData.bank_account = atob(info.bank_account)
    }
  };


})

const errors = reactive({
  name: '',
  gender: '',
  birthday: '',
  phone: '',
  password: '',
  cPassword: '',
  bank_account: ''
});


function validateForm() {
  let valid = true

  // Reset errors
  Object.keys(errors).forEach(key => errors[key] = '')

  // 姓名
  if (!memberData.name.trim()) {
    errors.name = '姓名為必填'
    valid = false
  } else if (memberData.name.length < 2) {
    errors.name = '姓名至少兩個字'
    valid = false
  }

  // 密碼
   if (memberData.password || memberData.cPassword) {
    if (memberData.password.length < 6) {
      errors.password = '密碼至少需 6 碼'
      valid = false
    }
    if (memberData.password !== memberData.cPassword) {
      errors.cPassword = '兩次密碼不一致'
      valid = false
    }
  }

  // 手機
  if (memberData.phone.length !== 10 || !memberData.phone.startsWith('09')) {
    errors.phone = '請輸入09開頭的10碼手機格式'
    valid = false
  }
  
  // 生日
  if (memberData.birthday == '') {
    errors.birthday = '請選擇生日'
    valid = false
  } 

    // 性別
  if (memberData.gender == '') {
    errors.gender = '請選擇性別'
    valid = false
  } 

  return valid
}

async function saveProfile() {
  if (!validateForm()) return 

  const member = JSON.parse(localStorage.getItem('member'))
  const type = localStorage.getItem('memberType') || 'general' 
  const decodedId = atob(member.id)

  const dataToSend = {
   ...memberData,
   id: decodedId,
   type: type  
 }

  // 如果密碼是空的，就不要送去後端（避免覆蓋成空密碼）
  if (!memberData.password) {
    delete dataToSend.password
    delete dataToSend.cPassword
  }

  const response = await fetch('http://localhost/TIBAART/updateMemberInfo.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(dataToSend)
  })

  const result = await response.json()

  if (result.success) {
    alert('資料已成功更新！')
    // 清空密碼欄
    memberData.password = ''
    memberData.cPassword = ''

    const info = result.member_info
    memberData.name = info.name
    memberData.email = atob(info.email)
    memberData.phone = atob(info.phone)
    memberData.birthday = atob(info.birthday)
    memberData.gender = atob(info.gender)

    if (info.bank_account) {
    memberData.bank_account = atob(info.bank_account)
    }


  } else {
    alert('更新失敗：' + result.message)
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

    .formA{
        // border: 1px solid;
        padding: 60px 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 20px;
    
        .formGroup{
            margin: 0 auto;

          @media (max-width: 560px){
            width: 100%;
            
        
          }

        }
    
        .saveBtn{
            margin: 24px auto;
            width: auto;
            aspect-ratio: 2/1;
            font-size: 16px;
        }


    }



}



</style>