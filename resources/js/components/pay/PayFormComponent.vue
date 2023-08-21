<template>
  <div>
    <div class="row wow fadeIn">
      <div class="col">
        <div class="form-card row align-items-center justify-content-center">
          <div class="col">
            <h1 class="label">Заполните данные</h1>
            <form @submit.prevent="validateForm" class="form">
                <input type="text" class="form-component" placeholder="ФИО" v-model="name" :class="{ 'invalid': (v$.name.$dirty && v$.name.required.$invalid) }">
                <input type="text" class="form-component" placeholder="Email" v-model.trim="email" :class="{ 'invalid': (v$.email.$dirty && v$.email.required.$invalid || v$.email.$dirty && v$.email.email.$invalid)}">
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
import {email, required} from '@vuelidate/validators';

export default {
  data() {
    return {
        v$: useValidate(),
        name: '',
        email: '',
    }
  },
  props: {
    form: {
      type: Object,
      required: true,
    },
  },
  validations() {
    return {
      name: {required},
      email: {email, required},
    }
  },
  beforeMount(){
    if(this.form.name != ''){
      this.name = this.form.name;
    }
    if(this.form.email != ''){
      this.email = this.form.email;
    }
  },
  methods: {
      getBack() {
        console.log(`Назад`);
        this.$emit("update:Step", 'PaymentMethod');
      },
      validateForm() {
        this.v$.$validate();
        console.log(!(this.v$.name.$dirty && !this.v$.name.required.$invalid));        
        console.log(!(this.v$.email.$dirty && !this.v$.email.required.$invalid && !this.v$.email.email.$invalid));
        console.log(this.v$);
        if (!this.v$.$error) {
          console.log(`DONE`);
          this.$emit('update:Form', {name: this.name, email: this.email, step: 'Card'});
        } else {
          console.log(`FAIL TO SUBMIT`);
        }
      }
  }
}
</script>

<style scoped>
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

.form-card{
  margin: 1rem;
  width: 25rem;
  height: 20rem;
  flex-shrink: 0;
  border-radius: 0.9375rem;
  background: #FFF;
  box-shadow: 0px 0px 59px 0px rgba(211, 6, 6, 0.39);
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

.invalid{
  border: 3px solid rgba(255, 2, 2, 0.493);
}


@media screen and (max-width: 475px) {
  .form-card{
    margin: 0.8rem;
    width: 20rem;
    height: 16rem;
    border-radius: 0.75rem;
  }

  .form-component{
    margin: 1rem;
    width: 16.95rem;
    height: 2rem;
    border-radius: 0.5rem;
    font-size: 0.8rem;
    padding: 0.8rem;
  }

  .invalid{
    border: 2px solid rgba(255, 2, 2, 0.493);
  }
}

</style>