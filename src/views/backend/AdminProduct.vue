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
  { key: 'des', label: '商品描述' },
  { key: 'price', label: '價格' },
  { key: 'stock', label: '庫存' },
  { key: 'update', label: '上架時間' },
  { key: 'status', label: '狀態' , type:'select', options:['上架中', '以下架', '已售完']},
]

// 假資料陣列
const data = [
  { id: 1, name: '王小明', type: '藝術家', status: '啟用', des: '描述描述描述描述描述描述描述描述描述描述描述描述描述描述描述', update: '2020/00/00' },
]
</script>

<style scoped>

</style>
