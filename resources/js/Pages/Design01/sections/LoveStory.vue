<script setup>
import { useLoveStoryStore } from '@/Stores/loveStoryStore'

const loveStoryStore = useLoveStoryStore()
</script>

<template>
    <div class="my-6 mx-4">
        <h1 data-aos="fade-down" class="text-emerald-700 text-3xl text-center mb-8 fw-bolder font-main">Kisah Cinta Kami</h1>

        <div class="space-y-6">
            <div v-for="(item, index) in loveStoryStore.loveStory" :key="index">
                <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="500" :class="{'mx-12 bg-white p-3 shadow-xl rounded-sm': true, 'rotate-3': index % 2 == 0, '-rotate-3': index % 2 == 1}">
                    <img class="w-full h-48 mb-3" :src="`/storage/images/${item.image_name}`" alt="love story image">
                    <p class="text-lg">{{ item.story }}</p>
                </div>
            </div>

            <!-- separation -->
            <div data-aos="fade-up" data-aos-duration="500">
                <img class="w-70 mx-auto mt-10 opacity-25" :src="'/storage/images/tribal01.png'" alt="">
            </div>
        </div>
    </div>
</template>