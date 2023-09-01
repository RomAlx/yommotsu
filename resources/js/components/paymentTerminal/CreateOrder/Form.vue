<template>
    <div class="modal-content wow fadeIn">
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

@media screen and (max-width: 989px) {
    .form-component{
        margin: 0.8rem;
        width: 16.8rem;
        height: 2rem;
        box-shadow: 1px 1px 2px 0px rgba(0, 0, 0, 0.25) inset; 
        font-size: 0.8rem;
        padding: 0.8rem;
    }

    .main-button {
        width: 7.2rem;
        height: 2.16rem;
        padding: 0.5rem;
        font-size: 0.8rem;
    }

    .invalid{
        border: 2px solid rgba(255, 2, 2, 0.493);
    }
}

@media screen and (max-width: 445px) {
    .form-component{
        margin: 0.64rem;
        width: 13.44rem;
        height: 1.6rem; 
        font-size: 0.64rem;
        padding: 0.64rem;
    }

    .main-button {
        width: 5.76rem;
        height: 1.72rem;
        padding: 0.4rem;
        font-size: 0.64rem;
    }

    .invalid{
        border: 1px solid rgba(255, 2, 2, 0.493);
    }
}
</style>