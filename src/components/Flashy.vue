<template>
  <div class="canvas-wrapper">
      <canvas id="canvas" width="1440" height="700"></canvas>   
      
      
    <div class="btnSet">
        <button @click="goFront">前台</button>
        <button @click="goAdmin">後台</button>
    </div>

    <div class="title">
      <p>TibaArt 緯藝</p>
      <br>
      <p>提拔你的藝術力</p>
    </div>

  

  </div>
</template>
<script setup scoped>
import { onMounted } from 'vue';


function doFirst() {
    let canvas = document.querySelector('#canvas')
    let context = canvas.getContext('2d')

    // 閃耀光束，logo置中

    context.strokeStyle = 'transparent';

    // 左上
    context.beginPath();
    context.moveTo(0, 0);
    context.lineTo(720, 350);
    context.lineTo(480, 0);
    context.fillStyle = '#DA5B27';
    context.fill();
    context.stroke();

    // 上中
    context.beginPath();
    context.moveTo(480, 0);
    context.lineTo(720, 350);
    context.lineTo(960, 0);
    context.fillStyle = '#153D52';
    context.fill();
    context.stroke();

    // 上右
    context.beginPath();
    context.moveTo(960, 0);
    context.lineTo(720, 350);
    context.lineTo(1440, 0);
    context.fillStyle = '#EAA525';
    context.fill();
    context.stroke();

    // 右中
    context.beginPath();
    context.moveTo(1440, 0);
    context.lineTo(720, 350);
    context.lineTo(1440, 700);
    context.fillStyle = '#2A7769';
    context.fill();
    context.stroke();

    // 右下
    context.beginPath();
    context.moveTo(1440, 700);
    context.lineTo(720, 350);
    context.lineTo(960, 700);
    context.fillStyle = '#DA5B27';
    context.fill();
    context.stroke();

    // 中下
    context.beginPath();
    context.moveTo(960, 700);
    context.lineTo(720, 350);
    context.lineTo(480, 700);
    context.fillStyle = '#153D52';
    context.fill();
    context.stroke();

    // 左下
    context.beginPath();
    context.moveTo(480, 700);
    context.lineTo(720, 350);
    context.lineTo(0, 700);
    context.fillStyle = '#EAA525';
    context.fill();
    context.stroke();

    // 左中
    context.beginPath();
    context.moveTo(0, 700);
    context.lineTo(720, 350);
    context.lineTo(0, 0);
    context.fillStyle = '#166065';
    context.fill();
    context.stroke();

    let pic = new Image()
    pic.src = '/src/assets/img/logo.png'
    pic.addEventListener('load', function () {
        context.drawImage(pic, 558, 189)
    })

    const colors = ['#DA5B27', '#153D52', '#EAA525', '#2A7769', '#DA5B27', '#153D52', '#EAA525', '#166065'];
    const highlightColor = 'white'; // 讓區塊閃動時變亮
    let currentIndex = 0;

    function drawBlocks() {
        const positions = [
            [[0, 0], [720, 350], [480, 0]],   // 左上
            [[480, 0], [720, 350], [960, 0]], // 上中
            [[960, 0], [720, 350], [1440, 0]], // 上右
            [[1440, 0], [720, 350], [1440, 700]], // 右中
            [[1440, 700], [720, 350], [960, 700]], // 右下
            [[960, 700], [720, 350], [480, 700]], // 中下
            [[480, 700], [720, 350], [0, 700]], // 左下
            [[0, 700], [720, 350], [0, 0]] // 左中
        ];

        context.clearRect(0, 0, canvas.width, canvas.height); // 清除畫布

        for (let i = 0; i < positions.length; i++) {
            context.beginPath();
            positions[i].forEach(([x, y]) => context.lineTo(x, y));
            context.fillStyle = (i === currentIndex) ? highlightColor : colors[i]; // 當前區塊變白
            context.fill();
            context.stroke();
        }
        context.drawImage(pic, 558, 189)
      currentIndex = (currentIndex + 1) % positions.length; // 移動到下一個區塊

    }

    setInterval(drawBlocks, 100); 

}
// window.addEventListener('load', doFirst)
onMounted(() => {
  doFirst();
});

import { useRouter } from 'vue-router'


const router = useRouter()

const goFront = () => {
  router.push('/front')
}
const goAdmin = () => {
  router.push('/admin')
}


</script>
<style lang="scss" scoped>
@import '/style.scss';


.canvas-wrapper {
  position: relative;
  z-index: 0; 
}

#canvas {
  display: block;
  position: absolute;
  width: 100vw;
  height: 100vh;
  
  top: 0;
  left: 0;
  right: 0;
  z-index: 0;
}

.title{
  z-index: 1;
  position: absolute;
  top:45vh;
  right:10vh;

    p{
    font-size: 32px;
    font-weight: bold;
    color: $logoBrown;
    text-align: right;

  }

}

.btnSet{
  margin: 0;
  display: flex; 
  justify-content: center; 
  align-items: center;
  flex-direction: column; 
  gap: 40px; 
  z-index: 1; 
  padding: 20px;
  box-sizing: border-box;

  position: absolute;
  top:25vh;
  left:10vh;



  button{

    display: block;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background-color: $logoYellow;
    color: $fontBlack;
    font-size: 32px;
    font-weight: bold;
    box-shadow: 0 4px 15px rgba(41, 120, 106, 0.3);;
    border: none;


    &:hover{
      cursor: pointer;
      background-color: $logoBlue;
      transform: scale(1.15);
      color: $logoOrange;  
    }
  

  }


}


</style>