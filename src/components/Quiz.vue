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
          <slot />
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

defineProps({
  title: String, 
  isOpen: Boolean, 
});

const emit = defineEmits(['update:isOpen', 'file-selected', 'click']);

const close = () => {
  emit('update:isOpen', false); 
};

const handleOverlayClick = () => {
  emit('click'); 
};

</script>

<style scoped>
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
  padding: 12px;
  border-radius: 32px;
  border: 3px solid #2F2F2F;
  max-width: 50vw;
  width: 100%;

  height: 60vh;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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
  padding: 20px 0;
}

.quiz-footer {
  border-top: 1px solid #eee;
  padding-top: 10px;
  text-align: right;
}


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
</style>