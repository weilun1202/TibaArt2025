<template>
  <div class="memSideDiv">
    <div class="memSideCon">
        <div class="memAvatarDiv">
            <!-- <img :src="avatar" alt="avatar" /> -->
            <img class="memAvatar" src="@/assets/img/TibaArt-Icon.svg" alt="">
        </div>
        <div class="memName">
            <p>{{ name }}</p>
        </div>
        <div class="memNav">
        <ul>
            <li><router-link to="/member">會員基本資料</router-link></li>
            <li><router-link to="/member/memExpo">個人展覽資訊</router-link></li>
            <li><router-link to="/member/memOrder">商城訂單追蹤</router-link></li>
            <li><router-link to="/member/memSponsor">展覽贊助記錄</router-link></li>
        </ul>
        </div>
    </div>
    <button class="logoutBtn memberBtn" @click="logout">登出</button>
  </div>
</template>

<script setup>
const name = '緯藝藝術家'
// const avatar = '/src/assets/img/TibaArt-Icon.svg' //

const logout = () => {
  alert('已登出')
}
    
</script>

<style lang="scss" scoped>
@import '/style.scss';

.memSideDiv{
    min-height: 100%;
    padding: 40px 0;
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;

    .memSideCon{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: $spacing-8;

    }
  
      .memAvatar{
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 2px dashed;
        margin: 0 auto;

        @media (max-width:496px){ 
          width: 100px;
          height: 100px;
        }


      }

      .memName{
        font-size: map-get($font, h4);
        font-weight: bold;

    // border: 1px solid ;

        @media (max-width:496px){ 
        font-size: map-get($font, h5);

        }

      }

      .memNav ul {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;

        @media (max-width: 1200px) { 
          flex-direction: row;
        }

        @media (max-width: 496px) { 
          flex-wrap: wrap;
        }

          li {
            display: flex;
            justify-content: center;
            align-items: center;
            
            @media (max-width: 496px) {   
              width: calc(50% - 1px); // Account for border width
              border: 1.5px solid $fontBlack;
              
              // Remove borders between adjacent items
              &:nth-child(odd) {
                border-right: none;
              }
              &:not(:last-child):not(:nth-last-child(2)) {
                border-bottom: none;
              }
            }
          }

          a {
            display: block;
            padding: $spacing-3;
            border-radius: 8px;
            text-decoration: none;
            color: $fontBlack;
            transition: all 0.2s ease; // Smooth hover transitions

            @media (max-width: 496px) { 
              box-sizing: border-box;
              width: 100%;
              padding: $spacing-2; // Consider smaller padding on mobile
            }

            &:hover {
              cursor: pointer;
              background-color: $logoColor3;
              color: $fontWhite;

              @media (max-width: 496px) { 
                border-radius: 0;
              }
            }
          }


        }
        .logoutBtn{
          margin-top: 40px;
        }

      }




</style>