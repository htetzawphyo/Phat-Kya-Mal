<template>
    <nav aria-label="Page navigation example">
        <ul class="inline-flex -space-x-px text-base h-9 ">
            <li>
            <button @click="changePage(currentPage - 1)" :disabled="currentPage == 1" :class="{'hover': true, 'cursor-not-allowed' : currentPage == 1}" 
            class="flex items-center lg:justify-center px-4 h-9 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"> Prev </button>
            </li>
            <li>
            <button class="flex items-center justify-center px-4 h-9 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                {{ meta.current_page }}
            </button>
            </li>
            <!-- <li>
            <button class="flex items-center justify-center px-4 h-9 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                {{ meta.current_page }}
            </button>
            </li>
            <li>
            <button class="flex items-center justify-center px-4 h-9 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                ...
            </button>
            </li>
            <li>
            <button class="flex items-center justify-center px-4 h-9 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                {{ meta.last_page }}
            </button>
            </li> -->
            <li>
            <button @click="changePage(currentPage + 1)" :disabled="currentPage == meta.last_page" :class="{'hover': true, 'cursor-not-allowed' : currentPage == meta.last_page}" class="flex items-center justify-center px-4 h-9 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</button>
            </li>
        </ul>
        <!-- {{ meta.current_page }}||
        {{ meta.last_page }} -->
    </nav>
</template>

<script setup>
    import { defineProps, defineEmits ,ref } from 'vue';

    const props = defineProps(['meta']);
    const emits = defineEmits(['updatePage']); 
    const currentPage = ref(1);

    const changePage = (page) => {
        if(page >= 1 && page <= props.meta.last_page){
            currentPage.value = page;
            
            emits('updatePage', currentPage.value);
        }
    }
</script>