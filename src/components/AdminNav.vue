<template>
    <nav class="backNav">

        <div class="backUser">
            <span>管理人</span>
        </div>

        <div class="backMenu">
            <ul>
                <li
                v-for="(item, index) in menuItems"
                :key="index"
                :class="{ active: route.path === item.path }"
                >
                <router-link :to="item.path">{{ item.label }}</router-link>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script setup>
   import { useRoute } from 'vue-router'
const route = useRoute()

const menuItems = [
  { label: '一般會員管理', path: '/admin/member' },
  { label: '藝術家會員管理', path: '/admin/artist' },
  { label: '作品管理', path: '/admin/artwork' },
  { label: '展覽資訊管理', path: '/admin/expo' },
  { label: '商品管理', path: '/admin/product' },
  { label: '訂單管理', path: '/admin/order' },
  { label: '贊助管理', path: '/admin/donate' }
]
</script>

<style lang="scss" scoped>
@import '/style.scss';
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
                    background-color: darken($buttonYellow, 10%);
                    // background-color: $buttonYellow;
                }
            }
            &.active a {
            background-color: $buttonYellow;
            color: $fontBlack;
      }
        }
    }
}
</style>