<script>
    import Form from '../Form'
    export default{
        data(){
            return {
                cropRatio: 1,
                entity: new Form({
                    cover: '',
                    avatar: '',
                    description: '',
                    details: '',
                    name: '',
                    category_id: '',
                    latitude: '',
                    longitude: '',
                    tags: [],
                }),
                tags: [],
                imageToCrop: null,
                cropping: '',
                loading: false,
            }
        },

        methods: {
            getTags(query = null){
                let endpoint = '/api/tags'
                if (query) {
                    endpoint = endpoint + '?q= ' + query
                }
                axios.get(endpoint)
                    .then(({data}) => {
                        this.tags = data.data
                    });
            },
            setLocation(event){
                this.entity.latitude = event.location.latitude
                this.entity.longitude = event.location.longitude
            },
            setImageToCrop(cropping, event, cropRatio = 2.39){
                this.cropRatio = cropRatio
                this.cropping = cropping
                let reader = new FileReader();
                reader.onload = (e) => {
                    this.imageToCrop = e.target.result
                    this.$modal.show('cropImageModal')
                }
                reader.readAsDataURL(event.target.files[0])
            },
            setImage(event){
                this.entity[this.cropping] = event.croppedCanvas.toDataURL('image/jpeg', 0.5);
                this.$modal.hide('cropImageModal')
            },
            reduceTags(option){
                if (typeof option == 'object') {
                    return option.label
                }
                return option
            },
            save(){
                let endpoint = '/entities'
                this.loading = true;
                this.entity.post(endpoint).then(res => {
                    location.replace('/')
                }).catch(e => this.loading = false)
            }
        },

        mounted(){
            this.getTags()
        }
    }
</script>