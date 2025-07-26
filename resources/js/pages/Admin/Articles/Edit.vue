<template>
    <Head title="Edit Article" />

    <AdminLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Edit Article: {{ article.title }}
                </h2>
                <div class="flex space-x-3">
                    <Link :href="route('admin.articles.show', article.id)" 
                          class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        View
                    </Link>
                    <Link :href="route('admin.articles.index')" 
                          class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Articles
                    </Link>
                </div>
            </div>
        </template>

        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
            <form @submit.prevent="submit" class="p-6 space-y-6">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Title <span class="text-red-500">*</span>
                    </label>
                    <input v-model="form.title" 
                           id="title"
                           type="text" 
                           class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                           :class="{ 'border-red-500': form.errors.title }"
                           required>
                    <div v-if="form.errors.title" class="text-red-600 dark:text-red-400 text-sm mt-1">{{ form.errors.title }}</div>
                </div>

                <!-- Excerpt -->
                <div>
                    <label for="excerpt" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Excerpt <span class="text-red-500">*</span>
                    </label>
                    <textarea v-model="form.excerpt" 
                              id="excerpt"
                              rows="3"
                              class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                              :class="{ 'border-red-500': form.errors.excerpt }"
                              placeholder="Brief description of the article..."
                              required></textarea>
                    <div v-if="form.errors.excerpt" class="text-red-600 dark:text-red-400 text-sm mt-1">{{ form.errors.excerpt }}</div>
                </div>

                <!-- Category and Reading Time -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Category <span class="text-red-500">*</span>
                        </label>
                        <select v-model="form.category_id" 
                                id="category_id"
                                class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                :class="{ 'border-red-500': form.errors.category_id }"
                                required>
                            <option value="">Select Category</option>
                            <option v-for="category in categories" :key="category.id" :value="category.id">
                                {{ category.name }}
                            </option>
                        </select>
                        <div v-if="form.errors.category_id" class="text-red-600 dark:text-red-400 text-sm mt-1">{{ form.errors.category_id }}</div>
                    </div>

                    <div>
                        <label for="reading_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Reading Time (minutes)
                        </label>
                        <input v-model="form.reading_time" 
                               id="reading_time"
                               type="number" 
                               min="1"
                               class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               :class="{ 'border-red-500': form.errors.reading_time }">
                        <div v-if="form.errors.reading_time" class="text-red-600 dark:text-red-400 text-sm mt-1">{{ form.errors.reading_time }}</div>
                    </div>
                </div>

                <!-- Featured Image -->
                <ImageUpload v-model="form.image"
                            label="Featured Image"
                            :upload-url="route('admin.upload.article-image')"
                            :current-image="article.image"
                            alt-text="Article featured image"
                            @uploaded="onImageUploaded"
                            @removed="onImageRemoved"
                            @error="onImageError">
                    <!-- Hidden field to track current image -->
                    <input type="hidden" :value="article.image" name="current_image">
                </ImageUpload>

                <!-- Tags -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Tags
                    </label>
                    <div class="space-y-2">
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2">
                            <label v-for="tag in tags" :key="tag.id" class="flex items-center">
                                <input v-model="form.tags" 
                                       :value="tag.id"
                                       type="checkbox" 
                                       class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">{{ tag.name }}</span>
                            </label>
                        </div>
                    </div>
                    <div v-if="form.errors.tags" class="text-red-600 dark:text-red-400 text-sm mt-1">{{ form.errors.tags }}</div>
                </div>

                <!-- Content -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Content <span class="text-red-500">*</span>
                    </label>
                    <textarea v-model="form.content" 
                              id="content"
                              rows="20"
                              class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500"
                              :class="{ 'border-red-500': form.errors.content }"
                              placeholder="Write your article content here... You can use HTML tags."
                              required></textarea>
                    <div v-if="form.errors.content" class="text-red-600 dark:text-red-400 text-sm mt-1">{{ form.errors.content }}</div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">You can use HTML tags for formatting.</p>
                </div>

                <!-- Published Status -->
                <div>
                    <label class="flex items-center">
                        <input v-model="form.is_published" 
                               type="checkbox" 
                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Publish article</span>
                    </label>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Current status: <span class="font-medium">{{ article.is_published ? 'Published' : 'Draft' }}</span>
                    </p>
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-600">
                    <Link :href="route('admin.articles.index')" 
                          class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150">
                        Cancel
                    </Link>
                    <button type="submit" 
                            :disabled="form.processing"
                            class="px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 disabled:opacity-25 transition duration-150">
                        <span v-if="form.processing">Updating...</span>
                        <span v-else>Update Article</span>
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';
import ImageUpload from '@/Components/ImageUpload.vue';

const props = defineProps({
    article: Object,
    categories: Array,
    tags: Array,
});

const form = useForm({
    title: props.article.title,
    excerpt: props.article.excerpt,
    content: props.article.content,
    category_id: props.article.category_id,
    image: props.article.image,
    reading_time: props.article.reading_time,
    tags: props.article.tags || [],
    is_published: props.article.is_published,
    current_image: props.article.image,
    remove_image: false,
});

const submit = () => {
    form.put(route('admin.articles.update', props.article.id));
};

const onImageUploaded = (imageData) => {
    form.image = imageData.original;
    form.current_image = imageData.original;
    form.remove_image = false;
};

const onImageRemoved = () => {
    form.remove_image = true;
    form.image = '';
};

const onImageError = (error) => {
    console.error('Image upload error:', error);
};
</script>
