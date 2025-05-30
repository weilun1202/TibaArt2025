<template>
<div class="canvas-wrapper">

    <canvas id="canvas" width="1440" height="700"></canvas>
    <div class="frontQ animate__animated animate__wobble">作品乏人問津？</div>
    <div class="frontA animate__animated animate__rotateIn">快點來找緯藝！</div>

    <div class="btnSet">
        <button class="toFront" @click="goFront">前台</button>
        <button class="toAdmin" @click="goAdmin">後台</button>
    </div>


</div>
</template>
<script setup scoped>
import { onMounted } from 'vue';



function doFirst() {
    let canvas = document.querySelector('#canvas')
    let context = canvas.getContext('2d')

    context.strokeStyle = 'transparent';


    let pic = new Image()
    pic.src = '/src/assets/img/logo.png'
    // pic.addEventListener('load', function () {
    //     context.drawImage(pic, 620, 50, 200, 199)
    // })


    let time = 0;
    let float = 15;
    let baseY = 50;

    function animate() {
        context.clearRect(625, 35, 200, 199 + float * 2);
        time += 0.03;
        let y = baseY + Math.sin(time) * float;


        context.drawImage(pic, 625, y, 200, 199);
        requestAnimationFrame(animate);
    }


    pic.onload = function () {
        requestAnimationFrame(animate);
    };




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


.canvas-wrapper{
    position: relative;
    width: 100vw;
    height: 100vh;
}

#canvas {
  display: block;
  width: 100vw;
  height: 100vh;
  z-index: 0; 
}

.frontQ,
.frontA {
    position: absolute;
    font-size: 40px;
    font-weight: bold;
    color: $logoBrown;
}



.frontQ{
    top:20%;
    left:20%;
}

.frontA{
    top:20%;
    right:20%;
}


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
    position: absolute;

    &:hover{
      cursor: pointer;
      background-color: $logoGreen;
      transform: scale(1.10);
      color: $logoYellow;  
    }
  
  }

  .toFront{
    top:50%;
    left:45%
  }
  .toAdmin{
    top:72%;
    left:45%
  }



</style>