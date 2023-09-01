<template>
    <div class="modal-content">
        <span class="close" @click="closeModal">&times;</span>
        <div class="row">
            <div class="col">
                <div class="row align-items-center justify-content-center">
                    <div class="col">
                        <h1 class="label">Укажите сумму</h1>
                        <form @submit.prevent="validateForm" class="form">
                            <input id="amount" type="text" class="form-component" placeholder="Сумма" v-model="amount" :class="{ 'invalid': (v$.amount.$dirty && v$.amount.required.$invalid) }">
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="main-button" @click="closeModal()">Назад</button>
                                </div>
                                <div class="col">
                                    <button type="submit" class="main-button">Готово</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
import useValidate from '@vuelidate/core';
import {required} from '@vuelidate/validators';

export default {
    data() {
        return {
            v$: useValidate(),
            amount: '',
        }
    },
    validations() {
        return {
            amount: {required},
        }
    },
    methods: {
        validateForm() {
        this.v$.$validate();
        if (!this.v$.$error) {
            console.log(`DONE`);
            this.$emit('update:Amount', {amount: this.amount, step: 'QRCode'});
        } else {
            console.log(`FAIL TO SUBMIT`);
        }
        },
        closeModal(){
            this.$emit('Close');
        }
  }
};
</script>

<style scoped>

.modal-content{
    width: 50vh;
}
.form-text{
  margin: 0.2rem 1rem 1rem 1.1rem;
  width: 21.1875rem;
  text-align: start;
}

.form-component{
  margin: 1rem;
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

.invalid{
  border: 3px solid rgba(255, 2, 2, 0.493);
}
</style>