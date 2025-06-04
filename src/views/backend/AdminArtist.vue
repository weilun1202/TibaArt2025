<template>
    <AdminTable :columns="columns" :data="data" 
    @view-more="openModal"
    />

    <div v-if="showModal" class="modal-overlay" @click.self="showModal = false">
      <div class="modal-content">
        <h3>藝術家詳細資料</h3>
        <p>編號：{{ selectedArtist.id }}</p>
        <p>名稱：{{ selectedArtist.name }}</p>
        <p>Email：{{ selectedArtist.email }}</p>
        <p>生日：{{ selectedArtist.birthday }}</p>
        <p>性別：{{ selectedArtist.gender }}</p>
      </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import AdminTable from '@/components/AdminTable.vue'

const showModal = ref(false)
const selectedArtist = ref({})

function openModal(row) {
  selectedArtist.value = row
  showModal.value = true
}

// 欄位設定
const columns = [
  { key: 'id', label: '藝術家編號', class:'w-120' },
  { key: 'name', label: '藝術家名稱', class:'w-120' },
  { key: 'email', label: 'Email', class:'w-200'},
  { key: 'update', label: '修改時間' , class: 'w-200'},
  { key: 'status', label: '狀態', type:'switch', class: 'w-90' },
  { key: 'more', label: '詳細', type: 'button', buttonLabel: '查看', class: 'w-90' }
]

// php抓來的假資料陣列
const data = ref([]);

onMounted(async () => {
  const resp = await fetch(import.meta.env.VITE_AdminMember);
  const artists = await resp.json();
  data.value = artists;

});

</script>

<style lang="scss" scoped>
@import '/style.scss';
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
  width: 500px;
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
}
</style>
