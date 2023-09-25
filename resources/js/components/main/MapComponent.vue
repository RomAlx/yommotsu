<template>
    <section class="map wow fadeIn">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="map-label">Наши офиссы</h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div id="map-container">
                        <img id="map-image" :src="srcMapImg"  @click="closeInfo()">
                        <div v-for="marker in markers" :key="marker.id" class="marker" :style="{ left: marker.x + '%', top: marker.y + '%' }" @click="info(marker)"></div>
                        <div v-if="markerInformation.show" class="marker-information justify-content-center" :style="{ left: markerInformation.x + '%', top: markerInformation.y + '%' }">
                            <div class="justify-content-center text-center">
                                <img class='marker-information-flag' :src="this.markerInformation.flag">
                            </div>
                            <h1 class="marker-information-country"> {{ this.markerInformation.town }}</h1>
                            <p class="marker-information-address">{{ this.markerInformation.address }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="screenWidth>996" class="offices" id="contacts">
                <div class="row">
                    <div class="col-3">
                        <h1 class="map-town">Россия, Москва</h1>
                    </div>
                    <div class="col-3">
                        <h1 class="map-town">Россия, Пермь</h1>
                    </div>
                    <div class="col-3">
                        <h1 class="map-town">Thailand, Phuket</h1>
                    </div>
                    <div class="col-3">
                        <h1 class="map-town">Turkey, Antalia</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <p class="map-adress">Башня Федерации | Пресненская набережная, 12</p>
                    </div>
                    <div class="col-3">
                        <p class="map-adress">ул. Тополевый переулок <br>д. 5</p>
                    </div>
                    <div class="col-3">
                        <p class="map-adress">50/27 Soi Anusorn street, Mueang Phuket, Thailand</p>
                    </div>
                    <div class="col-3">
                        <p class="map-adress">Elmali Mahallesi 10. Sokak Hakki Gokceoglu Hani, D:No:8/D</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <p class="map-phone">+7 912 070 11 21</p>
                    </div>
                    <div class="col-3">
                        <p class="map-phone">+7 912 070 11 21</p>
                    </div>
                    <div class="col-3">
                        <p class="map-phone">+66 95 475 7374</p>
                    </div>
                    <div class="col-3">
                        <p class="map-phone">+90 537 392 1806</p>
                    </div>
                </div>
            </div>
            <div v-else class="offices" id="contacts">
                <div class="row align-items-center border-top border-bottom">
                    <div class="col-4">
                        <h1 class="map-town">Россия, Москва</h1>
                    </div>
                    <div class="col-4">
                        <p class="map-adress">Башня Федерации | Пресненская набережная, 12</p>
                    </div>
                    <div class="col-4">
                        <p class="map-phone">+7 912 070 11 21</p>
                    </div>
                </div>
                <div class="row align-items-center border-bottom">
                    <div class="col-4">
                        <h1 class="map-town">Россия, Пермь</h1>
                    </div>
                    <div class="col-4">
                        <p class="map-adress">ул. Тополевый переулок д. 5</p>
                    </div>
                    <div class="col-4">
                        <p class="map-phone">+7 912 070 11 21</p>
                    </div>
                </div>
                <div class="row align-items-center border-bottom">
                    <div class="col-4">
                        <h1 class="map-town">Thailand, Phuket</h1>
                    </div>
                    <div class="col-4">
                        <p class="map-adress">50/27 Soi Anusorn street, Mueang Phuket, Thailand</p>
                    </div>
                    <div class="col-4">
                        <p class="map-phone">+66 95 475 7374</p>
                    </div>
                </div>
                <div class="row align-items-center border-bottom">
                    <div class="col-4">
                        <h1 class="map-town">Turkey, Antalia</h1>
                    </div>
                    <div class="col-4">
                        <p class="map-adress">Elmali Mahallesi 10. Sokak Hakki Gokceoglu Hani, D:No:8/D</p>
                    </div>
                    <div class="col-4">
                        <p class="map-phone">+90 537 392 1806</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
  data() {
    return {
      srcMapImg: '/img/main/map-img.png',
      markers: [
        { id: 1, x: 57.5, y: 28.6, town: 'Россия, Москва', address: 'Башня Федерации | Пресненская набережная, 12', flag:'russia'},
        { id: 2, x: 62.75, y: 26.5, town: 'Россия, Пермь', address: 'ул. Тополевый переулок д. 5', flag:'russia' },
        { id: 3, x: 56.6, y: 42.5, town: 'Turkey, Antalia', address: 'Elmali Mahallesi 10. Sokak Hakki Gokceoglu Hani, D:No:8/D', flag:'turkey', },
        { id: 4, x: 75.6, y: 59.5,  town: 'Thailand, Phuket', address: '50/27 Soi Anusorn street, Mueang Phuket, Thailand', flag:'thailand' }, 
      ],
      markerInformation: {
        show: false,
        x: 57.5,
        y: 28.6,
        town: 'Turkey, Antalia', 
        address: 'Elmali Mahallesi 10. Sokak Hakki Gokceoglu Hani, D:No:8/D', 
        flag:'/img/main/flags/turkey.png' 
      }
    };
  },
  props: {
    screenWidth: {
      type: Number,
      required: true,
    },
  },
  methods:{
    closeInfo() {
        if(this.markerInformation.show){
            this.markerInformation.show = false;
        }
    },
    info(marker) {
        if(this.markerInformation.show){
            this.markerInformation.show = false;
        } else {
            this.markerInformation.x = marker.x;
            this.markerInformation.y = marker.y;
            this.markerInformation.town = marker.town;
            this.markerInformation.address = marker.address;
            this.markerInformation.flag = '/img/main/flags/' + marker.flag + '.png';
            this.markerInformation.show = true;
        }
    }
  }
}

