<template>
  <div>
    <header>
      <div class="pageTitle">線上商城</div>
    </header>
    <div class="wrapper2">
      <!-- Wrapper 不設 1200px 寬（例如展覽、關於我們頁面應該會滿版），想要限制內容在 1200 的再自己包一個 div 限制 1200  -->
      <!-- 以下供大家編輯 -->
       
      <!-- 商店分類 -->
      <div class="shopTab">
        <div class="tabaShopTab" :class="{ active: activeTab === 'tiba' }" @click="setActiveTab('tiba')">
          <h1>緯藝周邊商品</h1>
        </div>
        <div class="artSohopTab" :class="{ active: activeTab === 'artist' }" @click="setActiveTab('artist')">
          <h1>藝術家原創商品</h1>
        </div>
        <div class="searchContainer">
          <form class="searchBar" @submit.prevent="searchItems">
            <input type="text" class="searchInput" v-model="searchQuery" placeholder="Search..." required>
            <button type="submit" class="searchButton">
              <font-awesome-icon :icon="['fas', 'magnifying-glass']" />
            </button>
          </form>
        </div>
      </div>

      <!-- 商品列表 -->
      <itemList :items="filteredItems" @add-to-cart="handleAddToCart" />
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';

import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
defineProps()

import { useRouter } from 'vue-router';
import itemList from '@/components/itemList.vue';

// 路由導航
const router = useRouter();

// 反應式狀態
const activeTab = ref('tiba');
const searchQuery = ref('');

// 商品數據
const items = ref([
  {
    id: 1,
    name: '緯藝馬克杯',
    price: 500,
    image: new URL('@/assets/img/itemMug.jpg', import.meta.url).href,
    category: 'tiba'
  },
  {
    id: 2,
    name: '緯藝帆布袋',
    price: 580,
    image: new URL('@/assets/img/itemBag.jpg', import.meta.url).href,
    category: 'tiba'
  },
  {
    id: 3,
    name: '緯藝杯墊',
    price: 490,
    image: new URL('@/assets/img/itemCoaster.jpg', import.meta.url).href,
    category: 'tiba'
  },
  {
    id: 4,
    name: '緯藝書籤',
    price: 200,
    image: new URL('@/assets/img/itemBookmark.jpg', import.meta.url).href,
    category: 'tiba'
  },
  // 藝術家原創商品範例
  {
    id: 5,
    name: '藝術家油畫',
    price: 3500,
    image: new URL('@/assets/img/itemMug.jpg', import.meta.url).href, // 使用臨時圖片，實際應該替換
    category: 'artist'
  },
  {
    id: 6,
    name: '藝術家雕塑',
    price: 4800,
    image: new URL('@/assets/img/itemBag.jpg', import.meta.url).href, // 使用臨時圖片，實際應該替換
    category: 'artist'
  }
]);

// 計算屬性
const filteredItems = computed(() => {
  return items.value
    .filter(item => item.category === activeTab.value)
    .filter(item => {
      if (!searchQuery.value) return true;
      return item.name.toLowerCase().includes(searchQuery.value.toLowerCase());
    });
});

// 方法
const setActiveTab = (tab) => {
  activeTab.value = tab;
};

const searchItems = () => {
  // 搜尋功能已經透過 computed property 實現
  console.log('搜尋:', searchQuery.value);
};

const handleAddToCart = (item) => {
  // 處理從子組件傳來的加入購物車事件
  console.log('加入購物車:', item);
  // 可以在這裡實現將商品加入購物車的邏輯
  // 例如使用 Vuex Store 或其他狀態管理方式
  alert(`已將「${item.name}」加入購物車`);
};
</script>
