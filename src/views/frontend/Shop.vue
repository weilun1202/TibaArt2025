<template>
  <div>
    <div class="wrapper">
      <header class="animate__animated animate__flipInX">
        <div class="pageTitle">線上商城</div>
      </header>
      <!-- Wrapper 不設 1200px 寬（例如展覽、關於我們頁面應該會滿版），想要限制內容在 1200 的再自己包一個 div 限制 1200  -->
      <!-- 以下供大家編輯 -->

      <div class="wrap">
        <!-- 商店分類 -->
        <div class="shopTab animate__animated animate__fadeIn animate__slow" v-if="!searchQuery">
          <div class="tibaShopTab" :class="{ active: activeTab == 'tiba' }" @click="setActiveTab('tiba')">
            <h1>緯藝周邊</h1>
          </div>
          <div class="artShopTab" :class="{ active: activeTab == 'artist' }" @click="setActiveTab('artist')">
            <h1>藝術家原創</h1>
          </div>
          <div class="searchContainer">
            <div class="searchBar" @submit.prevent="searchItems">
              <input id="searchInput" name="searchInput" type="text" class="searchInput" :class="{ 'expanded': isSearchInputExpanded }"
                v-model="searchQuery" placeholder="Search..." required>
              <button type="button" class="searchButton" @click="toggleSearchInput">
                <font-awesome-icon :icon="['fas', 'magnifying-glass']" />
              </button>
            </div>
          </div>
        </div>

        <div class="shopTab" v-if="searchQuery">
        <!-- 搜尋結果才顯示 -->
          <div class="tibaShopTab">
            <h1>搜尋結果</h1>
          </div>
          <div class="searchContainer">
            <div class="searchBar" @submit.prevent="searchItems">
              <input id="searchInput" name="searchInput" type="text" class="searchInput" :class="{ 'expanded': isSearchInputExpanded }"
                v-model="searchQuery" placeholder="Search..." required>
              <button type="button" class="searchButton" @click="toggleSearchInput">
                <font-awesome-icon :icon="['fas', 'magnifying-glass']" />
              </button>
            </div>
          </div>
        </div>

        <!-- 商品列表 -->
        <ul class="itemList">
          <li class="item scroll-trigger-item"
                v-for="item in filterItems" 
                :key="item.id">
            <router-link :to="{name: 'product', params: {id: item.id}}" class="itemImage">
              <img :src="baseUrl + item.image" :alt="item.name">
              <!-- <img :src="item.image" :alt="item.name"> -->
            </router-link>
            
            <div class="itemInfo">
              <div class="itemDetails">
                <div class="itemName">{{ item.name }}</div>
                <div class="itemPrice">NT$ {{ item.price }}</div>
              </div>

              <div class="itemActions">
                <button type="button" class="btn" @click="handleAddToCart(item)">加入購物車</button>
              </div>
            </div>
          </li>
        </ul>

      </div>

      <div>
        <CartPopup
          :item="itemInPopup"
          :show="showCartPopup"
          :quantity="quantityInPopup"
          @close="showCartPopup = false"
        />
      </div>

    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed, nextTick } from 'vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { useRouter } from 'vue-router';
import { useCart } from '@/stores/cart.js';
import { useUserStore } from '@/stores/user';
import { gsap } from 'gsap'; 
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import CartPopup from '@/components/CartPopup.vue';

const router = useRouter();
// const baseUrl = import.meta.env.BASE_URL;
const baseUrl = import.meta.env.VITE_showUploadImage;

// ScrollTrigger 插件
gsap.registerPlugin(ScrollTrigger)

const activeTab = ref('tiba');
const searchQuery = ref('');
const isSearchInputExpanded = ref(false);
const searchInput = ref(null); // 用於獲取 input 元素的引用

const {addToCart} = useCart();
const items = ref([]);

// 載入商品資料
onMounted(() => {
  fetch(import.meta.env.VITE_Product)
    .then(resp => resp.json())
    .then(jsonData => {
      // console.log(jsonData)
      items.value = jsonData;
      nextTick(() => {
        initScrollTriggerAnimations();
      });
  })
  .catch(error => {
    console.error('載入商品資料失敗:', error);
  });
});

const filterItems = computed(() => {
  const filtered = items.value.filter(item => {
    if (searchQuery.value) {
      return item.name.toLowerCase().includes(searchQuery.value.toLowerCase());
    }
    return item.category === activeTab.value;
  });

  // filterItems 改變時，清除舊的 ScrollTrigger 重新初始化
  nextTick(() => {
    ScrollTrigger.getAll().forEach(trigger => trigger.kill()); // 殺掉所有現有的 ScrollTrigger
    initScrollTriggerAnimations();
  });

  return filtered;
});

const setActiveTab = (tab) => {
  activeTab.value = tab;

  // tab 改變時，重新初始化 ScrollTrigger
  nextTick(() => {
    ScrollTrigger.getAll().forEach(trigger => trigger.kill());
    initScrollTriggerAnimations();
  });
};

const searchItems = () => {
  console.log('搜尋:', searchQuery.value);
  isSearchInputExpanded.value = false;  // 搜尋後收起輸入框

  nextTick(() => {
    ScrollTrigger.getAll().forEach(trigger => trigger.kill());
    initScrollTriggerAnimations();
  });
};

const toggleSearchInput = () => {
  isSearchInputExpanded.value = !isSearchInputExpanded.value;
  // 當輸入框展開時，使其獲得焦點
  if (isSearchInputExpanded.value) {
    nextTick(() => {
      if (searchInput.value) {
        searchInput.value.focus();
      }
    });
  } else {
    // 當收起輸入框時，清除目前的輸入內容
    // 但不觸發實際的搜尋
    searchQuery.value = '';
    nextTick(() => {
      ScrollTrigger.getAll().forEach(trigger => trigger.kill());
      initScrollTriggerAnimations();
    });
  }
};

// 初始化 ScrollTrigger 動畫的函式
const initScrollTriggerAnimations = () => {
  const itemsToAnimate = document.querySelectorAll('.scroll-trigger-item');

  itemsToAnimate.forEach((item, index) => {
    gsap.fromTo(item,
      { opacity: 0, y: 50 }, // 開始動畫
      {
        opacity: 1, // 動畫到這裡
        y: 0,
        duration: 0.8, 
        ease: "power2.out", 
        scrollTrigger: {
          trigger: item, 
          start: "top 85%", //觸發點
          toggleActions: "play none none none", // 滾入時播放，滾出時不動作
        }
      }
    );
  });
};


// 彈窗
const showCartPopup = ref(false); 
const itemInPopup = ref(null); 
const quantityInPopup = ref(1); 

const userStore = useUserStore()
const props = defineProps({
  product: Object
})

const handleAddToCart = async (item) => {
  if (!userStore.requireLogin()) {
    alert('請先登入會員')
    router.push({
      path: '/front/memLogin',
      query: { redirect: router.currentRoute.value.fullPath } // 記錄當前頁面完整路徑
    });
    return
    
  } else {
    
      try {
        await new Promise(resolve => requestAnimationFrame(resolve));
        const success = addToCart(item);
        if (success) {
          // alert(`已將「${item.name}」加入購物車`);
          itemInPopup.value = item; // 設定要顯示的商品
          showCartPopup.value = true; // 顯示彈窗
        }
      } catch (error) {
        console.error('加入購物車失敗:', error);
      }
  }
};
</script>