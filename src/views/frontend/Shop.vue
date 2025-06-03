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
        <div class="shopTab" v-if="!searchQuery">
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
          <li class="item"
                v-for="item in filterItems" 
                :key="item.id">
            <router-link :to="{name: 'product', params: {id: item.id}}" class="itemImage">
              <img :src="baseUrl + item.image" :alt="item.name">
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

    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed, nextTick } from 'vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { useRouter } from 'vue-router';
import {useCart} from '@/stores/cart.js';

const router = useRouter();
const baseUrl = import.meta.env.BASE_URL;


const activeTab = ref('tiba');
const searchQuery = ref('');
const isSearchInputExpanded = ref(false);
const searchInput = ref(null); // 用於獲取 input 元素的引用

const {addToCart} = useCart();
const items = ref([]);

// 載入商品資料
onMounted(() => {
  fetch(import.meta.env.BASE_URL + 'productData.json')
    .then(resp => resp.json())
    .then(jsonData => {
      // console.log(jsonData)
      items.value = jsonData;
  })
  .catch(error => {
    console.error('載入商品資料失敗:', error);
  });
});

// 計算該顯示在哪個頁籤
// const filterItems = computed(() => {
//   return items.value
//     .filter(item => item.category == activeTab.value)
//     .filter(item => {
//       if (!searchQuery.value) return true;
//       return item.name.toLowerCase().includes(searchQuery.value.toLowerCase());
//     });
// });

const filterItems = computed(() => {
  // 如果有搜尋關鍵字，搜尋所有商品的 name
  if (searchQuery.value) {
    return items.value.filter(item =>
      item.name.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
  }
  // 否則按 activeTab 過濾
  return items.value.filter(item => item.category === activeTab.value);
});

const setActiveTab = (tab) => {
  activeTab.value = tab;
};

const searchItems = () => {
  console.log('搜尋:', SearchQuery.value);
  isSearchInputExpanded.value = false;  // 搜尋後收起輸入框
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
  }
};

const handleAddToCart = (item) => {
  // 處理從子組件傳來的加入購物車事件
  const success = addToCart(item);
  if(success) {
    alert(`已將「${item.name}」加入購物車`);
  }
};
</script>