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

// import Flashy from '@/components/Flashy.vue'
// import Listeners from '@/components/Listeners.vue'
  
</script>

<style>

canvas{
  min-width: 100vw;
  min-height: 100vh;
  margin: 0 auto;
}


</style>