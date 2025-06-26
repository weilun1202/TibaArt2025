<template>
    <AdminTable 
      :columns="columns" 
      :data="data"
      @add="openAddModal"
      @edit="openEditModal"
     />

      <transition name="fade">
      <div v-if="showAdd" class="modal-overlay" @click.self="showAdd = false">
        <div class="modal-content">
          <h3>新增展覽資料</h3>
          <label>
            <span>*</span> 藝術家：
            <select v-model="newData.artist_id">
              <option disabled value="">請選擇藝術家</option>
              <option v-for="artist in artists" :key="artist.id" :value="artist.id">
                {{ artist.name }}
              </option>
            </select>
          </label>
          <label><span>*</span>展覽封面：<input type="file" name="img" @change="handleFileChange" /></label>
          <label><span>*</span>展覽名稱：<input v-model="newData.name" /></label>
          <label><span>*</span>英文名稱：<input v-model="newData.name_en" /></label>
          <label><span>*</span>開始時間：<input v-model="newData.start" type="date"/></label>
          <label><span>*</span>結束時間：<input v-model="newData.end" type="date"/></label>
          <label><span>*</span>備註：<input v-model="newData.note" /></label>
          <label><span>*</span>選擇作品：</label> 
            <div class="checkbox-scroll">
              <label v-for="artwork in artworks" :key="artwork.id">
                <input 
                  type="checkbox"
                  :value="artwork.id" 
                  v-model="selectedArtworkIds" 
                />
                {{ artwork.name }}
              </label>
            </div>
           

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
  { key: 'id', label: '展場編號', class:'w-100'},
  { key: 'name', label: '展覽名稱'},
  { key: 'cover', label: '展覽封面', type:'image'},
  { key: 'artist', label: '出展人'},
  { key: 'start', label: '開始日期'},
  { key: 'end', label: '結束日期'},
  { key: 'status', label: '狀態', type:'select',class:'w-120', 
    options: [
      { value: 'expoOff', label: '未開展' },
      { value: 'expoOn', label: '展覽中' },
      { value: 'expoExit', label: '已撤展' }
    ]},
  { key: 'edit', label: '操作', type: 'edit', buttonLabel: '編輯', class:'w-80' },
]


const data = ref([]);
const showAdd = ref(false)
const imageFile = ref(null);
const selectedArtworkIds = ref([]);

// 新增表單資料
const newData = ref({
  artist_id: '',
  name: '',
  name_en: '',
  start: '',
  end: '',
  note: '',
  artwork_id: '',
})

function openAddModal() {
  showAdd.value = true
}

function handleFileChange(e) {
  imageFile.value = e.target.files[0]
}

async function fetchExpos() {
  const resp = await fetch(import.meta.env.VITE_AdminExpo)
  let expos = await resp.json()
  
  data.value = expos
}



// 取得藝術家清單
const artists = ref([]);
async function fetchArtistsList() {
  const resp = await fetch(import.meta.env.VITE_GetArtists);
  artists.value = await resp.json();
}

// 取得作品清單
const artworks = ref([]);
async function fetchArtworks() {
  const resp = await fetch(import.meta.env.VITE_GetAllArtworks);
  artworks.value = await resp.json();
}

function cleanForm() {
  newData.value = {
    artist_id: '',
    name: '',
    name_en: '',
    start: '',
    end: '',
    note: '',
    artwork_id: '',
  }
  imageFile.value = null;
  selectedArtworkIds.value = [];
}

// 新增資料
async function addData() {
  if (!imageFile.value || 
      !newData.value.artist_id || 
      !newData.value.name || 
      !newData.value.name_en || 
      !newData.value.start || 
      !newData.value.end || 
      !newData.value.note 
    ) {
    alert('請填寫所有欄位');
    return;
  }

  try {
    //  上傳圖片
    const formData = new FormData()
    formData.append('img', imageFile.value)

    const uploadResp = await fetch(import.meta.env.VITE_UploadExpoCover, {
      method: 'POST',
      body: formData
    })
    console.log(formData)
    for (let pair of formData.entries()) {
      console.log(pair[0], pair[1]);
    }

    // 檢查http和伺服器回傳邏輯是否錯誤
    if (!uploadResp.ok) throw new Error('HTTP 錯誤');
    const uploadResult = await uploadResp.json();
    if (!uploadResult.success) throw new Error(uploadResult.message || '圖片上傳失敗');

    const resp = await fetch(import.meta.env.VITE_AddExpo, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        ...newData.value,
        cover: uploadResult.url,
      })
    })

    const result = await resp.json();
    console.log(result);
    if (result.success) {
      const expoId = result.id
      await fetch(import.meta.env.VITE_AddExpoArtwork, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          expo_id: expoId,
          artwork_ids: selectedArtworkIds.value
        })
      })

      alert('新增成功');
      showAdd.value = false;
      cleanForm();              // 清空表單
      imageFile.value = null;   // 清空圖片
      fetchExpos(); 
    } else {
      throw new Error(result.error || '新增失敗');
    }
  } catch (err) {
    alert(`新增失敗：${err.message}`);
  }
}

function openEditModal(){
  alert('功能尚未開放');
}


onMounted(() => {
  fetchExpos()
  fetchArtistsList()
  fetchArtworks()
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
  .checkbox-scroll {
    max-height: 100px;
    overflow-y: auto;
    margin: $spacing-2;
    border: 1px solid #ccc;
    display: flex;
    flex-wrap: wrap;

    label {
      display: flex;
      align-items: center;
      padding: $spacing-2;
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
