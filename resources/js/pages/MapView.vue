<script>
    import GoogleMap from '../components/GoogleMap.vue'
    export default{
        components: {GoogleMap},
        data(){
            return {
                mapCenter: {}
            }
        },
        created(){
            axios.get('http://ip-api.com/json').then(({data}) => {
                this.mapCenter['latitude'] = data.lat
                this.mapCenter['longitude'] = data.lon
            })
        }
    }
</script>