<template>
  <nav class="frontNav">
    <router-link to="/front" @click="closeMenu"><img class="logo" src="@/assets/img/TibaArtLogo.svg" alt="" /></router-link>

    <!-- <div class="navBar">
      <ul>
        <li><router-link to="/expo">線上展覽</router-link></li>
        <li><router-link to="/sponsor">贊助藝術家</router-link></li>
        <li><router-link to="/application">展覽申請</router-link></li>
        <li><router-link to="/shop">線上商城</router-link></li>
        <li><router-link to="/about">關於我們</router-link></li>
      </ul>
      <div class="memberAction">
        <button class="memberBtn" @click="goToLogin">會員登入</button>
        <button class="registerBtn" @click="goToRegister">註冊會員</button>
      </div>
    </div> -->

    <!-- Dropdown Menu with Transition -->
    <transition name="dropdown-slide">
      <div v-show="menuOpen" class="dropdown">
        <div class="dropdown-overlay" @click="closeMenu"></div>
        <div class="dropdown-content">
          <ul>
            <li><router-link to="/front/expo" @click="closeMenu">線上展覽</router-link></li>
            <li><router-link to="/front/sponsor" @click="closeMenu">贊助藝術家</router-link></li>
            <li><router-link to="/front/application" @click="closeMenu">展覽申請</router-link></li>
            <li><router-link to="/front/shop" @click="closeMenu">線上商城</router-link></li>
            <li><router-link to="/front/about" @click="closeMenu">關於我們</router-link></li>
            <!-- <li><router-link to="/front/MemLogin" @click="closeMenu">會員登入</router-link></li>
            <li><router-link to="/front/MemReg" @click="closeMenu">註冊會員</router-link></li> -->
          </ul>
        </div>
      </div>
    </transition>

    <!-- 漢堡選單按鈕 -->
    <div class="menuToggle" :class="{ active: menuOpen }" @click="toggleMenu">
      <div class="burger">
        <div class="bar bar1"></div>
        <div class="bar bar2"></div>
        <div class="bar bar3"></div>
      </div>
    </div>

    <!-- 會員中心 未登入-->
    <div class="memberIconN" v-if="!userStore.isLoggedIn">
      <router-link to="/front/memLogin" @click="closeMenu">
          <font-awesome-icon :icon="['far', 'user']" />
      </router-link>
    </div>

    <!-- 會員中心 已登入-->
    <div class="memberIconY" v-if="userStore.isLoggedIn">
      <router-link to="/member" @click="closeMenu">
        <img v-if="userStore.memberData.img" 
        :src="getAvatarUrl(userStore.memberData.img)"
        alt="會員頭像">
        <img v-else src="@/assets/img/TibaArt-Icon.svg" alt="會員預設頭像">
      </router-link>
    </div>

     <!-- 購物車 -->
    <router-link to="/front/cart" class="cartIcon" @click="closeMenu">
        <font-awesome-icon :icon="['fas', 'cart-shopping']" />
        <span class="cartCount"
          v-if="userStore.isLoggedIn && totalItems > 0">{{ totalItems }}</span>
    </router-link>  

  </nav>
</template>

<script setup>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { useRouter } from 'vue-router'
import { ref, reactive, onMounted, onUnmounted, watch } from 'vue';
import { useUserStore } from '@/stores/user'
import { useCart } from '@/stores/cart.js';

defineProps()



const MemURL = import.meta.env.VITE_MemURL

const getAvatarUrl = (img) => {
  if (!img) return '';
  return (img.startsWith('http://') || img.startsWith('https://')) 
    ? img 
    : MemURL + img;
};




const router = useRouter()
const goToLogin = () => {
  router.push('/MemLogin') 
}
const goToRegister = () => {
  router.push('/MemReg') 
}

const menuOpen = ref(false)

const toggleMenu = () => {
  menuOpen.value = !menuOpen.value
  // Prevent body scroll when menu is open
  // if (menuOpen.value) {
  //   document.body.style.overflow = 'hidden'
  // } else {
  //   document.body.style.overflow = ''
  // }
}

