<template>
    <Navbar />
    <Sidebar />
    <div class="pt-16">
        <div class="container p-3">
            <div class="flex justify-center my-6 max-sm:my-4">
                <a href="https://flowbite.com" class="flex items-center ">
                <font-awesome-icon icon="fa-solid fa-book-open" class="mr-3 text-5xl max-sm:text-3xl whitespace-nowrap text-sky-700" alt="Phat Kya Mal Logo"/>
                <span class="text-5xl max-sm:text-3xl font-semibold whitespace-nowrap text-sky-700">ဖတ်ကြမယ်</span>
                </a>
            </div>

            <div class="flex justify-center">
                <div class="relative mb-4 flex w-2/4 max-sm:w-full flex-wrap items-stretch">
                    <input
                    type="search"
                    class="relative m-0 -mr-0.5 block min-w-0 flex-auto rounded-l border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-700 dark:placeholder:text-gray-500 dark:focus:border-primary"
                    placeholder="Search books.."
                    aria-label="Search"
                    aria-describedby="button-addon1" v-model="searchBox" v-on:keyup="search"/>

                    <!--Search button-->
                    <button
                    class="relative z-[2] flex items-center rounded-r bg-gray-600 px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-gray-700 hover:shadow-lg focus:bg-gray-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-800 active:shadow-lg"
                    type="button"
                    id="button-addon1"
                    data-te-ripple-init
                    data-te-ripple-color="light">
                    <font-awesome-icon class="w-4 h-4 text-gray-500 dark:text-gray-400" icon="fa-solid fa-magnifying-glass" />
                    </button>

                    <!-- Search Results -->
                    <div v-if="getSearchBooks && searchBox" class="absolute top-full left-0 max-h-64 bg-gray-500 w-full z-20 overflow-y-scroll">
                        <div v-for="book in getSearchBooks" :key="book.id"
                        class="bg-gray-500 ps-5 py-2 text-md text-gray-900 hover:bg-gray-700 cursor-pointer">
                            <div  @click="searchResultBook(book.id, book.author_id)">
                                <!-- <router-link :to="{name: 'book-detail', params: {id: book.id, author_id: book.author_id}}"> -->
                                    <span class="font-semibold">{{ book.author_name }}</span> _ 
                                    <span class="text-gray-800 font-semibold">{{ book.name }}</span>
                                <!-- </router-link> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-10 flex justify-center">
                <div class="w-11/12">
                    <h3 class="p-2 mb-3 text-3xl max-sm:text-2xl font-semibold text-gray-900">Recent Updated Books</h3>
                    
                    <div class="m-3">
                        <div v-if="getBooks" 
                        class="flex gap-3 overflow-x-auto" >
                            <div v-for="book in getBooks" :key="book.id">
                                <BookCard :book="book" />
                            </div>        
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-12 flex justify-center">
                <div class="w-11/12">
                    <h3 class="p-2 mb-3 text-3xl max-sm:text-2xl font-semibold text-gray-900">Most Popular Books</h3>
                    
                    <div class="m-3">
                        <div v-if="getBooks" 
                        class="flex gap-3 overflow-x-auto" >
                            <div v-for="book in getMostDownloadBooks" :key="book.id">
                                <BookCard :book="book" :count="book.download_count"/>
                            </div>        
                        </div>
                    </div>
                </div>
            </div>

            <font-awesome-icon icon="fa-solid fa-comment-dots" @click="showBookRequest"
            class="text-3xl fixed bottom-5 right-5 text-gray-600 cursor-pointer hover:text-gray-700 focus:text-red-900"/>

            <BookRequest />
        </div>  
    </div>
</template>

<script setup>
    import Navbar from '../components/front/Navbar.vue';
    import Sidebar from '../components/front/Sidebar.vue';
    import BookCard from '../components/front/BookCard.vue';
    import BookRequest from '../components/front/BookRequest.vue';
    import debounce from '../composables/debounce';
    import { useBookStore } from '../store/BookStore';
    import { useAuthStore } from '../store/AuthStore';
    import { useToggleStore } from '../store/ToggleStore';
    import { storeToRefs } from 'pinia';
    import { onMounted, ref } from 'vue';
    import { useRouter } from "vue-router";

    const bookStore = useBookStore();
    const authStore = useAuthStore();
    const toggleStore = useToggleStore();
    // const isBookRequestOpen = ref(true);
    const { getBooks, getMostDownloadBooks, getSearchBooks } = storeToRefs(bookStore);
    const { isBookRequestOpen } = storeToRefs(toggleStore);

    onMounted(() => {
        bookStore.getBook();
        bookStore.mostDownloadBook();
    })

    const searchBox = ref('');
    

    const search = debounce.debounce(e => {
        const value = e.target.value;
        searchBox.value = value;
        if(value){
            bookStore.mainSearch(value);
        }
    })

    // ROUTER
    const router = useRouter();

    const searchResultBook = (book_id, author_id) => {
        // console.log('helo click')
        router.push({name: 'book-detail', params: {id: book_id, author_id: author_id}})
    }

    const showBookRequest = () => {
        toggleStore.toggleBookRequest();
    }

</script>

<style scoped>

    

</style>