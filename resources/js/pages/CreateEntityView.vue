<script>
    export default{
        data(){
            return {
                location: {
                    latitude: '',
                    longitude: '',
                }
            }
        },

        methods: {
            setLocation(event){
                this.location.latitude = event.location.latitude
                this.location.longitude = event.location.longitude
            }
        }
    }
</script>