<!-- src/components/Modal.vue -->
<template>
  <Teleport to="body">
    <Transition name="modal">
    <div v-if="isOpen" class="modal-overlay" @click="handleOverlayClick">
      <div class="modal-content" @click.stop>
          <button @click="close" class="close-button">x</button>
        <header v-if="title" class="modal-header">
          <h2>{{ title }}</h2>
        </header>
        <div class="modal-body">
          <slot />
        </div>
        <footer v-if="$slots.footer" class="modal-footer">
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
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.modal-content {
  background: white;
  padding: 12px;
  border-radius: 8px;
  max-width: 500px;
  width: 100%;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.modal-header {
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

.modal-body {
  padding: 20px 0;
}

.modal-footer {
  border-top: 1px solid #eee;
  padding-top: 10px;
  text-align: right;
}


.modal-enter-active,
.modal-leave-active {
  transition: opacity 0.3s ease;
}
.modal-enter-from,
.modal-leave-to {
  opacity: 0;
}
.modal-content {
  transition: transform 0.3s ease;
}
.modal-enter-from .modal-content,
.modal-leave-to .modal-content {
  transform: scale(2);
}
</style>