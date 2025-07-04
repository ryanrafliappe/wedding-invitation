import { defineStore } from "pinia";
import { ref } from "vue";

export const useLoveStoryStore = defineStore('loveStory', () => {
    const loveStory = ref([])

    const set = (newLoveStory) => {
        loveStory.value = newLoveStory
    }

    return { loveStory, set }
})