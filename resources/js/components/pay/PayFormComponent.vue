<template>
  <div>
    <div id="modal" class="modal">
      <div class="modal-content">
        <span class="close" @click="closeModal">&times;</span>
        <h2 class="modal-label">Основания обработки.</h2>
        <p class="modal-text">
          Основанием Обработки Ваших персональных данных всегда является Ваше согласие. Без согласия с условиями настоящей Политики, мы не будем способны в полной мере обеспечить исполнения обязательств по заключаемым с Вами договорам - поэтому мы сделали невозможным их заключение без обязательного условия согласия с настоящей Политикой.
        </p>
      </div>
    </div>
    <div class="row wow fadeIn">
      <div class="col">
        <div class="form-card row align-items-center justify-content-center">
          <div class="col">
            <h1 class="label">Заполните данные</h1>
            <form @submit.prevent="validateForm" class="form">
                <input id="name" type="text" class="form-component" placeholder="Имя" v-model="name" :class="{ 'invalid': (v$.name.$dirty && v$.name.required.$invalid) }">
                <div id="nameHelp" class="form-text">Имя, которые Вы указали, должно совпадать с именем держателя карты.</div>
                <input id="email" type="text" class="form-component" placeholder="Email" v-model.trim="email" :class="{ 'invalid': (v$.email.$dirty && v$.email.required.$invalid || v$.email.$dirty && v$.email.email.$invalid)}">
                <div id="emailHelp" class="form-text">Чтобы мы могли отправить вам чек на почту.</div>
                <div class="check-group">
                  <div class="row align-items-center">
                    <div class="col-1">
                      <input class="form-check-input btn-outline-danger" type="checkbox" id="checkPrivacy" v-model="agreement.val" :class="{ 'invalid': (agreement.status) }">
                    </div>
                    <div class="col">
                      <label class="form-check-label" for="checkPrivacy" >Принимаю условия сервиса </label>
                    </div>
                  </div>
                </div>
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
        agreement: {
          status: false,
          val: false,
        }
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
      agreement: {required}
    }
  },
  beforeMount(){
    if(this.form.name != ''){
      this.name = this.form.name;
    }
    if(this.form.email != ''){
      this.email = this.form.email;
    }
    if(this.form.agreement != null){
      this.agreement.val = this.form.agreement;
    }
  },
  methods: {
      getBack() {
        console.log(`Назад`);
        this.$emit("update:Step", 'PaymentMethod');
      },
      validateForm() {
        this.v$.$validate();
        if (!this.v$.$error && this.agreement.val) {
          console.log(`DONE`);
          this.$emit('update:Form', {name: this.name, email: this.email, agreement: this.agreement.val, step: 'Card'});
        } else {
          this.agreement.status = !this.agreement.val;
          console.log(`FAIL TO SUBMIT`);
        }
      },
      openModal() {
          let modal = document.getElementById("modal");
          modal.style.display = "block";
      },
      closeModal() {
          let modal = document.getElementById("modal");
          modal.style.display = "none";
      }
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

.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.5);
}

.modal-content {
    position: relative;
    background-color: #fefefe;
    margin: 20% auto;
    padding: 2rem;
    border: 1px solid #888;
    width: 30rem;
}
.modal-label{
  padding-left: 1rem;
  font-family: Montserrat-SemiBold;
  color: #252525;
  font-size: 1.4rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
}

.modal-text{
  padding-left: 1rem;
  font-family: Montserrat-Regular;
  color: #252525;
  font-size: 1rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
  text-align: start;
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
  height: 24rem;
  flex-shrink: 0;
  border-radius: 0.9375rem;
  background: rgba( 255, 255, 255, 0.5 );
  box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
}

.form-text{
  margin: 0.2rem 1rem 1rem 1.1rem;
  width: 21.1875rem;
  text-align: start;
}

.form-component{
  margin: 1rem 1rem 0rem 1rem;
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

.check-group{
  margin: 1rem 1rem 1.5rem 1rem;
  width: 21.1875rem;
  display: block;
}
.form-check-input{
  margin-left: 0.1rem;
  border-radius: 0.3rem;
  background-color: #E3E3E3;
  box-shadow: 1px 1px 2px 0px rgba(0, 0, 0, 0.25) inset; 
  border:#F43B3B;
  font-family: Montserrat-Regular;
  font-size: 1.3rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
}

.form-check-input:checked{
  background-color: #f55454;
}

.form-check-label{
  width: 100%;
  font-family: Montserrat-Regular;
  color: #252525;
  font-size: 0.95rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
  text-align: start;
}

.invalid{
  border: 3px solid rgba(255, 2, 2, 0.493);
}


@media screen and (max-width: 685px) {

  .modal-content {
      padding: 2rem;
      width: 22rem;
  }
  .modal-label{
    padding-left: 0.8rem;
    font-size: 1.12rem;
  }

  .modal-text{
    padding-left: 0.8rem;
    color: #252525;
    font-size: 0.8rem;
  }

  .close {
      top: 0.8rem;
      right: 0.8rem;
      font-size: 1.4rem;
  }

  .form-card{
    margin: 0.8rem;
    width: 20rem;
    height: 24rem;
    border-radius: 0.72rem;
  }

  .form-text{
    margin: 0.16rem 0.8rem 0.8rem 0.88rem;
    width: 16.95rem;
    text-align: start;
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

  .check-group{
    margin: 0.8rem 0.8rem 1.2rem 0.8rem;
    width: 16.95rem;
    display: block;
  }
  .form-check-input{
    margin-left: 0.08rem;
    border-radius: 0.24rem;
    font-size: 1.12rem;
  }

  .form-check-label{
    font-family: Montserrat-Regular;
    color: #252525;
    font-size: 0.76rem;
  }
}

</style>