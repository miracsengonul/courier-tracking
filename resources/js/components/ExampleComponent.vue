<template>
    <div  :key="key">
        <iframe
            frameborder="0" style="border:0;width:100%;"
            :height="windowHeight"
            :src="`https://www.google.com/maps/embed/v1/place?key=AIzaSyBZtAsP-pW5jxPz0y6SaBmNHdU9vRKJNx4
    &q=${lat}, ${long}&zoom=18`">
        </iframe>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                windowHeight: window.innerHeight,
                lat: null,
                long: null,
                coordinate: '',
                key: 1,
            }
        },
        mounted() {
            console.log(this.coordinate)
        },
        created(){
            Echo.channel('location')
                .listen('SendPosition', (e) => {
                    this.lat = e.location.long;
                    this.long = e.location.lat;
                    this.coordinate = this.lat+','+this.long;
                    console.log(this.coordinate);
                });
        },
        watch: {
            windowHeight() {
                this.windowHeight = window.innerHeight;
            },
            coordinate(){
                this.key += 1;
            }
        },
    }

</script>
