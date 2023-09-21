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
      <div v-if="this.isSendComment">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col">
              <h1 class="label feedback">Спасибо за Ваш отзыв</h1>
            </div>
          </div>
        </div>
      </div>
      <div v-else>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col">
              <h1 class="label feedback">Как все прошло?</h1>
            </div>
          </div>
          <div class="container">
            <div class="row justify-content-center">
              <div class="star-block">
                <div class="row justify-content-center">
                  <div class="col-2">
                    <img :src="this.rate >= 1 ? star_active : star_disable" @click="changeRate(1)" alt="gold">
                  </div>
                  <div class="col-2">
                    <img :src="this.rate >= 2 ? star_active : star_disable" @click="changeRate(2)" alt="gold">
                  </div>
                  <div class="col-2">
                    <img :src="this.rate >= 3 ? star_active : star_disable" @click="changeRate(3)" alt="gold">
                  </div>
                  <div class="col-2">
                    <img :src="this.rate >= 4 ? star_active : star_disable" @click="changeRate(4)" alt="gold">
                  </div>
                  <div class="col-2">
                    <img :src="this.rate >= 5 ? star_active : star_disable" @click="changeRate(5)" alt="gold">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="container">
            <div class="row justify-content-center">
              <div class="comment-block">
                <div class="row justify-content-center">
                  <textarea class="comment-area" v-model="comment" placeholder="Напишите что-нибудь..."></textarea>  
                  <div class="col-12">
                    <button class="done-button"  @click="sendComment()">Отправить</button>
                  </div>
                </div>
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
      star_active: '/img/service/star-active.png',
      star_disable: '/img/service/star-disable.png',
      send: false,
      rate: null,
      comment: null,
      isSendComment: false,
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
    },
    changeRate(num){
      this.rate = num;
    },
    sendComment(){
      axios.post('/api/order/update/paypage', {
        data: {
          password: 'P2PEXCHANGE',
          order_id: this.order.order_id,
          rate: this.rate,
          comment: this.comment,
        },
      });
      this.isSendComment = true;
    },
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

.feedback{
  margin: 2rem;
  font-size: 1.4rem;
}

.star-block{
  width: 20rem;
}

.comment-area{
  margin: 1rem;
  padding: 0.5rem 1rem;
  width: 32rem;
  height: 10rem;
  flex-shrink: 0;
  font-family: Montserrat-Regular;
  font-size: 1rem;
  border-radius: 0.9375rem;
  background: rgba( 233, 233, 233, 0.25 );
  box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
  backdrop-filter: blur( 4px );
  -webkit-backdrop-filter: blur( 4px );
  border-radius: 10px;
  border: 1px solid rgba( 255, 255, 255, 0.18 );
  outline: none;
  appearance: none;
}

.comment-block{
  margin-bottom: 3rem;
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