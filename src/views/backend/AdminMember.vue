<template>
    <AdminTable :columns="columns" :data="data" />
</template>

<script setup>
import { ref, onMounted } from "vue";
import AdminTable from '@/components/AdminTable.vue'

// 欄位設定
const columns = [
  { key: 'id', label: '會員編號' },
  { key: 'name', label: '會員名稱' },
  { key: 'email', label: 'Email' },
  { key: 'register', label: '註冊時間' },
  { key: 'update', label: '修改時間' },
  { key: 'status', label: '狀態' },
  { key: 'more', label: '詳細資料' }
]

// php抓來的假資料陣列
const data = ref([])

// 串接資料
onMounted(async () => {
  const resp = await fetch(import.meta.env.VITE_AdminMember);
  const members = await resp.json();
  data.value = members;

});


</script>

<style scoped>

</style>
