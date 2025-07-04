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
    <div class="relative min-h-screen w-full font-general">
        <Navigation />

        <div class="absolute z-0">
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
</template>