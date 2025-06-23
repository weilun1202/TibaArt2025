<template>
  <div class="loading-screen" v-if="show">
    <div class="block block-1">緯藝基金會 <br> TibaArt Foundation</div>
    <div class="block block-2">致力於提拔新興藝術家 <br> Promotes Emerging Artists</div>
    <div class="block block-3">迄今已有100年的歷史 <br> Since 1925 </div>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { gsap } from 'gsap'

const show = ref(true)

onMounted(() => {

  const animateBlcoks = () => {
    const screenWidth = window.innerWidth;
    let targetWidth;
    let targetHeight;

    if (screenWidth >= 1200) {
      targetWidth = '30vw';
      targetHeight = '50vh';
    } else if (screenWidth >= 768) {
      targetWidth = '80vw';
      targetHeight = '30vh';
    } else {
      targetWidth = '90vw';
      targetHeight = '10vh';
    }

    const tl = gsap.timeline()
    tl.to('.block', {
      width: targetWidth,
      height: targetHeight,
      duration: 3.5,
      ease: 'power3.out',
    })
  }

  const observer = new IntersectionObserver(
    (entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const el = entry.target

          if (el.classList.contains('loading-screen')) {
            gsap.fromTo(el, { opacity: 0, y: 50 }, { opacity: 1, y: 0, duration: 1 });
            animateBlcoks(el);
          }
          observer.unobserve(el) 
        }
      })
    },
    {
      threshold: 0.5 
    }
  )
    const sections = document.querySelectorAll('.loading-screen')
    sections.forEach(section => {
    observer.observe(section)
    })
})
</script>

<style lang="scss" scoped>
@import '/style.scss';

.loading-screen{
    display: flex;
    width: 80vw;
    height: 50vh;
    margin: 0 auto;

    font-size: 24px;
    font-weight: bold;
    color: #fff;
    text-align: left;
    line-height: 1.6;
    justify-content: space-around;
    align-items: center;

  @media (max-width: 1000px) {
    flex-direction: column;
  }

  @media (max-width: 768px) {
    font-size: 20px;
    height: 30vh;
  }


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
