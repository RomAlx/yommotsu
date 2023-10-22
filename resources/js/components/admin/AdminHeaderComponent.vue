<template>
  <div class="text-center border-bottom">
      <div class="row my_nav justify-content-evenly">
          <div class="col align-self-center">
              <img :src="logo" alt="Logo" class="logo">
          </div>
          <div class="col align-self-center">
              <p class="date">{{ this.currentDateTime }}</p>    
              <h1 class="project_name">{{ this.project_name }}</h1>   
          </div>
      </div>
  </div>
</template>

<script>
import axios from 'axios'
import { ref, watch } from 'vue'

export default {
  props: {
    project_name: {
      type: String,
      required: true,
    }
  },
  data() {
    return {
      logo: '/img/logo.png',
      currentDateTime: '',
    };
  },
  mounted() {
    this.getCurrentDateTime();
    setInterval(this.getCurrentDateTime, 1000);
  },
  methods: {
    getCurrentDateTime() {
        const now = new Date();

        const days = ['Вс','Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'];
        const months = ['января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'];
        const dayOfWeek = now.getDay();
        const dayOfMonth = now.getDate();
        const month = now.getMonth();
        let hour = now.getHours();
        let minute = now.getMinutes();

        hour = hour < 10 ? `0${hour}` : hour;
        minute = minute < 10 ? `0${minute}` : minute;
        const formattedDateTime = `${days[dayOfWeek]}, ${dayOfMonth} ${months[month]} ${hour}:${minute}`;

        this.currentDateTime = formattedDateTime;
    },
  }
}
</script>


<style scoped>
.my_nav{
  height: 15vh;
}

.logo{
    width:15rem;
}

.project_name{
  margin: 0.5rem;
  color: #262626;
  font-family: Montserrat-SemiBold;
  font-size: 1.3rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
  text-transform: uppercase;
}

</style>