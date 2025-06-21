<template>
    <AdminTable :columns="columns" :data="data" 
    @view-more="openModal"
    @add="openAddModal"
    @toggle-status="updateStatus"
    />

    <transition name="fade">
      <div v-if="showMore" class="modal-overlay" @click.self="showMore = false">
        <div class="modal-content">
          <h3>藝術家詳細資料</h3>
          <p>編號：{{ selectedArtist.id }}</p>
          <p>名稱：{{ selectedArtist.name }}</p>
          <p>Email：{{ selectedArtist.email }}</p>
          <p>連絡電話：{{ selectedArtist.phone }}</p>
          <p>生日：{{ selectedArtist.birthday }}</p>
          <p>性別：{{ selectedArtist.gender }}</p>
          <p>銀行帳戶：{{ selectedArtist.bank_account }}</p>
          <p>藝術家簡介：{{ selectedArtist.intro }}</p>
          <p>修改時間：{{ selectedArtist.updated }}</p>
        </div>
    </div>
    </transition>

    <transition name="fade">
      <div v-if="showAdd" class="modal-overlay" @click.self="showAdd = false">
        <div class="modal-content">
          <h3>新增藝術家會員資料</h3>
          <label><span>*</span>藝術家簡介頭像：<input type="file" name="img" @change="handleFileChange" /></label>
          <label><span>*</span>藝術家名稱：<input v-model="newData.name" /></label>
          <label><span>*</span>Email：<input v-model="newData.email" /></label>
          <label><span>*</span>連絡電話：<input v-model="newData.phone" /></label>
          <label>生日：<input v-model="newData.birthday" type="date" /></label>
          <label>性別：
            <select v-model="newData.gender">
              <option value="M">男</option>
              <option value="F">女</option>
              <option value="Other">不公開</option>
            </select>
          </label>
          <label><span>*</span>銀行帳戶：<input v-model="newData.bank_account" /></label>
          <label><span>*</span>藝術家簡介：<textarea v-model="newData.intro"></textarea></label>
          <label><span>*給予帳號</span>：<input v-model="newData.account" /></label>
          <label><span>*給予密碼</span>：<input v-model="newData.password" /></label>
          <div class="btn-content">
            <button class="btn" @click="addData">送出</button>
            <button class="btn" @click="showAdd = false">取消</button>
          </div>
        </div>
      </div>
    </transition>

</template>

<script setup>
import { ref, onMounted } from "vue";
import AdminTable from '@/components/AdminTable.vue'

// 欄位設定
const columns = [
  { key: 'id', label: '藝術家編號', class:'w-120'},
  { key: 'name', label: '藝術家名稱'},
  { key: 'email', label: 'Email'},
  { key: 'phone', label: '連絡電話'},
  { key: 'updated', label: '修改時間'},
  { key: 'per', label: '狀態', type:'switch', class:'w-80'},
  { key: 'more', label: '詳細', type: 'button', buttonLabel: '查看', class:'w-80'}
]

// 狀態變數
const showMore = ref(false)
const showAdd = ref(false)
const imageFile = ref(null);
const data = ref([])
const selectedArtist = ref({})

// 新增表單資料
const newData = ref({
  name: '',
  email: '',
  phone: '',
  birthday: '',
  gender: 'Other',
  bank_account: '',
  intro: '',
  account: '',
  password: ''
})

// 開啟新增 modal
function openAddModal() {
  showAdd.value = true
}

function handleFileChange(e) {
  imageFile.value = e.target.files[0]
}

// 新增時同步畫面呈現
async function fetchArtists() {
  const resp = await fetch(import.meta.env.VITE_AdminArtist)
  let artists = await resp.json()

  // 把 TINYINT(1) 的權限轉為 Boolean 顯示用
  artists = artists.map(artist => ({
    ...artist,
    per: Boolean(artist.per),
    gender: convertGender(artist.gender)
  }))

  data.value = artists
}

// 轉換性別顯示
function convertGender(i) {
  switch (i) {
    case 'M': return '男'
    case 'F': return '女'
    case 'Other': return '不公開'
  }
}

function cleanForm() {
  newData.value = {
    name: '',
    email: '',
    phone: '',
    birthday: '',
    gender: 'Other',
    bank_account: '',
    intro: '',
    account: '',
    password: ''
  }
  imageFile.value = null;
}

// 新增資料
async function addData() {
  if (!imageFile.value || 
      !newData.value.name ||
      !newData.value.email ||
      !newData.value.phone ||
      !newData.value.bank_account ||
      !newData.value.intro ||
      !newData.value.account ||
      !newData.value.password
    ) {
    alert('必要資料需全部填寫')
    return
  }

  try {
    //  上傳圖片
    const formData = new FormData()
    formData.append('img', imageFile.value)

    const uploadResp = await fetch(import.meta.env.VITE_UploadArtistHeadshot, {
      method: 'POST',
      body: formData
    })
    console.log(formData)
    for (let pair of formData.entries()) {
      console.log(pair[0], pair[1]);
    }

    const uploadResult = await uploadResp.json();
    if (!uploadResult.success) throw new Error(uploadResult.message || '圖片上傳失敗');

    const resp = await fetch(import.meta.env.VITE_AddArtist, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        ...newData.value,
        img: uploadResult.url,
      })
    })

    if (!resp.ok) {
      const errText = await resp.text()
      throw new Error(`新增失敗：${errText}`)
    }

    const result = await resp.json();
    if (resp.ok) {
      showAdd.value = false;
      cleanForm();              // 清空表單
      imageFile.value = null;   // 清空圖片
      fetchArtists(); 
    } else {
      throw new Error(result.error || '新增失敗');
    }

  } catch (err) {
    alert(`新增失敗：${err.message}`)
  }
}


// 切換狀態
async function updateStatus(row) {
  try {
    const resp = await fetch(import.meta.env.VITE_UpdatePerStatus, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        id: row.id,
        per: row.per ? 1 : 0,
        type: 'artist'  //抓資料表
      })
    })
    
    if (!resp.ok) throw new Error('狀態更新失敗')
      console.log('狀態更新成功')
  } catch (err) {
    alert(`狀態更新失敗：${err.message}`)
  }
}

// 查看詳細
function openModal(row) {
  selectedArtist.value = row
  showMore.value = true
}

// 讀取資料
onMounted(async () => fetchArtists())

</script>

<style lang="scss" scoped>
@import '/style.scss';
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.3s ease;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,0.6);
  display: flex;
  align-items: center;
  justify-content: center;
}
.modal-content {
  background: white;
  width: 50%;
  h3{
    font-size: 24px;
    background-color: $primaryGreen;
    padding: $spacing-4;
    color: #FFF;
  }
  p{
    font-size: 20px;
    padding: $spacing-3;
  }
  label{
    display: flex;
    align-items: center;
    padding: $spacing-3;
    span{
      color: $fontWarn;
    }
    input, select{
      height: 32px;
      font-size: 16px;
    }

  }
  .btn-content{
    display: flex;
    gap: $spacing-3;
    justify-content: center;
    padding: $spacing-3;
  }
}
</style>
