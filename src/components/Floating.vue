<template>
<div class="canvas-wrapper">
    <canvas id="canvas" ref="canvasRef"></canvas>
      <div class="frontQ animate__animated animate__wobble">作品乏人問津？</div>
      <div class="frontA animate__animated animate__rotateIn">快點來找緯藝！</div>

    <div class="btnSet">
        <button class="toFront" @click="goFront">前台</button>
        <button class="toAdmin" @click="goAdmin">後台</button>
    </div>
</div>
</template>

<script setup scoped>
import { onMounted, ref, onUnmounted } from 'vue';

const canvasRef = ref(null);
let animationId = null;

// 基準尺寸 (設計稿尺寸)
const BASE_WIDTH = 1440;
const BASE_HEIGHT = 700;

function setupCanvas() {
    const canvas = canvasRef.value;
    if (!canvas) return;
    
    const context = canvas.getContext('2d');
    
    // 獲取容器尺寸
    const container = canvas.parentElement;
    const containerWidth = container.clientWidth;
    const containerHeight = container.clientHeight;
    
    // 設定 Canvas 實際尺寸
    canvas.width = containerWidth;
    canvas.height = containerHeight;
    
    // 計算縮放比例
    const scaleX = containerWidth / BASE_WIDTH;
    const scaleY = containerHeight / BASE_HEIGHT;
    const scale = Math.min(scaleX, scaleY); // 等比例縮放
    
    // 計算置中偏移
    const offsetX = (containerWidth - BASE_WIDTH * scale) / 2;
    const offsetY = (containerHeight - BASE_HEIGHT * scale) / 2;
    
    // 應用變換
    context.setTransform(scale, 0, 0, scale, offsetX, offsetY);
    
    return { context, scale, offsetX, offsetY };
}

function drawStaticElements(context) {
    context.strokeStyle = 'transparent';
    
    // 山
    context.beginPath();
    context.moveTo(480, 700);
    context.lineTo(700, 200);
    context.lineTo(715, 340);
    context.lineTo(725, 260);
    context.lineTo(740, 320);
    context.lineTo(755, 210);
    context.lineTo(960, 700);
    context.fillStyle = '#153D52';
    context.fill();
    context.stroke();

    // 黃三角左上
    context.beginPath();
    context.moveTo(275, 300);
    context.lineTo(400, 365);
    context.lineTo(250, 350);
    context.lineTo(275, 300);
    context.fillStyle = '#EAA525';
    context.fill();
    context.stroke();

    // 黃三角左下
    context.beginPath();
    context.moveTo(275, 480);
    context.lineTo(400, 415);
    context.lineTo(250, 430);
    context.lineTo(275, 480);
    context.fillStyle = '#EAA525';
    context.fill();
    context.stroke();

    // 黃三角右上
    context.beginPath();
    context.moveTo(1165, 300);
    context.lineTo(1040, 365);
    context.lineTo(1190, 350);
    context.lineTo(1165, 300);
    context.fillStyle = '#EAA525';
    context.fill();
    context.stroke();

    // 黃三角右下
    context.beginPath();
    context.moveTo(1165, 480);
    context.lineTo(1040, 415);
    context.lineTo(1190, 430);
    context.lineTo(1165, 480);
    context.fillStyle = '#EAA525';
    context.fill();
    context.stroke();
}

function startAnimation() {
    const setupResult = setupCanvas();
    if (!setupResult) return;
    
    const { context } = setupResult;
    
    // 載入圖片
    const pic = new Image();
    pic.src = '/src/assets/img/logo.png';
    
    let time = 0;
    const float = 15;
    const baseY = 50;
    const baseX = 625;
    const imgWidth = 200;
    const imgHeight = 199;
    
    function animate() {
        // 重新設定 canvas (處理視窗大小改變)
        const currentSetup = setupCanvas();
        if (!currentSetup) return;
        
        const { context } = currentSetup;
        
        // 清除整個 canvas
        context.save();
        context.setTransform(1, 0, 0, 1, 0, 0);
        context.clearRect(0, 0, canvasRef.value.width, canvasRef.value.height);
        context.restore();
        
        // 重繪靜態元素
        drawStaticElements(context);
        
        // 動畫邏輯
        time += 0.05;
        const y = baseY + Math.sin(time) * float;
        
        // 繪製浮動的 logo
        if (pic.complete) {
            context.drawImage(pic, baseX, y, imgWidth, imgHeight);
        }
        
        animationId = requestAnimationFrame(animate);
    }
    
    pic.onload = function() {
        animate();
    };
    
    // 如果圖片已經載入完成
    if (pic.complete) {
        animate();
    }
}

function handleResize() {
    // 重新開始動畫以適應新尺寸
    if (animationId) {
        cancelAnimationFrame(animationId);
    }
    startAnimation();
}

onMounted(() => {
    startAnimation();
    window.addEventListener('resize', handleResize);
});

onUnmounted(() => {
    if (animationId) {
        cancelAnimationFrame(animationId);
    }
    window.removeEventListener('resize', handleResize);
});

import { useRouter } from 'vue-router'

const router = useRouter()

const goFront = () => {
    router.push('/front')
}
const goAdmin = () => {
  router.push('/admin/login')
}
</script>

<style lang="scss" scoped>
@import '/style.scss';

.canvas-wrapper {
    position: relative;
    width: 100vw;
    height: 100vh;
    overflow: hidden;
}

#canvas {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
    display: block;
}

.frontQ,
.frontA {
    position: absolute;
    font-size: clamp(24px, 4vw, 40px); // 響應式字體
    font-weight: bold;
    color: $logoBrown;
    z-index: 1;
}

.frontQ {
    top: 20%;
    left: 20%;
}

.frontA {
    top: 20%;
    right: 20%;
}

.btnSet {
    position: absolute;
    top: 55%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: flex;
    gap: 20px;
    z-index: 1;
}

button {
    display: block;
    width: clamp(80px, 10vw, 120px); // 響應式按鈕尺寸
    height: clamp(80px, 10vw, 120px);
    border-radius: 50%;
    background-color: $logoYellow;
    color: $fontBlack;
    font-size: clamp(20px, 2.5vw, 32px); // 響應式字體
    font-weight: bold;
    box-shadow: 0 4px 15px rgba(41, 120, 106, 0.3);
    border: none;
    transition: all 0.3s ease;

    &:hover {
        cursor: pointer;
        background-color: $logoGreen;
        transform: scale(1.05);
        color: $logoYellow;
    }
}

@media (max-width: 1280px) {
    
    .frontQ {
        top: 10%;
        left: 10%;
    }
    
    .frontA {
        top: 10%;
        right: 10%;
    }
  }


// 手機版樣式調整
@media (max-width: 768px) {

    .frontQ,
    .frontA {
        font-size: 24px;
    }
    
    .frontQ {
        top: 15%;
        left: 10%;
    }
    
    .frontA {
        top: 20%;
        right: 10%;
    }
    
    .btnSet {
        // flex-direction: column;
        gap: 15px;

        top: 50%;
        left: 50%;
    }
    
    button {
        width: 80px;
        height: 80px;
        font-size: 20px;
    }
}



@media (max-width: 500px) {

  .btnSet {
        gap: 15px;

        top: 30%;
        left: 50%;
    }



}
</style>