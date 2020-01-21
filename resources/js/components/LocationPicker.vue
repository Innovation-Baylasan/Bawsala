<template>
    <div class="overflow-hidden">
        <div class="h-full w-full" ref="map"></div>
    </div>
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
            multiple: Boolean,
            center: Object,
        },

        data() {
            return {
                google: null,
                map: null,
                markers: [],
            }
        },

        mounted() {
            GoogleMapsApiLoader({
                apiKey: this.apiKey
            }).then((response) => {
                this.google = response
                this.initializeMap()
                this.centeringMap()
            })
        },

        watch: {
            center(newCenter){
                this.centeringMap()
            }
        },

        methods: {
            initializeMap() {
                this.map = new this.google.maps.Map(this.$refs.map,
                    {
                        center: {lat: 15.5007, lng: 32.5599},
                        zoom: 12,
                        streetViewControl: false,
                        disableDefaultUI: true
                    }
                )
                this.map.addListener('click', (event) => {
                    this.placeMarker(event.latLng);
                    let inputEvent = new Event('change', {
                        bubbles: true,
                        cancelable: true,
                    });

                    this.$emit('input', {
                        latitude: event.latLng.lat(),
                        longitude: event.latLng.lng()
                    })
                });
                this.map.addListener('center_changed', () => this.$emit('centerChanged', this.map.center))
            },

            placeMarker(latLang) {
                if (this.google) {
                    let marker = new this.google.maps.Marker({
                        position: latLang,
                        map: this.map,
                    });

                    this.multiple ? '' : this.removeMarkers()
                    this.markers.push(marker)
                    this.$emit('marker-placed', {
                        marker: marker,
                        location: {
                            latitude: marker.position.lat(),
                            longitude: marker.position.lng()
                        }
                    })
                }
            },
            removeMarkers(){
                this.markers.forEach(marker => {
                    marker.setMap(null)
                    this.markers.slice(this.markers.indexOf(marker), 1);
                })
            },
            centeringMap () {
                if (this.center.latitude && this.map) {
                    this.map.panTo(new this.google.maps.LatLng(this.center.latitude, this.center.longitude));
                }
            },
        },
    }
</script>