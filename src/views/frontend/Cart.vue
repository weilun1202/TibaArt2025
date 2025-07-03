<template>
  <div>
    <div class="wrapper">
      <header class="animate__animated animate__flipInX">
        <div class="pageTitle">購物車</div>
      </header>
      <!-- Wrapper 不設 1200px 寬（例如展覽、關於我們頁面應該會滿版），想要限制內容在 1200 的再自己包一個 div 限制 1200  -->
      <!-- 以下供大家編輯 -->
        <div class="wrap animate__animated animate__fadeIn animate__slow">
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
                                <router-link :to="{name: 'product', params: {id: item.id}}" class="itemImage">
                                    <img :src="baseUrl + item.image" :alt="item.name">
                                </router-link>
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
                                                @input="updateItemQuan(item.id, $event.target.value)" 
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
                                <label for="buyerName">
                                    姓名
                                    <span class="formHint">*</span>
                                </label>
                                <input id="buyerName" type="text" 
                                    placeholder="請輸入姓名" 
                                    v-model="orderInfo.name"
                                    @blur="validateField('name')"
                                    @keyup.enter="validateField('name')">
                                    <div class="formError" 
                                    v-if="errors.name && touchedFields.name">
                                    {{errors.name}}
                                </div>
                            </div>
                            <div class="formGroup">
                                <label for="buyerTel">
                                    電話
                                    <span class="formHint">*</span>
                                </label>
                                <input id="buyerTel" type="tel" 
                                    placeholder="請輸入電話(10碼)" 
                                    v-model="orderInfo.tel"
                                    maxlength="10"
                                    inputmode="numeric"
                                    @blur="validateField('tel')"
                                    @keyup.enter="validateField('tel')"
                                    @input="restrictToNumbers">
                                <div class="formError" 
                                    v-if="errors.tel && touchedFields.tel">
                                    {{ errors.tel }}
                                </div>
                            </div>
                            <div class="formGroup">
                                <label for="invoiceType">
                                    發票類型
                                    <span class="formHint">*</span>
                                </label>
                                <select id="invoiceType" class="invoiceType"
                                    v-model="orderInfo.invoiceType"
                                    @blur="validateField('invoiceType')"
                                    @change="handleInvoiceTypeChange">
                                    <option value="">請選擇</option>
                                    <option value="paper">紙本發票</option>
                                    <option value="electronic">電子發票</option>
                                </select>
                                <div class="formError" 
                                    v-if="errors.invoiceType && touchedFields.invoiceType">
                                    {{ errors.invoiceType }}
                                </div>
                            </div>
                            <div class="formGroup" v-if="orderInfo.invoiceType =='electronic'">
                                <label for="carrier">
                                    載具
                                    <span class="formHint">*</span>
                                </label>
                                <input id="carrier" type="text" 
                                    placeholder="/ABCD123 (8碼)"
                                    v-model="orderInfo.carrier"
                                    maxlength="8"
                                    @blur="validateField('carrier')"
                                    @keyup.enter="validateField('carrier')"
                                    @input="formatCarrier">
                                <div class="formError" 
                                    v-if="errors.carrier && touchedFields.carrier">
                                    {{ errors.carrier }}
                                </div>
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
                                <label for="sameName">
                                    姓名
                                    <span class="formHint">*</span>
                                </label>
                                <input id="sameName" type="text" 
                                    placeholder="請輸入姓名" 
                                    v-model="recipientInfo.name"
                                    :disabled="sameAsOrder"
                                    @blur="validateRecipientField('name')"
                                    @keyup.enter="validateRecipientField('name')">
                                <div class="formError" 
                                    v-if="errors.recipientName && touchedFields.recipientName">
                                    {{ errors.recipientName }}
                                </div>
                            </div>
                            <div class="formGroup">
                                <label for="sameTel">
                                    電話
                                    <span class="formHint">*</span>
                                </label>
                                <input id="sameTel" type="tel" 
                                    placeholder="請輸入電話(10碼)" 
                                    v-model="recipientInfo.tel"
                                    :disabled="sameAsOrder"
                                    @blur="validateRecipientField('tel')"
                                    @keyup.enter="validateRecipientField('tel')"
                                    @input="restrictToNumbers"
                                    maxlength="10"
                                    inputmode="numeric"
                                    required>
                                <div class="formError" 
                                    v-if="errors.recipientTel && touchedFields.recipientTel">
                                    {{ errors.recipientTel }}
                                </div>
                            </div>
                            <div class="formGroup">
                                <label for="sameAddress">
                                    地址
                                    <span class="formHint">*</span>
                                </label>
                                <input id="sameAddress" type="text" 
                                    placeholder="請輸入地址" 
                                    v-model="recipientInfo.address"
                                    @blur="validateRecipientField('address')"
                                    @keyup.enter="validateRecipientField('address')">
                                <div class="formError" 
                                    v-if="errors.recipientAddress && touchedFields.recipientAddress">
                                    {{ errors.recipientAddress }}
                                </div>
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
                            <!-- <button class="btn"><router-link to="orderConfirm>確認購買</router-link></button> -->
                            <button type="button" class="btn" @click="handleSubmitOrder">確認購買</button>
                            <img class="ecpay" src="@/assets/img/ecpay_logo.svg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <LoginPopup
            :show="showLoginPopup"
            :redirectPath="currentPath"
            @close="showLoginPopup = false"
            />

        <OrderConfirmPopup 
            :show="showErrorPopup" 
            :message="errorMessage" 
            @close="closeErrorPopup" 
            />
        <RemovePopup 
            :show="showRemovePopup" 
            :item="itemToRemove" 
            @close="closeRemovePopup" 
            @confirm="confirmRemoveItem"
            />            
    </div>
  </div>
