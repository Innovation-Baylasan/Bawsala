<template>
    <div v-cloak style="width:393px;" class="fixed z-10 top-0 bg-white rounded overflow-hidden shadow m-4 left-0">
        <div class="relative h-56 overflow-hidden  flex flex-col justify-center items-center">
                    <span @click="$emit('close')"
                          class="block cursor-pointer w-8 h-8 flex items-center justify-center  p-4 rounded-full text-gray-500 absolute m-4 top-0 right-0 bg-white">
                    &times;</span>
            <img class="overflow-hidden" :src="event.picture" alt="">
        </div>
        <div class="flex flex-col">
            <table>
                <tbody>
                <tr>
                    <td class="border p-4 text-center pb-0">
                        <p class="flex flex-col">
                            <img src="/svg/event-starttime-icon.svg" alt="">
                            <span class="text-sm text-muted">start date</span>
                            <span v-text="event.start_date"></span></p>
                    </td>
                    <td class="border p-4 text-center pb-0">
                        <p class="flex flex-col">
                            <img src="/svg/event-endtime-icon.svg" alt="">
                            <span class="text-sm text-muted">end date</span>
                            <span v-text="event.end_date"></span></p>
                    </td>
                </tr>
                <tr>
                    <td class="border p-4 text-center pb-0">
                        <p class="flex flex-col">
                            <img src="/svg/event-fees-icon.svg" alt="">
                            <span class="text-sm text-muted">fees</span>
                            <span>0</span></p>
                    </td>
                    <td class="border p-4 text-center pb-0">
                        <p class="flex flex-col">
                            <img src="/svg/event-seats-icon.svg" alt="">
                            <span class="text-sm text-muted">seats</span>
                            <span>100</span></p>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="p-2">
                <p class="text-sm mb-4 text-gray-500 capitalize" v-text="event.description"></p>
                <a :href="event.link" target="_blank"
                   class="button is-wide text-center flex justify-center">Go to event</a>
            </div>
        </div>
    </div>
</template>
<script>
    export default{
        props: ['event'],
    }
</script>