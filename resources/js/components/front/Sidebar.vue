<template>
    <aside :class="{ 'translate-x-0': isSidebarOpen, 'translate-x-full': !isSidebarOpen }" aria-label="Sidebar"
    class="fixed top-0 right-0 z-40 -translate-x-full w-52 h-screen pt-20 duration-300 transition-transform bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-900 dark:border-gray-700 sm:hidden" >
        <div class="h-full px-3 pb-4  bg-white dark:bg-gray-900 divide-y divide-gray-100 rounded shadow dark:divide-gray-600 transition-transform">
            <ul class="mb-2 space-y-2 font-medium text-sm">
                <li>
                    <router-link :to="{name: 'home'}" class="flex items-center p-2 text-gray-900 rounded-sm dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <font-awesome-icon icon="fa-solid fa-house" class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"/>
                    <span class="flex-1 ml-3 whitespace-nowrap text-gray-300">Home</span>
                    </router-link>
                </li>
                <!-- <li>
                    <router-link :to="{name: 'front-book'}" class="flex items-center p-2 text-gray-900 rounded-sm dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <font-awesome-icon icon="fa-solid fa-book" class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"/>
                    <span class="flex-1 ml-3 whitespace-nowrap text-gray-300">Book</span>
                    </router-link>
                </li> -->
                <li>
                    <router-link :to="{name: 'front-author'}" class="flex items-center p-2 text-gray-900 rounded-sm dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <font-awesome-icon icon="fa-solid fa-users" class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"/>
                    <span class="flex-1 ml-3 whitespace-nowrap text-gray-300">Author</span>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{name: 'about'}" class="flex items-center p-2 text-gray-900 rounded-sm dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <font-awesome-icon icon="fa-solid fa-circle-info" class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"/>
                    <span class="flex-1 ml-3 whitespace-nowrap text-gray-300">About</span>
                    </router-link>
                </li>
            </ul>
        </div>
    </aside>
</template>

<script setup>
    import { useDashboardFunctionsStore } from '../../store/DashboardFunctionsStore';
    import { storeToRefs } from 'pinia';

    const dashoardFunctionsStore = useDashboardFunctionsStore();
    const { isSidebarOpen } = storeToRefs(dashoardFunctionsStore);
</script>

<style scoped>
    /* .router-link-active {
        border-left: 3px solid rgba(224, 223, 217, 0.856);
        background-color: #424040;
    } */

</style>