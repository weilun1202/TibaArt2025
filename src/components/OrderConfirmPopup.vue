<template>
  <div v-if="show" class="popup-overlay" @click.self="closePopup">
    <div class="popup-content animate__animated animate__fadeInDown">
      <div class="popup-header">
        <button class="close-btn" @click="closePopup">&times;</button>
      </div>
      <div class="popup-body">
        <!-- 錯誤圖示 -->
        <div class="error-icon">⚠️</div>
        
        <!-- 錯誤訊息 -->
        <p class="error-message">{{ message }}</p>
      </div>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  show: {
    type: Boolean,
    default: false
  },
  message: {
    type: String,
    default: ''
  }
});

const emit = defineEmits(['close']);

const closePopup = () => {
  emit('close');
};
</script>

<style lang="scss" scoped>
.popup-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(230, 219, 210, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.popup-content {
  background: linear-gradient(to top, #f6eee4, #ffffff);
  padding: 20px;
  border-radius: 12px;
  border: 1.6px solid #2F2F2F;
  max-width: 400px;
  width: 90%;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
  position: relative;

  @media (max-width: 700px) {
    max-width: 320px;
    padding: 16px;
  }
}

.popup-header {
  position: relative;
  margin-bottom: 10px;
}

.close-btn {
  background: none;
  border: none;
  font-size: 1.5rem;
  cursor: pointer;
  position: absolute;
  top: -10px;
  right: -10px;
  color: #666;
  padding: 5px;
  border-radius: 50%;
  width: 30px;
  height: 30px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background-color 0.2s;

  &:hover {
    background-color: #f0f0f0;
  }
}

.popup-body {
  text-align: center;
  line-height: 1.5;
}

.error-icon {
  font-size: 2.5rem;
  margin-bottom: 15px;
}

.error-message {
  font-size: 1.1rem;
  color: #2F2F2F;
  margin: 15px 0 20px 0;
  font-weight: 500;
}

.popup-actions {
  display: flex;
  justify-content: center;
  margin-top: 20px;
}

.confirm-btn {
  padding: 8px 20px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 0.9rem;
  transition: all 0.2s;
  min-width: 100px;
  background-color: #2F2F2F;
  color: white;

  &:hover {
    background-color: #1a1a1a;
  }
}
</style>