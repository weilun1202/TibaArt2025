<template>
  <div class="expo">
    <div class="wrapper">
      <header class="animate__animated animate__flipInX">
        <div class="pageTitle">線上展覽</div>
      </header>

      <!-- 在這裡加上 ref -->
      <div class="parent" ref="parentRef">
        <router-link v-for="item in expoItems" :key="item.id" :to="item.to"
          :class="`grid ${item.className} ${item.side}`">
          <img class="has-tooltip" :data-title="item.title" :src="item.img" alt="" />
        </router-link>
        <div class="tooltip" ref="tooltipRef"></div>
        <!-- 只保留一個 tooltip -->
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, nextTick } from 'vue'
// 1. 從 gsap 取出核心，並引入 ScrollTrigger
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

// 註冊插件
gsap.registerPlugin(ScrollTrigger)

// 2. 定義 expoItems（你原本的資料）
const expoItems = ref([
  {
    id: 1,
    to: '/front/ExpoArea',
    className: 'div1',
    side: 'left',
    img: import.meta.env.BASE_URL + '/assets/img/expo1.jpg',
    title: '圖片的提示文字1'
  },
  {
    id: 2,
    to: '/front/ExpoArea',
    className: 'div2',
    side: 'right',
    img: import.meta.env.BASE_URL + '/assets/img/expo2.jpg',
    title: '圖片的提示文字2'
  },
  {
    id: 3,
    to: '/front/ExpoArea',
    className: 'div3',
    side: 'right',
    img: import.meta.env.BASE_URL + '/assets/img/expo3.jpg',
    title: '圖片的提示文字3'
  },
  {
    id: 4,
    to: '/front/ExpoArea',
    className: 'div4',
    side: 'left',
    img: import.meta.env.BASE_URL + '/assets/img/expo4.jpg',
    title: '圖片的提示文字4'
  },
  {
    id: 5,
    to: '/front/ExpoArea',
    className: 'div5',
    side: 'left',
    img: import.meta.env.BASE_URL + '/assets/img/expo5.jpg',
    title: '圖片的提示文字5'
  },
  {
    id: 6,
    to: '/front/ExpoArea',
    className: 'div6',
    side: 'right',
    img: import.meta.env.BASE_URL + '/assets/img/expo6.jpg',
    title: '圖片的提示文字6'
  },
  {
    id: 7,
    to: '/front/ExpoArea',
    className: 'div7',
    side: 'right',
    img: import.meta.env.BASE_URL + '/assets/img/expo7.jpg',
    title: '圖片的提示文字7'
  },
  {
    id: 8,
    to: '/front/ExpoArea',
    className: 'div8',
    side: 'left',
    img: import.meta.env.BASE_URL + '/assets/img/expo8.jpg',
    title: '圖片的提示文字8'
  },
  {
    id: 9,
    to: '/front/ExpoArea',
    className: 'div9',
    side: 'left',
    img: import.meta.env.BASE_URL + '/assets/img/expo9.jpg',
    title: '圖片的提示文字9'
  },
  {
    id: 10,
    to: '/front/ExpoArea',
    className: 'div10',
    side: 'right',
    img: import.meta.env.BASE_URL + '/assets/img/expo10.jpg',
    title: '圖片的提示文字10'
  },
  {
    id: 11,
    to: '/front/ExpoArea',
    className: 'div11',
    side: 'right',
    img: import.meta.env.BASE_URL + '/assets/img/expo11.jpg',
    title: '圖片的提示文字11'
  },
  {
    id: 12,
    to: '/front/ExpoArea',
    className: 'div12',
    side: 'left',
    img: import.meta.env.BASE_URL + '/assets/img/expo12.jpg',
    title: '圖片的提示文字12'
  },
  {
    id: 13,
    to: '/front/ExpoArea',
    className: 'div13',
    side: 'left',
    img: import.meta.env.BASE_URL + '/assets/img/expo13.jpg',
    title: '圖片的提示文字13'
  },
  {
    id: 14,
    to: '/front/ExpoArea',
    className: 'div14',
    side: 'right',
    img: import.meta.env.BASE_URL + '/assets/img/expo14.jpg',
    title: '圖片的提示文字14'
  },
  {
    id: 15,
    to: '/front/ExpoArea',
    className: 'div15',
    side: 'right',
    img: import.meta.env.BASE_URL + '/assets/img/expo15.jpg',
    title: '圖片的提示文字15'
  },
  {
    id: 16,
    to: '/front/ExpoArea',
    className: 'div16',
    side: 'left',
    img: import.meta.env.BASE_URL + '/assets/img/expo16.jpg',
    title: '圖片的提示文字16'
  },
  {
    id: 17,
    to: '/front/ExpoArea',
    className: 'div17',
    side: 'left',
    img: import.meta.env.BASE_URL + '/assets/img/expo17.jpg',
    title: '圖片的提示文字17'
  },
  {
    id: 18,
    to: '/front/ExpoArea',
    className: 'div18',
    side: 'right',
    img: import.meta.env.BASE_URL + '/assets/img/expo18.jpg',
    title: '圖片的提示文字18'
  },
  {
    id: 19,
    to: '/front/ExpoArea',
    className: 'div19',
    side: 'right',
    img: import.meta.env.BASE_URL + '/assets/img/expo19.jpg',
    title: '圖片的提示文字19'
  }
])

