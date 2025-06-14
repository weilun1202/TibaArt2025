<template>
    <AdminTable 
      :columns="columns" 
      :data="data"
      @add="openAddModal"
     />
</template>

<script setup>
import { ref, onMounted } from "vue";
import AdminTable from '@/components/AdminTable.vue'

// 欄位設定
const columns = [
  { key: 'id', label: '展場編號', class:'w-100'},
  { key: 'name', label: '展覽名稱'},
  { key: 'img', label: '展覽封面', type:'image'},
  { key: 'artist', label: '出展人'},
  { key: 'start', label: '開始日期'},
  { key: 'end', label: '結束日期'},
  { key: 'status', label: '狀態', type:'select', options:['未開展', '展覽中', '已撤展']},
]

const data = ref([]);
// const showAdd = ref(false)
// const imageFile = ref(null);

async function fetchExpos() {
  const resp = await fetch(import.meta.env.VITE_AdminExpo)
  let expos = await resp.json()

  // expos = expos.map(expo => ({
  //   ...expo,
  //   status: convertStatus(expo.status)
  // }))
  data.value = expos
}

// function convertStatus(code) {
//   switch (code) {
//     case 'expoOff': return '未開展'
//     case 'expoOn': return '展覽中'
//     case 'expoExit': return '已撤展'
//   }
// }

onMounted(() => {
  fetchExpos()
})

</script>

<style scoped>

</style>
