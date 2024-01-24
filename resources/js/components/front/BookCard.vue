<template>
    <div class="book-card flex flex-col w-36 h-full p-2 bg-white border border-gray-200 rounded-md shadow dark:bg-gray-800 dark:border-gray-700 ">
        <div class="divide-y-2 divided-gray-600 ">
            <div class="mb-2">
                <img class="rounded-t-lg" :src="book.image" alt="" />
            </div>
            
            <div>
                <p class="my-2 font-bold text-red-500 dark:text-red-700">{{ book.author_name }}</p>
                
                <h5 class="mb-3 text-lg font-serif tracking-tight text-gray-900 dark:text-gray-200">
                    {{ book.name }}
                </h5>
            </div>
        </div>
        
        <div class="space-y-2 mt-auto">
            <div v-if="count" class="">
                <span class="text-sm bg-neutral-700 text-green-500 rounded-md p-0.5">
                    <font-awesome-icon icon="fa-solid fa-download" class=" w-3.5 h-3.5 ms-2"/>
                    {{ count }}
                </span>
            </div>
            <button type="button" @click="downloadPdf(book.id, book.name)" :disabled="isDownload" class=" w-full hover:cursor-pointer inline-flex items-center px-2 py-1 text-sm font-medium text-center text-white bg-yellow-600 rounded-md hover:bg-yellow-700 ">
                <span class="overflow-hidden">Download</span>
                <font-awesome-icon icon="fa-solid fa-download" class=" w-3.5 h-3.5 ms-2"/>
            </button>
            <router-link :to="{name: 'book-detail', params: {id: book.id, author_id: book.author_id} }"
            class="w-full hover:cursor-pointer inline-flex items-center px-2 py-1 text-sm font-medium text-center text-white bg-blue-500 rounded-md hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <span class="overflow-hidden">View more</span>
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </router-link>
        </div>
    </div>
</template>
<script setup>
    import { defineProps } from 'vue';
    import { useBookStore } from '../../store/BookStore';
    import { storeToRefs } from 'pinia';

    const props = defineProps(['book', 'count']);
    const bookStore = useBookStore();
    const { isDownload } = storeToRefs(bookStore);

    const downloadPdf = (id, name) => {
        bookStore.isDownload = true;
        bookStore.download(id, name);
    }
</script>

<style scoped>
.book-card {
  opacity: 0;
  animation: fadeIn 0.8s ease-in-out forwards;
}

@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}
</style>