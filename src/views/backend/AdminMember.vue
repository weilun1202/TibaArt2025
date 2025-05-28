<template>
    <AdminTable :columns="columns" :data="data" />
</template>

<script setup>
import AdminTable from '@/components/AdminTable.vue'

// 欄位設定
const columns = [
  { key: 'id', label: '會員編號' },
  { key: 'email', label: 'Email' },
  { key: 'name', label: '會員名稱' },
  { key: 'register', label: '註冊時間' },
  { key: 'update', label: '修改時間' },
  { key: 'status', label: '狀態' },
  { key: 'more', label: '詳細資料' }
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
