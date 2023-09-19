<template>
    <section>
        <div class="container">
            <div v-if="screenWidth>992" class="offer row justify-content-center align-items-center">
                <div class="col align-items-center wow fadeInLeft">
                    <h1 class="offer-label">Твой помощник в обмене валют и совершении платежей</h1>
                    <p class="offer-text">Наш Сервис призван помочь вам в обмене фиата и криптовалюты, а так же в совершении платежей в интернете и за рубежом.</p>
                    <a href="#use" class="offer-button">Подробнее</a>
                </div>
                <div class="col align-items-center wow fadeInRight">
                    <img class="offer-img" :src="srcOfferImg">
                </div>
            </div>
            <div v-else class="offer row justify-content-center align-items-center text-center">
                <div class="col wow fadeIn">
                    <h1 class="offer-label">Твой помощник в обмене валют и совершении платежей</h1>
                    <img class="offer-img" :src="srcOfferImg">
                    <p class="offer-text">Наш Сервис призван помочь вам в обмене фиата и криптовалюты, а так же в совершении платежей в интернете и за рубежом.</p>
                    <div class="d-flex justify-content-center">
                        <button class="offer-button">Подробнее</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
  props: {
    screenWidth: {
      type: Number,
      required: true,
    },
  },
  data() {
    return {
      srcOfferImg: '/img/main/offer-img.png',
    };
  }
}

</script>

<style>

.offer{
    height:48rem;
}

.offer-label{
    color: var(--gray-900, #18181B);
    font-family: Montserrat-SemiBold;
    font-size: 2rem;
    font-style: normal;
    font-weight: 700;
    line-height: 2.21875rem; /* 147.917% */
    letter-spacing: -0.0625rem;
    margin-top: 1.5rem;
    margin-bottom: 1.5rem;
}

.offer-text {
    color: #6F6F6F;
    font-family: Montserrat-Regular;
    font-size: 1.2rem;
    font-style: normal;
    font-weight: 500;
    line-height: 1.625rem;
    margin-top: 1rem;
    margin-bottom: 1rem;
}

.offer-button {
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: #ffffff;
    font-family: Montserrat-Regular;
    font-size: 1.2rem;
    display: flex;
    width: 11rem;
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
    text-decoration: none;
}

.offer-button:hover{
    color: #ffffff;
    background: #18181bf6;
    box-shadow: 0 0 3rem red;
}

@media screen and (max-width: 1200px) {
    .offer{
        height: 45rem;      
    }
 .offer-img{
    width: 40rem;
 }
}

@media screen and (max-width: 992px) {
    .offer{
        height:50rem;
    }
    .offer-label{
        font-size: 1.6rem;
        line-height: 1.7rem;
        margin-top: 1.2rem;
        margin-bottom: 1.2rem;
        text-align: center;
    }

    .offer-text {
        font-size: 0.96rem;
        line-height: 1.3rem;
        margin-bottom: 0.8rem;
        text-align: center;
    }

    .offer-button {
        margin-top: 1.6rem;
        margin-bottom: 0.8rem;
        font-size: 0.96rem;
        width: 8.8rem;
        padding: 0.4rem;
        border-radius: 0.5rem;
        text-align: center;
    }

    .offer-button:hover{
        box-shadow: 0 0 3rem red;
    }
    .offer-img{
        width: 32rem;
    }
}


@media screen and (max-width: 560px) {
    .offer{
        height: 43rem;
    }
    .offer-label{
        font-size: 1.28rem;
        line-height: 1.36rem;
        margin-top: 0.96rem;
        margin-bottom: 0.96rem;
    }

    .offer-text {
        font-size: 0.9rem;
        line-height: 1.04rem;
        margin-bottom: 0.64rem;
    }

    .offer-button {
        margin-top: 1.28rem;
        margin-bottom: 0.64rem;
        font-size: 0.77rem;
        width: 7.04rem;
        padding: 0.32rem;
        border-radius: 0.4rem;
    }

    .offer-button:hover{
        box-shadow: 0 0 2rem red;
    }
    .offer-img{
        width: 25.6rem;
    }
}

</style>