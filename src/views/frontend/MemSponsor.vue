<template>
  <div>
    <div class="wrapper">
      <!-- <header>
        <div class="pageTitle">會員中心</div>
      </header> -->
      <!-- 以下供大家編輯 -->
      <div class="memHome">
        <div class="memHomeContent">

          <div class="memSideBar">
            <div class="memSideDiv">
              <div class="memAvatar">
                <img src="" alt="">
              </div>
              <div class="memName">
                <p>艾莉亞・諾瓦</p>
              </div>
             <div class="memNav">
                <ul>
                  <li><router-link to="/memHome">會員基本資料</router-link></li>
                  <li><router-link to="/memExpo">個人展覽資訊</router-link></li>
                  <li><router-link to="/memOrder">商城訂單追蹤</router-link></li>
                  <li><router-link to="/memSponsor">展覽贊助記錄</router-link></li>
                </ul>
              </div>
            </div>
            
            <button class="memberBtn">登出</button>

          </div>

          <div class="memContent">


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

.memHome {
  max-width: 1200px;
  margin: 0 auto;


  .memHomeContent{

    display: flex;



    .memSideBar{
      width: 25%;
      padding: 80px 0;
      text-align: center;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      align-items: center;

      height: 1000px;

      .memSideDiv{
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        gap: $spacing-8;
      }
  
      .memAvatar{
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 2px dashed;
        margin: 0 auto;
      }

      .memName{
        font-size: map-get($font, h4);
        font-weight: bold;
      }

      .memNav ul{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
      
        li{
          padding: $spacing-3;
          border-radius: 8px;

          &:hover{
            cursor: pointer;
            background-color: $logoColor3;
            color: $fontWhite;

          }

        }

      }

      .memberBtn{
        width: 50%;
      }

    }

    .memContent{
      width: 75%;
      padding: 80px 0;

    }
    
  }






}

</style>