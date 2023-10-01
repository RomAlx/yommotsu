<template>
<div class="container">
    <div class="row">
        <div class="col">
            <img :src="logo" alt="Logo" class="logo-main">
        </div>
    </div>
    <div class="tg_wrap">
        <div class="tg_cont text-center">
            <div class="row wow fadeIn">
                <div class="col">
                    <div class="form-card row align-items-center justify-content-center">
                        <div class="col">
                            <h1 class="label">Необходима авторизация</h1>
                            <form @submit.prevent="validateForm" class="form">
                                <input id="name" type="text" class="form-component" placeholder="Логин" v-model="login" :class="{ 'invalid': (v$.login.$dirty && v$.login.required.$invalid && auth) }">
                                <input id="email" type="password" class="form-component" placeholder="Пароль" v-model="password" :class="{ 'invalid': (v$.password.$dirty && v$.password.required.$invalid && auth)}">
                                <div class="row">
                                    <div class="col">
                                        <button type="submit" class="main-button">Продолжить</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
  
<script>
import axios from 'axios';
import useValidate from '@vuelidate/core';
import {required} from '@vuelidate/validators';

export default {
    data() {
        return {
            csrfToken: document.getElementById('pay-terminal').getAttribute('data-csrf-token'),
            logo: '/img/logo.png',
            v$: useValidate(),
            login: '',
            password: '',
            auth: false,
        }
    },
    validations() {
        return {
            login: {required},
            password: {required}
        }
    },
    methods: {
        validateForm() {
            this.v$.$validate();
            if (!this.v$.$error) {
                const params = {
                    project_name: this.login,
                    password: this.password
                };
                
                axios.get('/api/auth/terminal', {
                    headers: {
                        'X-CSRF-TOKEN': this.csrfToken
                    },
                    params: {
                        project_name: this.login,
                        password: this.password
                    }
                }).then(response => {
                    window.blade_data = response.data;
                    console.log(window.blade_data);
                    this.$emit('auth:success')
                })
                .catch(error => {
                    this.auth = true;
                    this.password = '';
                    this.login = '';
                });
            } else {
                console.log(`FAIL TO SUBMIT`);
            }
        },
    }
}
</script>
  
<style scoped>

.logo-main {
  height: 15vh;
}

.label{
  margin: 1rem;
  color: #262626;
  font-family: Montserrat-SemiBold;
  font-size: 1rem;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
}

.main-button {
    margin: 1rem;
    display: flex;
    width: 9rem;
    height: 2.5rem;
    padding: 0.5rem;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    border-radius: 0.625rem;
    background: var(--gray-900, #18181B);
    box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.178);
    color: #FFF;
    font-family: Montserrat-Regular;
    font-size: 0.9rem;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
}

a{
    color:#b82d2d;
}
.row {
    display: flex;
    flex-direction: row;
    justify-content: center;
}

.col {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.form-card{
    margin: 1rem;
    width: 23rem;
    height: 17rem;
    flex-shrink: 0;
    border-radius: 0.9375rem;
    background: rgba( 255, 255, 255, 0.5 );
    box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
}

.form-component{
    margin: 1rem;
    width: 19rem;
    height: 2rem;
    flex-shrink: 0; 
    border-radius: 0.625rem;
    background: #E3E3E3;
    box-shadow: 1px 1px 2px 0px rgba(0, 0, 0, 0.25) inset; 
    font-family: Montserrat-Regular;
    font-size: 1rem;
    font-style: normal;
    font-weight: 600;
    line-height: normal; 
    padding: 1rem;
    display: block;
}

.invalid{
    border: 2px solid rgba(255, 2, 2, 0.493);
}

@media screen and (max-width: 989px) {

    .label{
        margin: 0.8rem;
        font-size: 0.8rem;
    }

    .main-button {
        margin: 0.8rem;
        width: 7.2rem;
        height: 2rem;
        padding: 0.4rem;
        font-size: 0.72rem;
    }

    .form-card{
        margin: 0.8rem;
        width: 18.4rem;
        height: 13.6rem;
    }

    .form-component{
        margin: 0.8rem;
        width: 15.2rem;
        height: 1.6rem;
        font-size: 0.8rem;
        padding: 0.8rem;
    }

    .invalid{
        border: 2px solid rgba(255, 2, 2, 0.493);
    }
}
</style>