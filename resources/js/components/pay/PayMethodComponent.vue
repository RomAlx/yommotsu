<template>
  <div class="row wow fadeIn">
    <div class="col">
      <h1 class="label">Выберите удобный метод оплаты</h1>
      <div class="row">
        <button class="pay-button" @click="selectPaymentMethod('sberbank')"><img :src="sber" alt="СберБанк"></button>
        <button class="pay-button" @click="selectPaymentMethod('tinkoff')"><img :src="tinkoff" alt="Тинькофф"></button>
        <button class="pay-button" @click="selectPaymentMethod('sbp')"><img :src="sbp" alt="СБП"></button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      tinkoff: '/img/paymentMethod/tinkoff.png',
      sber: '/img/paymentMethod/sberbank.png',
      sbp: '/img/paymentMethod/sbp.png',
    };
  },
  methods: {
    selectPaymentMethod(bank) {
        console.log(`Выбран банк: ${bank}`);
        this.$emit("update:Bank", {paymentMethod: bank, step: 'Form'});
      }
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
</style>