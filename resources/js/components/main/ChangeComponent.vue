<template>
    <div class="change-block">
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
                <button class="modal-change-button" @click="changeBack">Готово</button>
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
                    <div class="col align-items-center text-center">
                        <h1 for="amount" class="label-change-field">Отдаете сумму</h1>
                        <div class="align-items-center">
                            <input type="number" inputmode="numeric" v-model="amount" id="amount" class="form-component" :class="{ 'invalid': (v$.amount.$dirty && v$.amount.required.$invalid) }">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center align-items-center">
                  <div class="col align-items-center text-center">
                    <p v-if="this.current_summary != '' && this.current_rate != '' &&  this.from != this.to" class="info-text">
                      На данный момент мы сможем обменять по курсу <span class="info-text-important">{{ this.current_rate}}</span>.<br>
                      Вы получите <span class="info-text-important">{{ this.current_summary }}</span>.<br>
                      <span class="info-text-important">Окончательный курс согласовывается в момент сделки.</span>
                    </p>
                  </div>
                </div>
                <div class="row justify-content-center align-items-center">
                    <div class="col align-items-center text-center">
                        <h1 for="from" class="label-change-field">Способ связи</h1>
                        <div class="align-items-center">
                            <select v-model="connect" id="from" class="form-select" :class="{ 'invalid': (v$.connect.$dirty && v$.connect.required.$invalid) }">
                                <option value="Telegram">Telegram</option>
                                <option value="WhatsApp">WhatsApp</option>
                            </select>
                        </div>
                    </div>
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
        banks: ['RUB', 'THB', 'USDT', 'BTC'],
        from: 'RUB',
        to: 'THB',
        amount: "",
        name: '',
        number: '',
        connect: 'WhatsApp',
        rates: '',
        current_summary: '',
        current_rate: '',
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
    watch: {
      amount: {
        handler: 'updateRateAndSummary',
        immediate: true
      },
      from: {
        handler: 'updateRateAndSummary',
        immediate: true
      },
      to: {
        handler: 'updateRateAndSummary',
        immediate: true
      }
    },
    methods: {
      async updateRateAndSummary() {
        await this.rate_calculate();
        await this.summary_calculate();
      },
      async rate_calculate() {
        // Make API requests to get currency rates
        const binanceUrl = 'https://api.binance.com/api/v3/ticker/price?symbols=["BTCRUB","USDTRUB","BTCUSDT"]';
        const bitkubUsdtUrl = 'https://api.bitkub.com/api/market/ticker?sym=thb_usdt';
        const bitkubBtcUrl = 'https://api.bitkub.com/api/market/ticker?sym=thb_btc';

        // Fetch currency rates from Binance API and Bitkub API
        const binanceResponse = fetch(binanceUrl);
        const bitkubUsdtResponse = fetch(bitkubUsdtUrl);
        const bitkubBtcResponse = fetch(bitkubBtcUrl);

        const [binanceResponseData, bitkubUsdtResponseData, bitkubBtcResponseData] = await Promise.all([
          binanceResponse.then(response => response.json()),
          bitkubUsdtResponse.then(response => response.json()),
          bitkubBtcResponse.then(response => response.json())
        ]);

        // Extract the rates from the API responses
        const binanceData = binanceResponseData;
        const bitkubUsdtData = bitkubUsdtResponseData;
        const bitkubBtcData = bitkubBtcResponseData;

        const btcRubRate = binanceData.find(item => item.symbol === 'BTCRUB').price;
        const usdtRubRate = binanceData.find(item => item.symbol === 'USDTRUB').price;
        const btcUsdtRate = binanceData.find(item => item.symbol === 'BTCUSDT').price;
        const thbUsdtRate = bitkubUsdtData['THB_USDT'].last;
        const thbBtcRate = bitkubBtcData['THB_BTC'].last;

        const rates = {
          'thb_usdt': (thbUsdtRate * 0.95).toFixed(2),
          'thb_rub': (1/(thbUsdtRate * 0.95) * usdtRubRate * 1.05).toFixed(2),
          'thb_btc': (thbBtcRate * 0.95).toFixed(2),
          'btc_usdt': (btcUsdtRate * 1.05).toFixed(2),
          'btc_rub': (btcRubRate * 1.05).toFixed(2),
          'usdt_rub': (usdtRubRate * 1.05).toFixed(2),
        };

        console.log(rates);
        this.rates = rates;

        return {
          rates
        };
      },
      async summary_calculate() {
        // Calculate the amount based on the currency rates
        const rates = (await this.rate_calculate()).rates;
        console.log(rates);
        // Perform the calculation based on the selected currencies and amount input
        let summary = 0;
        let rate = 0;
        if (this.amount != ''){
          //rub <-> thb
          if (this.from === 'RUB' && this.to === 'THB') {   
            rate = rates.thb_rub + ' ₽';    
            summary = (this.amount / rates.thb_rub).toFixed(2) + ' ฿';
          }
          if (this.from === 'THB' && this.to === 'RUB') {         
            rate = rates.thb_rub + ' ₽';    
            summary = (this.amount * rates.thb_rub).toFixed(2) + ' ₽';
          }
          //rub <-> usdt
          if (this.from === 'RUB' && this.to === 'USDT') {
            rate = rates.usdt_rub + ' ₽';    
            summary = (this.amount / rates.usdt_rub).toFixed(2) + ' ₮';
          }
          if (this.from === 'USDT' && this.to === 'RUB') {
            rate = rates.usdt_rub + ' ₽';    
            summary = (this.amount * rates.usdt_rub).toFixed(2) + ' ₽';
          }
          //rub <-> btc
          if (this.from === 'RUB' && this.to === 'BTC') {
            rate = rates.btc_rub + ' ₽';    
            summary = (this.amount / rates.btc_rub).toFixed(7) + ' ₿';
          }
          if (this.from === 'BTC' && this.to === 'RUB') {
            rate = rates.btc_rub + ' ₽';    
            summary = (this.amount * rates.btc_rub).toFixed(2) + ' ₽';
          }
          //btc <-> usdt
          if (this.from === 'BTC' && this.to === 'USDT') {
            rate = rates.btc_usdt + ' ₮';    
            summary = (this.amount * rates.btc_usdt).toFixed(2) + ' ₮';
          }
          if (this.from === 'USDT' && this.to === 'BTC') {
            rate = rates.btc_usdt + ' ₮';
            summary = (this.amount / rates.btc_usdt).toFixed(7) + ' ₿';
          }
          //thb <-> usdt
          if (this.from === 'THB' && this.to === 'USDT') {
            rate = rates.thb_usdt + ' ฿';    
            summary = (this.amount * rates.thb_usdt).toFixed(2) + ' ₮';
          }
          if (this.from === 'USDT' && this.to === 'THB') {
            rate = rates.thb_usdt + ' ฿';    
            summary = (this.amount / rates.thb_usdt).toFixed(2) + ' ฿';
          }
          //thb <-> btc
          if (this.from === 'THB' && this.to === 'BTC') {
            rate = rates.thb_btc + ' ฿';    
            summary = (this.amount / rates.thb_btc).toFixed(7) + ' ₿';
          }
          if (this.from === 'BTC' && this.to === 'THB') {
            rate = rates.thb_btc + ' ฿';    
            summary = (this.amount * rates.thb_btc).toFixed(2) + ' ฿';
          }
          console.log(summary);
          this.current_summary = summary;
          this.current_rate = rate;
          // Return the calculated amount
          return summary;
        }
      },   
      changeBack(){
        this.isDone = false;
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
  
  .change-block {
    position: relative;
    background: #e9e9e9;
    backdrop-filter: blur( 4px );
    -webkit-backdrop-filter: blur( 4px );
    border-radius: 10px;
    border: 1px solid rgba( 255, 255, 255, 0.18 );
    margin: 2rem auto;
    padding: 2rem;
  }

  .use-text{
    color: #2e2e2e;
    font-family: Montserrat-Regular;
    font-size: 0.9rem;
    font-style: normal;
    font-weight: 500;
    line-height: 1.1875rem;
  }


  .info-text{
    margin-top: 1.5rem;
    color: #2e2e2e;
    font-family: Montserrat-Regular;
    font-size: 0.9rem;
    font-style: normal;
    font-weight: 500;
    line-height: 1.1875rem;
  }
  .info-text-important{
    font-family: Montserrat-SemiBold;
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
    width: 18rem;
    height: 2.5rem;
    border-radius: 0.625rem;
    box-shadow: 1px 1px 1px 1px rgba(0, 0, 0, 0.25) inset; 
    font-family: Montserrat-Regular;
    font-size: 1rem;
    font-style: normal;
    font-weight: 600;
    line-height: normal; 
    padding-left: 1rem;
    display: inline-flex;
    align-self: center;
  }
  
  .form-select{
    margin-top: 0.5rem;
    width: 18rem;
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
    border: 1px solid rgba(255, 2, 2, 0.493);
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

  @media screen and (max-width: 992px) {
    .form-component{
      margin-top: 0.4rem;
      width: 10rem;
      height: 2rem;
      border-radius: 0.625rem;
      box-shadow: 1px 1px 1px 1px rgba(0, 0, 0, 0.25) inset; 
      font-size: 0.8rem;
      padding-left: 1rem;
    }
  
    .form-select{
      margin-top: 0.4rem;
      width: 10rem;
      height: 2rem;
      border-radius: 0.625rem;
      box-shadow: 1px 1px 1px 1px rgba(0, 0, 0, 0.25) inset; 
      font-family: Montserrat-Regular;
      font-size: 0.8rem;
      padding-left: 1.8rem;
    }
  }
  
  @media screen and (max-width: 768px) {
    .change-block {
      width: 22.5rem;
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
    .change-block {
      width: 20rem;
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