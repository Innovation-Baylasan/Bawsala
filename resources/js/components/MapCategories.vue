<template>
    <div class="flex flex-col justify-between">
        <a href="#"
           class="flex  items-center justify-center p-2  fade"
           :class="[selectedCategory == '' ?  'active':'']"
           @click.prevent="selectCategory('')"
        >
            <div class="w-10 h-10 flex items-center justify-center p-1 rounded bg-gray-100bg-red-100 svg-red"
            >
                <img src="/svg/map-icon.svg" alt="">
            </div>
        </a>
        <a href="#"
           class="flex items-center justify-center p-2 fade"
           v-for="(category,index) in categories"
           :class="[selectedCategory == category.name ? 'active':'']"
           :key="index"
           @click.prevent="selectCategory(category.name)"
        >
            <div class="w-10 h-10 flex items-center justify-center p-1 rounded bg-gray-100"
                 :class="{'bg-red-100 svg-red' :  (selectedCategory == category)}"
            >
                <img :src="category.icon" alt="">
            </div>
        </a>
    </div>
</template>

<script>
    export default{
        props: ['categories'],
        data(){
            return {
                selectedCategory: '',
            }
        },
        methods: {
            selectCategory(category){
                this.selectedCategory = category
                this.$emit('category-change', category)
            },
        }
    }
</script>
<style>
    .fade {
        transition: all .3s ease-in;
    }

    .svg-red path {
        fill: #f04238;
    }
</style>