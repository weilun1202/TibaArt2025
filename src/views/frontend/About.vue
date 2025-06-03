<template>

  <div class="about">
    <!-- 關於我們 介紹 -->

    <section class="wrapper" ref="wrapper">
      <header class="animate__animated animate__flipInX">
        <div class="pageTitle">關於我們</div>
      </header>

      <div class="banner">
        <div class="banner-text">
          <h2>緯藝基金會 TibaArt </h2>
          <p>Weaving Art, Connecting Worlds.</p>
        </div>
        <img src="/tjd101/g2/assets/img/aboutBanner.jpg" alt="">
      </div>

      <div class="intro">

        <h1>理念</h1>
        <p>
          緯藝基金會（TibaArt）致力於串連藝術與社會的緯度，開啟一個多元、包容且具前瞻性的創作平台。我們相信，藝術不僅是表達，更是一種關係的建立——在人與人之間，在地方與世界之間，在當下與未來之間。TibaArt
          的成立旨在支持具潛力的新銳藝術家、推動跨領域合作，並深耕社群文化，讓藝術成為生活的一部分。透過展演、駐村、教育計畫與數位策展等方式，我們希望拓展觀者的視野，激發創作者的勇氣，並促進藝術資源的公平流動。我們期望與各界共創一個既自由又有溫度的藝術生態，讓每一份創作都能找到屬於它的聽眾與場域。
        </p>
      </div>
      <h1 class="history">大事記</h1>
      <div class="control" ref="controlRef">
        <ul class="timeline" ref="timelineRef">
          <li v-for="item in timelineItems" :key="item.year">
            <img :src="item.img" :alt="item.title" />
            <h3>{{ item.title }}</h3>
            <span>{{ item.description }}</span>
          </li>

        </ul>
      </div>
    </section>
  </div>
</template>

<script setup>

import { ref, onMounted, onBeforeUnmount } from 'vue'
import gsap from 'gsap'

const controlRef = ref(null)
const timelineRef = ref(null)


//timeLine 裡的東西

const timelineItems = ref([
  {
    year: '1925',
    title: '1925 — 創始起源',
    img: '/tjd101/g2/assets/img/about-1925.png',
    description: '在台北大稻埕，藝術推手「林德熙」創立了「提拔藝文社」'
  },
  {
    year: '1934',
    title: '1934 — 女性藝術崛起',
    img: '/tjd101/g2/assets/img/about-1934.png',
    description: '開創「女性創作月」，邀請多位女藝術家展出刺繡、攝影與詩集，打破當時藝術界男性壟斷的局面。'
  },
  {
    year: '1945',
    title: '1945 — 光復重建',
    img: '/tjd101/g2/public/assets/img/about-1945.png',
    description: '光復後，提拔藝回到台北，並成立「台灣青年藝術協會」，與台大、師大美術系合作培育學生。'
  },
  {
    year: '1953',
    title: '1953 — 國際連結',
    img: '/tjd101/g2/public/assets/img/about-1953.png',
    description: '與國際日本水彩大會合辦「亞洲青年藝術家交流展」，並於香港設立分會。'
  },
  {
    year: '1975',
    title: '1975 — 本土現代畫派興起',
    img: '/tjd101/g2/public/assets/img/about-1975.png',
    description: '受到社會運動、解嚴思潮刺激，本土畫派崛起，畫風「新世代主義」逐漸形成。'
  },
  {
    year: '1984',
    title: '1984 — 數位典藏計畫啟動',
    img: '/tjd101/g2/public/assets/img/about-1984.png',
    description: '配合「老藝檔案數位化計畫」，將 1925～1980 年代的資料典藏到資料庫。'
  },
  {
    year: '1995',
    title: '1995 — 登入網路時代',
    img: '/tjd101/g2/public/assets/img/about-1995.png',
    description: '正式上線「提拔藝資料網」，提供線上展覽、作品資料庫查詢與網路購物上架功能。'
  },
  {
    year: '2000',
    title: '2000 — 線上虛擬展間初登場',
    img: '/tjd101/g2/public/assets/img/about-2000.png',
    description: '利用 Flash 技術打造首個「360° 虛擬藝廊空間」，為策展開啟新里程碑。'
  },
  {
    year: '2010',
    title: '2010 — 開放藝術家自行上傳作品',
    img: '/tjd101/g2/public/assets/img/about-2010.png',
    description: '推出「開放投稿平台」，讓藝術家能自主上傳自己的展覽與創作，真正走向平臺化管理。'
  }
])


onMounted(() => {
  const controlEl = controlRef.value
  const timelineEl = timelineRef.value

  // 計算可水平捲動的最大距離
  const totalWidth = timelineEl.scrollWidth
  const viewportWidth = window.innerWidth
  const maxScrollDistance = totalWidth - viewportWidth

  let currentX = 0

  function onWheel(e) {
    e.preventDefault()
    const delta = e.deltaY * 0.8
    let newX = currentX - delta

    // clamp 範圍
    if (newX > 0) newX = 0
    if (newX < -maxScrollDistance) newX = -maxScrollDistance

    // GSAP 給位移
    gsap.to(timelineEl, {
      x: newX,
      ease: 'power2.out',
      duration: 0.3
    })

    currentX = newX
  }

  // 只在滑鼠在 .control 上時，綁定 wheel 事件
  controlEl.addEventListener('wheel', onWheel, { passive: false })

  onBeforeUnmount(() => {
    controlEl.removeEventListener('wheel', onWheel)
  })
})
</script>
