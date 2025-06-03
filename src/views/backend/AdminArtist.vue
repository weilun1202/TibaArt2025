<template>
    <AdminTable :columns="columns" :data="data" />
</template>

<script setup>
import { ref, onMounted } from "vue";
import AdminTable from '@/components/AdminTable.vue'

// 欄位設定
const columns = [
  { key: 'id', label: '藝術家編號', class:'w-120' },
  { key: 'name', label: '藝術家名稱', class:'w-120' },
  { key: 'email', label: 'Email'},
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

<style scoped>

</style>
