<template>
  <LoadComponent v-if="this.data.step === 'Loading'"/>
  <TimerComponent v-if="this.data.step === 'Timer'" :order="this.data.order" v-on:update:timerStatus="updateTimerStatus"/>
  <SuccessComponent v-else-if="this.data.step === 'Success'" :order="this.data.order"/>
  <ErrorComponent v-else-if="this.data.step === 'Error'" :order="this.data.order"/>
  <WarningComponent v-else-if="this.data.step === 'Warning'" :order="this.data.order"/>
</template>

<script>
import { reactive, onBeforeUnmount, onMounted } from 'vue';
import axios from 'axios';
import LoadComponent from '../LoadPage/LoadPageComponent.vue';
import ErrorComponent from './PaySecretTimerErrorComponent.vue';
import WarningComponent from './PaySecretTimerWarningComponent.vue';
import SuccessComponent from './PaySecretTimerSuccessComponent.vue';
import TimerComponent from './PaySecretTimerTimerComponent.vue';

export default {
  components: {
      LoadComponent,
      ErrorComponent,
      WarningComponent,
      SuccessComponent,
      TimerComponent
  },
  data() {
    return{
      step: 'Loading',
    }
  },
  setup() {
    let data = reactive({
      step: 'Loading',
      timer: true
    });
    let axiosIntervalId;

    const makeAxiosRequest = () => {
      axios.get('/api/order/status', {
          params: {
            project_name: window.blade_data.project_name,
            order_id: window.blade_data.order_id,
          }
        })
        .then(response => {
          data.order = response.data;
          if (data.order.status === 'WAITING') {
            if (data.timer) {
              data.step = 'Timer';
            } else {
              data.step = 'Warning';
            }            
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
</style>