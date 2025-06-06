<template>
  <div>
    <div class="wrapper">
      <header class="animate__animated animate__flipInX">
        <div class="pageTitle">贊助藝術家</div>
      </header>
      <!-- Wrapper 不設 1200px 寬（例如展覽、關於我們頁面應該會滿版），想要限制內容在 1200 的再自己包一個 div 限制 1200  -->
      <!-- 以下供大家編輯 -->
      
      <div class="wrap">

        <div class="formA donateForm">

          <div class="formGroup">

            <div class="donateItem">
              欲贊助之展覽
            </div>
            <select id="artist_id" name="artist_id" v-model="subject" @change="errors.subject = ''">
            <option v-for="expo in expoList" :value="expo.id" :key="expo.id">{{ expo.title }}</option>
              <option value="">請選擇</option>
              <option value="expo1">《 靜界焰光 》</option>
              <option value="expo2">《 雪白世界 》</option>
              <option value="expo3">《 白陽落櫻 》</option>
              <option value="expo4">《 撕裂極光 》</option>
            </select>
            <span class="formError" v-show="true">{{ errors.subject ? errors.subject : '\u00A0' }}</span>

          </div>

          <div class="formGroup">

            <div class="donateItem">
              贊助金額
            </div>
            <div class="formCostChoice">
              <div class="formCostChoiceBtn">
                <button
                  class="btn"
                  v-for="(amount, index) in amounts"
                  :key="index"
                  @click="selectAmount(amount)"
                >
                  {{ amount }} 元
                </button>
              </div>
              <label for="cost" class="formLabel">
                新臺幣
                <span class="formHint">*</span>
              </label>
              <input
                type="text"
                id="amount"
                name="amount"
                placeholder="請選擇或輸入金額"
                v-model="selectedAmount"
              />
              <span class="formError" v-show="true">{{ errors.amount ? errors.amount : '\u00A0' }}</span>
            </div>

          </div>

          <div class="formGroup">

            <div class="donateItem">
              贊助人資料
            </div>
            <label for="name" class="formLabel">
              姓名<span class="formHint">*</span>
            </label>
            <input
              type="text"
              id="name"
              name="name"
              placeholder="請輸入姓名"
              v-model="name"
              @input="errors.name = ''"
            />
            <span class="formError" v-show="true">{{ errors.name ? errors.name : '\u00A0' }}</span>

          </div>
            
          <div class="formGroup">

            <label for="email" class="formLabel">
              帳號 (信箱)<span class="formHint">*</span>
            </label>
            <div class="formReceipt">收據將以電子郵件方式寄出</div><!-- name="email" "share" ?-->
            <input
              type="text"
              id="email"
              name="email"
              placeholder="請輸入電子郵件"
              v-model="email"
              @input="errors.email = ''"
            />
            <span class="formError" v-show="true">{{ errors.email ? errors.email : '\u00A0' }}</span>

          </div>

          <div class="formGroup">

            <label class="formLabel">
              付款方式
            </label>
            <button type="button" class="btn formDonate" @click="handleSubmit">
              立刻贊助
            </button>
            
          </div>
          <div class="ecpayBtn">
          </div>
          <img src="@/assets/img/ecpay_logo.svg" alt="ecpay_logo.svg">

          <br>

          
            
        </div>
        

        <!-- ================================================== -->
        <div class="faq">
          <div class="donateItem">
            常見問題
          </div>

          <!-- 1 -->
          <div class="faqItem">
            <input type="checkbox" id="faqCheckbox-1" name="faq" class="faqToggle">

            <label class="faqTitle" for="faqCheckbox-1">
              <h4>贊助時間有限制嗎？</h4>

              <span class="materialIcons">
                <font-awesome-icon :icon="['fas', 'plus']" />
                <font-awesome-icon :icon="['fas', 'minus']" />
              </span>

            </label>

            <div class="faqText">
              <p>只要作品還在網頁上，都可以進行贊助。</p>
            </div>
          </div>

          <!-- 2 -->
          <div class="faqItem">
            <input type="checkbox" id="faqCheckbox-2" name="faq" class="faqToggle">

            <label class="faqTitle" for="faqCheckbox-2">
              <h4>我人不在台灣/不是台灣人可以贊助嗎？</h4>

              <span class="materialIcons">
                <font-awesome-icon :icon="['fas', 'plus']" />
                <font-awesome-icon :icon="['fas', 'minus']" />
              </span>

            </label>

            <div class="faqText">
              <p>可以。</p>
            </div>
          </div>

          <!-- 3 -->
          <div class="faqItem">
            <input type="checkbox" id="faqCheckbox-3" name="faq" class="faqToggle">

            <label class="faqTitle" for="faqCheckbox-3">
              <h4>我想要贊助，可以透過哪些方式呢？</h4>

              <span class="materialIcons">
                <font-awesome-icon :icon="['fas', 'plus']" />
                <font-awesome-icon :icon="['fas', 'minus']" />
              </span>

            </label>

            <div class="faqText">
              <p>目前有提供綠界。</p>
            </div>
          </div>

          <!-- 4 -->
          <div class="faqItem">
            <input type="checkbox" id="faqCheckbox-4" name="faq" class="faqToggle">

            <label class="faqTitle" for="faqCheckbox-4">
              <h4>我想取消贊助或退款，該怎麼做？</h4>
              <span class="materialIcons">
                <font-awesome-icon :icon="['fas', 'plus']" />
                <font-awesome-icon :icon="['fas', 'minus']" />
              </span>
            </label>

            <div class="faqText">
              <p>請使用本公司的「聯絡我們」，我們會與您聯繫。</p>
            </div>
          </div>

          <!-- 5 -->
          <div class="faqItem">
            <input type="checkbox" id="faqCheckbox-5" name="faq" class="faqToggle">

            <label class="faqTitle" for="faqCheckbox-5">
              <h4>贊助計畫會有收據嗎？</h4>
              <span class="materialIcons">
                <font-awesome-icon :icon="['fas', 'plus']" />
                <font-awesome-icon :icon="['fas', 'minus']" />
              </span>
            </label>

            <div class="faqText">
              <p>贊助後，您會收到由緯藝基金會合作的金流公司所寄出的 Email 收款證明，此證明並非電子發票。</p>
            </div>
          </div>


        </div>


      </div>


    </div>

  </div>

