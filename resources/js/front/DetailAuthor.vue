<template>
    <Navbar />
    <Sidebar />
    
    <div class="pt-16">
        <div class="container p-3 ">
            <div v-if="getAuthors"
                class="flex flex-col md:flex-row items-center md:items-start justify-center bg-neutral-500 py-5 rounded-md">
                <img v-if="getAuthors.image" class="rounded-t-lg w-auto" :src="getAuthors.image"  alt="Author Image" />
                <div class="px-3 py-2">
                    <h3 class="text-2xl text-gray-900 font-semibold mb-3">{{ getAuthors.name }}</h3>
                    <p class="mt-8 text-gray-300">{{ getAuthors.about }}</p>
                </div>
            </div>
            <div v-if="getBooks"
            class="border-2 rounded-md border-gray-900 my-5">
                <h3 class="p-2 mb-3 text-xl font-semibold text-gray-900">{{ getAuthors.name }} Books</h3>
                
                <div class="m-3">
                    <div class="flex gap-3 overflow-x-auto" >
                        <div v-for="book in getBooks" :key="book.id">
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
    import { computed, defineProps, ref } from 'vue';
    import { useBookStore } from '../store/BookStore';
    import { useAuthorStore } from '../store/AuthorStore';
    import { storeToRefs } from 'pinia';

    const props = defineProps(['id']);
    const authorStore = useAuthorStore();
    authorStore.editAuthor(props.id);
    const { getAuthors } = storeToRefs(authorStore);

    const bookStore = useBookStore();
    bookStore.detailBook(props.id)

    const { getBooks } = storeToRefs(bookStore);
</script>

<style scoped>

</style>