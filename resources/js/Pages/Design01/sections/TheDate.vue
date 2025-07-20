<script setup>
import { useDataStore } from '@/Stores/dataStore';

const dataStore = useDataStore()
const data = dataStore.data

function getIndoDay(dateString) {
    const days = [
        'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'
    ];
    const date = new Date(dateString);
    return days[date.getDay()];
}

function getIndoDate(dateString) {
    const date = new Date(dateString);
    return String(date.getDate()).padStart(2, '0');
}

function getIndoMonth(dateString) {
    const months = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    const date = new Date(dateString);
    return months[date.getMonth()];
}

function getIndoYear(dateString) {
    const date = new Date(dateString);
    return date.getFullYear();
}
</script>

<template>
    <div class="px-8 pt-8 pb-12 bg-emerald-800">
        <p data-aos="zoom-in" class="mb-8 text-3xl font-extrabold text-emerald-100 font-main">Hari Spesial Kami</p>

        <!-- akad -->
        <div
            data-aos="zoom-in"
            data-aos-duration="500"
            class="relative w-full mb-6 overflow-hidden rounded-lg shadow-lg">
            <div class="absolute inset-0 bg-top bg-cover" style="background-image: url('/storage/images/akad-bg.jpeg');"></div>
            <div class="absolute inset-0 bg-black-overlay"></div>
            <div class="absolute inset-0 z-30 flex justify-center mt-4">
                <p class="text-3xl text-white font-main">Akad Nikah</p>
            </div>
            <div class="relative z-30 pt-4 mt-16 bg-white rounded-t-4xl rounded-b-2xl">
                <div class="flex items-center justify-center w-full px-4">
                    <div class="w-1/2 pb-4 pr-5 border-r text-end border-emerald-500">
                        <p>{{ getIndoDay(data.akad_date) }}</p>
                        <p class="pb-2 text-5xl font-bold font-main">{{ getIndoDate(data.akad_date) }}</p>
                        <p>{{ getIndoMonth(data.akad_date) }} {{ getIndoYear(data.akad_date) }}</p>
                    </div>
                    <div class="flex flex-col items-start justify-center w-1/2 h-full pl-5">
                        <p class="text-2xl font-semibold font-main">{{ data.akad_time }}</p>
                        <p><span class="text-xs">WITA</span></p>
                    </div>
                </div>

                <div>
                    <p class="pt-8 text-center">Lokasi Akad Nikah</p>
                    <p class="px-4 pb-8 text-lg font-semibold text-center">{{ data.akad_location }}</p>
                </div>
            </div>
        </div>

        <!-- reception -->
        
        <div
            data-aos="zoom-in"
            data-aos-duration="500"
            class="relative w-full mb-6 overflow-hidden rounded-lg shadow-lg">
            <div class="absolute inset-0 bg-top bg-cover" style="background-image: url('/storage/images/resepsi-bg.jpeg');"></div>
            <div class="absolute inset-0 bg-black-overlay"></div>
            <div class="absolute inset-0 z-30 flex justify-center mt-4">
                <p class="text-3xl text-white font-main">Resepsi</p>
            </div>
            <div class="relative z-30 pt-4 mt-16 bg-white rounded-t-4xl rounded-b-2xl">
                <div class="flex items-center justify-center w-full px-4">
                    <div class="w-1/2 pb-4 pr-5 border-r text-end border-emerald-500">
                        <p>{{ getIndoDay(data.reception_date) }}</p>
                        <p class="pb-2 text-5xl font-bold font-main">{{ getIndoDate(data.reception_date) }}</p>
                        <p>{{ getIndoMonth(data.reception_date) }} {{ getIndoYear(data.reception_date) }}</p>
                    </div>
                    <div class="flex flex-col items-start justify-center w-1/2 h-full pl-5">
                        <p class="text-2xl font-semibold font-main">{{ data.reception_time_start }} - {{ data.reception_time_end || 'Selesai' }}</p>
                        <p><span class="text-xs">WITA</span></p>
                    </div>
                </div>

                <div>
                    <p class="pt-8 text-center">Lokasi Acara</p>
                    <p class="px-4 mb-2 text-lg font-semibold text-center">{{ data.reception_location }}</p>
                    <iframe
                        v-if="data.reception_coordinate"
                        :src="`https://www.google.com/maps?q=${data.reception_coordinate}&hl=id&z=15&output=embed`"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        class="w-full pb-6 aspect-square">
                    </iframe>
                </div>
            </div>
        </div>
        
        <div
            data-aos="zoom-in"
            data-aos-duration="500"
            class="relative w-full overflow-hidden rounded-lg shadow-lg">
            <div class="absolute inset-0 bg-top bg-cover" style="background-image: url('/storage/images/resepsi-bg.jpeg');"></div>
            <div class="absolute inset-0 bg-black-overlay"></div>
            <div class="absolute inset-0 z-30 flex justify-center mt-4">
                <p class="text-3xl text-white font-main">Ngunduh Mantu</p>
            </div>
            <div class="relative z-30 pt-4 mt-16 bg-white rounded-t-4xl rounded-b-2xl">
                <div class="flex items-center justify-center w-full px-4">
                    <div class="w-1/2 pb-4 pr-5 border-r text-end border-emerald-500">
                        <p>{{ getIndoDay(data.post_reception_date) }}</p>
                        <p class="pb-2 text-5xl font-bold font-main">{{ getIndoDate(data.post_reception_date) }}</p>
                        <p>{{ getIndoMonth(data.post_reception_date) }} {{ getIndoYear(data.post_reception_date) }}</p>
                    </div>
                    <div class="flex flex-col items-start justify-center w-1/2 h-full pl-5">
                        <p class="text-2xl font-semibold font-main">{{ data.post_reception_time_start }} - {{ data.post_reception_time_end || 'Selesai' }}</p>
                        <p><span class="text-xs">WITA</span></p>
                    </div>
                </div>

                <div>
                    <p class="pt-8 text-center">Lokasi Acara</p>
                    <p class="px-4 mb-2 text-lg font-semibold text-center">{{ data.post_reception_location }}</p>
                    <iframe
                        v-if="data.post_reception_coordinate"
                        :src="`https://www.google.com/maps?q=${data.post_reception_coordinate}&hl=id&z=15&output=embed`"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        class="w-full pb-6 aspect-square">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.bg-black-overlay::after {
    content: '';
    position: absolute;
    inset: 0;
    background-color: rgba(0, 0, 0, 0.5); /* hitam 75% */
    pointer-events: none;
    z-index: 10;
}

.bg-gradient-white::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to bottom,
        rgba(255, 255, 255, 0) 0%,
        rgba(255, 255, 255, 0) 10%,
        rgba(255, 255, 255, .8) 13%,
        rgba(255, 255, 255, 1) 15%,
        rgba(255, 255, 255, 1) 100%
    );
    pointer-events: none;
    z-index: 20;
}
</style>