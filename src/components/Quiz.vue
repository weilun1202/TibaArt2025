<!-- src/components/Modal.vue -->
<template>
  <Teleport to="body">
    <Transition name="quiz">
    <div v-if="isOpen" class="quiz-overlay" @click="handleOverlayClick">
      <div class="quiz-content" @click.stop>
          <button @click="close" class="close-button">x</button>
        <header v-if="title" class="quiz-header">
          <h2>{{ title }}</h2>
        </header>
        <div class="quiz-body">
          <div class="quiz-body">
            <div class="QAcontainer" v-if="!quizCompleted">
              <img :src="currentQuestion.image" class="quiz-image">
              <h3>{{ currentQuestionIndex + 1 }}. {{ currentQuestion.question }}</h3>
                
              <div class="options-container">
                <button
                  v-for="option in currentQuestion.options"
                  :key="option"
                  @click="selectAnswer(option)"
                  class="quiz-option-button"
                >
                  {{ option }}
                </button>
              </div>
            </div>

            <div v-else class="result-container">
              <h3>測驗結果</h3>
              <p>你的分數是：{{ score }} / 100</p>
              <p>{{ getResultDescription }}</p>
              <div class="resultBtns">
                <button @click="resetQuiz" class="footerbtn reset-quiz-button">重新開始</button>
                <button @click="quitQuiz" class="footerbtn quit-quiz-button">結束測驗</button>
              </div>
            </div>
          </div>
          <!-- <slot /> -->
        </div>
        <footer v-if="$slots.footer" class="quiz-footer">
          <slot name="footer" />
        </footer>
      </div>
    </div>
    </Transition>
  </Teleport>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';
import { ref, computed } from 'vue';

defineProps({
  title: String, 
  isOpen: Boolean, 
});

const emit = defineEmits(['update:isOpen', 'file-selected', 'click']);

// const handleOverlayClick = () => {
//   emit('click'); 
// };

import image1 from '@/assets/img/aboutBanner.jpg'

const currentQuestionIndex = ref(0);
const userAnswers = ref([]);
const score = ref(0);
const quizCompleted = ref(false);

// 計算當前顯示的問題
const currentQuestion = computed(() => quizQuestions[currentQuestionIndex.value]);

// const import_image = (asset_url)=>{
//   return new URL('@/'+asset_url,import.meta.url).href
// }
const quizQuestions = [
  {
    id: 1,
    image: new URL('@/assets/img/aboutBanner.jpg',import.meta.url).href,
    // image:image1,
    // image:import_image('assets/img/aboutBanner.jpg'),
    question: '緯藝基金會創立於西元幾年？',
    options: ['1920', '1925', '1930', '1935'],
    answer: '1925'
  },
  {
    id: 2,
    image: new URL('@/assets/img/about-2000.png',import.meta.url).href,
    // image: './src/assets/img/about-2000.png',
    question: '1953年，緯藝與哪國水彩大會合辦「青年藝術家交流展」？',
    options: ['美國', '法國', '日本', '德國'],
    answer: '日本'
  },
  {
    id: 3,
    image: new URL('@/assets/img/monet.jpg',import.meta.url).href,
    // image: './src/assets/img/monet.jpg',
    question: '印象派的代表畫家是誰？',
    options: ['莫內', '達利', '安迪・沃荷', '高更'],
    answer: '莫內'
  },
  {
    id: 4,
    image: new URL('@/assets/img/Mona_Lisa.webp',import.meta.url).href,
    // image: './src/assets/img/Mona_Lisa.webp',
    question: '蒙娜麗莎的微笑是哪位藝術家的作品？',
    options: ['達文西', '梵谷', '畢卡索', '米開朗基羅'],
    answer: '達文西'
  },
  {
    id: 5,
    image: new URL('@/assets/img/dora_maar.jpg',import.meta.url).href,
    // image: './src/assets/img/dora_maar.jpg',
    question: '下列哪一項是畢卡索所創的藝術風格？',
    options: ['超現實主義', '立體主義', '印象派', '表現主義'],
    answer: '立體主義'
  },
  {
    id: 6,
    image: new URL('@/assets/img/dali.webp',import.meta.url).href,
    // image: './src/assets/img/dali.webp',
    question: '下列哪位藝術家以「融化的時鐘」而聞名？',
    options: ['馬蒂斯', '達利', '波提切利', '高第'],
    answer: '達利'
  },
  {
    id: 7,
    image: new URL('@/assets/img/van.png',import.meta.url).href,
    // image: './src/assets/img/van.png',
    question: '「星夜」這幅作品是出自哪位畫家之手？',
    options: ['莫內', '梵谷', '雷諾瓦', '秀拉'],
    answer: '梵谷'
  },
  {
    id: 8,
    image: new URL('@/assets/img/sixtin.avif',import.meta.url).href,
    // image: './src/assets/img/sixtin.avif',
    question: '米開朗基羅參與設計並繪製了哪座教堂的天頂畫？',
    options: ['巴黎聖母院', '梵蒂岡聖彼得大教堂', '威尼斯聖馬可大教堂', '梵蒂岡西斯汀禮拜堂'],
    answer: '梵蒂岡西斯汀禮拜堂'
  },
  {
    id: 9,
    image: new URL('@/assets/img/Andy.jpg',import.meta.url).href,
    // image: './src/assets/img/Andy.jpg',
    question: '安迪・沃荷是哪個藝術運動的代表人物？',
    options: ['現代主義', '達達主義', '普普藝術', '文藝復興'],
    answer: '普普藝術'
  },
  {
    id: 10,
    image: new URL('@/assets/img/ba_eaten.jpg',import.meta.url).href,
    // image: './src/assets/img/ba_eaten.jpg',
    question: '2019年，義大利藝術家毛里齊奧．卡泰蘭（Maurizio Cattelan）以一根香蕉和一條銀色膠帶創作了名為《喜劇演員》（Comedian）的作品，以下哪位不是後來把它吃掉的人？',
    options: ['藝術系學生盧賢秀（Noh Huyn-soo）', '加密貨幣企業家孫宇晨（Justin Sun）', '緯藝基金會執行長', '行為藝術家大衛・達圖納（David Datuna）'],
    answer: '緯藝基金會執行長'
  }
];

