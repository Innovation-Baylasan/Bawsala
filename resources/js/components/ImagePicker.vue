<template>
    <div class="">
        <div @click="$refs.file.click()"
             class="h-full w-full absolute cursor-pointer opacity-0 bg-black hover:opacity-50"></div>
        <img class="h-full" :src="getImage()" alt="">
        <input accept="image/*" ref="file" class="invisible absolute" @change="setImage" type="file" name="name">
    </div>
</template>
<script>
    export default{
        props: ['defaultImage', 'name'],

        data(){
            return {
                image: null
            }
        },
        methods: {
            getImage(){
                return this.image ? this.image : this.defaultImage
            },
            setImage(event){
                let reader = new FileReader();

                reader.onload = (e) => this.image = e.target.result

                reader.readAsDataURL(event.target.files[0]);
            }
        }
    }
</script>