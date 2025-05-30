<template>
  <nav class="frontNav">
    <router-link to="/" @click="closeMenu"><img class="logo" src="@/assets/img/TibaArtLogo.svg" alt="" /></router-link>

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
            <li><router-link to="/front/MemLogin" @click="closeMenu">會員登入</router-link></li>
            <li><router-link to="/front/MemReg" @click="closeMenu">註冊會員</router-link></li>
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

     <!-- 購物車 -->
    <router-link to="/front/cart" class="cartIcon" @click="closeMenu">
        <font-awesome-icon :icon="['fas', 'cart-shopping']" />
        <span class="cartCount">0</span>
    </router-link>  

  </nav>
</template>

<script setup>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { useRouter } from 'vue-router'
import { ref, onMounted, onUnmounted } from 'vue';

defineProps()

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
  if (menuOpen.value) {
    document.body.style.overflow = 'hidden'
  } else {
    document.body.style.overflow = ''
  }
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
    background: transparent;

    // border:1px solid;



    .logo {
        height: 60px;
    }

    .navBar {
        display: none;
        margin-left: auto;

    }

    }

    ul {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: $spacing-4;

        li {
            margin-right: $spacing-8;

            @media (max-width: 1200px) {
                 margin-right: 0;
            }

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
                    left: -50vw;
                  }
                }

                &:hover:after {
                    width: 100%;

                  @media (max-width: 1200px) {
                    background-color: #176066;
                    width: 150vw;
                }
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
            color: $buttonYellow;
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


.menuToggle {
    display: block;
    width: auto;
    margin-left: auto;
    cursor: pointer;
    z-index: 1001;
    position: relative;
}

.bar {
    width: 26px;
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

    .dropdown-overlay {
        flex: 1;
    }

    .dropdown-content {
        width: 40%;
        height: 100%;
        background: linear-gradient(135deg, #f6eee4 0%, #ffffff 100%);
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
            padding: 80px 0 40px;
            margin: 0;
            list-style: none;

            li {
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
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    text-decoration: none;
                    color: #333;
                    font-size: 18px;
                    font-weight: 500;
                    padding: 20px 30px;
                    margin: 5px 20px;
                    transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
                    position: relative;
                    overflow: hidden;

                    &::before {
                        content: '';
                        position: absolute;
                        top: 0;
                        left: -100%;
                        width: 100%;
                        height: 100%;
                        // background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
                        transition: left 0.5s;
                    }

                    &:hover {
                        background-color: rgba(23, 96, 102, 0.1);
                        color: #176066;
                        transform: translateX(-5px);
                        box-shadow: 0 4px 15px rgba(23, 96, 102, 0.2);

                        &::before {
                            left: 100%;
                        }
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
</style>