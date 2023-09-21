<template>
    <ModalMerchantComponent v-if="isModalMerchantOpen" v-on:close="closeModal('merchant')" :class="{'myFadeOut': this.isModalAnimationCloseMerchant, 'myFadeIn': this.isModalMerchantOpen}"></ModalMerchantComponent>
    <section class="merchant-section wow fadeIn" id="merchant">
        <div class="container">
            <div class="merchant text-center">
                <div class="row justify-content-center align-items-center">
                    <div class="align-items-center" :class="{'col-6': screenWidth >= 992, 'col-12': screenWidth < 1200}">
                        <h1 class="merchant-label">YOMMOTSU merchant</h1>
                        <p class="merchant-text">Наша платежная система - это быстрая и удобная система для осуществления платежей. Мы предлагаем широкий спектр возможностей, включая финансовые операции за рубежом и уникальную кассу в Telegram для вашего бизнеса.<br> Мы гарантируем безопасность и надежность всех транзакций, а также оперативную поддержку наших клиентов.<br> Присоединяйтесь к нам и упростите процесс принятия оплаты уже сегодня! </p>
                        <div class="d-flex justify-content-center">
                            <button class="merchant-button" @click="openModal('merchant')">Оставить заявку</button>
                        </div>
                    </div>
                    <div v-if="screenWidth>1200" class="col-6 mt-auto">
                        <img class="merchant-img" :src="srcPhoneImg">
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>import { defineAsyncComponent } from 'vue';

export default {
  components: {
    ModalMerchantComponent: defineAsyncComponent(() => import('./ModalMerchantMainComponent.vue')),
  },
  data() {
    return {
      srcPhoneImg: '/img/main/merchant-img.png',
      isModalMerchantOpen: false,
      isModalAnimationCloseMerchant: false,
    };
  },
  props: {
    screenWidth: {
      type: Number,
      required: true,
    },
  },
  methods:{
    openModal(move) {
        switch (move){
            case 'merchant':
                this.isModalMerchantOpen = true;
                break;
        }
    },
    closeModal(move) {
        switch (move) {
            case 'merchant':
                this.isModalAnimationCloseMerchant = true;
                setTimeout(() => { 
                    this.isModalMerchantOpen = false; 
                    this.isModalAnimationCloseMerchant = false;
                }, 500);
                break;
        }
    }
}
}

</script>

<style>
.merchant-section{
    padding-top: 6rem;
}

.merchant {
    margin-bottom: 3rem;
    height: 40rem;
    padding-left: 3rem;
    background: 
         url(/img/main/merchant-bg1-img.png) no-repeat top right, 
         url(/img/main/merchant-bg2-img.png) no-repeat bottom left;
    background-color: #f1f1f1;
    background-size: auto;
    background-position: right -2rem top -29rem, left bottom -28rem;
    box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
    backdrop-filter: blur( 20px );
    -webkit-backdrop-filter: blur( 20px );
    border-radius: 1rem;
    overflow: hidden;
}

.merchant-label{
    color: var(--gray-900, #18181B);
    font-family: Montserrat-SemiBold;
    font-size: 2rem;
    font-style: normal;
    font-weight: 700;
    line-height: 2.21875rem; /* 147.917% */
    letter-spacing: -0.0625rem;
    margin-top: -10rem;
    margin-bottom: 1.5rem;
    text-align: start;
}

.merchant-text {
    color: #6F6F6F;
    font-family: Montserrat-Regular;
    font-size: 1.2rem;
    font-style: normal;
    font-weight: 500;
    line-height: 1.625rem;
    margin-top: 1rem;
    margin-bottom: 1rem;
    text-align: start;
}

.merchant-button {
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: #ffffff;
    font-family: Montserrat-Regular;
    font-size: 1.2rem;
    display: flex;
    width: 13rem;
    padding: 0.5rem;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 0.625rem;
    flex-shrink: 0; 
    border-radius: 0.625rem;
    background:  #18181B;
    box-shadow: 0 0 3rem red;
    border: none;
    outline: none;
}

.merchant-button:hover{
    color: #ffffff;
    background: #18181bf6;
    box-shadow: 0 0 3rem red;
}

.merchant-img{
    height: 50rem;
    position: relative;
    top: 5rem;
}

@media screen and (max-width: 1200px) {

    .merchant {
        padding-left: 3rem;
        padding-right: 3rem;
    }

    .merchant-label{
        color: var(--gray-900, #18181B);
        font-family: Montserrat-SemiBold;
        font-size: 2rem;
        font-style: normal;
        font-weight: 700;
        line-height: 2.21875rem; /* 147.917% */
        letter-spacing: -0.0625rem;
        margin-top: 12rem;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .merchant-text {
        color: #6F6F6F;
        font-family: Montserrat-Regular;
        font-size: 1.2rem;
        font-style: normal;
        font-weight: 500;
        line-height: 1.625rem;
        margin-top: 1rem;
        margin-bottom: 1rem;
        text-align: center;
    }
}


@media screen and (max-width: 992px) {
    .merchant {
        padding: 2rem;
        height: auto;
    }
    .merchant-label{
        font-size: 1.8rem;
        font-weight: 700;
        line-height: 2.21875rem; /* 147.917% */
        letter-spacing: -0.0625rem;
        margin-top: 11rem;
        margin-bottom: 1.5rem;
    }

    .merchant-text {
        font-size: 1rem;
        font-weight: 500;
        line-height: 1.625rem;
        margin-top: 1rem;
        margin-bottom: 1rem;
    }
    .merchant-button {
        margin-top: 1.8rem;
        margin-bottom: 0.9rem;
        font-size: 1rem;
        width: 9.9rem;
        padding: 0.5rem;
        gap: 0.625rem;
        border-radius: 0.625rem;
    }
}

@media screen and (max-width: 769px) {
    .merchant-label{
        font-size: 1.8rem;
        font-weight: 700;
        line-height: 2.21875rem; /* 147.917% */
        letter-spacing: -0.0625rem;
        margin-top: 8rem;
        margin-bottom: 1.5rem;
    }
}

@media screen and (max-width: 576px) {
    
    .merchant-label{
        font-size: 1.6rem;
        font-weight: 700;
        line-height: 2.21875rem; /* 147.917% */
        letter-spacing: -0.0625rem;
        margin-top: 10rem;
        margin-bottom: 1.5rem;
    }

    .merchant-text {
        font-size: 0.9rem;
        font-weight: 500;
        line-height: 1.625rem;
        margin-top: 1rem;
        margin-bottom: 1rem;
    }
    .merchant-button {
        margin-top: 1.62rem;
        margin-bottom: 0.81rem;
        font-size: 0.9rem;
        width: 8.91rem;
        padding: 0.5rem;
        gap: 0.625rem;
        border-radius: 0.625rem;
    }
}

@media screen and (max-width: 769px) {
    .merchant-label{
        font-size: 1.8rem;
        font-weight: 700;
        line-height: 2.21875rem; /* 147.917% */
        letter-spacing: -0.0625rem;
        margin-top: 0rem;
        margin-bottom: 1.5rem;
    }
}

</style>