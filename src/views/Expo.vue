<template>
  <div>
    <div class="wrapper">
      <header>
        <div class="pageTitle">線上展覽</div>
      </header>
      <!-- 內容全寬，若要限制寬度再另外包 div -->
      <div class="masonry" id="masonry">
        <div
          v-for="item in items"
          :key="item.id"
          class="item"
          :style="{ height: item.height + 'px' }"
        >
          Item {{ item.id }}
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const minH = 100;
const maxH = 250;
const count = 17; // 項目個數，可依需求調整
const items = ref([]);

onMounted(() => {
  items.value = Array.from({ length: count }, (_, idx) => {
    const height = Math.floor(Math.random() * (maxH - minH + 1)) + minH;
    return {
      id: idx + 1,
      height,
    };
  });
});
</script>

<style scoped>
/* 多欄式瀑布流佈局 */
.masonry {
  column-count: 4;
  column-gap: 1rem;
  max-width: 1200px;
  margin: 0 auto;
  padding: 1rem 0;
}

.masonry .item {
  display: inline-block;
  width: 100%;
  margin-bottom: 1rem;
  background: #87ceeb;
  border-radius: 4px;
  box-sizing: border-box;
  padding: 0.5rem;
  color: #fff;
  font-size: 14px;
  text-align: center;
}
</style>
