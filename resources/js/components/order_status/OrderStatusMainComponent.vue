<template>
  <div class="container">
    <div class="row">
        <div class="col text-center">
            <img :src="logo" alt="Logo" class="logo-main">
        </div>
    </div>
    <div class="tg_wrap">
      <div class="tg_cont text-center">
        <StatusCheckerMainComponent v-if="data.step === 'Main'"/>
        <GetOrderIdComponent v-if="data.step === 'GetOrder'" v-on:getOrder="getOrder"/>
      </div>
    </div>
  </div>
  <FooterComponent></FooterComponent>
</template>

<script>
import {reactive} from 'vue';
import axios from 'axios';

import StatusCheckerMainComponent from './StatusCheckerMainComponent.vue';
import GetOrderIdComponent from './GetOrderIdComponent.vue';
import FooterComponent from '../Footer/FooterComponent.vue';

export default {
  components: {
    StatusCheckerMainComponent,
    GetOrderIdComponent,
    FooterComponent,
  },
  data() {
    return {
      csrfToken: document.getElementById('order-status').getAttribute('data-csrf-token'),
      logo: '/img/logo.png',
    };
  },
  setup() {
    const data = reactive({
      order: null,
      step: null,
    });
    const csrfToken = document.getElementById('order-status').getAttribute('data-csrf-token');
    const fetchData = async () => {
      try {
        let response = await axios.get('/api/order/get/id', {
          headers: {
              'X-CSRF-TOKEN': csrfToken
          },
          params: {
            password: 'P2PEXCHANGE',
            order_id: window.blade_data.order_id,
          },
        });
        console.log(response.data);
        data.order = response.data;
        data.step = 'Main';
      } catch (error) {
        console.error('no order');
        data.step = 'GetOrder';
      }
    };

    fetchData();

    return {data};
  },
  methods:{
    getOrder(order){
      window.blade_data.order_id = order.order_id;
      this.data.order = order;
      console.log(this.data.order);
      this.data.step = 'Main';
    }
  }
}
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

.done-button:disabled{
  background: linear-gradient(39deg, #464646 10.94%, #7a7a7a 47.88%, #757575 84.38%);
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