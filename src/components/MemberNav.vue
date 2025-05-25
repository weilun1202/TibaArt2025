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
// const avatar = '/src/assets/img/TibaArt-Icon.svg' // 假資料，未來可改動態

const logout = () => {
  // 這邊之後可加上登出邏輯
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

        a{
            display: block;
            padding: $spacing-3;
            border-radius: 8px;
            text-decoration: none;
            color: $fontBlack;

            &:hover{
            cursor: pointer;
            background-color: $logoColor3;
            color: $fontWhite;
          }

        }

        }

      }




</style>