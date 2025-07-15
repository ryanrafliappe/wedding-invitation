<script setup>
import { defineEmits } from 'vue'
import { useAudioStore } from '@/Stores/audioStore'
import { useDataStore } from '@/Stores/dataStore'

const props = defineProps({
    to: String
})

const audioStore = useAudioStore()
const dataStore = useDataStore()
const data = dataStore.data

const emit = defineEmits(['open-invitation'])

const handleClick = () => {
    const target = document.getElementById('countdown')
    if (target) {
        target.scrollIntoView({ behavior: 'auto' })
    }

    emit('open-invitation')
    audioStore.play()
}

function formatIndoDate(dateString) {
    const months = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];

    const date = new Date(dateString);
    const day = String(date.getDate()).padStart(2, '0');
    const month = months[date.getMonth()];
    const year = date.getFullYear();

    return `${day} ${month} ${year}`;
}
</script>

<template>
    <div class="relative w-full min-h-screen">
        <img :src="'/storage/images/cover.jpeg'" alt="wedding invitation" class="block object-cover object-top h-screen" />
        <div class="absolute top-0 bottom-0 left-0 right-0 px-8 py-8 bg-black opacity-60"></div>
        <div class="absolute top-0 flex flex-col items-center justify-center w-full px-8 pt-8 text-white">
            <p class="text-gray-200 ">Kepada</p>
            <div class="px-8 py-2 border-y">
                <p class="text-2xl text-center">{{ props.to }}</p>
                <p class="text-center">di- Tempat</p>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 px-8 py-4 pb-12">
            <div class="text-white">
                <p class="mb-4"><span class="px-4 py-2 text-sm italic border border-white rounded-3xl">The wedding of</span></p>
                <h1 class="text-7xl font-main">{{ data.groom_nickname }}</h1>
                <h1 class="mb-4 text-7xl font-main">{{ data.bride_nickname }}</h1>
                <p class="text-lg italic">{{ formatIndoDate(data.reception_date) }}</p>
            </div>
            <div class="flex flex-col items-center justify-center mt-6 text-white animate-bounce" @click="handleClick">
                <p class="animate-pulse">Buka Undangan</p>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 animate-pulse">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 5.25 7.5 7.5 7.5-7.5m-15 6 7.5 7.5 7.5-7.5" />
                </svg>
            </div>
        </div>
    </div>
</template>
