<template>
  <div class="row wow fadeIn">
    <div class="col">
      <button class="action-button" @click="selectAction('Pay')">Оплатить</button>
      <button class="action-button" @click="selectAction('Status')">Узнать статус оплаты</button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
  },
  methods: {
    selectAction(action) {
        console.log(`Выбрано действие: ${action}`);
        this.$emit("update:Action", {action: action});
    }
  }
};
</script>

<style scoped>

.action-button{
  margin: 1rem;
  width: 15rem;
  height: 5rem;
  flex-shrink: 0;
  border-radius: 1.25rem;
  background: rgba( 255, 255, 255, 0.5 );
  box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
  backdrop-filter: blur( 20px );
  -webkit-backdrop-filter: blur( 20px );
  border-radius: 10px;
  border: 0.25rem solid rgba( 255, 255, 255, 0.18 );
  color: #1d1d1d;
  font-family: Montserrat-SemiBold;
  font-size: 1rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
}

</style>