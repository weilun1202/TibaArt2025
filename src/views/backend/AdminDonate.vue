<template>
    <AdminTable :columns="columns" :data="data" :showAddButton="false"/>
</template>

<script setup>
import { ref, onMounted } from "vue";
import AdminTable from '@/components/AdminTable.vue'

// 欄位設定
const columns = [
  { key: 'donate_no', label: '筆數', class:'w-100' },
  { key: 'd_name', label: '贊助者' },
  { key: 'd_email', label: '贊助者信箱' },
  { key: 'sponsored', label: '贊助展覽' },
  { key: 'amount', label: '金額' },
  { key: 'created_at', label: '建立時間' },
  { key: 'updated_at', label: '修改時間' },
  { key: 'status', label: '狀態', class:'w-100' },
]

// 假資料陣列
const data = ref([]);

async function fetchProducts() {
  const resp = await fetch(import.meta.env.VITE_AdminDonate)
  let artworks = await resp.json()

  data.value = artworks
}

onMounted(() => {
  fetchProducts()
})
</script>

<style scoped>

</style>
