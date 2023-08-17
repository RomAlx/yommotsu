<template>
    <div class="row wow fadeIn">
        <div class="container payment-card" :class="bank">
            <div class="row align-items-center">
                <div class="col-7 to-left-side">
                    <small class="card-label">Название проекта</small>
                    <h5 class="card-fill-small">Yommotsu</h5>
                    <small class="card-label">Владелец</small>
                    <h5 class="card-fill-small">Elena</h5>
                </div>
                <div class="col-5 justify-content-center logo">
                    <div class="logo-div">
                        <img :src="srcLogo" alt="bank" :class="logobank">
                    </div>
                </div>
            </div>
            <div class="row second-half">
                <div class="col-9 to-left-side">
                    <small class="card-label">Номер карты</small>
                    <h5 class="card-fill-big">4264 2153 6534 1234</h5>
                </div>
                <div class="col-3 justify-content-center">
                    <small class="card-label">Сумма</small>
                    <h5 class="card-fill-big">1337</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h5 class="label">Обязательно укажите в комментарии последние 4 символа вашего заказа.</h5>
            <h5 class="label comment">LVc7</h5>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col">
                <button type="button" class="done-button" @click="getBack()">Назад</button>
        </div>
        <div class="col">
            <button class="done-button" @click="checking()">Я оплатил!</button>
        </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      tinkoff: '/img/paycard/tinkoff.png',
      sber: '/img/paycard/sberbank.png',
      sbp: '/img/paycard/sbp.png',
      merchant: '',
    };
  },
  beforeMount() {
    axios.get('/api/data')
    .then(response => {
        // Обрабатывайте полученные данные
        console.log(response.data);
    })
  },
  props: {
    bank: {
      type: Object,
      required: true,
    },
  }, 
  computed: {
        bank() {
            return this.bank.name;
        },
        srcLogo () {
            return '/img/paycard/'+this.bank.name+'.png';
        },
        logobank () {
            return 'logo-' + this.bank.name;
        }
  },
  methods: {
      getBack() {
        console.log(`Назад`);
        this.$emit("update:Step", 'Form');
      },
      checking() {
        console.log(this.srcLogo);
      }
    }
};
</script>

<style scoped>
.payment-card{
    width: 35rem;
    height: 19.44rem;
    padding: 2rem;
    flex-shrink: 0;
    border-radius: 1.4375rem;
    display: block;
}

.sberbank{
    background: var(--grad-1, linear-gradient(319deg, #15151D 17.71%, #6ecf6d 100%));
    box-shadow: 0px 2px 19px 3px rgba(0, 0, 0, 0.31);
}
.tinkoff{
    background: linear-gradient(319deg, #15151D 17.71%, #af9e00 88.89%);
    box-shadow: 0px 2px 19px 3px rgba(0, 0, 0, 0.31);
}
.sbp{
    background: linear-gradient(319deg, #15151D 17.71%, #5271a1 100%);
    box-shadow: 0px 2px 19px 3px rgba(0, 0, 0, 0.31);
}

.card-label{
    color: #DDD;
    font-family: Montserrat-Regular;
    font-size: 0.875rem;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
}
.card-fill-small{
    color: #FFF;
    font-family: Montserrat-SemiBold;
    font-size: 1.5625rem;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
}
.card-fill-big{
    color: #FFF;
    font-family: Montserrat-SemiBold;
    font-size: 2rem;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
}

.to-left-side{
    text-align: left
}

.second-half{
    margin-top: 3rem;
}

.comment{
  font-family: Montserrat-Bold;
  font-size: 2rem;
}

.logo-sberbank{
    width: 12rem;
}

.logo-tinkoff{
    width: 9rem;
}

.logo-sbp{
    width: 10rem;
}


@media screen and (max-width: 565px) {
    .payment-card{
        width: 28rem;
        height: 15.552rem;
        padding: 1.6rem;
        border-radius: 1.15rem;
    }

    .card-label{
        font-size: 0.7rem;
    }
    .card-fill-small{
        font-size: 1.25rem;
    }
    .card-fill-big{
        font-size: 1.6rem;
    }

    .second-half{
        margin-top: 2.4rem;
    }

    .comment{
        font-size: 1.6rem;
    }

    .logo-sberbank{
        width: 9.6rem;
    }

    .logo-tinkoff{
        width: 7.2rem;
    }

    .logo-sbp{
        width: 8rem;
    }
}

@media screen and (max-width: 429px) {
    .payment-card{
        width: 22.4rem;
        height: 12.4416rem;
        padding: 1.28rem;
        border-radius: 0.92rem;
    }

    .card-label{
        font-size: 0.56rem;
    }
    .card-fill-small{
        font-size: 1rem;
    }
    .card-fill-big{
        font-size: 1.28rem;
    }

    .second-half{
        margin-top: 1rem;
    }

    .comment{
        font-size: 1.28rem;
    }

    .logo-sberbank{
        width: 7.68rem;
    }

    .logo-tinkoff{
        width: 5.76rem;
    }

    .logo-sbp{
        width: 6.4rem;
    }
}

</style>