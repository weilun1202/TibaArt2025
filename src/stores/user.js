import { defineStore } from 'pinia'
import { ref, computed } from 'vue'

export const useUserStore = defineStore('user', {
  // 狀態定義
  state: () => {
    // 在 state 初始化時就從 localStorage 讀取
    let memberInfo = { id: '', email: '' }
    let memberType = 'general'
    
    try {
      const member = JSON.parse(localStorage.getItem('member'))
      const storedMemberType = localStorage.getItem('memberType')
      
      if (member) {
        memberInfo = {
          id: member.id || '',
          email: member.email || ''
        }
      }
      
      if (storedMemberType) {
        memberType = storedMemberType
      }
    } catch (error) {
      console.error('從 localStorage 載入會員資訊失敗:', error)
    }

    return {
      // 會員資料
      memberData: {
        name: '',
        gender: '',
        birthday: '',
        email: '',
        phone: '',
        password: '',
        cPassword: '',
        bank_account: '',
        type: '',
        img: ''
      },
      // 會員基本資訊 (從 localStorage 來的) - 現在會自動載入
      memberInfo: memberInfo,
      // 會員類型 - 現在會自動載入
      memberType: memberType,
      // 載入狀態
      loading: false,
      // 錯誤訊息
      error: null,
      // 表單驗證錯誤
      errors: {
        name: '',
        gender: '',
        birthday: '',
        phone: '',
        password: '',
        cPassword: '',
        bank_account: ''
      }
    }
  },
  // 計算屬性 (getters)
  getters: {
    // 取得解碼後的會員 ID
    decodedMemberId: (state) => {
      try {
        return state.memberInfo.id ? atob(state.memberInfo.id) : ''
      } catch (error) {
        console.error('解碼會員 ID 失敗:', error)
        return ''
      }
    },

    // 檢查是否已登入
    isLoggedIn: (state) => {
      return !!(state.memberInfo.id && state.memberInfo.email)
    },

    // 檢查會員類型
    isGeneralMember: (state) => state.memberType === 'general',
    isArtistMember: (state) => state.memberType === 'artist',

    // 根據會員類型顯示不同的標題
    memberTypeLabel: (state) => {
      return state.memberType === 'artist' ? '藝術家會員' : '會員'
    },

    // 取得最大生日日期字串 (18歲限制)
    maxBirthdayStr: () => {
      const today = new Date()
      const maxBirthday = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate())
      return maxBirthday.toISOString().split('T')[0]
    },

    // 檢查表單是否有效
    isFormValid: (state) => {
      return Object.values(state.errors).every(error => error === '')
    }
  },

  // 方法 (actions)
  actions: {
    // 從 localStorage 載入會員資訊
    loadFromLocalStorage() {
      try {
        const member = JSON.parse(localStorage.getItem('member'))
        const memberType = localStorage.getItem('memberType') || 'general'
        
        if (member) {
          this.memberInfo = {
            id: member.id,
            email: member.email
          }
          this.memberType = memberType
        }
      } catch (error) {
        console.error('從 localStorage 載入會員資訊失敗:', error)
        this.error = '載入會員資訊失敗'
      }
    },

    // 設置會員登入資料
    setMemberData(memberData, memberType = 'general') {
      // 更新會員基本資訊
      this.memberInfo = {
        id: memberData.id,
        email: memberData.email
      }
      
      // 更新會員詳細資料
      this.memberData = {
        ...this.memberData,
        ...memberData
      }
      
      this.memberType = memberType
      
      // 儲存到 localStorage
      localStorage.setItem('member', JSON.stringify({
        id: memberData.id,
        email: memberData.email
      }))
      localStorage.setItem('memberType', memberType)
    },

    // 登出功能
    logout() {
      // 重置所有狀態
      this.memberData = {
        name: '',
        gender: '',
        birthday: '',
        email: '',
        phone: '',
        password: '',
        cPassword: '',
        bank_account: '',
        type: '',
        img: ''
      }
      
      this.memberInfo = {
        id: '',
        email: ''
      }
      
      this.memberType = 'general'
      this.error = null
      this.clearErrors()
      
      // 清除 localStorage
      localStorage.removeItem('member')
      localStorage.removeItem('memberType')
    },

    // 檢查登入狀態的方法（用於需要登入的操作）
    requireLogin() {
      if (!this.isLoggedIn) {
        return false
      }
      return true
    },

    // 從 API 獲取會員詳細資料
    async fetchMemberInfo() {
      if (!this.decodedMemberId) {
        this.error = '找不到會員 ID'
        return false
      }

      this.loading = true
      this.error = null

      try {
        const response = await fetch('http://localhost/TIBAART/getMemberInfo.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ 
            id: this.decodedMemberId, 
            type: this.memberType 
          })
        })

        const result = await response.json()
        
        if (result.success) {
          const info = result.member_info
          this.memberData = {
            name: info.name,
            email: atob(info.email),
            phone: atob(info.phone),
            birthday: atob(info.birthday),
            gender: atob(info.gender),
            bank_account: info.bank_account ? atob(info.bank_account) : '',
            password: '',
            cPassword: '',
            type: this.memberType,
            img: info.img || '' // 載入會員頭像
          }
          return true
        } else {
          this.error = result.message || '獲取會員資料失敗'
          return false
        }
      } catch (error) {
        console.error('API 請求失敗:', error)
        this.error = '網路連線錯誤'
        return false
      } finally {
        this.loading = false
      }
    },

    // 表單驗證
    validateForm() {
      let valid = true

      // 重置錯誤訊息
      Object.keys(this.errors).forEach(key => this.errors[key] = '')

      // 姓名驗證
      if (!this.memberData.name.trim()) {
        this.errors.name = '姓名為必填'
        valid = false
      } else if (this.memberData.name.length < 2) {
        this.errors.name = '姓名至少兩個字'
        valid = false
      }

      // 密碼驗證
      if (this.memberData.password || this.memberData.cPassword) {
        if (this.memberData.password.length < 6) {
          this.errors.password = '密碼至少需 6 碼'
          valid = false
        }
        if (this.memberData.password !== this.memberData.cPassword) {
          this.errors.cPassword = '兩次密碼不一致'
          valid = false
        }
      }

      // 手機驗證
      if (this.memberData.phone.length !== 10 || !this.memberData.phone.startsWith('09')) {
        this.errors.phone = '請輸入09開頭的10碼手機格式'
        valid = false
      }

      // 生日驗證
      if (this.memberData.birthday === '') {
        this.errors.birthday = '請選擇生日'
        valid = false
      }

      // 性別驗證
      if (this.memberData.gender === '') {
        this.errors.gender = '請選擇性別'
        valid = false
      }

      // 銀行帳戶驗證 (藝術家會員必填)
      if (this.memberType === 'artist') {
        if (!this.memberData.bank_account.trim()) {
          this.errors.bank_account = '藝術家會員必須填寫銀行帳戶'
          valid = false
        }
      }

      return valid
    },

    // 儲存會員資料
    async saveProfile() {
      if (!this.validateForm()) {
        return { success: false, message: '表單驗證失敗' }
      }

      this.loading = true
      this.error = null

      try {
        const dataToSend = {
          ...this.memberData,
          id: this.decodedMemberId,
          type: this.memberType
        }

        // 如果密碼是空的，就不要送去後端
        if (!this.memberData.password) {
          delete dataToSend.password
          delete dataToSend.cPassword
        }

        const response = await fetch('http://localhost/TIBAART/updateMemberInfo.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(dataToSend)
        })

        const result = await response.json()

        if (result.success) {
          // 清空密碼欄
          this.memberData.password = ''
          this.memberData.cPassword = ''

          if (result.member_info) {
            const info = result.member_info
            this.memberData.name = info.name
            this.memberData.email = atob(info.email)
            this.memberData.phone = atob(info.phone)
            this.memberData.birthday = atob(info.birthday)
            this.memberData.gender = atob(info.gender)

            if (info.bank_account) {
              this.memberData.bank_account = atob(info.bank_account)
            }
            
            // 更新頭像
            if (info.img) {
              this.memberData.img = info.img
            }
          } else {
            // 如果沒有 member_info，重新獲取會員資料
            console.log('後端沒有回傳 member_info，重新獲取資料')
            await this.fetchMemberInfo()
          }
          return { success: true, message: '資料已成功更新！' }
        } else {
          this.error = result.message || '更新失敗'
          return { success: false, message: result.message || '更新失敗' }
        }
      } catch (error) {
        console.error('更新會員資料失敗:', error)
        this.error = '網路連線錯誤'
        return { success: false, message: '網路連線錯誤' }
      } finally {
        this.loading = false
      }
    },

    // 清除錯誤訊息
    clearErrors() {
      Object.keys(this.errors).forEach(key => this.errors[key] = '')
      this.error = null
    },

    // 重置密碼欄位
    resetPasswordFields() {
      this.memberData.password = ''
      this.memberData.cPassword = ''
    }
  }
})