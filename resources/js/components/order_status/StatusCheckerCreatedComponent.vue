<template>
  <div class="row wow fadeIn">
    <div class="col">
      <div class="created-card row align-items-center justify-content-center">
        <div class="col">
          <div class="order-card">
            <p class="created-label">Оплата не завершена</p>
            <div class="row justify-content-start">
              <div class="col-3"><p class="fix-top created-field-name">Проект</p></div>
              <div class="col-9"><p class="fix-top created-field-value">{{ this.order.project_name }}</p></div>
            </div>
            <div class="row justify-content-start">
              <div class="col-3"><p class="fix-top created-field-name">Email</p></div>
              <div class="col-9"><p class="fix-top created-field-value">{{ this.order.email }}</p></div>
            </div>
            <div class="row justify-content-start">
              <div class="col-3"><p class="fix-top created-field-name">ФИО</p></div>
              <div class="col-9"><p class="fix-top created-field-value">{{ this.order.name }}</p></div>
            </div>
            <div class="row justify-content-start">
              <div class="col-3"><p class="fix-top created-field-name">Сумма</p></div>
              <div class="col-9"><p class="fix-top created-field-value">{{ this.order.amount }}</p></div>
            </div>
            <div class="row justify-content-start">
              <div class="col-3"><p class="fix-top created-field-name">Заказ</p></div>
              <div class="col-9"><p class="fix-top created-field-value">{{ this.order.order_id }}</p></div>
            </div>
          </div>
        </div>
        <div class="comment-card">
          <p class="label-comment">Вернитесь на <a :href="payLink" target="_blank">страницу оплаты</a> и завершите её.</p>
          <p class="label-comment">
            Если вы уже совершили оплату, то необходимо:<br> 
            1) Вернуться на <a :href="payLink" target="_blank">страницу оплаты</a><br>
            2) Выбрать способ, которым вы оплатили<br>
            3) Не повторяя оплаты, нажать на кнопку "Я оплатил"<br>
          </p>
          <p class="label-comment">После этих действий заказ заказ автоматически попадет в работу.</p>
          <p class="label-comment">Также вы можете написать в поддержку узнать статус заказа, передав данные о нем.</p>
        </div>
      </div>
      <div class="container fix-width">
        <div class="row justify-content-center">
            <div class="col">
                <button class="done-button"  @click="openNewWindow(this.redirect_url)">Готово</button>
            </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script scoped>
import axios from 'axios';

export default {
  data() {
    return {
      csrfToken:  document.getElementById('order-status').getAttribute('data-csrf-token'),
      warning: '/img/payTimer/warning.png',
      redirect_url: '/',
      help_url: 'https://t.me/yommotsu_admin',
      send: false,
    };
  },
  props:{
    order: {
      type: Object,
      required: true,
    },
  },
  computed: {
    payLink() {
      const { project_name, amount, order_id, redirect_url, name } = this.order;
      let baseUrl = 'https://yommotsu.com'
      if (this.order.name != null) {
        baseUrl = baseUrl + '/pay';
      } else {
        baseUrl = baseUrl + '/pay/secret';
      }
      const queryParams = new URLSearchParams({
        project_name: this.order.project_name,
        order_id: this.order.order_id,
        redirect_url: '/',
        amount: this.order.amount
      });
      return `${baseUrl}?${queryParams.toString()}`;
    }
  },
  methods: {
    openNewWindow(url){
      window.open(url, "_blank");
    }
  }
};
</script>

<style scoped>
a{
  color: #ff0000;
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

.label-comment{
  font-size: 1rem;
  text-align:start;
}

.created-card{
  margin: 1rem;
  padding: 2rem;
  width: 41rem;
  flex-shrink: 0;
  border-radius: 0.9375rem;
  background: rgba( 255, 255, 255, 0.5 );
  box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
}

.status-img{
  height: 3rem;
}

.fix-top{
  margin-bottom: 0;
}

.created-label{
  color: #ff0000;
  font-family: Montserrat-SemiBold;
  font-size: 1.2rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
}

.created-field-name{
  margin-right: 2rem;
  color: #0f0f0f;
  font-family: Montserrat-SemiBold;
  font-size: 1rem;
  font-style: normal;
  font-weight: 700;
  line-height: normal;
  text-align: start;
}

.created-field-value{
  margin-left: 2rem;
  color: #454545;
  font-family: Montserrat-Regular;
  font-size: 1rem;
  font-style: normal;
  font-weight: 700;
  line-height: normal;
  text-align: start;
}

.comment-card{
  padding: 2rem;
  text-align: start;
}

.fix-width{
    margin-top: 1rem;
    width: 25rem;
}

@media screen and (max-width: 685px) {
  .label-comment{
    font-size: 0.9rem;
  }

  .created-card{
    margin: 1rem;
    padding: 2rem;
    width: 30rem;
    border-radius: 0.9375rem;
  }

  .status-img{
    height: 3rem;
  }

  .created-label{
    font-size: 0.9rem;
  }

  .created-field-name{
    font-size: 0.7rem;
  }

  .created-field-value{
    font-size: 0.75rem;
  }

  .fix-width{
      margin-top: 0.75rem;
      width: 18.75rem;
  }
}
@media screen and (max-width: 510px) {
  .label-comment{
    font-size: 0.8rem;
  }

  .created-card{
    margin: 1rem;
    padding: 1.5rem;
    width: 19rem;
    border-radius: 0.9375rem;
  }

  .status-img{
    height: 3rem;
    width: 3rem;
  }

  .created-label{
    font-size: 0.9rem;
  }

  .order-card{
    margin: 1rem;
    margin-left: 0rem;
  }

  .warning-field-name{
    font-size: 0.7rem;
  }

  .warning-field-value{
    font-size: 0.75rem;
  }

  .comment-card{
    padding: 1rem;
  }

  .fix-width{
      margin-top: 0.75rem;
      width: 18.75rem;
  }
}
</style>