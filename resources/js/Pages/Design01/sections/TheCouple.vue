<script setup>
import { useDataStore } from '@/Stores/dataStore';

const dataStore = useDataStore()
const data = dataStore.data
</script>

<template>
    <div class="relative min-h-screen bg-white">
        <div class="absolute">
            <div class="flex flex-col items-center justify-center min-h-screen px-6 py-4">
                <img data-aos="fade-up" data-aos-duration="1000" :src="'/storage/images/bismillah.png'" alt="Basmalah" class="w-[50vw] lg:w-[15vw] mb-4">
        
                <p data-aos="fade-up" data-aos-duration="1000" class="mb-12 text-center">Di antara jutaan langkah yang pernah ditempuh,<br />Allah pertemukan kami dalam takdir yang indah. Bukan karena kami sempurna, tapi karena kami saling melengkapi satu sama lain.</p>

                <div data-aos="fade-up" data-aos-duration="1000" class="flex flex-col items-center text-center">
                    <p class="mb-1 text-sm text-gray-600">Mempelai Wanita</p>
                    <h1 class="text-2xl font-semibold text-emerald-800 font-main">{{ data.bride_fullname }}</h1>
                    <p class="text-sm">Putri dari Bapak {{ data.bride_fathername }} & Ibu {{ data.bride_mothername }}</p>
                </div>
                
                <p data-aos="fade-up" data-aos-duration="1000" class="my-4 text-xl">&</p>
                
                <div data-aos="fade-up" data-aos-duration="1000" class="flex flex-col items-center text-center">
                    <p class="mb-1 text-sm text-gray-600">Mempelai Pria</p>
                    <h1 class="text-2xl font-semibold text-emerald-800 font-main">{{ data.groom_fullname }}</h1>
                    <p class="text-sm">Putra dari Bapak {{ data.groom_fathername }} & Ibu {{ data.groom_mothername }}</p>
                </div>
        
                <p data-aos="fade-up" data-aos-duration="1000" class="px-8 mt-12 text-center">Kini, kami bersiap melangkah bersama menuju babak baru kehidupan dalam ikatan suci pernikahan.</p>
            </div>
        </div>
        <div
            class="absolute bottom-0 right-0 opacity-5">
            <img
                class="w-full"
                :src="'/storage/images/tribal02.png'"
                alt="background decoration">
        </div>
    </div>
</template>