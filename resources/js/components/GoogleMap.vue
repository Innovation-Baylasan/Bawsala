<template>
    <div class="w-full h-screen"></div>
</template>

<script>
    import GoogleMapsApiLoader from 'google-maps-api-loader'
    import MapClusterer from '@google/markerclusterer'

    export default {
        props: {
            mapConfig: {
                type: Object,
                default: function () {
                    return {};
                }
            },

            places: Array,
            apiKey: String,
            center: Object,
        },

        data() {
            return {
                google: null,
                map: null,
                clusterer: null,
                markers: [],
            }
        },
        watch: {
            places(){
                if (this.google) {
                    this.removeMarkers()
                    this.setMarkers()
                }
            },
            center(newCenter){
                this.centeringMap()
            }
        },
        methods: {
            initializeMap() {
                this.map = new this.google.maps.Map(this.$el,
                    {
                        center: {lat: 15.5007, lng: 32.5599},
                        zoom: 12,
                        streetViewControl: false,
                        disableDefaultUI: true
                    }
                )
                this.map.addListener('center_changed', () => this.$emit('centerChanged', this.map.center))
                this.clusterer = new MapClusterer(this.map, this.markers)

            },
            addMarker(place) {
                if (this.google) {
                    let marker = new this.google.maps.Marker({
                        position: new this.google.maps.LatLng(place.location.lat, place.location.long),
                        map: this.map,
                        icon: {
                            url: (place.category ? `/svg/markers/${place.category.name}-marker-icon.svg` : '/svg/event-icon.svg'),
                            scaledSize: new google.maps.Size(35, 35),
                            origin: new google.maps.Point(0, 0),
                            anchor: new google.maps.Point(0, 0)
                        }
                    });
                    this.google.maps.event.addListener(marker, 'click', () => {
                        this.$emit('marker-clicked', {place, marker})
                    });
                    this.clusterer.addMarker(marker)
                    this.markers.push(marker)
                }
            },
            setMarkers(){
                this.places.forEach((place) => {
                    this.addMarker(place)
                })
            },
            removeMarkers(){
                this.markers.forEach(marker => {
                    marker.setMap(null)
                    this.clusterer.removeMarker(marker)
                    this.markers.slice(this.markers.indexOf(marker), 1);
                })
            },
            centeringMap () {
                if (this.center.latitude && this.map) {
                    this.map.panTo(new this.google.maps.LatLng(this.center.latitude, this.center.longitude));
                }
            },
        },
        created() {
            GoogleMapsApiLoader({
                apiKey: this.apiKey
            }).then((response) => {
                window.google = response
                this.google = response
                this.initializeMap()
                this.centeringMap()
                this.setMarkers()
            })
        },
    }
</script>