<template>
    <section class="footer wow fadeInUp">
        <footer>
            <div class="container">
                <div class="row align-items-center">
                    <div :class="{'col-3': screenWidth >= 1200, 'col-12 align-items-center text-center': screenWidth<1200}">
                        <a href="/" class="d-flex align-items-center link-body-emphasis text-decoration-none text-center">
                            <img :src="logo" alt="Logo" class="logo-footer">
                        </a>
                    </div>
                    <div :class="{'col-6': screenWidth >= 1200, 'col-12 align-items-center text-center': screenWidth<1200}">
                        <div class="row justify-content-end align-items-center">
                            <div class="col-3 align-items-center">
                                <a href="/#merchant" class="footer-label">Мерчант</a>
                            </div>
                            <div class="col-3 align-items-center">
                                <a href="/#use" class="footer-label">Обмен</a>
                            </div>
                            <div class="col-3 align-items-center">
                                <a href="/#contacts" class="footer-label">Контакты</a>
                            </div>
                            <div class="align-items-center" :class="{'col-2': screenWidth >= 1200, 'col-3': screenWidth<1200}">
                                <a href="/#about" class="footer-label">О нас</a>
                            </div>
                        </div>
                    </div>
                    <div :class="{'col-3': screenWidth >= 1200, 'col-12 align-items-center text-center social': screenWidth<1200}">
                        <div class="row" :class="{'justify-content-end': screenWidth >= 1200, 'justify-content-center': screenWidth<1200}">
                            <div class="align-items-center" :class="{'col-3': screenWidth >= 1200, 'col-1': screenWidth<1200 && screenWidth>= 768, 'col-2': screenWidth<768}">
                                <a href="https://t.me/yommotsu_university" target="_blank" class="footer-social" ><i class="lab la-telegram"></i></a>
                            </div>
                            <div class="align-items-center" :class="{'col-3': screenWidth >= 1200, 'col-1': screenWidth<1200 && screenWidth>= 768, 'col-2': screenWidth<768}">
                                <a href="mailto:admin@yommotsu.com" target="_blank" class="footer-social"><i class="las la-envelope"></i></a>
                            </div>
                            <div class="align-items-center" :class="{'col-3': screenWidth >= 1200, 'col-1': screenWidth<1200 && screenWidth>= 768, 'col-2': screenWidth<768}">
                                <a href="https://t.me/yommotsubot" target="_blank" class="footer-social"><i class="las la-robot"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="policy">
                        <div class="row justify-content-center">
                            <div class="col-5 align-items-center text-center">
                                <a class="policy-link" href="/policy">Политика сервиса</a>
                            </div>
                            <div class="col-5 align-items-center text-center">
                                <a class="policy-link" href="/treatment">Обработка данных</a>
                            </div>
                        </div>
                    </div>
                    <div class="rights">
                        <div class="row justify-content-center">
                            <div class="col-12 align-items-center text-center">
                                <h1 class="rights-text">Copyright © 2023 Yommotsu. All Rights Reserved.</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </section>
</template>

<script>
import { ref, onMounted } from 'vue';

export default {
  data() {
    return {
      logo: '/img/main/logo-footer-comp.png',
    };
  },
  setup() {
    const screenWidth = ref(0);

    onMounted(() => {
      screenWidth.value = getWidth(); // Устанавливаем начальное значение screenWidth
      window.addEventListener('resize', updateWidth); // Добавляем слушатель события resize окна
    });

    const getWidth = () => {
      if (typeof window !== 'undefined') {
        return document.documentElement.clientWidth || window.innerWidth;
      }
      return 0;
    };

    const updateWidth = () => {
      screenWidth.value = getWidth();
    };

    return {
      screenWidth,
    };
  },
}

</script>

<style>
a:hover{
    color: red;
    cursor: pointer;
}
.footer{
    margin-top: 3rem;
    padding: 1rem;
    padding-top: 2rem;
    background-color: #000000;
}

.logo-footer{
    height: 3rem;
    display: block;
    margin: 0 auto;
}
.footer-label{
    text-decoration: none;
    color: #ffffff;
    text-align: center;
    font-family: Montserrat-SemiBold;
    font-size: 1rem;
    font-style: normal;
    font-weight: 600;
    line-height: 1.875rem;
}
.social{
    margin: 2rem 0rem;
}

.footer-social{
    color: #cccccc;
    text-align: center;
    font-family: Montserrat-SemiBold;
    font-size: 2rem;
    font-style: normal;
    font-weight: 600;
    line-height: 1.875rem;
}

.policy{
    margin-top: 2rem;
}
.policy-link{
    color: #ffffff;
    font-family: Montserrat-Regular;
    font-size: 1rem;
    font-style: normal;
    font-weight: 400;
    text-decoration: none;
}
.rights{
    margin-top: 2rem;
}

.rights-text{
    color: #b4b2b2;
    font-family: Montserrat-Regular;
    font-size: 0.8rem;
    font-style: normal;
    font-weight: 400;
    text-decoration: none;
}


@media screen and (max-width: 1400px) {
    .footer{
        margin-top: 3rem;
        padding: 1rem;
        padding-top: 2rem;
    }

    .logo-footer{
        height: 3rem;
    }
    .footer-label{
        font-size: 0.9rem;
    }
    .footer-social{
        font-size: 2rem;
    }
}


@media screen and (max-width: 1200px) {
    .footer{
        margin-top: 3rem;
        padding: 1rem;
        padding-top: 2rem;
    }

    .logo-footer{
        margin-top: 1rem;
        margin-bottom: 2rem;
        height: 3rem;
    }
    .footer-label{
        font-size: 0.9rem;
    }
    .footer-social{
        margin-top: 2rem;;
        font-size: 2.5rem;
    }
    .policy{
        margin-top: 0.5rem;
    }
    .policy-link{
        font-size: 0.9rem;
    }
    .rights{
        margin-top: 2rem;
    }

    .rights-text{
        font-size: 0.7rem;
    }
}

@media screen and (max-width: 768px) {

    .footer{
        margin-top: 2rem;
        padding: 1rem;
        padding-top: 2rem;
    }

    .logo-footer{
        height: 3rem;
    }
    .footer-label{
        font-size: 0.8rem;
    }
    .footer-social{
        margin-top: 1rem;
        font-size: 2rem;
    }
}
</style>