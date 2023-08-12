<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>I'm an example component. Hello {{ username }}</h1>
            </div>
        </div>
    </div>
</template>

<script>
    import {defineComponent} from 'vue';
    
    export default defineComponent({
        components: {},
        setup() {
            return {
                username: 'Jopa'
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    });
</script>

<style scoped>
</style>
