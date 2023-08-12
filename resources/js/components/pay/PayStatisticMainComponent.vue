<template>
  <div class="container">
    <div class="row">
      <div class="col-lg-2 d-flex flex-column align-items-start justify-content-start">
        <label for="projectSelect">Выберите проект: </label>  
        <select class="form-control red-select" id="projectSelect" v-model="selectedProject"> 
          <option value="all">Все</option> 
          <option v-for="project in projects">{{ project.bot_name }}</option> 
        </select> 
        <label for="periodSelect ">Выберите период: </label> 
        <select class="form-control red-select" id="periodSelect" v-model="selectedPeriod"> 
          <option value="day">Сегодня</option> 
          <option value="week">Неделя</option> 
          <option value="month">Месяц</option>
          <option value="year">Год</option> 
        </select> 
        <label for="statusSelect">Выберите Статус: </label> 
        <select class="form-control red-select" id="statusSelect" v-model="selectedStatus"> 
          <option value="all">Все</option>
          <option value="PAID">PAID</option> 
          <option value="WAITING">WAITING</option> 
          <option value="REJECTED">REJECTED</option> 
        </select>
        <button class="btn btn-danger">Скачать отчет</button> 
      </div> 
      <div class="col-lg-9">
        <div class="table-responsive" style="height:100vh; overflow:auto">
          <table class="table table-sticky">
            <thead class="thread-light">
              <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Название проекта</th>
                <th class="text-center">ID заказа</th>
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
                <td class="text-center">{{ item.amount }}</td>
                <td class="text-center">{{ item.status }}</td>
                <td class="text-center">{{ item.created_at }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div> 
  </div>
</template>

<script>
import axios from 'axios'
import { ref, watch } from 'vue'

export default {
  setup () {
    const items = ref([])
    const projects = ref([])
    const selectedProject = ref('all')
    const selectedPeriod = ref('month')
    const selectedStatus = ref('all')
    const password = 'P2PEXCHANGE'

    const fetchData = async () => {
      const res = await axios.get(`/api/pay/statistic/get`, {
        params: {
          password: password,
          project_name: selectedProject.value, 
          period: selectedPeriod.value,
          status: selectedStatus.value
        }
      })
      let arr = Object.entries(res.data);
      arr.forEach(([key, value]) => {
        console.log(value.created_at)
        let date = new Date(value.created_at)
        let dateString = date.toLocaleDateString() 
        let timeString = date.toLocaleTimeString()
        value.created_at = dateString + ' ' + timeString
        console.log(value.created_at)
      });
      items.value = await res.data
      
    }

    const fetchProjects = async () => {
      const res = await axios.get(`/api/projects/get/projects`, {
        params: {
          password: password,
        }
      })
      projects.value = await res.data
    }

    const downloadReport = async () => {
      const res = await axios.get(`/api/pay/statistic/download`, {
        responseType: 'blob', // Также важно
        params: {
          password: password, 
          project_name: selectedProject.value, 
          period: selectedPeriod.value, 
          status: selectedStatus.value,
        }
      })

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
  }
}
</script>


<style scoped>
.table-sticky thead th {
  position: sticky;
  top: 0;
  z-index: 2;
  background-color: #f7bfab;
}

select {
  margin-bottom: 10px; 
}

.red-select:focus {
  border-color: red;
  outline: 0;
  box-shadow: 0 0 0 0.2rem rgba(255, 0, 0, 0.25); /* Это добавляет красный подсветок вместо синего */
}

</style>