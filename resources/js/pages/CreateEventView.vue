<script>
    import Form from '../Form'
    export default{
        data(){
            return {
                event: new Form({
                    name: '',
                    link: '',
                    entity_id: '',
                    start_date: '',
                    end_date: '',
                    description: '',
                    latitude: '',
                    longitude: '',
                }),
                isLoading: false,
            }
        },
        methods: {
            setLocation(event){
                this.event.latitude = event.location.latitude
                this.event.longitude = event.location.longitude
            },

            save(){
                this.isLoading = true
                this.event.post('/events').then(({data}) => {
                    this.$modal.hide('add-event')
                    flash(data.message)
                }).catch(err => {
                    this.isLoading = false
                    flash('Something goes wrong', 'danger')
                })
            }
        }
    }
</script>