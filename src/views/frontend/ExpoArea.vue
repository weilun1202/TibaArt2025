<template>
  <div class="expoArea">
    <div class="wrapper">
      <!-- 載入狀態 -->
      <div v-if="loading" class="loading">
        <p>載入中...</p>
      </div>

      <!-- 錯誤狀態 -->
      <div v-else-if="error" class="error">
        <p>載入失敗：{{ error }}</p>
        <button @click="fetchExpoData">重新載入</button>
      </div>

      <!-- 主要內容 -->
      <div v-else>
        <!-- 展覽橫幅 -->
        <div class="banner" v-if="expoData">
          <div class="banner-text">
            <h1>{{ expoData.name }}</h1>
            <p>{{ expoData.name_en }}</p>
            <p>{{ expoData.note }}</p>
            <router-link to="/front/Sponsor">
              <button>贊助</button>
            </router-link>
          </div>
          <img :src="baseUrl + expoData.cover" :alt="expoData.name" />
        </div>

        <!-- 藝術家介紹 -->
        <div class="expoArea-intro" v-if="artistData">
          <h2>藝術家介紹</h2>
          <div class="expoArea-artist">
            <img :src="baseUrl + artistData.img" alt="artist" />
            <div class="artist-text">
              <h5 v-html="artistData.intro"></h5>
              <div class="icons">
                <font-awesome-icon icon="globe" />
                <font-awesome-icon :icon="['fab', 'instagram']" />
                <font-awesome-icon :icon="['fab', 'behance']" />
              </div>
            </div>
          </div>
        </div>

        <!-- 藝術作品 -->
        <ul class="expoArea-artwork" v-if="artworks.length > 0">
          <li v-for="(art, idx) in artworks" :key="idx" class="expoArea-card">
            <div class="zoom-container">
              <router-link :to="`/front/ExpoAreaPage/${art.id}`">
                <img class="zoom-image" :src="baseUrl + art.img" :alt="art.title" />
              </router-link>
              <div class="magnifier"></div>
            </div>
            <div class="title">
              <h3>{{ art.name }}</h3>
              <p>{{ art.name_en }}</p>
              <p>{{ art.stuff }}</p>
            </div>
            <p>{{ art.note }}</p>
            <router-link :to="`/front/ExpoAreaPage/${art.id}`">learn more</router-link>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import { gsap } from 'gsap'

const route = useRoute()
const baseUrl = import.meta.env.BASE_URL

// 響應式資料
const loading = ref(true)
const error = ref(null)
const expoData = ref(null)
const artistData = ref(null)
const artworks = ref([])

// 獲取展覽資料
const fetchExpoData = async () => {
  try {
    loading.value = true
    error.value = null

    const expoId = route.params.id
    if (!expoId) {
      throw new Error('展覽 ID 不存在')
    }

    // 取得展覽詳細資料
    const expoResponse = await fetch(`${import.meta.env.VITE_ExpoDetail}?id=${expoId}`)
    //const response = await fetch(`${import.meta.env.VITE_ExpoDetail}?id=${expoId}`)  上線用
    if (!expoResponse.ok) throw new Error(`HTTP 錯誤：${expoResponse.status}`)

    const expoResult = await expoResponse.json()
    if (!expoResult.success) throw new Error(expoResult.error || '展覽資料載入失敗')

    expoData.value = expoResult.data

    // 如果有藝術家 ID，取得藝術家資料
    if (expoData.value.artist_id) {
      //const artistResponse = await fetch(`${import.meta.env.VITE_Artist}?id=${expoData.value.artist_id}`) 上線用
      const artistResponse = await fetch(`${import.meta.env.VITE_Artist}?id=${expoData.value.artist_id}`)
      if (artistResponse.ok) {
        const artistResult = await artistResponse.json()
        if (artistResult.success) {
          console.log("abc")
          artistData.value = artistResult.data
        }
      }
    }

    //取得該展覽的作品
    const artworksResponse = await fetch(`${import.meta.env.VITE_Artworks}?expo_id=${expoId}`)
    if (artworksResponse.ok) {
      const artworksResult = await artworksResponse.json()
      if (artworksResult.success) {
        artworks.value = artworksResult.data
      }
    }

  } catch (err) {
    error.value = err.message || '網路錯誤'
    console.error('資料載入錯誤:', err)
  } finally {
    loading.value = false
  }
}

// 放大鏡功能
const initZoomEffect = () => {
  document.querySelectorAll('.zoom-container').forEach((container) => {
    const img = container.querySelector('img.zoom-image')
    const magnifier = container.querySelector('div.magnifier')
    if (!img || !magnifier) return

    const zoomLevel = 1.5

    function getMagnifierRadius() {
      const diameter = magnifier.offsetWidth
      return diameter / 2
    }
    let magnifierRadius = getMagnifierRadius()

    function setupMagnifierBackground() {
      magnifierRadius = getMagnifierRadius()
      const bgWidth = img.naturalWidth * zoomLevel
      const bgHeight = img.naturalHeight * zoomLevel
      magnifier.style.backgroundImage = `url(${img.src})`
      magnifier.style.backgroundSize = `${bgWidth}px ${bgHeight}px`
    }

    if (img.complete) {
      setupMagnifierBackground()
    } else {
      img.addEventListener('load', setupMagnifierBackground)
    }

    container.addEventListener('mouseenter', () => {
      magnifierRadius = getMagnifierRadius()
      gsap.to(magnifier, {
        duration: 0.3,
        scale: 1,
        ease: 'power3.out',
      })
    })

    container.addEventListener('mouseleave', () => {
      gsap.to(magnifier, {
        duration: 0.3,
        scale: 0,
        ease: 'power3.out',
      })
    })

    container.addEventListener('mousemove', (e) => {
      const rect = container.getBoundingClientRect()
      let offsetX = e.clientX - rect.left
      let offsetY = e.clientY - rect.top

      const minCenterX = magnifierRadius / zoomLevel
      const maxCenterX = img.clientWidth - (magnifierRadius / zoomLevel)
      const minCenterY = magnifierRadius / zoomLevel
      const maxCenterY = img.clientHeight - (magnifierRadius / zoomLevel)

      const centerX = Math.min(Math.max(offsetX, minCenterX), maxCenterX)
      const centerY = Math.min(Math.max(offsetY, minCenterY), maxCenterY)

      const xpos = centerX - magnifierRadius
      const ypos = centerY - magnifierRadius

      const ratioX = centerX / img.clientWidth
      const ratioY = centerY / img.clientHeight
      const bgX = ratioX * img.naturalWidth * zoomLevel - magnifierRadius
      const bgY = ratioY * img.naturalHeight * zoomLevel - magnifierRadius

      gsap.set(magnifier, {
        x: xpos,
        y: ypos,
        onUpdate: () => {
          magnifier.style.backgroundPosition = `-${bgX}px -${bgY}px`
        }
      })
    })
  })
}

onMounted(async () => {
  await fetchExpoData()
  // 等待 DOM 更新後初始化放大鏡
  setTimeout(() => {
    initZoomEffect()
  }, 100)
})
</script>

<style lang="scss" scoped>
@import '/style.scss';

.loading {
  text-align: center;
  padding: 2rem;
  font-size: 1.2rem;
}

.error {
  text-align: center;
  padding: 2rem;
  color: #e74c3c;
}

.error button {
  margin-top: 1rem;
  padding: 0.5rem 1rem;
  background-color: #3498db;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.error button:hover {
  background-color: #2980b9;
}
</style>