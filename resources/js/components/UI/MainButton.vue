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
    width: 13rem;
    height: 3rem;
    padding: 0.5rem;
    flex-direction: column;
    justify-content: center;
    align-items: center;
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
</style>