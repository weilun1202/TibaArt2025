# ※ 日期最新的在最上面 ※
每一份日誌請間隔四個 Enter

※※※※ 比較重要的搜尋 ※※※※
使用 ctrl + F 尋找
vue3 開發目前遇到的狀況(5/22)
標籤命名規則
系統設計 (basic)
系統設計 (component)
系統設計 (layout)

※※※※※※ 以下更新 ※※※※※※
# 日期：2025 / 6 / 24
## 更新者：偉倫
## 項目：修改 Application.vue
新增 空白申請書




# 日期：2025 / 6 / 19
## 更新者：偉倫
## 項目：由 expoArea 進入贊助頁面時，自動帶入選項
混淆 useRouter 和 useRoute
useRouter：讀取目前的路由資訊（URL參數、query、path等）
useRoute：用來做程式導航（跳頁、前進/後退）




# 日期：2025 / 6 / 18
## 更新者：偉倫
## 項目：
修改贊助成功頁面，贊助編號顯示在頁面上




# 日期：2025 / 6 / 14
## 更新者：偉倫
## 項目：開發目前遇到的狀況
贊助藝術家頁面 會員可以自動帶入 姓名、信箱
              動態新增展覽選項




# 日期：2025 / 6 / 11
## 更新者：偉倫
## 項目：開發目前遇到的狀況

贊助藝術家頁面 可以串接到綠界(已經在中心伺服器測試)
線上商城頁面 可以串到綠界
加入會員(成功)



# 日期：2025 / 6 / 07
## 更新者：偉倫
## 項目：圖片路徑問題

js 裡的圖片路徑要加上 → imgSrc: import.meta.env.BASE_URL +..
Vue3 裡的圖片路徑要改成 → /public/assets/img/..
需要多張圖片渲染到template
原本 <img src="/tjd101/g2/assets/img/expoArea-artwork1.png" alt="">
改成 <img :src="imgUrl" alt="">
    <script setup>
    // 自動使用 base 設定，這樣在 dev 和 build 都正確
        const imgUrl = import.meta.env.BASE_URL + 'assets/img/expoArea-artwork1.png'
    </script>




# 日期：2025 / 6 / 04 
## 更新者：偉倫
## 項目：團專期中報告(改進方向)

所在位置需要粗體，讓使用者知道現在身處網站的哪裡
RWD 斷點需要新增
線上展覽 圖片檔過大，建議圖片大小壓縮，並且使用Lazy Loarding
關於我們 大事紀 需要 scroll 滾動方向提示
首頁 提示文字建議改成跟隨滑鼠移動
後台 表格寬度一致




# 日期：2025 / 6 / 02 
## 更新者：偉倫
## 項目：開發目前遇到的狀況 (總結)

FTP 路徑初步建立
首頁 GSAP 完成
後台 會員表格完成




# 日期：2025 / 06 / 01
## 更新者：偉倫
## 項目：開發目前遇到的狀況 (總結)

前後端分離，分別新建frontend、backend，避免前端建立的 nav 影響後端架構
商品頁以 json 檔串接
開始進行全斷點 RWD



# 日期：2025 / 05 / 29
## 更新者：偉倫
## 項目：

#### style.css.map 衝突 → 寫進 .gitignore
因為每位組員的 style.css.map 都不一樣，常常在 Pull 時會造成衝突
所以需要把 style.css.map 寫進 .gitignore




# 日期：2025 / 05 / 22
## 更新者：偉倫
## 項目：vue3 開發目前遇到的狀況(5/22)

### 重新整理跑版 → 檔名問題
位於src > views > Application.vue 在重新整理後，讀取到最上層的 application.html
把 application.html 改名或刪除即可

#### 重複 footer → 重複引入

#### wrapper 跑版 → class 重複命名

#### FortAwesome icon 引用 (※ 重要)
必須先到 src > mani.js import

例如：
// Font Awesome 相關導入
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

// 把需要的 icon 加進 library
library.add(faMagnifyingGlass);




# 日期：2025 / 05 / 18
## 更新者：偉倫
## 項目：標籤命名規則

舉例：
id="footer"
class="aboutTitleBtn"

## 項目：圖片命名規則
aboutBanner_01
aboutBanner_02




# 日期：2025 / 05 / 18
## 更新者：偉倫
## 項目：系統設計 (component)

#### 按鈕 btn
普通按鈕 有 @mixin

申請檔範例、上傳 的 applicationBtn 的 margin:20px 只是為了不進貼標題
上傳 uploadBtn：如果按照 Figma 的數值，會和 申請檔範例 按鈕不一致，所以有進行更改

#### 表單 form
第一組表單我還沒研究出讓必填穩定出現 input 下方
所以我試著做一組嶄新的表單，這組表單可以跳出格式錯誤等訊息，必填改用「*」放在文字的旁邊

#### 頁籤 tab
商店頁籤 有 @mixin，但是碰觸時會變形，沒修好，使用時請注意！




# 日期：2025 / 05 / 18
## 更新者：偉倫
## 項目：系統設計 (basic)

### 主色 olor
$primaryGreen :  #29786A;

### 網頁文字顏色
$fontBlack: #2F2F2F;

### 白色
$fontWhite: #ffffff;

### 按鈕碰觸
$buttonYellow: #E4C600;

### 申請按鈕 (上傳下載)
$fontdownload: #2D7DA1;

### 警示
$fontWarn: #C34E4E;

### logo color
$logoColor1 : #DB5C28;
$logoColor2 : #297868;
$logoColor3 : #176066;
$logoColor4 : #163F52;
$logoColor5 : #402E1E;
$logoColor6 : #EAA424;

------------------------

### font 字體大小
$bodyfont : 16px;   // basicfont

### 使用方式： font-size: map-get($font, h1);
$font:(
    h1 : 3rem,     // 48px 頁面主標題
    h2 : 2.5rem,   // 40px 區塊標題
    h3 : 2rem,     // 32px 卡片標題
    h4 : 1.5rem,   // 24px 內文標題
    h5 : 1.25rem,  // 20px 表單標題
    p : 1rem,      // 16px 內文
    pwar: 0.75rem  // 12px 提示自
);

### 字型
$fontEG:'Noto Serif TC';
$fontTC:'微軟正黑體';
$fontJP:'游ゴシック体';

------------------------

### spacing 空間 + border-radius 圓角 + pandding + margin
$spacing-1 : 4px;
$spacing-2 : 8px;
$spacing-3 : 12px;
$spacing-4 : 16px;
$spacing-5 : 20px;
$spacing-6 : 24px;
$spacing-7 : 28px;
$spacing-8 : 32px;