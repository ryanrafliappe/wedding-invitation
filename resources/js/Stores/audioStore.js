import { defineStore } from "pinia";
import { ref } from "vue";

export const useAudioStore = defineStore("audio", () => {
    const isPlaying = ref(false)
    const audio = ref(new Audio('/storage/audio/backsound.mp3'))

    const play = () => {
        audio.value.play()
        isPlaying.value = true
    }

    const pause = () => {
        audio.value.pause()
        isPlaying.value = false
    }

    const toggle = () => {
        isPlaying.value ? pause() : play()
    }

    return { audio, isPlaying, play, pause, toggle }
})