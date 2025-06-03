<template>

<div class="frontHomeW">

     <div class="split-text-container">
            <h1 ref="splitTextElement" class="animated-heading">
            TibaArt 緯藝基金會
            </h1>
    </div>
    
     <transition name="fade" mode="out-in">
      <div :key="activeBlock" class="info">
        <p class="flip animate__animated animate__flipInX" v-if="activeBlock === 'painting1'"> {{ painting1 }}</p>
        <p class="flip animate__animated animate__flipInX" v-else-if="activeBlock === 'painting2'"> {{ painting2 }}</p>
        <p class="flip animate__animated animate__flipInX" v-else-if="activeBlock === 'painting3'"> {{ painting3 }}</p>
        <p class="flip animate__animated animate__flipInX" v-else-if="activeBlock === 'painting4'"> {{ painting4 }}</p>
        <p class="flip animate__animated animate__flipInX" v-else-if="activeBlock === 'painting5'"> {{ painting5}}</p>
        <p class="flip animate__animated animate__flipInX" v-else-if="activeBlock === 'painting6'"> 前往觀看{{ painting6}}</p>
        <p v-else>{{ defaultText }}</p>
      </div>
    </transition>

      <svg ref="svgRef" width="1000" height="600" viewBox="0 0 1000 600" xmlns="http://www.w3.org/2000/svg">

        <!-- 展館地板 -->
        <!-- <path d="M0 450 L1000 450 L1000 600 L0 600 Z" fill="#e8e8e8"/> -->
        
        <!-- 展館牆面 -->
        <!-- <path d="M0 0 L1000 0 L1000 450 L0 450 Z" fill="#ffffff"/> -->
        
        
        <g 
        class="paint paint2 painting2" 
        ref="paint2"
        >
        <!-- 中間垂直畫作框架 -->
        <rect x="320" y="150" width="80" height="120" fill="#f0e6d2" stroke="#d4c4a8" stroke-width="6"/>
        
        <!-- 中間垂直畫作內容 -->
        <!-- 深色背景 -->
        <path d="M326 156 L394 156 L394 264 L326 264 Z" fill="#4a4266"/>
        
        <!-- 綠色流線 -->
        <path d="M326 156 Q350 180 370 200 Q380 220 394 240 L394 156 Z" fill="#7fb069"/>
        
        <!-- 橙色區塊 -->
        <path d="M326 220 L394 220 L394 264 L326 264 Z" fill="#e55a4e"/>
        
        <!-- 藍色小圓 -->
        <circle cx="340" cy="170" r="8" fill="#6ba3d6"/>
      </g>

      <g 
      class="paint paint1 painting1" 
      ref="paint1"
      >

      <!-- 左側大型畫作框架 -->
      <rect x="50" y="80" width="220" height="180" fill="#f0e6d2" stroke="#d4c4a8" stroke-width="8"/>
      
      <!-- 左側大型畫作內容 -->
      <!-- 深紫色背景 -->
      <path d="M58 88 L262 88 L262 252 L58 252 Z" fill="#4a4266"/>
      
      <!-- 橙紅色圓形 -->
      <circle cx="120" cy="140" r="25" fill="#e55a4e"/>
      
      <!-- 藍色流線 -->
      <path d="M140 88 Q180 120 220 150 Q240 170 262 200 L262 88 Z" fill="#6ba3d6"/>
      
      <!-- 橙紅色區塊 -->
      <path d="M220 88 L262 88 L262 160 Q240 140 220 120 Z" fill="#e55a4e"/>
      
      <!-- 白色流線 -->
      <path d="M58 200 Q100 180 140 200 Q180 220 220 200 Q240 190 262 200 L262 252 L58 252 Z" fill="#f5f5f5"/>
      
      <!-- 深色圓弧 -->
      <path d="M80 120 Q120 100 160 120 Q180 130 200 140 Q180 160 160 180 Q120 200 80 180 Q60 160 60 140 Q60 130 80 120 Z" fill="#2d2d2d"/>
      </g>
      
        <g class="paint paint3" ref="paint3">
        <!-- 小型幾何畫作框架1 -->
        <rect x="450" y="120" width="70" height="70" fill="#f0e6d2" stroke="#d4c4a8" stroke-width="4"/>
        
        <!-- 小型幾何畫作內容1 -->
        <path d="M454 124 L516 124 L516 186 L454 186 Z" fill="#f5f5f5"/>
        <!-- 深藍色線條 -->
        <path d="M454 130 L470 124 L486 130 L502 124 L516 130" stroke="#2d2d2d" stroke-width="3" fill="none"/>
        <path d="M454 140 L470 134 L486 140 L502 134 L516 140" stroke="#2d2d2d" stroke-width="3" fill="none"/>
        <!-- 紅色小方塊 -->
        <rect x="458" y="150" width="12" height="6" fill="#e55a4e"/>
        <!-- 綠色小方塊 -->
        <rect x="480" y="155" width="12" height="6" fill="#7fb069"/>
        </g>

        <g class="paint paint4" ref="paint4">
        <!-- 小型畫作框架2 -->
        <rect x="540" y="120" width="60" height="90" fill="#f0e6d2" stroke="#d4c4a8" stroke-width="4"/>
        
        <!-- 小型畫作內容2 -->
        <path d="M544 124 L596 124 L596 206 L544 206 Z" fill="#f5f5f5"/>
        <!-- 深藍色垂直區塊 -->
        <rect x="544" y="124" width="20" height="82" fill="#4a4266"/>
        <!-- 橙色小圓 -->
        <circle cx="575" cy="140" r="6" fill="#e55a4e"/>
        </g>

        <g class="paint paint5" ref="paint5">
        <!-- 右側大型畫作框架 -->
        <rect x="680" y="100" width="280" height="200" fill="#f0e6d2" stroke="#d4c4a8" stroke-width="8"/>
        
        <!-- 右側大型畫作內容 -->
        <!-- 背景 -->
        <path d="M688 108 L952 108 L952 292 L688 292 Z" fill="#f5f5f5"/>
        
        <!-- 橙紅色流線區域 -->
        <path d="M688 108 Q720 140 750 160 Q780 180 820 190 Q850 200 880 190 Q920 180 952 200 L952 108 Z" fill="#e55a4e"/>
        
        <!-- 綠色區域 -->
        <path d="M820 108 L952 108 L952 200 Q920 180 880 190 Q850 200 820 190 Z" fill="#7fb069"/>
        
        <!-- 藍色流線 -->
        <path d="M688 200 Q720 180 750 200 Q780 220 820 210 Q850 200 880 210 Q920 220 952 200 L952 292 L688 292 Z" fill="#6ba3d6"/>
        
        <!-- 白色流線 -->
        <path d="M720 150 Q750 130 780 150 Q820 170 860 160 Q900 150 940 160 Q920 180 880 190 Q850 200 820 190 Q780 180 750 160 Q720 140 720 150 Z" fill="#ffffff"/>
        
        <!-- 深紫色圓形 -->
        <circle cx="900" cy="250" r="20" fill="#4a4266"/>
        
        <!-- 深紅色有機形狀 -->
        <path d="M750 220 Q780 210 800 230 Q820 250 800 270 Q780 280 760 270 Q740 250 750 220 Z" fill="#a64253"/>
        </g>

        <!-- 展館照明效果 -->
        <defs>
            <radialGradient id="lighting" cx="50%" cy="0%" r="50%">
                <stop offset="0%" style="stop-color:#ffffff;stop-opacity:0.3"/>
                <stop offset="100%" style="stop-color:#ffffff;stop-opacity:0"/>
            </radialGradient>
        </defs>
        
        <!-- 照明覆蓋層 -->
        <rect x="0" y="0" width="1000" height="450" fill="url(#lighting)"/>
        
        <!-- 地板反射效果 -->
        <defs>
            <linearGradient id="floor-reflection" x1="0%" y1="0%" x2="0%" y2="100%">
                <stop offset="0%" style="stop-color:#ffffff;stop-opacity:0.1"/>
                <stop offset="100%" style="stop-color:#cccccc;stop-opacity:0.05"/>
            </linearGradient>
        </defs>
        
        <rect x="0" y="450" width="1000" height="150" fill="url(#floor-reflection)"/>
        
        <!-- 互動區域覆蓋層 -->
        <!-- 左側大型畫作互動區 -->
        <rect id="artwork-1" x="50" y="80" width="220" height="180" 
              fill="transparent" 
              style="cursor: pointer; stroke: rgba(0,0,0,0); stroke-width: 3;"
              data-title="抽象流線畫作"
              @click="router.push('/front/sponsor')"
              @mouseenter="setActiveBlock('painting1')"
              @mouseleave="setActiveBlock('')"
        />
        
        <!-- 中間垂直畫作互動區 -->
        <rect id="artwork-2" x="320" y="150" width="80" height="120" 
              fill="transparent" 
              style="cursor: pointer; stroke: rgba(0,0,0,0); stroke-width: 3;"
              data-title="綠色流線作品"
              @click="router.push('/front/application')"
              @mouseenter="setActiveBlock('painting2')"
              @mouseleave="setActiveBlock('')"
        />
        
        <!-- 小型幾何畫作1互動區 -->
        <rect id="artwork-3" x="450" y="120" width="70" height="70" 
              fill="transparent" 
              style="cursor: pointer; stroke: rgba(0,0,0,0); stroke-width: 3;"
              data-title="幾何線條作品"
              @click="router.push('/front/about')"
              @mouseenter="setActiveBlock('painting3')"
              @mouseleave="setActiveBlock('')"
        />
        
        <!-- 小型畫作2互動區 -->
        <rect id="artwork-4" x="540" y="120" width="60" height="90" 
              fill="transparent" 
              style="cursor: pointer; stroke: rgba(0,0,0,0); stroke-width: 3;"
              data-title="藍色垂直構圖"
              @click="router.push('/front/memLogin')"
              @mouseenter="setActiveBlock('painting4')"
              @mouseleave="setActiveBlock('')"
        />
        
        <!-- 右側大型畫作互動區 -->
        <rect id="artwork-5" x="680" y="100" width="280" height="200" 
              fill="transparent" 
              style="cursor: pointer; stroke: rgba(0,0,0,0); stroke-width: 3;"
              data-title="現代抽象大作"
              @click="router.push('/front/shop')"
              @mouseenter="setActiveBlock('painting5')"
              @mouseleave="setActiveBlock('')"
        />

        <image class="thinker painting6 parallax-layer-6" 
              ref="paint6"
              style="cursor: pointer"
              href="/src/assets/img/thinker.svg" 
              width="240" height="240"
              @click="router.push('/front/expo')"
              @mouseenter="setActiveBlock('painting6')"
              @mouseleave="setActiveBlock('')"/>
              
              <!-- x="400" y="200"  -->
    </svg>

