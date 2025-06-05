<!-- 後台面板 -->
<template>
  <AdminNav />
  <AdminHeader />
  <div class="backWarp">
    <router-view />
  </div>
</template>


<script setup>
  import AdminNav from "@/components/AdminNav.vue"
  import AdminHeader from "@/components/AdminHeader.vue";
</script>

<style scoped>


.backWarp{
  /* 為了把全域背景色蓋掉 */
  height: 100vh;
  background-color: #fff;

  padding-left: 280px;
  padding-top: 100px;
}

</style>