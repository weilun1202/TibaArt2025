<template>
  <div>
    <div id="g_id_signin"></div>

    <div id="g_id_onload"
         :data-client_id="CLIENT_ID"
         data-callback="handleCredentialResponse"
         data-auto_prompt="false"> </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

const CLIENT_ID = '您的用戶端 ID'; // 從 GCP 獲取的用戶端 ID
const emit = defineEmits(['google-token-received']); // 定義一個事件，用於將 ID Token 發送給父組件

// 這裡我們將 handleCredentialResponse 定義為全局函數，因為 Google SDK 是這樣調用的
// 或者您可以將其綁定到 window 對象上
let originalHandleCredentialResponse;

onMounted(() => {
  // 檢查 window.google 是否已經載入
  if (window.google && window.google.accounts) {
    window.google.accounts.id.initialize({
      client_id: CLIENT_ID,
      callback: handleCredentialResponse, // Google 成功登入後的回調函數
      auto_prompt: false // 不自動彈出 One Tap，等待用戶點擊按鈕
    });

    // 渲染 Google 登入按鈕
    window.google.accounts.id.renderButton(
      document.getElementById('g_id_signin'), // 渲染按鈕的 DOM 元素
      {
        theme: 'outline',       // 按鈕主題
        size: 'large',          // 按鈕大小
        text: 'signin_with',    // 按鈕文字
        shape: 'rectangular',   // 按鈕形狀
        logo_alignment: 'left'  // Logo 對齊方式
      }
    );

    // 如果您也希望自動彈出 Google One Tap 登入視窗
    // window.google.accounts.id.prompt();

  } else {
    console.error('Google Identity Services SDK 未載入或初始化失敗');
  }
});

// 處理 Google 回傳的憑證 (這個函數會被 Google SDK 調用)
// 為了讓 Google SDK 能夠訪問，將其掛載到 window 對象
const handleCredentialResponse = (response) => {
  if (response.credential) {
    console.log('Received Google ID Token:', response.credential);
    emit('google-token-received', response.credential); // 發送給父組件
  } else {
    console.error('Google 登入失敗：未收到憑證');
  }
};

// 在組件銷毀時清理，避免重複初始化
onUnmounted(() => {
  if (window.google && window.google.accounts) {
    window.google.accounts.id.cancel(); // 取消任何待處理的 One Tap 或彈出
  }
});
</script>

<style scoped>
/* 可以為按鈕容器添加樣式 */
#g_id_signin {
  display: inline-block; /* 確保按鈕正確顯示 */
}
</style>