</div>
</template>

<script setup>
import router from '@/router';
import { ref, onMounted, onUnmounted } from 'vue'
import { gsap } from 'gsap'
import { SplitText } from 'gsap/SplitText'; 
import { ScrollTrigger } from 'gsap/ScrollTrigger';
gsap.registerPlugin(SplitText, ScrollTrigger);

const splitTextElement = ref(null);
let mySplitText;

const svgRef = ref(null)
const paint1 = ref(null)
const paint2 = ref(null)
const paint3 = ref(null)
const paint4 = ref(null)
const paint5 = ref(null)
const paint6 = ref(null)
const infoPanel = ref(null)
const parallaxBg = ref(null)
const contentSection = ref(null)

const activeBlock = ref('');
const defaultText = ref('點選下方作品，開始悠遊緯藝！');

const painting1 = '我要贊助藝術家';
const painting2 = '我要申請辦展';
const painting3 = '我想要更了解緯藝';
const painting4 = '我要前往會員中心';
const painting5 = '我要買藝術周邊';
const painting6 = '線上展覽';

const setActiveBlock = (blockName) => {
  activeBlock.value = blockName;
};

onMounted(() => {
  // 文字分割動畫
  if (splitTextElement.value) {
    mySplitText = new SplitText(splitTextElement.value, { type: 'chars' });
    gsap.from(mySplitText.chars, {
      opacity: 0,
      y: 20,
      rotationX: -245,
      transformOrigin: '50% 50% -20px',
      stagger: 0.2,
      duration: 1,
      ease: 'back.out(1.7)',
      delay: 0.5
    });
  }
    
  // 初始設定所有元素為「在畫面外」
  gsap.set([paint1.value, paint2.value], { x: -200, opacity: 0 })
  gsap.set([paint3.value], { y: 200, opacity: 0 })
  gsap.set([paint4.value], { y: -200, opacity: 0 })
  gsap.set([paint5.value], { x: 200, opacity: 0 })
  gsap.set(paint6.value, { x: window.innerWidth / 2, y: window.innerHeight / 4, opacity: 0, scale: 2 }); // 從視窗右下方開始


  // 順序滑入動畫
  gsap.timeline()
    .to(paint1.value, { x: 0, opacity: 1, duration: 0.75, ease: 'power3.out' })
    .to(paint2.value, { x: 0, opacity: 1, duration: 0.75, ease: 'circ.out' }, '0.5')
    .to(paint3.value, { y: 0, opacity: 1, duration: 0.75, ease: 'bounce.out' }, '0.7')
    .to(paint4.value, { y: 0, opacity: 1, duration: 0.75, ease: 'elastic.out(1, 0.3)' }, '1.2')
    .to(paint5.value, { x: 0, opacity: 1, duration: 0.75, ease: 'power3.out' }, '0.4')

    .to(paint6.value, { 
      x: 400,
      y: 240,
      opacity: 1, 
      scale: 1,
      duration: 1.5,
      ease: 'back.out(1.7)' 
    }, '1.4');
    

  // Hover 效果 for painting1 to painting5
  const paintings = [paint1.value, paint2.value, paint3.value, paint4.value, paint5.value];
  paintings.forEach((painting, index) => {
    const artwork = document.getElementById(`artwork-${index + 1}`);
    if (artwork && painting) {
      artwork.addEventListener('mouseenter', () => {
        gsap.to(painting, {
          scale: 1.2,
          duration: 0.3,
          ease: 'power2.out',
          transformOrigin: 'center center'
        });
      });
      artwork.addEventListener('mouseleave', () => {
        gsap.to(painting, {
          scale: 1,
          duration: 0.3,
          ease: 'power2.out',
          transformOrigin: 'center center'
        });
      });
    }
  });

  // Hover 效果 for painting6
  if (paint6.value) {
    paint6.value.addEventListener('mouseenter', () => {
      gsap.to(paint6.value, {
        scale: 1.2,
        rotation: 5, 
        filter: 'drop-shadow(0 0 10px rgba(255, 255, 0, 0.8)) drop-shadow(0 0 20px rgba(255, 255, 0, 0.6))',
        duration: 0.3,
        ease: 'power2.out',
        transformOrigin: 'center center'
      });
    });
    paint6.value.addEventListener('mouseleave', () => {
      gsap.to(paint6.value, {
        scale: 1,
        rotation: 0,
        filter: 'none',
        duration: 0.3,
        ease: 'power2.out',
        transformOrigin: 'center center'
      });
    });
  }

  // 左右視差效果設定
  setupHorizontalParallax();
})

