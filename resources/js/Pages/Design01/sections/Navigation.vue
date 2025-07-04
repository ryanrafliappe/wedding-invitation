<script setup>
import { useAudioStore } from '@/Stores/audioStore';
import { onMounted, onUnmounted, ref } from 'vue';

const audioStore = useAudioStore()
const currentSection = ref('countdown')
const sectionIds = ['countdown', 'couple', 'date', 'story']
let observer

const handleClick = () => {
    audioStore.toggle()
}

const scrollToSection = (id) => {
  const el = document.getElementById(id)
  if (el) {
    currentSection.value = id
    el.scrollIntoView({ behavior: 'smooth' })
  }
}

onMounted(() => {
  observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        currentSection.value = entry.target.id
      }
    })
  }, {
    threshold: 0.6 // sesuaikan agar cukup terlihat sebelum dianggap aktif
  })

  sectionIds.forEach(id => {
    const el = document.getElementById(id)
    if (el) observer.observe(el)
  })
})

onUnmounted(() => {
  sectionIds.forEach(id => {
    const el = document.getElementById(id)
    if (el) observer.unobserve(el)
  })
})
</script>

<template>
    <div
        class="flex justify-center items-center w-full">
        <div
            class="fixed bottom-6 z-50">
            <button
                @click="handleClick"
                :class="{
                    'text-white w-16 h-16 rounded-full shadow-lg transition': true,
                    'bg-emerald-500 hover:bg-emerald-600': audioStore.isPlaying,
                    'bg-gray-300 hover:bg-gray-400': !audioStore.isPlaying
                }">
                <span
                    :class="{
                        'inline-block': true,
                        'animate-spin-slow': audioStore.isPlaying
                    }">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="size-6">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m9 9 10.5-3m0 6.553v3.75a2.25 2.25 0 0 1-1.632 2.163l-1.32.377a1.803 1.803 0 1 1-.99-3.467l2.31-.66a2.25 2.25 0 0 0 1.632-2.163Zm0 0V2.25L9 5.25v10.303m0 0v3.75a2.25 2.25 0 0 1-1.632 2.163l-1.32.377a1.803 1.803 0 0 1-.99-3.467l2.31-.66A2.25 2.25 0 0 0 9 15.553Z" />
                    </svg>
                </span>
            </button>
        </div>
        <div
            class="fixed bottom-8 z-30">
            <div
                class="w-72 h-11 bg-white rounded-full shadow-lg flex justify-center items-center">
                <button
                    :class="{
                        'w-1/5 flex justify-center items-center': true,
                        'text-emerald-500': currentSection === 'countdown',
                        'text-gray-500 hover:text-emerald-500': currentSection !== 'countdown'
                    }"
                    @click="scrollToSection('countdown')">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="size-6">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </button>
                <button
                    :class="{
                        'w-1/5 flex justify-center items-center': true,
                        'text-emerald-500': currentSection === 'couple',
                        'text-gray-500 hover:text-emerald-500': currentSection !== 'couple'
                    }"
                    @click="scrollToSection('couple')">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="size-6">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>
                </button>
                <div
                    class="w-1/5">
                </div>
                <button
                    :class="{
                        'w-1/5 flex justify-center items-center': true,
                        'text-emerald-500': currentSection === 'date',
                        'text-gray-500 hover:text-emerald-500': currentSection !== 'date'
                    }"
                    @click="scrollToSection('date')">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="size-6">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                    </svg>
                </button>
                <button
                    :class="{
                        'w-1/5 flex justify-center items-center': true,
                        'text-emerald-500': currentSection === 'story',
                        'text-gray-500 hover:text-emerald-500': currentSection !== 'story'
                    }"
                    @click="scrollToSection('story')">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="size-6">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</template>