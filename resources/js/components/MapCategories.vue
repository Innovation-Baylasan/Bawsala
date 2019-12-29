<template>
    <div class="flex flex-col justify-between">
        <a href="#"
           class="flex  items-center justify-center p-2  fade"
           v-for="(category,index) in categories"
           :class="[selectedCategory == category ? 'active':'']"
           :key="index"
           @click.prevent="selectCategory(category)"
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
                    'map',
                    'startups',
                    'accelerator',
                    'labs',
                    'investors',
                    'research-centers',
                ],
                selectedCategory: 'map'
            }
        },
        methods: {
            selectCategory(category){
                this.selectedCategory = category
                this.$emit('category-change', category)
            },

            icon(name){
                return require('../../../public/svg/' + name + '-icon.svg');
            }
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