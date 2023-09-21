<template>
  <div class="container">
    <div class="tg_wrap">
      <div class="tg_cont text-center">
        <div class="row">
            <div class="col">
                <img :src="logo" alt="Logo" class="logo-main">
            </div>
        </div>
        <ChooseActionComponent 
          v-if="this.action === 'ChooseAction'" 
          v-on:update:Action="updateAction"
        />
        <StatusMainComponent 
          v-if="this.action === 'Status'" 
          :order ="this.order"
          v-on:update:Action="updateAction"
          v-on:update:OrderId="updateOrderId"
        />
        <PayMainComponent 
          v-if="this.action === 'Pay'" 
          v-on:update:Action="updateAction" 
          v-on:update:Order="updateOrder"
        />
      </div>
    </div>
  </div>
</template>

<script>
import ChooseActionComponent from './ChooseActionComponent.vue';
import PayMainComponent from './Pay/PayMainComponent.vue';
import StatusMainComponent from './Status/StatusMainComponent.vue';


export default {
  components: {
    ChooseActionComponent,
    PayMainComponent,
    StatusMainComponent,
},
  data() {
    return {
      action: 'ChooseAction',
      logo: '/img/logo.png',
      order: {
        project_name: window.blade_data.project_name,
        order_id: '',
        name: 'без имени',
        email: 'без почты',
        amount: null,
      },
    };
  },
  methods: {
    updateAction(data) {
      this.action = data.action;
    },
    updateOrder(data) {
      this.order = data.order;
    },
    updateOrderId(data) {
      this.order.order_id = data.order_id;
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