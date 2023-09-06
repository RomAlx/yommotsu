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
        <FormComponent v-else-if="data.step === 'Form'" :form="form" v-on:update:Form="updateFromForm" v-on:update:Step="updateStep"/>
        <CardComponent v-else-if="data.step === 'Card'" :merchant="bank" :order="data.order" :form="form" v-on:update:Card="updateFromCard" v-on:update:Step="updateStep"/>
        <CanceledComponent v-else-if="data.step === 'Canceled'"/>
        <TimerComponent v-else-if="data.step === 'Timer'" v-on:update:Step="updateStep"/>
      </div>
    </div>
    <div class="footer">

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
import CanceledComponent from './PayCanceledComponent.vue';

export default {
  components: {
      PayMethodComponent,
      FormComponent,
      CardComponent,
      CanceledComponent,
      TimerComponent
  },
  data() {
    return {
      form: {
        name: '',
        email: '',
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
      this.form.agreement = form.agreement;
      this.data.step = form.step;
      axios.post('/api/order/status/email', {
        data: {
          password: 'P2PEXCHANGE',
          order_id: this.data.order.order_id,
        },
      });
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
          bank: this.bank,
        }
      });
      axios.post('/api/order/status/email', {
        data: {
          password: 'P2PEXCHANGE',
          order_id: this.data.order.order_id,
        },
      });
    },
  }
};
</script>

<style>

.logo-main {
  height: 15vh;
}

.footer {
  height: 5vh;
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