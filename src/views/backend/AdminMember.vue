<template>
    <AdminTable :columns="columns" :data="data" 
    @view-more="openModal" 
    @toggle-status="handleToggleStatus"
    />

    <div v-if="showModal" class="modal-overlay" @click.self="showModal = false">
      <div class="modal-content">
        <h3>會員詳細資料</h3>
        <p>編號：{{ selectedMember.id }}</p>
        <p>名稱：{{ selectedMember.name }}</p>
        <p>Email：{{ selectedMember.email }}</p>
        <p>生日：{{ selectedMember.birthday }}</p>
        <p>性別：{{ selectedMember.gender }}</p>
        <p>註冊時間：{{ selectedMember.register }}</p>
      </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import AdminTable from '@/components/AdminTable.vue'

// 欄位設定
const columns = [
  { key: 'id', label: '會員編號', class: 'w-100' },
  { key: 'name', label: '會員名稱' , class: 'w-150'},
  { key: 'email', label: 'Email'},
  { key: 'register', label: '註冊時間', class: 'w-200' },
  { key: 'update', label: '修改時間' , class: 'w-200'},
  { key: 'status', label: '狀態', type:'switch', class: 'w-90' },
  { key: 'more', label: '詳細', type: 'button', buttonLabel: '查看', class: 'w-90' }
]

const showModal = ref(false)
const selectedMember = ref({})

function openModal(row) {
  selectedMember.value = row
  showModal.value = true
}

// php抓來的假資料陣列
const data = ref([])

function handleToggleStatus(member) {
  console.log('會員狀態已變更', member)

  // TODO：這裡可呼叫 API 更新資料庫
  // await fetch(`/api/update-member-status`, {
  //   method: 'POST',
  //   body: JSON.stringify({ id: member.id, status: member.status }),
  //   headers: { 'Content-Type': 'application/json' }
  // })
}

// 串接資料
onMounted(async () => {
  const resp = await fetch(import.meta.env.VITE_AdminMember);
  const members = await resp.json();
  data.value = members;

});


</script>

<style lang="scss" scoped>
@import '/style.scss';
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
}
</style>
