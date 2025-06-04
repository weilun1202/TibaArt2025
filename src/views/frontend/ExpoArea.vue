<template>
  <div class="expoArea">
    <div class="wrapper">
      <!-- Wrapper 不設 1200px 寬（例如展覽、關於我們頁面應該會滿版），想要限制內容在 1200 的再自己包一個 div 限制 1200  -->
      <!-- 以下供大家編輯 -->
      <div class="banner">
        <div class="banner-text">
          <h1>靜界焰光</h1>
          <p>The Luminous Silence</p>
          <p>「當情感無以為繼，色彩替我們說話。」 凱婭·露希亞的創作長年在寂靜與爆發之間來回拉扯，她以自然隱喻人心，讓畫布成為風暴中心的靜止點。
            本次展覽精選其近十年間五件代表作，以色彩為線索，從冷冽冰縫、綠林密靜，到炙熱的內燃記憶，呈現一場無語卻極具張力的感官旅程。觀者不需理解，僅需感受</p>
          <router-link to="/front/Sponsor"><button>贊助</button></router-link>
        </div>
        <img src="/public/assets/img/expoArea-banner.png" alt="">
      </div>

      <div class="expoArea-intro">
        <h2>藝術家介紹</h2>
        
        
        <div class="expoArea-artist">
          <img src="/public/assets/img/expoArea-artist.png" alt="artist">
          <div class="artist-text">
         
            <h5>出生於冰島雷克雅維克，自幼沉浸於極光與火山地貌的視覺震撼中。20歲時赴挪威卑爾根藝術學院深造，後旅居日本京都五年，受禪意美學影響深遠。<br>
              她認為自然界的極端對比，冷與熱、生與死、光與闇，是情緒最誠實的投射。她的創作動機是透過畫布「捕捉內心風暴中那道平靜的光」，將感知與直覺轉化為視覺語言。
            </h5>

            <div class="icons">
              <font-awesome-icon icon="globe" />
              <font-awesome-icon :icon="['fab', 'instagram']" />
              <font-awesome-icon :icon="['fab', 'behance']" />
            </div>
          </div>
        </div>
      </div>


      <ul class="expoArea-artwork">
        <li v-for="(art, idx) in artworks" :key="idx" class="expoArea-card">
          <div class="zoom-container">
            <router-link :to="art.link">
              <img class="zoom-image" :src="art.imgSrc" :alt="art.title" />
            </router-link>
            <div class="magnifier"></div>
          </div>
          <div class="title">
            <h3>{{ art.title }}</h3>
            <p>{{ art.englishTitle }}</p>
            <p>{{ art.medium }}</p>
          </div>
          <p>{{ art.description }}</p>
          <router-link :to="art.link">learn more</router-link>
        </li>
      </ul>
    </div>
  </div>

</template>

<script setup>

//v-for跑div


import { ref } from 'vue'

