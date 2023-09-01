<template>
    <button class="main-button"><slot></slot></button>
</template>
  
<script>
export default {
  name: "MainButton",
  methods: { },
};
</script>

<style scoped>
.main-button {
    display: flex;
    width: 11.5rem;
    height: 3rem;
    padding: 0.5rem;
    flex-direction: column;
    border-radius: 0.625rem;
    background: var(--gray-900, #18181B);
    box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.178);
    color: #FFF;
    font-family: Montserrat-Regular;
    font-size: 1rem;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
}

@media screen and (max-width: 989px) {
  .main-button {
    width: 9rem;
    height: 2.4rem;
    padding: 0.5rem;
    font-size: 0.8rem;
  }
}

@media screen and (max-width: 769px) {
  .main-button {
    width: 7.2rem;
    height: 1.92rem;
    padding: 0.4rem;
    font-size: 0.64rem;
  }
}

</style>