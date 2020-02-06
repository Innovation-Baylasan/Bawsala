<script>
    import Form from '../Form'
    export default{
        props: ['initialEntity'],
        data(){
            return {
                cropRatio: 1,
                entity: new Form(
                    {
                        cover: '',
                        avatar: '',
                        description: '',
                        details: '',
                        name: '',
                        category_id: '',
                        latitude: '',
                        longitude: '',
                        tags: [],
                    }
                ),
                tags: [],
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
                reader.onload = (e) => this.imageToCrop = e.target.result
                reader.readAsDataURL(event.target.files[0])
            },
            setImage(event){
                this.entity[this.cropping] = event.croppedCanvas.toDataURL();
                this.$modal.hide('cropImageModal')
            },
            reduceTags(option){
                if (typeof option == 'object') {
                    return option.label
                }
                return option
            },
            save(){
                this.loading = true;
                let endpoint = '/admin/entities';
                this.entity.put(endpoint + '/' + this.entity.id).then(res => location.replace(endpoint))
            }
        },

        mounted(){
            this.entity = new Form(this.initialEntity)
            this.getTags()
            this.entity.tags.map((tag) => {
                if (typeof tag == 'object') {
                    this.entity.tags[this.entity.tags.indexOf(tag)] = tag.label
                }
                return tag
            })
        }
    }
</script>