<template>
    <div class="glide">
        <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">
                <slot></slot>
            </ul>
        </div>
    </div>
</template>

<script>
    import Glide from '@glidejs/glide'

    export default{
        props: ['type','perView','autoplay'],
        mounted(){
            new Glide('.glide', {
                autoplay: this.autoplay||8500,
                animationDuration: 1500,
                type: this.type,
                perView: this.perView,
                gap:'10',
            }).mount();
        }
    }
</script>