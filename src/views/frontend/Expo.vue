<template>
  <div class="expo">
    <div class="wrapper">
        <header class="animate__animated animate__flipInX">
          <div class="pageTitle">線上展覽</div>
        </header>
  <div class="parent">
    <router-link
      v-for="item in expoItems"
      :key="item.id"
      :to="item.to"
      :class="`grid ${item.className} ${item.side}`"
    >
      <img :src="item.img" alt="" />
    </router-link>
  </div>
    </div>
  </div>
</template>
<script setup>
import { ScrollTrigger } from 'gsap/ScrollTrigger'
import { ref } from 'vue'

// 1. 定義一個陣列，把原本寫死的每一筆 router-link，拆成「圖片路徑」、「class 名稱」、「left/right」等欄位
const expoItems = ref([
  {
    id: 1,
    to: '/front/ExpoArea',
    className: 'div1',
    side: 'left',
    img: import.meta.env.BASE_URL + '/assets/img/expo1.jpg'
  },
  {
    id: 2,
    to: '/front/ExpoArea',
    className: 'div2',
    side: 'right',
    img: import.meta.env.BASE_URL + '/assets/img/expo2.jpg'
  },
  {
    id: 3,
    to: '/front/ExpoArea',
    className: 'div3',
    side: 'right',
    img: import.meta.env.BASE_URL + '/assets/img/expo3.jpg'
  },
  {
    id: 4,
    to: '/front/ExpoArea',
    className: 'div4',
    side: 'left',
    img: import.meta.env.BASE_URL + '/assets/img/expo4.jpg'
  },
  {
    id: 5,
    to: '/front/ExpoArea',
    className: 'div5',
    side: 'left',
    img: import.meta.env.BASE_URL + '/assets/img/expo5.jpg'
  },
  {
    id: 6,
    to: '/front/ExpoArea',
    className: 'div6',
    side: 'right',
    img: import.meta.env.BASE_URL + '/assets/img/expo6.jpg'
  },
  {
    id: 7,
    to: '/front/ExpoArea',
    className: 'div7',
    side: 'right',
    img: import.meta.env.BASE_URL + '/assets/img/expo7.jpg'
  },
  {
    id: 8,
    to: '/front/ExpoArea',
    className: 'div8',
    side: 'left',
    img: import.meta.env.BASE_URL + '/assets/img/expo8.jpg'
  },
  {
    id: 9,
    to: '/front/ExpoArea',
    className: 'div9',
    side: 'left',
    img: import.meta.env.BASE_URL + '/assets/img/expo9.jpg'
  },
  {
    id: 10,
    to: '/front/ExpoArea',
    className: 'div10',
    side: 'right',
    img: import.meta.env.BASE_URL + '/assets/img/expo10.jpg'
  },
  {
    id: 11,
    to: '/front/ExpoArea',
    className: 'div11',
    side: 'right',
    img: import.meta.env.BASE_URL + '/assets/img/expo11.jpg'
  },
  {
    id: 12,
    to: '/front/ExpoArea',
    className: 'div12',
    side: 'left',
    img: import.meta.env.BASE_URL + '/assets/img/expo12.jpg'
  },
  {
    id: 13,
    to: '/front/ExpoArea',
    className: 'div13',
    side: 'left',
    img: import.meta.env.BASE_URL + '/assets/img/expo13.jpg'
  },
  {
    id: 14,
    to: '/front/ExpoArea',
    className: 'div14',
    side: 'right',
    img: import.meta.env.BASE_URL + '/assets/img/expo14.jpg'
  },
  {
    id: 15,
    to: '/front/ExpoArea',
    className: 'div15',
    side: 'right',
    img: import.meta.env.BASE_URL + '/assets/img/expo15.jpg'
  },
  {
    id: 16,
    to: '/front/ExpoArea',
    className: 'div16',
    side: 'left',
    img: import.meta.env.BASE_URL + '/assets/img/expo16.jpg'
  },
  {
    id: 17,
    to: '/front/ExpoArea',
    className: 'div17',
    side: 'left',
    img: import.meta.env.BASE_URL + '/assets/img/expo17.jpg'
  },
  {
    id: 18,
    to: '/front/ExpoArea',
    className: 'div18',
    side: 'right',
    img: import.meta.env.BASE_URL + '/assets/img/expo18.jpg'
  },
  {
    id: 19,
    to: '/front/ExpoArea',
    className: 'div19',
    side: 'right',
    img: import.meta.env.BASE_URL + '/assets/img/expo19.jpg'
  }
])
</script>