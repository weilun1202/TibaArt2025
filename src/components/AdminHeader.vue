<template>

  <div class="adminHeader">
    <span>{{ route.meta.title }}</span>
    <div class="adminHeaderBtn">
      <button class="btn" v-if="!isAdminHome" @click="goHome">回首頁</button>
      <button class="btn" @click="adminLogout">登出</button>
    </div>
  </div>

</template>

<script setup>
import { useRoute, useRouter } from 'vue-router'
import { computed } from 'vue'

const route = useRoute()
const router = useRouter()

const isAdminHome = computed(() => route.name === 'Admin')

function goHome() {
router.push('/admin')
}

function adminLogout(){
  router.push('/admin/login')
}
</script>

<style lang="scss" scoped>
@import '/style.scss';
.adminHeader{
  background-color: #fff;
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: calc(100% - 250px);
  height: 60px;
  border-bottom: 2px solid $primaryGreen;
  position: fixed;
  right: 0;
  span{
    padding: $spacing-5;
    font-size: 20px;
    font-weight: 600;
  }
  .btn{
    margin-right: $spacing-5;
  }
}
.adminHeaderBtn{
  .btn{
    font-size: 16px;
    line-height: 42px;
  }
}
</style>