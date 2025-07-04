import { defineStore } from "pinia";
import { ref } from "vue";

export const useDataStore = defineStore("data", () => {
    const data = ref({})

    const set = (newData) => {
        data.value = newData
    }

    return { data, set }
})