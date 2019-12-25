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
                map: null
            }
        },

        mounted() {
            GoogleMapsApiLoader({
                apiKey: this.apiKey
            }).then((response) => {
                this.google = response
                this.initializeMap()
                this.ipLookUp()
            })
        },

        methods: {
            initializeMap() {
                this.map = new this.google.maps.Map(this.$el,
                    {
                        center: {lat: 0.5007, lng:0.5599},
                        zoom: 16
                    }
                )
            },
            ipLookUp () {
                return axios.get('http://ip-api.com/json').then(({data}) => {
                    this.map.setCenter(new this.google.maps.LatLng(data.lat, data.lon));
                })
            },
        }
    }
</script>