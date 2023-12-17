<template>
    <Navbar />
    <Sidebar />
    <div class="p-2 sm:ml-64" >
        <div class="p-4 mt-12">
            <div class="flex justify-between items-center mb-3">
                <h3 class="text-gray-900 font-semibold text-2xl underline">Author Edit</h3>

                <router-link :to="{name: 'author'}" class="text-white bg-blue-500 hover:bg-blue-800 focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm w-auto px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Back
                </router-link>
            </div>
            <form @submit.prevent="handleAuthor" v-if="getAuthors">
                <div class="mb-6" >
                    <label for="name" class="block mb-2 text-lg font-medium text-gray-900">Name</label>
                    <input :class="{'border-red-600': getErrMsg.name}" v-model="getAuthors.name" type="text" id="name" class="bg-gray-300 border-2 border-gray-900 text-gray-900 text-sm rounded-md  block w-full p-2.5 " placeholder="Full Name" >
                    <i v-if="getErrMsg.name" class="text-red-600 font-thin">{{ getErrMsg.name[0] }}</i>
                </div>
                <div class="mb-6" >
                    <label for="about" class="block mb-2 text-lg font-medium text-gray-900">About</label>
                    <textarea  v-model="getAuthors.about" id="about" rows="4" class="bg-gray-300 border-2 border-gray-900 text-gray-900 text-sm rounded-md  block w-full p-2.5 " placeholder="About . . . "></textarea>
                </div>
                <div class="mb-6">
                    <label for="author-image" class="block mb-2 text-lg font-medium text-gray-900">Image</label>
                    <ImageUploader @imageUpload="handleImage" :hasImage="getAuthors.image"/>
                </div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </form>
        </div>
    </div>

</template>

<script setup>
    import Navbar from '../../components/dashboard/Navbar.vue';
    import Sidebar from '../../components/dashboard/Sidebar.vue';
    import ImageUploader from '../../components/dashboard/ImageUploader.vue';
    import { ref, defineProps } from "vue";
    import { useAuthorStore } from '../../store/AuthorStore';
    import { storeToRefs } from 'pinia';
    
    const props = defineProps(['id']);
    
    const authorStore = useAuthorStore();
    authorStore.editAuthor(props.id);

    const { getAuthors ,getErrMsg } = storeToRefs(authorStore);    

    const image = ref(null);

    const handleImage = (imageFile) => {
        image.value = imageFile;
    }

    const handleAuthor = () => {
        let formData = new FormData();
        formData.append("_method", 'put');
        formData.append("name", getAuthors.value.name)
        formData.append("about", getAuthors.value.about ? getAuthors.value.about : '')
        formData.append("image", image.value ? image.value : null)

        authorStore.updateAuthor(props.id, formData);
    }
</script>