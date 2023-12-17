import { defineStore } from "pinia";
import { ref } from "vue";

export const useDashboardFunctionsStore = defineStore('dashboardFunctionsStore', () => {
    // STATE
    const isUserMenuOpen = ref(false);
    const isSidebarOpen = ref(false);
    const isAuthorDropdown = ref(true);
    const isBookDropdown = ref(true); 
    const isCategoryDropdown = ref(true); 

    // ACTIONS
    const toggleUserMenu = () => {
        isUserMenuOpen.value = !isUserMenuOpen.value;
    };

    const toggleSidebar = () => {
        isSidebarOpen.value = !isSidebarOpen.value;
    };

    const hideSidebar = () => {
        isSidebarOpen.value = !isSidebarOpen.value;
    };

    const toggleAuthorDropdown = () => {
        isAuthorDropdown.value = !isAuthorDropdown.value;
    }

    const toggleBookDropdown = () => {
        isBookDropdown.value = !isBookDropdown.value;
    }

    const toggleCategoryDropdown = () => {
        isCategoryDropdown.value = !isCategoryDropdown.value;
    }

    return { isUserMenuOpen, isSidebarOpen, isAuthorDropdown, isBookDropdown, isCategoryDropdown,
        toggleAuthorDropdown, toggleBookDropdown, toggleCategoryDropdown, toggleUserMenu, toggleSidebar, hideSidebar }
})