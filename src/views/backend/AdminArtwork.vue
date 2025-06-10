<template>
    <AdminTable 
      :columns="columns" 
      :data="data"
      @edit="openEditModal"
     />

     <EditModal
      :show="showEdit"
      :data="selectedRow"
      :fields="editFields"
      title="編輯作品"
      @close="showEdit = false"
      @update="updateData"
    />
</template>

<script setup>
import { ref, onMounted } from "vue";
import AdminTable from '@/components/AdminTable.vue'
import EditModal from '@/components/AdminEditModal.vue'

// 欄位設定
const columns = [
  { key: 'id', label: '作品編號', class:'w-100' },
  { key: 'img', label: '作品圖片'},
  { key: 'name', label: '作品名稱' },
  { key: 'artist', label: '作者' },
  { key: 'size', label: '尺寸' },
  { key: 'note', label: '備註' },
  { key: 'edit', label: '操作', type: 'edit', buttonLabel: '編輯', class:'w-80' }
]

const data = ref([]);
const showEdit = ref(false)
const selectedRow = ref({})

const editFields = [
  { key: 'name', label: '作品名稱' },
  { key: 'size', label: '尺寸'  },
  { key: 'note', label: '備註', type: 'textarea'},
  { key: 'img', label: '作品圖片',type:'file' },
]

function openEditModal(row) {
  selectedRow.value = { ...row }
  showEdit.value = true
}

// 編輯
async function updateData(formData, id) {
  const resp = await fetch(`${import.meta.env.VITE_UpdateArtwork}/${id}`, {
    method: 'POST',
    body: formData
  })

  if (resp.ok) {
    const updated = await resp.json()
    const index = data.value.findIndex(d => d.id === id)
    if (index !== -1) {
      data.value[index] = updated
    }
  } else {
    alert('更新失敗')
  }
}

// 讀取資料
onMounted(async () => {
  const resp = await fetch(import.meta.env.VITE_AdminArtwork)
  let artworks = await resp.json()

  data.value = artworks
})

</script>

<style scoped lang="scss">
@import '/style.scss';

</style>
