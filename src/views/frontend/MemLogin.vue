<template>
  <div>
    <div class="wrapper">
      <header class="animate__animated animate__flipInX">
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
            <div class="formA">
              <div class="formGroup">
                <label for="email" class="formLabel">帳號（您的電子信箱）</label>
                <input
                  type="email"
                  id="email"
                  name="email"
                  placeholder="輸入 E-mail"
                  v-model="general.email"
                />
              <span class="formError" :class="{ hidden: !errors.email }">{{ errors.email }}</span>
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
                  <span class="formError" :class="{ hidden: !errors.password }">{{ errors.password }}</span>
                  <router-link to="/front/memForgetPass" class="passForget">忘記密碼</router-link>
                </div>
              </div>

              <div class="btnGroup">
                <!-- <button class="btn" type="button"
                @click="router.push('/member')"
                >確定登入</button> -->
                <button class="btn" type="button"
                @click="handleSubmitGeneral"
                >確定登入</button>
                <button class="btn" type="button"
                @click="$router.push('/front/memReg')"
                >註冊會員</button>
              </div>
            </div>
          </div>

          <!-- 藝術家登入 -->
          <div id="artistLogin" class="tabContent" v-if="currentTab === 'artist'" :class="{ bgArtist: currentTab === 'artist' }">
            <div class="formA">
              <div class="formGroup">
                <label for="account" class="formLabel">緯藝帳號</label>
                <input
                  type="text"
                  id="account"
                  name="account"
                  placeholder="輸入帳號"
                  v-model="artist.account"
                />
                  <span class="formError" :class="{ hidden: !errorsA.account }">{{ errorsA.account }}</span>
              </div>

              <div class="formGroup">
                <label for="password" class="formLabel">密碼</label>
                <input
                  type="password"
                  id="password"
                  placeholder="輸入密碼"
                  v-model="artist.password"
                />
                <div class="reminder">
                  <span class="formError" :class="{ hidden: !errorsA.password }">{{ errorsA.password }}</span>
                  <router-link to="/front/memForgetPass" class="passForget">忘記密碼</router-link>
                </div>
              </div>
              <!-- <div class="btnGroup">
                <button class="btn" type="button"
                @click="router.push('/member')"
                >確定登入</button>
              </div> -->
              <div class="btnGroup">
                <button class="btn" type="button"
                @click="handleSubmitArtist"
                >確定登入</button>
              </div>
            </div>
          </div>
          
          <!-- 第三方登入區塊 -->
          <div class="thirdPartyLogin">
            <div class="separator">或使用以下方式登入</div>
            <div class="socialButtons">
              <button class="btn socialBtn google" aria-label="使用 Google 登入" @click="handleGoogleLogin">
                <font-awesome-icon :icon="['fab', 'google']" />
              </button>
              <button class="btn socialBtn line" aria-label="使用 Line 登入" @click="handleLineLogin"><font-awesome-icon :icon="['fab', 'line']" /></button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<script setup>

import { ref, reactive, onMounted, onUnmounted } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

const router = useRouter()

const currentTab = ref('general')

const general = reactive ({
  email: '',
  password: ''
})

const artist = reactive ({
  account: '',
  password: ''
})

const errors = reactive ({
  email: '',
  password: ''
})

const errorsA = reactive ({
  account: '',
  password: ''
})



