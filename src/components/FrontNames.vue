<template>


<section class="text-on-scroll section-3">
  <div class="NameTitle">
      <div class="TitleText">現正展出藝術家 Current Artists</div>
  </div>
</section>


<div class="artist">
  <div class="artist-name">
    <div class="artist-name-text animate__animated animate__slideInUp" 
    v-for="(artist, index) in artists" 
    :key="index" 
    ref="nameRefs" 
    :class="{ hovered: hoverIndex === index }"
    >{{ artist.name }}</div>
  </div>
  <div class="artist-photo">
    <img 
    :src="artist.img" 
    :alt="artist.name" 
    class="artist-img" 
    v-for="(artist, index) in artists" 
    :key="index" 
    ref="photoRefs" 
    @mouseenter="handleMouseEnter(index)"
    @mouseleave="handleMouseLeave"
    />
  </div>
</div>


<section class="text-on-scroll section-4">
  <div class="NameTitle">
      <div class="TitleText">開始逛逛緯藝 Start Visiting</div>
  </div>
</section>


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

const nameRefs = ref([])
const photoRefs = ref([])


const hoverIndex = ref(null);
const handleMouseEnter = (index) => {
  hoverIndex.value = index;
}
const handleMouseLeave = () => {
  hoverIndex.value = null;
}


onMounted(() => {

  const animateTitle = (sectionEl) => {
    const titleEl = sectionEl.querySelector('.TitleText');
    if(!titleEl) return
  
    gsap.to(titleEl, {
      width: '45vw',
      height: '10vh',
      duration: 3.5,
      ease: 'power3.out',
    })
}

  nameRefs.value.forEach((el, index) => {
    gsap.from(el, {
      scrollTrigger: {
        trigger: el,
        start: 'top 100%',
        toggleActions: 'play none none reverse'
      },
      y: 50,
      opacity: 0,
      duration: 1,
      ease: 'power3.out',
      delay: index * 0.03
    })
  })

    photoRefs.value.forEach((el, index) => {
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


  const observer = new IntersectionObserver(
    (entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const el = entry.target

          if (el.classList.contains('text-on-scroll')) {
            gsap.fromTo(el, { opacity: 0, y: 50 }, { opacity: 1, y: 0, duration: 1 });
            animateTitle(el);
          }
          observer.unobserve(el) 
        }
      })
    },
    {
      threshold: 0.5 
    }
  )
    const sections = document.querySelectorAll('.text-on-scroll')
    sections.forEach(section => {
    observer.observe(section)
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
    margin: 60px auto 60px;

    font-size: 32px;
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
    justify-content: center;
    background: $logoBlue; 
}

.artist {
    font-size: 36px;
    font-weight: bold;
    color: $fontBlack;
    margin: 0 auto;
    width: 90vw;
    border: 3px solid $fontBlack;
    padding: 32px;

    display: flex;
    justify-content: space-evenly;
    align-items: center;
    gap: 80px;
    margin-bottom: 32px;
    
    .artist-photo{
      order: 0;
      width: 100%;
    }

    .artist-name {
      order: 1;
      width: 100%;
    }

    .artist-name-text {
      line-height: 1.05;
    }

    .artist-name-text.hovered {
        color: $logoYellow;
        transition: color 0.35s ease;
      }

    .artist-img {
      width: 20%;
      aspect-ratio: 1/1;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid $logoBrown;

      &:hover {
        border: 5px solid $logoYellow;
        cursor: pointer;
      }

    }
}



</style>