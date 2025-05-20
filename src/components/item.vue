<template>
  <li class="item">
    <router-link :to="{ name: 'product', params: { id: item.id } }" class="itemImage">
      <img :src="item.image" :alt="item.name">
    </router-link>
    <div class="itemInfo">
      <div class="itemDetails">
        <div class="itemName">{{ item.name }}</div>
        <div class="itemPrice">NT$ {{ item.price }}</div>
      </div>
      <div class="itemActions">
        <button type="button" class="btn" @click="addToCart">加入購物車</button>
      </div>
    </div>
  </li>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
  item: {
    type: Object,
    required: true
  }
});

const emit = defineEmits(['add-to-cart']);

const addToCart = () => {
  emit('add-to-cart', props.item);
};
</script>