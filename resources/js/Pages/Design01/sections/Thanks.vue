<script setup>
import { useDataStore } from '@/Stores/dataStore';

const dataStore = useDataStore()
const data = dataStore.data
</script>

<template>
    <div class="relative flex items-center justify-center w-full min-h-screen">
        
        <img :src="'/storage/images/thanks.jpg'" alt="thanks image" class="absolute object-cover w-full h-full">
        <div class="absolute inset-0 bg-black opacity-60"></div>
        <div class="absolute px-8 mt-30">
            <p data-aos="zoom-in" data-aos-duration="500" class="text-4xl text-center text-white font-main">Terima Kasih</p>
            <p data-aos="zoom-in" data-aos-duration="1000" class="mt-8 text-center text-white">telah menjadi bagian dari hari yang paling berarti dalam hidup kami. Doa dan restu Anda adalah hadiah terindah yang kami terima</p>

            <p data-aos="zoom-in" data-aos-duration="1000" class="mt-12 text-2xl text-center text-white font-main">{{ data.bride_nickname }} & {{ data.groom_nickname }}</p>
        </div>
    </div>
</template>