function validateForm() {
  let valid = true

  // Reset errors
  Object.keys(errors).forEach(key => errors[key] = '')
  Object.keys(errorsA).forEach(key => errorsA[key] = '')

  // 一般登入信箱
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/

   if (currentTab.value === 'general') { // 針對一般會員 Tab 進行驗證
    if (!general.email.trim()) {
      errors.email = '信箱為必填'
      valid = false
    } else if (!emailRegex.test(general.email)) { // emailRegex 未定義
      errors.email = '請輸入正確的信箱格式'
      valid = false
    }
    
    // 一般登入密碼
    if (!general.password) {
      errors.password = '請輸入密碼'
      valid = false
    } else if (general.password.length < 6) {
      errors.password = '密碼需至少 6 碼'
      valid = false
    }
  }

  if (currentTab.value === 'artist') { // 針對藝術家會員 Tab 進行驗證
    // 藝術家登入帳號
    if (!artist.account.trim()) {
      errorsA.account = '請輸入緯藝提供給您的帳號'
      valid = false
    } 

    // 藝術家登入密碼
    if (!artist.password) {
      errorsA.password = '請輸入密碼'
      valid = false
    } else if (artist.password.length < 6) {
      errorsA.password = '密碼需至少 6 碼'
      valid = false
    }
  }


  return valid
}


async function handleSubmitGeneral() {
  if (currentTab.value === 'general' && validateForm()) { 
    const payload = {
      type: 'general', 
      email: general.email,
      password: general.password,
    }

    try {
      const response = await fetch(import.meta.env.VITE_MemLogin, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(payload), 
      })

      const result = await response.json()

      if (result.success) {
        localStorage.setItem('member', JSON.stringify(result.member_info))
        localStorage.setItem('memberType', payload.type); // 加這行記錄會員類型


      //   localStorage.setItem('member', JSON.stringify({
      //   id: result.member_info.id,
      //   name: result.member_info.name,
      //   type: result.member_info.type,
      //   email: result.member_info.email,
      //   account: result.member_info.account || null
      // }))

        alert('登入成功！');

        // 檢查是否有 redirect 查詢參數
        const redirectPath = router.currentRoute.value.query.redirect;
        if (redirectPath) {
          router.replace(redirectPath); // 導航回之前頁面
        } else {
          router.replace('/member'); // 否則導航到會員主頁
        }      
      } else {
        alert('登入失敗：' + result.message)
      }
    } catch (error) {
      console.error('傳送資料錯誤', error)
      alert('伺服器錯誤，請稍後再試')
    }
  }
}


async function handleSubmitArtist() {
  // 確保只驗證當前 Tab 的表單
  if (currentTab.value === 'artist' && validateForm()) { // 加上 currentTab 判斷
    // 只取出要送進資料庫的欄位
    const payload = {
      type: 'artist', // 這裡有傳送 type，但後端沒有使用
      account: artist.account,
      password: artist.password,
    }

    try {
      const response = await fetch(import.meta.env.VITE_MemLogin, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(payload), 
      })

      const result = await response.json()

      if (result.success) {
        // 成功後導向會員主頁
        localStorage.setItem('member', JSON.stringify(result.member_info))
        localStorage.setItem('memberType', payload.type); // 加這行記錄會員類型


      //   localStorage.setItem('member', JSON.stringify({
      //   id: result.member_info.id,
      //   name: result.member_info.name,
      //   type: result.member_info.type,
      //   email: result.member_info.email,
      //   account: result.member_info.account || null
      // }))

        alert('登入成功！');
        router.push('/member')
        // 同樣，這裡也需要考慮儲存會員資訊。
      } else {
        alert('登入失敗：' + result.message)
      }
    } catch (error) {
      console.error('傳送資料錯誤', error)
      alert('伺服器錯誤，請稍後再試')
    }
  }
}

function handleLineLogin() {
  const lineClientId = import.meta.env.VITE_LINE_CLIENT_ID; // 您的 LINE Channel ID
  const lineRedirectUri = import.meta.env.VITE_LINE_REDIRECT_URI; // 您的回調 URL
  const lineAuthState = 'your_random_state_string'; // 為了安全，請生成一個隨機的 state 字串
  // const lineScope = 'profile openid email'; // 請求的權限，例如 profile, openid, email
  const lineScope = 'profile openid'; // 請求的權限，例如 profile, openid


  // 將 state 存儲起來，以便回調時驗證
  localStorage.setItem('line_auth_state', lineAuthState);

  const lineAuthUrl = `https://access.line.me/oauth2/v2.1/authorize?response_type=code&client_id=${lineClientId}&redirect_uri=${encodeURIComponent(lineRedirectUri)}&state=${lineAuthState}&scope=${lineScope}`;
  
  console.log('Line Auth URL:', lineAuthUrl); // 為了除錯，您可以打印出這個 URL 看看是否正確

  window.location.href = lineAuthUrl;
}


