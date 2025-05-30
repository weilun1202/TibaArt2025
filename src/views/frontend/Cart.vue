<template>
  <div>
    <div class="wrapper">
      <header>
        <div class="pageTitle">購物車</div>
      </header>
      <!-- Wrapper 不設 1200px 寬（例如展覽、關於我們頁面應該會滿版），想要限制內容在 1200 的再自己包一個 div 限制 1200  -->
      <!-- 以下供大家編輯 -->
        <div class="wrap">
            <div id="cart" class="cartContainer">
                <!-- 左邊：購物車商品 -->
                <div class="leftPanel">
                    <div class="card">
                        <div class="cartItem">
                            <img src="/assets/img/itemMug.jpg" alt="商品圖片">
                            <div class="cartDetails">
                                <h3 class="cardName">緯藝馬克杯</h3>
                                <p class="productPrice">價格：NT$500</p>
                                <div class="quantity">
                                    <p class="productDescription">數量: </p>
                                    <div class="selectQuan">
                                        <button type="button" class="addMinus">-</button>
                                        <input type="number" id="quantity" value="1" min="1">
                                        <button type="button" class="addMinus">+</button>
                                    </div>
                                </div>
                            </div>
                            <button class="removeBtn"><p>-</p></button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="cartItem">
                            <img src="/assets/img/itemBookmark.jpg" alt="商品圖片">
                            <div class="cartDetails">
                                <h3 class="cardName">緯藝書籤</h3>
                                <p class="productPrice">價格：NT$200</p>
                                <div class="quantity">
                                    <p class="productDescription">數量: </p>
                                    <div class="selectQuan">
                                        <button type="button" class="addMinus">-</button>
                                        <input type="number" id="quantity" value="1" min="1">
                                        <button type="button" class="addMinus">+</button>
                                    </div>
                                </div>
                            </div>
                            <button class="removeBtn"><p>-</p></button>
                        </div>
                    </div>
                    <p class="continueShopping"><router-link to="/front/shop">繼續選購商品</router-link></p>

                </div>

                <!-- 右邊-->
                <div class="rightPanel">
                    <!-- 訂購人資訊 -->
                    <div class="card2">
                        <h2 class="cardTitle">訂購人資訊</h2>
                        <div class="form">
                            <div class="formGroup">
                                <label>姓名</label>
                                <input type="text" placeholder="請輸入姓名">
                            </div>
                            <div class="formGroup">
                                <label>電話</label>
                                <input type="tel" placeholder="請輸入電話">
                            </div>
                            <div class="formGroup">
                                <label>地址</label>
                                <input type="text" placeholder="請輸入地址">
                            </div>
                            <div class="formGroup">
                                <label>發票類型</label>
                                <select class="invoiceType">
                                    <option value="">請選擇</option>
                                    <option value="">紙本發票</option>
                                    <option value="">電子發票</option>
                                </select>
                            </div>
                            <div class="formGroup">
                                <label>載具</label>
                                <input type="text" placeholder="請輸入載具號碼">
                            </div>
                        </div>

                    </div>

                    <!-- 收件人資訊 -->
                    <div class="card2">
                        <h2 class="cardTitle">收件人資訊</h2>
                        <div class="form">
                            <div class="formGroup">
                                <label>同訂購人</label>
                                <div class="checkboxContainer">
                                    <input type="checkbox" class="checkbox">
                                </div>
                            </div>
                            <div class="formGroup">
                                <label>姓名</label>
                                <input placeholder="請輸入姓名">
                            </div>
                            <div class="formGroup">
                                <label>電話</label>
                                <input placeholder="請輸入電話">
                            </div>
                            <div class="formGroup">
                                <label>地址</label>
                                <input placeholder="請輸入地址">
                            </div>
                        </div>
                    </div>

                    <!-- 確認訂單 -->
                    <div class="card2">
                        <h2 class="cardTitle">確認訂單</h2>
                        <div class="form2">
                            <div class="orderSummary">
                                <p><span>商品總額</span><span>NT$500</span></p>
                                <p><span>運費</span><span>NT$60</span></p>
                                <p><span>折扣</span><span>NT$0</span></p>
                                <hr>
                                <p class="total"><span>總計</span><span>NT$560</span></p>
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

</script>

<style lang="scss" scoped>
/* 可以把額外的 CSS 加在這裡或保留在全域 */
@import '/style.scss';


</style>

