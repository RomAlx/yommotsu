<template>
    <div id="modal" class="modal">
      <div class="modal-content">
        <span class="close" @click="closeModal">&times;</span>
        <div class="row justify-content-center border-bottom">
          <div class="col">
            <h1 class="label-change">Покупка товара</h1>
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
                <div class="row justify-content-center align-items-center">
                  <div class="col align-items-center text-center">
                    <h1 for="link" class="label-change-field">Ссылка на товар</h1>
                    <div class="align-items-center">
                      <input v-model="link" id="link" class="form-component" :class="{ 'invalid': (v$.link.$dirty && v$.link.required.$invalid) }">
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
        isDone: false,
        srcServiceCopyDone: '/img/service/done_green.png',
        v$: useValidate(),
        link: '',
        name: '',
        number: '',
        connect: 'WhatsApp',
      };
    },
    validations() {
      return {
        link: {required},
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
            console.log({
              password: 'P2PEXCHANGE',
              link: this.link,
              name: this.name,
              connect: this.connect,
              phone: this.number,
            });
            axios.post('/api/purchase/create/', { 
            data: {
              password: 'P2PEXCHANGE',
              link: this.link,
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
    color: #252525;
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
    border: 3px solid rgba(255, 2, 2, 0.493);
  }


@media screen and (max-width: 1400px) {
  .done-img{
      background-color: #fdfdfdc5;
      border-radius: 50%;
      height: 8rem;
  }
  .form-margin{
    margin-top: 1rem;
  }
  .label-change{
    font-size: 1rem;
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
    color: #252525;
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
    border: 3px solid rgba(255, 2, 2, 0.493);
  }
}

@media screen and (max-width: 992px) {
    .offer{
        height:50rem;
    }
    .offer-label{
        font-size: 1.6rem;
        line-height: 1.7rem;
        margin-top: 1.2rem;
        margin-bottom: 1.2rem;
        text-align: center;
    }

    .offer-text {
        font-size: 0.96rem;
        line-height: 1.3rem;
        margin-bottom: 0.8rem;
        text-align: center;
    }

    .offer-button {
        margin-top: 1.6rem;
        margin-bottom: 0.8rem;
        font-size: 0.96rem;
        width: 8.8rem;
        padding: 0.4rem;
        border-radius: 0.5rem;
        text-align: center;
    }

    .offer-button:hover{
        box-shadow: 0 0 3rem red;
    }
    .offer-img{
        width: 32rem;
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
  }

@media screen and (max-width: 560px) {
    .offer{
        height: 43rem;
    }
    .offer-label{
        font-size: 1.28rem;
        line-height: 1.36rem;
        margin-top: 0.96rem;
        margin-bottom: 0.96rem;
    }

    .offer-text {
        font-size: 0.9rem;
        line-height: 1.04rem;
        margin-bottom: 0.64rem;
    }

    .offer-button {
        margin-top: 1.28rem;
        margin-bottom: 0.64rem;
        font-size: 0.77rem;
        width: 7.04rem;
        padding: 0.32rem;
        border-radius: 0.4rem;
    }

    .offer-button:hover{
        box-shadow: 0 0 2rem red;
    }
    .offer-img{
        width: 25.6rem;
    }
}

@media screen and (max-width: 475px) {
    .offer-img {
        width: 18rem;
  }
}
  </style>