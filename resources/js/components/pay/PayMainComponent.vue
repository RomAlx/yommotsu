<template>
  <div class="container">
    <div class="tg_wrap">
      <div class="tg_cont text-center">
        <p>Значение банка: {{ bank.name }}</p>
        <p>Значение name: {{ form.name }}</p>
        <p>Значение email: {{ form.email }}</p>
        <PayMethodComponent v-if="step === 'PaymentMethod'" v-on:update:Bank="updateBank"/>
        <FormComponent v-else-if="step === 'Form'" :form="form" v-on:update:form="updateFromForm" v-on:update:Step="updateStep"/>
        <CardComponent v-else-if="step === 'Card'" :bank="bank" v-on:update:Step="updateStep"/>
        <TimerComponent v-else-if="step === 'Timer'" v-on:update:Step="updateStep"/>
      </div>
    </div>
  </div>
</template>

<script>
import PayMethodComponent from './PayMethodComponent.vue';
import FormComponent from './PayFormComponent.vue';
import CardComponent from './PayCardComponent.vue';
import TimerComponent from './PayTimerComponent.vue';

export default {
  components: {
      PayMethodComponent,
      FormComponent,
      CardComponent,
      TimerComponent
  },
  data() {
      return {
          step: 'PaymentMethod',
          fromBlade: window.blade_data,
          form: {
            name: '',
            email: '',
          },
          bank: {
            name: '',
          }
      };
  },
  methods: {
    updateBank(bank) {
      this.bank.name = bank.paymentMethod;
      this.step = bank.step;
      console.log(this.fromBlade.project_name);
    },
    updateStep(step) {
      this.step = step;
    },
    updateFromForm(form) {
      this.form.name = form.name;
      this.form.email = form.email;
      this.step = form.step;
    },
  }
};
</script>

<style>
.label{
  margin: 1rem;
  color: #262626;
  font-family: Montserrat-SemiBold;
  font-size: 1rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
}

.label-comment{

  color: #262626;
  text-align: center;
  font-family: Montserrat-Regular;
  font-size: 1rem;
  font-style: normal;
  font-weight: 300;
  line-height: normal;
}
.done-button{
  width: 8.8125rem;
  height: 2.4375rem;
  flex-shrink: 0;
  border-radius: 0.5625rem;
  background: linear-gradient(39deg, #B75555 10.94%, #E83F3F 47.88%, #F43B3B 84.38%);
  box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.25);
  color: #FFF;
  font-family: Montserrat-Regular;
  font-size: 1rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
}
</style>