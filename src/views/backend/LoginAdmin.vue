<template>
  <img src="../../assets/img/TibaArtLogo.svg" class="logo">
  
  <form @submit.prevent="adminLogin" class="adminLogin">
    <span>後台登入</span>
    <label for="adminAccount">
      帳號
      <br />
      <input
        v-model="acc"
        name="adminAccount"
        id="adminAccount"
        type="text"
        placeholder="請輸入帳號"
      />
    </label>
    <label for="adminPassword">
      密碼
      <br />
      <input
        v-model="pwd"
        name="adminPassword"
        id="adminPassword"
        type="password"
        placeholder="請輸入密碼"
      />
    </label>

    <button class="btn" type="submit">登入</button>
  </form>
</template>

<script setup>
  import { ref } from 'vue'
  import { useRouter } from 'vue-router'

  const acc = ref('')
  const pwd = ref('')
  const rouret = useRouter()

  const adminLogin = function(){
    if(acc.value === '123' && pwd.value === '456'){
      alert('成功登入')
      rouret.push('/admin')
    }else{
      alert('帳號密碼輸入錯誤')
    }
  }

</script>

<style lang="scss" scoped>
@import '/style.scss';
.logo{
  height: 60px;
  margin: 10px;
}

.adminLogin{
  width: 400px;
  display: flex;
  flex-direction: column;
  font-size: 24px;
  margin: 100px auto;
  gap: 30px;
  span{
    font-size: 48px;
    text-align: center;
    margin-bottom: 50px;
  }
  input{
    width: 100%;
    height: 40px;
  }
  input[type="text"]{
    font-size: 16px;
    padding: 10px;
  }
  input[type="password"]{
    font-size: 16px;
    padding: 10px;
  }
  label{
    line-height: 1.6;
  }
  button{
    width: 100px;
    align-self: center;
  }
}

</style>