// 宣告 artworks 陣列
const artworks = ref([
  {
    imgSrc: import.meta.env.BASE_URL + '/assets/img/expoArea-artwork1.png',
    title: '裂縫之下',
    englishTitle: 'Beneath the Fracture',
    medium: '油畫',
    description:
      '本畫靈感來自她親眼目睹的冰川裂縫，畫面以大面積裂痕與流動線條組成，象徵人內在的情緒斷層。她用此畫探討壓抑情感之下的潛流，並相信裂縫不是崩壞，而是讓光進入的通道。',
    link: '/front/ExpoAreaPage',
  },
  {
    imgSrc: import.meta.env.BASE_URL + '/assets/img/expoArea-artwork2.png',
    title: '裂縫之下',
    englishTitle: 'Beneath the Fracture',
    medium: '油畫',
    description:
      '本畫靈感來自她親眼目睹的冰川裂縫，畫面以大面積裂痕與流動線條組成，象徵人內在的情緒斷層。她用此畫探討壓抑情感之下的潛流，並相信裂縫不是崩壞，而是讓光進入的通道。',
    link: '/front/ExpoAreaPage',
  },
  {
    imgSrc: import.meta.env.BASE_URL + '/assets/img/expoArea-artwork3.png',
    title: '裂縫之下',
    englishTitle: 'Beneath the Fracture',
    medium: '油畫',
    description:
      '本畫靈感來自她親眼目睹的冰川裂縫，畫面以大面積裂痕與流動線條組成，象徵人內在的情緒斷層。她用此畫探討壓抑情感之下的潛流，並相信裂縫不是崩壞，而是讓光進入的通道。',
    link: '/front/ExpoAreaPage',
  },
  {
    imgSrc: import.meta.env.BASE_URL + '/assets/img/expoArea-artwork4.png',
    title: '裂縫之下',
    englishTitle: 'Beneath the Fracture',
    medium: '油畫',
    description:
      '本畫靈感來自她親眼目睹的冰川裂縫，畫面以大面積裂痕與流動線條組成，象徵人內在的情緒斷層。她用此畫探討壓抑情感之下的潛流，並相信裂縫不是崩壞，而是讓光進入的通道。',
    link: '/front/ExpoAreaPage',
  },
  {
    imgSrc: import.meta.env.BASE_URL + '/assets/img/expoArea-artwork5.png',
    title: '裂縫之下',
    englishTitle: 'Beneath the Fracture',
    medium: '油畫',
    description:
      '本畫靈感來自她親眼目睹的冰川裂縫，畫面以大面積裂痕與流動線條組成，象徵人內在的情緒斷層。她用此畫探討壓抑情感之下的潛流，並相信裂縫不是崩壞，而是讓光進入的通道。',
    link: '/front/ExpoAreaPage',
  },
])
//放大鏡
import { onMounted } from 'vue';
import { gsap } from 'gsap';

onMounted(() => {
  // 如果有多個 .zoom-container，這裡使用 querySelectorAll 逐一初始化
  document.querySelectorAll('.zoom-container').forEach((container) => {
    const img = container.querySelector('img.zoom-image');
    const magnifier = container.querySelector('div.magnifier');
    if (!img || !magnifier) return;

    // 放大倍率（可按需調整）
    const zoomLevel = 2;

    // 計算並設定放大鏡的背景圖與尺寸
    function setupMagnifierBackground() {
      magnifier.style.backgroundImage = `url(${img.src})`;
      magnifier.style.backgroundSize = `${img.width * zoomLevel}px ${img.height * zoomLevel}px`;
    }

    // 等圖片載入完成後再呼叫，確保 img.width/height 正確
    if (img.complete) {
      setupMagnifierBackground();
    } else {
      img.addEventListener('load', setupMagnifierBackground);
    }

    // 放大鏡半徑（此數值要跟 CSS 裡 .magnifier 寬高／2 一致）
    const magnifierRadius = 150 / 2; // 若 CSS 裡 .magnifier 改成 200px 寬，就寫 200/2

    // 滑鼠進入 container 時，將 .magnifier scale 0 → 1
    container.addEventListener('mouseenter', () => {
      gsap.to(magnifier, {
        duration: 0.3,
        scale: 1,
        ease: 'power3.out',
      });
    });

    // 滑鼠離開 container 時，將 .magnifier scale 1 → 0
    container.addEventListener('mouseleave', () => {
      gsap.to(magnifier, {
        duration: 0.3,
        scale: 0,
        ease: 'power3.out',
      });
    });

    // 滑鼠移動時，更新放大鏡位置與背景偏移
    container.addEventListener('mousemove', (e) => {
      const rect = container.getBoundingClientRect();
      const offsetX = e.clientX - rect.left;
      const offsetY = e.clientY - rect.top;

      // 左上角座標，使放大鏡圓心對準滑鼠
      const xpos = offsetX - magnifierRadius;
      const ypos = offsetY - magnifierRadius;

      // 背景須偏移的量：滑鼠在原圖的座標 * zoomLevel - 放大鏡半徑
      const bgX = offsetX * zoomLevel - magnifierRadius;
      const bgY = offsetY * zoomLevel - magnifierRadius;

      // 使用 GSAP 平滑更新位置，並在 onUpdate 裡設定背景位置
      gsap.to(magnifier, {
        duration: 0.1,
        x: xpos,
        y: ypos,
        ease: 'power3.out',
        onUpdate: () => {
          magnifier.style.backgroundPosition = `-${bgX}px -${bgY}px`;
        },
      });
    });
  });
});

</script>

<style lang="scss" scoped>
/* 可以把額外的 CSS 加在這裡或保留在全域 */
@import '/style.scss';
</style>
