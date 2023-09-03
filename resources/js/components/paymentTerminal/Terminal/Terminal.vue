<template>
    <div id="createOrder" class="modal wow fadeIn">
        <CreateOrder v-on:Close="closeModal('createOrder')"></CreateOrder>
    </div>
    <div id="QrCode" class="modal wow fadeIn">
        <ShowQrCode v-on:Close="closeModal('QrCode')" :order="this.order"></ShowQrCode>
    </div>
    <div class="container text-center">
        <div class="row my_nav justify-content-evenly">
            <div class="col align-self-center">
                <img :src="logo" alt="Logo" class="logo">
            </div>
            <div class="col align-self-center">
                <p class="date">{{ this.currentDateTime }}</p>    
                <h1 class="project_name">{{ this.projectName }}</h1>   
            </div>
            <div class="col align-self-center">
                <MainButton @click="openModal('createOrder')">Создать заказ</MainButton>
            </div>
        </div>
    </div>
    <div class="container">
        <table class="table">
            <thead>
                <tr class="table-field">
                    <th>Номер</th>
                    <th>Время</th>
                    <th>Заказ</th>
                    <th>Сумма</th>
                    <th>QR code</th>
                    <th>Статус</th>
                </tr>
            </thead>
            <tbody>
                <tr class="table-value" v-for="order in data.orders" :key="order.number">
                    <td>{{ order.number }}</td>
                    <td>{{ order.time }}</td>
                    <td>{{ order.order_id.slice(-4) }}</td>
                    <td>{{ order.amount }}</td>
                    <td><a href = "#" @click="showQrCode(order, 'QrCode')">Смотреть</a></td>
                    <td :class="this.statusClass(order.status)">{{ order.status }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
  
<script>
import { reactive, onBeforeUnmount, onMounted } from 'vue';
import axios from 'axios';
import CreateOrder from './CreateOrder/Main.vue';
import ShowQrCode from './ShowQrCode.vue';

export default {
  components: {
    CreateOrder,
    ShowQrCode,
  },
  data() {
    return {
      logo: '/img/logo.png',
      currentDateTime: '',
      projectName: window.blade_data.project_name,
      order: {
        projectName: window.blade_data.project_name,
        order_id: 'nope',
        amount: 'nope',
      },
    };
  },
  setup() {
        const data = reactive({
            orders: null,
        });
        let axiosIntervalId;

        const options = {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        };

        const dateFormatter = new Intl.DateTimeFormat('default', options);

        const processData = (response) => {
            data.orders = response.data;
            for (let i = 0; i < data.orders.length; i++) {
                const timestamp = new Date(data.orders[i].time * 1000);
                const formattedTime = dateFormatter.format(timestamp);

                data.orders[i].time = formattedTime;

                switch (data.orders[i].status) {
                    case 'CREATED':
                        data.orders[i].status = 'Создан'
                        break;
                    case 'WAITING':
                        data.orders[i].status = 'Ожидает'
                        break;
                    case 'PAID':
                        data.orders[i].status = 'Оплачен'
                        break;
                    case 'REJECTED':
                        data.orders[i].status = 'Отклонен'
                        break;
                }
            }
        };

        const makeAxiosRequest = () => {
            axios.get('/api/order/get/today', {
                params: {
                    project_name: window.blade_data.project_name,
                    password: window.blade_data.password,
                }
            })
            .then(response => {
                processData(response);
            });
        };

        onMounted(() => {
            axiosIntervalId = setInterval(makeAxiosRequest, 5000);
            makeAxiosRequest();
        });

        onBeforeUnmount(() => {
            clearInterval(axiosIntervalId);
        });

        return {
            data
        };
  },
  mounted() {
    this.getCurrentDateTime();
    setInterval(this.getCurrentDateTime, 1000);
  },
  methods: {
    getCurrentDateTime() {
        const now = new Date();

        const days = ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'];
        const months = ['января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'];
        const dayOfWeek = now.getDay();
        const dayOfMonth = now.getDate();
        const month = now.getMonth();
        let hour = now.getHours();
        let minute = now.getMinutes();

        hour = hour < 10 ? `0${hour}` : hour;
        minute = minute < 10 ? `0${minute}` : minute;

        const formattedDateTime = `${days[dayOfWeek - 1]}, ${dayOfMonth} ${months[month]} ${hour}:${minute}`;

        this.currentDateTime = formattedDateTime;
    },
    showQrCode(order, id) {
        console.log(order);
        console.log(id);
        this.order = order;
        let modal = document.getElementById(id);
        console.log(modal);
        modal.style.display = "block";
    },
    openModal(id) {
        let modal = document.getElementById(id);
        modal.style.display = "block";
    },
    closeModal(id) {
        let modal = document.getElementById(id);
        modal.style.display = "none";
    },
    statusClass(status) {
        switch (status) {
            case 'Создан':
                return 'status-created';
            case 'Ожидает':
                return 'status-waiting';
            case 'Оплачен':
                return 'status-success';
            case 'Отклонен':
                return 'status-rejected';
        }
    }
  },
}
</script>

<style>
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

.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.5);
}

