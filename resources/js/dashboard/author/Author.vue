<template>
    <Navbar />
    <Sidebar />
    <div class="p-2 sm:ml-64" >
        <div class="p-4 mt-12"> 
            <div class="flex justify-start items-center">
                <h3 class="text-gray-900 font-semibold text-2xl">Authors Lists</h3>
            </div>
            <div class="mb-4 lg:flex xl:flex 2xl:flex justify-between space-y-2">
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <font-awesome-icon class="w-4 h-4 text-gray-500 dark:text-gray-400" icon="fa-solid fa-magnifying-glass" />
                    </div>
                    <input v-model="searchBox" v-on:keyup="search" type="text" id="table-search" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-md w-full xl:w-80 2xl:w-80 lg:w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for authors">
                </div>

                <Pagination :meta="getMeta" @updatePage="handlePageUpdate"/>
            </div>
            <div class="relative overflow-x-auto shadow-lg rounded-md">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="pl-2 text-center py-3 w-1">
                                Index
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                About
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="">
                        <tr v-if="getAuthors == 0" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900">
                            <th colspan="4" scope="row" class="w-1 text-center  py-4 font-medium text-gray-500 whitespace-nowrap dark:text-gray-500">
                                No Data
                            </th>
                        </tr>
                        <tr v-for="(author, index) in getAuthors" :key="index" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900" >
                            <th scope="row" class="w-1 text-center py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ getIndex + index }}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ author ? author.name : '' }}
                            </th>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ author ? (author.about ? author.about.substring(0,50) + ' . . .' : '') : '' }}
                            </td>
                            <td class="px-6 py-4 flex">
                                <div v-if="author && author.id">
                                    <router-link :to="{ name: 'author-edit', params:{id: author.id} }">
                                        <font-awesome-icon icon="fa-solid fa-pen-to-square" class="w-8 h-4 text-amber-500 hover:cursor-pointer"/>
                                    </router-link>
                                </div>
                                <font-awesome-icon icon="fa-solid fa-trash" @click="deleteAuthor(author.id)"
                                class="w-8 h-4 text-red-800 hover:cursor-pointer"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</template>

<script setup>
    import Navbar from '../../components/dashboard/Navbar.vue';
    import Sidebar from '../../components/dashboard/Sidebar.vue';
    import Pagination from '../../components/dashboard/Pagination.vue';
    import debounce from '../../composables/debounce';
    import { useAuthorStore } from '../../store/AuthorStore';
    import { storeToRefs } from 'pinia';
    import { ref } from 'vue';

    const authorStore = useAuthorStore();
    const { getAuthors, getMeta, getIndex } = storeToRefs(authorStore);
    authorStore.getAuthor();

    const searchBox = ref(''); 

    const handlePageUpdate = (currentPage) => {
        authorStore.getAuthor(searchBox.value,currentPage)
    }

    const search = debounce.debounce(e => {
        const value= e.target.value;
        searchBox.value = value;
        authorStore.getAuthor(value)
    })

    const deleteAuthor = (id) => {
        confirm('Are you sure you want to Delete?') ? authorStore.deleteAuthor(id) : '';
    }
</script>

<style scoped>

</style>