<template>
  <div class="row wow fadeIn">
    <div class="col">
      <h1 class="label">Оплата отменена</h1>
      <div class="error-card row align-items-center justify-content-center">
        <div class="col-3">
          <img :src="error" alt="error" class="status-img"> 
        </div>
        <div class="col justify-content-start">
          <div class="order-card">
            <p class="error-label">Ваш заказ</p>
            <div class="row justify-content-start">
              <div class="col-3"><p class="fix-top error-field-name">Проект</p></div>
              <div class="col-9"><p class="fix-top error-field-value">{{ this.order.project_name }}</p></div>
            </div>
            <div class="row justify-content-start">
              <div class="col-3"><p class="fix-top error-field-name">Email</p></div>
              <div class="col-9"><p class="fix-top error-field-value">{{ this.order.email }}</p></div>
            </div>
            <div class="row justify-content-start">
              <div class="col-3"><p class="fix-top error-field-name">ФИО</p></div>
              <div class="col-9"><p class="fix-top error-field-value">{{ this.order.name }}</p></div>
            </div>
            <div class="row justify-content-start">
              <div class="col-3"><p class="fix-top error-field-name">Сумма</p></div>
              <div class="col-9"><p class="fix-top error-field-value">{{ this.order.amount }}</p></div>
            </div>
            <div class="row justify-content-start">
              <div class="col-3"><p class="fix-top error-field-name">Заказ</p></div>
              <div class="col-9"><p class="fix-top error-field-value">{{ this.order.order_id }}</p></div>
            </div>
          </div>
          <div class="error-label comment-card">
            <p class="fix-top">Вы можете написать в поддержку узнать детали заказа и причину отмены.</p>
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
      error: '/img/payTimer/error.png',
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

.error-card{
  margin: 1rem;
  padding: 1.5rem;
  width: 35rem;
  height: 20rem;
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

.error-label{
  color: #454545;
  font-family: Montserrat-SemiBold;
  font-size: 1.2rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
}

.error-card{
  margin: 2rem;
}

.error-field-name{
  color: #b90101;
  font-family: Montserrat-SemiBold;
  font-size: 1rem;
  font-style: normal;
  font-weight: 700;
  line-height: normal;
  text-align: start;
}

.error-field-value{
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
  font-family: Montserrat-Regular;
}

.fix-width{
    margin-top: 1rem;
    width: 25rem;
}

@media screen and (max-width: 685px) {
  .label-comment{
    font-size: 0.9rem;
  }

  .error-card{
    margin: 1.25rem;
    padding: 1.125rem;
    width: 26.25rem;
    height: 19rem;
    border-radius: 0.9375rem;
  }

  .status-img{
    height: 3rem;
  }

  .error-label{
    font-size: 0.9rem;
  }

  .order-card{
    margin: 1.5rem;
  }

  .error-field-name{
    font-size: 0.7rem;
  }

  .error-field-value{
    font-size: 0.75rem;
  }

  .comment-card{
    margin: 1rem;
  }

  .fix-width{
    margin-top: 0.75rem;
    width: 18.75rem;
  }
}
@media screen and (max-width: 510px) {
  .label-comment{
    font-size: 0.9rem;
  }

  .error-card{
    margin: 1rem;
    padding: 0.5rem;
    width: 19rem;
    height: 23rem;
    border-radius: 0.9375rem;
  }

  .status-img{
    height: 3rem;
    margin-top: 1.5rem;
  }

  .error-label{
    font-size: 0.9rem;
  }

  .order-card{
    margin: 1.5rem;
  }

  .error-field-name{
    font-size: 0.7rem;
  }

  .error-field-value{
    font-size: 0.75rem;
  }

  .comment-card{
    margin: 1.5rem;
  }

  .fix-width{
      margin-top: 0.75rem;
      width: 18.75rem;
  }
}
</style>