.modal-content {
    position: relative;
    background-color: #fefefe;
    margin: 15% auto;
    padding: 2rem;
    border: 1px solid #888;
}

.modal-label{
  padding-left: 1rem;
  font-family: Montserrat-SemiBold;
  color: #252525;
  font-size: 1.4rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
}

.modal-text{
  padding-left: 1rem;
  font-family: Montserrat-Regular;
  color: #252525;
  font-size: 1rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
  text-align: start;
}

.close {
    position: absolute;
    top: 1rem;
    right: 1.5rem;
    color: #aaa;
    float: right;
    font-size: 1.8rem;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color:#b82d2d;
    text-decoration: none;
    cursor: pointer;
}

.date{
    color: #262626;
    text-align: center;
    font-family: Montserrat-SemiBold;
    font-size: 1rem;
    font-style: normal;
    font-weight: 300;
    line-height: normal;
}

.table-container {
  overflow-y: auto; /* Включаем скролл, если таблица превышает высоту экрана */
  height: 85vh; /* Высота контейнера с таблицей (высота экрана) */
}

.table {
  margin-top: 2rem;
  border-collapse: collapse;
  width: 100%;
}

.table-field {
    padding: 8px;
    text-align: center;
    font-family: Montserrat-SemiBold;
    font-size: 1rem;
    font-style: normal;
    font-weight: 300;
    line-height: normal;
    background: var(--gray-900, #303030);
    color: #FFF;
    font-family: Montserrat-SemiBold;
    font-size: 1rem;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
}

.table-value {
    padding: 8px;
    text-align: left;
    color: #262626;
    text-align: center;
    font-family: Montserrat-SemiBold;
    font-size: 1rem;
    font-style: normal;
    font-weight: 300;
    line-height: normal;
}

.status-created{
    color: #262626;
}

.status-success{
    color: #226d00;
}

.status-waiting{
    color: #979500;
}

.status-rejected{
    color: #6b0000;
}


th, td{
    border: 1px solid #303030;
}

a{
    color:#b82d2d;
}
a:hover{
    color:#811515;
}

@media screen and (max-width: 989px) {

    .logo{
        width: 12rem;
    }
    .modal-content {
        margin: 20% auto;
    }

    .project_name{
        margin: 0.5rem;
        font-size: 1.04rem;
    }

    .modal-content {
        padding: 1.6rem;
    }

    .modal-text{
        padding-left: 0.8rem;
        font-size: 0.8rem;
    }

    .close {
        top: 0.8rem;
        right: 1.2rem;
        font-size: 1.6rem;
    }

    .date{
        font-size: 0.8rem;
    }

    .table-field {
        padding: 7px;
        font-size: 0.8rem;
    }

    .table-value {
        padding: 7px;
        font-size: 0.8rem;
    }

    th, td{
        border: 1px solid #303030;
    }
}

@media screen and (max-width: 769px) {

    .logo{
        width: 9.6rem;
    }

    .modal-content {
        padding: 1.6rem;
    }

    .modal-text{
        padding-left: 0.8rem;
        font-size: 0.8rem;
    }

    .close {
        top: 0.8rem;
        right: 1.2rem;
        font-size: 1.6rem;
    }

    .date{
        font-size: 0.8rem;
    }

    .table-field {
        padding: 7px;
        font-size: 0.64rem;
    }

    .table-value {
        padding: 7px;
        font-size: 0.64rem;
    }

    th, td{
        border: 1px solid #303030;
    }
}

@media screen and (max-width: 567px) {
    .modal-content {
        max-width: 20rem;
    }

    .table-field {
        padding: 7px;
        font-size: 0.5rem;
    }

    .table-value {
        padding: 7px;
        font-size: 0.5rem;
    }

    th, td{
        border: 1px solid #303030;
    }

}
  
</style>