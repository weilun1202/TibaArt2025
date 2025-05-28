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
  /* background-color: #ccc; */
  margin-left: 300px;
  margin-right: 50px;
  padding-top: 100px;
}

</style>