<template>
<div class="wrapper">
  <!-- Wave bg-->
  <div class="wave-container">
    <div class="wave -one"></div>
    <div class="wave -two"></div>
    <div class="wave -three"></div>
  </div>
  <div class="line"></div>
  <div class="text-wrap">
    <div class="text"><span>L</span><span>I</span><span>S</span><span>T</span><span>E</span><span>N</span>
      <div class="main-btn_wrapper"><i class="main-btn fa fa-play" aria-hidden="true"></i></div>
    </div>
	<div class="circle-options">
    <div class="option">Option 1</div>
    <div class="option">Option 2</div>
  </div>
  </div>
  <div class="header">
    <div class="burger-wrapper">
      <div class="burger"></div>
    </div>
    <div class="logo-text">Listeners Playlist</div>
    <div class="back_btn">
      <div class="circle"></div>
      <div class="text">Back</div>
    </div>
  </div>
  <div class="nav">
    <ul class="nav_main">
      <li> <a class="nav_link">Home</a></li>
      <li> <a class="nav_link">Listeners</a></li>
      <li> <a class="nav_link">Compilations</a></li>
      <li> <a class="nav_link">LP. Mix</a></li>
    </ul>
    <div class="nav_divider"></div>
    <ul class="nav_sub">
      <li><a class="nav_link" href="">About</a></li>
      <li><a class="nav_link" href="">Contact</a></li>
    </ul>
  </div>
  <div class="mini-player">
    <div class="track_info_wrapper">
      <div class="track_info">
        <div class="thumb"></div>
        <div class="info">
          <div class="title">Friday Comes</div>
          <div class="artist">Early</div>
        </div>
      </div>
    </div>
    <div class="mini-player_btn_wrapper"><i class="btn-prev fa fa-step-backward" aria-hidden="true"></i>
      <div class="btn-switch"><i class="btn-play fa fa-play" aria-hidden="true"></i><i class="btn-pause fa fa-pause" aria-hidden="true"></i></div><i class="btn-next fa fa-step-forward" aria-hidden="true"></i><i class="btn-open-player fa fa-list" aria-hidden="true"></i>
    </div>
  </div>
  <div class="dim"></div>
  <div class="player" id="player">
    <div class="playback_wrapper">
      <div class="playback_blur"></div>
      <div class="playback_thumb"></div>
      <div class="playback_info">
        <div class="title">Friday Comes</div>
        <div class="artist">Early</div>
      </div>
      <div class="playback_btn_wrapper"><i class="btn-prev fa fa-step-backward" aria-hidden="true"></i>
        <div class="btn-switch"><i class="btn-play fa fa-play" aria-hidden="true"></i><i class="btn-pause fa fa-pause" aria-hidden="true"></i></div><i class="btn-next fa fa-step-forward" aria-hidden="true"></i>
      </div>
      <div class="playback_timeline">
        <div class="playback_timeline_start-time">00:31</div>
        <div class="playback_timeline_slider">
          <div class="slider_base"></div>
          <div class="slider_progress"></div>
          <div class="slider_handle"></div>
        </div>
        <div class="playback_timeline_end-time">03:11</div>
      </div>
    </div>
    <div class="list_wrapper">
      <ul class="list"> 
        <li class="list_item selected"> 
          <div class="thumb"> </div>
          <div class="info"> 
            <div class="title">Friday Comes</div>
            <div class="artist">Early</div>
          </div>
        </li>
        <li class="list_item"> 
          <div class="thumb"> </div>
          <div class="info"> 
            <div class="title">Friday Comes</div>
            <div class="artist">Early</div>
          </div>
        </li>
        <li class="list_item"> 
          <div class="thumb"> </div>
          <div class="info"> 
            <div class="title">Friday Comes</div>
            <div class="artist">Early</div>
          </div>
        </li>
        <li class="list_item"> 
          <div class="thumb"> </div>
          <div class="info"> 
            <div class="title">Friday Comes</div>
            <div class="artist">Early</div>
          </div>
        </li>
        <li class="list_item"> 
          <div class="thumb"> </div>
          <div class="info"> 
            <div class="title">Friday Comes</div>
            <div class="artist">Early</div>
          </div>
        </li>
        <li class="list_item"> 
          <div class="thumb"> </div>
          <div class="info"> 
            <div class="title">Friday Comes</div>
            <div class="artist">Early</div>
          </div>
        </li>
        <li class="list_item"> 
          <div class="thumb"> </div>
          <div class="info"> 
            <div class="title">Friday Comes</div>
            <div class="artist">Early</div>
          </div>
        </li>
        <li class="list_item"> 
          <div class="thumb"> </div>
          <div class="info"> 
            <div class="title">Friday Comes</div>
            <div class="artist">Early</div>
          </div>
        </li>
      </ul>
    </div>
  </div>
  <div class="page" id="curator">
    <div class="curator_title_wrapper"><span>LP</span>
      <div class="curator_line"></div>
      <div class="curator_title">Listeners</div>
      <div class="curator_line"></div><span>14</span>
    </div>
    <div class="curator_list">
      <div class="curator_list_content">
        <div class="connect_btn_wrapper item">
          <div class="connect_btn">
            <div class="connect_btn_text">Connect<br/>SoundCloud</div>
          </div>
        </div>
        <div class="curator_list_content_desc">Or Select<br/>a Listener of<br/>L.P.</div>
        <div class="item">
          <div class="thumb"></div>
          <div class="info">
            <div class="name">Fantasy</div>
            <div class="desc">Sam</div>
          </div>
        </div>
        <div class="item">
          <div class="thumb"></div>
          <div class="info">
            <div class="name">Fantasy</div>
            <div class="desc">Sam</div>
          </div>
        </div>
        <div class="item">
          <div class="thumb"></div>
          <div class="info">
            <div class="name">Fantasy</div>
            <div class="desc">Sam</div>
          </div>
        </div>
        <div class="item">
          <div class="thumb"></div>
          <div class="info">
            <div class="name">Fantasy</div>
            <div class="desc">Sam</div>
          </div>
        </div>
        <div class="item">
          <div class="thumb"></div>
          <div class="info">
            <div class="name">Fantasy</div>
            <div class="desc">Sam</div>
          </div>
        </div>
        <div class="item">
          <div class="thumb"></div>
          <div class="info">
            <div class="name">Fantasy</div>
            <div class="desc">Sam</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>

