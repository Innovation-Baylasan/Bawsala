<script>
    import GoogleMap from '../components/GoogleMap.vue'
    import PlaceProfileCard from '../components/PlaceProfileCard.vue'
    import EventCard from '../components/EventCard.vue'
    export default{
        components: {GoogleMap, PlaceProfileCard, EventCard},
        data(){
            return {
                places: [],
                selectedPlace: null,
                selectedEvent: null,
                selectedCategory: null,
                mapCenter: {},
                showing: 'places',
                endpoints: {
                    places: '/api/entities',
                    events: '/api/events',
                },
            }
        },
        watch: {
            showing(){
                this.getPlaces()
            }
        },
        computed: {
            endpoint(){
                return this.endpoints[this.showing]
            }
        },
        methods: {
            getPlaces(category = null){
                this.selectedCategory = category
                axios.get(this.endpoint + (category ? '?category=' + category : '' ))
                    .then(({data}) => this.places = data.data)
            },
            getCenter(){
                return axios.get('http://ip-api.com/json').then(({data}) => {
                    this.mapCenter = {
                        latitude: data.lat,
                        longitude: data.lon,
                    }
                })
            },
            selectPlace(place){
                let lookup = {places: 'Place', events: 'Event'}
                this['selected' + lookup[this.showing]] = place
                this.mapCenter = {}
                this.mapCenter.latitude = place.location.lat
                this.mapCenter.longitude = place.location.long
            }
        },
        created(){
            this.getPlaces()
            this.getCenter()
        }
    }
</script>