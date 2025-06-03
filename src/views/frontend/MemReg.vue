<template>
  <div>
    <div class="wrapper">
      <header class="animate__animated animate__flipInX">
        <div class="pageTitle">註冊成為會員</div>
      </header>
      <!-- 以下供大家編輯 -->
      <div class="regOpening">
      <p>歡迎加入緯藝，一起為藝術發聲！<br>
      請將基本資料填寫於下方表單，信箱將成為會員帳號，並確保您的資訊正確無虞，以保障後續會員權益，謝謝。</p>
      </div>

      <div class="registerPage">

        <img src="/src/assets/img/RegisterImg.jpg" alt="">

        <div class="regContainer">
         <div class="formA">
            <!-- 姓名 -->
            <div class="formGroup">
              <label for="name" class="formLabel">姓名</label>
              <input
                type="text"
                id="name"
                v-model="form.name"
                placeholder="輸入姓名"
              />
              <span class="formError" :class="{ hidden: !errors.name }">{{ errors.name }}</span>
            </div>

                <!-- 信箱 -->
            <div class="formGroup">
              <label for="email" class="formLabel">電子郵件（您的帳號）</label>
              <input
                type="email"
                id="email"
                v-model="form.email"
                placeholder="example@email.com"
              />
              <span class="formError" :class="{ hidden: !errors.email }">{{ errors.email }}</span>
            </div>

                <!-- 密碼 -->
            <div class="formGroup">
              <label for="password" class="formLabel">設定密碼</label>
              <input
                type="password"
                id="password"
                v-model="form.password"
                placeholder="輸入密碼"
              />
              <span class="formError" :class="{ hidden: !errors.password }">{{ errors.password }}</span>
            </div>

            <!-- 確認密碼 -->
            <div class="formGroup">
              <label for="cPassword" class="formLabel">確認密碼</label>
              <input
                type="password"
                id="cPassword"
                v-model="form.cPassword"
                placeholder="確認密碼"
              />
              <span class="formError" :class="{ hidden: !errors.cPassword }">{{ errors.cPassword }}</span>
            </div>

            <!-- 手機 -->
            <div class="formGroup">
              <label for="phone" class="formLabel">手機號碼</label>
              <input
                type="tel"
                id="phone"
                v-model="form.phone"
                placeholder="輸入手機"
              />
              <span class="formError" :class="{ hidden: !errors.phone }">{{ errors.phone }}</span>
            </div>

            <!-- 生日 -->
            <div class="formGroup">
              <label for="birthday" class="formLabel">您的生日</label>
              <input
                type="date"
                id="birthday"
                :max="today"
                v-model="form.birthday"
                placeholder="選擇生日"
              />
              <span class="formError" :class="{ hidden: !errors.birthday }">{{ errors.birthday }}</span>
            </div>

            <!-- 性別 -->          
                <div class="formGroup">
                  <label for="gender" class="formLabel">性別</label>
                  <select id="gender" class="formSelect" v-model="form.gender">
                    <option value="">請選擇</option>
                    <option value="M">男</option>
                    <option value="F">女</option>
                  </select>
                  <span class="formError" :class="{ hidden: !errors.gender }">{{ errors.gender }}</span>
                </div>
                
                <!-- 條款勾選 -->
              <div class="formGroup">
                <input type="checkbox" id="termsAgreement" v-model="form.termsAgreement" />
                <label for="termsAgreement" class="terms">
                  我已詳細閱讀並接受<a href="#" target="_blank">緯藝會員條款</a>
                </label>
                <br>
                <span class="formError" :class="{ hidden: !errors.termsAgreement }">{{ errors.termsAgreement }}</span>
              </div>
      
              <!-- 註冊按鈕 -->
              <button class="btn regBtn" type="button" @click="handleSubmit">註冊</button>
          </div>


          <div class="thirdPartyRegister">
            <div class="separator">或使用以下方式註冊</div>
            <div class="socialButtons">
              <button class="btn socialBtn google" aria-label="使用 Google 註冊">
                <font-awesome-icon :icon="['fab', 'google']" />
              </button>
              <button class="btn socialBtn facebook" aria-label="使用 Facebook 註冊">
                <font-awesome-icon :icon="['fab', 'facebook']" />
              </button>
            </div>
          </div>

        </div>

      </div>
      
    </div>
  </div>
</template>

<script setup>

import { reactive } from 'vue'
import { useRouter } from 'vue-router'

const today = new Date().toISOString().split('T')[0]; // 轉成 YYYY-MM-DD 格式

