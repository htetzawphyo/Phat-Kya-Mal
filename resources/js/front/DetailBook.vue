<template>
    <Navbar />
    <Sidebar />
    
    <div class="pt-16 ">
        <div class="container p-3 ">
            <div v-if="getMainBook"
                class="flex flex-col md:flex-row items-center md:items-start justify-center bg-neutral-500 py-5 rounded-md">
                <img class="rounded-t-lg w-auto" :src="getMainBook.image" alt="" />
                <div class="px-3">
                    <h3 class="text-2xl text-gray-900 font-semibold mb-3">{{ getMainBook.name }}</h3>
                    <h5 class="text-md text-red-800 italic font-bold">{{ getMainBook.author_name }}</h5>

                    <div @click="downloadPdf(getMainBook.id, getMainBook.name)" class="my-2 hover:cursor-pointer inline-flex items-center px-2 py-1 text-xs font-medium text-center text-white bg-yellow-600 rounded-md hover:bg-yellow-700 focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-700">
                        <span class="">Download</span>
                        <font-awesome-icon icon="fa-solid fa-download" class=" w-3.5 h-3.5 ms-2"/>
                    </div>
                    
                    <p class="mt-8 text-gray-300">{{ getMainBook.about != 'null' ? getMainBook.about : '' }}</p>
                </div>
            </div>
            <div v-if="getReferBook && getReferBook.length !== 0"
            class="border-2 rounded-md border-gray-900 my-5">
                <h3 class="p-2 mb-3 text-xl font-semibold text-gray-900">Reference Books</h3>
                
                <div class="m-3">
                    <div class="flex gap-3 overflow-x-auto" >
                        <div v-for="book in getReferBook" :key="book.id">
                            <BookCard :book="book"/>
                        </div>
        
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import Navbar from '../components/front/Navbar.vue';
    import Sidebar from '../components/front/Sidebar.vue';
    import BookCard from '../components/front/BookCard.vue';
    import { computed, defineProps, onMounted, ref, watch } from 'vue';
    import { useBookStore } from '../store/BookStore';
    import { storeToRefs } from 'pinia';
    import { useRoute } from 'vue-router';

    const props = defineProps(['id', 'author_id']);
    const bookStore = useBookStore();
    const route = useRoute();
    
    const fetchBook = () => {
        bookStore.detailBook(props.author_id, props.id)
    };

    // fetchBook();
    
    onMounted(() => fetchBook());
    watch(route, () => fetchBook());
    const { getBooks, getMainBook, getReferBook } = storeToRefs(bookStore);

    const downloadPdf = (id, name) => {
        bookStore.download(id, name);
    }
</script>