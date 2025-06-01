<template>
  <div>
    <div class="wrapper">
      <header class="animate__animated animate__flipInX">
        <div class="pageTitle">購物車</div>
      </header>
      <!-- Wrapper 不設 1200px 寬（例如展覽、關於我們頁面應該會滿版），想要限制內容在 1200 的再自己包一個 div 限制 1200  -->
      <!-- 以下供大家編輯 -->
        <div class="wrap">
            <div id="cart" class="cartContainer">
                <!-- 左邊：購物車商品 -->
                <div class="leftPanel">

                    <!-- 沒商品時顯示這個 -->
                    <div class="cartEmpty" 
                        v-if="cartItems.length == 0">
                        <p>您的購物車目前是空的</p>
                        <p class="continueShopping"><router-link to="/front/shop">繼續選購商品</router-link></p>
                    </div> 
                    
                    <!-- 購物車列表 -->
                    <div v-else>
                        <div class="card" 
                                v-for="item in cartItems"
                                key="item.id">

                            <div class="cartItem">
                                <img :src="item.image" :alt="item.name">
                                <div class="cartDetails">
                                    <h3 class="cardName">{{item.name}}</h3>
                                    <p class="productPrice">價格：NT$ {{item.price}}</p>
                                    <div class="quantity">
                                        <p class="productDescription">數量: </p>
                                        
                                        <div class="selectQuan">
                                            <button type="button" class="addMinus"
                                            @click="minusQuan(item.id)"
                                            :disabled="item.quantity <= 1">-</button>
                                            
                                            <!-- id只能有一個名字 但有很多商品的數量 可以這樣寫  quantity + item.id -->
                                            <input type="number" 
                                                :id="'quantity-' + item.id" 
                                                :value="item.quantity"
                                                @input="updateItemQuan(item.Id, $event.target.value)" 
                                                min="1">

                                            <button type="button" class="addMinus"
                                                @click="addQuan(item.id)">+</button>
                                        </div>
                                    </div>
                                </div>
                                <button class="removeBtn" @click="handleRemoveItem(item.id)"><p>-</p></button>
                            </div>
                        </div>
    
                        <p class="continueShopping"><router-link to="/front/shop">繼續選購商品</router-link></p>

                    </div>

                </div>

                <!-- 右邊-->
                <div class="rightPanel">
                    <!-- 訂購人資訊 -->
                    <div class="card2">
                        <h2 class="cardTitle">訂購人資訊</h2>
                        <div class="form">
                            <div class="formGroup">
                                <label for="buyerName">姓名</label>
                                <input id="buyerName" type="text" 
                                    placeholder="請輸入姓名" 
                                    v-model="orderInfo.name">
                            </div>
                            <div class="formGroup">
                                <label for="buyerTel">電話</label>
                                <input id="buyerTel" type="tel" 
                                    placeholder="請輸入電話" 
                                    v-model="orderInfo.tel">
                            </div>
                            <div class="formGroup">
                                <label for="buyerAddress">地址</label>
                                <input id="buyerAddress" type="text" 
                                    placeholder="請輸入地址" 
                                    v-model="orderInfo.address">
                            </div>
                            <div class="formGroup">
                                <label for="invoiceType">發票類型</label>
                                <select id="invoiceType" class="invoiceType">
                                    <option value="">請選擇</option>
                                    <option value="">紙本發票</option>
                                    <option value="">電子發票</option>
                                </select>
                            </div>
                            <div class="formGroup">
                                <label for="carrier">載具</label>
                                <input id="carrier" type="text" placeholder="請輸入載具號碼">
                            </div>
                        </div>

                    </div>

                    <!-- 收件人資訊 -->
                    <div class="card2">
                        <h2 class="cardTitle">收件人資訊</h2>
                        <div class="form">
                            <div class="formGroup">
                                <label for="sameAsBuyer">同訂購人</label>
                                <div class="checkboxContainer">
                                    <input id="sameAsBuyer" type="checkbox" 
                                        class="checkbox" 
                                        v-model="sameAsOrder">
                                </div>
                            </div>
                            <div class="formGroup">
                                <label for="sameName">姓名</label>
                                <input id="sameName" type="text" 
                                    placeholder="請輸入姓名" 
                                    v-model="recipientInfo.name"
                                    :disabled="sameAsOrder">
                            </div>
                            <div class="formGroup">
                                <label for="sameTel">電話</label>
                                <input id="sameTel" type="tel" 
                                    placeholder="請輸入電話" 
                                    v-model="recipientInfo.tel"
                                    :disabled="sameAsOrder">
                            </div>
                            <div class="formGroup">
                                <label for="sameAddress">地址</label>
                                <input id="sameAddress" type="text" 
                                    placeholder="請輸入地址" 
                                    v-model="recipientInfo.address"
                                    :disabled="sameAsOrder">
                            </div>
                        </div>
                    </div>

                    <!-- 確認訂單 -->
                    <div class="card2">
                        <h2 class="cardTitle">確認訂單</h2>
                        <div class="form2">
                            <div class="orderSummary">
                                <p><span>商品總額</span><span>NT${{ totalPrice }}</span></p>
                                <p><span>運費</span><span>NT${{ shippingFee }}</span></p>
                                <p><span>折扣</span><span>NT${{ discount }}</span></p>
                                <hr>
                                <p class="total"><span>總計</span><span>NT${{ finalPrice }}</span></p>
                            </div>
                            <button class="btn"><router-link to="/front/orderConfirm">確認購買</router-link></button>
                            <img class="ecpay" src="@/assets/img/ecpay_logo.svg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>

