<template>
  <div>
    <div class="wrapper">
      <header class="animate__animated animate__flipInX">
        <div class="pageTitle">申請辦展</div>
      </header>
      
      <!-- Wrapper 不設 1200px 寬（例如展覽、關於我們頁面應該會滿版），想要限制內容在 1200 的再自己包一個 div 限制 1200  -->
      <!-- 以下供大家編輯 -->
       <!-- <p>test1</p> -->
       <div class="applicationWrapper">
        <div class="applicationImg">
          <img src="@/assets/img/applicationBanner.jpg" alt="" />
        </div>
        <section class="applicationSection">
          <div class="applicationContent">
            <div class="applicationTitle">
                緯藝基金會 線上展覽申請開放中！
            </div>

            <div class="applicationText">
                你是一位懷抱創作熱情的藝術家，卻苦無展出平台嗎？我們誠摯邀請你加入緯藝基金會的線上展覽區域，一同為藝術注入更多元、自由的想像！<br><br>
                緯藝基金會致力於支持小眾與新銳藝術創作者，無論你的作品形式是繪畫、攝影、影像、裝置或跨域實驗，只要你的創作擁有獨特觀點與動人故事，我們都希望能成為你藝術旅程的起點與陪伴者。
            </div>

            <div class="applicationContent">
    
              <div class="applicationTitle">
                  申請方式
              </div>
              
              <div class="applicationText">
                  請參考下方申請檔範例，填寫展覽申請表格，再與欲展出之作品合併整理成一個 zip 壓縮檔，上傳至下方本館雲端空間，並來信告知相關資訊。我們將由專人進行審核，並於後續與您聯絡確認展出事宜。
              </div>
    
            </div>
            <div class="applicationArea">

              <div class="applicationAreaBtn">
  
                <a href="https://docs.google.com/document/d/1p76XVYbjVrUj4EiRHDsrNW1XIhKQzzRX/export?format=docx" download class="applicationBtn">
                  <span class="text">
                    申請檔範例 &nbsp;
                    <font-awesome-icon :icon="['fas', 'file-arrow-down']" class="appIconDown"/>
                  </span>
                </a>

                <a href="https://docs.google.com/document/d/1VhNKxNoe1bmUCZoSbw7WWbU9GmpQJQun/export?format=docx" download class="applicationBtn">
                  <span class="text">
                    空白申請書 &nbsp;
                    <font-awesome-icon :icon="['fas', 'file-arrow-down']" class="appIconDown"/>
                  </span>
                </a>

                <a href="https://script.google.com/macros/s/AKfycbx4F2Ldzyj02D9S3OEmJyL55Fc1xmq0ZbF9C9pWeW3GBbCNh9a18-rFELixP5SUJmu2aw/exec" class="applicationBtn" Target="_blank">
                  <span class="text">
                    申請檔上傳&nbsp;
                    <font-awesome-icon :icon="['fas', 'cloud-arrow-up']" class="appIconUp"/>
                  </span>
                </a>
  
              </div>
            </div>
            <div class="applicationText">
              檔案準備完成後，請將整包資料夾上傳至本館指定雲端空間（上傳連結將於來信後提供），並來信通知：<br>tibaart101@mail.tw<br>02-12345678
            </div>

            <div class="applicationText">
              如資料不齊全，將可能影響審核進度，敬請配合。期待您的創作，在緯藝基金會被世界看見！
            </div>
    
          </div>
        </section>
       </div>




    </div>
  </div>
</template>

<script setup>

</script>

<style lang="scss" scoped>
/* 可以把額外的 CSS 加在這裡或保留在全域 */
@import '/style.scss';

.wrapper{
    margin-bottom: 120px;
}

.appIconDown{
  font-size: map-get($font, h3);
}
.appIconUp{
  font-size: 28px;
}
@media screen and (max-width: 992px) {
  .applicationImg{
    // overflow: hidden;
    display: none;
  }
  .applicationSection{
    margin: 0 auto;
    padding: $spacing-2;
  }
}

</style>


