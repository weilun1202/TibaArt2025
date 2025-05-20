<template>
  <ul class="itemList">
    <item 
      v-for="(item, index) in items" 
      :key="index" 
      :item="item"
      @add-to-cart="onAddToCart"
    />
  </ul>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';
import item from './item.vue';

const props = defineProps({
  items: {
    type: Array,
    required: true
  }
});

const emit = defineEmits(['add-to-cart']);

const onAddToCart = (item) => {
  emit('add-to-cart', item);
};
</script>