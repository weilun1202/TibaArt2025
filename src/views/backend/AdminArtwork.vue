<template>
    <AdminTable 
      :columns="columns" 
      :data="data"
      @add="openAddModal"
      />
      <!-- @edit="openEditModal" -->

    <transition name="fade">
      <div v-if="showAdd" class="modal-overlay" @click.self="showAdd = false">
        <div class="modal-content">
          <h3>新增作品資料</h3>
          <label>
            <span>*</span> 藝術家：
            <select v-model="newData.artist_id">
              <option disabled value="">請選擇藝術家</option>
              <option v-for="artist in artists" :key="artist.id" :value="artist.id">
                {{ artist.name }}
              </option>
            </select>
          </label>
          <label><span>*</span>圖片：<input type="file" name="img" @change="handleFileChange" /></label>
          <label><span>*</span>作品名稱：<input v-model="newData.name" /></label>
          <label><span>*</span>英文名稱：<input v-model="newData.name_en" /></label>
          <label><span>*</span>媒材：<input v-model="newData.stuff" /></label>
          <label><span>*</span>尺寸：<input v-model="newData.size" /></label>
          <label><span>*</span>備註：<input v-model="newData.note" /></label>

          <div class="btn-content">
            <button class="btn" @click="addData">送出</button>
            <button class="btn" @click="showAdd = false">取消</button>
          </div>
        </div>
      </div>
    </transition>

    <!-- <EditModal
      :show="showEdit"
      :data="selectedRow"
      :fields="editFields"
      title="編輯作品"
      @close="showEdit = false"
      @update="updateData"
    /> -->
</template>

<script setup>
import { ref, onMounted } from "vue";
import AdminTable from '@/components/AdminTable.vue'
// import EditModal from '@/components/AdminEditModal.vue'


// 欄位設定
const columns = [
  { key: 'id', label: '作品編號', class:'w-100' },
  { key: 'img', label: '作品圖片', type: 'image'},
  { key: 'name', label: '作品名稱' },
  { key: 'artist', label: '作者' },
  { key: 'size', label: '尺寸' },
  { key: 'note', label: '備註' },
  { key: 'edit', label: '操作', type: 'edit', buttonLabel: '編輯', class:'w-80' }
]

const data = ref([]);
const showAdd = ref(false)
const imageFile = ref(null);
// const showEdit = ref(false)
// const selectedRow = ref({})

// 新增表單資料
const newData = ref({
  artist_id: '',
  name: '',
  name_en: '',
  stuff: '',
  size: '',
  note: '',
})

function openAddModal() {
  showAdd.value = true
}

function handleFileChange(e) {
  imageFile.value = e.target.files[0]
}

// 載入藝術家清單
const artists = ref([]);
async function fetchArtistsList() {
  const resp = await fetch(import.meta.env.VITE_GetArtists);
  artists.value = await resp.json();
}

// 新增時同步畫面呈現
async function fetchArtworks() {
  const resp = await fetch(import.meta.env.VITE_AdminArtwork)
  let artworks = await resp.json()

  data.value = artworks
}

function cleanForm() {
  newData.value = {
    artist_id: '',
    name: '',
    name_en: '',
    stuff: '',
    size: '',
    note: '',
  }
  imageFile.value = null;
}

// 新增資料
async function addData() {
  if (!imageFile.value || 
      !newData.value.artist_id || 
      !newData.value.name || 
      !newData.value.name_en || 
      !newData.value.stuff || 
      !newData.value.size || 
      !newData.value.note 
    ) {
    alert('請填寫所有欄位');
    return;
  }

  try {
    //  上傳圖片
    const formData = new FormData()
    formData.append('img', imageFile.value)

    const uploadResp = await fetch(import.meta.env.VITE_UploadArtworkImage, {
      method: 'POST',
      body: formData
    })
    console.log(formData)
    for (let pair of formData.entries()) {
      console.log(pair[0], pair[1]);
    }

    const uploadResult = await uploadResp.json();
    if (!uploadResult.success) throw new Error(uploadResult.message || '圖片上傳失敗');

    const resp = await fetch(import.meta.env.VITE_AddArtwork, {
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
      fetchArtworks(); 
    } else {
      throw new Error(result.error || '新增失敗');
    }
  } catch (err) {
    alert(`新增失敗：${err.message}`);
  }
}

// 編輯資料
// const editFields = [
//   { key: 'name', label: '作品名稱' },
//   { key: 'name_en', label: '作品名稱' },
//   { key: 'artist_id', label: '作者' },
//   { key: 'stuff', label: '媒材'  },
//   { key: 'size', label: '尺寸'  },
//   { key: 'note', label: '備註', type: 'textarea'},
//   { key: 'img', label: '作品圖片',type: 'file' },
// ]

// function openEditModal(row) {
//   selectedRow.value = { ...row }
//   showEdit.value = true
// }

// async function updateData(formData, id) {
//   const resp = await fetch(`${import.meta.env.VITE_UpdateArtwork}/${id}`, {
//     method: 'POST',
//     body: formData
//   })

//   if (resp.ok) {
//     const updated = await resp.json()
//     const index = data.value.findIndex(d => d.id === id)
//     if (index !== -1) {
//       data.value[index] = updated
//     }
//   } else {
//     alert('更新失敗')
//   }
// }

onMounted(() => {
  fetchArtworks()
  fetchArtistsList()
})

</script>

<style scoped lang="scss">
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
