<template>
    <Auth v-if="this.step === 'Auth'" v-on:auth:success="terminal"/>
    <Terminal v-else-if="this.step === 'Terminal'"/>
</template>

<script>
import Auth from './Auth.vue';
import Terminal from './Terminal/Terminal.vue';


export default {
  components: {
      Auth,
      Terminal,
  },
  data() {
    return {
      step: 'Auth',
    };
  },
  methods: {
    terminal(){
      this.step = 'Terminal';
    }
  }
};

</script>

<style>
button{
  border: none;
  outline: none;
}
</style>