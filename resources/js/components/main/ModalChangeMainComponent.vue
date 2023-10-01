<template>
  <div id="modal" class="modal">
    <div class="modal-content">
      <span class="close" @click="closeModal">&times;</span>
      <div class="row justify-content-center border-bottom">
        <div class="col">
          <h1 class="label-change">Обмен валюты</h1>
        </div>
      </div>  
      <div class="row justify-content-center">
        <div v-if="this.isDone">
          <h1 class="label-change-field">Отлично!</h1>
          <div class="col align-items-center text-center">
            <img class="done-img" :src="srcServiceCopyDone">
          </div>
          <p class="modal-text">Наш менеджер свяжется с вами втечении 15 минут для уточнения деталей</p>
          <div class="col align-items-center text-center">
            <button class="modal-change-button" @click="closeModal">Готово</button>
          </div>
        </div>
        <div v-else>
          <div class="container form-margin">
            <form @submit.prevent="validateForm()">
              <div class="row justify-content-center">
                <div class="col align-items-center text-center">
                  <h1 for="from" class="label-change-field">Отдаете</h1>
                  <div class="align-items-center">
                    <select v-model="from" id="from" class="form-select" :class="{ 'invalid': (v$.from.$dirty && v$.from.required.$invalid) }">
                      <option v-for="bank in banks" :value="bank">{{ bank }}</option>
                    </select>
                  </div>
                </div>
                <div class="col align-items-center text-center">
                  <h1 for="to" class="label-change-field">Получаете</h1>
                  <div class="align-items-center">
                    <select v-model="to" id="to" class="form-select" :class="{ 'invalid': (v$.to.$dirty && v$.to.required.$invalid) }">
                      <option v-for="bank in banks" :value="bank">{{ bank }}</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row justify-content-center align-items-center">
                <div class="col align-items-center text-center">
                  <h1 for="amount" class="label-change-field">Отдаете сумму</h1>
                  <div class="align-items-center">
                    <input v-model="amount" id="amount" class="form-component" :class="{ 'invalid': (v$.amount.$dirty && v$.amount.required.$invalid) }">
                  </div>
                </div>
                <div class="col align-items-center text-center">
                  <h1 for="from" class="label-change-field">Способ связи</h1>
                  <div class="align-items-center">
                    <select v-model="connect" id="from" class="form-select" :class="{ 'invalid': (v$.connect.$dirty && v$.connect.required.$invalid) }">
                      <option value="Telegram">Telegram</option>
                      <option value="WhatsApp">WhatsApp</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">      
                  <h1 v-if="connect==='WhatsApp'" for="number" class="label-change-field">Номер телефона</h1>
                  <h1 v-else for="number" class="label-change-field">Имя пользователя</h1>
                  <div class="col align-items-center text-center">
                    <input type="tel" v-model="number" id="number" class="form-component" :class="{ 'invalid': (v$.number.$dirty && v$.number.required.$invalid) }">
                  </div>
                </div>
                <div class="col">
                  <h1 for="name" class="label-change-field">Как вас зовут</h1>
                  <div class="col align-items-center text-center">
                    <input type="text" v-model="name" id="name" class="form-component" :class="{ 'invalid': (v$.name.$dirty && v$.name.required.$invalid) }">
                  </div>
                </div>
              </div>    
              <div class="row justify-content-center">
                <div class="col align-items-center text-center">
                  <button type="submit" class="modal-change-button">Создать заявку</button>
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
import axios from 'axios';
import useValidate from '@vuelidate/core';
import { required } from '@vuelidate/validators';
export default {
  data() {
    return {
      csrfToken: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      isDone: false,
      srcServiceCopyDone: '/img/service/done_green.png',
      v$: useValidate(),
      banks: ['Сбербанк | RUB','Тинькофф | RUB','Райффайзен | RUB','ВТБ | RUB','Альфа банк | RUB','ОТП банк | RUB','Vakif Bank | TRY','Bangkok Bank | THB', 'BTC', 'USDT', 'Другая криптовалюта'],
      from: 'Сбербанк | RUB',
      to: 'Bangkok Bank | THB',
      amount: null,
      name: '',
      number: '',
      connect: 'WhatsApp',
    };
  },
  validations() {
    return {
      from: {required},
      to: {required},
      amount: {required},
      name:{required},
      number:{required},
      connect:{required},
    }
  },
  methods: {
    closeModal(){
      this.$emit("close");
    },
    validateForm() {
      this.v$.$validate();
      if (!this.v$.$error) {
        try{
          axios.post('/api/exchange/create/', { 
          headers: {
              'X-CSRF-TOKEN': this.csrfToken
          },
          data: {
            password: 'P2PEXCHANGE',
            buy: this.to,
            sell: this.from,
            amount: this.amount,
            name: this.name,
            connect: this.connect,
            phone: this.number,
          }});
          console.log(`DONE`);
          this.isDone = true;
        } catch {

        }
      } else {
        console.log(`FAIL TO SUBMIT`);
      }
    },
  },
};
</script>

