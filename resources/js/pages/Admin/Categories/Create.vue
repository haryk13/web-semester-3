<template>
    <Head title="Create Category" />

    <AdminLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Create Category
                </h2>
                <Link :href="route('admin.categories.index')" 
                      class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Categories
                </Link>
            </div>
        </template>

        <div class="bg-white shadow-sm rounded-lg">
            <form @submit.prevent="submit" class="p-6 space-y-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        Category Name <span class="text-red-500">*</span>
                    </label>
                    <input v-model="form.name" 
                           id="name"
                           type="text" 
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                           :class="{ 'border-red-500': form.errors.name }"
                           required>
                    <div v-if="form.errors.name" class="text-red-600 text-sm mt-1">{{ form.errors.name }}</div>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                        Description <span class="text-red-500">*</span>
                    </label>
                    <textarea v-model="form.description" 
                              id="description"
                              rows="3"
                              class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                              :class="{ 'border-red-500': form.errors.description }"
                              placeholder="Brief description of the category..."
                              required></textarea>
                    <div v-if="form.errors.description" class="text-red-600 text-sm mt-1">{{ form.errors.description }}</div>
                </div>

                <!-- Color and Icon -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="color" class="block text-sm font-medium text-gray-700 mb-1">
                            Color <span class="text-red-500">*</span>
                        </label>
                        <select v-model="form.color" 
                                id="color"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                :class="{ 'border-red-500': form.errors.color }"
                                required>
                            <option value="">Select Color</option>
                            <option value="blue">Blue</option>
                            <option value="green">Green</option>
                            <option value="purple">Purple</option>
                            <option value="red">Red</option>
                            <option value="yellow">Yellow</option>
                            <option value="indigo">Indigo</option>
                            <option value="pink">Pink</option>
                            <option value="gray">Gray</option>
                        </select>
                        <div v-if="form.errors.color" class="text-red-600 text-sm mt-1">{{ form.errors.color }}</div>
                    </div>

                    <div>
                        <label for="icon" class="block text-sm font-medium text-gray-700 mb-1">
                            Icon <span class="text-red-500">*</span>
                        </label>
                        <select v-model="form.icon" 
                                id="icon"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                :class="{ 'border-red-500': form.errors.icon }"
                                required>
                            <option value="">Select Icon</option>
                            <option value="code">Code</option>
                            <option value="globe">Globe</option>
                            <option value="mobile">Mobile</option>
                            <option value="gamepad">Gamepad</option>
                            <option value="chart">Chart</option>
                            <option value="server">Server</option>
                            <option value="database">Database</option>
                            <option value="terminal">Terminal</option>
                        </select>
                        <div v-if="form.errors.icon" class="text-red-600 text-sm mt-1">{{ form.errors.icon }}</div>
                    </div>
                </div>

                <!-- Sort Order -->
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-1">
                        Sort Order
                    </label>
                    <input v-model="form.sort_order" 
                           id="sort_order"
                           type="number" 
                           min="0"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                           :class="{ 'border-red-500': form.errors.sort_order }"
                           placeholder="Leave empty for auto-assignment">
                    <div v-if="form.errors.sort_order" class="text-red-600 text-sm mt-1">{{ form.errors.sort_order }}</div>
                    <p class="text-sm text-gray-500 mt-1">Categories with lower numbers appear first.</p>
                </div>

                <!-- Active Status -->
                <div>
                    <label class="flex items-center">
                        <input v-model="form.is_active" 
                               type="checkbox" 
                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-700">Active category</span>
                    </label>
                    <p class="text-sm text-gray-500 mt-1">Only active categories will be visible on the public site.</p>
                </div>

                <!-- Preview -->
                <div v-if="form.color && form.icon" class="border border-gray-200 rounded-lg p-4">
                    <h4 class="text-sm font-medium text-gray-700 mb-2">Preview</h4>
                    <div class="flex items-center space-x-3">
                        <div :class="`w-10 h-10 rounded-lg bg-${form.color}-100 flex items-center justify-center`">
                            <svg class="w-5 h-5" :class="`text-${form.color}-600`" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ form.name || 'Category Name' }}</h3>
                            <p class="text-sm text-gray-500">{{ form.description || 'Category description' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <Link :href="route('admin.categories.index')" 
                          class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-150">
                        Cancel
                    </Link>
                    <button type="submit" 
                            :disabled="form.processing"
                            class="px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 disabled:opacity-25 transition duration-150">
                        <span v-if="form.processing">Creating...</span>
                        <span v-else>Create Category</span>
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/layouts/AdminLayout.vue';

const form = useForm({
    name: '',
    description: '',
    color: '',
    icon: '',
    sort_order: '',
    is_active: true,
});

const submit = () => {
    form.post(route('admin.categories.store'));
};
</script>