const CLIENT_ID = import.meta.env.VITE_GOOGLE_CLIENT_ID || '360104213341-jfogr4douuub3tj81tldrdotgqs7ga1c.apps.googleusercontent.com'
const API_BASE_URL = import.meta.env.VITE_API_BASE_URL || 'http://localhost/TIBAART/api'


const loading = ref(false)
const error = ref(null)
const isGoogleReady = ref(false)


// Google SDK 載入檢查
const checkGoogleSDK = () => {
  return new Promise((resolve) => {
    const checkInterval = setInterval(() => {
      if (window.google && window.google.accounts) {
        clearInterval(checkInterval)
        resolve(true)
      }
    }, 100)
    
    // 超時處理 (10秒)
    setTimeout(() => {
      clearInterval(checkInterval)
      resolve(false)
    }, 10000)
  })
}

// 動態載入 Google Identity Services SDK
const loadGoogleSDK = () => {
  return new Promise((resolve, reject) => {
    // 檢查是否已經載入
    if (window.google && window.google.accounts) {
      resolve(true)
      return
    }

    // 檢查是否已經有 script 標籤
    if (document.querySelector('script[src*="accounts.google.com"]')) {
      checkGoogleSDK().then(resolve)
      return
    }

    const script = document.createElement('script')
    script.src = 'https://accounts.google.com/gsi/client'
    script.async = true
    script.defer = true
    
    script.onload = async () => {
      const isReady = await checkGoogleSDK()
      resolve(isReady)
    }
    
    script.onerror = () => {
      reject(new Error('Failed to load Google SDK'))
    }
    
    document.head.appendChild(script)
  })
}

// Google 登入回調函數
const handleCredentialResponse = async (response) => {
  console.log('Google login response received')
  
  if (response.credential) {
    console.log('Received Google ID Token:', response.credential)
    await handleGoogleToken(response.credential)
  } else {
    console.error('Google 登入失敗：未收到憑證')
    error.value = 'Google 登入失敗，請重試。'
  }
}

// 初始化 Google Identity Services
const initializeGoogle = async () => {
  try {
    const isLoaded = await loadGoogleSDK()
    
    if (!isLoaded) {
      throw new Error('Google SDK 載入失敗')
    }

    // 設定全域回調函數
    window.handleCredentialResponse = handleCredentialResponse

    // 初始化 Google Identity Services
    window.google.accounts.id.initialize({
      client_id: CLIENT_ID,
      callback: handleCredentialResponse,
      auto_prompt: false,
      cancel_on_tap_outside: true,
      context: 'signin',
      itp_support: true
    })

    isGoogleReady.value = true
    console.log('Google Identity Services 初始化成功')
    
  } catch (err) {
    console.error('Google Identity Services 初始化失敗:', err)
    error.value = 'Google 登入功能初始化失敗，請重新整理頁面重試。'
  }
}

// 處理 Google 登入按鈕點擊
const handleGoogleLogin = () => {
  if (!isGoogleReady.value) {
    error.value = 'Google 登入功能尚未準備好，請稍後再試。'
    return
  }

  error.value = null
  
  try {
    // 方法1: 使用 One Tap 彈窗
    window.google.accounts.id.prompt((notification) => {
      console.log('Prompt notification:', notification)
      
      if (notification.isNotDisplayed()) {
        console.log('One Tap 無法顯示，改用 OAuth2 流程')
        // 如果 One Tap 無法顯示，使用 OAuth2 流程
        initiateOAuth2Flow()
      }
    })
    
  } catch (err) {
    console.error('Google 登入流程錯誤:', err)
    error.value = '啟動 Google 登入時發生錯誤。'
  }
}

