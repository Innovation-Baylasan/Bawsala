<template>
    <div>
        <img ref="image" :src="src" alt="">
        <div class="flex justify-end p-2">
            <button @click="crop" class="button">Apply</button>
        </div>
    </div>
</template>
<script>
    import 'cropperjs/dist/cropper.css';
    import Cropper from 'cropperjs'
    export default{
        props: ['src', 'cropRatio'],
        data(){
            return {
                cropper: null,
            }
        },
        methods: {
            crop(){
                this.$emit('cropped', {
                    cropper: this.cropper,
                    croppedCanvas: this.cropper.getCroppedCanvas({maxWidth: 4096, maxHeight: 4096})
                })
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