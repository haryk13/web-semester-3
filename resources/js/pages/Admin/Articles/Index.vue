<template>
    <Head title="Articles Management" />

    <AdminLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Articles Management
                </h2>
                <Link :href="route('admin.articles.create')" 
                      class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    New Article
                </Link>
            </div>
        </template>

        <div class="bg-white shadow-sm rounded-lg">
            <!-- Filters -->
            <div class="p-6 border-b border-gray-200">
                <form @submit.prevent="search" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                        <input v-model="form.search" 
                               type="text" 
                               placeholder="Search articles..."
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <select v-model="form.category" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">All Categories</option>
                            <option v-for="category in categories" :key="category.id" :value="category.id">
                                {{ category.name }}
                            </option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select v-model="form.status" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">All Status</option>
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                    
                    <div class="flex items-end space-x-2">
                        <button type="submit" 
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-150">
                            Filter
                        </button>
                        <Link :href="route('admin.articles.index')" 
                              class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition duration-150">
                            Clear
                        </Link>
                    </div>
                </form>
            </div>

            <!-- Articles Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Article
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Category
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Stats
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tags
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="article in articles.data" :key="article.id" class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ article.title }}</div>
                                    <div class="text-sm text-gray-500 mt-1">{{ article.excerpt }}</div>
                                    <div class="text-xs text-gray-400 mt-1">By {{ article.author }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ article.category }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span v-if="article.is_published" 
                                      class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Published
                                </span>
                                <span v-else 
                                      class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    Draft
                                </span>
                                <div v-if="article.published_at" class="text-xs text-gray-500 mt-1">
                                    {{ article.published_at }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div>{{ article.views_count }} views</div>
                                <div class="text-xs text-gray-500">{{ article.reading_time }} min read</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">{{ article.tags }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <Link :href="route('admin.articles.show', article.id)" 
                                          class="text-blue-600 hover:text-blue-900">
                                        View
                                    </Link>
                                    <Link :href="route('admin.articles.edit', article.id)" 
                                          class="text-indigo-600 hover:text-indigo-900">
                                        Edit
                                    </Link>
                                    <button @click="deleteArticle(article)" 
                                            class="text-red-600 hover:text-red-900">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div v-if="articles.links.length > 3" class="px-6 py-4 border-t border-gray-200">
                <nav class="flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Showing {{ articles.from }} to {{ articles.to }} of {{ articles.total }} results
                    </div>
                    <div class="flex space-x-1">
                        <Link v-for="link in articles.links" 
                              :key="link.label"
                              :href="link.url"
                              :class="[
                                  'px-3 py-2 text-sm rounded-md',
                                  link.active 
                                      ? 'bg-blue-600 text-white' 
                                      : 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-300'
                              ]"
                              :disabled="!link.url">
                            {{ link.label }}
                        </Link>
                    </div>
                </nav>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import { reactive } from 'vue';
import AdminLayout from '@/layouts/AdminLayout.vue';

const props = defineProps({
    articles: Object,
    categories: Array,
    filters: Object,
});

const form = reactive({
    search: props.filters.search || '',
    category: props.filters.category || '',
    status: props.filters.status || '',
});

const search = () => {
    router.get(route('admin.articles.index'), form, {
        preserveState: true,
        replace: true,
    });
};

const deleteArticle = (article) => {
    if (confirm(`Are you sure you want to delete "${article.title}"?`)) {
        router.delete(route('admin.articles.destroy', article.id));
    }
};
</script>
