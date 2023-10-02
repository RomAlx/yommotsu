<template>
    <div class="modal-content wow fadeIn">
        <span class="close" @click="closeModal">&times;</span>
        <div class="row">
            <div class="col">
                <div class="row align-items-center justify-content-center">
                    <div class="col">
                        <h1 class="label">Ссылка для оплаты</h1>
                        <p class="payment-url"><a @click="openNewWindow($event)">Ссылка</a></p>
                        <img class="payment-qrcode" :src="this.qrCodeData" alt="QR Code" />
                        <div class="row">
                            <div class="col">
                                <button type="button" class="main-button" @click="closeModal">Готово</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
import QRCode from 'qrcode-generator';

export default {
    data() {
        return {
            url: '',
            qrCodeData: '',
        }
    },
    props: {
        order: {
            type: Object,
            required: true,
        },
    },
    mounted(){
        this.generateUrl();
    },
    watch: {
        order: {
            handler: function(newOrder) {
            this.generateUrl();
            },
            deep: true
        }
    },
    methods: {
        generateUrl(){
            this.url = 'https://yommotsu.com/pay?project_name='+window.blade_data.project_name+'&order_id='+this.order.order_id+'&amount='+this.order.amount+'&redirect_url=google.com';
            const qr = QRCode(0, 'L');
            qr.addData(this.url);
            qr.make();
            const cellSize = 10; // Размер ячейки (пиксели)
            const margin = 4; // Отступ от границы (пиксели)
            const colorDark = '#b82d2d'; // Цвет темных ячеек
            const colorLight = '#ffffff'; // Цвет светлых ячеек
            this.qrCodeData = qr.createDataURL(cellSize, margin, colorDark, colorLight);
        },
        closeModal(){
            this.$emit('Close');
        },

        openNewWindow(event) {
            event.preventDefault();
            window.open(this.url, "_blank");
        }
  }
};
</script>

<style scoped>
.modal-content{
    width: 50vh;
}
a{
  color:#b82d2d;
}

.payment-qrcode{
  margin: 1rem;
  width: 16rem;
  flex-shrink: 0;
  border-radius: 1.25rem;
  background: rgba(255, 255, 255, 0.5);
  box-shadow: 0 4px 4px 0 rgba( 31, 38, 135, 0.37 );
  backdrop-filter: blur( 20px );
  -webkit-backdrop-filter: blur( 20px );
  border-radius: 10px;
  border: 0.25rem solid rgba( 255, 255, 255, 0.18 );
}

.main-button {
    display: flex;
    width: 9rem;
    height: 2.7rem;
    padding: 0.5rem;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    border-radius: 0.625rem;
    background: var(--gray-900, #18181B);
    box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.178);
    color: #FFF;
    font-family: Montserrat-Regular;
    font-size: 1rem;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
}

@media screen and (max-width: 989px) {
    .payment-qrcode{
        margin: 0.8rem;
        width: 12.8rem;
        border-radius: 1rem;
    }

    .main-button {
        width: 7.2rem;
        height: 2.16rem;
        padding: 0.4rem;
        font-size: 0.8rem;
    }
}

@media screen and (max-width: 445px) {
    .payment-qrcode{
        margin: 0.64rem;
        width: 11rem;
        border-radius: 0.8rem;
    }

    .main-button {
        width: 5.76rem;
        height: 1.72rem;
        padding: 0.32rem;
        font-size: 0.64rem;
    }
}
</style>