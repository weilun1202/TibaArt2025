<template>
    <nav class="backNav">

        <div class="backUser">
            <span>管理人</span>
        </div>

        <div class="backMenu">
            <ul>
                <li><a href="#">一般會員管理</a></li>
                <li><a href="#">藝術家會員管理</a></li>
                <li><a href="#">作品管理</a></li>
                <li><a href="#">展覽資訊管理</a></li>
                <li><a href="#">商品管理</a></li>
                <li><a href="#">訂單管理</a></li>
                <li><a href="#">贊助管理</a></li>
            </ul>
        </div>
    </nav>
</template>

<script setup>
</script>

<style lang="scss">
.backNav {
    background-color: $primaryGreen;
    width: 250px;
    height: 100vh;
    color: $fontWhite;
    position: fixed;
}

.backUser {
    padding: 50px;
}

.backMenu {
    ul {
        li {
            a {
                display: block;
                text-decoration: none;
                color: $fontWhite;
                line-height: 50px;
                padding-left: 50px;

                &:hover {
                    background-color: $buttonYellow;
                    color: $fontBlack;
                }
            }
        }
    }
}
</style>