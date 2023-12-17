<template>
    <Navbar />
    <Sidebar />
    <div class="p-2 sm:ml-64" >
        <div class="p-4 mt-12">
            <div class="flex justify-between items-center mb-3">
                <h3 class="text-gray-900 font-semibold text-2xl underline">Book Add</h3>

                <router-link :to="{name: 'book'}" class="text-white bg-blue-500 hover:bg-blue-800 focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm w-auto px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Back
                </router-link>
            </div>
            <form @submit.prevent="handleBook">
                <div class="mb-6">
                    <label for="text" class="block mb-2 text-lg font-medium text-gray-900">Name</label>
                    <input :class="{'border-red-600': getErrMsg.name}" v-model="name" type="text" id="text" class="bg-gray-300 border-2 border-gray-900 text-gray-900 text-sm rounded-md  block w-full p-2.5 " placeholder="Full Name" >
                    <i v-if="getErrMsg.name" class="text-red-600 font-thin">{{ getErrMsg.name[0] }}</i>
                </div>
                <div class="mb-6">
                    <label for="about" class="block mb-2 text-lg font-medium text-gray-900">About</label>
                    <textarea v-model="about" id="about" rows="4" class="bg-gray-300 border-2 border-gray-900 text-gray-900 text-sm rounded-md  block w-full p-2.5 " placeholder="About . . . "></textarea>
                </div>
                <div class="mb-6">
                    <label for="author-select" class="block mb-2 text-lg font-medium text-gray-900">Author</label>
                    <select id="author-select" @change="handleAuthorId" 
                    class=" bg-gray-300 border-2 border-gray-900 rounded-md w-auto p-2.5">
                        <option value="null" disabled selected>Select Author</option>
                        <option v-for="author in getAuthors" :key="author.id" :value="author.id">{{ author.name }}</option>
                    </select>
                </div>
                <div class="mb-6">
                    <!-- <label for="book-file" class="block mb-2 text-lg font-medium text-gray-900">PDF</label>
                    <input class="bg-gray-300 border-2 border-gray-900 text-gray-900 text-sm rounded-md  block w-auto cursor-pointer" id="book-file" type="file"
                    ref="pdf" @change="handlePdf" > -->
                    <PdfUploader @pdfUpload="handlePdf"/>
                    <i v-if="getErrMsg.file" class="text-red-600 font-thin">{{ getErrMsg.file[0] }}</i>
                </div>
                <div class="mb-6">
                    <label class="block mb-2 text-lg font-medium text-gray-900">Image</label>
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
    import PdfUploader from '../../components/dashboard/PdfUploader.vue';
    import { onMounted, ref } from 'vue';
    import { useBookStore } from '../../store/BookStore';
    import { useAuthorStore } from '../../store/AuthorStore';
    import { storeToRefs } from 'pinia';

    const bookStore = useBookStore();
    const authorStore = useAuthorStore();
    const { getErrMsg } = storeToRefs(bookStore);
    const { getAuthors } = storeToRefs(authorStore);

    onMounted( () => {
        authorStore.getAuthor();
    })

    let name = ref(null);
    let about = ref(null);
    let pdf = ref(null);
    let image = ref(null);
    let authorId = ref(null);

    const handlePdf = (file) => {
        pdf.value = file
        // pdf.value = e.target.files[0];
    }

    const handleImage = (imageFile) => {
        image.value = imageFile;
    }

    const handleAuthorId = (e) => {
        authorId.value = e.target.value;
    }

    const handleBook = () => {
        const book = {
            name: name.value,
            about: about.value,
            author_id: authorId.value, 
            file: pdf.value ? pdf.value : null,
            image: image.value ? image.value : null
        }
        // console.log(book)
        bookStore.addBook(book);
    }
</script>