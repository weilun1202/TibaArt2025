<template>
  <div>
    <div class="wrapper">
      <header>
        <div class="pageTitle">會員登入</div>
      </header>
      <div class="loginPage">
        
        <img src="../assets/img/LoginImg.jpg" alt="">
        
        <div class="loginContainer">
          <div class="tabs">
            <button class="tab-button active" @click="showTab('general')">一般會員登入</button>
            <button class="tab-button" @click="showTab('artist')">藝術家會員登入</button>
          </div>
          <div id="general-login" class="tab-content active">
            
            <form action="" class="formA">
                <div class="formGroup">
                  <label for="name" class="formLabel">帳號（您的電子郵件</label>
                  <input type="text" id="name" name="name" placeholder="輸入 E-mail">
                  <span class="formError hidden">格式錯誤</span>
                </div>
              
                <div class="formGroup">
                    <label for="email" class="formLabel">密碼</label>
                    <input type="password" id="password" name="password" placeholder="輸入密碼">
                    <span class="formError hidden">格式錯誤</span>
                </div>
            </form>

          </div>

        </div>

      </div>
    </div>
  </div>
</template>

<script setup>

</script>

<style lang="scss" scoped>
/* 可以把額外的 CSS 加在這裡或保留在全域 */
@import '/style.scss';

.loginPage{
  max-width: 1200px;
  display: flex;
  justify-content: center;
  gap: $spacing-5;
}


</style>


