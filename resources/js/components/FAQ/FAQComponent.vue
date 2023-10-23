<template>
    <HeaderComponent :screenWidth="screenWidth"></HeaderComponent>
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="card">
            <h1 class="label">FAQ</h1>
            <p class="text">
              Q: <span class="question">Кто мы?</span><br>
              A: Мы являемся провайдером услуг по приему платежей. Наша компания предоставляет надежные и безопасные решения для приема платежей офлайн и онлайн платежей.<br><br>
              Q: <span class="question">Чем мы можем помочь?</span><br>
              A: Мы можем помочь вам упростить процесс приема платежей, обеспечить безопасность ваших транзакций и предоставить аналитику для управления финансами вашего бизнеса.<br><br>
              Q: <span class="question">Как это работает?</span><br>
              A: Наш сервис работает следующим образом: мы предоставляем вам уникальную ссылку или кнопку, которую вы нажимаете на сайте и бот сервисе, для оплаты услуги. Мы обрабатываем платежи, обеспечиваем их безопасность и передаем вам информацию о каждой успешной транзакции.<br><br>
              Q: <span class="question">Какая информация требуется для использования нашего сервиса?</span><br>
              A: Для использования нашего сервиса вам потребуется ввести Имя держателя карты и предоставить email адрес ,для отправки вам уведомлений о статусе заказа. Мы также можем запросить дополнительные документы для проверки ваших данных и обеспечения безопасности.<br><br>
              Q: <span class="question">Как проходит оплата со стороны клиента?</span><br>
              A: Для ответа на этот вопрос мы подготовили инструкцию в <a href="https://teletype.in/@yommotsu/bsQj4ErmGhA" target="_blank">текстовом варианте</a> и видео процесса оплаты.<br><br>
            </p>
            <!--<div class="video-container">
              <iframe src="https://www.youtube.com/embed/9GZrqNbJrEI" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>-->
            <p class="text">
              <i>Надеемся, эти ответы помогут вам. Если у вас возникнут еще вопросы, не стесняйтесь спрашивать!</i>
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
a{
  color: #18181B;
}
.card{
    margin-top: 6rem;
    background: #e9e9e9;
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
    font-size: 1.8rem;
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

.question {
    color: #18181B;
    font-family: Montserrat-SemiBold;
}

.video-container {
  margin: 0rem 0rem 2rem 0rem;
  position: relative;
  width: 66%;
  padding-bottom: 37.125%; /* Задаем соотношение сторон 16:9 (высота / ширина) */
}

.video-container iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

@media (max-width: 768px) {
  .video-container {
    margin: 0rem 0rem 1rem 0rem;
    width: 90%;
    padding-bottom: 50.625%; /* Изменяем соотношение сторон для мобильных устройств */
  }
}
</style>