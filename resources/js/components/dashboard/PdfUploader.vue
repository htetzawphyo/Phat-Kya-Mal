<template>
    <div class="">
        <label for="book-file" class="block mb-2 text-lg font-medium text-gray-900">PDF</label>
        <input class="bg-gray-300 border-2 border-gray-900 text-gray-900 text-sm rounded-md  block w-auto cursor-pointer" id="book-file" type="file"
        ref="pdf" @change="handlePdf">
    </div>
</template>

<script setup>
    import { defineEmits ,ref } from 'vue';

    const pdf = ref(null);

    const emits = defineEmits(['pdf']);

    const handlePdf = (e) => {
        pdf.value = e.target.files[0];

        emits('pdfUpload', pdf.value);
    }

</script>