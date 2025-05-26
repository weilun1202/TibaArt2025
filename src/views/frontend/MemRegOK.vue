<template>
  <div>
    <div class="wrapper">
      <header>
        <div class="pageTitle">註冊信箱驗證</div>
      </header>
      <!-- 以下供大家編輯 -->
      <div class="registerOK">
        <div class="okContent">
              <img src="@/assets/img/TibaArtLogo.svg" alt="">
              
                  <p>為了確保註冊為您本人，我們將發送驗證連結至您註冊的信箱，24小時內為有效的驗證時間，請至您的信箱確認，謝謝。驗證完成後您將成為緯藝基金會之會員，之後您可以進行購物、展覽申請，享受我們的會員服務，打造自己的藝術人生！</p>

              <div class="backToHome">
                  <button type="button" class="btn"
                  @click="$router.push('/')"
                  >回到首頁</button>
              </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>

</script>

<style lang="scss" scoped>


.registerOK {
    margin: 0 auto;
    max-width: 1200px;
    height: calc(100vh - 192px);
    padding-top: 60px;
  }


.okContent {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 40px;
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

    .backToHome {
        display: flex;
        gap: 20px;
    }
}

</style>