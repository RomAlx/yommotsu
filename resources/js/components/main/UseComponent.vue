<template>
    <ModalChangeComponent v-if="isModalChangeOpen" v-on:close="closeModal('change')" :class="{'myFadeOut': this.isModalAnimationCloseChange, 'myFadeIn': this.isModalChangeOpen}"></ModalChangeComponent>
    <ModalBuyProductComponent v-if="isModalBuyOpen" v-on:close="closeModal('buy')" :class="{'myFadeOut': this.isModalAnimationCloseBuy, 'myFadeIn': this.isModalBuyOpen}"></ModalBuyProductComponent>
    <section class="use" id="use">
        <div class="container">
            <div class="use-card-label wow fadeIn">
                <h1 class="use-label-main"><span class="use-label-main-emoji">👋</span> Чем мы можем быть полезны?</h1>
            </div>
            <ChangeComponent></ChangeComponent>
            <div class="row">
                <div :class="{'col-7 fadeInLeft': screenWidth >= 992, 'col-12 text-center fadeIn': screenWidth < 992}" class="wow">
                    <div class="use-card-row-1">
                        <h1 class="use-label">Зарабатываете в рублях, а живете за границей?</h1>
                        <p class="use-text">Отлично! Тогда мы поможем с покупкой: BTC, ETH, BNB, USDT, и любую валюту, которая есть в списке CoinMarketCap.</p>
                        <div :class="{'d-flex justify-content-center': screenWidth < 992}">
                            <a class="use-button" :href="connect_url" target="_blank">
                                <span>Начать <i class="las la-comment"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div :class="{'col-5 fadeInRight': screenWidth >= 992, 'col-12 text-center fadeIn': screenWidth < 992}" class="wow">
                    <div class="use-card-row-1">
                        <h1 class="use-label">Музыкант?</h1>
                        <p class="use-text">Примем ваши платежи в долларах, евро и отдадим рублями!<br> С нами уже работают: Dimma Urih, Gleb Filipchenkow</p>
                        <div :class="{'d-flex justify-content-center': screenWidth < 992}">
                            <a class="use-button" :href="connect_url" target="_blank">
                                <span>Начать <i class="las la-comment"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div :class="{'col-4 fadeInLeft': screenWidth >= 992, 'col-12 text-center fadeIn': screenWidth < 992}" class="wow">
                    <div class="use-card-row-2">
                        <h1 class="use-label">Нужны Доллары?</h1>
                        <p class="use-text">Вы можете получить у нас любое количество долларов наличными за криптовалюту, рубли, лиры или баты.</p>
                        <div :class="{'d-flex justify-content-center': screenWidth < 992}">
                            <a class="use-button" :href="connect_url" target="_blank">
                                <span>Начать <i class="las la-comment"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div :class="{'col-8 fadeInRight': screenWidth >= 992, 'col-12 text-center fadeIn': screenWidth < 992}" class="wow">
                    <div class="use-card-row-2">
                        <h1 class="use-label">SWIFT? Не проблема!</h1>
                        <p class="use-text">Открытые направления: Турция / Таиланд.<br> Так же, мы предоставляем консультацию и полное сопровождение, если вы хотите работать по своим счетам.<br> Помогаем открыть счета в Турции, Таиланде, Казахстане и России.</p>
                        <div :class="{'d-flex justify-content-center': screenWidth < 992}">
                            <a class="use-button" :href="connect_url" target="_blank">
                                <span>Начать <i class="las la-comment"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div :class="{'col-7 fadeInLeft': screenWidth >= 992, 'col-12 text-center fadeIn': screenWidth < 992}" class="wow">
                    <div class="use-card-row-3">
                        <h1 class="use-label">Хотите сделать покупку на EBay, Farfetch  и других зарубежных площадках?</h1>
                        <p class="use-text">Не проблема, мы закажем и оплатим любой товар, и доставим в любую точку мира!</p>
                        <div :class="{'d-flex justify-content-center': screenWidth < 992}">
                            <button class="use-button" @click="openModal('buy')"><span>Начать <i class="las la-comment"></i></span></button>
                        </div>
                    </div>
                </div>
                <div :class="{'col-5 fadeInRight': screenWidth >= 992, 'col-12 text-center fadeIn': screenWidth < 992}" class="wow">
                    <div class="use-card-row-3">
                        <h1 class="use-label">Хотите купить криптовалюту за рубли или доллары? </h1>
                        <p class="use-text">Примем любой рублёвый перевод на любой банк РФ, взамен выдадим любое количество или долларов наличными, или местной валюты. Либо переведём на счёт.</p>
                        <div :class="{'d-flex justify-content-center': screenWidth < 992}">
                            <a class="use-button" :href="connect_url" target="_blank">
                                <span>Начать <i class="las la-comment"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { defineAsyncComponent } from 'vue';

