<template>
  <div class="row">
    <div class="col-md-2">
      <!-- Боковая панель слева -->
      <div class="sidebar border-right">
        <!-- Меню -->
        <ul class="nav flex-column">
          <li class="nav-item">
            <h1 class="nav-link active tab" @click="ChangeTab('statistic')" :class="{ 'active-tab': tab === 'statistic'}">Статистика</h1> 
          </li>
          <li class="nav-item">
            <h1 class="nav-link active tab" href="#" @click="ChangeTab('error')" :class="{ 'active-tab': tab === 'error'}">Что-то еще</h1>
          </li>
        </ul>
      </div>
    </div>
    <div class="col-md-10">
      <!-- Место для подключения другого компонента -->
      <div class="main-content">
        <component :is="component"></component>
      </div>
    </div>
  </div>
</template>

<script>
import { watch } from 'vue';
export default {
  props: ['component'],
  data(){
    return {
      tab: 'statistic'
    }
  },
  methods: {
    ChangeTab(tab){
      this.tab = tab;
      this.$emit('update:Tab', tab);
    }
  }
};
</script>

<style>
.sidebar {
  height: 85vh; /* Высота боковой панели */
  padding-top: 20px;
  border-right: 1px solid #dee2e6;
}

.main-content {
  /* Стили для основного содержимого справа */
  padding: 20px;
  height: 85vh;
}

.tab{
  color: #262626;
  font-family: Montserrat-SemiBold;
  font-size: 1rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
  text-decoration: none;
  text-align: center;
}

.tab:hover{
  color: #ff0000;
  cursor: pointer;
}

.active-tab{
  color: #ff0000;
}


</style>
