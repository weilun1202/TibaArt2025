<template>
  <div class="memSideDiv">
    <div class="memSideCon">
        <div class="memAvatarDiv">
            <div class="memAvatarCon avatarUploaded image-uploaded" v-if="memberData.img">
              <img class="memAvatar" :src="memberData.img" v-if="memberData.img" alt="上傳的頭像">
            </div>
            <div v-else class="memAvatarCon">
              <img class="memAvatar" src="@/assets/img/TibaArt-Icon.svg" alt="預設頭像" />
            </div>
            <div>
              <button class="avatarUpload" @click="openModal">上傳照片</button>
              <Modal v-model:isOpen="showModal" title="上傳圖片" @click="closeModal">
                <div class="modalDIY" method="post" action="SingleFile.php" enctype="multipart/form-data">
                  <label for="file-upload" class="modalText">選擇圖片</label>
                  <input id="file-upload" type="file" accept="image/*" @change="handleFileChange">
                  <div class="avatarPreview image-preview" v-if="previewUrl">
                     <img :src="previewUrl" alt="預覽" style="max-width: 100%; max-height: 120px;" />
                  </div>
                </div>
                <div class="modalBtnSet">
                  <button @click="closeModal" aria-label="取消上傳">取消</button>
                  <button @click="uploadImage" aria-label="確認上傳圖片">確認上傳</button>   
                </div>              
              </Modal>
              <!-- <div v-if="selectedImageUrl" class="uploaded-image">
                <h3>已上傳的圖片：</h3>
                <img :src="selectedImageUrl" alt="Uploaded Image" style="max-width: 100%; max-height: 120px;" />
              </div> -->
            </div>
        </div>
        <div class="memName">
            <p>嗨！{{ memberData.name }}</p>
        </div>
        <div class="memNav">
        <ul>
            <li><router-link to="/member">會員基本資料</router-link></li>
            <li v-if="memberData.type === 'artist'"><router-link to="/member/memExpo">個人展覽資訊</router-link></li>
            <li v-if="memberData.type === 'general'"><router-link to="/member/memOrder">商城訂單追蹤</router-link></li>
            <li v-if="memberData.type === 'general'"><router-link to="/member/memSponsor">展覽贊助記錄</router-link></li>
        </ul>
        </div>
    </div>
    <button class="logoutBtn memberBtn" @click="logout">登出</button>
  </div>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue';
import Modal from '@/components/Modal.vue';
import { useUserStore } from '@/stores/user'
import { useRouter } from 'vue-router'

const memberData = reactive({
  name: '',
  type: '',
  img: ''
});

async function loadMemberData() {
  const member = JSON.parse(localStorage.getItem('member'))
  const type = localStorage.getItem('memberType') || 'general'
  const decodedId = atob(member.id)

  const response = await fetch(import.meta.env.VITE_GetMemberInfo, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ id: decodedId, type })
  })

  const result = await response.json()
  if (result.success) {
    const info = result.member_info
    // console.log(info);
    
    memberData.name = info.name
    memberData.type = type
    memberData.img = info.img 
    // console.log(memberData.img);
    
  }
}

onMounted(() => {
  loadMemberData()
})

// const logout = () => {
//   alert('已登出')
//   localStorage.removeItem('member')
//   localStorage.removeItem('memberType')
//   router.push('/front/MemLogin')
// }

const userStore = useUserStore()
const router = useRouter()

const logout = () => {
  alert('已登出')
  userStore.logout()
  router.push('/front/MemLogin')
}


const showModal = ref(false);
const previewUrl = ref(null); 
const selectedFile = ref(null);

const openModal = () => {
  showModal.value = true;
};

const closeModal = () => {
  showModal.value = false;
  previewUrl.value = null; 
};

const handleFileChange = (event) => {
  const file = event.target.files[0];
  if (file && file.size > 5 * 1024 * 1024) {
    alert('檔案大小不能超過 5MB');
    return;
  }
  previewUrl.value = URL.createObjectURL(file);
  selectedFile.value = file;
};

const uploadImage = async () => {
  if (!selectedFile.value) {
    alert('請先選擇一張圖片');
    return;
  }

  const member = JSON.parse(localStorage.getItem('member'));
  const decodedId = atob(member.id);
  const type = localStorage.getItem('memberType') || 'general';

  const formData = new FormData();
  formData.append('img', selectedFile.value);
  formData.append('id', decodedId);
  formData.append('type', type);

  try {
    const response = await fetch(import.meta.env.VITE_AvatarUpload, {
      method: 'POST',
      body: formData,
    });

    const result = await response.json();    
    console.log('上傳成功：', result);
    

    memberData.img  = result.url || URL.createObjectURL(selectedFile.value);
    
    // 釋放預覽 URL
    URL.revokeObjectURL(previewUrl.value);



    // 關閉 modal 與清空狀態
    showModal.value = false;
    previewUrl.value = null;
    selectedFile.value = null;

    // loadMemberData()

    // 可以選擇刷新或重新撈取資料
    // location.reload()

  } catch (error) {
    console.error('上傳失敗：', error);
    alert('圖片上傳失敗，請重試');
  }
};


    
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


  .memAvatarCon{
    position: relative;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 2px solid $logoBrown;
        margin: 0 auto;

      @media (max-width:496px){ 
          width: 100px;
          height: 100px;
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