// 3. 建立一個 ref 拿到 parent 容器
const parentRef = ref(null)
const tooltipRef = ref(null)

onMounted(async () => {
  // 等到 DOM 更新完成
  await nextTick()

  // 找到 parentRef 裡所有 .grid 元素
  const grids = parentRef.value.querySelectorAll('.grid')

  // 針對每一個 grid 元素，建立 scrollTrigger 動畫
  grids.forEach((el, index) => {
    gsap.fromTo(
      el,
      { opacity: 0, y: 50 }, // 從「透明 + 往下偏移 50px」開始
      {
        opacity: 1,
        y: 0,
        duration: 0.8,
        ease: 'power1.out',
        delay: index * 0.2, // 每個往後延遲 0.2 秒，做「依序」效果
        scrollTrigger: {
          trigger: el,
          start: 'top 100%',       // 當 el 的 top 到達 viewport 底下時觸發
          toggleActions: 'play reverse play reverse',
          // play：捲動進來時播放
          // reverse：捲動回去時反向（即淡出）
          // 之後可視需求改成 'play none none none'（只要進來淡入、不需淡出）
        }
      }
    )
  })

  // ── Tooltip 動態顯示設定區塊 ──
  const tooltipEl = tooltipRef.value
  const imgs = parentRef.value.querySelectorAll('.has-tooltip')

  imgs.forEach(img => {
    img.addEventListener('mouseenter', (e) => {
      const text = img.getAttribute('data-title') || ''
      if (!text) return

      tooltipEl.textContent = text

      // 直接把 left/top 設為游標座標（clientX, clientY）：
      gsap.set(tooltipEl, {
        left: e.clientX + 'px',
        top: e.clientY + 'px',
        scale: 0.8,
        opacity: 0  // 確保一開始是完全透明，讓下一行動畫帶出淡入效果
      })

      // 接著做「淡入+放大」動畫
      gsap.to(tooltipEl, {
        duration: 0.2,
        opacity: 1,
        scale: 1,
        ease: 'power2.out'
      })
    })

    img.addEventListener('mousemove', (e) => {
      // 滑鼠移動時，只更新 left/top，保持 opacity、scale
      gsap.set(tooltipEl, {
        left: e.clientX + 'px',
        top: e.clientY + 'px'
      })
    })

    img.addEventListener('mouseleave', () => {
      // 滑鼠離開時，淡出並縮小
      gsap.to(tooltipEl, {
        duration: 0.15,
        opacity: 0,
        scale: 0.8,
        ease: 'power2.in'
      })
    })
  })
  // ── Tooltip 區塊結束 ──
})
</script>