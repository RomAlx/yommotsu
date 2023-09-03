<template>
  <div class="row wow fadeIn">
    <div class="col">
      <h1 class="label">Выберите удобный метод оплаты</h1>
        <div class="row justify-content-center">
          <div class="col">
            <button class="pay-button" @click="selectPaymentMethod('sberbank')" :disabled="checkButtonStatus('sberbank')"><img class="bank-img" :src="sberbank" alt="СберБанк"></button>
          </div>
          <div class="col">
            <button class="pay-button" @click="selectPaymentMethod('tinkoff')" :disabled="checkButtonStatus('tinkoff')"><img class="bank-img" :src="tinkoff" alt="Тинькофф"></button>
          </div>
          <div class="col">
            <button class="pay-button" @click="selectPaymentMethod('sbp')" :disabled="checkButtonStatus('sbp')"><img class="bank-img" :src="sbp" alt="СБП"></button>
          </div>
          <div class="col">
            <button class="pay-button" @click="selectPaymentMethod('alfa')" :disabled="checkButtonStatus('alfa')"><img class="bank-img" :src="alfa" alt="Альфа-банк"></button>
          </div>
          <div class="col">
            <button class="pay-button" @click="selectPaymentMethod('raiffeisen')" :disabled="checkButtonStatus('raiffeisen')"><img class="bank-img" :src="raiffeisen" alt="Райффайзен"></button>
          </div>
          <div class="col">
            <button class="pay-button" @click="selectPaymentMethod('mastercard')" :disabled="checkButtonStatus('mastercard')"><img class="bank-img" :src="mastercard" alt="Мастер-кард РФ"></button>
          </div>
          <div class="col">
            <button class="pay-button" @click="selectPaymentMethod('mir')" :disabled="checkButtonStatus('mir')"><img class="bank-img" :src="mir" alt="Мир"></button>
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
      mastercard: '/img/paymentMethod/mastercard.png',
      mir: '/img/paymentMethod/mir.png',
    };
  },
  props: {
    merchants: {
      type: Object,
      required: true,
    },
  },
  methods: {
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
  .pay-button{
    margin: 0.512rem;
    width: 7.36rem;
    height: 5.76rem;
    border-radius: 0.64rem;
  }
}

</style>