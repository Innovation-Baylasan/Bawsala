<template>
    <div class="mb-12 flex -mx-4">
        <div class="mx-4">
            <button @click="isActive = !isActive"
                    class="border border-solid focus:outline-none border-gray-600 rounded-full w-6 h-6 flex items-center justify-center text-xs text-gray-600 font-bold leading-none cursor-pointer">
                <svg v-if="!isActive" xmlns="http://www.w3.org/2000/svg" width="12" height="16" viewBox="0 0 12 16"
                     class="fill-current">
                    <path d="M12 9H7v5H5V9H0V7h5V2h2v5h5z"></path>
                </svg>

                <svg v-if="isActive" xmlns="http://www.w3.org/2000/svg" width="12" height="16" viewBox="0 0 12 16"
                     class="fill-current">
                    <path d="M7.48 8l3.75 3.75-1.48 1.48L6 9.48l-3.75 3.75-1.48-1.48L4.52 8 .77 4.25l1.48-1.48L6 6.52l3.75-3.75 1.48 1.48z"></path>
                </svg>
            </button>
        </div>
        <div class="leading-none">
            <h3 @click="isActive = !isActive"
                class="text-gray-900  mb-2 text-bold text-3xl  "
            >{{title}}</h3>

            <p v-if="isActive" class="text-gray-600">{{body}}</p>

        </div>
    </div>
</template>
<script>
    export default{
        props: ['title', 'body'],
        data(){
            return {
                isActive: false
            }
        }
    }
</script>