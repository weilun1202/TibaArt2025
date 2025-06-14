<template>
    <AdminTable 
      :columns="columns" 
      :data="data"
      @add="openAddModal"
     />

      <!-- <transition name="fade">
      <div v-if="showAdd" class="modal-overlay" @click.self="showAdd = false">
        <div class="modal-content">
          <h3>新增展覽資料</h3>
          <label>
            <span>*</span> 藝術家：
            <select v-model="newData.artist_id">
              <option disabled value="">請選擇藝術家</option>
              <option v-for="artist in artists" :key="artist.id" :value="artist.id">
                {{ artist.name }}
              </option>
            </select>
          </label>
          <label><span>*</span> 展覽封面：<input type="file" name="img" @change="handleFileChange" /></label>
          <label><span>*</span>展覽名稱：<input v-model="newData.name" /></label>
          <label><span>*</span>英文名稱：<input v-model="newData.name_en" /></label>
          <label><span>*</span>開始時間：<input v-model="newData.start" type="date"/></label>
          <label><span>*</span>結束時間：<input v-model="newData.end" type="date"/></label>
          <label><span>*</span>備註：<input v-model="newData.note" /></label>

          <div class="btn-content">
            <button class="btn" @click="addData">送出</button>
            <button class="btn" @click="showAdd = false">取消</button>
          </div>
        </div>
      </div>
    </transition> -->
</template>

<script setup>
import { ref, onMounted } from "vue";
import AdminTable from '@/components/AdminTable.vue'

// 欄位設定
const columns = [
  { key: 'id', label: '展場編號', class:'w-100'},
  { key: 'name', label: '展覽名稱'},
  { key: 'cover', label: '展覽封面', type:'image'},
  { key: 'artist', label: '出展人'},
  { key: 'start', label: '開始日期'},
  { key: 'end', label: '結束日期'},
  { key: 'status', label: '狀態', type:'select', options:['expoOff', 'expoOn', 'expoExit']},
]

const data = ref([]);
const showAdd = ref(false)
const imageFile = ref(null);

async function fetchExpos() {
  const resp = await fetch(import.meta.env.VITE_AdminExpo)
  let expos = await resp.json()

  expos = expos.map(expo => ({
    ...expo,

  }))
  data.value = expos
}

onMounted(() => {
  fetchExpos()
})

</script>

<style scoped>

</style>
