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
        mounted(){
            new Glide('.glide', {
                autoplay: 8500,
                animationDuration: 1500,
            }).mount();
        }
    }
</script>