const setupHorizontalParallax = () => {
  // 主標題左右視差效果
  gsap.to(splitTextElement.value, {
    ease: "none",
    scrollTrigger: {
      trigger: splitTextElement.value,
      start: "top bottom", 
      end: "bottom top",
      scrub: true
    }
  });

  // 信息面板向右移動
  gsap.to(infoPanel.value, {
    xPercent: 15,
    ease: "none",
    scrollTrigger: {
      trigger: infoPanel.value,
      start: "top bottom",
      end: "bottom top", 
      scrub: true
    }
  });

  // 左側畫作組 - 向右移動（快速）
  gsap.to([paint1.value, paint2.value], {
    xPercent: 30,
    rotation: 3,
    ease: "none",
    scrollTrigger: {
      trigger: svgRef.value,
      start: "top bottom",
      end: "bottom top",
      scrub: 1
    }
  });

  // 中間畫作 - 向左移動（中速）
  gsap.to([paint3.value, paint4.value], {
    xPercent: -20,
    scale: 1.05,
    rotation: -2,
    ease: "none",
    scrollTrigger: {
      trigger: svgRef.value,
      start: "top bottom",
      end: "bottom top",
      scrub: 1.5
    }
  });

  // 右側畫作 - 向左移動（慢速）
  gsap.to(paint5.value, {
    xPercent: -40,
    rotation: 2,
    ease: "none",
    scrollTrigger: {
      trigger: svgRef.value,
      start: "top bottom",
      end: "bottom top",
      scrub: 2
    }
  });

  // SVG 整體左右傾斜效果
  gsap.to(svgRef.value, {
    rotationZ: 2,
    xPercent: -10,
    ease: "none",
    scrollTrigger: {
      trigger: svgRef.value,
      start: "top center",
      end: "bottom center",
      scrub: 2
    }
  });

  // 背景層左右視差效果
  if (parallaxBg.value) {
    const bgLayers = parallaxBg.value.querySelectorAll('.bg-layer');
    bgLayers.forEach((layer, index) => {
      gsap.to(layer, {
        xPercent: -15 * (index + 1), // 每層不同的左右移動速度
        ease: "none",
        scrollTrigger: {
          trigger: parallaxBg.value,
          start: "top bottom",
          end: "bottom top",
          scrub: true
        }
      });
    });
  }

  // 內容區塊的左右交替進入
  if (contentSection.value) {
    const contentBlocks = contentSection.value.querySelectorAll('.content-block');
    contentBlocks.forEach((block, index) => {
      const direction = index % 2 === 0 ? -100 : 100; // 交替從左右進入
      
      gsap.fromTo(block, 
        {
          opacity: 0,
          x: direction,
          rotationY: direction > 0 ? -15 : 15
        },
        {
          opacity: 1,
          x: 0,
          rotationY: 0,
          duration: 1,
          ease: "power3.out",
          scrollTrigger: {
            trigger: block,
            start: "top 80%",
            end: "bottom 20%",
            toggleActions: "play none none reverse"
          }
        }
      );
      
      // 個別內容塊的左右視差效果
      gsap.to(block, {
        xPercent: index % 2 === 0 ? -10 : 10, // 交替左右移動
        ease: "none",
        scrollTrigger: {
          trigger: block,
          start: "top bottom",
          end: "bottom top",
          scrub: 2
        }
      });
    });
  }

  // 鼠標左右移動視差效果
  let mouseX = 0;

  const handleMouseMove = (e) => {
    mouseX = (e.clientX / window.innerWidth - 0.5) * 2;

    // SVG 左右跟隨鼠標
    gsap.to(svgRef.value, {
      rotationY: mouseX * 5,
      x: mouseX * 20,
      transformPerspective: 1000,
      duration: 1,
      ease: "power2.out"
    });

    // 左邊畫作向右跟隨
    gsap.to([paint1.value, paint2.value], {
      x: mouseX * 30,
      rotation: mouseX * 2,
      duration: 1.5,
      ease: "power2.out"
    });

    // 右邊畫作向左反向跟隨
    gsap.to([paint4.value, paint5.value], {
      x: -mouseX * 25,
      rotation: -mouseX * 1.5,
      duration: 1.2,
      ease: "power2.out"
    });

    // 中間畫作微妙跟隨
    gsap.to(paint3.value, {
      x: mouseX * 15,
      duration: 1.8,
      ease: "power2.out"
    });
  };

  document.addEventListener('mousemove', handleMouseMove);

  // 清理函數
  onUnmounted(() => {
    document.removeEventListener('mousemove', handleMouseMove);
  });

  // 滾動方向檢測的左右效果
  let lastScrollY = 0;
  
  const handleScroll = () => {
    const currentScrollY = window.scrollY;
    const scrollDirection = currentScrollY > lastScrollY ? 1 : -1;
    
    // 根據滾動方向調整左右移動
    gsap.to([paint1.value, paint3.value, paint5.value], {
      x: scrollDirection * 10,
      duration: 0.5,
      ease: "power2.out"
    });
    
    gsap.to([paint2.value, paint4.value], {
      x: -scrollDirection * 8,
      duration: 0.5, 
      ease: "power2.out"
    });
    
    lastScrollY = currentScrollY;
  };
  
  window.addEventListener('scroll', handleScroll);
  
  onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
  });
};