</template>

<script setup>
import{ref, watch, computed, onMounted } from 'vue';
import {useCart} from '@/stores/cart.js';
import { useRouter } from 'vue-router';
import { useUserStore } from '@/stores/user.js';
import LoginPopup from '@/components/LoginPopup.vue';
import RemovePopup from '@/components/RemovePopup.vue';
import OrderConfirmPopup from '@/components/OrderConfirmPopup.vue';

const { cartItems, updateQuan, removeFromCart, totalPrice, clearCart } = useCart();
const router = useRouter();
// const baseUrl = import.meta.env.BASE_URL;
const baseUrl = import.meta.env.VITE_showUploadImage;
const userStore = useUserStore(); 

const memberId = computed(() => userStore.decodedMemberId);

const orderInfo = ref({
    name: '',
    tel: '',
    invoiceType: '',
    carrier: '',
    member_id: memberId.value,
})

// 當 memberId 變化時，更新 orderInfo 中的 member_id
watch(memberId, (newId) => {
    orderInfo.value.member_id = newId;
    // 當會員 ID 變更時（表示登入狀態改變或用戶切換），清空購物車
    if (!newId) { // 如果 newId 為空字串，表示未登入或登出
        clearCart();
        console.log('會員登入狀態改變，購物車已清空。');
    }
}, { immediate: true }); // immediate: true 確保在組件初始化時就執行一次

// 新增一個 watch 來監聽登入狀態，如果登出則清空購物車
watch(() => userStore.isLoggedIn, (newStatus, oldStatus) => {
    // 避免首次載入時就清空，只在狀態從登入變為未登入時執行
    if (oldStatus === true && newStatus === false) {
        clearCart();
        console.log('用戶已登出，購物車已清空。');
    }
});

const recipientInfo = ref({
    name: '',
    tel: '',
    address: '',
})

const sameAsOrder = ref(false);
const shippingFee = ref(60);
const discount = ref(0);
const errors = ref({})
const touchedFields = ref({}); // 追蹤哪些欄位已經被使用者操作過

// 登入彈窗相關
const showLoginPopup = ref(false);

// 計算總價
const finalPrice = computed (() => {
    return totalPrice.value + shippingFee.value - discount.value;
})

