<template>
    <div class="glide__slide flex flex-col items-center justify-center">
        <div :class="classes">
            <slot></slot>
        </div>
        <slot name="footer"></slot>
    </div>
</template>
<script>
    export default{
        props: ['classes'],
    }
</script>