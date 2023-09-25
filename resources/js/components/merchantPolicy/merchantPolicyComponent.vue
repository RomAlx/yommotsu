<template>
    <HeaderComponent :screenWidth="screenWidth"></HeaderComponent>
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="card">
            <h1 class="label">Требования к проектам</h1>
            <p class="text">
              Прежде, чем Мы сможем подключить Нашу онлайн-кассу к Вашему бизнесу (сайту или телеграмм - боту) , есть несколько требований, которые необходимо соблюсти: <br><br>

              1. Сайт или телеграмм-бот должен быть создан и функционировать на основе современных веб-стандартов или платформы Telegram.<br>

              2. Ваш веб-сайт или бот должны поддерживать интеграцию по API (Application Programming Interface).<br>

              3. У вас должен быть доступ к административной панели вашего сайта или настроенного бота. Необходимо, чтобы мы могли получить доступ к настройкам и интегрировать нашу онлайн-кассу.<br>

              4. Ваш сайт или бот должен иметь возможность передавать данные о продажах и платежах в режиме реального времени. Это необходимо для корректной работы кассового аппарата.<br>

              5. У вас должна быть надежная и стабильная интернет-связь, чтобы обмен данными с онлайн-кассой осуществлялся без сбоев и задержек.<br>

              6. Для выполнения операций по подключению кассы к вашему бизнесу, мы можем попросить вас предоставить определенные данные и доступы. Пожалуйста, будьте готовы предоставить нам необходимую информацию.<br>

              * Мы подключаем только открытые бизнес проекты, и не сотрудничаем с мошенническими предприятиями. <br><br>

              Если все эти требования выполнены, мы сможем приступить к подключению вашей онлайн-кассы к вашему бизнесу. Если у вас есть дополнительные вопросы или требуется более подробная информация, не стесняйтесь обращаться. Наша команда всегда готов помочь!<br><br>

              Последнее обновление: 03.08.2023
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
</style>