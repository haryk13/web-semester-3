<template>
  <PublicLayout>
    <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <section class="bg-white border-b">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center">
          <h1 class="text-4xl font-bold text-gray-900 mb-4">
            {{ category.name }}
          </h1>
          <p class="text-xl text-gray-600">
            {{ category.description }}
          </p>
        </div>
      </div>
    </section>

    <!-- Articles -->
    <section class="py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
          <h2 class="text-2xl font-bold text-gray-900 mb-4">
            Tutorial dalam kategori ini
          </h2>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
          <article v-for="article in category.articles" :key="article.id" 
                   class="bg-white rounded-lg shadow-sm border p-6 hover:shadow-md transition-shadow group">
            
            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">
              <Link :href="route('article', article.slug)">
                {{ article.title }}
              </Link>
            </h3>
            
            <p class="text-gray-600 mb-4 leading-relaxed">
              {{ article.excerpt }}
            </p>
            
            <div class="flex items-center justify-between">
              <span class="text-sm text-gray-500">
                {{ article.date }}
              </span>
              
              <Link 
                :href="route('article', article.slug)" 
                class="text-blue-600 font-semibold hover:text-blue-700 transition-colors flex items-center"
              >
                Baca
                <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/>
                </svg>
              </Link>
            </div>
          </article>
        </div>

        <!-- Back to Categories -->
        <div class="mt-12">
          <Link 
            :href="route('categories')" 
            class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-700 transition-colors"
          >
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
              <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
            </svg>
            Kembali ke Kategori
          </Link>
        </div>
      </div>
    </section>
    </div>
  </PublicLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import PublicLayout from '@/layouts/PublicLayout.vue'

defineProps({
  category: Object
})
</script>
