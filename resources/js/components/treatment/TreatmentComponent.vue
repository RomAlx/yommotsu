<template>
    <HeaderComponent :screenWidth="screenWidth"></HeaderComponent>
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="card">
            <h1 class="label"> Условия обработки персональных данных.</h1>
            <p class="text">
              Мы собираем только ту персональную информацию, которая необходима для обеспечения наших услуг. В случае регистрации или оформления заказа, мы просим вас предоставить<br><br>

              1. Имя для идентификации отправителя: Оно должно совпадать с именем держателя капоты, с которой будет совершен перевод.<br><br>

              2. Email для получения уведомлений о статусе заказа: указывайте только действительную почту, к которой имеете доступ.<br>
              * Дальнейшая смена почтового адреса будет невозможна.<br><br>

              3. Мы принимаем все необходимые меры для защиты предоставленных вами данных от несанкционированного доступа, утраты, изменения или раскрытия. Мы используем надежные методы и технологии для обеспечения безопасности ваших данных.<br><br>

              4. Мы храним ваши данные только в течение необходимого периода времени для выполнения наших обязательств по предоставлению сервиса.<br>
              * Мы не передаем ваши персональные данные третьим сторонам. <br>
              ** Если вы хотите удалить свои данные, свяжитесь с нами, и мы обработаем ваш запрос соответствующим образом.<br>
            </p>
          </div>
        </div>
      </div>
    </div>
    <FooterComponent :screenWidth="screenWidth"></FooterComponent>
</template>

<script>
import { ref, onMounted } from 'vue';

import HeaderComponent from '../Header/HeaderComponent.vue';
import FooterComponent from '../Footer/FooterComponent.vue';

export default {
  components: {
    HeaderComponent,
    FooterComponent,
  },
  setup() {
    const screenWidth = ref(0);

    onMounted(() => {
      screenWidth.value = getWidth(); // Устанавливаем начальное значение screenWidth
      window.addEventListener('resize', updateWidth); // Добавляем слушатель события resize окна
    });

    const getWidth = () => {
      if (typeof window !== 'undefined') {
        return document.documentElement.clientWidth || window.innerWidth;
      }
      return 0;
    };

    const updateWidth = () => {
      screenWidth.value = getWidth();
    };

    return {
      screenWidth,
    };
  },
}
</script>

<style>
.card{
    margin-top: 6rem;
    background: #f1f1f1;
    box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
    backdrop-filter: blur( 20px );
    -webkit-backdrop-filter: blur( 20px );
    border: 0.25rem solid rgba( 255, 255, 255, 0.18 );
    padding: 2rem;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 0.625rem;
    flex-shrink: 0; 
    border-radius: 1rem;
}
.myFadeOut{
  opacity: 0;
  transition: opacity 0.5s;
}

.label{
    color: var(--gray-900, #18181B);
    font-family: Montserrat-SemiBold;
    font-size: 2rem;
    font-style: normal;
    font-weight: 700;
    line-height: 2.21875rem; /* 147.917% */
    letter-spacing: -0.0625rem;
    margin-top: 1.5rem;
    margin-bottom: 1.5rem;
    text-align: center;
}

.text {
    color: #18181B;
    font-family: Montserrat-Regular;
    font-size: 1.2rem;
    font-style: normal;
    font-weight: 500;
    line-height: 1.625rem;
    margin-top: 1rem;
    margin-bottom: 1rem;
    text-align: start;
}
</style>