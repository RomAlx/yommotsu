<template>
  <div>
    <div class="row wow fadeIn">
      <div class="col">
        <div class="form-card row align-items-center justify-content-center">
          <div class="col">
            <h1 class="label">Укажите сумму</h1>
            <form @submit.prevent="validateForm" class="form">
                <input id="amount" type="text" class="form-component" placeholder="Укажите сумму" v-model="amount" :class="{ 'invalid': (v$.amount.$dirty && v$.amount.required.$invalid) }">
                <div class="row">
                  <div class="col">
                    <button type="button" class="done-button" @click="getBack()">Назад</button>
                  </div>
                  <div class="col">
                    <button type="submit" class="done-button">Готово</button>
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
  props: {
    order: {
      type: Object,
      required: true,
    },
  },
  validations() {
    return {
      amount: {required},
    }
  },
  beforeMount(){
    if(this.order.amount != ''){
      this.amount = this.order.amount;
    }
  },
  methods: {
      getBack() {
        console.log(`Назад`);
        this.$emit("update:Step", 'PaymentMethod');
      },
      validateForm() {
        this.v$.$validate();
        if (!this.v$.$error) {
          console.log(`DONE`);
          this.$emit('update:Form', {amount: this.amount, step: 'Card'});
        } else {
          console.log(`FAIL TO SUBMIT`);
        }
      },
  }
}
</script>

<style scoped>

a{
  color:#b82d2d;
}
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

.close {
    position: absolute;
    top: 1rem;
    right: 1.5rem;
    color: #aaa;
    float: right;
    font-size: 1.8rem;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color:#b82d2d;
    text-decoration: none;
    cursor: pointer;
}

.form-card{
  margin: 1rem;
  width: 25rem;
  height: 15rem;
  flex-shrink: 0;
  border-radius: 0.9375rem;
  background: rgba( 255, 255, 255, 0.5 );
  box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
}

.form-component{
  margin: 1rem 1rem 1rem 1rem;
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

.invalid{
  border: 3px solid rgba(255, 2, 2, 0.493);
}


@media screen and (max-width: 668px) {

  .form-card{
    margin: 0.8rem;
    width: 20rem;
    height: 12rem;
    border-radius: 0.72rem;
  }

  .form-component{
    margin: 0.16rem 0.8rem 0.8rem 0.88rem;
    width: 16.95rem;
    height: 2rem;
    border-radius: 0.5rem;
    font-size: 0.8rem;
    padding: 0.8rem;
    display: block;
  }
}

</style>