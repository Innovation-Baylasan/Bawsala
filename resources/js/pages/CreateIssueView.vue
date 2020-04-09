<script>
    import Form from '../Form'
    export default{
        data(){
            return {
                issue: new Form({
                    title: '',
                    description: '',
                }),
                isLoading: false,
            }
        },
        methods: {

            save(){
                this.isLoading = true
                this.issue.post('/issues').then(({data}) => {
                    this.$modal.hide('report-issue')
                    flash(data.message)
                }).catch(err => {
                    this.isLoading = false
                    flash('Something goes wrong', 'danger')
                })
            }
        }
    }
</script>