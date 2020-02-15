<template>
    <div class="relative">
        <div @click="isOpen = !isOpen">
            <slot name="trigger"></slot>
        </div>
        <div class="absolute" v-if="isOpen">
            <slot>

            </slot>
        </div>
    </div>
</template>
<script>
    export default{
        props: ['img'],
        data(){
            return {
                isOpen: false
            }
        },
        mounted(){
            document.body.addEventListener('click', event => {
                if (!(this.$el == event.target || this.$el.contains(event.target))) {
                    this.isOpen = false
                }
            })
        }
    }
</script>