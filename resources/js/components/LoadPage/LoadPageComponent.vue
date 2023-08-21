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
      logo: '/img/logo.png',
    };
  },
};
</script>

<style scoped>
.logo {
  height: 30rem;
  animation: blink 2s infinite;
}

@keyframes blink {
  50% {
    opacity: 0.5;
  }
}
</style>
