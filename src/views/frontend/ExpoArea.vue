<template>
  <div class="expoArea">
    <div class="wrapper">
      <!-- Wrapper 不設 1200px 寬（例如展覽、關於我們頁面應該會滿版），想要限制內容在 1200 的再自己包一個 div 限制 1200  -->
      <!-- 以下供大家編輯 -->
    <div class="banner" v-for="(item, index) in expo" :key="index">
      <div class="banner-text">
        <h1>{{ item.expoTitleZh }}</h1>
        <p>{{ item.expoTitleEn }}</p>
        <p>{{ item.expoDes }}</p>
        <router-link to="/front/Sponsor">
          <button>贊助</button>
        </router-link>
      </div>
      <img :src="item.imgSrc" alt="" />
    </div>


      <div class="expoArea-intro">
        <h2>藝術家介紹</h2>
        
        
        <div class="expoArea-artist" v-for="(item, index) in artist" :key="index">
          <img :src="item.imgSrc" alt="artist" />
          <div class="artist-text">
            <h5 v-html="item.description"></h5>
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

// 宣告 陣列
const artist = ref([
  {
    imgSrc: import.meta.env.BASE_URL + '/assets/img/expoArea-artist.png',
    description: `出生於冰島雷克雅維克，自幼沉浸於極光與火山地貌的視覺震撼中。20歲時赴挪威卑爾根藝術學院深造，後旅居日本京都五年，受禪意美學影響深遠。
她認為自然界的極端對比，冷與熱、生與死、光與闇，是情緒最誠實的投射。她的創作動機是透過畫布「捕捉內心風暴中那道平靜的光」，將感知與直覺轉化為視覺語言。`
  }
])

const expo = ref([
  {
    expoTitleZh:'靜界焰光',
    expoTitleEn:'The Luminous Silence',
    expoDes:'「當情感無以為繼，色彩替我們說話。」 凱婭·露希亞的創作長年在寂靜與爆發之間來回拉扯，她以自然隱喻人心，讓畫布成為風暴中心的靜止點。 本次展覽精選其近十年間五件代表作，以色彩為線索，從冷冽冰縫、綠林密靜，到炙熱的內燃記憶，呈現一場無語卻極具張力的感官旅程。觀者不需理解，僅需感受',
    imgSrc: import.meta.env.BASE_URL + '/assets/img/expoArea-banner.png',
  },
])

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
import { onMounted } from 'vue'
import { gsap } from 'gsap'

onMounted(() => {
  document.querySelectorAll('.zoom-container').forEach((container) => {
    const img = container.querySelector('img.zoom-image')
    const magnifier = container.querySelector('div.magnifier')
    if (!img || !magnifier) return

    // 放大倍率（可自行調整）
    const zoomLevel = 1.5

    // 放大鏡直徑與半徑：動態讀取 .magnifier 的 offsetWidth
    function getMagnifierRadius() {
      const diameter = magnifier.offsetWidth
      return diameter / 2
    }
    let magnifierRadius = getMagnifierRadius()

    // 設定放大鏡背景：使用圖片的 naturalWidth / naturalHeight 保證比例正確
    function setupMagnifierBackground() {
      magnifierRadius = getMagnifierRadius() // 每次重新計算 radius（若 CSS 有做響應式改變也能即時更新）
      const bgWidth = img.naturalWidth * zoomLevel
      const bgHeight = img.naturalHeight * zoomLevel
      magnifier.style.backgroundImage = `url(${img.src})`
      magnifier.style.backgroundSize = `${bgWidth}px ${bgHeight}px`
    }

    // 若圖片已經載入完，馬上建立背景；否則等 load 事件
    if (img.complete) {
      setupMagnifierBackground()
    } else {
      img.addEventListener('load', setupMagnifierBackground)
    }

    // 當滑鼠移到容器時，放大鏡出現
    container.addEventListener('mouseenter', () => {
      // 確保放大鏡半徑是最新的
      magnifierRadius = getMagnifierRadius()
      gsap.to(magnifier, {
        duration: 0.3,
        scale: 1,
        ease: 'power3.out',
      })
    })

    // 離開時縮回去
    container.addEventListener('mouseleave', () => {
      gsap.to(magnifier, {
        duration: 0.3,
        scale: 0,
        ease: 'power3.out',
      })
    })

    // 滑鼠移動時更新放大鏡位置與背景
    container.addEventListener('mousemove', (e) => {
      const rect = container.getBoundingClientRect()
      // 計算滑鼠在 container 內的 x, y
      let offsetX = e.clientX - rect.left
      let offsetY = e.clientY - rect.top

      // Clamp 滑鼠位置，讓放大鏡的中心不會超出圖片範圍
      // 放大鏡 center 最多只能在 [magnifierRadius/zoomLevel, img.width - magnifierRadius/zoomLevel]
      const minCenterX = magnifierRadius / zoomLevel
      const maxCenterX = img.clientWidth - (magnifierRadius / zoomLevel)
      const minCenterY = magnifierRadius / zoomLevel
      const maxCenterY = img.clientHeight - (magnifierRadius / zoomLevel)

      // 將 offsetX/Y 限制在可用範圍
      const centerX = Math.min(Math.max(offsetX, minCenterX), maxCenterX)
      const centerY = Math.min(Math.max(offsetY, minCenterY), maxCenterY)

      // 放大鏡左上角位置：讓圓心對準 (centerX, centerY)
      const xpos = centerX - magnifierRadius
      const ypos = centerY - magnifierRadius

      // 背景偏移量：游標在圖片真實像素座標 * zoomLevel - magnifierRadius
      // 這邊一樣要用「img 的顯示寬度」轉換成真實像素，再乘 zoomLevel
      // 若圖片有寬度縮放，比方 container 變小，offsetX, offsetY 對應的是顯示尺寸，
      // 背景偏移必須算：offset / clientWidth * naturalWidth
      const ratioX = centerX / img.clientWidth
      const ratioY = centerY / img.clientHeight
      const bgX = ratioX * img.naturalWidth * zoomLevel - magnifierRadius
      const bgY = ratioY * img.naturalHeight * zoomLevel - magnifierRadius

      // 直接用 gsap.set 讓 position 跟背景一起對齊
      gsap.set(magnifier, {
        x: xpos,
        y: ypos,
        onUpdate: () => {
          magnifier.style.backgroundPosition = `-${bgX}px -${bgY}px`
        }
      })
    })
  })
})

</script>

<style lang="scss" scoped>
/* 可以把額外的 CSS 加在這裡或保留在全域 */
@import '/style.scss';
</style>
