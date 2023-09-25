<template>
    <HeaderComponent :screenWidth="screenWidth"></HeaderComponent>
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="card">
            <h1 class="label">Политика конфиденциальности и правила оказания услуг.</h1>
            <p class="text">
            1. Стороны и платежный партнер<br>
              1.1. В данной политике конфиденциальности участниками являются "Сервис приема платежей для бизнеса из РФ" (далее "Yommotsu") и пользователь (далее "Клиент").<br>
              1.2. Платежный партнер (далее ”Бизнес Партнер”) - третья сторона, с которой Сервис Yommotsu сотрудничает для обеспечения выполнения платежных операций.<br><br>
            2. Принятие условий оферты<br>
              2.1. Клиент обязуется ознакомиться с условиями оферты Сервиса Yommotsu полностью  и принять их путем согласия с данными условиями.<br>
              2.2. При согласии с условиями оферты, Клиент предоставляет Сервису Yommotsu свое согласие на обработку персональных данных в соответствии с политикой конфиденциальности.<br><br>

            3. Срок действия, изменения оферты<br>
              3.1. Условия оферты, включая политику конфиденциальности, имеют срок действия с момента принятия Клиентом до момента его отзыва.<br>
              3.2. Сервис Yommotsu имеет право вносить изменения в условия оферты и политику конфиденциальности; изменения вступают в силу с момента их опубликования на официальном сайте Сервиса *ссылка на политику конфиденциальности<br><br>

            4. Объем услуг для получателя<br>
              4.1. Сервис обеспечивает услуги по приему платежей от Клиента и переводу их Бизнес Партнеру.<br>
              4.2. Сервис не несет ответственности за выполнение обязательств Бизнес Партнера перед Клиентом.<br><br>

            5. Объем услуг для клиента<br>
              5.1. Клиент имеет возможность использовать Сервис Yommotsu для осуществления платежных операций в соответствии с правилами и требованиями.<br>
              5.2. Сервис не несет ответственности за возможные ошибки или задержки, связанные с работой Бизнес Партнера.<br><br>

            6. Операции возврата<br>
              6.1. В случае необходимости возврата платежа, Клиенту следует обратиться в Нашу службу  технической поддержки или техническую поддержку Бизнес Партнера. Для решения данного вопроса вам необходимо иметь КВИТАНЦИЮ о переводе и ЧЕК, который мы вам высылали на вашу почту.<br><br>
              6.2. Сервис Yommotsu принимает прямое участие в операциях возврата при согласие Бизнес Партера,  в соответствии с правилами, установленными нами и Бизнес Партнером.<br><br>

            7. Конфиденциальность<br>
              7.1. Сервис обязуется обеспечить конфиденциальность и безопасность персональных данных Клиента.<br>
              7.2. Сервис может использовать персональные данные Клиента только в целях идентификации вашего платежа . А так же по запросу Бизнес Партнера<br><br>

            8. Ответственность<br>
              8.1. Сервис не несет ответственности за потерю, повреждение или несанкционированное использование информации Клиента, если это произошло по вине третьих лиц.<br><br>


            Официальные контакты:<br>
            - Адреса: <br>
            * Россия, Москва, Башня Федерации | Пресненская набережная, 12 +7 999 123 25 01 <br>
            * Россия, Пермь, ул. Тополевый переулок д. 5 +7 999 123 25 01 <br>
            * Thailand, Phuket, 50/27 Soi Anusorn street, Mueang Phuket, Thailand +66 95 475 7374 <br>
            * Turkey, Antalia, Elmali Mahallesi 10. Sokak Hakki Gokceoglu Hani, D:No:8/D +90 537 392 1806 <br><br>
            - Email:<br>
            * Официальная почта <a href="mailto:admin@yommotsu.com">admin@yommotsu.com</a><br>
            * Почта поддержки <a href="mailto:support@yommotsu.com">support@yommotsu.com</a><br><br>
            - Телеграмм: <br>
            * Канал <a href="https://t.me/yommotsu_university"> Yommotsu - University</a><br>
            * Бот <a href="https://t.me/yommotsubot"> YOMMOTSU</a><br>
            * Официальный аккаунт <a href="https://t.me/yommotsu_admin">@yommotsu_admin</a><br>
            * Аккаунт владельца сервиса <a href="https://t.me/yommotsu4btc">@yommotsu4btc</a><br><br>

            УКАЗАННЫЕ КОНТАКТЫ ЕДИНСТВЕННЫЕ ОФИЦИАЛЬНЫЕ ИСТОЧНИКИ СВЯЗИ. ПОЖАЛУЙСТА БУДЬТЕ ВНИМАТЕЛЬНЫ!  <br><br>


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