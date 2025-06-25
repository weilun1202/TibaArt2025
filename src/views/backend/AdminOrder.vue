<template>
    <AdminTable :columns="columns" :data="data" :showAddButton="false"/>
</template>

<script setup>
import { ref, onMounted } from "vue";
import AdminTable from '@/components/AdminTable.vue'

// 欄位設定
const columns = [
  { key: 'order_number', label: '訂單編號' },
  // { key: 'detail', label: '訂單內容' },
  { key: 'contact_name', label: '訂購人' },
  { key: 'contact_phone', label: '訂購人電話' },
  { key: 'total_amount', label: '總金額' },
  { key: 'address', label: '配送地址' },
  { key: 'order_date', label: '訂購時間' },
  { key: 'payment_status', label: '狀態', type:'select', class:'w-120', options:['unpaid', 'paid', 'refunded'] },
]

const data = ref([]);

async function fetchOrders() {
  const resp = await fetch(import.meta.env.VITE_AdminOrder)
  let orders = await resp.json()

  data.value = orders
}

onMounted(() => {
  fetchOrders()
})
</script>

<style scoped>

</style>
