<template>


<section class="text-on-scroll section-3">
  <div class="NameTitle">
      <div class="TitleText">現正展出藝術家 Current Artists</div>
  </div>
</section>


<div class="artist" v-if="!isMobile">
  <div class="artist-name">
    <div 
    class="artist-name-text animate__animated animate__slideInUp" 
    v-for="(artist, index) in artists" 
    :key="index" 
    ref="nameRefs" 
    :class="{ hovered: hoverIndex === index }"
    >{{ artist.name }}</div>
  </div>
  <div class="artist-photo"
  >
    <!-- <RouterLink
        v-if="artist.router"
        :to="artist.router"
        class="artist-link"
      > -->
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
    <!-- </RouterLink> -->
  </div>
</div>

<div v-else class="artistM">
  <div
        v-for="(artist, index) in artists"
        :key="index"
        ref="artistRefs"
        class="artist artist-mobile"
      >
        <img :src="artist.img" :alt="artist.name" class="artist-img" />
        <div class="artist-name animate__animated animate__slideInUp" >{{ artist.displayName }}</div>
  </div>
</div>


<!-- <section class="text-on-scroll section-4">
  <div class="NameTitle">
      <div class="TitleText">開始逛逛緯藝 Start Visiting</div>
  </div>
</section> -->


</template>
<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import gsap from 'gsap'
import ScrollTrigger from 'gsap/ScrollTrigger'
import router from '@/router'
gsap.registerPlugin(ScrollTrigger)

const screenWidth = window.innerWidth;


const isPhone = screenWidth <= 768; // 判斷是否為手機
const getChineseName = (name) => {
  const match = name.match(/[\u4e00-\u9fa5]+.*$/); // 抓中文段落
  return match ? match[0] : name;
}

const artists = [
  { name: 'Elia Nova 艾莉亞諾瓦', img: new URL('@/assets/img/1.png',import.meta.url).href },
  { name: 'Fernand Levieux 費南德勒維爾', img: new URL('@/assets/img/2.png',import.meta.url).href },
  { name: 'Lin Chih-Yun 林芷芸', img: new URL('@/assets/img/3.png',import.meta.url).href },
  { name: 'Saya Sugimoto 杉本紗耶', img: new URL('@/assets/img/4.png',import.meta.url).href },
  { name: 'Elias Grey 伊萊亞斯格雷', img: new URL('@/assets/img/5.png',import.meta.url).href },
  { name: 'Lín Yì 林弈', img: new URL('@/assets/img/6.png',import.meta.url).href },
  { name: 'Azmi Nasir 阿茲米納西爾', img: new URL('@/assets/img/7.png',import.meta.url).href },
  { name: 'Emma Bloch 艾瑪布洛赫', img: new URL('@/assets/img/8.png',import.meta.url).href },
  { name: 'Kyouko Nakahara 中原皎子', img: new URL('@/assets/img/9.png',import.meta.url).href },
  { name: 'Luca Fiore 盧卡菲歐雷', img: new URL('@/assets/img/10.png',import.meta.url).href },
  { name: 'Camila Essa 卡蜜拉艾沙', img: new URL('@/assets/img/11.png',import.meta.url).href },
  { name: 'Shen Yi-Heng 沈奕衡', img: new URL('@/assets/img/12.png',import.meta.url).href },
  { name: 'Lukas Wiedmann 路卡斯維德曼', img: new URL('@/assets/img/13.png',import.meta.url).href },
  { name: 'Lin Yu-Shan 林羽珊', img: new URL('@/assets/img/14.png',import.meta.url).href },
  { name: 'ZENO 澤諾', img: new URL('@/assets/img/15.png',import.meta.url).href },
  { name: 'Nakamura Tomoya 中村朋也', img: new URL('@/assets/img/16.png',import.meta.url).href },
  { name: 'Noé Sauvage 諾耶索瓦奇', img: new URL('@/assets/img/17.png',import.meta.url).href },
  { name: 'Tahanan Whitecloud 塔哈南懷特雲', img: new URL('@/assets/img/18.png',import.meta.url).href },
  { name: 'Yamamoto Ichiyo 山本一葉', img: new URL('@/assets/img/19.png',import.meta.url).href }
].map(artist => ({
  ...artist,
  displayName: isPhone ? getChineseName(artist.name) : artist.name
}));

const nameRefs = ref([])
const photoRefs = ref([])
const artistRefs = ref([])


const hoverIndex = ref(null);
const handleMouseEnter = (index) => {
  hoverIndex.value = index;
}
const handleMouseLeave = () => {
  hoverIndex.value = null;
}

const isMobile = ref(window.innerWidth < 1200)

const handleResize = () => {
  isMobile.value = window.innerWidth < 1200
}


onMounted(() => {

  window.addEventListener('resize', handleResize)
  handleResize() 

  const animateTitle = (sectionEl) => {
    const titleEl = sectionEl.querySelector('.TitleText');
    if (!titleEl) return

    let targetWidth;
    let targetHeight;

    if (screenWidth >= 1200) {
      targetWidth = '50vw';
    } else if (screenWidth >= 768) {
      targetWidth = '60vw';
      targetHeight = '10vh';
    } else if (screenWidth >= 428) {
      targetWidth = '70vw';
      targetHeight = '5vh';
    } else {
      targetWidth = '80vw';
    }
  
    gsap.to(titleEl, {
      width: targetWidth,
      height: targetHeight,
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

onUnmounted(() => {
  window.removeEventListener('resize', handleResize)
})

</script>

<style lang="scss" scoped>
@import '/style.scss';

.NameTitle{
    display: flex;
    // width: 50vw;
    height: 50vh;
    margin: 30px auto;

    font-size: 32px;
    font-weight: bold;
    color: #fff;
    text-align: left;
    line-height: 1.6;
    justify-content: center;
    align-items: center;

  @media screen and (max-width: 992px) {
    font-size: 24px;
    height: 30vh;
    margin: 20px auto;
  }

  @media screen and (max-width: 768px) {
    font-size: 20px;
  }

}

.TitleText{
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background: $logoBlue; 
}

.artist {
  
    font-size: 28px;
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
    margin-bottom: 300px;

    @media screen and (max-width: 992px) {
       gap: 30px;
       padding: 24px;
      font-size: 24px;
    }

    @media screen and (max-width: 768px) {
      gap: 20px;
      padding: 16px;
      font-size: 20px;
    }
    
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
      }

    }
}

.artistM{
    margin-bottom: 200px;

}

.artist-mobile{
  width: 80vw;
  margin: 12px auto; 
  height: 20%;
  display: flex;
  justify-content: space-between;
  align-items: center;

  .artist-name {
    display: flex;
    justify-content: space-between;
    align-items: center;

    @media (max-width: 1000px) {
      height: 15%;
      
    }

    @media (max-width: 768px) {
      height: 10%;

    }

    @media (max-width: 620px) {
      flex-direction: column;  
      text-align: center;  
      justify-content: center;
    }
      
  }

  .artist-img{
    width: 15%;

    @media (max-width: 1000px) {
    width: 20%;
    
  }

    @media (max-width: 768px) {
    width: 25%;
  }

  }

}




</style>