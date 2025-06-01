<template>

<div class="frontHomeW">

     <!-- <div class="infoPanel animate__animated animate__flipInX">
        <p>TibaArt 緯藝基金會</p>
    </div> -->
    
     <transition name="fade" mode="out-in">
      <div :key="activeBlock" class="info">
        <p class="animate__animated animate__flipInX" v-if="activeBlock === 'painting1'"> {{ painting1 }}</p>
        <p class="animate__animated animate__flipInX" v-else-if="activeBlock === 'painting2'"> {{ painting2 }}</p>
        <p class="animate__animated animate__flipInX" v-else-if="activeBlock === 'painting3'"> {{ painting3 }}</p>
        <p class="animate__animated animate__flipInX" v-else-if="activeBlock === 'painting4'"> {{ painting4 }}</p>
        <p class="animate__animated animate__flipInX" v-else-if="activeBlock === 'painting5'"> {{ painting5}}</p>
        <p class="animate__animated animate__flipInX" v-else-if="activeBlock === 'painting6'"> 前往觀看{{ painting6}}</p>
        <p v-else>{{ defaultText }}</p>
      </div>
    </transition>

        <div class="split-text-container">
            <h1 ref="splitTextElement" class="animated-heading">
            TibaArt 緯藝基金會
            </h1>
        </div>

      <svg ref="svgRef" width="1000" height="600" viewBox="0 0 1000 600" xmlns="http://www.w3.org/2000/svg">

        <!-- 展館地板 -->
        <!-- <path d="M0 450 L1000 450 L1000 600 L0 600 Z" fill="#e8e8e8"/> -->
        
        <!-- 展館牆面 -->
        <!-- <path d="M0 0 L1000 0 L1000 450 L0 450 Z" fill="#ffffff"/> -->
        
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

          <image class="thinker painting6" 
          ref="paint6"
          style="cursor: pointer"
          href="/src/assets/img/thinker.svg" 
          x="400" y="200" 
          width="240" height="240"
          @click="router.push('/front/expo')"
          @mouseenter="setActiveBlock('painting6')"
          @mouseleave="setActiveBlock('')"
        />

    </svg>

</div>
</template>

<script setup>
import router from '@/router';
import { ref, onMounted, onUnmounted } from 'vue'
import { gsap } from 'gsap'
import { SplitText } from 'gsap/SplitText'; 
gsap.registerPlugin(SplitText);

const splitTextElement = ref(null); // 用於引用要分割的文字元素
let mySplitText; // 儲存 SplitText 實例，以便在組件銷毀時 revert


const svgRef = ref(null)
const paint1 = ref(null)
const paint2 = ref(null)
const paint3 = ref(null)
const paint4 = ref(null)
const paint5 = ref(null)
const paint6 = ref(null)


const activeBlock = ref(''); // 用於儲存當前滑鼠懸停的畫框名稱
const defaultText = ref('點選下方作品，開始悠遊緯藝！'); // 預設顯示的文字

// 定義每個畫框對應的文字內容
// 這裡可以直接定義為 ref 物件，或者更簡潔的直接使用 JavaScript 物件
const painting1 = '我要贊助藝術家';
const painting2 = '我要申請辦展';
const painting3 = '我想要更了解緯藝';
const painting4 = '我要前往會員中心';
const painting5 = '我要買藝術周邊';
const painting6 = '線上展覽';

const setActiveBlock = (blockName) => {
  console.log('Mouse event triggered for:', blockName);
  activeBlock.value = blockName;
};

const animatedText = ref(null);


onMounted(() => {

if (splitTextElement.value) {
    // 創建 SplitText 實例
    // type: 'chars' 將文字分割成單個字元
    // type: 'words' 將文字分割成單詞
    // type: 'lines' 將文字分割成行
    // 你也可以組合使用，例如 'chars,words'
    mySplitText = new SplitText(splitTextElement.value, { type: 'chars' });

    // 對每個字元進行動畫
    gsap.from(mySplitText.chars, {
      opacity: 0,
      y: 20, // 初始位置從下方 20px 處
      rotationX: -245, // 初始旋轉
      transformOrigin: '50% 50% -20px', // 設置旋轉中心，製造從深處飛出的效果
      stagger: 0.2, // 每個字元之間動畫延遲 0.05 秒
      duration: 1, // 每個字元動畫持續時間 0.8 秒
      ease: 'back.out(1.7)', // 緩動效果
      delay: 0.5 // 整體動畫延遲 0.5 秒開始
    });
  }
    
  // 初始設定所有元素為「在畫面外」，例如往左滑入
  gsap.set([paint1.value, paint2.value], { x: -200, opacity: 0 })
  gsap.set([paint3.value], { y: 200, opacity: 0 })
  gsap.set([paint4.value], { y: -200, opacity: 0 })
  gsap.set([paint5.value], { x: 200, opacity: 0 })
//   gsap.set([paint6.value], { x: 200, opacity: 0 })


    // 順序滑入
  gsap.timeline()
    .to(paint1.value, { x: 0, opacity: 1, duration: 0.75, ease: 'power3.out' }, )
      .to(paint2.value, { x: 0, opacity: 1, duration: 0.75, ease: 'circ.out' }, '+=0.05')
      .to(paint3.value, { y: 0, opacity: 1, duration: 0.75, ease: 'bounce.out' }, '+=0.05')
      .to(paint4.value, { y: 0, opacity: 1, duration: 0.75, ease: 'elastic.out(1, 0.3)' }, '+=0.05')
      .to(paint5.value, { x: 0, opacity: 1, duration: 0.75, ease: 'power3.out' }, '0.05')
    //   .to(paint6.value, { x: 0, opacity: 1, duration: 0.75, ease: 'power3.out' }, '+=0.5')

    gsap.timeline()
    .fromTo(".painting6", 
        { scale: 2, x: 800, y: 200, z: 0 }, 
        { scale: 1, x: 0, y: 0, z: 500, duration: 1, ease: "circ.out" }, '+=1'
    );
    
})

// 在組件銷毀時清除 SplitText 的修改，避免污染 DOM
onUnmounted(() => {
  if (mySplitText) {
    mySplitText.revert(); // 將文字恢復到原始狀態
  }
});


</script>

<style lang="scss" scoped>
@import '/style.scss';
@import url('https://fonts.googleapis.com/css2?family=Chocolate+Classical+Sans&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');

.frontHomeW{
    padding-top: 36px;
}

svg {
    width: 100vw;
    height: 100vh;
    pointer-events: all;
}


.infoPanel{

margin: 0 auto;
width: 50%;
border: 1.5px solid;
padding: 32px;
text-align: center;

}

h1{
    font-size: 60px;
    font-weight: 450;
    text-align: center;
    color: $fontBlack;
    margin-top: 32px;
    font-family: 'Chocolate Classical Sans';
}


svg {
  display: block;
  margin: 0 auto;

  perspective: 1000px
}

// .paint {
//   opacity: 0;
//   transform: translateY(50px);
//   transition: all 0.8s ease;
// }

// .paint.enter {
//   opacity: 1;
//   transform: translateY(0);
// }



#artwork-1:hover, 
#artwork-2:hover, 
#artwork-3:hover, 
#artwork-4:hover, 
#artwork-5:hover{
    fill: rgb(255, 255, 255, 0.5);
}

image{
    // transform-style: preserve-3d;
    transform-origin: center center;
}

image:hover{
    transform: scale(1.5) rotate(15deg);
}


.info{
    margin: 12px auto 0;
    padding: 32px;
    width: 25%;
    border:1.5px solid;
    text-align: center;
}


</style>