export default {
  components: {
    ChangeComponent: defineAsyncComponent(() => import('./ChangeComponent.vue')),
    ModalChangeComponent: defineAsyncComponent(() => import('./ModalChangeMainComponent.vue')),
    ModalBuyProductComponent: defineAsyncComponent(() => import('./ModalBuyProductComponent.vue')),
  },
    props: {
    screenWidth: {
      type: Number,
      required: true,
    },
  },
  data() {
    return {
      srcUseAnnotationImg: '/img/main/use-annotation.png',
      connect_url: 'https://t.me/yommotsu_admin',
      isModalChangeOpen: false,
      isModalAnimationCloseChange: false,
      isModalBuyOpen: false,
      isModalAnimationCloseBuy: false,
    };
  },
  methods:{
    openModal(move) {
        switch (move){
            case 'change':
                this.isModalChangeOpen = true;
                break;
            case 'buy':
                this.isModalBuyOpen = true;
                break;
        }
    },
    closeModal(move) {
        switch (move) {
            case 'change':
                this.isModalAnimationCloseChange = true;
                setTimeout(() => { 
                    this.isModalChangeOpen = false; 
                    this.isModalAnimationCloseChange = false;
                }, 500);
                break;
            case 'buy':
                this.isModalAnimationCloseBuy = true;
                setTimeout(() => { 
                    this.isModalBuyOpen = false; 
                    this.isModalAnimationCloseBuy = false;
                }, 500);
                break;
        }
    }
  }
}

</script>

<style>
.use{
    padding-top: 6rem;
}

.use-card-label{
    margin-bottom: 1rem;
    background: #f1f1f1 url(/img/main/use-label-img.png) no-repeat center;
    background-position: 45vw center;
    box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
    backdrop-filter: blur( 20px );
    -webkit-backdrop-filter: blur( 20px );
    border: 0.25rem solid rgba( 255, 255, 255, 0.18 );
    padding: 2rem;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 0.625rem;
    flex-shrink: 0; 
    border-radius: 1rem;
}