</script>

<style>
.map{
    margin-top: 6rem;
}

.map-label{
    color: #090914;
    text-align: center;
    font-family: Montserrat-SemiBold;
    font-size: 2rem;
    font-style: normal;
    font-weight: 600;
    line-height: 1.875rem;
}

#map-container {
    margin-top: 3rem;
    backdrop-filter: blur( 20px );
    -webkit-backdrop-filter: blur( 20px );
    border: 0.25rem solid rgba( 255, 255, 255, 0.18 );
    position: relative;
    gap: 0.625rem;
    flex-shrink: 0; 
    border: none;
    border-radius: 1rem;
    outline: none;
    
}

#map-image {
  width: 100%;
  height: 100%;
  border-radius: 1rem;
}

.marker { 
    position: absolute; 
    width: 8px; 
    height: 8px;
    transform: 
        translateX(-50%)
        translateY(-100%);  
    background-color: #ff2828e7; 
    border-radius: 50%; 
    -webkit-box-shadow: 0px 0px 20px 10px #FF44447d;
    -moz-box-shadow: 0px 0px 20px 10px #FF44447d;
    box-shadow: 0px 0px 20px 10px #FF44447d;
}

.marker-information { 
    position: absolute; 
    width: 12rem; 
    height: 9.5rem;
    padding: 1rem;
    transform: 
        translateX(-50%)
        translateY(-108%); 
    background: rgba( 237, 237, 237, 0.5 );
    backdrop-filter: blur( 4px );
    -webkit-backdrop-filter: blur( 4px );
    border-radius: 10px;
    border: 1px solid rgba( 255, 255, 255, 0.18 );
}

.marker-information-flag{
    height: 3rem;
}

.marker-information-country{
    color: #090914;
    text-align: center;
    font-family: Montserrat-SemiBold;
    font-size: 0.9rem;
    font-style: normal;
    font-weight: 600;
    line-height: 1.7rem;
}

.marker-information-address{
    color: #090914;
    text-align: center;
    font-family: Montserrat-Regular;
    font-size: 0.6rem;
    font-style: normal;
    font-weight: 600;
    line-height: 0.8rem;
}

.offices{
    margin-top: 2rem;
}

.map-town{
    color: var(--gray-900, #18181B);
    font-family: Montserrat-SemiBold;
    font-size: 1.5rem;
    font-style: normal;
    font-weight: 700;
    line-height: 2.21875rem; /* 147.917% */
    margin-top: 1rem;
    text-align: center;
}

.map-adress{
    color: var(--gray-900, #6F6F6F);
    font-family: Montserrat-Regular;
    font-size: 1rem;
    font-style: normal;
    font-weight: 700;
    line-height: 2.21875rem; /* 147.917% */
    margin-bottom: 1.5rem;
    text-align: center;
}

.map-phone{
    color: var(--gray-900, #FF4444);
    font-family: Montserrat-Regular;
    font-size: 1rem;
    font-style: normal;
    font-weight: 700;
    line-height: 2.21875rem; /* 147.917% */
    text-align: center;
}

@media screen and (max-width: 996px) {

    .map{
        margin-top: 5.4rem;
    }

    .map-label{
        font-size: 1.8rem;
        line-height: 1.665rem;
    }

    .offices{
        margin-top: 1.8rem;
    }

    .map-town{
        font-size: 1.2rem;
        margin-top: 0rem;
    }

    .map-adress{
        font-size: 0.9rem;
        margin-bottom: 0rem;
    }

    .map-phone{
        font-size: 1rem;
    }

    .marker-information { 
        width: 11rem; 
        height: 8rem;
        padding: 0.3rem;
    }

    .marker-information-flag{
        height: 2.5rem;
        margin: 0.2rem;
    }

    .marker-information-country{
        font-size: 0.7rem;
        line-height: 1.2rem;
    }

    .marker-information-address{
        font-size: 0.6rem;
    }

}

@media screen and (max-width: 776px) {

.marker-information { 
    width: 10rem; 
    height: 7rem;
    padding: 0.3rem;
}

.marker-information-flag{
    height: 2.5rem;
    margin: 0.2rem;
}

.marker-information-country{
    font-size: 0.7rem;
    line-height: 1.2rem;
}

.marker-information-address{
    font-size: 0.6rem;
}

}

@media screen and (max-width: 576px) {

.map{
    margin-top: 4.32rem;
}

.map-label{
    font-size: 1.44rem;
}

.offices{
    margin-top: 1.44rem;
}

.map-town{
    font-size: 0.96rem;
    margin-top: 0rem;
}

.map-adress{
    font-size: 0.72rem;
    margin-bottom: 0rem;
}

.map-phone{
    font-size: 0.8rem;
}

.marker-information { 
    width: 10rem; 
    height: 5rem;
    padding: 0.3rem;
}

.marker-information-flag{
    height: 2rem;
    margin: 0.1rem;
}

.marker-information-country{
    font-size: 0.6rem;
    line-height: 0.9rem;
}

.marker-information-address{
    font-size: 0.6rem;
}
}
</style>