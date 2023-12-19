import { defineStore } from "pinia";
import { ref } from "vue";

export const useToggleStore = defineStore('toggleStore', () => {
    // STATE
    const isBookRequestOpen = ref(true);

    // ACTIONS
    const toggleBookRequest = () => {
        isBookRequestOpen.value = !isBookRequestOpen.value;
    }

    return {isBookRequestOpen, toggleBookRequest};
})