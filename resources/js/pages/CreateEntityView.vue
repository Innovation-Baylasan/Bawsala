<script>
    export default{
        data(){
            return {
                cropRatio: 1,
                entity: {
                    cover: '',
                    avatar: '',
                    description: '',
                    name: '',
                    category_id: '',
                    latitude: '',
                    longitude: '',
                },
                imageToCrop: null,
                cropping: '',
                loading: false,
            }
        },
        watch: {
            imageToCrop(){
                this.$modal.show('cropImageModal')
            }
        },

        methods: {
            setLocation(event){
                this.entity.latitude = event.location.latitude
                this.entity.longitude = event.location.longitude
            },
            setImageToCrop(cropping, event, cropRatio = 2.39){
                this.cropRatio = cropRatio
                this.cropping = cropping
                let reader = new FileReader();
                reader.onload = (e) => this.imageToCrop = e.target.result
                reader.readAsDataURL(event.target.files[0])
            },
            setImage(event){
                this.entity[this.cropping] = event.croppedCanvas.toDataURL();
                this.$modal.hide('cropImageModal')
            },
            save(){
                this.loading = true;
                let data = new FormData();

                for (let key in this.entity) {
                    if (this.entity[key]) {
                        data.append(key, this.entity[key]);
                    }
                }
                axios.post('/admin/entities', data, {
                    headers: {'content-type': 'multipart/form-data'}
                }).then(res => {
                    console.log(res)
                    this.loading = false
                    location.replace('/admin/entities')
                })
                    .catch(err => {
                        this.loading = false
                        console.log(err)
                    })
            }
        },
    }
</script>