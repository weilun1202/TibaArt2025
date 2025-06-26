<template>
  <div v-if="show" class="remove-popup-overlay" @click.self="closePopup">
    <div class="remove-popup-content animate__animated animate__fadeInDown">
      <div class="popup-header">
        <button class="close-btn" @click="closePopup">&times;</button>
      </div>
      <div class="popup-body">
        <p class="remove-message">
          確定要移除「{{ item?.name }}」嗎？
        </p>
        <div class="popup-actions">
          <button class="confirm-btn" @click="confirmRemove">確定移除</button>
          <button class="cancel-btn" @click="closePopup">取消</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  item: Object, // 接收要移除的商品資訊
  show: Boolean, // 控制彈窗顯示/隱藏的狀態
});

const emit = defineEmits(['close', 'confirm']); // 定義發出的事件

const closePopup = () => {
  emit('close'); // 通知父元件關閉彈窗
};

const confirmRemove = () => {
  emit('confirm', props.item?.id); // 通知父元件確認移除
  closePopup(); // 關閉彈窗
};
</script>

<style lang="scss" scoped>
@import '/style.scss';

.remove-popup-overlay {
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

.remove-popup-content {
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

.remove-message {
  font-size: 1.1rem;
  color: #2F2F2F;
  margin: 15px 0 20px 0;
  font-weight: 500;
}

.popup-actions {
  display: flex;
  gap: 10px;
  justify-content: center;
  margin-top: 20px;

  @media (max-width: 400px) {
    flex-direction: column;
  }
}

.cancel-btn, .confirm-btn {
  padding: 8px 16px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 0.9rem;
  transition: all 0.2s;
  min-width: 100px;
}

.cancel-btn {
  background-color: $fontWhite;
  color: $fontBlack;
  border: 1px solid $primaryGreen;
  &:hover {
    background-color: #e9ecef;
  }
}

.confirm-btn {
  background-color: $primaryGreen;
  color: $fontWhite;

  &:hover {
    background-color: $buttonYellow;
  }
}
</style>