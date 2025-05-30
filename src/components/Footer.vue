<template>
  <footer class="footer">
    <div class="footerContact">
        <p>TEL：<a href="tel:+886212345678">02-12345678</a></p>
        <p>E-mail：<a href="mailto:your_email@example.com">tibaart101@mail.tw</a></p>
    </div>
    <p>&copy; 2025 緯藝基金會 TibaArt. All rights reserved.</p>
    <br>
    <p>本網站為緯育TibaMe前端工程師班第95期學員專題成果作品，本平台僅供學習、展示之用。若有抵觸有關著作權，或有第三人主張侵害智慧財產權等情事，均由學
員負法律上責任，緯育公司概不負責。若有侵權疑慮，您可以私訊<a href="https://www.facebook.com/TibaMe">【緯育TibaMe】</a>，後續會由專人協助處理。</p>
  </footer>
</template>


<script setup>

</script>

<style lang='scss' scoped>
@import '/style.scss';

.footerContact{
  display: flex;
  justify-content: center;
  gap: 16px;
}


a{
  text-decoration: none;
  
  &:hover{
  color: $fontBlack;
  }

}

@media (max-width: 445px){
  .footerContact{
    display: flex;
    flex-direction: column;
    gap: 4px;
  }
    
  }



</style>