<script setup>
import { onMounted, ref, watch } from 'vue';
import Countdown from './sections/Countdown.vue'
import Cover from './sections/Cover.vue'
import LoveStory from './sections/LoveStory.vue'
import Messages from './sections/Messages.vue'
import Navigation from './sections/Navigation.vue'
import Thanks from './sections/Thanks.vue';
import TheCouple from './sections/TheCouple.vue'
import TheDate from './sections/TheDate.vue'
import { useDataStore } from '@/Stores/dataStore';
import { useLoveStoryStore } from '@/Stores/loveStoryStore';

const props = defineProps({
    to: String,
    data: Object,
    story: Array
})

const data = useDataStore()
data.set(props.data)

const story = useLoveStoryStore()
story.set(props.story)

const isCoverClosed = ref(false)

watch(isCoverClosed, (value) => {
    document.body.style.overflow = value ? 'auto' : 'hidden'
})

onMounted(() => {
    document.body.style.overflow = isCoverClosed.value ? 'auto' : 'hidden'
})
</script>

<template>
    <div class="flex min-h-dvh bg-emerald-800">
        <div class="fixed top-0 left-0 hidden w-2/3 h-full md:block bg-emerald-800">
            <!-- Sticky wrapper -->
             <div class="flex flex-col items-center justify-center w-full h-full text-white">
                <h1 class="text-5xl font-main">Rika</h1>
                <h1 class="mb-4 text-5xl font-main">Fadli</h1>
             </div>
        </div>
        <div class="relative w-full ml-auto bg-emerald-800 md:w-1/3 min-h-dvh">
        <!-- <div class="relative w-full bg-white min-h-dvh md:max-w-md font-general"> -->
            <Navigation />
    
            <div class="absolute z-0 w-full">
                <section id="countdown">
                    <Countdown />
                </section>
    
                <section id="couple">
                    <TheCouple />
                </section>
    
                <section id="date">
                    <TheDate />
                </section>
                
                <section id="story">
                    <LoveStory />
                </section>
    
                <section id="messages">
                    <Messages />
                </section>
    
                <section id="thanks">
                    <Thanks />
                </section>
            </div>
    
            <div class="fixed inset-0 z-[999] transition-transform duration-1000 ease-in-out"
                :class="isCoverClosed ? '-translate-y-full' : 'translate-y-0'">
                <div>
                    <Cover
                        :to="props.to"
                        @open-invitation="isCoverClosed = true" />
                </div>
            </div>
        </div>
    </div>
</template>