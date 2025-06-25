<template>
    <AdminTable :columns="columns" :data="data " 
    :showAddButton="false"
    @view-more="openModal" 
    @toggle-status="updateStatus"
    />

    <transition name="fade">
      <div v-if="showMore" class="modal-overlay" @click.self="showMore = false">
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
    </transition>

</template>

<script setup>
import { ref, onMounted } from "vue";
import AdminTable from '@/components/AdminTable.vue'

// 欄位設定
const columns = [
  { key: 'id', label: '會員編號', class:'w-100'},
  { key: 'name', label: '會員名稱'},
  { key: 'email', label: 'Email'},
  { key: 'phone', label: '連絡電話'},
  { key: 'register', label: '註冊時間'},
  { key: 'updated', label: '修改時間' },
  { key: 'status', label: '狀態', type:'switch', class:'w-80'},
  { key: 'more', label: '詳細', type: 'more', buttonLabel: '查看', class:'w-80' }
]

// 查看
const showMore = ref(false)
const selectedMember = ref({})

function openModal(row) {
  selectedMember.value = row
  showMore.value = true
}

// 切換狀態
async function updateStatus(row) {
  try {
    const resp = await fetch(import.meta.env.VITE_UpdatePerStatus, {
      method: 'POST',
      headers: { 
        'Content-Type': 'application/json' 
      },
      body: JSON.stringify({
        id: row.id,
        per: row.per ? 1 : 0,  // 轉換成數字傳給資料庫
        type: 'member'  //抓資料表
      })
    })
    
    if (!resp.ok) throw new Error('狀態更新失敗')
      console.log('狀態更新成功')
  } catch (err) {
    alert(`狀態更新失敗：${err.message}`)
  }
}

// 讀取資料
const data = ref([])

onMounted(async () => {
  const resp = await fetch(import.meta.env.VITE_AdminMember);
  let members = await resp.json();

  members = members.map(member => ({
    ...member,
    per: Boolean(member.per),
    gender: convertGender(member.gender)
  }))
  data.value = members;
});

// 轉換性別顯示
function convertGender(code) {
  switch (code) {
    case 'M': return '男'
    case 'F': return '女'
    case 'Other': return '不公開'
  }
}


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
}
</style>
