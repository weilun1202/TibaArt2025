# ※ 日期最新的在最上面 ※
每一份日誌請間隔四個 Enter

※※※※ 比較重要的搜尋 ※※※※
使用 ctrl + F 尋找
標籤命名規則
系統設計 (basic)
系統設計 (component)
系統設計 (layout)

※※※※※※ 以下更新 ※※※※※※










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
$fontWhite:#ffffff;

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