const closeMenu = () => {
  menuOpen.value = false
  document.body.style.overflow = ''
}

// Close menu on escape key
const handleEscKey = (event) => {
  if (event.key === 'Escape' && menuOpen.value) {
    closeMenu()
  }
}

const userStore = useUserStore()
const { totalItems } = useCart()


// 組件掛載時初始化會員資料
onMounted(() => {
  userStore.loadFromLocalStorage()
  if (userStore.isLoggedIn) {
    userStore.fetchMemberInfo()
  }

  // 初始化購物車
})

// 監聽登入狀態變化，重新初始化購物車
watch(
  () => userStore.isLoggedIn,
  () => {
    console.log('Navbar 監聽到登入狀態變化')
  }
)


// const memberData = reactive({
//   name: '',
//   type: '',
//   img: ''
// });

// async function loadMemberData() {
//   const member = JSON.parse(localStorage.getItem('member'))
//   const type = localStorage.getItem('memberType') || 'general'
//   const decodedId = atob(member.id)

//   const response = await fetch('http://localhost/TIBAART/getMemberInfo.php', {
//     method: 'POST',
//     headers: { 'Content-Type': 'application/json' },
//     body: JSON.stringify({ id: decodedId, type })
//   })

//   const result = await response.json()
//   if (result.success) {
//     const info = result.member_info
//     // console.log(info);
    
//     memberData.name = info.name
//     memberData.type = type
//     memberData.img = info.img 
//     // console.log(memberData.img);
    
//   }
// }

// onMounted(() => {
//   loadMemberData()
// })



onMounted(() => {
  document.addEventListener('keydown', handleEscKey)
})

onUnmounted(() => {
  document.removeEventListener('keydown', handleEscKey)
  document.body.style.overflow = '' // Clean up on unmount
})


</script>

<style lang="scss" scoped>
@import '/style.scss';

