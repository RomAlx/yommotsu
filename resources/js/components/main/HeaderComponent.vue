<template>
  <header class="p-3 border-bottom fixed-top header wow fadeInDown">
      <div class="container">
        <div class="row header-height justify-content-center">
          <div class="col align-items-center">
            <div class="d-flex flex-wrap justify-content-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
                    <img :src="logo" alt="Logo" class="logo-main">
                </a>
            </div>
          </div>
          <div v-if="screenWidth>=992" class="col">
            <ul class="nav d-flex justify-content-center">
              <li><a href="#merchant" class="nav-link px-2 header-link">Мерчант</a></li>
              <li><a href="#use" class="nav-link px-2 header-link">Обмен Валют</a></li>
              <li><a href="#contacts" class="nav-link px-2 header-link">Контакты</a></li>
              <li><a href="#about" class="nav-link px-2 header-link">О нас</a></li>
            </ul>
          </div>
          <div v-else class="col">
            <div v-if="!this.isMenuOpen" class="d-flex flex-wrap justify-content-end">
              <button class="nav-bar-button wow fadeIn" @click="openMenu()"><i class="las la-bars"></i></button>
            </div>
          </div>
        </div>
      </div>
  </header>
  <div v-if="this.isMenuOpen" class="side-bar wow fadeIn" :class="{'myFadeOut': this.isAnimationClose}">
    <div class="row">
      <div class="col-12">
        <ul class="nav d-flex flex-column justify-content-center align-items-center" style="padding: 0;">
          <li><a @click="href('#merchant')" class="nav-link header-link-mobile">Мерчант</a></li>
          <li><a @click="href('#use')" class="nav-link header-link-mobile">Обмен Валют</a></li>
          <li><a @click="href('#contacts')" class="nav-link header-link-mobile">Контакты</a></li>
          <li><a @click="href('#about')" class="nav-link header-link-mobile">О нас</a></li>
        </ul>
      </div>
      <div class="col-12 d-flex flex-column justify-content-center align-items-center">
        <button class="nav-bar-button-close" @click="closeMenu()"><i class="las la-times"></i></button>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  data() {
    return {
      logo: '/img/main/logo-header-comp.png',
      isMenuOpen: false,
      isAnimationClose: false,
    };
  },
  props: {
    screenWidth: {
      type: Number,
      required: true,
    },
  },
  methods: {
    openMenu() {
      this.isMenuOpen = true;
    },
    closeMenu() {
      this.isAnimationClose = true;
      setTimeout(() => { 
        this.isMenuOpen = false; 
        this.isAnimationClose = false;
      }, 500);
    },
    href(address) {
      window.location.href = address;
      this.closeMenu();
    }
  }
}

</script>

<style>
header{
  background: rgba( 255, 255, 255, 0.25 );
  box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
  backdrop-filter: blur( 4px );
  -webkit-backdrop-filter: blur( 4px );
  border-radius: 10px;
  border: 1px solid rgba( 255, 255, 255, 0.18 );
}

.header-height{
    margin: 0rem;
}
.logo-main {
  height: 3rem;
}

.header-link{
  color: #262626;
  text-align: center;
  font-family: Montserrat-SemiBold;
  font-size: 1rem;
  font-style: normal;
  font-weight: 300;
  line-height: normal;
}

.header-link:hover{
  color: red;
  cursor: pointer;
}

.nav-bar-button{
    color: #ffffff;
    font-family: Montserrat-Regular;
    font-size: 1.3rem;
    display: flex;
    padding: 0.5rem;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 0.625rem;
    flex-shrink: 0; 
    border-radius: 50%;
    background:  #18181B;
    border: none;
    outline: none;
}

.nav-bar-button-close{
    margin-top: 1rem;
    color: #ffffff;
    font-family: Montserrat-SemiBold;
    font-size: 1.3rem;
    display: flex;
    padding: 0.5rem;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 0.625rem;
    flex-shrink: 0; 
    border-radius: 50%;
    background:  #ff0000;
    border: none;
    outline: none;
}

.side-bar {
  position: fixed;
  width: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba( 255, 255, 255, 0.25 );
  box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
  backdrop-filter: blur( 4px );
  -webkit-backdrop-filter: blur( 4px );
  border-radius: 10px;
  border: 1px solid rgba( 255, 255, 255, 0.18 );
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999; /* Устанавливаем высокий z-index */
}

.header-link-mobile{
  color: #18181B;
  text-align: center;
  font-family: Montserrat-SemiBold;
  font-size: 1.4rem;
  font-style: normal;
  font-weight: 300;
  line-height: normal;
}

.header-link-mobile:hover{
  color: red;
  cursor: pointer;
}

@media screen and (max-width: 475px) {
  .logo-main {
    height: 2.5rem;
  }
}

@media screen and (max-width: 423px) {
  .logo-main {
    height: 2rem;
  }
}

</style>