<template>
    <AdminTable :columns="columns" :data="data" />
</template>

<script setup>
import { ref, onMounted } from "vue";
import AdminTable from '@/components/AdminTable.vue'

// 欄位設定
const columns = [
  { key: 'id', label: '藝術家編號' },
  { key: 'name', label: '藝術家名稱' },
  { key: 'email', label: 'Email' },
  { key: 'update', label: '修改時間' },
  { key: 'status', label: '狀態', type:'switch'},
  { key: 'more', label: '詳細資料', type:'button'},
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
