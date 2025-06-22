<template>
  <div class="loading-screen" v-if="show">
    <div class="block block-1">歡迎來到緯藝基金會 <br> Welcome To TibaArt Foundation</div>
    <div class="block block-2">致力於提拔新興藝術家 <br> Promoting Emerging Artists</div>
    <div class="block block-3">迄今已有100年的歷史 <br> Since 1925 </div>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { gsap } from 'gsap'

const show = ref(true)

onMounted(() => {
  const tl = gsap.timeline()

  tl.to('.block', {
    width: '30vw',
    height: '50vh',
    duration: 3.5,
    ease: 'power3.out',
  })
})
</script>

<style lang="scss" scoped>
@import '/style.scss';

.loading-screen{
    display: flex;
    width: 80vw;
    height: 50vh;
    margin: 120px auto;

    font-size: 24px;
    font-weight: bold;
    color: #fff;
    text-align: left;
    line-height: 1.6;
    justify-content: space-around;
    align-items: center;
}

.block{
    overflow: hidden;
    display: flex;
    align-items: center;
    padding: 0 12px;
}

.block-1 { background: $logoYellow; }
.block-2 { background: $logoOrange; }
.block-3 { background: $logoGreen; }



</style>
