<template>
    <Navbar />
    <Sidebar />

    <div class="pt-16">
        <div class="container">
            <div v-if="getScrollBook">
                <div v-for="book in getScrollBook" :key="book.id">
                    <BookCard :book="book"/>
                </div>
                <div ref="scrollTrigger" style="height: 1px;"></div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import Navbar from '../components/front/Navbar.vue';
    import Sidebar from '../components/front/Sidebar.vue';
    import BookCard from '../components/front/BookCard.vue';
    import debounce from '../composables/debounce';
    import { useBookStore } from '../store/BookStore';
    import { storeToRefs } from 'pinia';
    import { computed, onMounted, onUnmounted, ref } from 'vue';

    const bookStore = useBookStore();
    const { getScrollBook } = storeToRefs(bookStore);

    const allBooks = computed(() => {
        return getScrollBook.value;
    })

    const books = ref([]);
    const scrollTrigger = ref(null);
    const currentPage = ref(0);

    const loadMoreData = () => {
        const trigger = scrollTrigger.value;
        if (window.scrollY + window.innerHeight >= document.documentElement.offsetHeight) {
            currentPage.value++;
            bookStore.scrollBook(currentPage.value)
        }
    };
    
    onMounted(() => {
        loadMoreData();
        window.addEventListener("scroll", () => loadMoreData());
    });

    onUnmounted(() => {
        window.removeEventListener("scroll", () => loadMoreData());
    })


</script>