<template>
  <section class="banks wow fadeIn">
    <div class="container">
      <div class="row justify-content-center align-items-center">
        <div class="col align-items-center">
          <h1 class="banks-label">Банки с которыми мы работаем</h1>
          <div class="banks-table">
            <div class="row justify-content-center align-items-center">
              <div class="d-flex justify-content-center text-center"
                :class="{ 'col-2': screenWidth >= 992, 'col-3': screenWidth < 992 && screenWidth >= 576, 'col-4': screenWidth < 576 }">
                <img class="bank" :src="srcSberImg">
              </div>
              <div class="d-flex justify-content-center text-center"
                :class="{ 'col-2': screenWidth >= 992, 'col-3': screenWidth < 992 && screenWidth >= 576, 'col-4': screenWidth < 576 }">
                <img class="bank" :src="srcTinkoffImg">
              </div>
              <div class="d-flex justify-content-center text-center"
                :class="{ 'col-2': screenWidth >= 992, 'col-3': screenWidth < 992 && screenWidth >= 576, 'col-4': screenWidth < 576 }">
                <img class="bank" :src="srcAlfaImg">
              </div>
              <div class="d-flex justify-content-center text-center"
                :class="{ 'col-2': screenWidth >= 992, 'col-3': screenWidth < 992 && screenWidth >= 576, 'col-4': screenWidth < 576 }">
                <img class="bank" :src="srcOtpBankImg">
              </div>
              <div class="d-flex justify-content-center text-center"
                :class="{ 'col-2': screenWidth >= 992, 'col-3': screenWidth < 992 && screenWidth >= 576, 'col-4': screenWidth < 576 }">
                <img class="bank" :src="srcRaiffeisenImg">
              </div>
              <div class="d-flex justify-content-center text-center"
                :class="{ 'col-1': screenWidth >= 992, 'col-2': screenWidth < 992 && screenWidth >= 576, 'col-3': screenWidth < 576 }">
                <img class="bank" :src="srcVtbImg">
              </div>
              <div class="d-flex justify-content-center text-center"
                :class="{ 'col-2': screenWidth >= 992, 'col-3': screenWidth < 992 && screenWidth >= 576, 'col-4': screenWidth < 576 }">
                <img class="bank" :src="srcBangkokBankImg">
              </div>
              <div class="d-flex justify-content-center text-center"
                :class="{ 'col-2': screenWidth >= 992, 'col-3': screenWidth < 992 && screenWidth >= 576, 'col-4': screenWidth < 576 }">
                <img class="bank" :src="srcVakifImg">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      srcSberImg: '/img/main/banks/sberbank.png',
      srcBangkokBankImg: '/img/main/banks/bangkokbank.png',
      srcOtpBankImg: '/img/main/banks/otpbank.png',
      srcRaiffeisenImg: '/img/main/banks/raiffeisen.png',
      srcAlfaImg: '/img/main/banks/alfa.png',
      srcTinkoffImg: '/img/main/banks/tinkoff.png',
      srcVakifImg: '/img/main/banks/vakif.png',
      srcVtbImg: '/img/main/banks/vtb.png',
    };
  },
  props: {
    screenWidth: {
      type: Number,
      required: true,
    },
  },
}

</script>

<style>
.banks {
  height: 20rem;
  padding-top: 5rem;
}

.banks-label {
  color: #909090;
  text-align: center;
  font-family: Montserrat-SemiBold;
  font-size: 1.25rem;
  font-style: normal;
  font-weight: 600;
  line-height: 1.875rem;
}

.banks-table {
  margin-top: 2rem;
}

.bank {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
}

@media screen and (max-width: 992px) {
  .banks-label {
    font-size: 1.125rem;
  }
}</style>