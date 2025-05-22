<template>
  <div>
    <!-- 關於我們 介紹 -->
    <header>
      <div class="pageTitle">關於我們</div>
    </header>
    <section class="intro">
      <h1>理念</h1>
      <p>
        緯藝基金會（TibaArt）致力於串連藝術與社會的緯度，開啟一個多元、包容且具前瞻性的創作平台……
      </p>
    </section>

    <!-- 大事記 瀑布水平滾動區塊 -->
    <section class="wrapper" ref="wrapper">
      <h1>大事記</h1>
      <ul class="timeline" ref="timeline">
        <li>
          <img src="" alt="1925 — 創始起源" />
          <strong>1925 — 創始起源</strong><br />
          在台北大稻埕，藝術推手「林德熙」創立了「提拔藝文社」……
        </li>
        <li>
          <img src="" alt="1934 — 女性藝術崛起" />
          <strong>1934 — 女性藝術崛起</strong><br />
          開創「女性創作月」……
        </li>
        <li>
          <img src="" alt="1945 — 光復重建">
          <strong>1945 — 光復重建</strong><br>
          光復後，提拔藝回到台北，並成立「台灣青年藝術協會」，與台大、師大美術系合作培育學生。
        </li>
        <li>
          <img src="" alt="1953 — 國際連結">
          <strong>1953 — 國際連結</strong><br>
          與國際日本水彩大會合辦「亞洲青年藝術家交流展」，並於香港設立分會。
        </li>
        <li>
          <img src="" alt="1975 — 本土現代畫派興起">
          <strong>1975 — 本土現代畫派興起</strong><br>
          受到社會運動、解嚴思潮刺激，本土畫派崛起，畫風「新世代主義」逐漸形成。
        </li>
        <li>
          <img src="" alt="1984 — 數位典藏計畫啟動">
          <strong>1984 — 數位典藏計畫啟動</strong><br>
          配合「老藝檔案數位化計畫」，將 1925～1980 年代的資料典藏到資料庫。
        </li>
        <li>
          <img src="" alt="1995 — 登入網路時代">
          <strong>1995 — 登入網路時代</strong><br>
          正式上線「提拔藝資料網」，提供線上展覽、作品資料庫查詢與網路購物上架功能。
        </li>
        <li>
          <img src="" alt="2000 — 線上虛擬展間初登場">
          <strong>2000 — 線上虛擬展間初登場</strong><br>
          利用 Flash 技術打造首個「360° 虛擬藝廊空間」，為策展開啟新里程碑。
        </li>
        <li>
          <img src="" alt="2010 — 開放藝術家自行上傳作品">
          <strong>2010 — 開放藝術家自行上傳作品</strong><br>
          推出「開放投稿平台」，讓藝術家能自主上傳自己的展覽與創作，真正走向平臺化管理。
        </li>

      </ul>
    </section>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

gsap.registerPlugin(ScrollTrigger)

const wrapper = ref(null)
const timeline = ref(null)

onMounted(() => {
  if (!wrapper.value || !timeline.value) return

  const el = timeline.value
  const width = el.scrollWidth - window.innerWidth

  gsap.to(el, {
    x: -width,
    ease: 'none',
    scrollTrigger: {
      trigger: wrapper.value,
      start: 'top top',
      end: () => `+=${width}`,
      scrub: true,
      pin: true,
      anticipatePin: 1
    }
  })
})
</script>

<style scoped>
/* 基本排版 */
body {
  margin: 0;
  font-family: Tahoma, Geneva, Verdana, sans-serif;
}

nav ul {
  display: flex;
  list-style: none;
  padding: 0;
  background: #333;
}

nav li a {
  color: #fff;
  padding: 0.5em 1em;
  text-decoration: none;
}

.pageTitle {
  padding: 1em;
  font-size: 1.5em;
}

/* 介紹段落 */
.intro {
  padding: 2em;
}

/* 大事記水平滾動 */
.wrapper {
  overflow: hidden;
  position: relative;
  padding: 1rem 0;
}

.timeline {
  display: flex;
  padding: 0;
  margin: 0;
  list-style: none;
}

.timeline li {
  flex: 0 0 auto;
  width: 260px;
  margin-right: 16px;
  background: #f9f9f9;
  border-radius: 8px;
  padding: 1em;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

.timeline li img {
  width: 100%;
  border-radius: 4px;
  margin-bottom: 0.5em;
}
</style>
