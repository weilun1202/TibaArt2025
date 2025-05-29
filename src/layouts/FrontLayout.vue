<!-- 前台面板 -->
 <template>
  <NavBar />
  <router-view />
  <Footer />

  <!-- <Listeners /> -->
</template>


<script setup>
import NavBar from '@/components/NavBar.vue'
import Footer from '@/components/Footer.vue'
// import Listeners from '@/components/Listeners.vue'
  
</script>