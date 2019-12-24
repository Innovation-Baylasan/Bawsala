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
            })
        },

        methods: {
            initializeMap() {
                this.map = new this.google.maps.Map(this.$el,
                    {
                        center: {lat: 15.5007, lng: 32.5599},
                        zoom: 16
                    }
                )
            }
        }
    }
</script>