//檢查資料有沒有填好
const checkout = computed(() => {
    return orderInfo.value.name &&
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
const showRemovePopup = ref(false);
const itemToRemove = ref(null);

const handleRemoveItem = async (productId) => {
    try {
        await new Promise(resolve => requestAnimationFrame(resolve));

        const item = cartItems.value.find(item => item.id === productId);
        if(item) {
            itemToRemove.value = item;
            showRemovePopup.value = true;
        }
    } catch (error) {
        console.error('移除商品失敗:', error);
    }
}

// 關閉移除彈窗
const closeRemovePopup = () => {
    showRemovePopup.value = false;
    itemToRemove.value = null;
}

// 確認移除商品
const confirmRemoveItem = (productId) => {
    removeFromCart(productId);
    closeRemovePopup();
}


// 限制只能輸入數字
const restrictToNumbers = (event) => {
    const value = event.target.value;
    event.target.value = value.replace(/[^0-9]/g, '');

    // 同步更新到對應的資料
    if (event.target.id === 'buyerTel') {
        orderInfo.value.tel = event.target.value;
    } else if (event.target.id === 'sameTel') {
        recipientInfo.value.tel = event.target.value;
    }
}

// 格式化載具輸入
const formatCarrier = (event) => {
    let value = event.target.value.toUpperCase();

    // 如果第一個字符不是 / 且有輸入內容，自動添加 /
    if (value.length > 0 && value.charAt(0) !== '/') {
        value = '/' + value;
    }

    // 第一碼必須是 /，其餘只允許數字和英文字母
    if (value.length > 1) {
        const firstChar = value.charAt(0);
        const restChars = value.slice(1).replace(/[^0-9A-Z]/g, '');
        value = firstChar + restChars;
    }

    // 限制總長度為8碼
    if (value.length > 8) {
        value = value.slice(0, 8);
    }

    event.target.value = value;
    orderInfo.value.carrier = value;
}

// 處理發票類型變更
const handleInvoiceTypeChange = () => {
    validateField('invoiceType');

    // 如果切換到紙本發票，清除載具相關錯誤和資料
    if (orderInfo.value.invoiceType === 'paper') {
        orderInfo.value.carrier = '';
        delete errors.value.carrier;
        delete touchedFields.value.carrier;
    }
}
// 驗證單一欄位（訂購人資訊）
const validateField = (fieldName) => {
    touchedFields.value[fieldName] = true;

    switch(fieldName) {
        case 'name':
            if (!orderInfo.value.name.trim()) {
                errors.value.name = '請輸入姓名';
            } else {
                delete errors.value.name;
            }
            break;
        case 'tel':
            // 檢查是否為10碼數字且以09開頭
            if (!/^(09)[0-9]{8}$/.test(orderInfo.value.tel)) {
                errors.value.tel = '請輸入正確的電話號碼 (須為09開頭的10碼數字)';
            } else {
                delete errors.value.tel;
            }
            break;
        case 'invoiceType':
            if (!orderInfo.value.invoiceType) {
                errors.value.invoiceType = '請選擇發票類型';
            } else {
                delete errors.value.invoiceType;
            }
            break;
        case 'carrier':
            // 只有選擇電子發票時才需要驗證載具
            if (orderInfo.value.invoiceType === 'electronic') {
                const carrierPattern = /^\/[0-9A-Z]{7}$/;
                if (!orderInfo.value.carrier.trim()) {
                    errors.value.carrier = '請輸入載具號碼';
                } else if (!carrierPattern.test(orderInfo.value.carrier)) {
                    errors.value.carrier = '載具格式錯誤：須為8碼，第一碼為/，其餘為數字或英文';
                } else {
                    delete errors.value.carrier;
                }
            } else {
                // 選擇紙本發票時，清除載具錯誤
                delete errors.value.carrier;
            }
            break;
    }
}

// 驗證收件人欄位
const validateRecipientField = (fieldName) => {
    // if (sameAsOrder.value) return;

    const errorKey = `recipient${fieldName.charAt(0).toUpperCase() + fieldName.slice(1)}`;
    touchedFields.value[errorKey] = true;

    switch(fieldName) {
        case 'name':
            if (!recipientInfo.value.name.trim()) {
                errors.value.recipientName = '請輸入收件人姓名';
            } else {
                delete errors.value.recipientName;
            }
            break;
        case 'tel':
            // 檢查是否為10碼數字且以09開頭
            if (!/^(09)[0-9]{8}$/.test(recipientInfo.value.tel)) {
                errors.value.recipientTel = '請輸入正確的電話號碼 (須為09開頭的10碼數字)';
            } else {
                delete errors.value.recipientTel;
            }
            break;
        case 'address':
            // 無論是否勾選「同訂購人」，都進行地址驗證
            if (!recipientInfo.value.address.trim()) {
                errors.value.recipientAddress = '請輸入收件人地址';
            } else {
                delete errors.value.recipientAddress;
            }
            break;
    }
}

// 勾或取消checkbox 
watch(sameAsOrder, (same) => {
    if(same) {
        recipientInfo.value.name = orderInfo.value.name;
        recipientInfo.value.tel = orderInfo.value.tel;
        
        validateRecipientField('name');
        validateRecipientField('tel');

    } else {
        // 取消勾選時，清空收件人資訊
        recipientInfo.value.name = '';
        recipientInfo.value.tel = '';
        delete errors.value.recipientName;
        delete errors.value.recipientTel;
        delete touchedFields.value.recipientName;
        delete touchedFields.value.recipientTel;
    }
});

// 訂購人資訊改變時 如果勾選同訂購人 要同步更新)
watch(orderInfo, (update) => {
    if(sameAsOrder.value) {
        recipientInfo.value.name = update.name;
        recipientInfo.value.tel = update.tel;
        validateRecipientField('name');
        validateRecipientField('tel');
        validateRecipientField('address');
    }
}, { deep: true });  //確保能監聽到物件內部屬性的變化

//提交表單時驗證
const validateForm = () => {
    touchedFields.value = {
        name: true,
        tel: true,
        invoiceType: true,
        carrier: orderInfo.value.invoiceType === 'electronic', // 有電子發票才需要驗證載具
        recipientName: true,
        recipientTel: true,
        recipientAddress: true
    };

    errors.value = {};

    if (cartItems.value.length === 0) {
        errors.value.cart = '購物車不能為空';
    }

    // 驗證訂購人資訊
    validateField('name');
    validateField('tel');
    validateField('invoiceType');

    if (orderInfo.value.invoiceType === 'electronic') {
        validateField('carrier');
    }

    // 無論是否勾選「同訂購人」，都驗證收件人資訊
    validateRecipientField('name');
    validateRecipientField('tel');
    validateRecipientField('address');

    return Object.keys(errors.value).length === 0;
};


// 彈窗
const showErrorPopup = ref(false);
const errorMessage = ref('');

const showError = (message) => {
  errorMessage.value = message;
  showErrorPopup.value = true;
};

const closeErrorPopup = () => {
  showErrorPopup.value = false;
  errorMessage.value = '';
};

// 關閉登入彈窗
const closeLoginPopup = () => {
    showLoginPopup.value = false;
};

// 處理確認購買按鈕點擊（加入登入檢查）
const handleSubmitOrder = () => {
    // 首先檢查是否已登入
    if (!userStore.isLoggedIn) {
        showLoginPopup.value = true;
        return;
    }
    
    // 已登入，執行原本的送出訂單邏輯
    submitOrder();
};

const submitOrder = async () => {
    if (validateForm()) {
        console.log('送出訂單:', {
            orderInfo: orderInfo.value,
            recipientInfo: recipientInfo.value,
            cartItems: cartItems.value
        });

        // 準備要送出的資料
        const orderData = {
            orderInfo: orderInfo.value,
            recipientInfo: recipientInfo.value,
            cartItems: cartItems.value,
            totalPrice: finalPrice.value,
            shippingFee: shippingFee.value,
            discount: discount.value 
        };

        try {
            const response = await fetch(import.meta.env.VITE_SubmitOrder, { 
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(orderData), // 將 JavaScript 物件轉換為 JSON 字串
            });

            const result = await response.json(); // 解析 JSON 回應

            if (response.ok && result.success) {
                // alert('訂單送出成功！');
            }
                
            
            // 訂單建立成功，獲取 orderId
            const orderNumber = result.orderId;
            sessionStorage.setItem('lastOrderNumber', orderNumber);

            const ecpayResponse = await fetch(import.meta.env.VITE_EcpayOrder, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ order_number: orderNumber })
            });
            
            if (ecpayResponse.ok) {
                // 將返回的 HTML 表單寫入文檔，觸發自動提交到綠界
                document.open();
                document.write(await ecpayResponse.text());
                document.close();
            } else {
                alert('無法連接到綠界付款，請稍後再試');
            }
            
            clearCart();

        } catch (error) {
            console.error('Error', error);
            alert('網路或伺服器錯誤，請稍後再試。');
        }

    } else {
        // 驗證失敗，顯示簡化的警告彈窗
        if (cartItems.value.length === 0) {
            // alert('購物車不能為空');
            showError('購物車不能為空');

        } else {
            // alert('資訊輸入有誤，請檢查');
            showError('資訊輸入有誤，請檢查');

        }
        
        console.log('表單驗證失敗:', errors.value);
    }
};
</script>

<style lang="scss" scoped>
@import '/style.scss';

.formError{
  font-size: 12px;
  color: $fontWarn;
  margin-top: $spacing-1;
  min-height: $spacing-4;
}

</style>