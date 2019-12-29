<template>
    <div class="relative">
        <img class="rounded" @click.prevent="showDropdown = !showDropdown" :src="img" alt="avatar">
        <div v-if="showDropdown && (!!auth)" class="shadow rounded flex flex-col bg-white absolute top-0"
             style="left:60px;">
            <a class="py-2 px-6 border-b border-gray-200 cap " v-if="user.role.role == 'company' "
               :href="'/@'+user.username">Profile</a>
            <a class="py-2 px-6 border-b border-gray-200 cap " v-if="user.role.role == 'admin' "
               href="/admin">Dashboard</a>
            <a class="py-2 px-6 border-b border-gray-200 cap " href="#"
               onclick="event.preventDefault();getElementById('logout-form').submit()">Logout</a>
        </div>
        <div v-if="showDropdown && (!auth)" class="shadow rounded flex flex-col bg-white absolute py-2 top-0"
             style="left:60px;">
            <a class="py-2 px-6 border-b border-gray-200 cap " href="/register">register</a>
            <a class="py-2 px-6 border-b border-gray-200 cap " href="/login">login</a>
        </div>
    </div>
</template>
<script>
    export default{
        props: ['img', 'auth', 'user'],

        data(){
            return {
                showDropdown: false,
            }
        }
    }
</script>