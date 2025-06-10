<template>
    <div class="memWrap">
        <!-- 動態顯示會員類型 -->
        <h2>{{ userStore.memberTypeLabel }}基本資料</h2>

        <!-- 會員類型指示器 -->
        <div class="member-type-badge" :class="memberTypeBadgeClass">
        </div>

        <!-- 載入狀態 -->
        <div v-if="userStore.loading" class="loading">
            資料載入中...
        </div>

        <!-- 錯誤訊息 -->
        <div v-if="userStore.error" class="error-message">
            {{ userStore.error }}
        </div>

        <div class="member-profile-edit">
            <div class="formA">
                <div class="formGroup">
                    <label for="name" class="formLabel">姓名</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="輸入姓名"
                        v-model="userStore.memberData.name"
                    />
                    <span v-if="userStore.errors.name" class="formError">{{ userStore.errors.name }}</span>
                </div>

                <div class="formGroup">
                    <label for="gender" class="formLabel">性別</label>
                    <select id="gender" name="gender" class="formSelect" v-model="userStore.memberData.gender">
                        <option value="">請選擇</option>
                        <option value="M">男</option>
                        <option value="F">女</option>
                        <option value="Other">其他</option>
                    </select>
                    <span v-if="userStore.errors.gender" class="formError">{{ userStore.errors.gender }}</span>
                </div>

                <div class="formGroup">
                    <label for="birthday" class="formLabel">生日</label>
                    <input
                        type="date"
                        id="birthday"
                        name="birthday"
                        :max="userStore.maxBirthdayStr"
                        v-model="userStore.memberData.birthday"
                    />
                    <span v-if="userStore.errors.birthday" class="formError">{{ userStore.errors.birthday }}</span>
                </div>

                <div class="formGroup">
                    <label for="email" class="formLabel">電子郵件</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="輸入電子郵件"
                        v-model="userStore.memberData.email"
                        readonly 
                    />
                </div>

                <div class="formGroup">
                    <label for="phone" class="formLabel">手機號碼</label>
                    <input
                        type="tel"
                        id="phone"
                        name="phone"
                        placeholder="輸入手機號碼"
                        v-model="userStore.memberData.phone"
                    />
                    <span v-if="userStore.errors.phone" class="formError">{{ userStore.errors.phone }}</span>
                </div>

                <div class="formGroup">
                    <label for="password" class="formLabel">修改密碼</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="至少 6 碼"
                        v-model="userStore.memberData.password"
                    />
                    <span class="formError" v-if="userStore.errors.password">{{ userStore.errors.password }}</span>
                </div>

                <!-- 確認密碼 -->
                <div class="formGroup">
                    <label for="cPassword" class="formLabel">確認新密碼</label>
                    <input
                        type="password"
                        id="cPassword"
                        name="cPassword"
                        placeholder="再次輸入密碼"
                        v-model="userStore.memberData.cPassword"
                    />
                    <span class="formError" v-if="userStore.errors.cPassword">{{ userStore.errors.cPassword }}</span>
                </div>

                <!-- 銀行帳戶：只有藝術家會員才顯示 -->
                <div class="formGroup" v-if="userStore.isArtistMember || userStore.memberData.bank_account">
                    <label for="bank_account" class="formLabel">
                        銀行帳戶
                    </label>
                    <input
                        type="text"
                        id="bank_account"
                        name="bank_account"
                        placeholder="輸入銀行帳戶"
                        v-model="userStore.memberData.bank_account"
                    />
                    <span v-if="userStore.errors.bank_account" class="formError">{{ userStore.errors.bank_account }}</span>
                </div>

                <button 
                    class="btn saveBtn" 
                    type="button" 
                    @click="handleSaveProfile"
                    :disabled="userStore.loading"
                >
                    {{ userStore.loading ? '儲存中...' : '儲存修改' }}
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, onMounted } from 'vue'
import { useUserStore } from '@/stores/user'

// 使用 user store
const userStore = useUserStore()

// 會員類型徽章樣式
const memberTypeBadgeClass = computed(() => ({
  'badge-general': userStore.isGeneralMember,
  'badge-artist': userStore.isArtistMember
}))

// 組件掛載時初始化
onMounted(async () => {
  // 從 localStorage 載入會員資訊
  userStore.loadFromLocalStorage()
  
  // 如果有會員資訊，則獲取詳細資料
  if (userStore.isLoggedIn) {
    await userStore.fetchMemberInfo()
  }
})

// 處理儲存資料
const handleSaveProfile = async () => {
  const result = await userStore.saveProfile()
  
  if (result.success) {
    alert(result.message)
  } else {
    alert('更新失敗：' + result.message)
  }
}
</script>

<style lang="scss" scoped>
@import '/style.scss';

.memWrap{

    padding-top: 40px;
    text-align: center;


    h2{
        font-size: map-get($font, h2);
        font-weight: bold;
        text-align: center;

        @media (max-width: 1200px){
        font-size: map-get($font, h3);
    }

    }

    .formA{
        // border: 1px solid;
        padding: 60px 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 20px;
    
        .formGroup{
            margin: 0 auto;

          @media (max-width: 560px){
            width: 100%;
            
        
          }

        }
    
        .saveBtn{
            margin: 24px auto;
            width: auto;
            aspect-ratio: 2/1;
            font-size: 16px;
        }


    }



}



</style>