<script setup>
import{ref, watch, computed } from 'vue';
import {useCart} from '@/stores/cart.js';

const { cartItems, updateQuan, removeFromCart, totalPrice } = useCart();


const orderInfo = ref({
    name: '',
    tel: '',
    address: '',
    invoiceType: '',
    carrier: '',
})

const recipientInfo = ref({
    name: '',
    tel: '',
    address: '',    
})

const sameAsOrder = ref(false);
const shippingFee = ref(60);
const discount = ref(0);

// 計算總價
const finalPrice = computed (() => {
    return totalPrice.value + shippingFee.value - discount.value;
})

//檢查資料有沒有填好
const checkout = computed(() => {
    return orderInfo.value.name &&
           orderInfo.value.address &&
           cartItems.value.length > 0;
})

// 加減商品數量
const addQuan = (productId) => {
    const item = cartItems.value.find(item => item.id == productId);
    if(item){
        updateQuan(productId, item.quantity + 1);
    }
}

const minusQuan = (productId) => {
    const item = cartItems.value.find(item => item.id == productId);
    if(item && item.quantity > 1){
        updateQuan(productId, item.quantity - 1);
    }
}

const updateItemQuan = (productId, newQuan) => {
    const quantity = parseInt(newQuan);
    if(quantity > 0){
        updateQuan(productId, newQuan)
    }
}

//移除商品
const handleRemoveItem = (productId) => {
    const item = cartItems.value.find(item => item.id === productId);
    if(item && confirm(`確定要移除「${item.name}」嗎？`)){
        removeFromCart(productId);
    }
}

// 勾或取消checkbox 時
watch(sameAsOrder, (same) => {
    if(same) {
        recipientInfo.value.name = orderInfo.value.name;
        recipientInfo.value.tel = orderInfo.value.tel;
        recipientInfo.value.address = orderInfo.value.address;
    }else {
        recipientInfo.value.name = '';
        recipientInfo.value.tel = '';
        recipientInfo.value.address = '';
    }
})

// 即時更新收件人資訊
watch(orderInfo, (update) => {
    if(sameAsOrder.value) {
        recipientInfo.value.name = update.name;
        recipientInfo.value.tel = update.tel;
        recipientInfo.value.address = update.address;
    }
}, { deep: true });  //確保能監聽到物件內部屬性的變化
</script>
