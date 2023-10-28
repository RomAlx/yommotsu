<template>
  <div class="row">
    <div class="col-lg-8">
      <div class="table-responsive" style="height:100vh; overflow:auto">
        <table class="table table-sticky">
          <thead class="thread-light">
            <tr>
              <th class="text-center">ID</th>
              <th class="text-center">Название проекта</th>
              <th class="text-center">ID заказа</th>
              <th class="text-center">Email</th>
              <th class="text-center">ФИО</th>
              <th class="text-center">Сумма</th>
              <th class="text-center">Статус</th>
              <th class="text-center">Дата создания</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in items">
              <td class="text-center">{{ item.id }}</td>
              <td class="text-center">{{ item.project_name }}</td>
              <td class="text-center">{{ item.order_id }}</td>
              <td class="text-center">{{ item.email }}</td>
              <td class="text-center">{{ item.name }}</td>
              <td class="text-center">{{ item.amount }}</td>
              <td class="text-center">{{ item.status }}</td>
              <td class="text-center">{{ item.created_at }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-lg-4 d-flex flex-column align-items-center justify-content-start">
      <div class="settings">
        <label for="projectSelect">Выберите проект: </label>  
        <select class="form-control red-select" id="projectSelect" v-model="selectedProject"> 
          <option value="all">Все</option> 
          <option v-for="project in projects">{{ project.bot_name }}</option> 
        </select> 
        <label for="statusSelect">Выберите Статус: </label> 
        <select class="form-control red-select" id="statusSelect" v-model="selectedStatus"> 
          <option value="all">Все</option>
          <option value="PAID">PAID</option> 
          <option value="WAITING">WAITING</option> 
          <option value="REJECTED">REJECTED</option> 
        </select>
        <label for="periodSelect ">Выберите период: </label> 
        <select class="form-control red-select" id="periodSelect" v-model="selectedPeriod"> 
          <option value="day">Сегодня</option> 
          <option value="week">Неделя</option> 
          <option value="month">Месяц</option>
          <option value="year">Год</option> 
        </select> 
        <button class="btn btn-danger" @click="downloadReport">Скачать отчет</button> 
      </div> 
    </div>
  </div> 
</template>

<script>
import axios from 'axios';
import { ref, watch, onMounted } from 'vue';
import DatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

export default {
  components: {
    DatePicker
  },
  setup () {
    const items = ref([])
    const projects = ref([])
    const selectedProject = ref('all')
    const selectedPeriod = ref('month')
    const selectedStatus = ref('all')
    const password = 'P2PEXCHANGE'
    const csrfToken = document.getElementById('admin').getAttribute('data-csrf-token')

    const fetchData = async () => {
      console.log(localStorage.getItem('access_token'));

      const res = await axios.get(`/api/admin/statistic/get`, {
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'X-AUTH-TOKEN': localStorage.getItem('access_token'),
        },
        params: {
          password: password,
          project_name: selectedProject.value, 
          period: selectedPeriod.value,
          status: selectedStatus.value
        },
      })
      if(res.data.redirect){
        window.location.href = `/${res.data.redirect}`;
      }
      let arr = Object.entries(res.data);
      arr.forEach(([key, value]) => {
        console.log(value.created_at)
        let date = new Date(value.created_at)
        let dateString = date.toLocaleDateString() 
        let timeString = date.toLocaleTimeString()
        value.created_at = dateString + ' ' + timeString
      });
      items.value = await res.data
      
    }

    const fetchProjects = async () => {
      const res = await axios.get(`/api/projects/get/projects`, {
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'X-AUTH-TOKEN': localStorage.getItem('access_token'),
        },
        params: {
          password: password,
        },
      })
      if(res.data.redirect){
        window.location.href = `/${res.data.redirect}`;
      }
      projects.value = await res.data
    }

    const downloadReport = async () => {
      const res = await axios.get(`/api/admin/statistic/download`, {
        headers: {
          'X-CSRF-TOKEN': csrfToken,
          'X-AUTH-TOKEN': localStorage.getItem('access_token'),
        },
        responseType: 'blob',
        params: {
          password: password, 
          project_name: selectedProject.value, 
          period: selectedPeriod.value, 
          status: selectedStatus.value,
        }
      });

      let filename = '';
      const disposition = res.headers['content-disposition'];
      if (disposition && disposition.indexOf('attachment') !== -1) {
        const filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
        const matches = filenameRegex.exec(disposition);
        if (matches !== null && matches[1]) {
          filename = matches[1].replace(/['"]/g, '');
        }
      }
      console.log(res)
      const url = window.URL.createObjectURL(new Blob([res.data]));
    
      const link = document.createElement('a');
      link.href = url;
      link.setAttribute('download', filename); 
      document.body.appendChild(link);
      link.click();
    }

    onMounted(() => {
      const startDate = new Date();
      const endDate = new Date(new Date().setDate(startDate.getDate() + 7));
      selectedPeriod.value = [startDate, endDate];
    });

    fetchProjects()
    fetchData()

    watch(selectedProject, () => {
      fetchData();
    });

    watch(selectedPeriod, () => {
      fetchData();
    });

    watch(selectedStatus, () => {
      fetchData();
    });

    return {
      items,
      projects,
      selectedProject,
      selectedPeriod,
      selectedStatus,
      downloadReport
    }
  },

  methods: {
    showDatePicker() {
      this.isOpen = true;
    },
    hideDatePicker() {
      this.isOpen = false;
    },
    previousMonth() {
      this.currentDate.setMonth(this.currentDate.getMonth() - 1);
    },
    nextMonth() {
      this.currentDate.setMonth(this.currentDate.getMonth() + 1);
    },
    selectDate(day) {
      const selectedMonth = this.currentDate.getMonth() + 1;
      const formattedMonth = selectedMonth < 10 ? `0${selectedMonth}` : selectedMonth;
      const formattedDay = day < 10 ? `0${day}` : day;
      this.selectedDate = `${this.currentDate.getFullYear()}-${formattedMonth}-${formattedDay}`;
      this.hideDatePicker();
    },
    isSelected(day) {
      if (!this.selectedDate) {
        return false;
      }
      const [selectedYear, selectedMonth, selectedDay] = this.selectedDate.split('-');
      const selectedDate = new Date(selectedYear, selectedMonth - 1, selectedDay);
      return selectedDate.getDate() === day && selectedDate.getMonth() === this.currentDate.getMonth() && selectedDate.getFullYear() === this.currentDate.getFullYear();
    }
  }
}
</script>

<style lang="scss">
.dp-custom-cell {
  border-radius: 50%;
}
.dp__range_start, .dp__range_end{
  border: none;
  background: rgb(173, 13, 13);
}
.dp__range_between{
  border: none;
  background: rgba(255, 0, 0, 0.26);
}
</style>

<style scoped>

.settings{
  margin-left: 2rem;;
  width: 16.5rem;
}
.table-sticky thead th {
  position: sticky;
  top: 0;
  z-index: 2;
}

select {
  margin-bottom: 10px; 
}

.red-select:focus {
  border-color: red;
  outline: 0;
  box-shadow: 0 0 0 0.2rem rgba(255, 0, 0, 0.25); /* Это добавляет красный подсветок вместо синего */
}

.datepicker{
  margin: 1rem 0;
}


</style>