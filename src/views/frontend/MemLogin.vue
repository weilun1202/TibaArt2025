<template>
  <div>
    <div class="wrapper">
      <header>
        <div class="pageTitle">會員登入</div>
      </header>
      <div class="loginPage">
        
        <img src="/src/assets/img/LoginImg.jpg" alt="">
        
        <div class="loginContainer">
          <!-- Tabs -->
          <div class="memberLoginTab">
            <div
              class="generalLoginTab"
              :class="{ active: currentTab === 'general' }, { bgGeneral: currentTab === 'general' }"
              @click="currentTab = 'general'"
            >
              <h4>一般會員登入</h4>
            </div>
            <div
              class="artistLoginTab"
              :class="{ active: currentTab === 'artist' }, { bgArtist: currentTab === 'artist' }"
              @click="currentTab = 'artist'"
            >
              <h4>藝術家會員登入</h4>
            </div>
          </div>

          <!-- 一般會員登入 -->
          <div id="generalLogin" class="tabContent" v-if="currentTab === 'general'" :class="{ bgGeneral: currentTab === 'general' }">
            <div class="formA" @submit.prevent="submitGeneral">
              <div class="formGroup">
                <label for="account" class="formLabel">帳號（您的電子信箱）</label>
                <input
                  type="email"
                  id="account"
                  name="account"
                  placeholder="輸入 E-mail"
                  v-model="general.email"
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
                  v-model="general.password"
                />
                <div class="reminder">
                  <span class="formError hidden">格式錯誤</span>
                  <router-link to="/memForgetPass" class="passForget">忘記密碼</router-link>
                </div>
              </div>

              <div class="btnGroup">
                <button class="btn" type="submit"
                @click="$router.push('/member')"
                >確定登入</button>
                <button class="btn" type="button"
                @click="$router.push('/memReg')"
                >註冊會員</button>
              </div>
            </div>
          </div>

          <!-- 藝術家登入 -->
          <div id="artistLogin" class="tabContent" v-if="currentTab === 'artist'" :class="{ bgArtist: currentTab === 'artist' }">
            <div class="formA" @submit.prevent="submitArtist">
              <div class="formGroup">
                <label for="artistEmail" class="formLabel">帳號（您的電子信箱）</label>
                <input
                  type="email"
                  id="artistEmail"
                  placeholder="輸入 E-mail"
                  v-model="artist.email"
                />
                <span class="formError hidden">格式錯誤</span>
              </div>

              <div class="formGroup">
                <label for="artistPassword" class="formLabel">密碼</label>
                <input
                  type="password"
                  id="artistPassword"
                  placeholder="輸入密碼"
                  v-model="artist.password"
                />
                <div class="reminder">
                  <span class="formError hidden">格式錯誤</span>
                  <router-link to="/memForgetPass" class="passForget">忘記密碼</router-link>
                </div>
              </div>

              <div class="btnGroup">
                <button class="btn" type="submit"
                @click="$router.push('/member')"
                >確定登入</button>
              </div>
            </div>
          </div>
          
          <!-- 第三方登入區塊 -->
          <div class="thirdPartyLogin">
            <div class="separator">或使用以下方式登入</div>
            <div class="socialButtons">
              <button class="btn socialBtn google" aria-label="使用 Google 登入"><font-awesome-icon :icon="['fab', 'google']" /></button>
              <button class="btn socialBtn facebook" aria-label="使用 Facebook 登入"><font-awesome-icon :icon="['fab', 'facebook']" /></button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<script setup>

import { ref } from 'vue'

const currentTab = ref('general')

const general = ref({
  email: '',
  password: ''
})

const artist = ref({
  email: '',
  password: ''
})

const submitGeneral = () => {
  console.log('一般會員登入資料:', general.value)
  // 可加上 axios.post() 送出資料
}

const submitArtist = () => {
  console.log('藝術家會員登入資料:', artist.value)
  // 可加上 axios.post() 送出資料
}

import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
defineProps()

</script>

<style lang="scss" scoped>
/* 可以把額外的 CSS 加在這裡或保留在全域 */
@import '/style.scss';

.loginPage {
  max-width: 1200px;
  margin: 0 auto;
  padding: 120px 0 ;
  display: flex;
  justify-content: center;
  gap: $spacing-10;

  @media (max-width: 1110px) {
    flex-direction: column;
    align-items: center;
  }

  img{
    @media (max-width: 1110px) {
    order: 2;
    }

    @media (max-width: 560px) {
      width: 90vw;
    }
  }

  .formA{
    border: 1.5px solid $fontBlack;
    border-radius: 0 0 $spacing-2 $spacing-2;
    border-top: none;

    @media (max-width: 560px) {
      width: 90vw;
    }

    @media (max-width: 470px) {
      width: 86vw;
    }

    .formGroup{
      @media (max-width: 560px) {
      width: 100%;
    }
    }

     .formLabel {
        
        @media (max-width: 560px) {
            font-size: map-get($font, p);

        }
    }

  }

  .reminder{
    display: flex;
    justify-content: space-between;
  }
    .passForget{
      font-size: map-get($font, pwar);
      margin-top: $spacing-1;
      min-height: $spacing-4;
      // text-decoration: none;
      color: $fontBlack;
      // border-bottom: 1px solid $fontBlack;
    }

  .btnGroup{
    display: flex;
    justify-content: center;
    gap: $spacing-10;
  }

  .tabContent{
    // border: 1.5px solid $fontBlack;
    border-radius: 0 0 $spacing-2 $spacing-2;
  }

  .bgGeneral,
  .bgGeneral a{
    background-color: $logoColor3;
    color: $fontWhite;
  }

  .bgArtist{
    color: $fontBlack;
    background-color: $logoColor6;
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


}

</style>


