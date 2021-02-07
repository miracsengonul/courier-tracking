<template>

    <div style="position: absolute; top: 0; right: 0; bottom: 0; left: 0" :key="key">
        <div style="text-align: center;background-color: black;padding:5px">
            <img src="images/dominos.png" class="img-responsive" style="width:90%">
        </div>
        <!-- TODO Eğer konum için verilirse gösterilecek !-->
        <template>
            <div style="margin-bottom:-15px;overflow: auto;display:flex;overflow: none">
               <div @click="teslimatAdresim" class="alert alert-danger button">Teslimat Adresim</div>
               <div @click="kuryeOdaklan" class="alert alert-danger red-button">Kuryeye Odaklan</div>
            </div>
            <div v-if="estimatedMinutesRemaining !== '' && estimatedMinutesRemaining > 60" style="overflow: auto;display:flex;overflow: none;font-size: 15px;justify-content: center;padding:5px;text-align:center">
               Tahmini Teslimat Süresi İçin Sayfayı Yenileyip, Konum İçin İzin Veriniz.
            </div>
            <div v-else-if="estimatedMinutesRemaining !== ''" class="container" style="overflow: auto;display:flex;overflow: none;font-size: 15px;justify-content: center;padding:5px">
                <img width="16" src="images/icon/hourglass.png" alt="">
                Tahmini Ulaşma Süresi : <span style="margin-left:5px;font-weight: bold"> {{estimatedMinutesRemaining}} Dk</span>
            </div>
            <l-map
                v-if="showMap"
                :zoom="zoom"
                :center="center"
            >

                <l-marker :lat-lng="customerCoordinate" v-if="customerCoordinate" :icon="this.icon">
                    <l-tooltip :options="{ permanent: true, interactive: true }">
                        <div>
                            Sizin Adresiniz
                        </div>
                    </l-tooltip>
                </l-marker>


                <l-tile-layer
                    :url="url"
                    :attribution="attribution"
                />


                <l-marker :lat-lng="withPopup" :icon="this.courierIcon"/>
                <l-circle
                    :lat-lng="circle.center"
                    :radius="circle.radius"
                    :color="circle.color"
                    :fillColor="circle.fillColor"
                />

            </l-map>
        </template>

    </div>
</template>

<script>
import { latLng, icon  } from "leaflet";
import { LMap, LTileLayer, LMarker, LCircle, LTooltip, LIcon } from "vue2-leaflet";
import LatLon from 'geodesy/latlon-spherical.js';

