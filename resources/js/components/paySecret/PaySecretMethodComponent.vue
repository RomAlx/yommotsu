<template>
  <div class="row wow fadeIn">
    <div class="col">
      <h1 class="label">Выберите удобный метод оплаты</h1>
      <div class="row justify-content-center">
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
            <button class="pay-button" @click="selectPaymentMethod('mastercard')" :disabled="checkButtonStatus('mastercard')"><img class="bank-img" :src="mastercard" alt="Мастер-кард РФ"></button>
          </div>
          <div class="col">
            <button class="pay-button" @click="selectPaymentMethod('mir')" :disabled="checkButtonStatus('mir')"><img class="bank-img" :src="mir" alt="Мир"></button>
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
    selectPaymentMethod(bank) {
        console.log(`Выбран банк: ${bank}`);
        this.$emit("update:Bank", {merchant: this.merchants[bank], step: 'Card'});
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
  border-radius: 10px;
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

</style>