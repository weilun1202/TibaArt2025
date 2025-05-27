<!-- 後台面板 -->
<template>
  <AdminNav />
  <AdminHeader />
  <router-view />
</template>


<script setup>
  import AdminNav from "@/components/AdminNav.vue"
  import AdminHeader from "@/components/AdminHeader.vue";
</script>