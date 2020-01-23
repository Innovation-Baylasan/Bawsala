<template>
    <div class="relative">
        <img class="rounded" :src="img" alt="avatar">
    </div>
</template>
<script>
    export default{
        props: ['img'],
    }
</script>