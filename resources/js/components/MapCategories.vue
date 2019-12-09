<template>
    <div class="flex flex-col justify-between">
        <a href="#"
           class="flex  items-center justify-center p-2  fade"
           v-for="(category,index) in categories"
           :class="[selectedCategory == category ? 'border-l-2 border-rounded border-red-500':'']"
           :key="index"
           @click.prevent="selectedCategory = category"
        >
            <div :class="{'w-10 h-10 flex items-center justify-center p-1 rounded bg-gray-100': index >= 1 ,   'bg-red-100 svg-red' :  (selectedCategory == category) && index>= 1 }"
                 v-html="icon(category)"></div>
        </a>
    </div>
</template>

<script>
    export default{
        data(){
            return {
                categories: [
                    'map-icon.svg',
                    'startups-icon.svg',
                    'accelerator-icon.svg',
                    'search-icon.svg',
                    'labs-icon.svg',
                    'investors-icon.svg',
                    'research-icon.svg',
                ],
                selectedCategory: ''
            }
        },
        methods: {
            icon(name){
                return require('../../../public/svg/' + name);
            }
        }
    }
</script>
<style>
    .fade {
        transition: border .3s ease-in;
    }

    .svg-red path {
        fill: #f04238;
    }
</style>