<template>
  <div class="row wow fadeIn">
    <div class="col">
      <h1 class="label">Успешная оплата!</h1>
      <div class="success-card row align-items-center justify-content-center">
        <div class="col-4">
          <img :src="success" alt="success" class="status-img"> 
        </div>
        <div class="col-8">
          <p class="fix-top success-label">Вы оплатили</p>
          <div class="row justify-content-center">
            <div class="col-5"><p class="fix-top success-amount">{{ this.order.amount }}</p></div>
            <div class="col-1"><p class="fix-top success-currency">₽</p></div>
          </div>
        </div>
      </div>
      <p class="label-comment">Комиссия сервиса 10%</p>
      <div class="container fix-width">
        <div class="row justify-content-center">
            <div class="col">
                <button class="success-button"  @click="openNewWindow(this.redirect_url)">Готово</button>
            </div>
            <div class="col">
                <button class="help-button" @click="openNewWindow(this.help_url)">Поддержка</button>
            </div>
        </div>
    </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      success: '/img/payTimer/done.png',
      redirect_url: window.blade_data.redirect_url,
      help_url: 'https://t.me/yommotsu',
    };
  },
  props: {
    order: {
      type: Object,
      required: true,
    },
  },
  methods: {
    openNewWindow(url){
      window.open(url, "_blank");
    }
  }
};
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

.success-card{
  margin: 1rem;
  width: 20.4375rem;
  height: 7.75rem;
  flex-shrink: 0;
  border-radius: 0.9375rem;
  background: #FFF;
  box-shadow: 0px 0px 59px 0px rgba(40, 202, 95, 0.25);
}

.status-img{
  height: 3rem;
}

.fix-top{
  margin-bottom: 0;
}

.success-label{
  color: #454545;
  font-family: Montserrat-Regular;
  font-size: 1.2rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
}

.success-amount{
  color: #28CA5F;
  font-family: Montserrat-SemiBold;
  font-size: 1.5rem;
  font-style: normal;
  font-weight: 700;
  line-height: normal;
}

.success-currency{
  color: #454545;
  font-family: Montserrat-Regular;
  font-size: 1.4rem;
  font-style: normal;
  font-weight: 700;
  line-height: normal;
}

.fix-width{
    margin-top: 1rem;
    width: 25rem;
}

.success-button{
  width: 8.8125rem;
  height: 2.4375rem;
  flex-shrink: 0;
  border-radius: 0.5625rem;
  background: linear-gradient(180deg, #28CA5F 0%, #28CA5F 100%);
  box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.25);
  color: #FFF;
  font-family: Montserrat-Regular;
  font-size: 1rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
  text-align: center;
  text-decoration: none;
}

.help-button{
  width: 8.8125rem;
  height: 2.4375rem;
  flex-shrink: 0;
  border-radius: 0.5625rem;
  border: 2px solid #28CA5F;
  box-shadow: 0px 1px 6px 0px rgba(0, 0, 0, 0.25);
  font-family: Montserrat-Regular;
  font-size: 1rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
}
</style>