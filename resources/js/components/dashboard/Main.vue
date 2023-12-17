<template>
    <Navbar /> 
    <Sidebar />
    <div class="p-2 sm:ml-64" @click="sidebarHide">
        <div class="p-4 mt-12">
            <!-- Component  -->
            
        </div>
    </div>
</template>

<script setup>
    import Navbar from '../components/dashboard/Navbar.vue';
    import Sidebar from '../components/dashboard/Sidebar.vue';
    import { useDashboardFunctionsStore } from '../store/DashboardFunctionsStore';
    import { storeToRefs } from 'pinia';

    const dashoardFunctionsStore = useDashboardFunctionsStore();
    const { isSidebarOpen } = storeToRefs(dashoardFunctionsStore);

    const sidebarHide = () => {
        if(isSidebarOpen.value){
            dashoardFunctionsStore.hideSidebar();
        }
    }

</script>