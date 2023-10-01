<template>
  <div class="container">
    <div class="row">
        <div class="col">
            <img :src="logo" alt="Logo" class="logo-main">
        </div>
    </div>
    <div class="tg_wrap">
      <div class="tg_cont text-center">
        <PayMethodComponent v-if="data.step === 'PaymentMethod'" :merchants="data.merchants" v-on:update:Bank="updateFromBank"/>
        <CardComponent v-else-if="data.step === 'Card'" :merchant="bank" :order="data.order" :form="form" v-on:update:Card="updateFromCard" v-on:update:Step="updateStep"/>
        <CanceledComponent v-else-if="data.step === 'Canceled'"/>
        <TimerComponent v-else-if="data.step === 'Timer'" v-on:update:Step="updateStep"/>
      </div>
    </div>
  </div>
  <FooterComponent></FooterComponent>
</template>

<script>
import {reactive} from 'vue';
import axios from 'axios';
import PayMethodComponent from './PaySecretMethodComponent.vue';
import CardComponent from './PaySecretCardComponent.vue';
import TimerComponent from './PaySecretTimerMainComponent.vue';
import CanceledComponent from './PaySecretCanceledComponent.vue';
import FooterComponent from '../Footer/FooterComponent.vue';

export default {
  components: {
      PayMethodComponent,
      CardComponent,
      TimerComponent,
      CanceledComponent,
      FooterComponent
  },
  data() {
    return {
      csrfToken: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      form: {
        name: '-',
        email: '-',
        agreement: null,
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
          headers: {
              'X-CSRF-TOKEN': this.csrfToken
          },
          params: {
            password: 'P2PEXCHANGE',
          },
        });
        console.log(response.data);
        data.merchants = response.data;
        response = await axios.get('/api/order/get/id', {
          headers: {
              'X-CSRF-TOKEN': this.csrfToken
          },
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
    updateFromCard(card) {
      this.data.step = card.step;
      axios.post('/api/order/update/paypage', { 
        headers: {
            'X-CSRF-TOKEN': this.csrfToken
        },
        data: {
          password: 'P2PEXCHANGE',
          order_id: this.data.order.order_id,
          name: this.form.name,
          email: this.form.email, 
          status: 'WAITING',
          bank: this.bank,
        }
      });
    },
  }
};
</script>

<style>

.logo-main {
  height: 15vh;
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
  padding: 0.2rem 1rem;
  min-width: 8rem;
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
  border: none;
  outline: none;
}

.help-button{
  width: 8.8125rem;
  height: 2.4375rem;
  flex-shrink: 0;
  border-radius: 0.5625rem;
  border: 2px solid #e83f3f;
  box-shadow: 0px 1px 6px 0px rgba(0, 0, 0, 0.25);
  font-family: Montserrat-Regular;
  font-size: 1rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
  border: none;
  outline: none;
}

@media screen and (max-width: 685px) {
  .done-button{
    padding: 0.2rem 1rem;
    min-width: 7rem;
    height: 2rem;
    border-radius: 0.42rem;
    font-size: 0.8rem;
  }

  .help-button{
    width: 6.6rem;
    height: 1.8rem;
    border-radius: 0.42rem;
    font-size: 0.75rem;
  }
}
</style>