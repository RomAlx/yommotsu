<template>
  <LoadComponent v-if="this.data.step === 'Loading'"/>
  <SuccessComponent v-else-if="this.data.step === 'Success'" :order="this.data.order"/>
  <ErrorComponent v-else-if="this.data.step === 'Error'" :order="this.data.order"/>
  <WarningComponent v-else-if="this.data.step === 'Warning'" :order="this.data.order"/>
  <CreatedComponent v-else-if="this.data.step === 'Created'" :order="this.data.order"/>
</template>

<script>
import { reactive, onBeforeUnmount, onMounted } from 'vue';
import axios from 'axios';
import LoadComponent from '../LoadPage/LoadPageComponent.vue';
import ErrorComponent from './StatusCheckerErrorComponent.vue';
import WarningComponent from './StatusCheckerWarningComponent.vue';
import SuccessComponent from './StatusCheckerSuccessComponent.vue';
import CreatedComponent from './StatusCheckerCreatedComponent.vue';

export default {
  components: {
      LoadComponent,
      ErrorComponent,
      WarningComponent,
      SuccessComponent,
      CreatedComponent
  },
  data() {
    return{
      csrfToken:  document.getElementById('order-status').getAttribute('data-csrf-token'),
    }
  },
  setup() {
    let data = reactive({
      step: 'Loading',
      timer: true
    });
    let axiosIntervalId;
    const csrfToken = document.getElementById('order-status').getAttribute('data-csrf-token');
    const makeAxiosRequest = () => {
      axios.get('/api/order/get/id', {
          headers: {
              'X-CSRF-TOKEN': csrfToken
          },
          params: {
            password: 'P2PEXCHANGE',
            order_id: window.blade_data.order_id,
          }
        })
        .then(response => {
          data.order = response.data;
          console.log(response.data);
          if (data.order.status === 'CREATED') {
            data.step = 'Created';
          } else if (data.order.status === 'WAITING') {
            data.step = 'Warning';        
          } else if (data.order.status === 'PAID') {
            data.step = 'Success';
          } else if (data.order.status === 'REJECTED') {
            data.step = 'Error';
          }
        });
    };
    onMounted(()=>{
      makeAxiosRequest();
    });

    onBeforeUnmount(() => {
      clearInterval(axiosIntervalId);
    });

    axiosIntervalId = setInterval(makeAxiosRequest, 5000);

    return {
      data
    };
  },
  methods: {
    updateTimerStatus(timer){
      this.data.timer = timer.status;
    },
  },
};
</script>

<style>
.row {
  display: flex;
  flex-direction: row;
  justify-content: center;
}

.col {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.timer{
  color: #262626;
  font-family: Montserrat-SemiBold;
  font-size: 2rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
  width: 19rem;
  height: 5.1875rem;
  flex-shrink: 0;
  border-radius: 0.9375rem;
  background: #FFF;
  display: flex;
  justify-content: center;
  padding: 1rem;
  margin: 2rem;
  text-align: center;
  align-items: center;
}

.status-img{
  height: 3rem;
}

.fix-top{
  margin-bottom: 0;
}

.button-send{
  margin: 1rem;
  width: 16rem;
}

@media screen and (max-width: 685px) {
  .button-send{
    margin: 0.8rem;
    width: 14rem;
  }
}
</style>