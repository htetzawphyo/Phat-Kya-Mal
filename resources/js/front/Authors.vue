<template>
    <Navbar />
    <Sidebar />

    <div class="pt-16">
        <div class="container p-3">
            <div v-if="getAuthors"
            class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 lg:grid-cols-5 gap-3">
                <!-- Card -->
                <div v-for="(author, index) in getAuthors" :key="index"
                class="block rounded-lg bg-white shadow-lg dark:bg-gray-800 text-left author-card">

                    <!-- Card body -->
                    <div class="p-3 ">

                        <!-- Title -->
                        <h5 class="mb-2 text-xl font-bold tracking-wide text-neutral-800 dark:text-neutral-50">
                            {{ author ? author.name : '' }}
                        </h5>

                        <!-- Button -->
                        <router-link v-if="author && author.id" :to="{name: 'author-detail', params: {id: author.id}}"
                            class="mt-3 inline-block rounded bg-blue-500 px-6 pb-1.5 pt-2 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-blue-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-blue-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-blue-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                            View
                        </router-link>

                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import Navbar from '../components/front/Navbar.vue';
    import Sidebar from '../components/front/Sidebar.vue';
    import { useAuthorStore } from '../store/AuthorStore';
    import { storeToRefs } from 'pinia';

    const authorStore = useAuthorStore();
    const { getAuthors } = storeToRefs(authorStore);
    authorStore.getAuthor();

    // Array of Burmese strings
    // let burmeseArray = ['က', 'ဂ', 'င', 'စ', 'ဆ', 'ဇ', 'ဈ', 'ည', 'ဋ', 'ဌ', 'ဍ', 'ဎ', 'ဏ', 'တ', 'ထ', 'ဒ', 'ဓ', 'န', 'ပ', 'ဖ', 'ဗ', 'ဘ', 'မ', 'ယ', 'ရ', 'လ', 'ဝ', 'သ', 'ဟ', 'ဠ', 'အ'];

    // // Sorting the array based on Unicode values
    // burmeseArray.sort((a, b) => a.localeCompare(b, 'my'));

    // console.log(burmeseArray);

</script>

<style scoped>
.author-card {
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