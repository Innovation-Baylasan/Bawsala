<template>
    <div class="shadow rounded bg-white w-96" v-cloak>
        <div class="flex p-2">
            <a href="#" class="p-2 w-8 h-8 bg-accent-light rounded flex items-center justify-center">
                <img src="/svg/search-icon.svg" alt="search what you looking for">
            </a>

            <input class="outline-none flex-1 text-black md:px-8"
                   type="text"
                   v-model="query"
                   @input="search"
                   :placeholder="placeholder">

        </div>
        <div v-if="results && query" class="bg-gray-200">
            <ul>
                <li v-for="place in results"
                    class="flex border-t cursor-pointer border-gray-300 items-center p-3 justify-between">
                    <div class="flex items-start">
                        <img @click="selectResult(place)" class="w-8 h-8 rounded mr-2"
                             :src="place.avatar" alt="">
                        <div>
                            <h3 class="text-black font-semibold text-sm" @click="selectResult(place)"
                                v-text="place.name"></h3>
                            <span v-text="place.rating" class="text-gray-500"></span>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div v-if="!results.length && searching" class="bg-gray-200">
            <ul>
                <li class="flex border-t text-gray-500 cursor-pointer border-gray-300 items-center p-3 justify-between">
                    it seems like there is no results for now
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
    import StarRating from './StarRating.vue'
    export default{
        props: ['category', 'placeholder'],
        components: {},
        data(){
            return {
                query: '',
                results: [],
                searching: false
            }
        },

        methods: {
            search(){
                this.searching = true
                axios.get(`/api/entities?q=${this.query}&&take=5&&${this.category ? 'category=' + this.category : '' }`).then(({data}) => {
                    this.results = data.data
                })
            },
            selectResult(place){
                this.$emit('result-clicked', place)
                this.results = [];
            },
            close(e){
                if (!this.$el.contains(e.target)) {
                    this.results = []
                    this.searching = false
                }
            }
        },
        mounted(){
            document.addEventListener('click', this.close)
        }
    }
</script>