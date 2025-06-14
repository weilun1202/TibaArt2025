<template>
    <AdminTable :columns="columns" :data="data" />
</template>

<script setup>
import { ref, onMounted } from "vue";
import AdminTable from '@/components/AdminTable.vue'

// 欄位設定
const columns = [
  { key: 'id', label: '商品編號',class:'w-100' },
  { key: 'type', label: '分類',class:'w-100' },
  { key: 'name', label: '商品名稱' },
  { key: 'img', label: '商品圖', type:'image' },
  { key: 'des', label: '商品描述' },
  { key: 'price', label: '價格' },
  { key: 'stock', label: '庫存' },
  { key: 'updated', label: '上架時間'},
  { key: 'status', label: '狀態' , type:'select', options:['上架中', '以下架', '已售完']},
]

const data = ref([]);

async function fetchProducts() {
  const resp = await fetch(import.meta.env.VITE_AdminProduct)
  let artworks = await resp.json()

  data.value = artworks
}

onMounted(() => {
  fetchProducts()
})
</script>

<style scoped>

</style>