import { gsap, Power2, Expo } from 'gsap';

document.addEventListener('DOMContentLoaded', () => {
  const burger = document.querySelector('.burger-wrapper');
  const nav = document.querySelector('.nav');
  const dim = document.querySelector('.dim');
  const logoText = document.querySelector('.logo-text'); // 可選

  // 初始隱藏
  gsap.set(nav, { xPercent: -100, display: 'none' });
  gsap.set(dim, { opacity: 0, display: 'none' });

  burger.addEventListener('click', () => {
    const isNavVisible = getComputedStyle(nav).display !== 'none';

    if (!isNavVisible) {
      gsap.to(dim, { opacity: 1, display: 'block', duration: 0.5, ease: Power2.easeInOut });
      gsap.to(nav, { xPercent: 0, display: 'block', duration: 0.5, ease: Expo.easeOut });
      gsap.from('.nav li', {
        opacity: 0,
        y: 20,
        stagger: 0.1,
        duration: 0.5,
        ease: Power2.easeInOut
      });

      if (logoText) logoText.style.display = 'none';
    } else {
      gsap.to(dim, { opacity: 0, display: 'none', duration: 0.5, ease: Power2.easeInOut });
      gsap.to(nav, { xPercent: -100, display: 'none', duration: 0.5, ease: Expo.easeOut });

      if (logoText) {
        logoText.style.opacity = '1';
        logoText.style.display = 'block';
      }
    }
  });

  dim.addEventListener('click', () => {
    gsap.to(dim, { opacity: 0, display: 'none', duration: 0.5, ease: Power2.easeInOut });
    gsap.to(nav, { xPercent: -100, display: 'none', duration: 0.5, ease: Expo.easeOut });
  });

  // Listeners 點擊效果
  const text = document.querySelector('.text-wrap .text');
  const circleOptions = document.querySelector('.circle-options');

  gsap.set(circleOptions, { scale: 0, opacity: 0, display: 'none' });

  text.addEventListener('click', () => {
    gsap.set(circleOptions, { display: 'flex' });
    gsap.to(circleOptions, {
      scale: 1,
      opacity: 1,
      duration: 0.8,
      ease: Power2.easeOut
    });
  });
});



