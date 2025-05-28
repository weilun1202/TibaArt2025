<template>
    <AdminTable :columns="columns" :data="data" />
</template>

<script setup>
import AdminTable from '@/components/AdminTable.vue'

// 欄位設定
const columns = [
  { key: 'id', label: '商品編號' },
  { key: 'type', label: '分類' },
  { key: 'name', label: '商品名稱' },
  { key: 'img', label: '商品圖' },
  { key: 'price', label: '價格' },
  { key: 'stock', label: '庫存' },
  { key: 'update', label: '上架時間' },
  { key: 'status', label: '狀態' },
]

// 假資料陣列
const data = [
  { id: 1, name: '王小明', email: 'ming@example.com', status: '啟用' },
  { id: 2, name: '陳美麗', email: 'mei@example.com', status: '停權' },
  { id: 3, name: '林大仁', email: 'lin@example.com', status: '啟用' },
  { id: 4, name: '張小華', email: 'hua@example.com', status: '啟用' }
]
</script>

<style scoped>

</style>
