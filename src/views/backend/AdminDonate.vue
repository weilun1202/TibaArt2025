<template>
    <AdminTable :columns="columns" :data="data" :showAddButton="false"/>
</template>

<script setup>
import AdminTable from '@/components/AdminTable.vue'

// 欄位設定
const columns = [
  { key: 'id', label: '筆數', class:'w-100' },
  { key: 'patron', label: '贊助者' },
  { key: 'email', label: '贊助者信箱' },
  { key: 'sponsored', label: '贊助展覽' },
  { key: 'amount', label: '金額' },
  { key: 'time', label: '贊助時間' },
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
