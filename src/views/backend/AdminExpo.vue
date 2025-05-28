<template>
    <AdminTable :columns="columns" :data="data" />
</template>

<script setup>
import AdminTable from '@/components/AdminTable.vue'

// 欄位設定
const columns = [
  { key: 'id', label: '展場編號' },
  { key: 'name', label: '展覽名稱' },
  { key: 'img', label: '展覽封面' },
  { key: 'artist', label: '出展人' },
  { key: 'expoStart', label: '開始日期' },
  { key: 'expoEnd', label: '結束日期' },
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
