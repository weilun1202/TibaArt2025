<template>
  <div>
    <p>正在處理 LINE 登入中...</p>
  </div>
</template>

<script setup>
import { onMounted } from 'vue';
import { useRouter, useRoute } from 'vue-router';

const router = useRouter();
const route = useRoute();

onMounted(async () => {
  const code = route.query.code;
  const state = route.query.state;
  const storedState = localStorage.getItem('line_auth_state');

  // 驗證 state 以防止 CSRF 攻擊
  if (!state || state !== storedState) {
    alert('LINE 登入失敗：狀態驗證錯誤！');
    router.replace('/front/memLogin'); // 導回登入頁
    return;
  }

  localStorage.removeItem('line_auth_state'); // 使用後移除 state

  if (code) {
    try {
      // 將 code 發送到您的後端進行處理
      const response = await fetch(import.meta.env.VITE_LINE_TOKEN_EXCHANGE_API, { // 您的後端 API 端點
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ code, redirect_uri: import.meta.env.VITE_LINE_REDIRECT_URI }),
      });

      const result = await response.json();

      if (result.success) {
        localStorage.setItem('member', JSON.stringify(result.member_info));
        localStorage.setItem('memberType', result.member_info.type);
        alert('LINE 登入成功！');
        router.replace('/member');
      } else if (result.errorCode === 'EMAIL_EXISTS') {
        // 彈出提示，告知 Email 已註冊
        alert(result.message);
        router.replace('/front/memLogin'); // 導回登入頁
      } else {
        alert('LINE 登入失敗：' + result.message);
        router.replace('/front/memLogin');
      }
    } catch (error) {
      console.error('LINE 登入處理錯誤', error);
      alert('伺服器錯誤，請稍後再試');
      router.replace('/front/memLogin'); // 導回登入頁
    }
  } else {
    alert('LINE 登入失敗：未收到授權碼');
    router.replace('/front/memLogin'); // 導回登入頁
  }
});
</script>