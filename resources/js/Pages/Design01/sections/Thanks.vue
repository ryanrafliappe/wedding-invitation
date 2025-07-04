<script setup>
import { useDataStore } from '@/Stores/dataStore';

const dataStore = useDataStore()
const data = dataStore.data
</script>

<template>
    <div class="flex justify-center items-center min-h-screen w-full relative">
        
        <img :src="'/storage/images/thanks.webp'" alt="thanks image" class="h-full w-full object-cover absolute">
        <div class="absolute inset-0 bg-black opacity-60"></div>
        <div class="absolute px-8">
            <p data-aos="zoom-in" data-aos-duration="500" class="text-white text-4xl font-main text-center">Terima Kasih</p>
            <p data-aos="zoom-in" data-aos-duration="1000" class="text-white text-center mt-8">telah menjadi bagian dari hari yang paling berarti dalam hidup kami. Doa dan restu Anda adalah hadiah terindah yang kami terima</p>

            <p data-aos="zoom-in" data-aos-duration="1000" class="mt-12 text-white text-center text-2xl font-main">{{ data.groom_nickname }} & {{ data.bride_nickname }}</p>
        </div>
    </div>
</template>