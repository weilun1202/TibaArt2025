<template>
  <div>
    <div class="wrapper">
      <header>
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
                <label for="name" class="formLabel">姓名<span class="formHint">*</span></label>
                <input
                  type="text"
                  id="regName"
                  name="regName"
                  placeholder="輸入姓名"
                />
                <span class="formError hidden">格式錯誤</span>
              </div>

              <div class="formGroup">
                <label for="password" class="formLabel">密碼</label>
                <input
                  type="password"
                  id="password"
                  name="password"
                  placeholder="輸入密碼"
                />
                <div class="reminder">
                  <span class="formError hidden">格式錯誤</span>
                </div>
              </div>

              <div class="btnGroup">
                <button class="btn" type="submit">確定登入</button>
                <button class="btn" type="button">註冊會員</button>
              </div>
            </div>
        </div>

      </div>

      <div class="toRegisterOK">
          <router-link to="/registerok">註冊成功</router-link>
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
  }

}


</style>