document.addEventListener('DOMContentLoaded', () => {
  // ... 現有程式碼 ...

  // 迷你播放器按鈕
  const miniPlayerPlayBtn = document.querySelector('.mini-player_btn_wrapper .btn-play');
  const miniPlayerPauseBtn = document.querySelector('.mini-player_btn_wrapper .btn-pause');
  const miniPlayerNextBtn = document.querySelector('.mini-player_btn_wrapper .btn-next');
  const miniPlayerPrevBtn = document.querySelector('.mini-player_btn_wrapper .btn-prev');
  const btnOpenPlayer = document.querySelector('.btn-open-player');
  const player = document.getElementById('player'); // 取得播放器元素

  // 播放器內的按鈕
  const playbackPlayBtn = document.querySelector('.playback_btn_wrapper .btn-play');
  const playbackPauseBtn = document.querySelector('.playback_btn_wrapper .btn-pause');
  const playbackNextBtn = document.querySelector('.playback_btn_wrapper .btn-next');
  const playbackPrevBtn = document.querySelector('.playback_btn_wrapper .btn-prev');

  // 返回按鈕
  const backBtn = document.querySelector('.back_btn');

  // 列表項目
  const listItems = document.querySelectorAll('.list_item');

  // 主播放按鈕
  const mainBtn = document.querySelector('.main-btn_wrapper .main-btn');


  // 為按鈕添加事件監聽器 (範例)
  if (miniPlayerPlayBtn) {
    miniPlayerPlayBtn.addEventListener('click', () => {
      console.log('點擊了迷你播放器播放按鈕');
      // 播放邏輯，切換按鈕顯示等
      gsap.to(miniPlayerPlayBtn, { opacity: 0, display: 'none', duration: 0.3 });
      gsap.to(miniPlayerPauseBtn, { opacity: 1, display: 'block', duration: 0.3 });
    });
  }

  if (miniPlayerPauseBtn) {
    miniPlayerPauseBtn.addEventListener('click', () => {
      console.log('點擊了迷你播放器暫停按鈕');
      // 暫停邏輯，切換按鈕顯示等
      gsap.to(miniPlayerPauseBtn, { opacity: 0, display: 'none', duration: 0.3 });
      gsap.to(miniPlayerPlayBtn, { opacity: 1, display: 'block', duration: 0.3 });
    });
  }

  if (btnOpenPlayer && player) {
    gsap.set(player, { x: '100%', display: 'none' }); // 播放器初始隱藏
    btnOpenPlayer.addEventListener('click', () => {
      console.log('打開播放器');
      gsap.to(dim, { opacity: 1, display: 'block', duration: 0.5, ease: Power2.easeInOut });
      gsap.to(player, { x: '0%', display: 'block', duration: 0.5, ease: Expo.easeOut });
    });
  }

  if (backBtn && player) {
    backBtn.addEventListener('click', () => {
      console.log('返回');
      gsap.to(player, { x: '100%', display: 'none', duration: 0.5, ease: Expo.easeOut });
      gsap.to(dim, { opacity: 0, display: 'none', duration: 0.5, ease: Power2.easeInOut });
    });
  }

  // 為導航連結添加事件 (如果需要處理路由或特定行為)
  const navLinks = document.querySelectorAll('.nav_link');
  navLinks.forEach(link => {
    link.addEventListener('click', (event) => {
      // event.preventDefault(); // 如果你不想讓連結導航
      console.log(`點擊了導航連結: ${link.textContent}`);
      // 處理導航邏輯，例如關閉導航選單
      gsap.to(dim, { opacity: 0, display: 'none', duration: 0.5, ease: Power2.easeInOut });
      gsap.to(nav, { xPercent: -100, display: 'none', duration: 0.5, ease: Expo.easeOut });
    });
  });

  // 為主播放按鈕添加事件 (範例：點擊後顯示)
  if (mainBtn) {
    // 假設你希望點擊 LISEN 後的播放按鈕會做什麼
    mainBtn.addEventListener('click', () => {
      console.log('點擊了主播放按鈕');
      // 例如：播放音樂或打開播放器
      gsap.to(btnOpenPlayer, { opacity: 1, display: 'block', duration: 0.5, ease: Power2.easeOut }); // 假設打開迷你播放器
    });
  }

  // 如果你希望點擊 'LISTEN' 文字時，不僅出現 circle-options，也讓 main-btn_wrapper 出現
  if (text) {
    text.addEventListener('click', () => {
      const mainBtnWrapper = document.querySelector('.main-btn_wrapper');
      if (mainBtnWrapper) {
        gsap.to(mainBtnWrapper, {
          opacity: 1,
          scale: 1,
          display: 'block', // 確保元素可見
          duration: 0.8,
          ease: Power2.easeOut
        });
      }
      // 原有的 circleOptions 邏輯
      const circleOptions = document.querySelector('.circle-options'); // 再次確認 circle-options 存在
      if (circleOptions) {
        gsap.set(circleOptions, { display: 'flex' });
        gsap.to(circleOptions, {
          scale: 1,
          opacity: 1,
          duration: 0.8,
          ease: Power2.easeOut
        });
      }
    });
  }

  // 處理列表項目點擊
  if (listItems) {
    listItems.forEach(item => {
      item.addEventListener('click', () => {
        console.log('點擊了列表項目');
        // 移除所有 selected 類
        listItems.forEach(li => li.classList.remove('selected'));
        // 為當前點擊的項目添加 selected 類
        item.classList.add('selected');
        // 在這裡你可以添加播放該曲目的邏輯
      });
    });
  }

  // 處理策展人列表項目點擊
  const curatorItems = document.querySelectorAll('.curator_list_content .item');
  if (curatorItems) {
    curatorItems.forEach(item => {
      item.addEventListener('click', () => {
        console.log('點擊了策展人項目');
        // 在這裡你可以添加跳轉到該策展人頁面或顯示其資訊的邏輯
      });
    });
  }

  // 策展人頁面顯示/隱藏邏輯 (需要觸發點)
  // 如果你希望點擊特定按鈕打開策展人頁面，你需要為該按鈕添加事件
  // 例如，如果點擊某個導航連結會顯示策展人頁面：
  // const curatorLink = document.querySelector('.nav_link[data-page="curator"]'); // 假設導航連結有 data-page 屬性
  // const curatorPage = document.getElementById('curator');
  // if (curatorLink && curatorPage) {
  //   gsap.set(curatorPage, { opacity: 0, display: 'none' }); // 初始隱藏
  //   curatorLink.addEventListener('click', () => {
  //     gsap.to(curatorPage, { opacity: 1, display: 'block', duration: 0.8, ease: Power2.easeInOut });
  //     // 同時隱藏其他頁面，並關閉導航
  //     gsap.to(dim, { opacity: 0, display: 'none', duration: 0.5, ease: Power2.easeInOut });
  //     gsap.to(nav, { xPercent: -100, display: 'none', duration: 0.5, ease: Expo.easeOut });
  //   });
  // }

});



