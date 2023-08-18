<template>
  <div class="container">
    <div class="tg_wrap">
      <div class="tg_cont text-center">
        <div class="row">
            <div class="col">
                <img :src="logo" alt="Logo" class="logo-main">
            </div>
        </div>
        <PayMethodComponent v-if="data.step === 'PaymentMethod'" :merchants="data.merchants" v-on:update:Bank="updateFromBank"/>
        <FormComponent v-else-if="data.step === 'Form'" :form="form" v-on:update:Form="updateFromForm" v-on:update:Step="updateStep"/>
        <CardComponent v-else-if="data.step === 'Card'" :merchant="bank" :order="data.order" v-on:update:Card="updateFromCard" v-on:update:Step="updateStep"/>
        <TimerComponent v-else-if="data.step === 'Timer'" v-on:update:Step="updateStep"/>
      </div>
    </div>
  </div>
</template>

<script>
import {reactive} from 'vue';
import axios from 'axios';
import PayMethodComponent from './PayMethodComponent.vue';
import FormComponent from './PayFormComponent.vue';
import CardComponent from './PayCardComponent.vue';
import TimerComponent from './PayTimerMainComponent.vue';

export default {
  components: {
      PayMethodComponent,
      FormComponent,
      CardComponent,
      TimerComponent
  },
  data() {
    return {
      form: {
        name: '',
        email: '',
      },
      bank: null,
      logo: '/img/logo.png',
    };
  },
  setup() {
    const data = reactive({
      merchants: null,
      order: null,
      step: null,
    });
    const fetchData = async () => {
      try {
        let response = await axios.get('/api/merchants/get/current', {
          params: {
            password: 'P2PEXCHANGE',
          },
        });
        console.log(response.data);
        data.merchants = response.data;
        response = await axios.get('/api/order/get/id', {
          params: {
            password: 'P2PEXCHANGE',
            order_id: window.blade_data.order_id,
          },
        });
        console.log(response.data);
        data.order = response.data;
        if(data.order.status != 'CREATED') {
          data.step = 'Timer';
        } else {
          data.step = 'PaymentMethod';
        }
      } catch (error) {
        console.error(error);
      }
    };

    fetchData();

    return {data};
  },
  methods: {
    updateStep(step) {
      this.data.step = step;
    },
    updateFromBank(bank) {
      this.bank = bank.merchant;
      this.data.step = bank.step;
    },
    updateFromForm(form) {
      this.form.name = form.name;
      this.form.email = form.email;
      this.data.step = form.step;
    },
    updateFromCard(card) {
      this.data.step = card.step;
      axios.post('/api/order/update/paypage', { 
        data: {
          password: 'P2PEXCHANGE',
          order_id: this.data.order.order_id,
          name: this.form.name,
          email: this.form.email, 
          status: 'WAITING',
        }
      });
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

@media screen and (max-width: 475px) {
  .done-button{
    width: 7.05rem;
    height: 1.95rem;
    border-radius: 0.45rem;
    font-size: 0.8rem;
  }
}
</style>