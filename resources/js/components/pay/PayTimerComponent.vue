<template>
  <div class="row wow fadeIn">
    <div class="col">
      <h1 class="label">Партнер проверяет ваш перевод!</h1>
      <p class="label-comment">Как только партнер подтвердит перевод, мы совершим вашу оплату.</p>
      <div class="timer row">
        <div class="col-4">
          <img :src="waiting" alt="waiting" class="status-img"> 
        </div>
        <div class="col-8">
          <p class="fix-top">{{ minutes }}:{{ seconds }}</p> 
        </div>
      </div>
      <p class="label-comment">Обычно проверка занимает до 5 минут.</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
      return {
          waiting: '/img/payTimer/waiting.gif',
          timeoutId: null,
          timeRemaining: 300,
          minutes: 5,
          seconds: 0
      };
  },
  mounted() {
      this.startTimer();
  },
  beforeUnmount() {
      clearTimeout(this.timeoutId);
  },
  methods: {
      startTimer() {
          this.timeoutId = setTimeout(() => {
              this.timeRemaining--;
              this.minutes = Math.floor((this.timeRemaining % 3600) / 60);
              this.seconds = this.timeRemaining % 60;
              
              if(this.timeRemaining > 0) {
                  this.startTimer();
              }
          }, 1000);
      }
  }
};
</script>

<style>
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

.timer{
  color: #262626;
  font-family: Montserrat-SemiBold;
  font-size: 2rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
  width: 19rem;
  height: 5.1875rem;
  flex-shrink: 0;
  border-radius: 0.9375rem;
  background: #FFF;
  display: flex;
  justify-content: center;
  padding: 1rem;
  margin: 2rem;
  text-align: center;
  align-items: center;
}

.status-img{
  height: 3rem;
}

.fix-top{
  margin-bottom: 0;
}
</style>