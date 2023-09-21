<template>
  <div class="row wow fadeIn">
    <div class="col">
      <h1 class="label">Успешная оплата!</h1>
      <div class="success-card row align-items-center justify-content-center">
        <div class="col-3">
          <img :src="success" alt="success" class="status-img"> 
        </div>
        <div class="col-9">
          <div class="row justify-content-center">
            <div class="order-card">
              <p class="success-label">Ваш заказ</p>
              <div class="row justify-content-start">
                <div class="col-3"><p class="fix-top success-field-name">Проект</p></div>
                <div class="col-9"><p class="fix-top success-field-value">{{ this.order.project_name }}</p></div>
              </div>
              <div class="row justify-content-start">
                <div class="col-3"><p class="fix-top success-field-name">Email</p></div>
                <div class="col-9"><p class="fix-top success-field-value">{{ this.order.email }}</p></div>
              </div>
              <div class="row justify-content-start">
                <div class="col-3"><p class="fix-top success-field-name">ФИО</p></div>
                <div class="col-9"><p class="fix-top success-field-value">{{ this.order.name }}</p></div>
              </div>
              <div class="row justify-content-start">
                <div class="col-3"><p class="fix-top success-field-name">Сумма</p></div>
                <div class="col-9"><p class="fix-top success-field-value">{{ this.order.amount }}</p></div>
              </div>
              <div class="row justify-content-start">
                <div class="col-3"><p class="fix-top success-field-name">Заказ</p></div>
                <div class="col-9"><p class="fix-top success-field-value">{{ this.order.order_id }}</p></div>
              </div>
            </div>
            
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
      help_url: 'https://t.me/yommotsu_admin',
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

.label-comment{
  text-align:start;
}

.success-card{
  margin: 2rem;
  padding: 1rem;
  width: 32rem;
  height: 13rem;
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

.success-label{
  color: #454545;
  font-family: Montserrat-SemiBold;
  font-size: 1.2rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
}

.success-field-name{
  color: #12724a;
  font-family: Montserrat-SemiBold;
  font-size: 1rem;
  font-style: normal;
  font-weight: 700;
  line-height: normal;
  text-align: start;
}

.success-field-value{
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
  .success-card{
    margin: 1.6rem;
    padding: 1rem;
    width: 25.6rem;
    height: 11rem;
    border-radius: 0.72rem;
  }

  .status-img{
    height: 3rem;
  }

  .success-label{
    font-size: 0.96rem;
  }

  .success-field-name{
    font-size: 0.8rem;
    font-weight: 700;
  }

  .success-field-value{
    font-size: 0.8rem;
  }

  .comment-card{
    margin: 1.6rem;
  }

  .fix-width{
      margin-top: 0.8rem;
      width: 25rem;
  }
}
@media screen and (max-width: 450px) {
  .success-card{
    margin: 1.6rem;
    padding: 1.2rem;
    width: 20rem;
    height: 9rem;
    border-radius: 0.72rem;
  }

  .status-img{
    height: 2.4rem;
  }

  .success-label{
    font-size: 0.76rem;
  }

  .success-field-name{
    font-size: 0.64rem;
  }

  .success-field-value{
    font-size: 0.64rem;
  }

  .comment-card{
    margin: 1.28rem;
  }

  .fix-width{
      margin-top: 0.64rem;
      width: 20rem;
  }
}
</style>