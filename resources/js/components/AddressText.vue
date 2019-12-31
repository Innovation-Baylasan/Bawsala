<template>
    <p></p>
</template>
<script>
    export default{
        props: ['place', 'apiKey'],
        mounted(){
            axios.get(`https://maps.googleapis.com/maps/api/geocode/json?latlng=${this.place.latitude},${this.place.longitude}&key=${this.apiKey}`)
                .then(res => console.log(res))
        }
    }
</script>