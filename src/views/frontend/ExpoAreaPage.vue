<template>
  <div class="expoAreaPage">
    <div class="wrapper">
      <div class="main">
        <!-- 1. 原本的圖片 -->
        <img ref="targetImg" :src="imgUrl" alt="">

        <!-- 2. 放大鏡容器（初始隱藏） -->
        <div ref="magnifier" class="magnifier">
          <img :src="imgUrl" alt="" ref="magnifierImg" />
        </div>
        <p class="remind">長按圖片看細節!</p>

        <!-- 以下維持你原本的文字區塊 -->
        <div class="artwork-title">
          <h2>{{ currentArtwork.title.zh }}</h2>
          <h5>{{ currentArtwork.title.en }}</h5>
          <p>{{ currentArtwork.size }}</p>
          <p>{{ currentArtwork.type }}</p>
        </div>
        <p>{{ currentArtwork.description }}</p>

        <router-link to="/front/ExpoArea">
          <button class="btn">返回展區</button>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { gsap } from 'gsap'

// 作品資料
const currentArtwork = ref({
  title: {
    zh: '凝視遺聲',
    en: 'Gaze of Unspoken'
  },
  size: 'size 66x66(m)',
  type: '雕塑',
  description: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae rem perferendis cum exercitationem quidem sequi, sit error accusantium asperiores distinctio.Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae rem perferendis cum exercitationem quidem sequi, sit error accusantium asperiores distinctio.'
})

// 圖片路徑（跟你原本一樣自動拼 BASE_URL）
const imgUrl = import.meta.env.BASE_URL + 'assets/img/expoArea-artwork1.png'

// 用來取得兩個 DOM 節點：原始圖片、放大鏡容器、放大鏡內部的 img
const targetImg = ref(null)
const magnifier = ref(null)
const magnifierImg = ref(null)

onMounted(() => {
  // 常數設定
  const LONGPRESS_DELAY = 600 // 長按時間門檻 (毫秒)
  const MOVE_TOLERANCE = 10   // 長按前允許的手指微移範圍 (px)
  const MAG_SCALE = 2         // 放大倍率
  const MAG_DIAM = 120        // 固定放大鏡直徑，不依賴動態計算

  let longPressTimer = null
  let touchStartX = 0, touchStartY = 0
  let isLongPressed = false

  // 進出場動畫都會用到的函式
  function showMagnifier(clientX, clientY) {
    // 1. 把放大鏡置中在手指／滑鼠位置
    const magSize = MAG_DIAM
    magnifier.value.style.left = (clientX - magSize / 2) + 'px'
    magnifier.value.style.top = (clientY - magSize / 2) + 'px'

    // 2. 設定放大鏡內部大圖的位置
    positionMagImage(clientX, clientY)

    // 3. 用 GSAP 漸顯＋縮放到正常大小 (scale:1)
    gsap.killTweensOf(magnifier.value)
    gsap.to(magnifier.value, {
      duration: 0.25,
      opacity: 1,
      scale: 1,
      ease: 'power2.out'
    })
  }

  function updateMagnifier(clientX, clientY) {
    const magSize = MAG_DIAM
    magnifier.value.style.left = (clientX - magSize / 2) + 'px'
    magnifier.value.style.top = (clientY - magSize / 2) + 'px'
    positionMagImage(clientX, clientY)
  }

  function hideMagnifier() {
    gsap.killTweensOf(magnifier.value)
    gsap.to(magnifier.value, {
      duration: 0.2,
      opacity: 0,
      scale: 0.2,
      ease: 'power2.in'
    })
  }

  // 修正後的計算放大鏡內部 img 的位置
  function positionMagImage(clientX, clientY) {
    const imgRect = targetImg.value.getBoundingClientRect()

    // 滑鼠/手指相對於圖片的位置
    const relX = clientX - imgRect.left
    const relY = clientY - imgRect.top

    // 確保座標在圖片範圍內
    const clampedX = Math.max(0, Math.min(relX, imgRect.width))
    const clampedY = Math.max(0, Math.min(relY, imgRect.height))

    // 計算放大鏡內部圖片的偏移
    // 放大後的圖片尺寸
    const scaledWidth = imgRect.width * MAG_SCALE
    const scaledHeight = imgRect.height * MAG_SCALE

    // 計算要顯示的區域在放大後圖片中的位置
    const offsetX = clampedX * MAG_SCALE - MAG_DIAM / 2
    const offsetY = clampedY * MAG_SCALE - MAG_DIAM / 2

    // 設定放大鏡內部圖片的變換
    magnifierImg.value.style.width = imgRect.width + 'px'
    magnifierImg.value.style.height = imgRect.height + 'px'
    magnifierImg.value.style.transform = `scale(${MAG_SCALE}) translate(${-offsetX / MAG_SCALE}px, ${-offsetY / MAG_SCALE}px)`
    magnifierImg.value.style.transformOrigin = 'top left'
  }

  // ---------- desktop: mouse 事件 ----------
  targetImg.value.addEventListener('mouseenter', (e) => {
    showMagnifier(e.clientX, e.clientY)
  })

  targetImg.value.addEventListener('mousemove', (e) => {
    updateMagnifier(e.clientX, e.clientY)
  })

  targetImg.value.addEventListener('mouseleave', () => {
    hideMagnifier()
  })

  // ---------- mobile: touch 事件 ----------
  targetImg.value.addEventListener('touchstart', (e) => {
    e.preventDefault() // 防止觸發其他手勢
    if (e.touches.length !== 1) return

    const touch = e.touches[0]
    touchStartX = touch.clientX
    touchStartY = touch.clientY
    isLongPressed = false

    longPressTimer = setTimeout(() => {
      isLongPressed = true
      showMagnifier(touch.clientX, touch.clientY)
    }, LONGPRESS_DELAY)
  })

  targetImg.value.addEventListener('touchmove', (e) => {
    e.preventDefault() // 防止頁面滾動干擾
    if (e.touches.length !== 1) return

    const touch = e.touches[0]
    const dx = Math.abs(touch.clientX - touchStartX)
    const dy = Math.abs(touch.clientY - touchStartY)

    // 如果在長按前移動超出容許範圍，取消長按計時
    if (!isLongPressed && (dx > MOVE_TOLERANCE || dy > MOVE_TOLERANCE)) {
      clearTimeout(longPressTimer)
    }

    // 如果已經進入長按狀態，持續更新放大鏡位置
    if (isLongPressed) {
      updateMagnifier(touch.clientX, touch.clientY)
    }
  })

  // touchend 或 touchcancel，都要停止計時並收回放大鏡
  const cancelTouch = () => {
    clearTimeout(longPressTimer)
    if (isLongPressed) {
      hideMagnifier()
      isLongPressed = false
    }
  }

  targetImg.value.addEventListener('touchend', cancelTouch)
  targetImg.value.addEventListener('touchcancel', cancelTouch)
})
</script>

<style lang="scss" scoped>
@import '/style.scss';
</style>
