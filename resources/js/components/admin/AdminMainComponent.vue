<template>
  <AdminHeader :project_name="payload ? payload.project_name : ''"></AdminHeader>
  <AdminSideBar :component="DynamicComponent" v-on:update:Tab="ChangeTab"></AdminSideBar>
</template>

<script>
import { ref, onMounted } from 'vue';
import jwt_decode from 'jwt-decode';

import AdminHeader from './AdminHeaderComponent.vue';
import AdminSideBar from './AdminSideBarComponent.vue';
import AdminStatistic from './AdminStatisticComponent.vue';
import Error from '../LoadPage/LoadPageComponent.vue'


export default {
  components: {
    AdminHeader,
    AdminSideBar,
    Error
  },
  data(){
    return {
      tab: 'statistic',
      DynamicComponent: AdminStatistic,
    }
  },  
  setup() {
    const accessToken = localStorage.getItem('access_token');
    const payload = ref(null);

    const checkAccessToken = () => {
      if (accessToken == null) {
        window.location.href = '/auth';
      } else {
        payload.value = jwt_decode(accessToken);
        console.log(payload.value);
      }
    };

    onMounted(checkAccessToken);

    return {
      payload,
    };
  },
  methods: {
    ChangeTab(tab){
      this.tab = tab;
      switch(tab){
        case 'statistic':
          this.DynamicComponent = AdminStatistic;
          break;
        case 'error':
          this.DynamicComponent = Error;
          break;
      } 
    }
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