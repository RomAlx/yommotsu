<template>
  <PayMethodComponent 
    v-if="this.step === 'PaymentMethod'" 
    :merchants="data.merchants" 
    v-on:update:Bank="updateFromBank"
  />
  <FormComponent 
    v-else-if="this.step === 'Form'" 
    :order="this.order" 
    v-on:update:Form="updateFromForm" 
    v-on:update:Step="updateStep"
  />
  <CardComponent 
    v-else-if="this.step === 'Card'" 
    :order="this.order" 
    v-on:update:Card="updateFromCard" 
    v-on:update:Step="updateStep"
  />
</template>

<script>
import {reactive} from 'vue';
import axios from 'axios';
import PayMethodComponent from './PayMethodComponent.vue';
import FormComponent from './PayFormComponent.vue';
import CardComponent from './PayCardComponent.vue';

export default {
  components: {
      PayMethodComponent,
      FormComponent,
      CardComponent,
  },
  data() {
    return {
      csrfToken: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      bank: null,
      step: 'PaymentMethod',
      order: {
        project_name: window.blade_data.project_name,
        order_id: [...crypto.getRandomValues(new Uint8Array(16))].map((x) => x.toString(36)).join('').substr(0, 22),
        name: 'без имени',
        email: 'без почты',
        amount: null,
        bank: null,
      },
    };
  },
  setup() {
    const data = reactive({
      merchants: null,
    });
    const fetchData = async () => {
      try {
        let response = await axios.get('/api/merchants/get/current', {
          headers: {
              'X-CSRF-TOKEN': this.csrfToken
          },
          params: {
            password: 'P2PEXCHANGE',
          },
        });
        console.log(response.data);
        data.merchants = response.data;
      } catch (error) {
        console.error(error);
      }
    };

    fetchData();

    return {data};
  },
  methods: {
    updateStep(step) {
      this.step = step;
    },
    updateFromBank(bank) {
      this.order.bank = bank.merchant;
      this.step = bank.step;
    },
    updateFromForm(form) {
      this.order.amount = form.amount;
      this.step = form.step;
      this.$emit("update:Order", {order: this.order})
    },
    updateFromCard() {
      axios.post('/api/order/update/paypagestatic', { 
        headers: {
            'X-CSRF-TOKEN': this.csrfToken
        },
        data: {
          password: 'P2PEXCHANGE',
          project_name: this.order.project_name,
          order_id: this.order.order_id,
          name: this.order.name,
          email: this.order.email, 
          amount: this.order.amount,
          status: 'WAITING',
          bank: this.order.bank,
        }
      });
      window.blade_data = {
        project_name: this.order.project_name,
        order_id: this.order.order_id,
      };
      console.log(window.blade_data);
      this.$emit("update:Action", {action: "Status"})
    },
  }
};
</script>

<style>

.logo-main {
  height: 10rem;
}

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
  box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.178);
  color: #FFF;
  font-family: Montserrat-Regular;
  font-size: 1rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
}

.help-button{
  width: 8.8125rem;
  height: 2.4375rem;
  flex-shrink: 0;
  border-radius: 0.5625rem;
  border: 2px solid #E83F3F;
  box-shadow: 0px 1px 6px 0px rgba(0, 0, 0, 0.25);
  font-family: Montserrat-Regular;
  font-size: 1rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
}

@media screen and (max-width: 685px) {
  .done-button{
    width: 6.6rem;
    height: 1.8rem;
    border-radius: 0.42rem;
    font-size: 0.75rem;
  }

  .help-button{
    width: 6.6rem;
    height: 1.8rem;
    border-radius: 0.42rem;
    font-size: 0.75rem;
  }
}
</style>