const selectAnswer = (selectedOption) => {
  userAnswers.value.push({
    questionId: currentQuestion.value.id,
    selectedOption: selectedOption
  });

  if (currentQuestionIndex.value < quizQuestions.length - 1) {
    currentQuestionIndex.value++;
  } else {
    calculateResult();
  }
};

const calculateResult = () => {
  score.value = 0;
  userAnswers.value.forEach(answer => {
    const question = quizQuestions.find(q => q.id === answer.questionId);
    if (question && question.answer === answer.selectedOption) {
      score.value += 10; // 每題 10 分，共 100 分
    }
  });
  quizCompleted.value = true;
};

const getResultDescription = computed(() => {
  const result = resultDescriptions.find(range => score.value >= range.scoreRange[0] && score.value <= range.scoreRange[1]);
  return result ? result.description : '沒有找到對應的描述。';
});

const resetQuiz = () => {
  currentQuestionIndex.value = 0;
  userAnswers.value = [];
  score.value = 0;
  quizCompleted.value = false;
};

const quitQuiz = () => {
  resetQuiz();
  emit('update:isOpen', false); 
}

const close = () => {
  resetQuiz();
  emit('update:isOpen', false); 
};

const resultDescriptions = [
  { scoreRange: [0, 20], description: '你對藝術的了解還有很大的進步空間，多看看藝術展覽吧！' },
  { scoreRange: [21, 40], description: '不錯的開始！你對藝術有一些基本認識。' },
  { scoreRange: [41, 60], description: '表現良好！你對藝術有不錯的掌握。' },
  { scoreRange: [61, 80], description: '你是一位藝術愛好者，知識豐富！' },
  { scoreRange: [81, 100], description: '太棒了！你是一位藝術大師！' },
  // ... 你可以根據分數區間定義更多詳細的描述
];


</script>

<style lang="scss" scoped>
.quiz-overlay { 
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgb(230, 219, 210, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.quiz-content {
  background:linear-gradient(to top, #f6eee4, #ffffff);
  padding: 20px;
  border-radius: 32px;
  border: 3px solid #2F2F2F;
  max-width: 50vw;
  width: 100%;

  height: auto;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);

  @media (max-width:700px){
    max-width: 70vw;
  }

  @media (max-width:500px){
    max-width: 80vw;
  }

  @media (max-width:400px){
    max-width: 90vw;
  }



}

.quiz-header {
  display: flex;
  justify-content: center;
  align-items: center;
  border-bottom: 1px solid #eee;
  padding: 0 0 20px;
  font-size: 18px;
  font-weight: 450;

  height: auto;
  /* border: 1px solid;; */
}

.close-button {
  display: block;
  margin-left: auto;
  background: none;
  border: none;
  font-size: 1.05rem;
  cursor: pointer;
}

.quiz-body {
  padding: 8px;
  text-align: center;

  line-height: 1.3;
}

.QAcontainer{
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.options-container{

  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 4px;

  button{
    height: 24px;
    line-height: 24px;
    background-color: #2f2f2f;
    border: none;
    border-radius: 8px;
    color: #fff;
    cursor: pointer;
    padding: 0 16px;
    text-align: center;
  }
}

.result-container{
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 16px;
}

.resultBtns{
  display: flex;
  gap: 8px;
}

.footerbtn{
  height: 24px;
    line-height: 24px;
    background-color: #2f2f2f;
    border: none;
    border-radius: 8px;
    color: #fff;
    cursor: pointer;
    padding: 0 16px;
    text-align: center;
}


// .quiz-footer {
//   border-top: 1px solid #eee;
//   padding-top: 10px;
//   text-align: right;
// }


.quiz-enter-active,
.quiz-leave-active {
  transition: opacity 0.3s ease;
}
.quiz-enter-from,
.quiz-leave-to {
  opacity: 0;
}
.quiz-content {
  transition: transform 0.3s ease;
}
.quiz-enter-from .quiz-content,
.quiz-leave-to .quiz-content {
  transform: scale(0.8);
}


.quiz-image{
  display: block;
  margin: 0 auto;
  width: 30%;
  aspect-ratio: 1/1;
  border: 1.5px solid #2F2F2F; 
  border-radius: 50%;
  object-fit: cover;

  @media (max-width:1000px){
    width: 35%;
  }

  @media (max-width:700px){
    width: 40%;
  }

  @media (max-width:500px){
    width: 45%;
  }

  @media (max-width:400px){
    width: 50%;
  }



}


</style>