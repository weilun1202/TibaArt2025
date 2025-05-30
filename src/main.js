// Vue 專案內建樣式，先註解掉，避免被影響
// import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import 'animate.css'

import App from './App.vue'
import router from './router'


// Font Awesome 相關導入
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faCartShopping } from '@fortawesome/free-solid-svg-icons'
import { faMagnifyingGlass } from '@fortawesome/free-solid-svg-icons'
import { faGoogle } from '@fortawesome/free-brands-svg-icons'
import { faFacebook } from '@fortawesome/free-brands-svg-icons'
import { faGlobe } from '@fortawesome/free-solid-svg-icons'
import { faInstagram, faBehance } from '@fortawesome/free-brands-svg-icons'
import { faFileArrowDown, faCloudArrowUp } from '@fortawesome/free-solid-svg-icons'
import { faPlus } from '@fortawesome/free-solid-svg-icons'
import { faMinus } from '@fortawesome/free-solid-svg-icons'


// 把需要的 icon 加進 library
library.add(faCartShopping);
library.add(faMagnifyingGlass);
library.add(faGoogle);
library.add(faFacebook);
library.add(faGlobe);
library.add(faInstagram, faBehance);
library.add(faCloudArrowUp);
library.add(faFileArrowDown);
library.add(faPlus);
library.add(faMinus)



const app = createApp(App)
app.component('font-awesome-icon', FontAwesomeIcon)  // 註冊元件


app.use(createPinia())
app.use(router)

app.mount('#app')
