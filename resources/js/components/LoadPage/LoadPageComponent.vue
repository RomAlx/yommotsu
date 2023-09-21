<template>
  <div class="row">
      <div class="col">
          <img :src="logo" alt="Logo" class="logo">
      </div>
  </div>
</template>

<script scoped>

export default {
  data() {
    return {
      logo: '/img/loading.png',
    };
  },
};
</script>

<style scoped>
.logo {
  height: 15rem;
  animation: blink 4s infinite;
}

@keyframes blink {
  50% {
    opacity: 0.1;
    transform: scale(0.7);
  }
}
</style>
