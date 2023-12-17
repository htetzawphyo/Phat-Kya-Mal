<template>
    <div class="">
        <input type="file" @change="previewImage" ref="imageInput" 
        class="bg-gray-300 border-2 border-gray-900 text-gray-900 text-sm rounded-md  block w-auto cursor-pointer">
        <div v-if="hasImage || previewImageSrc" class="relative mt-2 max-w-xs w-20">
            <img v-if="!previewImageSrc" :src="hasImage" alt="Preview" class="block max-w-full max-h-96"/>
            <img v-if="previewImageSrc" :src="previewImageSrc" alt="Preview" class="block max-w-full max-h-96"/>
            <button @click="cancelImage"
            class="hidden absolute top-0 right-0 p-1 bg-gray-300 text-red-600 rounded-full transform translate-x-1/2 -translate-y-1/2">
            <font-awesome-icon icon="fa-solid fa-xmark" class=""/>
            </button>
        </div>
    </div>
</template>
<script setup>
    import { ref, defineEmits, defineProps } from 'vue';
  
    const emits = defineEmits(['image']);
    const props = defineProps(['hasImage']);
    const previewImageSrc = ref(props.hasImage);
    const imageInput = ref(null);
    
    const previewImage = () => {
        if(imageInput.value.files[0]){
            const reader = new FileReader();
            reader.readAsDataURL(imageInput.value.files[0]); 
    
            reader.onload = (e) => {
                previewImageSrc.value = e.target.result;
            };
    
            emits('imageUpload', imageInput.value.files[0]);
        }
    };
    
    const cancelImage = () => {
        imageInput.value = null; // Clear the file input
        previewImageSrc.value = null; // Clear the preview
        
        emits('imageUpload', null);
    };
</script>

<!-- Author Edit form ကနေ သည် ImageUploader component ကို call တဲ့ချိန် အဲ့ဘက်ကနေ :hasImage နဲ့ image src ကို ပေးခဲ့တယ်။ ပေးခဲ့တယ်ဆိုပေမယ့် သည်ဘက်မှာ တန်းသုံးမှ ရမှာ, တန်းမသုံးပဲ variable တခုထဲ assign လုပ်ပြီးသုံးမယ်ဆို သုံးလို့မရဘူး, reload တချက်လုပ်မှ ပုံပေါ်မဲ့ အနေအထားဖြစ်နေတာ။

အဲ့တာကို ဖြေရှင်းဖို့ condition စစ်ပြီးပဲ လုပ်လိုက်တယ်။ -->