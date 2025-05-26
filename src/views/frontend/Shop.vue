<template>
  <div>
    <div class="wrapper">
      <header>
        <div class="pageTitle">線上商城</div>
      </header>
      <!-- Wrapper 不設 1200px 寬（例如展覽、關於我們頁面應該會滿版），想要限制內容在 1200 的再自己包一個 div 限制 1200  -->
      <!-- 以下供大家編輯 -->

      <div class="wrap">
        <!-- 商店分類 -->
        <div class="shopTab">
          <div class="tibaShopTab" :class="{ active: activeTab == 'tiba' }" @click="setActiveTab('tiba')">
            <h1>緯藝周邊</h1>
          </div>
          <div class="artShopTab" :class="{ active: activeTab == 'artist' }" @click="setActiveTab('artist')">
            <h1>藝術家原創</h1>
          </div>
          <div class="searchContainer">
            <form class="searchBar" @submit.prevent="searchItems">
              <input type="text" class="searchInput" :class="{ 'expanded': isSearchInputExpanded }"
                v-model="searchQuery" placeholder="Search..." required>
              <button type="button" class="searchButton" @click="toggleSearchInput">
                <font-awesome-icon :icon="['fas', 'magnifying-glass']" />
              </button>
            </form>
          </div>
        </div>

        <!-- 商品列表 -->
        <itemList :items="filteredItems" @add-to-cart="AddToCart" />

      </div>

    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch, nextTick } from 'vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { useRouter } from 'vue-router';
import itemList from '@/components/itemList.vue';

// 路由導航
const router = useRouter();

// 反應式狀態
const activeTab = ref('tiba');
const searchQuery = ref('');
const actualSearchQuery = ref(''); // 實際用於過濾的查詢詞，只有在點擊搜尋後更新
const isSearchInputExpanded = ref(false);
const searchInput = ref(null); // 用於獲取 input 元素的引用

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
    image: new URL('@/assets/img/itemPainting.jpg', import.meta.url).href, 
    category: 'artist'
  },
  {
    id: 6,
    name: '藝術家雕塑',
    price: 18000,
    image: new URL('@/assets/img/itemSculpture.jpg', import.meta.url).href,
    category: 'artist'
  }
]);

// 計算屬性
const filteredItems = computed(() => {
  return items.value
    .filter(item => item.category == activeTab.value)
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
  // 關鍵：將使用者輸入的 searchQuery 賦值給 actualSearchQuery
  actualSearchQuery.value = searchQuery.value;
  console.log('搜尋:', actualSearchQuery.value);
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

const AddToCart = (item) => {
  // 處理從子組件傳來的加入購物車事件
  console.log('加入購物車:', item);
  // 可以在這裡實現將商品加入購物車的邏輯
  // 例如使用 Vuex Store 或其他狀態管理方式
  alert(`已將「${item.name}」加入購物車`);
};
</script>
