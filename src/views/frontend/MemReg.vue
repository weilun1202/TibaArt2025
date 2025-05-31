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
            <div class="formGroup">
              <label for="regName" class="formLabel">姓名</label>
              <input
                type="text"
                id="regName"
                name="regName"
                placeholder="輸入姓名"
              />
              <span class="formError hidden">格式錯誤</span>
            </div>

            <div class="formGroup">
              <label for="regEmail" class="formLabel">電子郵件（您的帳號）</label>
              <input
                type="email"
                id="regEmail"
                name="regEmail"
                placeholder="輸入電子郵件"
              />
              <span class="formError hidden">格式錯誤</span>
            </div>

            <div class="formGroup">
              <label for="regPassword" class="formLabel">設定密碼</label>
              <input
                type="password"
                id="regPassword"
                name="regPassword"
                placeholder="輸入密碼"
              />
              <span class="formError hidden">格式錯誤</span>
            </div>

            <div class="formGroup">
              <label for="confirmPassword" class="formLabel">確認密碼</label>
              <input
                type="password"
                id="confirmPassword"
                name="confirmPassword"
                placeholder="確認密碼"
              />
              <span class="formError hidden">格式錯誤</span>
            </div>

            <div class="formGroup">
              <label for="regPhone" class="formLabel">手機號碼</label>
              <input
                type="tel"
                id="regPhone"
                name="regPhone"
                placeholder="輸入手機號碼"
              />
              <span class="formError hidden">格式錯誤</span>
            </div>

            <div class="formGroup">
              <label for="regBirthday" class="formLabel">您的生日</label>
              <input
                type="date"
                id="regBirthday"
                name="regBirthday"
                placeholder="選擇生日"
              />
              <span class="formError hidden">格式錯誤</span>
            </div>

            <div class="formGroup">
              <label for="regGender" class="formLabel">性別</label>
              <select id="regGender" name="regGender" class="formSelect">
                <option value="male">男</option>
                <option value="female">女</option>
              </select>
              <span class="formError hidden">請選擇性別</span>
            </div>

          </div>

          <div class="formGroup">
            <input type="checkbox" id="termsAgreement" name="termsAgreement" class="formCheckbox">
            <label for="termsAgreement" class="formLabel">
              我已詳細閱讀並接受<a href="#" target="_blank">緯藝會員服務條款</a>
            </label>
            <br>
            <span class="formError hidden">請勾選以繼續</span>
          </div>

          <button class="btn regBtn" type="button"
          @click="$router.push('/front/memRegOK')"
          >註冊</button>

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

</script>

<style lang="scss" scoped>
@import '/style.scss';

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

</style>

