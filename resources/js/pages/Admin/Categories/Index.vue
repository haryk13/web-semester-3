<template>
    <Head title="Categories Management" />

    <AdminLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Categories Management
                </h2>
                <Link :href="route('admin.categories.create')" 
                      class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    New Category
                </Link>
            </div>
        </template>

        <div class="bg-white shadow-sm rounded-lg">
            <!-- Search -->
            <div class="p-6 border-b border-gray-200">
                <form @submit.prevent="search" class="flex space-x-4">
                    <div class="flex-1">
                        <input v-model="form.search" 
                               type="text" 
                               placeholder="Search categories..."
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-150">
                        Search
                    </button>
                    <Link :href="route('admin.categories.index')" 
                          class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition duration-150">
                        Clear
                    </Link>
                </form>
            </div>

            <!-- Categories Grid -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div v-for="category in categories.data" :key="category.id" 
                         class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition duration-150">
                        <!-- Category Header -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div :class="`w-10 h-10 rounded-lg bg-${category.color}-100 flex items-center justify-center`">
                                    <svg class="w-5 h-5" :class="`text-${category.color}-600`" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">{{ category.name }}</h3>
                                    <p class="text-sm text-gray-500">{{ category.articles_count }} articles</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-1">
                                <span v-if="category.is_active" 
                                      class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Active
                                </span>
                                <span v-else 
                                      class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    Inactive
                                </span>
                            </div>
                        </div>

                        <!-- Description -->
                        <p class="text-gray-600 text-sm mb-4">{{ category.description }}</p>

                        <!-- Sort Order -->
                        <div class="text-xs text-gray-500 mb-4">
                            Sort Order: {{ category.sort_order }}
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                            <Link :href="route('admin.categories.show', category.id)" 
                                  class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                                View Details
                            </Link>
                            <div class="flex items-center space-x-2">
                                <Link :href="route('admin.categories.edit', category.id)" 
                                      class="text-indigo-600 hover:text-indigo-900 text-sm">
                                    Edit
                                </Link>
                                <button @click="deleteCategory(category)" 
                                        class="text-red-600 hover:text-red-900 text-sm">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Empty State -->
                <div v-if="categories.data.length === 0" class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No categories found</h3>
                    <p class="mt-1 text-sm text-gray-500">Get started by creating a new category.</p>
                    <div class="mt-6">
                        <Link :href="route('admin.categories.create')" 
                              class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            New Category
                        </Link>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div v-if="categories.links.length > 3" class="px-6 py-4 border-t border-gray-200">
                <nav class="flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Showing {{ categories.from }} to {{ categories.to }} of {{ categories.total }} results
                    </div>
                    <div class="flex space-x-1">
                        <Link v-for="link in categories.links" 
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
    categories: Object,
    filters: Object,
});

const form = reactive({
    search: props.filters.search || '',
});

const search = () => {
    router.get(route('admin.categories.index'), form, {
        preserveState: true,
        replace: true,
    });
};

const deleteCategory = (category) => {
    if (confirm(`Are you sure you want to delete "${category.name}"?`)) {
        router.delete(route('admin.categories.destroy', category.id));
    }
};
</script>
