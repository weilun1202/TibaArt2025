<template>
    <AdminTable 
      :columns="columns" 
      :data="data"
      @add="openAddModal"
      @edit="openEditModal"
     />

    <transition name="fade">
      <div v-if="showAdd" class="modal-overlay" @click.self="showAdd = false">
        <div class="modal-content">
          <h3>新增商品</h3>
          <label><span>*</span>圖片：<input type="file" name="img" @change="handleFileChange" /></label>
          <label><span>*</span>商品名稱：<input v-model="newData.name" /></label>
          <label>
            <span>*</span>類別：
            <select v-model="newData.type">
              <option disabled value="">請選擇類別</option>
              <option value="tiba">館方</option>
              <option value="artist">藝術家</option>
            </select>
          </label>
          <label><span>*</span>詳細描述：<input v-model="newData.des" /></label>
          <label><span>*</span>價格：<input v-model="newData.price" /></label>
          <label><span>*</span>庫存：<input v-model="newData.stock" /></label>

          <div class="btn-content">
            <button class="btn" @click="addData">送出</button>
            <button class="btn" @click="showAdd = false">取消</button>
          </div>
        </div>
      </div>
    </transition>
</template>

<script setup>
import { ref, onMounted } from "vue";
import AdminTable from '@/components/AdminTable.vue'

// 欄位設定
const columns = [
  { key: 'id', label: '商品編號',class:'w-100' },
  { key: 'type', label: '分類',class:'w-100' },
  { key: 'name', label: '商品名稱' },
  { key: 'img', label: '商品圖', type:'image' },
  { key: 'des', label: '商品描述' },
  { key: 'price', label: '價格' },
  { key: 'stock', label: '庫存' },
  { key: 'updated', label: '上架時間'},
  { key: 'status', label: '狀態' , type:'select', class:'w-120', 
    options:[
      { value: '上架中', label: '上架中' },
      { value: '已下架', label: '已下架' },
      { value: '已售完', label: '已售完' }
    ]
  },
  { key: 'edit', label: '編輯', type:'edit', class:'w-80'},
]

const data = ref([]);
const showAdd = ref(false)
const imageFile = ref(null);

async function fetchProducts() {
  const resp = await fetch(import.meta.env.VITE_AdminProduct)
  let products = await resp.json()

  products = products.map(product => ({
    ...product,
    type: converType(product.type)
  }))
  
  data.value = products
}

function converType(i) {
  switch (i) {
    case 'tiba': return '館方'
    case 'artist': return '藝術家'
  }
}

// 新增表單資料
const newData = ref({
  name: '',
  type: '',
  des: '',
  price: '',
  stock: '',
})

function openAddModal() {
  showAdd.value = true
}

function handleFileChange(e) {
  imageFile.value = e.target.files[0]
}

function cleanForm() {
  newData.value = {
    name: '',
    type: '',
    des: '',
    price: '',
    stock: '',
  }
  imageFile.value = null;
}

// 新增資料
async function addData() {
  if (!imageFile.value || 
      !newData.value.name || 
      !newData.value.type || 
      !newData.value.des || 
      !newData.value.price || 
      !newData.value.stock
    ) {
    alert('請填寫所有欄位');
    return;
  }

  try {
    //  上傳圖片
    const formData = new FormData()
    formData.append('img', imageFile.value)

    const uploadResp = await fetch(import.meta.env.VITE_UploadProductImage, {
      method: 'POST',
      body: formData
    })
    console.log(formData)
    for (let pair of formData.entries()) {
      console.log(pair[0], pair[1]);
    }

    const uploadResult = await uploadResp.json();
    if (!uploadResult.success) throw new Error(uploadResult.message || '圖片上傳失敗');

    const resp = await fetch(import.meta.env.VITE_AddProduct, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        ...newData.value,
        img: uploadResult.url,
      })
    })
    
    const result = await resp.json();
    if (resp.ok) {
      alert(`新增成功`);
      showAdd.value = false;
      cleanForm();              // 清空表單
      imageFile.value = null;   // 清空圖片
      fetchProducts(); 
    } else {
      throw new Error(result.error || '新增失敗');
    }
  } catch (err) {
    alert(`新增失敗：${err.message}`);
  }
}

function openEditModal(){
  alert('功能尚未開放');
}

onMounted(() => {
  fetchProducts()
})
</script>

<style scoped lang="scss">
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
  label{
    display: flex;
    align-items: center;
    padding: $spacing-3;
    span{
      color: $fontWarn;
    }
    input, select{
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
}
</style>

