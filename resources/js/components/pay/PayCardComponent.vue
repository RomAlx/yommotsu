<template>
    <div id="modal" class="modal wow fadeIn">
      <div class="modal-content">
        <span class="close" @click="closeModal">&times;</span>
        <h2 class="modal-label">Правила</h2>
        <p class="modal-text">
            1. Перевод осуществляются строго с выборного банка на банк.<br>
            2. Имя которое вы указываете, должно полностью совпадать с именем держателя карты.<br>
            <span class="modal-text-important">3. Всегда указывайте в комментарий к платежу последние 4 символа вашего заказа.</span><br>
            4. Если вы нарушаете правила - обратитесь в поддержку для уточнения статуса вашего платежа.
        </p>
      </div>
    </div>
    <div class="row wow fadeIn">
        <div class="row align-items-center">
            <div class="col align-items-center">
                <div class="container order-card">
                    <p class="order-label">Ваш заказ</p>
                    <div class="row justify-content-start">
                        <div class="col-3"><p class="fix-top order-field-name">Проект</p></div>
                        <div class="col-9"><p class="fix-top order-field-value">{{ this.order.project_name }}</p></div>
                    </div>
                    <div class="row justify-content-start">
                        <div class="col-3"><p class="fix-top order-field-name">Email</p></div>
                        <div class="col-9"><p class="fix-top order-field-value">{{ this.form.email }}</p></div>
                    </div>
                    <div class="row justify-content-start">
                        <div class="col-3"><p class="fix-top order-field-name">ФИО</p></div>
                        <div class="col-9"><p class="fix-top order-field-value">{{ this.form.name }}</p></div>
                    </div>
                    <div class="row justify-content-start">
                        <div class="col-3"><p class="fix-top order-field-name">Сумма</p></div>
                        <div class="col-9"><p class="fix-top order-field-value">{{ amountString}}</p></div>
                    </div>
                    <div class="row justify-content-start">
                        <div class="col-3"><p class="fix-top order-field-name">Заказ</p></div>
                        <div class="col-9"><p class="fix-top order-field-value">{{ this.order.order_id }}</p></div>
                    </div>
                    <p class="fix-top comment-field-name">Ваш комментарий к переводу</p>
                    <div class="row justify-content-center">
                        <div class="col-1"><p class="fix-top comment-field-value" id="comment">{{ this.order.order_id.slice(-4) }}</p></div>
                        <div class="col-2"><img class="comment-copy" :src="srcServiceCopyComment" @click="copyToClipboard('comment')"></div>
                    </div>
                    <p class="fix-top comment-field-name"><a href="#" @click="openModal">Правила</a></p>
                </div>
            </div>
            <div class="col align-items-center">
                <div class="container payment-card" :class="bank">
                    <div class="row align-items-center">
                        <div class="col-4 to-left-side">
                            <small class="card-label">Проект</small>
                            <h5 class="card-fill-small">{{this.order.project_name}}</h5>
                            <small v-if="!['btc', 'usdt_trc_20', 'usdt_erc_20'].includes(this.merchant.bank)" class="card-label">Владелец</small>
                            <h5 v-if="!['btc', 'usdt_trc_20', 'usdt_erc_20'].includes(this.merchant.bank)" class="card-fill-small">{{this.merchant.name}}</h5>
                        </div>
                        <div class="col-8 to-right-side">
                            <div class="row align-items-center to-right-side">
                                <div v-if="this.merchant.qrcode !== null" class="col-7 justify-content-end logo">
                                    <div class="logo-div">
                                        <img :src="srcQrCode" alt="bank" class="qrcode">
                                    </div>
                                </div>
                                <div class="col-4 justify-content-end logo">
                                    <div class="logo-div">
                                        <img :src="srcLogo" alt="bank" :class="logobank">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row second-half">
                        <div v-if="['btc', 'usdt_trc_20', 'usdt_erc_20'].includes(this.merchant.bank)" class="col-9 to-left-side">
                            <div class="row justify-content-start">
                                <div class="col-3"><small class="card-label">Кошелек</small></div>
                                <div class="col-1"><img class="card-copy" :src="srcServiceCopyBank" @click="copyToClipboard('bank-number')"></div>
                            </div>
                            <h5 class="card-fill-big-crypto" id="bank-number">{{this.merchant.bank_number.slice(0, 20)}}<br>{{this.merchant.bank_number.length > 20 ? this.merchant.bank_number.slice(20): ''}}</h5>
                        </div>
                        <div v-else class="col-9 to-left-side">
                            <div class="row justify-content-start">
                                <div class="col-5"><small class="card-label">Номер карты</small></div>
                                <div class="col-1"><img class="card-copy" :src="srcServiceCopyBank" @click="copyToClipboard('bank-number')"></div>
                            </div>
                            <h5 class="card-fill-big-bank" id="bank-number">{{this.merchant.bank_number}}</h5>
                        </div>
                        <div class="col-3 justify-content-center">
                            <div class="row justify-content-center">
                                <div class="col-6"><small class="card-label">Сумма</small></div>
                                <div class="col-1"><img class="card-copy" :src="srcServiceCopyAmount" @click="copyToClipboard('amount')"></div>
                            </div>
                            <h5 v-if="this.merchant.bank == 'btc'" class="card-fill-big-btc" id="amount">{{amountString}}</h5>
                            <h5 v-else class="card-fill-big" id="amount">{{amountString.slice(0, -2)}}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col align-items-center">
                <div class="container info-card">
                    <p class="info-field"> Для зачисления Вашего депозита, оплатите одним платежом {{amountString}}.<br>
                        В противном случае мы не сможем ИНДИФИЦИРОВАТЬ  Ваш платёж.</p>
                    <p class="info-field"> Реквизиты для оплаты меняются с каждой оплатой.</p>
                    <p class="info-field"> Обязательно пашите КОММЕНТРАТИЙ к ваше платежу. <br>
                        Ваш комментарий к переводу: <span class="info-field-important">{{ this.order.order_id.slice(-4) }}</span></p>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col">
                        <img class="manual-img" :src="srcManualBank">
                        <p class="fix-top manual-field-value">Откройте приложение банка. Скопируйте с этой страницы реквизиты, сумму и комментарий.</p>
                    </div>
                    <div class="col">
                        <img class="manual-img" :src="srcManualCard">
                        <p class="fix-top manual-field-value">Проверьте владельца карты. Нажмите "Перевести".</p>
                    </div>
                    <div class="col">
                        <img class="manual-img" :src="srcManualSend">
                        <p class="fix-top manual-field-value">На этой странице нажмите кнопку "Я оплатил!", чтобы ваш заказ поступил в обработку.</p>
                    </div>
                    <div class="col">
                        <img class="manual-img" :src="srcManualDone">
                        <p class="fix-top manual-field-value">Ожидайте подтверждения операции.</p>
                    </div>
                </div>
            </div>
            <div class="container fix-width">
                <div class="row justify-content-center">
                    <div class="col">
                            <button type="button" class="done-button" @click="openNewWindow(this.redirect_url)">Отменить заказ</button>
                    </div>
                    <div class="col">
                        <button class="done-button" @click="pay()">Я оплатил!</button>
                    </div>
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
      qrCode: '',
      currency: window.blade_data.currency,
      redirect_url: window.blade_data.redirect_url,
      srcServiceCopyBank: "/img/service/copy_white.png",
      srcServiceCopyAmount: "/img/service/copy_white.png",
      srcServiceCopyComment: "/img/service/copy_fill_red.png",
      srcManualBank: "/img/paycard/manual/mobile_bank.png",
      srcManualCard: "/img/paycard/manual/card.png",
      srcManualSend: "/img/paycard/manual/send.png",
      srcManualDone: "/img/paycard/manual/done.png",
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
    form: {
      type: Object,
      required: true,
    }
  }, 
  computed: {
        bank() {
            console.log(this.merchant);
            return this.merchant.bank;
        },
        srcLogo () {
            return '/img/paycard/'+this.merchant.bank+'.png';
        },
        srcQrCode () {
            return '/img/paycard/qr-codes/'+this.merchant.qrcode+'.png';
        },
        logobank () {
            return 'logo-' + this.merchant.bank;
        },
        amountString () {
            if (['usdt_trc_20', 'usdt_erc_20'].includes(this.merchant.bank)) {
                return (this.order.amount / this.currency.USDTRUB * 1.05).toFixed(2) + " ₮";
            } else if (this.merchant.bank == 'btc') {
                return (this.order.amount / this.currency.BTCRUB * 1.05).toFixed(7) + " ₿";
            } else {
                return this.order.amount  + " ₽";
            }
        }
  },
  methods: {
      openModal() {
          let modal = document.getElementById("modal");
          modal.style.display = "block";
      },
      closeModal() {
          let modal = document.getElementById("modal");
          modal.style.display = "none";
      },
      openNewWindow(url){
        console.log(`Заказ отменен`);
        this.$emit("update:Step", 'Canceled');
        window.open(url, "_blank");    
      },
      copyToClipboard(id) {
        this.srcServiceCopyBank = "/img/service/copy_white.png";
        this.srcServiceCopyAmount = "/img/service/copy_white.png";
        this.srcServiceCopyComment = "/img/service/copy_fill_red.png";
        const element = document.getElementById(id);
        const textToCopy = element.innerText;
        try {
            if(id == 'bank-number'){
                copy(textToCopy);
                this.srcServiceCopyBank = "/img/service/done_white.png";
            }
            if(id == 'amount'){      
                copy(textToCopy.slice(0, -2));
                this.srcServiceCopyAmount = "/img/service/done_white.png";
            }
            if(id == 'comment'){
                copy(textToCopy);
                this.srcServiceCopyComment = "/img/service/done_red.png";
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

a{
  color:#b82d2d;
}

.modal {
    display: block;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.5);
}

.modal-content {
    position: relative;
    background-color: #fefefe;
    margin: 20% auto;
    padding: 2rem;
    border: 1px solid #888;
    width: 30rem;
}
.modal-label{
  padding-left: 1rem;
  font-family: Montserrat-SemiBold;
  color: #252525;
  font-size: 1.4rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
}

.modal-text{
  padding-left: 1rem;
  font-family: Montserrat-Regular;
  color: #252525;
  font-size: 1rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
  text-align: start;
}

.modal-text-important{
    color:#b82d2d;
    font-family: Montserrat-SemiBold;
}

.close {
    position: absolute;
    top: 1rem;
    right: 1.5rem;
    color: #aaa;
    float: right;
    font-size: 1.8rem;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color:#b82d2d;
    text-decoration: none;
    cursor: pointer;
}

.info-card{
    margin: 1rem;
    padding: 1.5rem;
    width: 35rem;
    height: 20rem;
    flex-shrink: 0;
    border-radius: 0.9375rem;
    background: rgba( 255, 26, 26, 0.3 );
    box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
    backdrop-filter: blur( 2px );
    -webkit-backdrop-filter: blur( 2px );
    border-radius: 10px;
    border: 1px solid rgba( 255, 255, 255, 0.18 );
}

.info-field{
  color: #ff0303;
  font-family: Montserrat-Regular;
  font-size: 1.2rem;
  font-style: normal;
  font-weight: 700;
  line-height: normal;
  text-align: start;
}

.info-field-important{
  color: #ff0303;
  font-family: Montserrat-SemiBold;
  font-size: 1.2rem;
  font-style: normal;
  font-weight: 700;
  line-height: normal;
  text-align: start;
}

.order-card{
  margin: 1rem;
  padding: 1.5rem;
  width: 35rem;
  height: 20rem;
  flex-shrink: 0;
  border-radius: 0.9375rem;
  background: rgba( 255, 255, 255, 0.5 );
  box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
}

.order-label{
  color: #454545;
  font-family: Montserrat-SemiBold;
  font-size: 1.2rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
}

.order-card{
  margin: 2rem;
}

.order-field-name{
  color: #454545;
  font-family: Montserrat-SemiBold;
  font-size: 1.2rem;
  font-style: normal;
  font-weight: 700;
  line-height: normal;
  text-align: start;
}

.order-field-value{
  color: #454545;
  font-family: Montserrat-Regular;
  font-size: 1.2rem;
  font-style: normal;
  font-weight: 700;
  line-height: normal;
  text-align: start;
}

.comment-field-name{
  margin: 1.1rem 0rem 0rem 0rem;
  color: #454545;
  font-family: Montserrat-SemiBold;
  font-size: 1.2rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
}

.comment-field-value{
  color: #b82d2d;
  font-family: Montserrat-SemiBold;
  font-size: 1.3rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
  text-align: end;
}

.comment-copy{
    height: 1.3rem;
}

.payment-card{
    margin: 1rem;
    width: 35rem;
    height: 19.44rem;
    padding: 2rem;
    flex-shrink: 0;
    border-radius: 1.4375rem;
    display: block;
}

.qrcode{
    border-radius: 0.5rem;
    width: 9.5rem;
    height: 9.5rem;
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

.alfa{
    background: linear-gradient(289deg, #15151D 17.96%, #FF1012 277.49%);
    box-shadow: 0px 2px 19px 3px rgba(0, 0, 0, 0.31); 
}

.usdt_trc_20, .usdt_erc_20{
    background: linear-gradient(289deg, #15151D 17.96%, #00A376 277.49%);
    box-shadow: 0px 2px 19px 3px rgba(0, 0, 0, 0.31); 
}

.btc{
    background: linear-gradient(289deg, #15151D 17.96%, #F99400 277.49%);
    box-shadow: 0px 2px 19px 3px rgba(0, 0, 0, 0.31); 
}

.mir{
    background: linear-gradient(289deg, #15151D 17.96%, #3DA536 277.49%);
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
    font-size: 1.8rem;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
}

.card-fill-big-bank{
    color: #FFF;
    font-family: Montserrat-SemiBold;
    font-size: 1.8rem;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
}

.card-fill-big-crypto{
    color: #FFF;
    font-family: Montserrat-SemiBold;
    font-size: 1rem;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
}

.card-fill-big-btc{
    color: #FFF;
    font-family: Montserrat-SemiBold;
    font-size: 1rem;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
}

.to-left-side{
    text-align: left
}

.to-right-side{
    text-align: right;
}

.second-half{
    margin-top: 3rem;
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
    width: 7rem;
    height: 3.5rem;
}

.logo-alfa{
    width: 11rem;
    height: 2.26rem;
}


.logo-usdt_trc_20, .logo-usdt_erc_20, .logo-btc{
    width: 5.5rem;
    height: 5.5rem;
}

.logo-mir{
    width: 12rem;
    height: 3.36rem;
}

.manual-field-value{
  color: #252525;
  font-family: Montserrat-Regular;
  font-size: 1rem;
  font-style: normal;
  font-weight: 700;
  line-height: normal;
}

.manual-img{
    margin-top: 1rem;
    margin-bottom: 1rem;
    width: 4rem;
}

.fix-width{
    margin: 2rem;
    width: 35rem;
}


@media screen and (max-width: 765px) {
    .info-card{
        margin: 0.8rem;
        padding: 1.2rem;
        width: 28rem;
        height: 16rem;
    }

    .info-field{
        font-size: 0.96rem;
    }

    .info-field-important{
        font-size: 0.96rem;
    }
    
    .order-card{
        margin: 0.8rem;
        padding: 1.2rem;
        width: 28rem;
        height: 17rem;
    }

    .order-label{
        font-size: 0.96rem;
    }

    .order-card{
        margin: 1.6rem;
    }

    .order-field-name{
        font-size: 0.96rem;
    }

    .order-field-value{
        font-size: 0.96rem;
    }

    .comment-field-name{
        margin: 0.88rem 0rem 0rem 0rem;
        font-size: 0.96rem;
    }

    .comment-field-value{
        font-size: 1rem;
    }

    .comment-copy{
        height: 1rem;
    }

    .payment-card{
        margin: 0.8rem;
        width: 28rem;
        height: 15.552rem;
        padding: 1.6rem;
        border-radius: 1.1788rem;
    }

    .qrcode{
        width: 7.5rem;
        height: 7.5rem;
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
        font-size: 1.4rem;
    }

    .card-fill-big-bank{
        font-size: 1.4rem;
    }

    .card-fill-big-crypto{
        font-size: 0.8rem;
    }
    .card-fill-big-btc{
        font-size: 0.8rem;
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
        width: 5.6rem;
        height: 2.8rem;
    }  

    .logo-alfa{
        width: 8.8rem;
        height: 1.8rem;
    }

    .logo-mir{
        width: 9.6rem;
        height: 2.69rem;
    }


    .logo-usdt_trc_20, .logo-usdt_erc_20, .logo-btc{
        width: 4.4rem;
        height: 4.4rem;
    }

    .manual-field-value{
        font-size: 0.8rem;
    }

    .manual-img{
        margin-bottom: 0.8rem;
        width: 3.2rem;
    }

    .fix-width{
        width: 28rem;
    }
}

@media screen and (max-width: 475px) {

    .modal-content {
        width: 21rem;
    }
    .modal-label{
        padding-left: 0.8rem;
        font-size: 1.1rem;
    }

    .modal-text{
        padding-left: 0rem;
        font-size: 0.8rem;
    }
    .close {
        top: 1rem;
        right: 1.5rem;
        font-size: 1.8rem;
    }

    .info-card{
        margin: 0.64rem;
        padding: 0.96rem;
        width: 22.4rem;
        height: 12.8rem;
    }

    .info-field{
        font-size: 0.76rem;
    }

    .info-field-important{
        font-size: 0.76rem;
    }

    .order-card{
        margin: 0.64rem;
        padding: 0.96rem;
        width: 22.4rem;
        height: 14rem;
    }

    .order-label{
        font-size: 0.76rem;
    }

    .order-card{
        margin: 1.28rem;
    }

    .order-field-name{
        font-size: 0.76rem;
    }

    .order-field-value{
        font-size: 0.76rem;
    }

    .comment-field-name{
        margin: 0.7rem 0rem 0rem 0rem;
        font-size: 0.76rem;
    }

    .comment-field-value{
        font-size: 0.8rem;
    }

    .comment-copy{
        height: 0.8rem;
    }

    .payment-card{
        margin: 0.64rem;
        width: 22.4rem;
        height: 12.44rem;
        padding: 1.28rem;
        border-radius: 0.96rem;
    }
    .qrcode{
        width: 6rem;
        height: 6rem;
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
        font-size: 1rem;
    }
    .card-fill-big-bank{
        font-size: 1rem;
    }
    .card-fill-big-crypto{
        font-size: 0.64rem;
    }
    .card-fill-big-btc{
        font-size: 0.6rem;
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
        width: 4.48rem;
        height: 2.24rem;
    }   

    .logo-alfa{
        width: 7.04rem;
        height: 1.44rem;
    }


    .logo-usdt_trc_20, .logo-usdt_erc_20, .logo-btc{
        width: 3.5rem;
        height: 3.5rem;
    }

    .logo-mir{
        width: 7.44rem;
        height: 2.15rem;
    }

    .manual-field-value{
        font-size: 0.64rem;
    }

    .manual-img{
        margin-bottom: 0.64rem;
        width: 2.56rem;
    }

    .fix-width{
        width: 22.4rem;
    }
}

@media screen and (max-width: 405px) {

    .order-card{
        margin: 0.5rem;
        padding: 0.81rem;
        width: 19.04rem;
        height: 11.5rem;
    }

    .order-label{
        font-size: 0.6rem;
    }

    .order-card{
        margin: 1rem;
    }

    .order-field-name{
        font-size: 0.6rem;
    }

    .order-field-value{
        font-size: 0.6rem;
    }

    .comment-field-name{
        margin: 0.6rem 0rem 0rem 0rem;
        font-size: 0.6rem;
    }

    .comment-field-value{
        font-size: 0.68rem;
    }

    .comment-copy{
        height: 0.68rem;
    }

    .payment-card{
        width: 19.04rem;
        height: 10.574rem;
        padding: 1rem;
        border-radius: 0.8rem;
    }

    .qrcode{
        width: 4.8rem;
        height: 4.8rem;
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
        font-size: 0.8rem;
    }
    .card-fill-big-bank{
        font-size: 0.8rem;
    }
    .card-fill-big-crypto{
        font-size: 0.5rem;
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
        width: 3.58rem;
        height: 1.79rem;
    }    

    .logo-alfa{
        width: 7.04rem;
        height: 1.44rem;
    }


    .logo-usdt_trc_20, .logo-usdt_erc_20, .logo-btc{
        width: 3.5rem;
        height: 3.5rem;
    }

    .logo-mir{
        width: 5.95rem;
        height: 1.72rem;
    }
}

</style>