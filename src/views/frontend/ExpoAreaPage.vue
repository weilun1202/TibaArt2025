<template>
  <div class="expoAreaPage">
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

      <!-- 成功載入後顯示作品 -->
      <div v-else class="main">
        <!-- 1. 原本的圖片 -->
        <img ref="targetImg" :src="imgUrl" alt="">

        <!-- 2. 放大鏡容器（初始隱藏） -->
        <div ref="magnifier" class="magnifier">
          <img :src="imgUrl" alt="" ref="magnifierImg" />
        </div>
        <p class="remind">手機板長按圖片看細節!</p>
        <!-- 以下維持你原本的文字區塊 -->
<div class="artwork-title">
  <h2>{{ artworks.name }}</h2>
  <h5>{{ artworks.name_en }}</h5>
  <p>{{ artworks.size }}</p>
  <p>{{ artworks.stuff }}</p>
</div>
<p>{{ artworks.note }}</p>

<router-link :to="`/front/ExpoArea/${expoId}`">
  <button class="btn">返回展區</button>
</router-link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, nextTick, watch, computed } from 'vue'
import { useRoute } from 'vue-router'
import { gsap } from 'gsap'

// 加入路由
const route = useRoute()
const baseUrl = import.meta.env.BASE_URL

// 修改變數宣告
const loading = ref(false)
const error = ref(null)
const artworks = ref({}) // 改為物件而不是陣列

// 使用計算屬性來動態取得圖片路徑
const imgUrl = computed(() => {
  return artworks.value?.img ? baseUrl + artworks.value.img : ''
})

// 計算展覽 ID（用於返回按鈕）
const expoId = computed(() => {
  return artworks.value?.expo_id || null
})

// 用來取得兩個 DOM 節點：原始圖片、放大鏡容器、放大鏡內部的 img
const targetImg = ref(null)
const magnifier = ref(null)
const magnifierImg = ref(null)

// 修正後的作品資料獲取函數
const fetchExpoData = async () => {
  try {
    loading.value = true
    error.value = null

    // 這裡的 id 是作品的 ID，不是展覽的 ID
    const artworkId = route.params.id
    console.log('作品 ID:', artworkId) // 除錯用
    
    if (!artworkId) {
      throw new Error('作品 ID 不存在')
    }
    
    console.log('正在載入作品 ID:', artworkId) // 除錯用
    
    // 直接用作品 ID 查詢單一作品
    const artworkResponse = await fetch(`http://localhost/TIBAART/expoArtwork.php?id=${artworkId}`)
    // const artworkResponse = await fetch(`http://tibamef2e.com/tjd101/g2/api/expoArtwork.php?id=${artworkId}`) 上線用
    console.log('API 回應狀態:', artworkResponse.status) // 除錯用
    
    if (artworkResponse.ok) {
      const artworkResult = await artworkResponse.json()
      console.log('API 回應內容:', artworkResult) // 除錯用
      
      if (artworkResult.success) {
        artworks.value = artworkResult.data
        console.log('作品資料設定完成:', artworks.value) // 除錯用
      } else {
        throw new Error(artworkResult.error || 'API 回傳錯誤')
      }
    } else {
      throw new Error(`HTTP 錯誤: ${artworkResponse.status}`)
    }

  } catch (err) {
    error.value = err.message || '網路錯誤'
    console.error('資料載入錯誤:', err)
  } finally {
    loading.value = false
  }
}

// 設定放大鏡功能
const setupMagnifier = () => {
  // 確保 DOM 元素存在
  if (!targetImg.value || !magnifier.value || !magnifierImg.value) {
    console.warn('放大鏡 DOM 元素未準備好')
    return
  }

  console.log('開始設定放大鏡功能') // 除錯用

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
}

// 監聽 artworks 變化，當資料載入完成後設定放大鏡
watch(artworks, async (newValue) => {
  if (newValue && Object.keys(newValue).length > 0) {
    console.log('資料已載入，準備設定放大鏡') // 除錯用
    await nextTick() // 等待 DOM 更新
    setupMagnifier()
  }
})

onMounted(async () => {
  console.log('頁面已載入，開始初始化') // 除錯用
  loading.value = true
  await fetchExpoData()
  await nextTick()
  if (Object.keys(artworks.value).length) {
    setupMagnifier()
  }
})
</script>