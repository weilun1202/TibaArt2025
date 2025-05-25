<template>
    <NavBar />
        <div class="memHome">
            <div class="memHomeContent">
                <aside class="memSideBar">
                    <MemberNav />
                </aside>
                <main class="memContent">
                    <RouterView />
                </main>
            </div>
        </div>
    <Footer />
</template>

<script setup>
import NavBar from '@/components/NavBar.vue'
import MemberNav from '@/components/MemberNav.vue'
import Footer from '@/components/Footer.vue'

</script>

<style lang="scss" scoped>
@import '/style.scss';


.memHome {
  max-width: 1200px;
  min-height: 100vh;
  margin: 0 auto;
  padding-top: 72px;

  .memHomeContent{

    display: flex;

    .memSideBar{
      width: 25%;
      min-height: 100vh;
    }

    .memContent{
      width: 75%;
    }

  }

}


</style>