const router = useRouter()

const form = reactive({
  name: '',
  email: '',
  password: '',
  cPassword: '',
  phone: '',
  birthday: '',
  gender:'',
  termsAgreement: false,
})

const errors = reactive({
  name: '',
  email: '',
  password: '',
  cPassword: '',
  phone: '',
  birthday: '',
  gender:'',
  termsAgreement: '',
})


function validateForm() {
  let valid = true

  // Reset errors
  Object.keys(errors).forEach(key => errors[key] = '')

  // 姓名
  if (!form.name.trim()) {
    errors.name = '姓名為必填'
    valid = false
  } else if (form.name.length < 2) {
    errors.name = '姓名至少兩個字'
    valid = false
  }

  // 信箱
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
  if (!form.email.trim()) {
    errors.email = '信箱為必填'
    valid = false
  } else if (!emailRegex.test(form.email)) {
    errors.email = '請輸入正確的信箱格式'
    valid = false
  }

  // 密碼
  if (!form.password) {
    errors.password = '請輸入密碼'
    valid = false
  } else if (form.password.length < 6) {
    errors.password = '密碼需至少 6 碼'
    valid = false
  }

  // 確認密碼
  if (form.cPassword !== form.password) {
    errors.cPassword = '兩次密碼不一致'
    valid = false
  }

  // 手機
  if (form.phone.length !== 10) {
    errors.phone = '請輸入正確手機格式'
    valid = false
  }
  
  // 生日
  if (form.birthday == '') {
    errors.birthday = '請選擇生日'
    valid = false
  } 

    // 性別
  if (form.gender == '') {
    errors.gender = '請選擇性別'
    valid = false
  } 

  // 條款
  if (!form.termsAgreement) {
    errors.termsAgreement = '請勾選同意條款'
    valid = false
  }

  return valid
}

async function handleSubmit() {
  if (validateForm()) {

    // 只取出要送進資料庫的欄位
    const payload = {
      name: form.name,
      email: form.email,
      password: form.password,
      phone: form.phone,
      birthday: form.birthday,
      gender: form.gender,
    }

    try {
      const response = await fetch('http://localhost/TibaTest/memRegister.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(payload), // <-- 注意是乾淨資料
      })

      const result = await response.json()

      if (result.success) {
        router.push('/front/memRegOK')  // 成功導向
      } else {
        alert('註冊失敗：' + result.message)
      }
    } catch (error) {
      console.error('傳送資料錯誤', error)
      alert('伺服器錯誤，請稍後再試')
    }
  }
}


</script>

<style lang="scss" scoped>
@import '/style.scss';

.wrapper{
  padding-bottom: 60px;

}

.toRegisterOK  a{

margin: 0 auto;

display: block;
width: 200px;
height: 200px;
border-radius: 50%;
background-color: #DB5C28;
text-align: center;
text-decoration: none;
color: $fontBlack;
font-weight: bold;
font-size: 24px;
line-height: 200px;

}

.regOpening{
  margin: 60px auto;
  width: 80vw;

  p{
    text-align: center;
    line-height: 1.6;
    font-weight: bold;
  }

}

.registerPage{
  max-width: 1200px;
  margin: 0 auto 60px;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: $spacing-10;

  @media (max-width:1124px){
    flex-direction: column;
  }

  img{
    @media (max-width:1124px){
      order:2;
    }

    @media (max-width:550px){
      width: 90vw;
    }
  }

}

.regContainer{
  text-align: center;
}

.regBtn{
  padding: 0 $spacing-10;
  margin: $spacing-5;
}


.formA{
  text-align: center;

  @media (max-width: 520px) {
      width: 100vw;
    }

     .formGroup{
      @media (max-width: 520px) {
      width: 100%;
    }
  }

}

.formError{
  font-size: 12px;
  color: $fontWarn;
  margin-top: $spacing-1;
  min-height: $spacing-4;
}

.hidden {
  visibility: hidden;
}

.separator{
    text-align: center;
    font-size: map-get($font, h5);
    margin: $spacing-6;
  }

  .socialButtons{
    display: flex;
    justify-content: center;
    gap: $spacing-10;
    
  }


   .socialBtn{
    font-size: map-get($font, p);
    line-height: 48px;
   }


#termsAgreement{
  width: 15px;
 height: 15px;

}

.terms a{
  color: $logoBlue;
  font-weight: bold;
  text-decoration: none;

  &:hover{
    text-decoration: underline;
    color: $logoGreen;
  }


}




</style>

