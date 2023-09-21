<template>
    <StatusFormComponent 
        v-if="this.step === 'Form'" 
        :order="this.order" 
        v-on:update:Step="updateStep"
        v-on:update:Action="updateAction"
    />
    <StatusUpdaterComponent 
        v-if="this.step === 'Updater'" 
        :order="this.order"
    />
</template>
  
<script>
  import StatusFormComponent from './StatusFormComponent.vue';
  import StatusUpdaterComponent from './StatusUpdaterComponent.vue';
  
  export default {
    components: {
        StatusFormComponent,
        StatusUpdaterComponent,
    },
    data() {
      return{
        step: 'Form',
      }
    },
    props: {
      order: {
        type: Object,
        required: true,
      },
    },
    mounted(){
      if(this.order.order_id != ''){
        this.step = "Updater";
      }
    },
    methods: {
        updateStep(data) {
            this.step = data.step;
        },
        updateAction(action) {
            this.$emit("update:Action", {action: action.action});
        },
    }
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