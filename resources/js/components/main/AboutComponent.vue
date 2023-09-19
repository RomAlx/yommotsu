<template>
    <section class="about wow fadeIn" id="about">
        <div class="container">
            <div class="row">
                <h1 class="about-label">О нас</h1>
            </div>
            <div class="row">
                <p class="about-text"><span class="about-text-important">YOMMOTSU</span> - это проект, созданный с целью совершать обмен валюты <span class="about-text-important">просто</span>, <span class="about-text-important">выгодно</span> и <span class="about-text-important">безопасно</span>. <br>
                    Мы понимаем, что наши потенциальные клиенты, проводящие международные платежи и совершающие обмен валюты, часто сталкиваются со сложностями, скрытыми комиссиями и непредсказуемыми курсами. <br>
                    Поэтому мы разработали уникальную систему, которая решает все эти проблемы.
                </p> 
            </div>
            <div class="row justify-content-center">
                <div class="about-rollers">
                    <div class="row justify-content-center roller">
                        <div class="col-7 align-items-center">
                            <h1 class="about-roller-field on-left">Cделок за месяц</h1>
                        </div>
                        <div class="col-5 align-items-center">
                            <h1 class="about-roller-value on-right"><span ref="deals"></span></h1>
                        </div>
                    </div>
                    <div class="row justify-content-center roller">
                        <div class="col-5 align-items-center">
                            <h1 class="about-roller-value  on-left"><span ref="turnover"></span> THB</h1>
                        </div>
                        <div class="col-7 align-items-center">
                            <h1 class="about-roller-field on-right">Месячный оборот</h1>
                        </div>
                    </div>
                    <div class="row justify-content-center roller">
                        <div class="col-7 align-items-center">
                            <h1 class="about-roller-field  on-left">Постоянных клиентов</h1>
                        </div>
                        <div class="col-5 align-items-center">
                            <h1 class="about-roller-value on-right"><span ref="clients"></span></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { CountUp } from 'countup.js';

export default {
  data() {
    return {
      counter: 0,
      deals: 368,
      turnover: 10061012,
      clients: 2500
    };
  },
  mounted() {
    this.startCounters();
  },
  methods: {
    startCounters() {
      const options = {
        startVal: 0,
        duration: 3,
        separator: ' ',
        decimal: ' ',
        suffix: '',
        useEasing: true,
        useGrouping: true,
        formattingFn: CountUp.formatNumber
      };

      const dealsCounter = new CountUp(this.$refs.deals, this.deals, options);
      if (!dealsCounter.error) {
        dealsCounter.start();
      } else {
        console.error(dealsCounter.error);
      }

      const turnoverCounter = new CountUp(this.$refs.turnover, this.turnover, options);
      if (!turnoverCounter.error) {
        turnoverCounter.start();
      } else {
        console.error(turnoverCounter.error);
      }

      const clientsCounter = new CountUp(this.$refs.clients, this.clients, options);
      if (!clientsCounter.error) {
        clientsCounter.start();
      } else {
        console.error(clientsCounter.error);
      }
    },
  }
};
</script>

<style>
.about{
    padding-top: 6rem;
}
.about-label{
    color: #090914;
    text-align: center;
    font-family: Montserrat-SemiBold;
    font-size: 2rem;
    font-style: normal;
    font-weight: 600;
    line-height: 1.875rem;
}
.about-text {
    color: #090914;
    font-family: Montserrat-Regular;
    font-size: 1.2rem;
    font-style: normal;
    font-weight: 500;
    line-height: 1.625rem;
    margin-top: 1rem;
    margin-bottom: 1rem;
    text-align: start;
}
.about-text-important {
    color: #090914;
    font-family: Montserrat-Semibold;
    font-size: 1.2rem;
    font-style: normal;
    font-weight: 500;
    line-height: 1.625rem;
    margin-top: 1rem;
    margin-bottom: 1rem;
    text-align: start;
}

.about-rollers{
    margin-top: 1rem;
    background: #f1f1f1;
    box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
    backdrop-filter: blur( 20px );
    -webkit-backdrop-filter: blur( 20px );
    border: 0.25rem solid rgba( 255, 255, 255, 0.18 );
    width: 42rem; 
    padding: 2vw;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 0.625rem;
    flex-shrink: 0; 
    border-radius: 1rem;
}

.roller{
    margin: 1rem 0rem;
}

.about-roller-field{
    color: #090914;
    font-family: Montserrat-SemiBold;
    font-size: 1.6rem;
    font-style: normal;
    font-weight: 600;
    line-height: 1.875rem;
}

.about-roller-value{
    color: #ec0101;
    font-family: Montserrat-SemiBold;
    font-size: 1.6rem;
    font-style: normal;
    font-weight: 600;
    line-height: 1.875rem;
}

.on-left{
    text-align: start;
}

.on-right{
    text-align: end;
}

@media screen and (max-width: 996px) {
    .about{
        padding-top: 6.5rem;
    }
    .about-label{
        font-size: 2rem;
        line-height: 1.875rem;
    }
    .about-text {
        font-size: 1rem;
        line-height: 1.625rem;
        margin-top: 1rem;
        margin-bottom: 1rem;
    }
    .about-text-important {
        font-size: 1rem;
        line-height: 1.625rem;
        margin-top: 1rem;
        margin-bottom: 1rem;
    }

    .about-rollers{
        margin-top: 1rem;
        width: 31rem; 
        padding: 2vw;
        border-radius: 1rem;
    }

    .roller{
        margin: 1rem 0rem;
    }

    .about-roller-field{
        font-size: 1.2rem;
        line-height: 1.875rem;
    }

    .about-roller-value{
        font-size: 1.2rem;
        line-height: 1.875rem;
    }
}
@media screen and (max-width: 576px) {
    .about{
        padding-top: 6.5rem;
    }
    .about-label{
        font-size: 2rem;
        line-height: 1.875rem;
    }
    .about-text {
        font-size: 1rem;
        line-height: 1.625rem;
        margin-top: 1rem;
        margin-bottom: 1rem;
    }
    .about-text-important {
        font-size: 1rem;
        line-height: 1.625rem;
        margin-top: 1rem;
        margin-bottom: 1rem;
    }

    .about-rollers{
        margin-top: 1rem;
        width: 24rem; 
        padding: 2vw;
        border-radius: 1rem;
    }

    .roller{
        margin: 1rem 0rem;
    }

    .about-roller-field{
        font-size: 0.9rem;
        line-height: 1.875rem;
    }

    .about-roller-value{
        font-size: 1rem;
        line-height: 1.875rem;
    }

}
</style>