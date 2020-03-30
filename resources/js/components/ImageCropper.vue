<template>
    <div>
        <img ref="image" :src="src" alt="">
        <div class="flex justify-end p-2">
            <button :class="{'is-loading' : loading}"
                    @click="crop"
                    class="button is-green">Apply
            </button>
        </div>
    </div>
</template>
<script>
    import Cropper from 'cropperjs'
    export default{
        props: ['src', 'cropRatio'],
        data(){
            return {
                loading: false,
                cropper: null,
            }
        },
        methods: {
            crop(){
                this.loading = true
                console.log(this.loading)
                this.$emit('cropped', this.setData())
            },
            setData(){
                return {
                    cropper: this.cropper,
                    croppedCanvas: this.cropper.getCroppedCanvas({maxWidth: 4096, maxHeight: 4096})
                }
            }
        },
        mounted(){
            this.cropper = new Cropper(this.$refs.image, {
                aspectRatio: this.cropRatio || 16 / 9,
                viewMode: 3,
            });
        }
    }
</script>