</script>

<style lang="scss" scoped>
@import url('https://fonts.googleapis.com/css?family=Oswald:300,400,700');

.dim {
  position: fixed;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,0.5);
  top: 0;
  left: 0;
  z-index: 10;
}

.nav {
  position: fixed;
  left: 0;
  top: 0;
  background: white;
  width: 250px;
  height: 100%;
  z-index: 20;
}

.circle-options {
  display: flex;
  gap: 1rem;
  justify-content: center;
  align-items: center;
  margin-top: 2rem;
  transition: all 0.3s ease;
}

.option {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  background: #ddd;
  display: flex;
  align-items: center;
  justify-content: center;
}


/* //  ===== Global Values ===== */
$color-bg: #F2D7D3;
$color-light: #fff9e1;
$color-black: #252120;
$color-gray: rgb(68, 68, 68);

i[class^="btn"] {
	font-size: 20px;
	margin-right: 30px;
	cursor: pointer;
}

* {
	box-sizing: border-box;
}

ul, li {
	list-style: none;
	padding: 0;
}

a {
	color: inherit;
	text-decoration: none;
}

//  ===== Body =====
body {
	margin: 0;
	background-color: $color-bg;
	font-family: 'Oswald', sans-serif;
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
	font-size: 1rem;
	overflow: hidden;
	width: 100vw;
}

