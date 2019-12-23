<template>
    <a href="" class="relative" @click.prevent="showDropdown = !showDropdown">
        <img class="rounded" :src="img" alt="avatar">
        <div v-if="showDropdown && auth" class="shadow rounded bg-white absolute py-1 top-0" style="left:60px;">
            <a class="p-1" href="#" onclick="event.preventDefault();getElementById('logout-form').submit()">Logout</a>
        </div>
    </a>
</template>
<script>
    export default{
        props: ['img', 'auth'],

        data(){
            return {
                showDropdown: false,
            }
        }
    }
</script>