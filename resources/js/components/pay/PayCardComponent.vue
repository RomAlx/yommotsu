<template>
    <div class="row wow fadeIn">
        <div class="row align-items-center">
            <div class="col align-items-center">
                <div class="container rules-card">
                    <h5 class="label-rules">Правила</h5>
                    <h5 class="rules">1. Перевод осуществляются строго с выборного банка на банк.</h5>
                    <h5 class="rules">2. ФИО которое вы указываете, должно полностью совпадать с ФИО отправителя.</h5>
                    <h5 class="rules">3. Всегда указывайте в комментарий к платежу последние 4 символа вашего заказа.</h5>
                    <h5 class="rules">4. Если вы нарушаете правила - обратитесь в поддержку для уточнения статуса вашего платежа.</h5>
                    <div class="row">
                        <div class="col">
                            <h5 class="label">Ваш комментарий:</h5>
                            <h5 class="label comment">{{this.order.order_id.slice(-4)}}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col align-items-center">
                <div class="container payment-card" :class="bank">
                    <div class="row align-items-center">
                        <div class="col-7 to-left-side">
                            <small class="card-label">Название проекта</small>
                            <h5 class="card-fill-small">{{this.order.project_name}}</h5>
                            <small class="card-label">Владелец</small>
                            <h5 class="card-fill-small">{{this.merchant.name}}</h5>
                        </div>
                        <div class="col-5 justify-content-center logo">
                            <div class="logo-div">
                                <img :src="srcLogo" alt="bank" :class="logobank">
                            </div>
                        </div>
                    </div>
                    <div class="row second-half">
                        <div class="col-9 to-left-side">
                            <div class="row justify-content-start">
                                <div class="col-5"><small class="card-label">Номер карты</small></div>
                                <div class="col-1"><img class="card-copy" :src="srcServiceCopyBank" @click="copyToClipboard('bank-number')"></div>
                            </div>
                            <h5 class="card-fill-big" id="bank-number">{{this.merchant.bank_number}}</h5>
                        </div>
                        <div class="col-3 justify-content-center">
                            <div class="row justify-content-center">
                                <div class="col-6"><small class="card-label">Сумма</small></div>
                                <div class="col-1"><img class="card-copy" :src="srcServiceCopyAmount" @click="copyToClipboard('amount')"></div>
                            </div>
                            <h5 class="card-fill-big" id="amount">{{this.order.amount}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container fix-width">
            <div class="row justify-content-center">
                <div class="col">
                        <button type="button" class="done-button" @click="getBack()">Назад</button>
                </div>
                <div class="col">
                    <button class="done-button" @click="pay()">Я оплатил!</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import copy from 'clipboard-copy';

export default {
  data() {
    return {
      tinkoff: '/img/paycard/tinkoff.png',
      sber: '/img/paycard/sberbank.png',
      sbp: '/img/paycard/sbp.png',
      srcServiceCopyBank: "/img/service/copy_white.png",
      srcServiceCopyAmount: "/img/service/copy_white.png",
    };
  },
  props: {
    merchant: {
      type: Object,
      required: true,
    },
    order: {
      type: Object,
      required: true,
    },
  }, 
  computed: {
        bank() {
            console.log(this.merchant);
            return this.merchant.bank;
        },
        srcLogo () {
            return '/img/paycard/'+this.merchant.bank+'.png';
        },
        logobank () {
            return 'logo-' + this.merchant.bank;
        }
  },
  methods: {
      getBack() {
        console.log(`Назад`);
        this.$emit("update:Step", 'Form');
      },
      copyToClipboard(id) {
        this.srcServiceCopyBank = "/img/service/copy_white.png";
        this.srcServiceCopyAmount = "/img/service/copy_white.png";
        const element = document.getElementById(id);
        const textToCopy = element.innerText;
        try {
            copy(textToCopy);
            if(id == 'bank-number'){
                this.srcServiceCopyBank = "/img/service/done_white.png";
            }
            if(id == 'amount'){
                this.srcServiceCopyAmount = "/img/service/done_white.png";
            }
        } catch (error) {
            console.log('Не удалось скопировать.');
        }
      },
      pay() {
        this.$emit("update:Card", {step: 'Timer'});
      }
    }
};
</script>

<style scoped>
.row {
  display: flex;
  flex-direction: row;
  justify-content: center;
}

.col {
  display: flex;
  flex-direction: column;
  align-items: center;
}
.rules-card{
    margin: 1rem;
    width: 35rem;
    height: 22rem;
    padding: 2rem;
    flex-shrink: 0;
    border-radius: 0.9375rem;
    background: rgba( 255, 255, 255, 0.5 );
    box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
}

.label-rules{
    color: #262626;
    font-family: Montserrat-SemiBold;
    font-size: 1.2rem;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
}

.rules{
    text-align: start;
    color: #262626;
    font-family: Montserrat-Regular;
    font-size: 0.9rem;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
}

.payment-card{
    width: 35rem;
    height: 19.44rem;
    padding: 2rem;
    flex-shrink: 0;
    border-radius: 1.4375rem;
    display: block;
}

.sberbank{
    background: var(--grad-1, linear-gradient(319deg, #15151D 17.71%, #6ecf6d 100%));
    box-shadow: 0px 2px 19px 3px rgba(0, 0, 0, 0.31);
}
.tinkoff{
    background: linear-gradient(319deg, #15151D 17.71%, #af9e00 88.89%);
    box-shadow: 0px 2px 19px 3px rgba(0, 0, 0, 0.31);
}
.sbp{
    background: linear-gradient(319deg, #15151D 17.71%, #5271a1 100%);
    box-shadow: 0px 2px 19px 3px rgba(0, 0, 0, 0.31);
}

.card-label{
    color: #DDD;
    font-family: Montserrat-Regular;
    font-size: 0.875rem;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
}

.card-copy{
    height: 0.875rem;
}

.card-fill-small{
    color: #FFF;
    font-family: Montserrat-SemiBold;
    font-size: 1.5625rem;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
}
.card-fill-big{
    color: #FFF;
    font-family: Montserrat-SemiBold;
    font-size: 2rem;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
}

.to-left-side{
    text-align: left
}

.second-half{
    margin-top: 3rem;
}

.comment{
  font-family: Montserrat-Bold;
  font-size: 1.6rem;
}

.logo-sberbank{
    width: 12rem;
    height: 3.5rem;
}

.logo-tinkoff{
    width: 10rem;
    height: 7.8rem;
}

.logo-sbp{
    width: 12rem;
    height: 6rem;
}

.fix-width{
    margin: 2rem;
    width: 35rem;
}


@media screen and (max-width: 765px) {
    .rules-card{
        margin-bottom: 1rem;
        width: 28rem;
        height: 20rem;
        padding: 2rem;
        border-radius: 0.9375rem;
    }

    .label-rules{
        font-size: 0.96rem;
    }

    .rules{
        font-size: 0.72rem;
    }
    .payment-card{
        width: 28rem;
        height: 15.552rem;
        padding: 1.6rem;
        border-radius: 1.1788rem;
    }

    .card-label{
        font-size: 0.7rem;
    }

    .card-copy{
        height: 0.875rem;
    }

    .card-fill-small{
        font-size: 1.25rem;
    }
    .card-fill-big{
        font-size: 1.6rem;
    }

    .second-half{
        margin-top: 2.4rem;
    }

    .comment{
        font-size: 1.44rem;
    }

    .logo-sberbank{
        width: 9.6rem;
        height: 2.8rem;
    }

    .logo-tinkoff{
        width: 8rem;
        height: 6.24rem;
    }

    .logo-sbp{
        width: 9.6rem;
        height: 4.8rem;
    }   

    .fix-width{
        width: 28rem;
    }
}

@media screen and (max-width: 475px) {
    .rules-card{
        margin-bottom: 1rem;
        width: 22.4rem;
        height: 21rem;
        padding: 2rem;
        border-radius: 0.9375rem;
    }

    .label-rules{
        font-size: 0.96rem;
    }

    .rules{
        font-size: 0.72rem;
    }

    .payment-card{
        width: 22.4rem;
        height: 12.44rem;
        padding: 1.28rem;
        border-radius: 0.96rem;
    }

    .card-label{
        font-size: 0.56rem;
    }

    .card-copy{
        height: 0.7rem;
    }

    .card-fill-small{
        font-size: 1rem;
    }
    .card-fill-big{
        font-size: 1.28rem;
    }
    .second-half{
        margin-top: 1rem;
    }

    .comment{
        font-size: 1.152rem;
    }

    .logo-sberbank{
        width: 7.68rem;
        height: 2.24rem;
    }

    .logo-tinkoff{
        width: 6.4rem;
        height: 4.9rem;
    }

    .logo-sbp{
        width: 7.68rem;
        height: 3.84rem;
    }   

    .fix-width{
        width: 22.4rem;
    }
}

@media screen and (max-width: 405px) {
    .payment-card{
        width: 19.04rem;
        height: 10.574rem;
        padding: 1rem;
        border-radius: 0.8rem;
    }

    .card-label{
        font-size: 0.476rem;
    }

    .card-copy{
        height: 0.6rem;
    }

    .card-fill-small{
        font-size: 0.85rem;
    }
    .card-fill-big{
        font-size: 1rem;
    }
    .second-half{
        margin-top: 0.2rem;
    }

    .logo-sberbank{
        width: 6.528rem;
        height: 1.9rem;
    }

    .logo-tinkoff{
        width: 5.44rem;
        height: 4.165rem;
    }

    .logo-sbp{
        width: 6.528rem;
        height: 3.264rem;
    }   
}

</style>