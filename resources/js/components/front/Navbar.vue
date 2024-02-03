<template>
    <nav class="z-50 bg-white border-gray-200 dark:bg-gray-900 dark:bg-gradient-to-r from-gray-900 to-gray-800 fixed w-full">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
            <a href="" class="flex items-center ">
                <font-awesome-icon icon="fa-solid fa-book-open" class="h-8 mr-3 whitespace-nowrap dark:text-white" alt="Phat Kya Mal Logo"/>
                <span class="self-center
                md:text-lg lg:text-2xl
                font-semibold whitespace-nowrap dark:text-white">ဖတ်ကြမယ်</span>
            </a>
            <div class="flex items-center max-md:text-lg max-sm:hidden ">
                <router-link :to="{name: 'home'}"
                class="hover:scale-105 transition duration-100 hover:text-sky-400 text-gray-500 dark:text-white mx-3 font-sans">
                    Home
                </router-link>
                <!-- <router-link :to="{name: 'front-book'}"
                class="hover:scale-105 transition duration-100 hover:text-sky-400 text-gray-500 dark:text-white mx-3 font-sans">
                    Book
                </router-link> -->
                <router-link :to="{name: 'front-author'}"
                class="hover:scale-105 transition duration-100 hover:text-sky-400 text-gray-500 dark:text-white mx-3 font-sans">
                    Authors
                </router-link>
                <!-- <router-link :to="{name: 'about'}"
                class="hover:scale-105 transition duration-100 hover:text-sky-400 text-gray-500 dark:text-white mx-3 font-sans">
                    About
                </router-link> -->
            </div>
            <div class="flex items-center">
                <!-- <a href="#" class="max-md:text-lg max-sm:hidden hover:scale-105 transition duration-100 hover:text-sky-400 text-blue-600 dark:text-blue-500 hover:underline">Login</a> -->
                <div @click="sidebarToggle">
                    <font-awesome-icon icon="fa-solid fa-bars" :class="{hidden: isSidebarOpen}" class=" w-6 h-6 sm:hidden dark:text-white hover:cursor-pointer"/>
                    <font-awesome-icon icon="fa-solid fa-xmark" :class="{hidden: !isSidebarOpen}" class="w-6 h-6 sm:hidden dark:text-white hover:cursor-pointer"/>
                </div>
            </div>
        </div>
    </nav>
</template>

<script setup>
    import { useDashboardFunctionsStore } from '../../store/DashboardFunctionsStore';
    import { storeToRefs } from 'pinia';

    const dashoardFunctionsStore = useDashboardFunctionsStore();
    const { isSidebarOpen, isUserMenuOpen } = storeToRefs(dashoardFunctionsStore);

    const userMenuToggle = () => {
        dashoardFunctionsStore.toggleUserMenu();
    }

    const sidebarToggle = () => {
        dashoardFunctionsStore.toggleSidebar();
    }
</script>

<style scoped>
    .router-link-active {
        font-size: 18px;
        border-bottom: 3px solid rgba(10, 144, 247, 0.856);
        /* background-color: #424040; */
    }
</style>