<style scoped>
.done-img{
    background-color: #fdfdfdc5;
    border-radius: 50%;
    height: 8rem;
}
.form-margin{
  margin-top: 1rem;
}
.label-change{
  text-align: center;
  color: var(--gray-900, #18181B);
  font-family: Montserrat-SemiBold;
  font-size: 1.5rem;
  font-style: normal;
  font-weight: 700;
  line-height: 2.21875rem; /* 147.917% */
  letter-spacing: -0.0625rem;
}

.label-change-field{
  margin-top: 0.5rem;
  text-align: center;
  color: var(--gray-900, #18181B);
  font-family: Montserrat-SemiBold;
  font-size: 1.2rem;
  font-style: normal;
  font-weight: 700;
  line-height: 2.21875rem; /* 147.917% */
  letter-spacing: -0.0625rem;
}
.modal-copy {
  display: block;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.274);
}

.modal {
  display: block;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
  position: relative;
  background: #f1f1f1 url(/img/main/use-label-img.png) no-repeat center;
  background-position: 2rem 2rem;
  margin: 15% auto;
  padding: 2rem;
  border: 1px solid #888;
  border-radius: 1rem;
  width: 40rem;
}

.modal-label {
  padding-left: 1rem;
  font-family: Montserrat-SemiBold;
  color: #252525;
  font-size: 1.4rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
}

.modal-text {
  padding-left: 1rem;
  font-family: Montserrat-Regular;
  color: #000000;
  font-size: 1rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
  text-align: center;
}

.modal-text-important {
  color: #b82d2d;
  font-family: Montserrat-SemiBold;
}

.close {
  position: absolute;
  top: 1rem;
  right: 1.5rem;
  color: #131313;
  float: right;
  font-size: 1.8rem;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #ff0000;
  text-decoration: none;
  cursor: pointer;
}

.form-component{
  margin-top: 0.5rem;
  width: 15rem;
  height: 2.5rem;
  border-radius: 0.625rem;
  box-shadow: 1px 1px 1px 1px rgba(0, 0, 0, 0.25) inset; 
  font-family: Montserrat-Regular;
  font-size: 1rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal; 
  padding-left: 2rem;
  display: inline-flex;
  align-self: center;
}

.form-select{
  margin-top: 0.5rem;
  width: 15rem;
  height: 2.5rem;
  border-radius: 0.625rem;
  box-shadow: 1px 1px 1px 1px rgba(0, 0, 0, 0.25) inset; 
  font-family: Montserrat-Regular;
  font-size: 1rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal; 
  padding-left: 2rem;
  display: inline-flex;
  align-self: center;
}

.border-bottom{
  border-bottom: 1px solid #0505054b !important;
}
.modal-change-button {
    margin-top: 2rem;
    color: #ffffff;
    font-family: Montserrat-SemiBold;
    font-size: 1rem;
    width: 10rem;
    height: 2.3rem;
    padding: 0.2rem;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 0.625rem;
    flex-shrink: 0; 
    border-radius: 0.625rem;
    background:  #050505;
    border: none;
    outline: none;
}

.invalid{
  border: 2px solid rgba(255, 2, 2, 0.493);
}

@media screen and (max-width: 1400px) {
  .done-img{
    margin: 1rem;
    background-color: #fdfdfdc5;
    border-radius: 50%;
    height: 6.4rem;
  }
  .form-margin{
    margin-top: 0.8rem;
  }
  .label-change{
    font-size: 1.2rem;
  }

  .label-change-field{
    margin-top: 0.8rem;
    font-size: 1rem;
    line-height: 1rem;
  }

  .modal-content {
    padding: 1.6rem;
    border: 1px solid #888;
    border-radius: 1rem;
    width: 32rem;
  }

  .modal-label {
    padding-left: 1rem;
    font-family: Montserrat-SemiBold;
    color: #252525;
    font-size: 1rem;
  }

  .modal-text {
    padding-left: 1rem;
    font-size: 0.8rem;
  }

  .modal-text-important {
    color: #b82d2d;
    font-family: Montserrat-SemiBold;
  }

  .form-component{
    margin-top: 0.4rem;
    width: 12rem;
    height: 2rem;
    border-radius: 0.625rem;
    box-shadow: 1px 1px 1px 1px rgba(0, 0, 0, 0.25) inset; 
    font-size: 0.8rem;
    padding-left: 1rem;
  }

  .form-select{
    margin-top: 0.4rem;
    width: 12rem;
    height: 2rem;
    border-radius: 0.625rem;
    box-shadow: 1px 1px 1px 1px rgba(0, 0, 0, 0.25) inset; 
    font-family: Montserrat-Regular;
    font-size: 0.8rem;
    padding-left: 1.8rem;
  }

  .border-bottom{
    border-bottom: 1px solid #0505054b !important;
  }
  .modal-change-button {
      margin-top: 1.6rem;
      font-size: 0.8rem;
      width: 8rem;
      height: 1.84rem;
      padding: 0.1rem;
      gap: 0.625rem;
      border-radius: 0.5rem;
  }
}

@media screen and (max-width: 768px) {
  .modal-content {
    position: relative;
    background: #f1f1f1 url(/img/main/use-label-img.png) no-repeat center;
    background-position: 2rem 2rem;
    margin: 15% auto;
    padding: 2rem;
    border: 1px solid #888;
    border-radius: 1rem;
    width: 23rem;
  }
  .form-component{
    margin-top: 0.4rem;
    width: 16rem;
    height: 2rem;
    border-radius: 0.625rem;
    box-shadow: 1px 1px 1px 1px rgba(0, 0, 0, 0.25) inset; 
    font-size: 0.8rem;
    padding-left: 1rem;
  }

  .form-select{
    margin-top: 0.4rem;
    width: 16rem;
    height: 2rem;
    border-radius: 0.625rem;
    box-shadow: 1px 1px 1px 1px rgba(0, 0, 0, 0.25) inset; 
    font-family: Montserrat-Regular;
    font-size: 0.8rem;
    padding-left: 1.8rem;
  }
}

@media screen and (max-width: 476px) {
  .done-img{
    margin: 1rem;
    background-color: #fdfdfdc5;
    border-radius: 50%;
    height: 6.4rem;
  }
  .form-margin{
    margin-top: 0.8rem;
  }
  .label-change{
    font-size: 1.2rem;
  }

  .label-change-field{
    margin-top: 0.8rem;
    font-size: 1rem;
    line-height: 1rem;
  }

  .modal-content {
    margin-top: 9rem;
    padding: 1.6rem;
    border: 1px solid #888;
    border-radius: 1rem;
    width: 18rem;
  }

  .modal-label {
    padding-left: 1rem;
    font-family: Montserrat-SemiBold;
    color: #252525;
    font-size: 1rem;
  }

  .modal-text {
    padding-left: 1rem;
    font-size: 0.8rem;
  }

  .modal-text-important {
    color: #b82d2d;
    font-family: Montserrat-SemiBold;
  }

  .form-component{
    margin-top: 0.4rem;
    width: 12rem;
    height: 2rem;
    border-radius: 0.625rem;
    box-shadow: 1px 1px 1px 1px rgba(0, 0, 0, 0.25) inset; 
    font-size: 0.8rem;
    padding-left: 1rem;
  }

  .form-select{
    margin-top: 0.4rem;
    width: 12rem;
    height: 2rem;
    border-radius: 0.625rem;
    box-shadow: 1px 1px 1px 1px rgba(0, 0, 0, 0.25) inset; 
    font-family: Montserrat-Regular;
    font-size: 0.8rem;
    padding-left: 1.8rem;
  }

  .border-bottom{
    border-bottom: 1px solid #0505054b !important;
  }
  .modal-change-button {
      margin-top: 1.6rem;
      font-size: 0.8rem;
      width: 8rem;
      height: 2rem;
      padding: 0.1rem;
      gap: 0.625rem;
      border-radius: 0.5rem;
  }
}
</style>