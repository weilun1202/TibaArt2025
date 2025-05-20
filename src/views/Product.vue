<template>
  <div>
    <header>
      <div class="pageTitle">商品詳細資訊</div>
    </header>
    <div class="wrapper2">
      <!-- Wrapper 不設 1200px 寬（例如展覽、關於我們頁面應該會滿版），想要限制內容在 1200 的再自己包一個 div 限制 1200  -->
      <!-- 以下供大家編輯 -->
       <div class="shopTab">
            <div class="tabaShopTab">
                <h1>商品詳細資訊</h1>
            </div>

            <div class="searchContainer">
                <form class="searchBar" action="#" method="get">
                    <input type="text" class="searchInput" placeholder="Search..." required>
                    <button type="submit" class="searchButton">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>
        </div>

        <div class="productContainer">
            <div class="productImg">
                <img src="@/assets/img/itemMug.jpg" alt="緯藝馬克杯">
            </div>
            <div class="productInfo">
                <h1 class="productName">緯藝馬克杯</h1>
                <p class="productDescription">材質：基材<br>
                    種類：磁器<br>
                    規格：325ml<br>
                    產地：日本</p>
                <p class="productPrice">價格：NT$ 280</p>

                <div class="quantity">
                    <p class="productDescription">數量: </p>
                    <div class="selectQuan">
                        <button type="button" class = "addMinus">-</button>
                        <input type="number" id="quantity" value="1" min="1">
                        <button type="button" class = "addMinus">+</button>
                    </div>

                </div>

                <div class="actions">
                    <button type="button" class="btn">加入購物車</button>
                    <p class="continueShopping"><router-link to="/shop">繼續選購其他商品</router-link></p>
                </div>
            </div>
        </div>

        <div class="recommend">
            <span class="recoTitle">您或許會喜歡</span>
            <ul class="itemList">
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

            </ul>
        </div>

    </div>
  </div>
</template>

<script setup>

</script>
