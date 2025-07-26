<template>
    <Head title="Tags Management" />

    <AdminLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Tags Management
                </h2>
                <Link :href="route('admin.tags.create')" 
                      class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    New Tag
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
                               placeholder="Search tags..."
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-150">
                        Search
                    </button>
                    <Link :href="route('admin.tags.index')" 
                          class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition duration-150">
                        Clear
                    </Link>
                </form>
            </div>

            <!-- Tags Grid -->
            <div class="p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                    <div v-for="tag in tags.data" :key="tag.id" 
                         class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition duration-150">
                        <!-- Tag -->
                        <div class="flex items-center justify-between mb-3">
                            <span :class="`inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-${tag.color}-100 text-${tag.color}-800`">
                                {{ tag.name }}
                            </span>
                        </div>

                        <!-- Stats -->
                        <div class="text-sm text-gray-500 mb-3">
                            {{ tag.articles_count }} articles
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-between pt-3 border-t border-gray-200">
                            <Link :href="route('admin.tags.edit', tag.id)" 
                                  class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                                Edit
                            </Link>
                            <button @click="deleteTag(tag)" 
                                    class="text-red-600 hover:text-red-900 text-sm font-medium">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Empty State -->
                <div v-if="tags.data.length === 0" class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No tags found</h3>
                    <p class="mt-1 text-sm text-gray-500">Get started by creating a new tag.</p>
                    <div class="mt-6">
                        <Link :href="route('admin.tags.create')" 
                              class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            New Tag
                        </Link>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div v-if="tags.links.length > 3" class="px-6 py-4 border-t border-gray-200">
                <nav class="flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Showing {{ tags.from }} to {{ tags.to }} of {{ tags.total }} results
                    </div>
                    <div class="flex space-x-1">
                        <Link v-for="link in tags.links" 
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
    tags: Object,
    filters: Object,
});

const form = reactive({
    search: props.filters.search || '',
});

const search = () => {
    router.get(route('admin.tags.index'), form, {
        preserveState: true,
        replace: true,
    });
};

const deleteTag = (tag) => {
    if (confirm(`Are you sure you want to delete "${tag.name}"?`)) {
        router.delete(route('admin.tags.destroy', tag.id));
    }
};
</script>
