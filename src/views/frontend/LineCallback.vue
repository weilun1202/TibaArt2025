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

  let finalRedirectPath = '/member'; // 預設的跳轉路徑

  // 1. 驗證 state 以防止 CSRF 攻擊。
  //    state 必須存在且與 localStorage 中存儲的 state 完全匹配。
  if (!state || state !== storedState) {
    alert('LINE 登入失敗：狀態驗證錯誤或過期！');
    router.replace('/front/memLogin'); // 導回登入頁
    return;
  }

  // 2. 如果 state 驗證通過，從 state 中解析出 redirect 路徑。
  try {
      const parts = state.split('_'); // 根據 MemLogin.vue 中的_分隔符號拆分
      if (parts.length > 1) {
          const encodedRedirect = parts[parts.length - 1]; // 最後一部分是 Base64 編碼的路徑
          const decodedRedirect = atob(encodedRedirect); // Base64 解碼
          if (decodedRedirect) {
              finalRedirectPath = decodedRedirect; // 更新最終跳轉路徑
          }
      }
  } catch (e) {
      console.error('從 LINE state 中解碼重定向路徑失敗:', e);
      // 如果解碼失敗，則使用預設的 /member 路徑，並繼續處理登入
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
        // 無需將 state 傳遞給 lineLogin.php，因為後端不需要它進行登入處理。
        // state 僅用於前端 CSRF 驗證和導航。
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
      // 3. 使用解析出的 finalRedirectPath 進行導航
      router.replace(finalRedirectPath);
      
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