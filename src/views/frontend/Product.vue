<template>
  <div>
    <div class="wrapper">
        <header>
        <div class="pageTitle">線上商城</div>
        </header>
        <div class="wrap">

        <!-- Wrapper 不設 1200px 寬（例如展覽、關於我們頁面應該會滿版），想要限制內容在 1200 的再自己包一個 div 限制 1200  -->
        <!-- 以下供大家編輯 -->
        <div class="shopTab">
                <div class="subTitle">
                    <h1>商品資訊</h1>
                </div>

                <!-- <div class="searchContainer">
                    <form class="searchBar" action="#" method="get">
                        <input type="text" class="searchInput" placeholder="Search..." required>
                        <button type="submit" class="searchButton">
                            <font-awesome-icon :icon="['fas', 'magnifying-glass']" />
                        </button>
                    </form>
                </div> -->
            </div>

            <div class="productContainer" v-if="currentProduct">
                <div class="productImg">
                    <img :src="currentProduct.image" alt="currentProduct.name">
                </div>
                <div class="productInfo">
                    <h1 class="productName">{{ currentProduct.name }}</h1>
                    <pre class="productDescription">{{ currentProduct.description }}</pre>
                    <p class="productPrice">價格：NT$ {{ currentProduct.price }}</p>

                    <div class="quantity">
                        <p class="productDescription">數量: </p>
                        <div class="selectQuan">
                            <button type="button" class = "addMinus" @click="minusQuan">-</button>
                            <input type="number" id="quantity" v-model="quantity" min="1">
                            <button type="button" class = "addMinus" @click="addQuan" :disabled="quantity === 0">+</button>
                        </div>
                    </div>

                    <div class="actions">
                        <button type="button" class="btn">加入購物車</button>
                        <p class="continueShopping"><router-link to="/front/shop">回商品列表</router-link></p>
                    </div>
                </div>
            </div>

            <div class="recommend" v-if="recommendedProducts.length > 0">
                <span class="recoTitle">或許您會喜歡</span>
                <!-- 商品列表 -->
                <itemList :items="recommendedProducts" @add-to-cart="AddToCart" />
                <!-- <ul class="itemList">
                    <li class="item">
                        <a href="#" class="itemImage">
                            <img src="@/assets/img/itemBag.jpg" alt="緯藝帆布袋">
                        </a>
                        <div class="itemInfo">
                            <div class="itemDetails">
                                <div class="itemName">緯藝帆布袋</div>
                                <div class="itemPrice">NT$ 580</div>
                            </div>
                            <div class="itemActions">
                                <button type="button" class="btn">加入購物車</button>
                            </div>
                        </div>
                    </li>

                    <li class="item">
                        <a href="#" class="itemImage">
                            <img src="@/assets/img/itemCoaster.jpg" alt="緯藝杯墊">
                        </a>
                        <div class="itemInfo">
                            <div class="itemDetails">
                                <div class="itemName">緯藝杯墊</div>
                                <div class="itemPrice">NT$ 490</div>
                            </div>
                            <div class="itemActions">
                                <button type="button" class="btn">加入購物車</button>
                            </div>
                        </div>
                    </li>
                    <li class="item">
                        <a href="#" class="itemImage">
                            <img src="@/assets/img/itemBookmark.jpg" alt="緯藝書籤">
                        </a>
                        <div class="itemInfo">
                            <div class="itemDetails">
                                <div class="itemName">緯藝書籤</div>
                                <div class="itemPrice">NT$ 200</div>
                            </div>
                            <div class="itemActions">
                                <button type="button" class="btn">加入購物車</button>
                            </div>
                        </div>
                    </li>
                </ul> -->
            </div>
        </div>
    </div>
  </div>
</template>

<script setup>
    import { ref, onMounted, computed } from 'vue';
    import { useRouter } from 'vue-router';
    import { useRoute } from 'vue-router';
    import itemList from '@/components/itemList.vue';


    const router = useRouter();
    const route = useRoute();

    // 載入相對應的商品
    const products = ref([])
    const currentProduct = ref(null)
    const quantity = ref(1)

    onMounted (async()=>{
        const resp = await fetch('/productData.json')
        if(!resp.ok){
            throw new Error('無法載入商品資料')
        }else{
            const data = await resp.json()
            products.value = data
            loadCurrentProduct()
        }
    })

    const loadCurrentProduct = () => {
        const productId = route.params.id
        currentProduct.value = products.value.find(product => product.id == productId)
    }

    //加商品數量
    const addQuan = () => {
        quantity.value++
    }
    const minusQuan = () => {
        if( quantity.value > 0 ){
            quantity.value--
        }
    }

    //載入推薦的產品
    const items = ref([]);
    const filteredItems = computed(()=>{
        return recommendedProducts.value;
    })

    const recommendedProducts = computed(() => {
        if (!currentProduct.value) return []
        
        return products.value
            .filter(product => product.id !== currentProduct.value.id)
            .slice(0, 6)
    })



</script>
