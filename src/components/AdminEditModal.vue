<template>
  <transition name="fade">
     <div v-if="show" class="modal-overlay" @click.self="emit('close')">
      <div class="modal-content">
        <h3>{{ title }}</h3>

        <div v-for="field in fields" :key="field.key" class="field">
          <label>{{ field.label }}：</label>

          <!-- 多行文字欄位 -->
          <textarea
            v-if="field.type === 'textarea'"
            v-model="editableData[field.key]"
            @input="autoResize($event)"
            ref="textareas"
            class="textarea-auto"
          ></textarea>

          <!-- 檔案欄位 -->
          <div v-else-if="field.type === 'file'">
            <input type="file" @change="handleFileUpload" />
            <img v-if="previewUrl" :src="previewUrl" class="preview" />
          </div>

          <!-- 一般欄位 -->
          <input v-else v-model="editableData[field.key]" />

        </div>

        <div class="btn-content">
          <button class="btn" @click="submit">送出</button>
          <button class="btn" @click="emit('close')">取消</button>
        </div>
      </div>
    </div>
  </transition>
</template>


<script setup>

import { ref, watch, nextTick } from 'vue'

const props = defineProps({
  show: Boolean,
  title: String,
  data: Object,
  fields: Array
})

const emit = defineEmits(['close', 'update']) // 由父層接手提交行為

const editableData = ref({})
const imageFile = ref(null)
const previewUrl = ref('')
const textareas = ref([])

// 若預設資料一開始就很長，自動調整一次
function autoResize(event) {
  const textarea = event.target
  textarea.style.height = 'auto'
  textarea.style.height = textarea.scrollHeight + 'px'
}

watch(() => props.data, () => {
  editableData.value = { ...props.data }

  const imgField = props.fields.find(f => f.type === 'file')
  previewUrl.value = imgField ? props.data[imgField.key] : ''

  nextTick(() => {
    textareas.value.forEach(t => {
      if (t) {
        t.style.height = 'auto'
        t.style.height = t.scrollHeight + 'px'
      }
    })
  })
})

// 待修正
function handleFileUpload(e) {
  imageFile.value = e.target.files[0]
  if (imageFile.value) {
    previewUrl.value = imageFile.value
  }
}

function submit() {
  const formData = new FormData()
  for (const key in editableData.value) {
    formData.append(key, editableData.value[key])
  }

  // 有圖片才加上
  if (imageFile.value) {
    const fileField = props.fields.find(f => f.type === 'file')
    if (fileField) formData.append(fileField.key, imageFile.value)
  }

  emit('update', formData, editableData.value.id)
}

</script>

<style lang="scss" scoped>
@import '/style.scss';

.fade-enter-active, .fade-leave-active {
  transition: opacity 0.3s ease;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,0.6);
  display: flex;
  align-items: center;
  justify-content: center;
}
.modal-content {
  background: white;
  width: 50%;
  h3{
    font-size: 24px;
    background-color: $primaryGreen;
    padding: $spacing-4;
    color: #FFF;
  }
  .field{
    display: flex;
    flex-direction: column;
    padding: $spacing-3;
    gap: $spacing-1;

    input{
      height: 32px;
      font-size: 16px;
    }

  }

  .btn-content{
    display: flex;
    gap: $spacing-3;
    justify-content: center;
    padding: $spacing-3;
  }
  .textarea-auto {
  width: 100%;
  min-height: 60px;
  padding: 8px;
  font-size: 16px;
  resize: none;
  overflow: hidden;
}
}
</style>