// OAuth2 流程 (備用方法)
const initiateOAuth2Flow = () => {
  const client = window.google.accounts.oauth2.initCodeClient({
    client_id: CLIENT_ID,
    scope: 'openid email profile',
    ux_mode: 'popup',
    callback: (response) => {
      console.log('OAuth2 response:', response)
      if (response.code) {
        // 處理授權碼
        handleAuthCode(response.code)
      }
    },
  })
  
  client.requestCode()
}

// 處理授權碼 (OAuth2 流程)
const handleAuthCode = async (code) => {
  loading.value = true
  error.value = null
  
  try {
    const response = await axios.post(`${API_BASE_URL}/googleAuthCode.php`, {
      code: code
    })
    
    if (response.data.success) {
      console.log('OAuth2 授權成功:', response.data.user)
      await handleLoginSuccess(response.data)
    } else {
      error.value = response.data.message || 'Google 登入失敗。'
    }
  } catch (err) {
    console.error('OAuth2 授權處理錯誤:', err)
    error.value = '登入過程中發生錯誤，請稍後再試。'
  } finally {
    loading.value = false
  }
}

// 處理 Google ID Token
const handleGoogleToken = async (idToken) => {
  loading.value = true
  error.value = null
  
  try {
    const response = await axios.post(`${API_BASE_URL}/googleVerifyToken.php`, {
      idToken: idToken
    }, {
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      timeout: 10000 // 10秒超時
    })

    if (response.data.success) {
      console.log('後端驗證成功，用戶已登入:', response.data.user)
      await handleLoginSuccess(response.data)
    } else {
      error.value = response.data.message || 'Google 登入失敗。'
    }
  } catch (err) {
    console.error('Google 登入 API 請求錯誤:', err)
    
    if (err.code === 'ECONNABORTED') {
      error.value = '登入請求超時，請檢查網路連線。'
    } else if (err.response?.status === 401) {
      error.value = 'Google 登入驗證失敗，請重試。'
    } else if (err.response?.status >= 500) {
      error.value = '伺服器錯誤，請稍後再試。'
    } else {
      error.value = '登入過程中發生錯誤，請稍後再試。'
    }
  } finally {
    loading.value = false
  }
}

// 處理登入成功
const handleLoginSuccess = async (data) => {
  try {
    // 儲存認證資訊
    if (data.token) {
      localStorage.setItem('authToken', data.token)
    }
    
    if (data.refreshToken) {
      localStorage.setItem('refreshToken', data.refreshToken)
    }
    
    if (data.user) {
      localStorage.setItem('user', JSON.stringify(data.user))
    }
    
    // 設定 axios 預設 header
    if (data.token) {
      axios.defaults.headers.common['Authorization'] = `Bearer ${data.token}`
    }
    
    // 發出登入成功事件 (如果有使用 event bus 或 store)
    // this.$emit('login-success', data.user)
    
    console.log('登入成功，準備跳轉')
    
    // 跳轉到指定頁面
    const redirect = new URLSearchParams(window.location.search).get('redirect') || '/dashboard'
    await router.push(redirect)
    
  } catch (err) {
    console.error('處理登入成功資料時發生錯誤:', err)
    error.value = '登入後處理發生錯誤。'
  }
}

// 清理錯誤訊息
const clearError = () => {
  error.value = null
}

// 組件掛載
onMounted(async () => {
  console.log('開始初始化 Google 登入')
  await initializeGoogle()
})

// 組件卸載清理
onUnmounted(() => {
  // 清理全域變數
  if (window.handleCredentialResponse) {
    delete window.handleCredentialResponse
  }
})

// 導出方法供父組件使用
defineExpose({
  handleGoogleLogin,
  clearError,
  isGoogleReady: isGoogleReady.value
})



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


