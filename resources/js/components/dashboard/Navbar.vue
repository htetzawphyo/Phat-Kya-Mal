<template>
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-900 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <!-- Begin:: Show Sidebar Icon -->
                <div class="flex items-center justify-start">
                    <button @click="sidebarToggle" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <font-awesome-icon icon="fa-solid fa-bars" :class="{hidden: isSidebarOpen}" class="w-6 h-6"/>
                        <font-awesome-icon icon="fa-solid fa-xmark" :class="{hidden: !isSidebarOpen}" class="w-6 h-6"/>
                    </button>
                    <router-link :to="{name: 'home'}" class="flex ml-2 md:mr-24">
                        <font-awesome-icon icon="fa-solid fa-book-open" class="h-8 mr-3 whitespace-nowrap dark:text-white" alt="Phat Kya Mal Logo"/>
                        <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">ဖတ်ကြမယ်</span>
                    </router-link>
                </div>
                
                <!-- End:: Show Sidebar Icon -->
                <div class="flex items-center">
                    <div class="flex items-center ml-3">
                        <div>
                            <button @click="userMenuToggle" type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                <img src="../../assets/profile-svg.svg" class="w-8 h-8 rounded-full" alt="User Icon">
                            </button>
                        </div>
                        <div class="relative">
                            <div v-if="isUserMenuOpen" class="absolute right-0 mt-5 w-48 z-50 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
                                <div class="px-4 py-3" role="none">
                                    <p class="text-sm text-gray-900 dark:text-white" role="none">
                                    Neil Sims
                                    </p>
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                    neil.sims@flowbite.com
                                    </p>
                                </div>
                                <ul class="py-1" role="none">
                                    <li>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Settings</a>
                                    </li>
                                    <li @click="singout">
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Sign out</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<script setup>
    import { useDashboardFunctionsStore } from '../../store/DashboardFunctionsStore';
    import { useAuthStore } from '../../store/AuthStore';
    import { storeToRefs } from 'pinia';

    const dashoardFunctionsStore = useDashboardFunctionsStore();
    const authStore = useAuthStore();
    const { isSidebarOpen, isUserMenuOpen } = storeToRefs(dashoardFunctionsStore);

    const userMenuToggle = () => {
        dashoardFunctionsStore.toggleUserMenu();
    }

    const sidebarToggle = () => {
        dashoardFunctionsStore.toggleSidebar();
    }

    const singout = () => {
        authStore.logout();
    }

</script>