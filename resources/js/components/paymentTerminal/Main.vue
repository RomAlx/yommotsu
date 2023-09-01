<template>
    <div id="createOrder" class="modal wow fadeIn">
        <CreateOrder v-on:Close="closeModal('createOrder')"></CreateOrder>
    </div>
    <div class="container text-center">
        <div class="row my_nav justify-content-evenly">
            <div class="col-3 align-self-center">
                <img :src="logo" alt="Logo" class="logo">
            </div>
            <div class="col-6 align-self-center">
                <p class="date">Чт, 31 августа 13:49</p>       
            </div>
            <div class="col-3 align-self-center">
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
                <tr class="table-value">
                </tr>
                <!-- Здесь будут данные таблицы -->
            </tbody>
        </table>
    </div>
</template>
  
<script>
import CreateOrder from './CreateOrder/Main.vue';

export default {
  components: {
    CreateOrder
  },
  data() {
    return {
      logo: '/img/logo.png',
      orders: [],
    };
  },
  methods: {
    openModal(id) {
        let modal = document.getElementById(id);
        modal.style.display = "block";
    },
    closeModal(id) {
        let modal = document.getElementById(id);
        modal.style.display = "none";
    },
    getTypeOf(value) {
      return typeof value;
    },
  },
}
</script>

<style>
.my_nav{
    height: 15vh;
}

.logo{
    height: 15vh;
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

th, td{
    border: 1px solid #303030;
}
  
</style>