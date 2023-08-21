<template>
  <div class="row wow fadeIn">
    <div class="col">
      <h1 class="label">Кажется, мы немного задерживаемся.</h1>
      <div class="warning-card row align-items-center justify-content-center">
        <div class="col-3">
          <img :src="warning" alt="warning" class="status-img"> 
        </div>
        <div class="col">
          <div class="order-card">
            <p class="warning-label">Ваш заказ</p>
            <div class="row justify-content-start">
              <div class="col-3"><p class="fix-top warning-field-name">Проект</p></div>
              <div class="col-9"><p class="fix-top warning-field-value">{{ this.order.project_name }}</p></div>
            </div>
            <div class="row justify-content-start">
              <div class="col-3"><p class="fix-top warning-field-name">Email</p></div>
              <div class="col-9"><p class="fix-top warning-field-value">{{ this.order.email }}</p></div>
            </div>
            <div class="row justify-content-start">
              <div class="col-3"><p class="fix-top warning-field-name">ФИО</p></div>
              <div class="col-9"><p class="fix-top warning-field-value">{{ this.order.name }}</p></div>
            </div>
            <div class="row justify-content-start">
              <div class="col-3"><p class="fix-top warning-field-name">Сумма</p></div>
              <div class="col-9"><p class="fix-top warning-field-value">{{ this.order.amount }}</p></div>
            </div>
            <div class="row justify-content-start">
              <div class="col-3"><p class="fix-top warning-field-name">Заказ</p></div>
              <div class="col-9"><p class="fix-top warning-field-value">{{ this.order.order_id }}</p></div>
            </div>
          </div>
          <div class="comment-card">
            <p class="label-comment">Вы можете отслеживать статус заказа на этой странице - она автоматически изменит статус оплаты. </p>
            <p class="label-comment">Также вы можете написать в поддержку узнать статус заказа, передав данные о нем.</p>
          </div>
        </div>
      </div>
      <div class="container fix-width">
        <div class="row justify-content-center">
            <div class="col">
                <button class="warning-button"  @click="openNewWindow(this.redirect_url)">Готово</button>
            </div>
            <div class="col">
                <button class="warning-help-button" @click="openNewWindow(this.help_url)">Поддержка</button>
            </div>
        </div>
    </div>
    </div>
  </div>
</template>

<script scoped>

export default {
  data() {
    return {
      warning: '/img/payTimer/warning.png',
      redirect_url: window.blade_data.redirect_url,
      help_url: 'https://t.me/yommotsu',
    };
  },
  props:{
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

.label-comment{
  text-align:start;
}

.warning-card{
  margin: 1rem;
  width: 40rem;
  height: 25rem;
  flex-shrink: 0;
  border-radius: 0.9375rem;
  background: #FFF;
  box-shadow: 0px 0px 59px 0px rgb(204, 211, 6);
}

.status-img{
  height: 3rem;
}

.fix-top{
  margin-bottom: 0;
}

.warning-label{
  color: #454545;
  font-family: Montserrat-SemiBold;
  font-size: 1.2rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
}

.order-card{
  margin: 2rem;
}

.warning-field-name{
  color: #b3b901;
  font-family: Montserrat-SemiBold;
  font-size: 1rem;
  font-style: normal;
  font-weight: 700;
  line-height: normal;
  text-align: start;
}

.warning-field-value{
  color: #454545;
  font-family: Montserrat-Regular;
  font-size: 1rem;
  font-style: normal;
  font-weight: 700;
  line-height: normal;
  text-align: start;
}

.comment-card{
  margin: 2rem;
  text-align: start;
}

.fix-width{
    margin-top: 1rem;
    width: 25rem;
}

.warning-button{
  width: 8.8125rem;
  height: 2.4375rem;
  flex-shrink: 0;
  border-radius: 0.5625rem;
  background: linear-gradient(180deg, #f6ff00 0%, #cad101 100%);
  box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.25);
  color: #FFF;
  font-family: Montserrat-SemiBold;
  font-size: 1rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
  text-align: center;
  text-decoration: none;
}

.warning-help-button{
  width: 8.8125rem;
  height: 2.4375rem;
  flex-shrink: 0;
  border-radius: 0.5625rem;
  border: 2px solid #DFE800;
  box-shadow: 0px 1px 6px 0px rgba(0, 0, 0, 0.25);
  font-family: Montserrat-Regular;
  font-size: 1rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
}

@media screen and (max-width: 685px) {
  .label-comment{
    font-size: 0.9rem;
  }

  .warning-card{
    margin: 1rem;
    width: 30rem;
    height: 20rem;
    border-radius: 0.9375rem;
  }

  .status-img{
    height: 3rem;
  }

  .warning-label{
    font-size: 0.9rem;
  }

  .order-card{
    margin: 1.5rem;
  }

  .warning-field-name{
    font-size: 0.7rem;
  }

  .warning-field-value{
    font-size: 0.75rem;
  }

  .comment-card{
    margin: 1.5rem;
  }

  .fix-width{
      margin-top: 0.75rem;
      width: 18.75rem;
  }

  .warning-button{
    width: 6.6rem;
    height: 1.8rem;
    border-radius: 0.42rem;
    font-size: 0.75rem;
  }

  .warning-help-button{
    width: 6.6rem;
    height: 1.8rem;
    border-radius: 0.42rem;
    font-size: 0.75rem;
  }
}
@media screen and (max-width: 510px) {
  .label-comment{
    font-size: 0.9rem;
  }

  .warning-card{
    margin: 1rem;
    width: 19rem;
    height: 27rem;
    border-radius: 0.9375rem;
  }

  .status-img{
    height: 3rem;
    margin-top: 1.5rem;
  }

  .warning-label{
    font-size: 0.9rem;
  }

  .order-card{
    margin: 1.5rem;
  }

  .warning-field-name{
    font-size: 0.7rem;
  }

  .warning-field-value{
    font-size: 0.75rem;
  }

  .comment-card{
    margin: 1.5rem;
  }

  .fix-width{
      margin-top: 0.75rem;
      width: 18.75rem;
  }

  .warning-button{
    width: 6.6rem;
    height: 1.8rem;
    border-radius: 0.42rem;
    font-size: 0.75rem;
  }

  .warning-help-button{
    width: 6.6rem;
    height: 1.8rem;
    border-radius: 0.42rem;
    font-size: 0.75rem;
  }
}
</style>