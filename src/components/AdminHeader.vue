<template>

  <div class="adminHeader">
    <span>{{ route.meta.title }}</span>
    <div class="adminHeaderBtn">
      <button class="btn" v-if="!isAdminHome" @click="goHome">回首頁</button>
      <button class="btn">登出</button>
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
  float: right;
  span{
    padding: $spacing-5;
    font-size: 20px;
    font-weight: 600;
  }
  .btn{
    margin-right: $spacing-5;
  }
}
</style>