<template>
    <div style="width:393px;" class="top-0 absolute bg-white rounded z-10 overflow-hidden shadow m-4 right-0">
        <div class="flex flex-col justify-center items-center">
            <div class="relative">
                <span class="block cursor-pointer w-8 h-8 flex items-center justify-center  p-4 rounded-full text-gray-500 absolute m-4 top-0 right-0 bg-white"
                      @click="$emit('close')"
                >
                    &times;</span>
                <img :src="place.cover" alt="">
                <div class="bg-white absolute w-full h-12 cover-skewer"></div>
            </div>
            <div class="rounded-full w-24 h-24 overflow-hidden shadow-sm bg-white -translate-y-50 -mb-5">
                <img :src="place.avatar" alt="">
            </div>
        </div>
        <div class="px-10 flex flex-col">
            <h3 class="uppercase text-xl font-bold text-center mb-4" v-text="place.name"></h3>
            <div v-if="place.tags"
                 class="-mx-1 flex py-2">
                <span v-for="tag in place.tags" class="rounded mx-1 px-5 bg-gray-200 text-sm shadow-sm text-gray-500" v-text="tag.label"></span>
            </div>
            <p class="text-sm text-gray-500 capitalize" v-text="place.description"></p>
            <a :href="'/@'+place.id" class="text-accent p-4 text-xl block text-center font-bold">Visit Profile</a>
        </div>
    </div>
</template>
<script>
    export default{
        props: ['place'],
    }
</script>