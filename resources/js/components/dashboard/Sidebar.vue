<template>
    <aside :class="{ 'translate-x-0': isSidebarOpen }" id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-900 dark:border-gray-700" aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-900 divide-y divide-gray-100 rounded shadow dark:divide-gray-600">
            <ul class="mb-2 space-y-2 font-medium text-sm">
                <li>
                    <router-link :to="{name: 'admin'}" class="flex items-center p-2 text-gray-900 rounded-sm dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <font-awesome-icon icon="fa-solid fa-chart-line" class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"/>
                    <span class="ml-3 text-gray-300">Dashboard</span>
                    </router-link>
                </li>                
                <li>
                    <div @click="toggleAuthor" class="hover:cursor-pointer flex items-center p-2 text-gray-900 rounded-sm dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <font-awesome-icon icon="fa-solid fa-feather" class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"/>
                        <span class="flex-1 ml-3 whitespace-nowrap text-gray-300">Author</span>
                        <font-awesome-icon icon="fa-solid fa-angle-down" class="text-xs" v-if="isAuthorDropdown"/>
                        <font-awesome-icon icon="fa-solid fa-chevron-up" class="text-xs" v-if="!isAuthorDropdown"/>
                    </div>
                    <ul class="pl-7" v-if="!isAuthorDropdown">
                        <li class="mb-1">
                            <router-link :to="{name: 'author'}" class="flex items-center p-2 text-gray-900 rounded-sm dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <span class="text-gray-300 text-sm flex items-center hover:text-gray-100  before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-2">Author Lists</span>
                            </router-link>
                        </li>
                        <li class="mb-1">
                            <router-link :to="{name: 'author-add'}" class="flex items-center p-2 text-gray-900 rounded-sm dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <span class="text-gray-300 text-sm flex items-center hover:text-gray-100  before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-2">Author Add</span>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li>
                    <div @click="toggleBook" class="hover:cursor-pointer flex items-center p-2 text-gray-900 rounded-sm dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <font-awesome-icon icon="fa-solid fa-book" class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"/>
                        <span class="flex-1 ml-3 whitespace-nowrap text-gray-300">Book</span>
                        <font-awesome-icon icon="fa-solid fa-angle-down" class="text-xs" v-if="isBookDropdown"/>
                        <font-awesome-icon icon="fa-solid fa-chevron-up" class="text-xs" v-if="!isBookDropdown"/>
                    </div>
                    <ul class="pl-7" v-if="!isBookDropdown">
                        <li class="mb-1">
                            <router-link :to="{name: 'book'}" class="flex items-center p-2 text-gray-900 rounded-sm dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <span class="text-gray-300 text-sm flex items-center hover:text-gray-100  before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-2">Book Lists</span>
                            </router-link>
                        </li>
                        <li class="mb-1">
                            <router-link :to="{name: 'book-add'}" class="flex items-center p-2 text-gray-900 rounded-sm dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <span class="text-gray-300 text-sm flex items-center hover:text-gray-100  before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-2">Book Add</span>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <!-- <li>
                    <div @click="toggleCategory" class="hover:cursor-pointer flex items-center p-2 text-gray-900 rounded-sm dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <font-awesome-icon icon="fa-solid fa-list" class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"/>
                        <span class="flex-1 ml-3 whitespace-nowrap text-gray-300">Category</span>
                        <font-awesome-icon icon="fa-solid fa-angle-down" class="text-xs" v-if="isCategoryDropdown"/>
                        <font-awesome-icon icon="fa-solid fa-chevron-up" class="text-xs" v-if="!isCategoryDropdown"/>
                    </div>
                    <ul class="pl-7" v-if="!isCategoryDropdown">
                        <li class="mb-1">
                            <router-link :to="{name: 'category'}" class="flex items-center p-2 text-gray-900 rounded-sm dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <span class="text-gray-300 text-sm flex items-center hover:text-gray-100  before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-2">Category Lists</span>
                            </router-link>
                        </li>
                        <li class="mb-1">
                            <router-link :to="{name: 'category-add'}" class="flex items-center p-2 text-gray-900 rounded-sm dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <span class="text-gray-300 text-sm flex items-center hover:text-gray-100  before:w-1 before:h-1 before:rounded-full before:bg-gray-300 before:mr-2">Category Add</span>
                            </router-link>
                        </li>
                    </ul>
                </li> -->
            </ul>
            <ul class="pt-2 space-y-2 font-medium text-sm">
                <li>
                    <router-link :to="{name: 'user'}" class="flex items-center p-2 text-gray-900 rounded-sm dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <font-awesome-icon icon="fa-solid fa-users" class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"/>
                    <span class="flex-1 ml-3 whitespace-nowrap text-gray-300">User</span>
                    </router-link>
                </li>
                <li>
                    <router-link :to="{name: 'role'}" class="flex items-center p-2 text-gray-900 rounded-sm dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <font-awesome-icon icon="fa-solid fa-list" class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"/>
                    <span class="flex-1 ml-3 whitespace-nowrap text-gray-300">Role</span>
                    </router-link>
                </li>                
            </ul>
        </div>
    </aside>
</template>

<script setup>
    import { useDashboardFunctionsStore } from '../../store/DashboardFunctionsStore';
    import { storeToRefs } from 'pinia';
    import { watch } from 'vue';

    const dashoardFunctionsStore = useDashboardFunctionsStore();
    const { isSidebarOpen, isAuthorDropdown, isBookDropdown, isCategoryDropdown } = storeToRefs(dashoardFunctionsStore);

    const toggleAuthor = () => {
        dashoardFunctionsStore.toggleAuthorDropdown();
    }

    const toggleBook = () => {
        dashoardFunctionsStore.toggleBookDropdown();
    }

    const toggleCategory = () => {
        dashoardFunctionsStore.toggleCategoryDropdown();
    }

</script>

<style scoped>
    .router-link-active {
        border-left: 3px solid rgba(224, 223, 217, 0.856);
        background-color: #424040;
    }
</style>