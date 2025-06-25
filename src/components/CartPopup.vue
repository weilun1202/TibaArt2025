<template>
  <div v-if="show" class="cart-popup-overlay" @click.self="closePopup">
    <div class="cart-popup-content animate__animated animate__fadeInDown">
      <div class="popup-header">
        <button class="close-btn" @click="closePopup">&times;</button>
      </div>
      <div class="popup-body">
        <p class="item-message">
          已將「{{ item?.name }}」x {{ quantity }} 加入購物車
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router';

const props = defineProps({
  item: Object, // 接收要顯示的商品資訊
  show: Boolean, // 控制彈窗顯示/隱藏的狀態
  quantity: {
    type: Number,
    default: 1
  }
});

const emit = defineEmits(['close']); // 定義發出的事件

const router = useRouter();

const closePopup = () => {
  emit('close'); // 通知父元件關閉彈窗
};

const viewCart = () => {
  closePopup(); // 關閉彈窗
  router.push('/front/cart'); // 導向購物車頁面（根據你的路由調整）
};

</script>

<style lang="scss" scoped>
.cart-popup-overlay {
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

.cart-popup-content {
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

.success-icon {
  font-size: 2.5rem;
  color: #28a745;
  margin-bottom: 15px;
  font-weight: bold;
}

.item-message {
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

.continue-btn, .view-cart-btn {
  padding: 8px 16px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 0.9rem;
  transition: all 0.2s;
  min-width: 100px;
}

.continue-btn {
  background-color: #f8f9fa;
  color: #2F2F2F;
  border: 1px solid #dee2e6;

  &:hover {
    background-color: #e9ecef;
  }
}

.view-cart-btn {
  background-color: #2F2F2F;
  color: white;

  &:hover {
    background-color: #1a1a1a;
  }
}
</style>