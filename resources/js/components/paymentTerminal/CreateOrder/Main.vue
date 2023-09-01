<template>
    <Form v-if="this.step === 'Form'" v-on:update:Amount="updateAmount" v-on:Close="close"></Form>
    <QRCode v-if="this.step === 'QRCode'" :amount="this.amount" v-on:Close="close"></QRCode>
</template>
  
<script>
import Form from './Form.vue';
import QRCode from './QRCode.vue';

export default {
    components:{
        Form,
        QRCode
    },
    data() {
        return {
            step: 'Form',
            amount: null,
        }
    },
    methods: {
        close(){
            this.$emit('Close');
            this.amount = '';
            this.step = 'Form';
        },
        updateAmount(data){
            this.amount = data.amount;
            this.step = data.step
        }
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

.label{
  margin: 0.5rem;
  color: #262626;
  font-family: Montserrat-SemiBold;
  font-size: 1.3rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
}

.modal-content{
    width: 50vh;
}
.form-text{
  margin: 0.2rem 1rem 1rem 1.1rem;
  width: 21.1875rem;
  text-align: start;
}

.form-component{
  margin: 2rem;
  width: 21.1875rem;
  height: 2.5rem;
  flex-shrink: 0; 
  border-radius: 0.625rem;
  background: #E3E3E3;
  box-shadow: 1px 1px 2px 0px rgba(0, 0, 0, 0.25) inset; 
  font-family: Montserrat-Regular;
  font-size: 1rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal; 
  padding: 1rem;
  display: block;
}

.main-button {
    display: flex;
    width: 9rem;
    height: 2.7rem;
    padding: 0.5rem;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    border-radius: 0.625rem;
    background: var(--gray-900, #18181B);
    box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.178);
    color: #FFF;
    font-family: Montserrat-Regular;
    font-size: 1rem;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
}
</style>