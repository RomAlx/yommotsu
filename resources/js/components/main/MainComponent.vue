<template>
    <HeaderComponent :screenWidth="screenWidth"></HeaderComponent>
    <OfferComponent :screenWidth="screenWidth"></OfferComponent>
    <UseComponent :screenWidth="screenWidth"></UseComponent>
    <BanksComponent :screenWidth="screenWidth"></BanksComponent>
    <MerchantComponent :screenWidth="screenWidth"></MerchantComponent>
    <AboutComponent :screenWidth="screenWidth"></AboutComponent>
    <MapComponent :screenWidth="screenWidth"></MapComponent>
    <FooterComponent :screenWidth="screenWidth"></FooterComponent>
</template>

<script>
import { ref, onMounted } from 'vue';

import HeaderComponent from './HeaderComponent.vue';
import OfferComponent from './OfferComponent.vue';
import UseComponent from './UseComponent.vue';
import BanksComponent from './BanksComponent.vue';
import MerchantComponent from './MerchantComponent.vue';
import MapComponent from './MapComponent.vue';
import AboutComponent from './AboutComponent.vue'
import FooterComponent from './FooterComponent.vue';

export default {
  components: {
    HeaderComponent,
    OfferComponent,
    UseComponent,
    BanksComponent,
    MerchantComponent,
    MapComponent,
    AboutComponent,
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
.myFadeOut{
  opacity: 0;
  transition: opacity 0.5s;
}
</style>