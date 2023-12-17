<template>
    <Navbar />
    <Sidebar />
    <div class="p-2 sm:ml-64" >
        <div class="p-4 mt-12">
            <div class="flex justify-between items-center mb-3">
                <h3 class="text-gray-900 font-semibold text-2xl underline">Author Add</h3>

                <router-link :to="{name: 'author'}" class="text-white bg-blue-500 hover:bg-blue-800 focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm w-auto px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Back
                </router-link>
            </div>
            <form @submit.prevent="handleAuthor">
                <div class="mb-6">
                    <label for="text" class="block mb-2 text-lg font-medium text-gray-900">Name</label>
                    <input :class="{'border-red-600': getErrMsg.name}" v-model="name" type="text" id="text" class="bg-gray-300 border-2 border-gray-900 text-gray-900 text-sm rounded-md  block w-full p-2.5 " placeholder="Full Name" >
                    <i v-if="getErrMsg.name" class="text-red-600 font-thin">{{ getErrMsg.name[0] }}</i>
                </div>
                <div class="mb-6">
                    <label for="message" class="block mb-2 text-lg font-medium text-gray-900">About</label>
                    <textarea v-model="about" id="message" rows="4" class="bg-gray-300 border-2 border-gray-900 text-gray-900 text-sm rounded-md  block w-full p-2.5 " placeholder="About . . . "></textarea>
                </div>
                <div class="mb-6">
                    <!-- <label for="author-image" class="block mb-2 text-lg font-medium text-gray-900">Image</label>
                    <input ref="image" @change="handleImage" class="bg-gray-300 border-2 border-gray-900 text-gray-900 text-sm rounded-md  block w-auto cursor-pointer" aria-describedby="user_avatar_help" id="author-image" type="file"> -->
                    <ImageUploader @imageUpload="handleImage"/>
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
    import { ref } from "vue";
    import { useAuthorStore } from '../../store/AuthorStore';
    import { storeToRefs } from 'pinia';

    const authorStore = useAuthorStore();
    const { getErrMsg } = storeToRefs(authorStore);

    let name = ref('');
    let about = ref('');
    let image = ref(null);

    // const handleImage = (e) => {
    //     image.value = e.target.files[0]
    // }
    const handleImage = (imageFile) => {
        image.value = imageFile;
    }

    const handleAuthor = () => {
        const author = {
            name: name.value,
            about: about.value,
            // image: image.value.name ? image.value : null
            image: image.value ? image.value : null
        }
        // console.log(author)
        authorStore.addAuthor(author);
    }
</script>