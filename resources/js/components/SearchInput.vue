<template>
    <div class="shadow mt-4 rounded bg-white">
        <div class="flex justify-between p-2">
            <a href="#" @click="$modal.show('filteringModal')"
               class="p-2  h-8 w-8 flex items-center justify-center">
                <img src="/svg/layer-icon.svg" alt="search what you looking for">
            </a>
            <input class="outline-none text-black px-8"
                   type="text"
                   v-model="query"
                   @input="search"
                   placeholder="Startups">

            <a href="#" class="p-2 w-8 h-8 bg-red-100 rounded flex items-center justify-center">
                <img src="/svg/search-icon.svg" alt="search what you looking for">
            </a>
        </div>
        <div v-if="results && query" class="bg-gray-200">
            <ul>
                <li v-for="entity in results" class="flex border-t border-gray-300 items-center p-3 justify-between">
                    <div class="flex items-center">
                        <img class="w-8 h-8 rounded mr-2" src="https://i.pravatar.cc/300" alt="">
                        <h3 class="text-gray-500" v-text="entity.name"></h3>
                    </div>
                    <img :src="'/svg/'+ entity.category.name + '-icon.svg'" alt="">
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
    export default{
        data(){
            return {
                query: '',
                results: [],
            }
        },

        methods: {
            search(){
                axios.get(`/api/entities?q=${this.query}`).then(({data}) => {
                    this.results = data.data
                })
            }
        }
    }
</script>