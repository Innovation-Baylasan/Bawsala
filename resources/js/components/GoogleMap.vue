<template>
    <div class="w-full h-screen"></div>
</template>

<script>
    import GoogleMapsApiLoader from 'google-maps-api-loader'

    export default {
        props: {
            mapConfig: {
                type: Object,
                default: function () {
                    return {};
                }
            },
            apiKey: String,
        },

        data() {
            return {
                google: null,
                map: null,
                center: {},
                places: {},
                markers: [],
            }
        },

        mounted() {
            GoogleMapsApiLoader({
                apiKey: this.apiKey
            }).then((response) => {
                this.google = response
                this.initializeMap()
                this.setMarkers()
            })
        },

        methods: {
            initializeMap() {
                this.map = new this.google.maps.Map(this.$el,
                    {
                        center: {lat: 32.23232, lng: 18.5599},
                        zoom: 12
                    }
                )
            },
            addMarker(latitude, longitude) {
                let marker = new this.google.maps.Marker({
                    position: new this.google.maps.LatLng(latitude, longitude),
                    map: this.map,
                    icon: '/svg/startups-icon.svg'
                });
                this.markers.push(marker)
            },
            setMarkers(){
                this.ipLookUp().then(() => {
                    this.getPlaces().then(() => {
                        this.places.forEach((place) => {
                            this.addMarker(place.location.lat, place.location.long)
                        })
                    })
                })
            },
            removeMarkers(){
                this.markers.forEach(marker => {
                    marker.setMap(null)
                    this.markers.slice(this.markers.indexOf(marker), 1);
                })
            },
            getPlaces(){
                return axios.get(`/api/entities?@long=${this.center.longitude}&&lat=${this.center.latitude}`)
                    .then(({data}) => {
                        this.places = data.data
                    })
            },
            ipLookUp () {
                return axios.get('http://ip-api.com/json').then(({data}) => {
                    this.map.setCenter(new this.google.maps.LatLng(data.lat, data.lon));
                    this.center.longitude = data.lon
                    this.center.latitude = data.lat
                })
            },
        }
    }
</script>