// ===== Wave Experiment =====
.wave-container {
	width: 300vw;
	height: 100%;
	position: fixed;
	overflow: hidden;
	transform: translate3d(0, 0, 0);
}

.wave {
	opacity: 1;
	position: absolute;
	top: 60%;
	left: -28%;
	background: #18DFAD;
	width: 100%;
	height: 300vw;
	transform-origin: 50% 49%;
	border-radius: 49%;
	-webkit-animation: drift 3000ms infinite linear;
	animation: drift 8000ms infinite linear;
	will-change: transform;
	// z-index: 3;
}
.wave.-two {
	animation: drift 9000ms infinite linear;
	opacity: 1;
	background: #33476a;
	top: 60%;
	left: -32%;
}

.wave.-three {
	animation: drift 4000ms infinite linear;
	opacity: 1;
	background: #F12645;
	top: 60%;
	left: -36%;
	z-index: -2;
}

@keyframes drift {
  from { transform: rotate(0deg); }
  from { transform: rotate(360deg); }
}
// ===== /Wave Experiment =====

// ===== Wrapper =====
.bg {
	position: fixed;
	bottom: 0;
	width: 100vw;
	height: 50%;
	background-color: #33476a;
	z-index: -1;
}

.line {
	position: fixed;
	left: 50vw;
	width: 2px;
	height: 80px;
	top: 24vh;
	background-color: white;
}

.text-wrap {
	position: absolute;
	width: 100vw;
	height: 100%;
	display: flex;
	justify-content: center;
	align-items: center;
	
	.text {
		cursor: pointer;	
		position: relative;
	}
	
	span {
		color: $color-light;
		font-size: 100px;
		font-weight: 300;
		padding: 0 2%;
	}
}

.main-btn_wrapper {
	position: absolute;
	right: -25%;
	top: calc(50% - 18px);
	width: 36px;
	height: 36px;
	background-color: rgb(255, 249, 225);
	border-radius: 50%;
	text-align: center;
	display: none;
	opacity: 0;
	transform: scale(0);
	transform-origin: bottom;
	
	.main-btn {
		line-height: 36px;
	}
	
}




// ===== Header =====
.header {
	position: fixed;
	left: 2.2vw;
	top: 2.2vw;
	margin-left: -4px;
	margin-top: -6px;
	color: $color-black;
	z-index: 103;
	display: flex;
	cursor: pointer;
	align-items: center;
	height: 30px;
	.burger-wrapper {
		width: 20px;
    height: 30px;
    margin-right: 20px;
    display: flex;
    align-items: center;
	}
	
	.burger {
		width: 20px;
		height: 3px;
		background-color: $color-black;
		position: relative;
		
		&:before, &:after {
			content: '';
			width: 20px;
			height: 3px;
			background-color: $color-black;
			position: absolute;
			left: 0;
		}
		
		&:before {
			top: -6px;
		}
		
		&:after {
			top: 6px;
			width: 14px;
		}
	}
	
	.logo-text {
		font-size: 20px;
		color: $color-black;
	}
}

.back_btn {
	cursor: pointer;
	position: relative;
	color: rgba(37,33,32,0.4);
	font-size: 18px;
	display: flex;
	align-items: center;
	display: none;
	opacity: 0;

	.circle {
		background-color: rgba(37,33,32,0.3);
		width: 24px;
		height: 24px;
		border-radius: 50%;
		margin-right: 8px;
	}
}


// ===== Navigation =====
.nav {
    top:0;
	will-change: transform;
	position: fixed;
	background-color: #fff;
	width: 50vw;
	min-width: 500px;
	height: 100vh;
	z-index: 10;
	box-shadow: 0 30px 80px 0 rgba(97,45,45,0.25);
	display: none;

	ul {
		color: $color-gray;
		
		&.nav_main {
			margin-top: 20vh;
		}
		
		&.nav_sub {
			margin-top: 3vh;
			
			a {
				font-size: 2.4vw;
			}
		}
		
		li {
			margin-left: 6vw;
			margin-bottom: .5vw;
			position: relative;
		}
	}
}

