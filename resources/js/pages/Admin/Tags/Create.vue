<template>
    <Head title="Create Tag" />

    <AdminLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Create Tag
                </h2>
                <Link :href="route('admin.tags.index')" 
                      class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Tags
                </Link>
            </div>
        </template>

        <div class="bg-white shadow-sm rounded-lg">
            <form @submit.prevent="submit" class="p-6 space-y-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        Tag Name <span class="text-red-500">*</span>
                    </label>
                    <input v-model="form.name" 
                           id="name"
                           type="text" 
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                           :class="{ 'border-red-500': form.errors.name }"
                           required>
                    <div v-if="form.errors.name" class="text-red-600 text-sm mt-1">{{ form.errors.name }}</div>
                    <p class="text-sm text-gray-500 mt-1">Use clear, descriptive names like "Laravel", "JavaScript", etc.</p>
                </div>

                <!-- Color -->
                <div>
                    <label for="color" class="block text-sm font-medium text-gray-700 mb-1">
                        Color
                    </label>
                    <select v-model="form.color" 
                            id="color"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            :class="{ 'border-red-500': form.errors.color }">
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

                <!-- Preview -->
                <div v-if="form.name" class="border border-gray-200 rounded-lg p-4">
                    <h4 class="text-sm font-medium text-gray-700 mb-2">Preview</h4>
                    <span :class="`inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-${form.color}-100 text-${form.color}-800`">
                        {{ form.name }}
                    </span>
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <Link :href="route('admin.tags.index')" 
                          class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 transition duration-150">
                        Cancel
                    </Link>
                    <button type="submit" 
                            :disabled="form.processing"
                            class="px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 disabled:opacity-25 transition duration-150">
                        <span v-if="form.processing">Creating...</span>
                        <span v-else>Create Tag</span>
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
    color: 'blue',
});

const submit = () => {
    form.post(route('admin.tags.store'));
};
</script>
