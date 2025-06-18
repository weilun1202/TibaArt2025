<template>
  <div class="wrapper">
    <p>正在處理 LINE 登入中...</p>
  </div>
</template>

<script setup>
import { onMounted } from 'vue';
import { useRouter, useRoute } from 'vue-router';

const router = useRouter();
const route = useRoute();

onMounted(async () => {

  //  ?? '' 是fallback 防呆 避免有奇怪的情況下錯誤
  const code = route.query.code ?? '';
  const state = route.query.state ?? '';

  const storedState = localStorage.getItem('line_auth_state');
  localStorage.removeItem('line_auth_state'); // 使用後移除 state

  // 驗證 state 以防止 CSRF 攻擊
  if (!state || state !== storedState) {
    alert('LINE 登入失敗：狀態驗證錯誤！');
    router.replace('/front/memLogin'); // 導回登入頁
    return;
  }

  if (!code) {
    alert('LINE 登入失敗：未收到授權碼');
    router.replace('/front/memLogin');
    return;
  }

  try {
    // 將 code 發送到後端做 token 換取及會員處理
    console.log('呼叫 API:', import.meta.env.VITE_LINE_TOKEN_EXCHANGE_API);

    const response = await fetch(import.meta.env.VITE_LINE_TOKEN_EXCHANGE_API, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        code,
        redirect_uri: import.meta.env.VITE_LINE_REDIRECT_URI,
      }),
    });

    const result = await response.json();

    if (result.success) {
      try {
        localStorage.setItem('member', JSON.stringify(result.member_info));
        localStorage.setItem('memberType', result.member_info.type);
      } catch (e) {
        console.warn('localStorage 寫入失敗', e);
      }

      alert('LINE 登入成功！');
      router.replace('/member');
    } else {
      // 根據不同錯誤代碼處理
      switch (result.errorCode) {
        case 'EMAIL_EXISTS':
          alert(result.message);
          router.replace('/front/memLogin');
          break;
        default:
          alert('LINE 登入失敗：' + (result.message || '未知錯誤'));
          router.replace('/front/memLogin');
      }
    }
  } catch (error) {
    console.error('LINE 登入處理錯誤', error);
    alert('伺服器錯誤，請稍後再試');
    router.replace('/front/memLogin');
  }
});
</script>

<style lang="scss" scoped>

@import '/style.scss';

.wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

    height: calc(100vh - 192px);
  }
</style>