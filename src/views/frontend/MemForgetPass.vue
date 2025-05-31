<template>
  <div>
    <div class="wrapper">
      <header class="animate__animated animate__flipInX">
        <div class="pageTitle">忘記密碼</div>
      </header>
      <!-- 以下供大家編輯 -->
      <div class="memForgetPass">
        <div class="forgetPassContent">
              <img src="@/assets/img/TibaArtLogo.svg" alt="">
              
                  <p>親愛的會員您好，請輸入您註冊時所使用的電子信箱，我們將寄送密碼重設連結至您的信箱，請點擊連結進行後續的更改流程。</p>

                   <div class="formA">
                      <div class="formGroup">
                        <label for="regEmail" class="formLabel">信箱</label>
                        <input
                          type="email"
                          id="regEmail"
                          name="regEmail"
                          placeholder="輸入電子郵件"
                        />
                      </div>
                   </div>

              <div class="getPass">
                  <button type="button" class="btn getPassBtn">確定送出</button>
              </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>

</script>

<style lang="scss" scoped>


.memForgetPass {
    margin: 0 auto;
    max-width: 1200px;
    height: calc(100vh - 192px);
    padding: 60px;
  }


.forgetPassContent {
    display: flex;
    flex-direction: column;
    align-items: center;
    // padding: 40px;
    gap: 40px;

    img {
        width: 200px;
    }

    span {
        font-weight: bold;
    }

    p {
      max-width: 640px;
      text-align: center;
      line-height: 1.6;
    }

    .formA{ 
      padding: 0;

      @media (max-width: 520px) {
      width: 90vw;
    }

     .formGroup{
      @media (max-width: 520px) {
      width: 100%;
    }
  }

}

}

</style>