// 在組件銷毀時清除
onUnmounted(() => {
  if (mySplitText) {
    mySplitText.revert();
  }
  ScrollTrigger.getAll().forEach(trigger => trigger.kill());
});
</script>

<style lang="scss" scoped>
@import '/style.scss';

.frontHomeW{
    padding-top: 100px;
}

svg {
    width: 100vw;
    height: auto; 
    max-height: 90vh;
    pointer-events: all;
    display: block;
    margin: 0 auto;
    aspect-ratio: 5/5; 
  }

.infoPanel{

margin: 0 auto;
width: 50%;
border: 1.5px solid;
padding: 32px;
text-align: center;
}

.flip{
    font-weight: bold;
    color: $logoDGreen;
}

h1{
    font-size: 60px;
    font-weight: 450;
    text-align: center;
    color: $fontBlack;
    margin-bottom: 32px;  

  @media (max-width: 1000px){
    font-size: 48px;
  }

  @media (max-width: 820px){
    font-size: 40px;
  }

    @media (max-width: 420px){
    font-size: 36px;
  }
}

svg {
  display: block;
  margin: 0 auto;

  perspective: 1000px
}

.info{
    position: absolute; 
    top: 27%; 
    left: 50%; 
    transform: translate(-50%, -50%); 
    
    padding: 16px;
    width: 25%;
    border: 1.5px solid;
    text-align: center;
    background-color: rgba(255, 255, 255, 0.9); 
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    pointer-events: none; 
    z-index: 10;

    font-size: map-get($font, p); 


  @media (max-width: 1080px){
    width: 35%;
  }

  @media (max-width: 750px){
    width: 50%;
  }

    @media (max-width: 520px){
      width: 55%;
      font-size: map-get($font, pwar); 
  }

}

</style>
