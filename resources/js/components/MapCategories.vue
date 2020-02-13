<template>
    <div class="bg-default shadow rounded w-72">
        <div class="text-accent cursor-pointer px-8 font-bold text-center py-3">
            <p class="" @click="isOpen = ! isOpen">Places & Categries</p>
            <div v-if="isOpen" class="flex bg-accent-lighter p-1 items-center rounded-sm">
                <img class="w-4 h-4 mx-1" src="/svg/search-icon.svg" alt="">
                <input class="bg-transparent focus:outline-none"
                       placeholder="search here for categories"
                       v-model="q"
                       type="text">
            </div>
        </div>

        <ul v-if="isOpen" class="flex overflow-auto max-h-72 px-4 flex-col">
            <li class="py-2 border-accent-light border-b"
                v-for="(category,index) in filteredCategories"
            >
                <a href="#"
                   class="flex items-center justify-between p-2 fade -mx-3"
                   :key="index"
                >
                    <div class="flex items-center">
                        <div class="w-8 h-8 flex items-center mx-3 justify-center p-1"
                        >
                            <img :src="category.icon" alt="">
                        </div>
                        <label :for="category.name" class="capitalize" v-text="category.name"></label>
                    </div>
                    <input :id="category.name"
                           class="checkbox border"
                           @change="$emit('category-change',selectedCategories)"
                           type="checkbox"
                           v-model="selectedCategories"
                           :value="category.name"/>
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