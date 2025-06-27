<template>
  <div>
    <div class="wrapper">
        <header class="animate__animated animate__flipInX">
        <div class="pageTitle">線上商城</div>
        </header>
        <div class="wrap">

                <!-- Wrapper 不設 1200px 寬（例如展覽、關於我們頁面應該會滿版），想要限制內容在 1200 的再自己包一個 div 限制 1200  -->
                <!-- 以下供大家編輯 -->
                <div class="shopTab animate__animated animate__fadeIn animate__slow">
                    <div class="subTitle">
                        <h1>商品資訊</h1>
                        <!-- {{ $router.currentRoute }} -->
                    </div>
                </div>

                <div class="productContainer animate__animated animate__fadeIn animate__slow" v-if="currentProduct">
                    <div class="productImg">
                        <img :src="baseUrl + currentProduct.image" alt="currentProduct.name">
                    </div>
                    <div class="productInfo">
                        <h1 class="productName">{{ currentProduct.name }}</h1>
                        <pre class="productDescription">{{ currentProduct.description }}</pre>
                        <p class="productPrice">價格：NT$ {{ currentProduct.price }}</p>

                        <div class="quantity">
                            <p class="productDescription">數量: </p>

                            <div class="selectQuan">
                                <button type="button" class="addMinus" 
                                    @click="minusQuan"
                                    :disabled="quantity <= 1">-</button>

                                <input type="number" id="quantity" 
                                    v-model="quantity" min="1">

                                <button type="button" class="addMinus" 
                                    @click="addQuan">+</button>
                            </div>
                        </div>

                        <div class="actions">
                            <button type="button" class="btn" @click="handleAddToCart">加入購物車</button>
                            <p class="continueShopping"><router-link to="/front/shop">回商品列表</router-link></p>
                        </div>
                    </div>
                </div>

                <div class="recommend" v-if="recommendedProducts.length > 0">
                    <span class="recoTitle">或許您會喜歡</span>
                    <!-- 推薦商品列表 -->
                    <ul class="itemList">
                        <li class="item scroll-trigger-item" 
                            v-for="item in recommendedProducts" 
                            :key="item.id">
                            <router-link :to="{ name: 'product', params: { id: item.id } }" class="itemImage">
                                <img :src="baseUrl + item.image" :alt="item.name">
                            </router-link>

                            <div class="itemInfo">
                                <div class="itemDetails">
                                    <div class="itemName">{{ item.name }}</div>
                                    <div class="itemPrice">NT$ {{ item.price }}</div>
                                </div>

                                <div class="itemActions">
                                    <button type="button" class="btn" @click="handleRecommendedAddToCart(item)">加入購物車</button>
                                </div>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>

            <div>
                <CartPopup
                :item="itemInPopup"
                :show="showCartPopup"
                :quantity="quantityInPopup"
                @close="showCartPopup = false"
                />
            </div>

            <div>
                <LoginPopup
                :show="showLoginPopup"
                :redirectPath="currentPath"
                @close="showLoginPopup = false"
                />
            </div>

        </div>
    </div>
</template>


<script setup>
import { ref, onMounted, computed, watch, nextTick } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import {useCart} from '@/stores/cart.js';
import { useUserStore } from '@/stores/user'
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger'; 
import CartPopup from '@/components/CartPopup.vue';
import LoginPopup from '@/components/LoginPopup.vue';

gsap.registerPlugin(ScrollTrigger);

const router = useRouter();
const route = useRoute();
// const baseUrl = import.meta.env.BASE_URL;
const baseUrl = import.meta.env.VITE_showUploadImage;


const {addToCart} = useCart();

// 載入相對應的商品
const products = ref([])
const currentProduct = ref(null)
const quantity = ref(1)

onMounted(async () => {
    // const resp = await fetch(import.meta.env.BASE_URL + 'productData.json')
    const resp = await fetch(import.meta.env.VITE_Product)
    if (!resp.ok) {
        throw new Error('無法載入商品資料')
    } else {
        const data = await resp.json()
        products.value = data
        loadCurrentProduct()
    }
})

// 監聽路由參數變化，當切換不同商品時，重新載入主商品並初始化 ScrollTrigger
watch(() => route.params.id, (newId, oldId) => {
    if (newId !== oldId) {
        loadCurrentProduct();
        // 在路由變化，DOM 可能更新後，重新初始化 ScrollTrigger
        nextTick(() => {
            // 殺掉所有現有的 ScrollTrigger 實例，避免重複或指向錯誤的元素
            ScrollTrigger.getAll().forEach(trigger => trigger.kill());
            initScrollTriggerAnimations();
        });
    }
});

const loadCurrentProduct = () => {
    const productId = route.params.id
    currentProduct.value = products.value.find(product => product.id == productId)

    nextTick(() => {
        // 殺掉所有現有的 ScrollTrigger 實例
        ScrollTrigger.getAll().forEach(trigger => trigger.kill());
        initScrollTriggerAnimations();
    });
}

//加商品數量
const addQuan = () => {
    quantity.value++
}
const minusQuan = () => {
    if (quantity.value > 1) {
        quantity.value--
    }
}

const recommendedProducts = computed(() => {
    if (!currentProduct.value) return []

    const filtered = products.value
        .filter(product => product.id !== currentProduct.value.id)
        .slice(0, 6); // 取前6個作為推薦

    return filtered;
})

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

// 登入彈窗
const showLoginPopup = ref(false);
const currentPath = ref('');

// 加入購物車彈窗
const showCartPopup = ref(false); 
const itemInPopup = ref(null); 
const quantityInPopup = ref(1); 

const userStore = useUserStore()
const props = defineProps({
  product: Object
})

//加入購物車
const handleAddToCart = async () => {

    if (!userStore.requireLogin()) {
    // alert('請先登入會員')

    // 記錄當前頁面完整路徑
    currentPath.value = router.currentRoute.value.fullPath;
    showLoginPopup.value = true;
    return

  } else {
      if(!currentProduct.value) return
      
      try {
          await new Promise(resolve => requestAnimationFrame(resolve));
          const success = addToCart(currentProduct.value, quantity.value)
          if(success){
            //   alert(`已將「${currentProduct.value.name}」x ${quantity.value} 加入購物車`);
            itemInPopup.value = currentProduct.value;
            quantityInPopup.value = quantity.value;
            showCartPopup.value = true;
            
            quantity.value = 1
          }
      } catch (error) {
          console.error('加入購物車失敗:', error);
      }
    }
};

//推薦商品加入購物車 (一次只能加一)
const handleRecommendedAddToCart = async (item) => {
    if (!userStore.requireLogin()) {
    // alert('請先登入會員')
    
    // 記錄當前頁面完整路徑
    currentPath.value = router.currentRoute.value.fullPath;
    showLoginPopup.value = true;
    return
    
  } else {
        try {
            await new Promise(resolve => requestAnimationFrame(resolve));
            const success = addToCart(item, 1)
            if(success){
                // alert(`已將「${item.name}」加入購物車`);
                itemInPopup.value = item;
                quantityInPopup.value = 1;
                showCartPopup.value = true;
            }
        } catch (error) {
            console.error('加入購物車失敗:', error);
        }
    }
}

</script>

<style lang="scss" scoped>
@import '/style.scss';
.shopTab {
    padding: 20px 20px 40px;
}

</style>