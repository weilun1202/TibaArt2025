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
                        <img src="@/assets/img/itemMug.jpg" alt="商品圖片">
                        <div class="cartDetails">
                            <h3 class="cardName">緯藝馬克杯</h3>
                            <p class="productDescription">材質：磁器、規格：325ml</p>
                            <p class="productPrice">價格：NT$500</p>
                            <div class="quantity">
                                <p class="productDescription">數量: </p>
                                <div class="selectQuan">
                                    <button type="button" class="addMinus">-</button>
                                    <input type="number" id="quantity" value="1" min="1">
                                    <button type="button" class="addMinus">+</button>
                                </div>
                            </div>
                            <p class="removeBtn">移除</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 右邊-->
            <div class="rightPanel">
                    <!-- 訂購人資訊 -->
                    <div class="card">
                        <h2 class="cardTitle">訂購人資訊</h2>
                        <div class="form-group">
                            <label>姓名</label>
                            <input placeholder="請輸入姓名">
                        </div>
                        <div class="form-group">
                            <label>電話</label>
                            <input placeholder="請輸入電話">
                        </div>
                        <div class="form-group">
                            <label>地址</label>
                            <input placeholder="請輸入地址">
                        </div>
                        <div class="form-group">
                            <label>發票類型</label>
                            <input placeholder="請選擇">
                        </div>
                        <div class="form-group">
                            <label>載具</label>
                            <input placeholder="請輸入載具號碼">
                        </div>
                    </div>

                    <!-- 收件人資訊 -->
                    <div class="card">
                        <h2 class="cardTitle">收件人資訊</h2>
                        <div class="form-group">
                            <label>同訂購人</label>
                            <input type="checkbox">
                        </div>
                        <div class="form-group">
                            <label>姓名</label>
                            <input placeholder="請輸入姓名">
                        </div>
                        <div class="form-group">
                            <label>電話</label>
                            <input placeholder="請輸入電話">
                        </div>
                        <div class="form-group">
                            <label>地址</label>
                            <input placeholder="請輸入地址">
                        </div>

                    </div>

                    <!-- 確認訂單 -->
                    <div class="card">
                        <h2 class="cardTitle">確認訂單</h2>
                        <div class="order-summary">
                            <p><span>商品總額</span><span>NT$500</span></p>
                            <p><span>運費</span><span>NT$60</span></p>
                            <p><span>折扣</span><span>NT$0</span></p>
                            <hr>
                            <p><span>總計</span><span>NT$560</span></p>
                        </div>
                        <button class="btn"><router-link to="/orderConfirm">確認購買</router-link></button>
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

