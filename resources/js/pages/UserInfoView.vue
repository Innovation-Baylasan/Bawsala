<script>
    import Form from '../Form'
    export default{
        props: ['user'],
        data(){
            return {
                loading: false,
                form: new Form({
                    name: this.user.name,
                    email: this.user.emailse,
                    password: '',
                    password_confirmation: '',
                })
            }
        },
        methods: {
            submit(){
                this.loading = true
                this.form.put('/user-info/update').then(res => {
                    location.reload()
                    this.loading = false
                }).catch(err => this.loading = false)
            }
        }
    }
</script>