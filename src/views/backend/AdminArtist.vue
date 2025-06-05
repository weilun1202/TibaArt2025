<template>
    <AdminTable :columns="columns" :data="data" 
    @view-more="openModal"
    @add="openAddModal"
    />

    <transition name="fade">
      <div v-if="showMore" class="modal-overlay" @click.self="showMore = false">
        <div class="modal-content">
          <h3>藝術家詳細資料</h3>
          <p>編號：{{ selectedArtist.id }}</p>
          <p>名稱：{{ selectedArtist.name }}</p>
          <p>Email：{{ selectedArtist.email }}</p>
          <p>生日：{{ selectedArtist.birthday }}</p>
          <p>性別：{{ selectedArtist.gender }}</p>
          <p>銀行帳戶{{ selectedArtist.bank_account }}</p>
          <p>修改時間：{{ selectedArtist.update }}</p>
        </div>
    </div>
    </transition>

    <transition name="fade">
      <div v-if="showAdd" class="modal-overlay" @click.self="showAdd = false">
        <div class="modal-content">
          <h3>新增藝術家會員資料</h3>
          <label>名稱：<input v-model="newData.name" /></label>
          <label>Email：<input v-model="newData.email" /></label>
          <label>生日：<input v-model="newData.birthday" type="date" /></label>
          <label>性別：
            <select v-model="newData.gender">
              <option value="男">男</option>
              <option value="女">女</option>
            </select>
          </label>
          <div class="btn-content">
            <button class="btn" @click="addData">送出</button>
            <button class="btn" @click="showAdd = false">取消</button>
          </div>
        </div>
      </div>
    </transition>

</template>

<script setup>
import { ref, onMounted } from "vue";
import AdminTable from '@/components/AdminTable.vue'

// 欄位設定
const columns = [
  { key: 'id', label: '藝術家編號', class:'w-120'},
  { key: 'name', label: '藝術家名稱'},
  { key: 'email', label: 'Email'},
  { key: 'update', label: '修改時間'},
  { key: 'status', label: '狀態', type:'switch', class:'w-80'},
  { key: 'more', label: '詳細', type: 'button', buttonLabel: '查看', class:'w-80'}
]

// 新增
const showAdd = ref(false)
const newData = ref({
  name: '',
  email: '',
  birthday: '',
  gender: '男'
})

function openAddModal() {
  showAdd.value = true
}

function addData() {
  if (!newData.value.name || !newData.value.email) {
    alert('請完整填寫資料')
    return
  }

  const newId = Date.now().toString() // 暫時生成 ID，可改成後端給
  data.value.push({
    id: newId,
    ...newData.value,
    phone: '',
    register: new Date().toISOString().slice(0, 10),
    update: new Date().toISOString().slice(0, 10),
    status: true
  })

  showAddModal.value = false
  newData.value = { name: '', email: '', birthday: '', gender: '男' }
}

// 查看
const showMore = ref(false)
const selectedArtist = ref({})

function openModal(row) {
  selectedArtist.value = row
  showMore.value = true
}

// php抓來的假資料陣列
const data = ref([]);

onMounted(async () => {
  const resp = await fetch(import.meta.env.VITE_AdminMember);
  const artists = await resp.json();
  data.value = artists;

});

</script>

<style lang="scss" scoped>
@import '/style.scss';
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.3s ease;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,0.6);
  display: flex;
  align-items: center;
  justify-content: center;
}
.modal-content {
  background: white;
  width: 500px;
  h3{
    font-size: 24px;
    background-color: $primaryGreen;
    padding: $spacing-4;
    color: #FFF;
  }
  p{
    font-size: 20px;
    padding: $spacing-3;
  }
  label{
    display: flex;
    padding: $spacing-3;
  }
  .btn-content{
    display: flex;
    gap: $spacing-3;
    justify-content: center;
    padding: $spacing-3;
  }
}
</style>
