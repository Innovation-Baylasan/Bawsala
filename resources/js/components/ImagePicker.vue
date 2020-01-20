<template>
    <div class="">
        <div @click="$refs.file.click()"
             class="h-full w-full absolute fade cursor-pointer opacity-0 bg-black hover:opacity-50 flex items-center justify-center">
            <img src="/svg/cam-icon.svg" alt="">
        </div>
        <img class="h-full w-full inline-block" :src="this.src" alt="">
        <input accept="image/*" ref="file" class="invisible absolute" @change="setImage" type="file" :name="name">
    </div>
</template>
<script>
    export default{
        props: ['src', 'name'],


        methods: {
            setImage(event){
                this.$emit('image-changed', event);
            }
        },
    }
</script>