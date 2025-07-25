<template>
  <PublicLayout>
    <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <section class="bg-white border-b">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center">
          <h1 class="text-4xl font-bold text-gray-900 mb-4">
            Semua Kategori
          </h1>
          <p class="text-xl text-gray-600">
            Jelajahi tutorial berdasarkan kategori yang kamu minati
          </p>
        </div>
      </div>
    </section>

    <!-- Categories Grid -->
    <section class="py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          <div v-for="category in categories" :key="category.id" 
               class="bg-white rounded-xl p-8 shadow-sm border hover:shadow-md transition-shadow group">
            
            <!-- Icon -->
            <div :class="`w-16 h-16 bg-${category.color}-100 rounded-lg flex items-center justify-center mb-6`">
              <svg v-if="category.icon === 'code'" class="w-8 h-8" :class="`text-${category.color}-600`" fill="currentColor" viewBox="0 0 24 24">
                <path d="M8.5 6.5l-3 3 3 3m7-6l3 3-3 3M10 4l4 16"/>
              </svg>
              <svg v-else-if="category.icon === 'globe'" class="w-8 h-8" :class="`text-${category.color}-600`" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.94-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
              </svg>
              <svg v-else-if="category.icon === 'mobile'" class="w-8 h-8" :class="`text-${category.color}-600`" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17 2H7c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H7V6h10v10z"/>
              </svg>
              <svg v-else-if="category.icon === 'gamepad'" class="w-8 h-8" :class="`text-${category.color}-600`" fill="currentColor" viewBox="0 0 24 24">
                <path d="M15,7.5V2H9V7.5L3,13.5C3,17.09 5.91,20 9.5,20S16,17.09 16,13.5L15,7.5M7,9A1,1 0 0,0 6,10A1,1 0 0,0 7,11A1,1 0 0,0 8,10A1,1 0 0,0 7,9M17,9A1,1 0 0,0 16,10A1,1 0 0,0 17,11A1,1 0 0,0 18,10A1,1 0 0,0 17,9Z"/>
              </svg>
              <svg v-else-if="category.icon === 'chart'" class="w-8 h-8" :class="`text-${category.color}-600`" fill="currentColor" viewBox="0 0 24 24">
                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/>
              </svg>
              <svg v-else-if="category.icon === 'server'" class="w-8 h-8" :class="`text-${category.color}-600`" fill="currentColor" viewBox="0 0 24 24">
                <path d="M4 1h16c1.1 0 2 .9 2 2v6c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V3c0-1.1.9-2 2-2zm0 8h16c1.1 0 2 .9 2 2v6c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2v-6c0-1.1.9-2 2-2z"/>
              </svg>
              <svg v-else class="w-8 h-8" :class="`text-${category.color}-600`" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
              </svg>
            </div>
            
            <!-- Content -->
            <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">
              {{ category.name }}
            </h3>
            
            <p class="text-gray-600 mb-6 leading-relaxed">
              {{ category.description }}
            </p>
            
            <div class="flex items-center justify-between">
              <span class="text-sm text-gray-500">
                {{ category.article_count }} artikel
              </span>
              
              <Link 
                :href="route('category', category.slug)" 
                :class="`text-${category.color}-600 font-semibold hover:text-${category.color}-700 transition-colors flex items-center`"
              >
                Jelajahi
                <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/>
                </svg>
              </Link>
            </div>
          </div>
        </div>
      </div>
    </section>
    </div>
  </PublicLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import PublicLayout from '@/layouts/PublicLayout.vue'

const props = defineProps({
  categories: Array
})
</script>
