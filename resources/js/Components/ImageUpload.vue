<template>
    <div class="space-y-4">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ label }}
            <span v-if="required" class="text-red-500">*</span>
        </label>

        <!-- Current Image Preview -->
        <div v-if="currentImage" class="relative inline-block">
            <img :src="currentImage" 
                 :alt="altText"
                 class="w-32 h-32 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
            <button type="button"
                    @click="removeCurrentImage"
                    class="absolute -top-2 -right-2 bg-red-500 hover:bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm transition-colors">
                ×
            </button>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Current image</p>
        </div>

        <!-- Upload Area -->
        <div class="relative">
            <div class="flex items-center justify-center w-full">
                <label :for="inputId" 
                       class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 transition-colors"
                       :class="{ 'border-red-500 dark:border-red-500': error }">
                    <div v-if="!uploading" class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                        </svg>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                            <span class="font-semibold">Click to upload</span> or drag and drop
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            {{ acceptedFormats }} (MAX. {{ maxSizeMB }}MB)
                        </p>
                    </div>
                    
                    <div v-else class="flex flex-col items-center justify-center pt-5 pb-6">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Uploading...</p>
                        <div v-if="uploadProgress > 0" class="w-full bg-gray-200 rounded-full h-2 mt-2 max-w-xs">
                            <div class="bg-blue-600 h-2 rounded-full transition-all duration-300" 
                                 :style="{ width: uploadProgress + '%' }"></div>
                        </div>
                    </div>
                </label>
                
                <input :id="inputId"
                       ref="fileInput"
                       type="file"
                       class="hidden"
                       :accept="accept"
                       @change="handleFileSelect">
            </div>
        </div>

        <!-- Upload Controls -->
        <div v-if="selectedFile && !uploading" class="flex items-center space-x-4">
            <div class="flex-1">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Selected: {{ selectedFile.name }} ({{ formatFileSize(selectedFile.size) }})
                </p>
            </div>
            <button type="button"
                    @click="uploadFile"
                    class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded transition-colors">
                Upload
            </button>
            <button type="button"
                    @click="clearSelection"
                    class="px-3 py-1 bg-gray-500 hover:bg-gray-600 text-white text-sm rounded transition-colors">
                Cancel
            </button>
        </div>

        <!-- Error Message -->
        <div v-if="error" class="text-red-600 dark:text-red-400 text-sm">{{ error }}</div>

        <!-- Success Message -->
        <div v-if="successMessage" class="text-green-600 dark:text-green-400 text-sm">{{ successMessage }}</div>

        <!-- Image Preview -->
        <div v-if="previewUrl" class="mt-4">
            <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Preview:</p>
            <img :src="previewUrl" 
                 :alt="altText"
                 class="w-48 h-32 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
        </div>
    </div>
</template>

<script setup>
import { ref, computed, watch } from 'vue';

const props = defineProps({
    label: {
        type: String,
        default: 'Upload Image'
    },
    modelValue: {
        type: String,
        default: ''
    },
    uploadUrl: {
        type: String,
        required: true
    },
    accept: {
        type: String,
        default: 'image/jpeg,image/png,image/jpg,image/gif,image/webp'
    },
    maxSize: {
        type: Number,
        default: 5242880 // 5MB in bytes
    },
    required: {
        type: Boolean,
        default: false
    },
    altText: {
        type: String,
        default: 'Uploaded image'
    },
    currentImage: {
        type: String,
        default: ''
    }
});

const emit = defineEmits(['update:modelValue', 'uploaded', 'removed', 'error']);

// Reactive state
const fileInput = ref(null);
const selectedFile = ref(null);
const uploading = ref(false);
const uploadProgress = ref(0);
const error = ref('');
const successMessage = ref('');
const previewUrl = ref('');

// Computed properties
const inputId = computed(() => `image-upload-${Math.random().toString(36).substr(2, 9)}`);

const acceptedFormats = computed(() => {
    return props.accept.split(',').map(type => {
        return type.replace('image/', '').toUpperCase();
    }).join(', ');
});

const maxSizeMB = computed(() => {
    return Math.round(props.maxSize / (1024 * 1024));
});

// Methods
const handleFileSelect = (event) => {
    const file = event.target.files[0];
    if (!file) return;

    error.value = '';
    successMessage.value = '';

    // Validate file type
    if (!props.accept.split(',').includes(file.type)) {
        error.value = `Invalid file type. Please select ${acceptedFormats.value} files only.`;
        return;
    }

    // Validate file size
    if (file.size > props.maxSize) {
        error.value = `File size too large. Maximum size is ${maxSizeMB.value}MB.`;
        return;
    }

    selectedFile.value = file;
    
    // Create preview
    const reader = new FileReader();
    reader.onload = (e) => {
        previewUrl.value = e.target.result;
    };
    reader.readAsDataURL(file);
};

const uploadFile = async () => {
    if (!selectedFile.value) return;

    uploading.value = true;
    uploadProgress.value = 0;
    error.value = '';

    const formData = new FormData();
    formData.append('image', selectedFile.value);

    try {
        // Get CSRF token safely
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        if (!csrfToken) {
            throw new Error('CSRF token not found. Please refresh the page.');
        }

        const response = await fetch(props.uploadUrl, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        const data = await response.json();

        if (response.ok && data.success) {
            emit('update:modelValue', data.data.original);
            emit('uploaded', data.data);
            successMessage.value = data.message || 'Image uploaded successfully!';
            clearSelection();
        } else {
            throw new Error(data.error || 'Upload failed');
        }
    } catch (err) {
        error.value = err.message || 'Failed to upload image';
        emit('error', err);
    } finally {
        uploading.value = false;
        uploadProgress.value = 0;
    }
};

const clearSelection = () => {
    selectedFile.value = null;
    previewUrl.value = '';
    if (fileInput.value) {
        fileInput.value.value = '';
    }
};

const removeCurrentImage = () => {
    emit('update:modelValue', '');
    emit('removed');
    successMessage.value = 'Image removed successfully!';
};

const formatFileSize = (bytes) => {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
};

// Watch for changes
watch(() => props.currentImage, (newValue) => {
    if (newValue) {
        successMessage.value = '';
        error.value = '';
    }
});
</script>
