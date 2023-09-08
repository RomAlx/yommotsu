<template>
  <div id="modal" class="modal wow fadeIn">
      <div class="modal-content">
        <h2 class="modal-label">Правила</h2>
        <p class="modal-text">
            1. Перевод осуществляются строго с выборного банка на банк.<br>
            2. Имя которое вы указываете, должно полностью совпадать с именем держателя карты.<br>
            <span class="modal-text-important">3. Всегда указывайте в комментарий к платежу последние 4 символа вашего заказа.</span><br>
            4. Если вы нарушаете правила - обратитесь в поддержку для уточнения статуса вашего платежа.
        </p>
        <div class="row">
          <div class="col">
            <button type="submit" class="done-button" @click="closeModal()">Принять</button>
          </div>
        </div>
      </div>
    </div>
  <div class="row wow fadeIn">
    <div class="col">
      <h1 class="label">Выберите удобный метод оплаты</h1>
      <h1 class="label"><a href="#" @click="openModal">Правила</a></h1>
        <div class="row justify-content-center">
          <div class="col">
            <button class="pay-button" @click="selectPaymentMethod('sberbank')" :disabled="checkButtonStatus('sberbank')"><img class="bank-img" :src="sberbank" alt="СберБанк"></button>
          </div>
          <div class="col">
            <button class="pay-button" @click="selectPaymentMethod('tinkoff')" :disabled="checkButtonStatus('tinkoff')"><img class="bank-img" :src="tinkoff" alt="Тинькофф"></button>
          </div>
          <div class="col">
            <button class="pay-button" @click="selectPaymentMethod('alfa')" :disabled="checkButtonStatus('alfa')"><img class="bank-img" :src="alfa" alt="Альфа-банк"></button>
          </div>
          <div class="col">
            <button class="pay-button" @click="selectPaymentMethod('raiffeisen')" :disabled="checkButtonStatus('raiffeisen')"><img class="bank-img" :src="raiffeisen" alt="Райффайзен"></button>
          </div>
          <div class="col">
            <button class="pay-button" @click="selectPaymentMethod('sbp')" :disabled="checkButtonStatus('sbp')"><img class="bank-img" :src="sbp" alt="СБП"></button>
          </div>
          <div class="col">
            <button class="pay-button" @click="selectPaymentMethod('usdt_trc_20')" :disabled="checkButtonStatus('usdt_trc_20')"><img class="bank-img" :src="usdt_trc_20" alt="USDT TRC 20"></button>
          </div>
          <div class="col">
            <button class="pay-button" @click="selectPaymentMethod('usdt_erc_20')" :disabled="checkButtonStatus('usdt_erc_20')"><img class="bank-img" :src="usdt_erc_20" alt="USDT ERC 20"></button>
          </div>
          <div class="col">
            <button class="pay-button" @click="selectPaymentMethod('btc')" :disabled="checkButtonStatus('btc')"><img class="bank-img" :src="btc" alt="BTC"></button>
          </div>
        </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      tinkoff: '/img/paymentMethod/tinkoff.png',
      sberbank: '/img/paymentMethod/sberbank.png',
      sbp: '/img/paymentMethod/sbp.png',
      alfa: '/img/paymentMethod/alfa.png',
      raiffeisen: '/img/paymentMethod/raiffeisen.png',
      //mastercard: '/img/paymentMethod/mastercard.png',
      //mir: '/img/paymentMethod/mir.png',
      usdt_trc_20: '/img/paymentMethod/usdt_trc_20.png',
      usdt_erc_20: '/img/paymentMethod/usdt_erc_20.png',
      btc: '/img/paymentMethod/btc.png',
    };
  },
  props: {
    merchants: {
      type: Object,
      required: true,
    },
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
    selectPaymentMethod(bank) {
        console.log(`Выбран банк: ${bank}`);
        this.$emit("update:Bank", {merchant: this.merchants[bank], step: 'Form'});
    },
    checkButtonStatus(bank) {
      if (bank in this.merchants) {
        return false; 
      } else {
        return true;
      }
    },
  }
};
</script>

<style scoped>


.modal {
    display: none;
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

a{
  color:red;
}

.pay-button{
  margin: 1rem;
  width: 14.375rem;
  height: 11.272rem;
  flex-shrink: 0;
  border-radius: 1.25rem;
  background: rgba( 255, 255, 255, 0.5 );
  box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
  backdrop-filter: blur( 20px );
  -webkit-backdrop-filter: blur( 20px );
  border: 0.25rem solid rgba( 255, 255, 255, 0.18 );
}

.pay-button:disabled {
  background-color: dimgrey;
  color: linen;
  opacity: 1;
}

.bank-img{
  width: 60%;
}

@media screen and (max-width: 991px) {
  .pay-button{
    margin: 0.8rem;
    width: 11.5rem;
    height: 9rem;
    border-radius: 1rem;
  }
}

@media screen and (max-width: 767px) {
  .pay-button{
    margin: 0.64rem;
    width: 9.2rem;
    height: 7.2rem;
    border-radius: 0.8rem;
  }
}

@media screen and (max-width: 576px) {


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
  .pay-button{
    margin: 0.512rem;
    width: 7.36rem;
    height: 5.76rem;
    border-radius: 0.64rem;
  }
}

</style>