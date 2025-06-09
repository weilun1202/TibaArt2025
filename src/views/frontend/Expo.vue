<template>
  <div class="expo">
    <div class="wrapper">
      <header class="animate__animated animate__flipInX">
        <div class="pageTitle">線上展覽</div>
      </header>

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
      <div v-else class="parent" ref="parentRef">
        <router-link 
          v-for="item in expoItems" 
          :key="item.id" 
          :to="item.to"
          :class="`grid ${item.className} ${item.side}`"
        >
          <img 
            class="has-tooltip" 
            :data-title="item.titleZh" 
            :src="baseUrl + item.img" 
            :alt="item.titleZh" 
          />
        </router-link>
        <div class="tooltip" ref="tooltipRef"></div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, nextTick, onUnmounted } from 'vue'
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

// 註冊 ScrollTrigger 插件
gsap.registerPlugin(ScrollTrigger)

// 響應式資料
const baseUrl = import.meta.env.BASE_URL
const expoItems = ref([])
const loading = ref(true)
const error = ref(null)

const parentRef = ref(null)
const tooltipRef = ref(null)

// 用來存儲 ScrollTrigger 實例，方便清理
const scrollTriggers = ref([])

// 撈取資料
const fetchExpoData = async () => {
  try {
    loading.value = true
    error.value = null

    const response = await fetch('http://localhost/TIBAART/expo.php')
    if (!response.ok) throw new Error(`HTTP 錯誤：${response.status}`)

    const jsonData = await response.json()
    if (!jsonData.success) throw new Error(jsonData.error || '資料載入失敗')

    expoItems.value = jsonData.data

    // 等 DOM 更新完成後初始化動畫
    await nextTick()
    
    // 稍微延遲確保 DOM 完全渲染
    setTimeout(() => {
      initAnimations()
    }, 100)

  } catch (err) {
    error.value = err.message || '網路錯誤'
    console.error('資料載入錯誤:', err)
  } finally {
    loading.value = false
  }
}

// 初始化動畫和 tooltip
const initAnimations = () => {
  console.log('開始初始化動畫...') // 除錯用
  
  if (!parentRef.value) {
    console.warn('parentRef 不存在')
    return
  }

  // 清理之前的 ScrollTriggers
  scrollTriggers.value.forEach(trigger => trigger.kill())
  scrollTriggers.value = []

  const grids = parentRef.value.querySelectorAll('.grid')
  console.log('找到的 grid 元素數量:', grids.length) // 除錯用

  if (grids.length === 0) {
    console.warn('沒有找到 .grid 元素')
    return
  }

  // ScrollTrigger 動畫
  grids.forEach((el, index) => {
    const trigger = gsap.fromTo(
      el,
      { opacity: 0, y: 50 },
      {
        opacity: 1,
        y: 0,
        duration: 0.8,
        ease: 'power1.out',
        delay: index * 0.2,
        scrollTrigger: {
          trigger: el,
          start: 'top 90%', // 調整觸發點
          end: 'bottom 10%',
          toggleActions: 'play none none reverse',
          // markers: true, // 開發時可以開啟來看觸發點
          onToggle: (self) => {
            console.log('ScrollTrigger 觸發:', self.isActive) // 除錯用
          }
        }
      }
    )
    
    // 保存 ScrollTrigger 實例
    if (trigger.scrollTrigger) {
      scrollTriggers.value.push(trigger.scrollTrigger)
    }
  })

  // 初始化 Tooltip
  initTooltip()
}

// 獨立的 tooltip 初始化函數
const initTooltip = () => {
  const tooltipEl = tooltipRef.value
  
  if (!tooltipEl) {
    console.warn('tooltip 元素不存在')
    return
  }

  const imgs = parentRef.value.querySelectorAll('.has-tooltip')
  console.log('找到的 tooltip 圖片數量:', imgs.length) // 除錯用

  imgs.forEach(img => {
    img.addEventListener('mouseenter', (e) => {
      const text = img.getAttribute('data-title') || ''
      if (!text) return

      console.log('顯示 tooltip:', text) // 除錯用

      tooltipEl.textContent = text
      tooltipEl.style.display = 'block'
      
      gsap.set(tooltipEl, {
        left: e.clientX + 10 + 'px',
        top: e.clientY - 10 + 'px',
        scale: 0.8,
        opacity: 0
      })
      
      gsap.to(tooltipEl, {
        duration: 0.2,
        opacity: 1,
        scale: 1,
        ease: 'power2.out'
      })
    })

    img.addEventListener('mousemove', (e) => {
      gsap.set(tooltipEl, {
        left: e.clientX + 10 + 'px',
        top: e.clientY - 10 + 'px'
      })
    })

    img.addEventListener('mouseleave', () => {
      gsap.to(tooltipEl, {
        duration: 0.15,
        opacity: 0,
        scale: 0.8,
        ease: 'power2.in',
        onComplete: () => {
          tooltipEl.style.display = 'none'
        }
      })
    })
  })
}

// 頁面載入時執行
onMounted(async () => {
  console.log('組件已掛載') // 除錯用
  await fetchExpoData()
})

// 清理 ScrollTriggers
onUnmounted(() => {
  scrollTriggers.value.forEach(trigger => trigger.kill())
  ScrollTrigger.getAll().forEach(trigger => trigger.kill())
})
</script>

<style scoped>
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

/* 確保 parent 容器有足夠高度讓 ScrollTrigger 工作 */
.parent {
  min-height: 100vh;
  position: relative;
}

/* Tooltip 樣式 */
.tooltip {
  position: fixed;
  background: rgba(0, 0, 0, 0.8);
  color: white;
  padding: 8px 12px;
  border-radius: 4px;
  font-size: 14px;
  pointer-events: none;
  z-index: 1000;
  display: none;
  white-space: nowrap;
}

/* 確保圖片可以觸發 hover */
.has-tooltip {
  cursor: pointer;
}

/* 確保 grid 元素有基本樣式 */
.grid {
  display: block;
  margin-bottom: 20px;
  transition: transform 0.3s ease;
}

.grid:hover {
  transform: scale(1.05);
}
</style>