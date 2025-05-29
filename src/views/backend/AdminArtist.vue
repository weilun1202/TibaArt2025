<template>
    <AdminTable :columns="columns" :data="data" />
</template>

<script setup>
import AdminTable from '@/components/AdminTable.vue'

// 欄位設定
const columns = [
  { key: 'id', label: '藝術家編號' },
  { key: 'name', label: '藝術家名稱' },
  { key: 'email', label: 'Email' },
  { key: 'update', label: '修改時間' },
  { key: 'status', label: '狀態', class:'' },
  { key: 'more', label: '詳細資料', class:'add-button btn' },
]

// 假資料陣列
const data = [
  { id: 1, 
    name: '王小明', 
    email: 'ming@example.com', 
    update: '2020/01/01', 
    status: '啟用',
    more: '查看'
   },
]
</script>

<style scoped>

</style>
