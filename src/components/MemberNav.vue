<template>
  <div class="memSideDiv">
    <div class="memSideCon">
        <div class="memAvatarDiv">
            <div class="avatarUploaded uploadedUrl image-uploaded" v-if="uploadedUrl">
              <img class="memAvatar" :src="uploadedUrl" alt="">
            </div>
            <div>
              <button class="avatarUpload" @click="openModal">上傳照片</button>
              <Modal v-model:isOpen="showModal" title="上傳圖片" @file-selected="handleFileSelected">
                <div class="modalDIY">
                  <p class="modalText">選擇欲上傳的照片</p>
                  <input type="file" accept="image/*" @change="handleFileChange" name="" id="" >
                  <div class="avatarPreview image-preview" v-if="previewUrl">
                     <img :src="previewUrl" alt="Preview" style="max-width: 100%; max-height: 120px;" />
                  </div>
                 

                </div>
                <div class="modalBtnSet">
                  <button @click="showModal = false">取消</button>
                  <button @click="uploadImage">確認上傳</button>   
                </div>              
              </Modal>
              <div v-if="selectedImageUrl" class="uploaded-image">
                <h3>已上傳的圖片：</h3>
                <img :src="selectedImageUrl" alt="Uploaded Image" style="max-width: 100%; max-height: 120px;" />
              </div>
            </div>
        </div>
        <div class="memName">
            <p>{{ name }}</p>
        </div>
        <div class="memNav">
        <ul>
            <li><router-link to="/member">會員基本資料</router-link></li>
            <li><router-link to="/member/memExpo">個人展覽資訊</router-link></li>
            <li><router-link to="/member/memOrder">商城訂單追蹤</router-link></li>
            <li><router-link to="/member/memSponsor">展覽贊助記錄</router-link></li>
        </ul>
        </div>
    </div>
    <button class="logoutBtn memberBtn" @click="logout">登出</button>
  </div>
</template>

<script setup>
import { ref, defineProps, defineEmits } from 'vue';
import Modal from '@/components/Modal.vue';

const name = '緯藝藝術家'
const logout = () => {
  alert('已登出')
}

defineProps({
  title: String,
  isOpen: Boolean,
});

const emit = defineEmits(['update:isOpen', 'file-selected']);

const previewUrl = ref(null); // 用於儲存圖片預覽的 URL

const close = () => {
  emit('update:isOpen', false);
  previewUrl.value = null; // 關閉時清除預覽
};

const handleFileChange = (event) => {
  const file = event.target.files[0]; // 獲取第一個上傳的檔案
  if (file && file.size > 5 * 1024 * 1024) { // 限制 5MB
    alert('檔案大小不能超過 5MB');
    return;
  }
  previewUrl.value = URL.createObjectURL(file);
  emit('file-selected', file);
};




const showModal = ref(false);
const selectedImageUrl = ref(null);

const openModal = () => {
  showModal.value = true;
};

const handleFileSelected = (file) => {
  // 儲存選擇的檔案並生成預覽（可選）
  selectedImageUrl.value = URL.createObjectURL(file);
  console.log('選擇的檔案：', file);
};



const uploadImage = async () => {
  if (selectedImageUrl.value) {
    const formData = new FormData();
    formData.append('image', file); // file 從 handleFileSelected 儲存
    try {
      const response = await fetch('/api/upload', {
        method: 'POST',
        body: formData,
      });
      const result = await response.json();
      console.log('上傳成功：', result);
      showModal.value = false;
    } catch (error) {
      console.error('上傳失敗：', error);
    }
  }
};

// const uploadImage = () => {
//   alert('圖片已上傳');
//   showModal.value = false;
// };
    
</script>

<style lang="scss" scoped>
@import '/style.scss';

.memSideDiv{
    min-height: 100%;
    padding: 40px 0;
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;

    .memSideCon{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: $spacing-8;

    }

    .memAvatarDiv {
        position: relative;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 2px dashed;
        margin: 0 auto;

      @media (max-width:496px){ 
          width: 100px;
          height: 100px;
        }



      .avatarUpload {
        position: absolute;
        height: 30px;
        top: 45%;
        left: 20%;
        border: none;
        border-radius: 8px;
        background-color: $logoBrown;
        color: $fontWhite;
        display: none;

        &:hover {
        cursor: pointer;
          }
        }

      &:hover {
        opacity: 0.8;
        cursor: pointer;

        .avatarUpload {
          display: block;
        }
      }
  }
  
      .memAvatar{
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;

      }


      .memName{
        font-size: map-get($font, h4);
        font-weight: bold;

    // border: 1px solid ;

        @media (max-width:496px){ 
        font-size: map-get($font, h5);

        }

      }

      .memNav ul {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;

        @media (max-width: 1200px) { 
          flex-direction: row;
        }

        @media (max-width: 496px) { 
          flex-wrap: wrap;
          gap:2px;
        }

          li {
            display: flex;
            justify-content: center;
            align-items: center;
            
            @media (max-width: 496px) {   
              width: calc(50% - 1px); // Account for border width
              border: 1.5px solid $fontBlack;
              border-radius: 8px;

              
              // Remove borders between adjacent items
              // &:nth-child(odd) {
              //   border-right: none;
              // }
              // &:not(:last-child):not(:nth-last-child(2)) {
              //   border-bottom: none;
              // }
            }
          }

          a {
            display: block;
            padding: $spacing-3;
            border-radius: 6px;
            text-decoration: none;
            color: $fontBlack;
            transition: all 0.2s ease; // Smooth hover transitions

            @media (max-width: 496px) { 
              box-sizing: border-box;
              width: 100%;
              padding: $spacing-2; // Consider smaller padding on mobile
            }

            &:hover {
              cursor: pointer;
              background-color: $logoDGreen;
              color: $fontWhite;

              @media (max-width: 496px) { 
              }
            }
          }


        }
        .logoutBtn{
          margin-top: 40px;
        }

      }

.modalText{
  text-align: center;
}

.modalDIY{
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 20px;
  
  margin-bottom: 20px;


    input{
      border: 1px solid;
      border-radius: 8px;
    }

    .avatarPreview{
      width: 120px;
      height: 120px;
      border-radius: 50%;
      border: 2px dashed;

      img{
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
      }

    }


}

.modalBtnSet{
  display: flex;
  justify-content: center;
  gap: 20px
}

</style>