</template>

<script setup>
  import { ref } from 'vue'
  import { useRouter } from 'vue-router'

  const router = useRouter()

  // 登入狀態，從 Vuex、Pinia、cookie 取得
  // const isLoggedIn = ref(false)
  // const expoList = ref([
  //   { id: 'expo1', title: '《 靜界焰光 》' },
  //   { id: 'expo2', title: '《 雪白世界 》' },
  //   { id: 'expo3', title: '《 白陽落櫻 》' },
  //   { id: 'expo4', title: '《 撕裂極光 》' }
  // ])

  // 表單資料
  const subject = ref('')                  // 展覽選項
  const amounts = [500, 1000, 1500, 2000]  // 所有金額選項
  const selectedAmount = ref('')           // 被選擇的金額
  const name = ref('')                     // 贊助人名字
  const email = ref('')                    // 電子郵件
  // 錯誤訊息狀態
  const errors = ref({
    subject: '',
    amount: '',
    name: '',
    email: ''
  })

  // 點擊按鈕時設定金額
  function selectAmount(amount) {
    selectedAmount.value = amount
    errors.value.amount = '' // 清除錯誤
  }


  // 驗證資料是否有誤
  function validateForm() {
    errors.value = {
      subject: '',
      amount: '',
      name: '',
      email: ''
    }
    

    if (!subject.value) {
      errors.value.subject = '請選擇一個展覽'
    }

    if (!name.value.trim()) {
      errors.value.name = '姓名為必填'
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    if (!emailRegex.test(email.value)) {
      errors.value.email = 'Email 格式不正確'
    }

    if (!selectedAmount.value) {
      errors.value.amount = '請選擇或輸入金額'
      isValid = false
    } else if (!/^\d+$/.test(selectedAmount.value)) {
      errors.value.amount = '金額必須為數字'
      isValid = false
    }

    // return Object.keys(errors.value).length === 0
    return Object.values(errors.value).every(error => error === '')
  }

function handleSubmit(e) {         // 把資料送去綠界
    e.preventDefault()
    if (validateForm()) {
        const formData = new FormData()
        // formData.append('subject', subject.value)
        // formData.append('amount', selectedAmount.value)
        // formData.append('name', name.value)
        // formData.append('email', email.value)

        formData.append('artist_id', subject.value) // subject 是展覽選項，可以理解為 artist_id
        formData.append('amount', selectedAmount.value)
        formData.append('member_id', name.value)
        formData.append('email', email.value)

        fetch('http://localhost/test2/checkoutdonate.php', {
        // fetch('https://tibamef2e.com/tjd101/g2/checkoutdonate.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(html => {
            // 從 PHP 回傳的綠界表單插入並提交
            const formWrapper = document.createElement('div')
            formWrapper.innerHTML = html
            document.body.appendChild(formWrapper)
            formWrapper.querySelector('form').submit()
        })
        .catch(err => {
            console.error('傳送失敗', err)
            alert('贊助失敗，請稍後再試')
        })
    }
}

</script>

<style lang="scss" scoped>
/* 可以把額外的 CSS 加在這裡或保留在全域 */
@import '/style.scss';


.faq{
  margin-bottom: 120px;
}

.formGroup .formError{
  display: block;
  min-height: 1.2em;
  color: #C34E4E;
  font-size: map-get($font, pwar);
  margin-top: 4px;
  .formCostChoice{
    .formCostChoiceBtn{
      .btn.first-child{
        width: 102px; 
        font-weight: bolder;
      }
    }
  }
}
.formError{
  font-weight: bold;
}

.formCostChoice{
  .btn{
    margin: 0 8px;
  }
}
.formLabel{
  margin-top: 10px;
}
.ecpayBtn{
  margin: 0;
  display: flex;
  justify-content: center; /* 水平置中 */
  align-items: center;     /* 垂直置中（若有高度） */
  // background-color: #fcfbf7;
}

.donateForm img{
  display: block;
  margin: 20px auto;
}
.faqText{
  line-height: 1.6;
}
@media screen and (max-width: 700px){
  .btn{
    font-size: 1.25rem;
    line-height: 48px;
  }
}
@media screen and (max-width: 540px) {
  .formA{
    .formGroup{
      width: 390px;
    }
    input[type="text"],
    input[type="tel"],
    select{
      width: 100%;
    }
    #cost{
      width: 390px;
    }
    .formCostChoice{
      margin: 0 auto;
    }
    .formReceipt{
      display: block;
      text-align: left;
      width: 360px;
    }
    .formCostChoiceBtn{
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      gap: 8px;
      .btn:first-child{
        width: 102px;
      }
    }
  }
  .faq{
    width: 390px;
  }
  .faqItem{
    width: 390px;
  }
}
@media screen and (max-width: 430px){
  .formA{
    width: 350px;
    .formGroup{
      width: 350px;
    }
    #cost{
      width: 350px;
    }
    .formCostChoiceBtn{
      justify-content: space-evenly
      // flex-wrap: wrap;
    }
  }
  .faq{
    width: 350px;
  }
  .faqItem{
    width: 330px;
    text-align: left;
  }
}
@media screen and (max-width: 400px){
  .formA{
    width: 320px;
    .formGroup{
      width: 320px;
    }
    .formReceipt{
      width: 200px;
    }
    input[type="text"],
    input[type="tel"],
    select{
      width: 100%;
    }
    #cost{
      width: 320px;
    }
  }
  .donateForm{
    width: 280px;
  }
  .faq{
    width: 280px;
  }
}

</style>

