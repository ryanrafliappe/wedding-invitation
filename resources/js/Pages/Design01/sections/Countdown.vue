<script setup>
import { onMounted, onUnmounted, ref } from 'vue'
import { useDataStore } from '@/Stores/dataStore'

const dataStore = useDataStore()
const data = dataStore.data

const props = defineProps({
    date: {
        type: String,
        default: '2030-01-01'
    },
    time: {
        type: String,
        default: '10:00'
    }
})
const targetDate = new Date(`${data.reception_date}T${data.reception_time_start}:00`).getTime()

const days = ref(0)
const hours = ref(0)
const minutes = ref(0)
const seconds = ref(0)

let interval

const updateCountdown = () => {
    const now = new Date().getTime();
    const distance = targetDate - now;

    if (distance < 0) {
        days.value = hours.value = minutes.value = seconds.value = 0
        clearInterval(interval)
        return
    }

    days.value = Math.floor(distance / (1000 * 60 * 60 * 24));
    hours.value = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    minutes.value = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    seconds.value = Math.floor((distance % (1000 * 60)) / 1000);
}

onMounted(() => {
    updateCountdown()
    interval = setInterval(updateCountdown, 1000)
})

onUnmounted(() => clearInterval(interval))
</script>

<template>
    <div class="relative h-screen w-screen">
        <img :src="'/storage/images/countdown.webp'" alt="countdown" class="absolute inset-0 w-full h-full object-cover object-top block z-0" />

        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent z-10"></div>

        <div class="relative z-20 w-full h-full flex flex-col justify-end items-center text-white pb-32">
            <h2 class="text-xl mb-4">Menuju hari bahagia</h2>
            <div class="flex gap-6 text-center text-xl font-semibold">
                <div>
                    <p class=" text-4xl font-main">{{ days }}</p>
                    <p class="text-sm font-thin">Hari</p>
                </div>
                <div>
                    <p class=" text-4xl font-main">{{ hours }}</p>
                    <p class="text-sm font-thin">Jam</p>
                </div>
                <div>
                    <p class=" text-4xl font-main">{{ minutes }}</p>
                    <p class="text-sm font-thin">Menit</p>
                </div>
                <div>
                    <p class=" text-4xl font-main">{{ seconds }}</p>
                    <p class="text-sm font-thin">Detik</p>
                </div>
            </div>
        </div>
    </div>
</template>