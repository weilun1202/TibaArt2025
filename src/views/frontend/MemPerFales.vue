<template>
  <div>
    <div class="wrapper">
      <header class="animate__animated animate__flipInX">
        <div class="pageTitle">停權通知</div>
      </header>
      <!-- 以下供大家編輯 -->
      <div class="registerOK">
        <div class="okContent">
              <img src="@/assets/img/TibaArtLogo.svg" alt="">
              
                  <p>此帳號目前已被停權，如有疑問，請來電或者寄信洽詢！</p>
                  <p>連絡電話：02-12345678</p>
                  <p>信箱：tibaart101@mail.tw</p>

              <div class="backToHome">
                  <button type="button" class="btn"
                  @click="$router.push('/front')"
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