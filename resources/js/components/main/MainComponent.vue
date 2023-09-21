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
import { defineAsyncComponent } from 'vue';

export default {
  components: {
    HeaderComponent: defineAsyncComponent(() => import('./HeaderComponent.vue')),
    OfferComponent: defineAsyncComponent(() => import('./OfferComponent.vue')),
    UseComponent: defineAsyncComponent(() => import('./UseComponent.vue')),
    BanksComponent: defineAsyncComponent(() => import('./BanksComponent.vue')),
    MerchantComponent: defineAsyncComponent(() => import('./MerchantComponent.vue')),
    MapComponent: defineAsyncComponent(() => import('./MapComponent.vue')),
    AboutComponent: defineAsyncComponent(() => import('./AboutComponent.vue')),
    FooterComponent: defineAsyncComponent(() => import('./FooterComponent.vue')),
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

.myFadeIn{
  animation: fade-in 1s;
}

@keyframes fade-in {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}
</style>