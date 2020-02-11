<template>
    <div class="bg-default rounded w-72 h-10/12">
        <div class="text-accent cursor-pointer px-8 font-bold text-center py-2">
            <p class="pb-2" @click="isOpen = ! isOpen">Places & Categries</p>
            <div v-if="isOpen" class="flex bg-accent-light p-1 items-center rounded-sm">
                <img class="w-4 h-4 mx-1" src="/svg/search-icon.svg" alt="">
                <input class="bg-transparent focus:outline-none"
                       placeholder="search here for categories"
                       v-model="q"
                       type="text">
            </div>
        </div>

        <ul v-if="isOpen" class="flex overflow-y-scroll px-4 md:flex-col justify-between">
            <li class="py-2 border-accent-light border-b">
                <a href="#"
                   class="flex items-center p-2  fade"
                   @click.prevent="selectCategory('')">
                    <div class="w-10 h-10 flex items-center justify-center p-1 rounded bg-gray-100bg-red-100 svg-red"
                    >
                        <img src="/svg/map-icon.svg" alt="">
                    </div>
                </a>
            </li>
            <li class="py-2 border-accent-light border-b"
                v-for="(category,index) in filteredCategories"
            >
                <a href="#"
                   class="flex items-center justify-between p-2 fade -mx-3"
                   :key="index"
                >
                    <div class="flex items-center">
                        <div class="w-8 h-8 flex items-center mx-3 justify-center p-1 rounded bg-gray-100"
                        >
                            <img :src="category.icon" alt="">
                        </div>
                        <label :for="category.name" class="capitalize" v-text="category.name"></label>
                    </div>
                    <input :id="category.name" @change="$emit('category-change',selectedCategories)" type="checkbox"
                           v-model="selectedCategories" :value="category.name"
                           class="border"/>
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
    export default{
        props: ['initialCategories'],
        data(){
            return {
                isOpen: false,
                categories: [],
                q: "",
                selectedCategories: [],
            }
        },
        computed: {
            filteredCategories() {
                if (!this.q) return this.categories;
                if (!this.categories || this.categories.length === 0) return [];
                const regexp = new RegExp(this.q);
                return this.categories.filter(category => {
                    return regexp.test(category.name);
                });
            }
        },
        mounted(){
            this.categories = this.initialCategories
            document.body.addEventListener('click', event => {
                if (!(this.$el == event.target || this.$el.contains(event.target))) {
                    this.isOpen = false
                }
            })
        }
    }
</script>
<style>
    .fade {
        transition: all .1s ease-in;
    }

    .svg-red path {
        fill: #f04238;
    }
</style>