export default {
    components: {
        LMap,
        LTileLayer,
        LMarker,
        LCircle,
        LTooltip,
        LatLon,
        LIcon
    },
    props: ['courierNumber'],
    data() {
        return {
            lat: '',
            long: '',
            coordinate: null,
            zoom: 11,
            center: latLng(38.351609545028786, 38.29612034427869),
            circle: {
                center: [38.351609545028786, 38.29612034427869],
                radius: 50,
                color: 'red',
                fillColor: '#F60202',
                fillOpacity: 0.5,
            },
            url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            attribution:
                '&copy; kurye.live',
            withPopup: latLng(38.351609545028786, 38.29612034427869),
            currentZoom: 11,
            currentCenter: latLng(38.351609545028786, 38.29612034427869),
            showParagraph: false,
            mapOptions: {
                zoomSnap: 0.5
            },
            showMap: false,
            key: 1,
            customerLat: '',
            customerLong: '',
            customerCoordinate: '',
            teslimatClick: false,
            pusherCourierNumber: null,
            estimatedMinutesRemaining: '',
            icon: icon({
                iconUrl: 'images/icon/house.png',
                iconSize:[48, 48],
            }),
            courierIcon: icon({
                iconUrl: 'images/icon/scooter-marker.png',
                iconSize:[48, 48],
            }),
            isAllowLocation: false
        };

    },
    mounted(){

        if(this.courierNumber === this.pusherCourierNumber){
            this.showMap = true;
        }
        Echo.channel('location')
            .listen('SendPosition', (e) => {
                this.pusherCourierNumber = e.location.courier;
                this.lat = e.location.long;
                this.long = e.location.lat;
                this.coordinate = e.location.long;

                this.withPopup = latLng(e.location.lat, e.location.long);
                this.currentCenter = latLng(e.location.lat, e.location.long);
                this.circle.center = latLng(e.location.lat, e.location.long);

                if(this.teslimatClick === false){
                    this.center = latLng(e.location.lat, e.location.long);
                    this.currentZoom = 17;
                    this.zoom = 17;
                }

            });
    },
    methods: {
      teslimatAdresim(){
          if(navigator.geolocation && !this.isAllowLocation) {
              var self = this;
              navigator.geolocation.getCurrentPosition(function(position) {
                      var positionInfo = position.coords.latitude + ", " + position.coords.longitude;
                      self.customerLat = position.coords.latitude;
                      self.customerLong = position.coords.longitude;
                      self.customerCoordinate = latLng(position.coords.latitude, position.coords.longitude);
                      self.center = self.customerCoordinate;
                      self.isAllowLocation = true;
                  },
                  function(error) {
                      if (error.code == error.PERMISSION_DENIED){
                          console.log("denied");
                          self.customerCoordinate = '';
                      }
                  });
          } else if(!navigator.geolocation){
              alert("Üzgünüz, kullandığınız tarayıcı konum iznini desteklemiyor.");
          }

          this.teslimatClick = true;
          this.zoom = 14;
          this.coordinate = this.customerCoordinate;
          if(this.coordinate){
              this.center = this.customerCoordinate;
          }
      },
      kuryeOdaklan(){
          this.teslimatClick = false;
          this.zoom = 17;
          this.center = this.currentCenter;
          this.coordinate = this.currentCenter;
      }
    },
    watch: {
        coordinate(){
            this.key += 1;
            if(this.courierNumber === this.pusherCourierNumber){
                this.showMap = true;
                if(this.courierNumber === this.pusherCourierNumber){
                    this.showMap = true;

                    const p1 = new LatLon(this.long, this.lat);
                    console.log(p1);
                    const p2 = new LatLon(this.customerLat, this.customerLong);
                    console.log(p2);
                    const d = p1.distanceTo(p2);
                    const km = d.toFixed(2);

                    //iki kordinat arası uzaklık. Google verilerine daha yakın olsun diye 1.261096606 çarptık.

                    const distance = (Math.round(km).toFixed(1)/1000)*1.261096606;

                    let speed = 22; //km speed
                    if(parseFloat(distance) > 10){
                        speed = 55; //km speed
                    }
                    else if(parseFloat(distance) > 5){
                        speed = 30; //km speed
                    }

                    const time = (distance / speed) * 60;
                    //noktalı 3.20 saniye yerine sadece 3 dakikayı almış oldum bu aşağıdaki işlemle.
                    let minute = time.toString().split('.')[0];

                    if(minute < 1){
                        minute = 1;
                    }
                    this.estimatedMinutesRemaining = minute;
                }
            }
        }
    },
};
</script>
<style>
.button{
    border-top-left-radius: 0px;
    cursor: pointer;
    margin-top:-1px;
    text-align: center;
    font-weight: bold;
    width: 100%;
    background-color:#008fff;
    color:#fff;
}
.button:active{
    background-color:purple;
}
.red-button{
    border-top-right-radius: 0px;
    margin-right: -1px;
    cursor: pointer;
    margin-top:-1px;
    background-color:#CE4A4A;
    text-align: center;
    font-weight: bold;
    width: 100%;
    color:#fff;
}
.red-button:active{
    background-color:#A20202;
}
.success-button{
    border-top-right-radius: 0px;
    margin-right: -1px;
    cursor: pointer;
    margin-top:-1px;
    background-color: #C3D700;
    text-align: center;
    font-weight: bold;
    width: 100%;
    color:black;
}
</style>
