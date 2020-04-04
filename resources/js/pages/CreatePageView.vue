<script>
    import Form from '../Form'
    export default{
        props: ['identifier', 'initialSetting'],
        data(){
            return {
                page: {},
                isLoading: false,
            }
        },
        methods: {
            save(){
                this.isLoading = true
                this.page.post('/admin/settings').then(({data}) => {
                    flash(data.message)
                }).catch(err => {
                    this.isLoading = false
                    flash('Something goes wrong', 'danger')
                })
            }
        },

        mounted(){
            this.page = new Form(this.initialSetting)
        }
    }
</script>