.use-label-main{
    color: var(--gray-900, #18181B);
    font-family: Montserrat-SemiBold;
    font-size: 2rem;
    font-style: normal;
    font-weight: 700;
    line-height: 2.21875rem; /* 147.917% */
    letter-spacing: -0.0625rem;
}

.use-label-main-emoji{
    font-family: var(--bs-font-sans-serif);
}

.use-card{
    margin-top: 1rem;
    background: #f1f1f1;
    box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
    backdrop-filter: blur( 20px );
    -webkit-backdrop-filter: blur( 20px );
    border: 0.25rem solid rgba( 255, 255, 255, 0.18 );
    height: 19vw; 
    padding-top: 2vw;
    padding-left: 2vw;
    padding-right: 2vw;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 0.625rem;
    flex-shrink: 0; 
    border-radius: 1rem;
}

.use-card-row-1{
    margin-top: 1rem;
    background: #f1f1f1;
    box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
    backdrop-filter: blur( 20px );
    -webkit-backdrop-filter: blur( 20px );
    border: 0.25rem solid rgba( 255, 255, 255, 0.18 );
    height: 13rem; 
    padding-top: 1rem;
    padding-left: 1.5rem;
    padding-right: 1.5rem;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 0.625rem;
    flex-shrink: 0; 
    border-radius: 1rem;
}

.use-card-row-2{
    margin-top: 1rem;
    background: #f1f1f1;
    box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
    backdrop-filter: blur( 20px );
    -webkit-backdrop-filter: blur( 20px );
    border: 0.25rem solid rgba( 255, 255, 255, 0.18 );
    height: 14rem;  
    padding-top: 1rem;
    padding-left: 1.5rem;
    padding-right: 1.5rem;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 0.625rem;
    flex-shrink: 0; 
    border-radius: 1rem;
}

.use-card-row-3{
    margin-top: 1rem;
    background: #f1f1f1;
    box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
    backdrop-filter: blur( 20px );
    -webkit-backdrop-filter: blur( 20px );
    border: 0.25rem solid rgba( 255, 255, 255, 0.18 );
    height: 15rem;  
    padding-top: 1rem;
    padding-left: 1.5rem;
    padding-right: 1.5rem;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 0.625rem;
    flex-shrink: 0; 
    border-radius: 1rem;
}

.use-label{
    color: var(--gray-900, #18181B);
    font-family: Montserrat-SemiBold;
    font-size: 1.5rem;
    font-style: normal;
    font-weight: 700;
    line-height: 2.21875rem; /* 147.917% */
    letter-spacing: -0.0625rem;
}

.use-text{
    color: #2e2e2e;
    font-family: Montserrat-Regular;
    font-size: 0.9rem;
    font-style: normal;
    font-weight: 500;
    line-height: 1.1875rem;
}

.use-button{
    margin-top: 3rem;
    color: #ffffff;
    font-family: Montserrat-SemiBold;
    font-size: 1rem;
    display: flex;
    width: 8rem;
    height: 2.3rem;
    padding: 0.2rem;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 0.625rem;
    flex-shrink: 0; 
    border-radius: 0.625rem;
    background:  #050505;
    border: none;
    outline: none;
    position: absolute;
    text-decoration: none;
    bottom: 1rem;
    left: 1.5rem;
}

@media screen and (max-width: 1400px) {
    .use-card-label{
        margin-bottom: 1rem;
        padding: 2rem;
        gap: 0.625rem;
        border-radius: 1rem;
    }

    .use-label-main{
        font-size: 1.8rem;
        line-height: 2.21875rem;
        letter-spacing: -0.0625rem;
    }

    .use-card-row-1{
        margin-top: 0.8rem;
        box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
        border: 0.25rem solid rgba( 255, 255, 255, 0.18 );
        height: 13rem; 
        padding-top: 1rem;
        padding-left: 1.5rem;
        padding-right: 1.5rem;
        gap: 0.625rem;
        border-radius: 1rem;
    }

    .use-card-row-2{
        margin-top: 0.8rem;
        border: 0.25rem solid rgba( 255, 255, 255, 0.18 );
        height: 14rem;  
        padding-top: 1rem;
        padding-left: 1.5rem;
        padding-right: 1.5rem;
        gap: 0.625rem;
        border-radius: 1rem;
    }

    .use-card-row-3{
        margin-top: 0.8rem;
        backdrop-filter: blur( 20px );
        -webkit-backdrop-filter: blur( 20px );
        border: 0.25rem solid rgba( 255, 255, 255, 0.18 );
        height: 15rem;  
        padding-top: 1rem;
        padding-left: 1.5rem;
        padding-right: 1.5rem;
        gap: 0.625rem;
        flex-shrink: 0; 
        border-radius: 1rem;
    }

    .use-label{
        font-size: 1.2rem;
        font-weight: 700;
        line-height: 2.21875rem;
        letter-spacing: -0.0625rem;
    }

    .use-text{
        font-size: 0.8rem;
        line-height: 1.1875rem;
    }

    .use-button{
        margin-top: 2.4rem;
        font-size: 0.9rem;
        width: 7.2rem;
        height: 2.07rem;
        padding: 0.19rem;
        border-radius: 0.5625rem;
        background:  #050505;
        bottom: 0.9rem;
        left: 1.35rem;
    }
}

@media screen and (max-width: 992px) {
    .use-card-label{
        margin-bottom: 1rem;
        padding: 2rem;
        gap: 0.625rem;
        border-radius: 1rem;
    }

    .use-label-main{
        font-size: 1.8rem;
        line-height: 2.21875rem;
        letter-spacing: -0.0625rem;
    }

    .use-card-row-1{
        margin-top: 0.8rem;
        height: auto;
        box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
        border: 0.25rem solid rgba( 255, 255, 255, 0.18 );
        padding-top: 1rem;
        padding-bottom: 1rem;
        padding-left: 1.5rem;
        padding-right: 1.5rem;
        gap: 0.625rem;
        border-radius: 1rem;
    }

    .use-card-row-2{
        margin-top: 0.8rem;
        height: auto;
        border: 0.25rem solid rgba( 255, 255, 255, 0.18 );
        padding-top: 1rem;
        padding-left: 1.5rem;
        padding-right: 1.5rem;
        padding-bottom: 1rem;
        gap: 0.625rem;
        border-radius: 1rem;
    }

    .use-card-row-3{
        margin-top: 0.8rem;
        height: auto;
        backdrop-filter: blur( 20px );
        -webkit-backdrop-filter: blur( 20px );
        border: 0.25rem solid rgba( 255, 255, 255, 0.18 );
        padding-top: 1rem;
        padding-left: 1.5rem;
        padding-right: 1.5rem;
        padding-bottom: 1rem;
        gap: 0.625rem;
        flex-shrink: 0; 
        border-radius: 1rem;
    }

    .use-label{
        font-size: 1.2rem;
        font-weight: 700;
        line-height: 2.21875rem;
        letter-spacing: -0.0625rem;
    }

    .use-text{
        font-size: 0.8rem;
        line-height: 1.1875rem;
    }

    .use-button{
        margin-top: 1rem;
        font-size: 0.9rem;
        width: 7.2rem;
        height: 2.07rem;
        padding: 0.19rem;
        border-radius: 0.5625rem;
        background:  #050505;
        position: relative;
        bottom: 0rem;
        left: 0rem;
    }
}
@media screen and (max-width: 768px) {
    .use-card-label{
        padding: 1rem;
    }

    .use-label-main{
        font-size: 1.6rem;
        font-weight: 700;
        line-height: 2.21875rem; 
    }

    .use-label{
        text-align: center;
    }

    .use-text{
        text-align: center;
    }
}

@media screen and (max-width: 576px) {
    .use-card-label{
        padding: 0.5rem;
    }

    .use-label-main{
        font-size: 1.4rem;
        font-weight: 700;
        line-height: 2.21875rem; 
        text-align: center;
    }

    .use-label{
        text-align: center;
    }

    .use-text{
        text-align: center;
    }
}
</style>