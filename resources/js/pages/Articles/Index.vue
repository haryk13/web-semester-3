<template>
  <PublicLayout>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
    <!-- Header -->
    <section class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 transition-colors duration-200">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center">
          <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">
            Semua Artikel
          </h1>
          <p class="text-xl text-gray-600 dark:text-gray-400">
            Kumpulan artikel dan tutorial programming terbaru
          </p>
        </div>
      </div>
    </section>

    <!-- Articles Grid -->
    <section class="py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Debug Info (remove in production) -->
        <div v-if="!articles || articles.length === 0" class="text-center py-16">
          <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-8 max-w-md mx-auto">
            <svg class="w-12 h-12 text-yellow-600 dark:text-yellow-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.732 15.5c-.77.833.192 2.5 1.732 2.5z"></path>
            </svg>
            <h3 class="text-lg font-semibold text-yellow-800 dark:text-yellow-200 mb-2">Tidak ada artikel</h3>
            <p class="text-yellow-700 dark:text-yellow-300">Belum ada artikel yang dipublikasikan.</p>
          </div>
        </div>

        <div v-else class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          <article v-for="article in articles.data || articles" :key="article.id" class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-md transition-all duration-200 group">
            <div class="relative overflow-hidden">
              <img 
                :src="article.image || '/images/placeholder.jpg'" 
                :alt="article.title"
                class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
              >
              <div class="absolute top-4 left-4">
                <span class="bg-blue-600 dark:bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                  {{ article.category }}
                </span>
              </div>
            </div>
            
            <div class="p-6">
              <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                <Link :href="route('article', article.slug)">
                  {{ article.title }}
                </Link>
              </h3>
              
              <p class="text-gray-600 dark:text-gray-400 mb-4 leading-relaxed">
                {{ article.excerpt }}
              </p>
              
              <div class="flex items-center justify-between">
                <div class="flex items-center text-sm text-gray-500 dark:text-gray-500">
                  <span>{{ article.date }}</span>
                  <span class="mx-2">•</span>
                  <span>{{ article.author }}</span>
                </div>
                
                <div class="flex flex-wrap gap-1">
                  <span v-for="tag in article.tags?.slice(0, 2)" :key="tag" 
                        class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 px-2 py-1 rounded text-xs">
                    {{ tag }}
                  </span>
                </div>
              </div>
            </div>
          </article>
        </div>

        <!-- Pagination -->
        <div v-if="articles?.links" class="mt-12 flex justify-center">
          <nav class="flex items-center space-x-2">
            <button 
              v-for="link in articles.links" 
              :key="link.label"
              v-html="link.label"
              @click="link.url && $inertia.get(link.url)"
              :disabled="!link.url"
              :class="[
                'px-3 py-2 text-sm rounded transition-colors',
                link.active 
                  ? 'bg-blue-600 text-white' 
                  : link.url 
                    ? 'text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700' 
                    : 'text-gray-400 dark:text-gray-600 cursor-not-allowed'
              ]"
            >
            </button>
          </nav>
        </div>
        
        <!-- Simple pagination fallback -->
        <div v-else-if="articles?.data && articles.data.length > 0" class="mt-12 flex justify-center">
          <nav class="flex items-center space-x-2">
            <button class="px-3 py-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 transition-colors">
              Previous
            </button>
            
            <button class="px-3 py-2 bg-blue-600 text-white rounded">
              1
            </button>
            <button class="px-3 py-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">
              2
            </button>
            <button class="px-3 py-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">
              3
            </button>
            
            <button class="px-3 py-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 transition-colors">
              Next
            </button>
          </nav>
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
  articles: {
    type: [Array, Object],
    default: () => []
  }
})

// Debug: Log the articles prop to console
console.log('Articles data:', props.articles)
</script>
