<template>
  <div class="row wow fadeIn">
    <div class="col">
      <h1 class="label">Выберите удобный метод оплаты</h1>
      <div class="row">
        <button class="pay-button" @click="selectPaymentMethod('sberbank')" :disabled="checkButtonStatus('sberbank')"><img :src="sberbank" alt="СберБанк"></button>
        <button class="pay-button" @click="selectPaymentMethod('tinkoff')" :disabled="checkButtonStatus('tinkoff')"><img :src="tinkoff" alt="Тинькофф"></button>
        <button class="pay-button" @click="selectPaymentMethod('sbp')" :disabled="checkButtonStatus('sbp')"><img :src="sbp" alt="СБП"></button>
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

</style>