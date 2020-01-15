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
                <li @click="selectResult(place)" v-for="place in results"
                    class="flex border-t cursor-pointer border-gray-300 items-center p-3 justify-between">
                    <div class="flex items-start">
                        <img class="w-8 h-8 rounded-full mr-2" src="https://i.pravatar.cc/300" alt="">
                        <div>
                            <h3 class="text-black font-semibold text-sm" v-text="place.name"></h3>
                            <star-rating class="-mx-3"></star-rating>
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
        props: ['category'],
        components:{},
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
                axios.get(`/api/entities?q=${this.query}&&${this.category ? 'category=' + this.category : '' }`).then(({data}) => {
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