.nav_link {
	font-size: 3.8vw;
	cursor: pointer;

	&:before {
		content: '';
		position: absolute;
		width:  4vw;
		height: 2px;
		background-color: $color-gray;
		left: -12vw;
		top: 50%;
		transition: 0.4s;
	}
}

.nav_divider {
	width: 3vw;
	height: 1px;
	background-color: rgba(37,33,32,0.12);
	margin: 4vh 6vw;
}

.nav li .nav_link:hover:before {
	left: -6vw;
}

// ===== Mini Player =====
.mini-player {
	color: #252120;
	position: fixed;
	height: 32px;
	right: 2.2vw;
	top: 2.2vw;
	z-index: 1;
	display: flex;
	align-items: center;
}

.track_info_wrapper {
	border-right: 1px solid rgba(24,38,69,0.11);
	margin-right: 23px;
	padding-right: 30px;
	
	.track_info {
		display: flex;
		align-items: center;
		cursor: pointer;
		opacity: 1;
		
		.thumb {
			width: 32px;
			height: 32px;
			margin-right: 10px;
			background-color: #D3D6DA;
			border-radius: 2px;
			background-size: cover;
			background-image: url(https://i1.sndcdn.com/artworks-000167527289-p3zpfg-large.jpg);
		}
		
		.title {
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
			font-size: 14px;
		}
		
		.artist {
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
			font-size: 12px;
			color: rgba(37,33,32,0.7);
		}
	}
}

// ===== Mini Player Buttons =====
.mini-player_btn_wrapper {
	display: flex;
	justify-content: space-between;
	position: relative;
}

.btn-switch {
	width: 30px;
	display: flex;
	margin-right: 30px;
	justify-content: center;
}

.playback_btn_wrapper .btn-switch {
	margin-right: 0;
}

.btn-play, .btn-pause {
	position: absolute;
}

.btn-pause {
	display: none;
	opacity: 0;
}

// ===== Player =====

.dim {
	will-change: opacity;
	width: 100vw;
	height: 100vh;
	background-color: rgba(37,33,32,0.2);
	position: fixed;
	background-color: rgba(224, 221, 209, 0.701961);
	z-index: 110;
	display: none;
	z-index: 2;
	opacity: 0;
}

// ===== Player =====
.player {
	will-change: transform;
	display: none;
	position: fixed;
	right:0;
	top: 0;
	width: 600px;
	height: 100%;
	background-color: #fff;
	box-shadow: 0px 25px 60px 0px rgba(97,45,45,0.4);
	font-size: 14px;
	z-index: 999;
}

// ===== Player - Playback =====
.playback_wrapper {
	height: 310px;
	position: relative;
	overflow: hidden;
	background-color: $color-light;
}

.playback_blur {
	width: 100%;
	height: 100%;
	background-size: cover;
	background-position: center;
	position: absolute;
	transform: scale(1.1);
	filter: blur(32px);
	opacity: 0.24;
	background-image: url(https://i1.sndcdn.com/artworks-000167527289-p3zpfg-large.jpg);
}

.playback_thumb {
	transition: 0.5s;
	width: 164px;
	height: 164px;
	border-radius: 5px;
	background-size: cover;
	position: absolute;
	margin: 35px;
	box-shadow: 0px 12px 30px 0px rgba(97,45,45,0.2);
	background-image: url(https://i1.sndcdn.com/artworks-000167527289-p3zpfg-t500x500.jpg);
}

.playback_info {
	display: block;
	position: absolute;
	left: 164px;
	z-index: 10;
	margin: 42px 8px 8px 70px;
	width: 55%;
	min-width: 100px;
	mix-blend-mode: color-burn;
	
	.title {
		font-size: 30px;
		display: inline;
		color: $color-black;
	}
	
	.artist {
		margin-top: 14px;
    font-size: 16px;
    opacity: 0.34;
		color: $color-black;
	}
}

.playback_btn_wrapper {
	position: absolute;
	z-index: 10;
	mix-blend-mode: color-burn;
	width: 124px;
	left: 55px;
	top: 240px;
	opacity: 0.6;
	display: flex;
	justify-content: space-between;
	
	i {
		margin: 0;
	}
}

.playback_timeline {
	position: absolute;
	width: 60%;
	left: 234px;
	top: 238px;
	mix-blend-mode: color-burn;
	color: #252120;
}

.playback_timeline_start-time, .playback_timeline_end-time {
	font-size: 14px;
	opacity: 0.4;
	margin-right: 15px;
	display: inline-block;
	vertical-align: middle;
}

.playback_timeline_slider {
	height: 24.67px;
	position: relative;
	cursor: pointer;
	width: 65%;
	margin-right: 15px;
	opacity: 1;
	display: inline-block;
	vertical-align: middle;
	
	.slider_base {
		width: 100%;
    height: 2px;
    background-color: rgba(37,33,32,0.12);
    border-radius: 2px;
    position: absolute;
    top: 12px;
	}
	
	// 	Manipulate ScaleX to grow the progress bar
	.slider_progress {
		transform: matrix(0.15812, 0, 0, 1, 0, 0);
		transform-origin: 0 0;
		width: 100%;
    height: 2px;
    background-color: rgba(37,33,32,0.5);
    border-radius: 2px;
    position: absolute;
    top: 12px;
	}
	
	// 	Manipulate TranslateX to grow the progress bar
	.slider_handle {
		transform: matrix(1, 0, 0, 1, 37, 0);
		width: 12px;
		height: 12px;
		background-color: rgb(37, 33, 32);
		border-radius: 50%;
		position: absolute;
    top: 7px;
    left: -6px;
	}
}





// ===== Player - List =====
.list_wrapper {
	height: calc(100% - 310px);
	// overflow: hidden;
	overflow: auto;
}

.list {
	padding: 20px 0;

	.list_item {
		display: flex;
		align-items: center;
		cursor: pointer;
		width: 100%;
		height: 74px;
		transition: 0.4s;
	}		

	.thumb {
		width: 50px;
		height: 50px;
		margin: 0 12px 0 31px;
		border-radius: 50%;
		position: relative;
		opacity: 0.8;
		background-size: cover;
	}

	.info {
		max-width: 600px;
		
		.title {
			font-size: 15px;
  	  color: #999;
		}
		
		.artist {
			font-size: 13px;
			text-transform: uppercase;
			color: #bbb;
		}
	}
}

.list_item:hover {
	background-color: rgba(0,0,0,0.03);
}

.list_item:active {
	transform: scale(0.98);
}

// List Replace with JSON later
.list {
	.list_item:nth-child(1) {
		.thumb{
			background-image: url(https://i1.sndcdn.com/artworks-000167527289-p3zpfg-large.jpg);
		}
	}
	
	.list_item:nth-child(2) {
		.thumb{
			background-image: url(https://i1.sndcdn.com/artworks-000149308680-w9rj6a-large.jpg);
		}
	}
	.list_item:nth-child(3) {
		.thumb{
			background-image: url(https://i1.sndcdn.com/artworks-000091003491-upr0rf-large.jpg);
		}
	}
	.list_item:nth-child(4) {
		.thumb{
			background-image: url(https://i1.sndcdn.com/artworks-000125642440-o2ff73-large.jpg);
		}
	}
	.list_item:nth-child(5) {
		.thumb{
			background-image: url(https://i1.sndcdn.com/artworks-000174340505-wv6dl1-large.jpg);
		}
	}
	.list_item:nth-child(6) {
		.thumb{
			background-image: url(https://i1.sndcdn.com/artworks-000169142537-e22x2o-large.jpg);
		}
	}
	.list_item:nth-child(7) {
		.thumb{
			background-image: url(https://i1.sndcdn.com/artworks-000180119811-wgpequ-large.jpg);
		}
	}
	.list_item:nth-child(8) {
		.thumb{
			background-image: url(https://i1.sndcdn.com/artworks-000133986066-hf1rz6-large.jpg);
		}
	}
}

.selected {
	background-color: rgba(224,186,171,0.19);
	
	&:hover {
		background-color: rgba(224,186,171,0.3);
	}
	
	.info {
		.title {
			color: #252120;
			font-size: 15px;
		}
		.artist {
			color: rgba(37,33,32,0.7);
			font-size: 13px;
   	 text-transform: uppercase;
		}
	}
}

// ===== Curator Page =====
.active {
	display: block;
	opacity: 1;
}

#curator {
	width: 100%;
	height: 100%;
	position: fixed;
	text-align: center;
	color: $color-black;
	display: none;
	
	.curator_title_wrapper  {
		position: fixed;
		margin-top: 17.55vh;
		width: 100vw;
		display: flex;
		align-items: center;
		justify-content: center;
		opacity: 0;
		
		span {
			font-size: 2.16vh;
		}
		
		.curator_title {
			font-size: 7.425vh;
		}
		
		.curator_line {
			width: 30px;
			height: 2px;
			border-radius: 2px;
			margin: 0 30px;
			background-color: $color-black;
		}
	}
}

// ===== Curator List =====
.curator_list {
	position: absolute;
	text-align: center;
	font-size: 14px;
	width: 100vw;
	height: 100%;
	-webkit-overflow-scrolling: touch;
	white-space: nowrap;
	// overflow: auto;
	opacity: 0;
}

.connect_btn {
	border-radius: 50%;
	width: 18vh;
	height: 18vh;
	background-image: linear-gradient(280deg, rgb(47, 42, 41) 0%, rgb(47, 42, 41) 100%);
	color: #f1dfdd;
	position: relative;
	display: flex;
	justify-content: center;
	align-items: center;
	transition: 0.5s;
	
	.connect_btn_text {
		z-index: 9;
	}
}

.connect_btn:before {
	position: absolute;
  content: '';
  width: 100%;
  height: 100%;
  border-radius: 50%;
  transition: opacity 0.5s ease-out;
  opacity: 0;
	background-image: linear-gradient(225deg, rgb(255, 103, 0) 0%, rgb(255, 45, 240) 100%);
	transition: 0.5s;
}

.connect_btn:hover:before {
	opacity: 1;
}



.curator_list_content_desc {
	position: relative;
	pointer-events: none;
	margin: 0 20px;
	margin-bottom: 60px;
}

.curator_list_content {
	padding: 0 50px;
	white-space: nowrap;
	text-align: left;
	// width: 1600px;
	// width: 100%;
	position: absolute;
	top: 50%;
	margin-top: -6.6666666667vh;
	display: flex;
	align-items: center;

	.item {
		cursor: pointer;
		// width: 18vh;
		height: 25vh;
		margin: 0 20px;
	}
	
	.item:active {
		transform: scale(0.95);
	}
	
	.info {
		opacity: 0;
	}
	
	.info .name, .info .desc {
		font-size: 13px;
    color: #f1dfdd;
    clear: both;
    position: relative;
    padding: 0 3px 1px 3px;
    background-color: #252120;
		display: inline-block;
		float: left;
		clear: both;
		border-radius: 3px 3px 0px 0px;
	}
	
	.thumb {
		border-radius: 50%;
    width: 18vh;
    height: 18vh;
    background-size: cover;
    margin-bottom: 20px;
		transition: 0.5s;
	}
}

.curator_list_content {
	.item:nth-child(3) .thumb {
		background-image: url(https://i1.sndcdn.com/avatars-000202649537-6368nw-t250x250.jpg);
	}
	.item:nth-child(4) .thumb {
		background-image: url(https://i1.sndcdn.com/avatars-000249865900-64rve1-t250x250.jpg);
	}
	.item:nth-child(5) .thumb {
		background-image: url(https://i1.sndcdn.com/avatars-000270812013-6zuevs-t250x250.jpg);
	}
	.item:nth-child(6) .thumb {
		background-image: url(https://i1.sndcdn.com/avatars-000213988027-6nutce-t250x250.jpg);
	}
	.item:nth-child(7) .thumb {
		background-image: url(https://i1.sndcdn.com/avatars-000187841543-7rhmm0-t250x250.jpg);
	}
	.item:nth-child(8) .thumb {
		background-image: url(https://i1.sndcdn.com/avatars-000248045110-uq3jhv-t250x250.jpg);
	}
	.item:nth-child(9) .thumb {
		background-image: url(https://i1.sndcdn.com/avatars-000276749358-7c1upz-t250x250.jpg);
	}
	.item:nth-child(10) .thumb {
		background-image: url(https://i1.sndcdn.com/avatars-000265518371-amlg8s-t250x250.jpg);
	}
}

.shadow {
	box-shadow: 0 30px 60px 0 rgba(0,0,0,0.4);
}


</style>