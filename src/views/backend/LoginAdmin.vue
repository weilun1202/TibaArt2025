<template>
  <img src="../../assets/img/TibaArtLogo.svg" class="logo">
  <div class="adminLogin">
  <span>後台登入</span>

    <label for="adminAccount">
      帳號
      <br>
      <input name="adminAccount" id ="adminAccount" type="text" placeholder="請輸入帳號">
    </label>
    <label for="adminPassword">
      密碼
      <br>
      <input name= "adminPassword" id="adminPassword" type="password" placseholder="請輸入密碼">
    </label>
    <button class="btn">登入</button>
  </div>
</template>

<script setup>
  import { ref } from "vue";

  
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
