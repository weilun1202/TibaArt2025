<template>



<div class="NameTitle">
    <div class="TitleText">現正展出的藝術家 Current Artists</div>
</div>


<div
      v-for="(artist, index) in artists"
      :key="index"
      ref="artistRefs"
      class="artist"
    >
      <img :src="artist.img" :alt="artist.name" class="artist-img" />
      <div class="artist-name animate__animated animate__slideInUp" >{{ artist.name }}</div>
</div>

<div class="NameTitle">
    <div class="TitleText">開始逛逛緯藝 Start Visiting</div>
</div>


</template>
<script setup>
import { ref, onMounted } from 'vue'
import gsap from 'gsap'
import ScrollTrigger from 'gsap/ScrollTrigger'
gsap.registerPlugin(ScrollTrigger)

const artists = [
  { name: 'Elia Nova 艾莉亞諾瓦', img: 'src/assets/img/1.png' },
  { name: 'Fernand Levieux 費南德勒維爾', img: 'src/assets/img/2.png' },
  { name: 'Lin Chih-Yun 林芷芸', img: 'src/assets/img/3.png' },
  { name: 'Saya Sugimoto 杉本紗耶', img: 'src/assets/img/4.png' },
  { name: 'Elias Grey 伊萊亞斯格雷', img: 'src/assets/img/5.png' },
  { name: 'Lín Yì 林弈', img: 'src/assets/img/6.png' },
  { name: 'Azmi Nasir 阿茲米納西爾', img: 'src/assets/img/7.png' },
  { name: 'Emma Bloch 艾瑪布洛赫', img: 'src/assets/img/8.png' },
  { name: 'Kyouko Nakahara 中原皎子', img: 'src/assets/img/9.png' },
  { name: 'Luca Fiore 盧卡菲歐雷', img: 'src/assets/img/10.png' },
  { name: 'Camila Essa 卡蜜拉艾沙', img: 'src/assets/img/11.png' },
  { name: 'Shen Yi-Heng 沈奕衡', img: 'src/assets/img/12.png' },
  { name: 'Lukas Wiedmann 路卡斯維德曼', img: 'src/assets/img/13.png' }
]

const artistRefs = ref([])

onMounted(() => {

const tl = gsap.timeline()

  tl.to('.TitleText', {
    width: '40vw',
    height: '10vh',
    duration: 3.5,
    ease: 'power3.out',
  })


  artistRefs.value.forEach((el, index) => {
    gsap.from(el, {
      scrollTrigger: {
        trigger: el,
        start: 'top 80%',
        toggleActions: 'play none none reverse'
      },
      y: 50,
      opacity: 0,
      duration: 1,
      ease: 'power3.out',
      delay: index * 0.05
    })
  })
})

</script>

<style lang="scss" scoped>
@import '/style.scss';

.NameTitle{
    display: flex;
    // border: 1px solid;

    width: 50vw;
    height: 50vh;
    margin: 120px auto 60px;

    font-size: 36px;
    font-weight: bold;
    color: #fff;
    text-align: left;
    line-height: 1.6;
    justify-content: center;
    align-items: center;
}

.TitleText{
    overflow: hidden;
    display: flex;
    align-items: center;
    padding: 0 12px;
    background: $logoBlue; 
}

.artist {
    font-size: 36px;
    font-weight: bold;
    color: $fontBlack;
    margin: 0 auto;
    width: 90vw;
    border: 1.5px solid $fontBlack;
    padding: 24px;

    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 24px;
    margin-bottom: 32px;

    .artist-img {
      order: 1;
      width: 10%;
      aspect-ratio: 1/1;
      border-radius: 50%;
      object-fit: cover;
    }
}



</style>