.frontNav {
    width: 100%;
    height: 72px;
    margin: 0 auto;
    padding: 2.5vw;
    display: flex;
    align-items: center;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    background: linear-gradient(180deg, #f6eee4 0%, #ffffff 100%);


    .logo {
        height: 60px;
    }

    .navBar {
        display: none;
        margin-left: auto;

    }

   

    ul {
    overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: $spacing-4;

        li {
            width: 100%;

            a {
                line-height: 24px;
                font-size: 16px;
                text-decoration: none;
                color: #000000;
                height: 24px;
                position: relative;
                display: inline-block;
                padding-bottom: 3px;

                @media (max-width: 1200px) {
                  height: auto;
                  line-height: 0;
                }

                &::after {
                  content: '';
                  position: absolute;
                  left: 0;
                  bottom: -4px;
                  width: 0;
                  height: 1px;
                  background-color: #000000;
                  transition: width 0.5s ease-in-out;

                  @media (max-width: 1200px) {
                    // left: -50vw;
                  }
                }

                &:hover:after {
                    width: 100%;

                //   @media (max-width: 1200px) {
                //     background-color: #176066;
                //     width: 150vw;
                // }
                }
            }
        }
    }

    .memberAction {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: $spacing-3;
    }

    

    .cartIcon {
        position: relative;
        color: $fontBlack;
        font-size: map-get($font, h5);

        &:hover {
            color: $logoYellow;
        }

        .cartCount {
            position: absolute;
            top: 8px;
            right: -8px;
            background-color: $primaryGreen;
            color: white;
            font-size: 12px;
            border-radius: 50%;
            padding: 3px 5px;

            &:first-child {
                margin-right: auto;
            }
        }
    }


.memberIconN a{
    position: relative;
    color: $fontBlack;
    font-size: map-get($font, h5);
    margin-right: 8px;
    

    &:hover {
        color: $logoYellow;
    }
}

.memberIconY{
    position: relative;
    margin-right: 8px;

    width: 30px;
    height: 30px;

    border-radius: 50%;
    border: 2px solid $logoBrown;

     &:hover {
      border: 2px solid $logoYellow;
     }

    img{
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;

         &:hover {
        opacity: 0.8;
    }
    }

}




.menuToggle {
    display: block;
    width: auto;
    margin-left: auto;
    cursor: pointer;
    z-index: 1001;
    position: relative;
}

.bar {
    width: 22px;
    height: 2.5px;
    background-color: #000;
    margin: 6px 12px;
    border-radius: 3px;
    transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.menuToggle.active .bar1 {
  transform: rotate(-45deg) translate(-6px, 6px);
}

.menuToggle.active .bar2 {
  opacity: 0;
}

.menuToggle.active .bar3 {
  transform: rotate(45deg) translate(-6px, -6px);
}

// Dropdown Menu Styles
.dropdown {
    position: fixed;
    top: 0;
    right: 0;
    width: 100vw;
    height: 100vh;
    z-index: 999;
    display: flex;
    background: transparent;

    .dropdown-overlay {
        flex: 1;
        background: rgb(230, 219, 210, 0.5);
    }

    .dropdown-content {
        width: 40%;
        height: 100%;
        background: linear-gradient(135deg, #f6eee4 0%, #ffffff 100%);
        // background-image: url('/src/assets/img/burgerBG v4.svg');
        background-size: cover;
        box-shadow: -5px 0 25px rgba(0, 0, 0, 0.15);
        overflow-y: auto;
        display: flex;
        flex-direction: column;

        @media (max-width: 1000px) {
            width: 100%;
        }

        ul {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: stretch;
            padding: 80px 0;
            margin: 0;
            list-style: none;

            li {

                // border:1px solid;

                display: block;
                opacity: 0;
                transform: translateX(30px);
                animation: slideInFromRight 0.4s ease-out forwards;

                @for $i from 1 through 7 {
                    &:nth-child(#{$i}) {
                        animation-delay: #{($i - 1) * 0.08}s;
                    }
                }

                a {
                  width: 100%;
                  align-items: center;

                    display: flex;
                    justify-content: center;
                    align-items: center;
                    text-decoration: none;
                    color: #333;
                    font-size: 20px;
                    font-weight: 500;
                    padding: 20px 30px;
                    transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
                    position: relative;
                    overflow: hidden;

                    &:hover{
                      transform: scale(1.05);
                      color: $logoDGreen;

                    }
                    
                    &::after {
                      content: '';
                      position: absolute;
                      bottom: 17.5px;
                      right: 0;
                      height: 1.5px;
                      width: 0;
                      background-color: #000;
                      transition: width 0.4s ease-in-out;
                    }

                    &:hover::after {
                      width: 38%;
                    }

                    &:active {
                        transform: translateX(-3px) scale(0.98);
                    }
                }
            }
        }
    }
}

// Vue Transition Animations
.dropdown-slide-enter-active {
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.dropdown-slide-leave-active {
    transition: all 0.3s cubic-bezier(0.55, 0.06, 0.68, 0.19);
}

.dropdown-slide-enter-from {
    opacity: 0;
    
    .dropdown-overlay {
        opacity: 0;
    }
    
    .dropdown-content {
        transform: translateX(100%);
    }
}

.dropdown-slide-leave-to {
    opacity: 0;
    
    .dropdown-overlay {
        opacity: 0;
    }
    
    .dropdown-content {
        transform: translateX(100%);
    }
}

// Keyframe Animation for Menu Items
@keyframes slideInFromRight {
    from {
        opacity: 0;
        transform: translateX(30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

// Responsive adjustments
@media (max-width: 768px) {
    .dropdown .dropdown-content {
        width: 100vw;
        
        .dropdown-overlay {
            display: none;
        }
    }
    
    .dropdown-slide-enter-from .dropdown-content,
    .dropdown-slide-leave-to .dropdown-content {
        transform: translateY(-100%);
    }
  }
}
</style>