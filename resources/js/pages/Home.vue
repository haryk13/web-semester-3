<template>
  <PublicLayout>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
      <!-- Hero Section -->
      <section class="bg-white dark:bg-gray-800 transition-colors duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
          <div class="text-center">
            <div class="mb-8">
              <svg class="w-32 h-32 mx-auto text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
              </svg>
            </div>
            <h1 class="text-5xl font-bold text-gray-900 dark:text-white mb-4">
              Web Learning Hub
            </h1>
            <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-2xl mx-auto">
              Belajar programming dan web development dengan tutorial yang mudah dipahami. 
              Dari basic hingga advanced level.
            </p>
            
            <!-- Authentication Section for Non-Authenticated Users -->
            <div v-if="!page.props.auth.user" class="mb-8">
              <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-700 dark:to-gray-600 rounded-2xl p-8 max-w-4xl mx-auto border border-blue-100 dark:border-gray-600">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                  🚀 Mulai Perjalanan Coding-mu!
                </h2>
                <p class="text-gray-600 dark:text-gray-300 mb-6">
                  Daftar sekarang untuk mengakses semua tutorial premium, track progress belajar, dan bergabung dengan komunitas developer Indonesia.
                </p>
                
                <!-- Auth Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                  <Link
                    :href="route('register')"
                    class="group w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 text-base font-semibold text-white bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105"
                  >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    Daftar Gratis
                    <svg class="w-4 h-4 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                  </Link>
                  
                  <Link
                    :href="route('login')"
                    class="group w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 text-base font-semibold text-blue-600 dark:text-blue-400 bg-white dark:bg-gray-800 border-2 border-blue-200 dark:border-blue-600 hover:border-blue-300 dark:hover:border-blue-500 rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105"
                  >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    Sudah Punya Akun? Login
                  </Link>
                </div>
                
                <!-- Benefits Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">
                  <div class="text-center">
                    <div class="w-10 h-10 mx-auto mb-2 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center">
                      <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                      </svg>
                    </div>
                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300">100% Gratis</p>
                  </div>
                  <div class="text-center">
                    <div class="w-10 h-10 mx-auto mb-2 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                      <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                      </svg>
                    </div>
                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Tutorial Premium</p>
                  </div>
                  <div class="text-center">
                    <div class="w-10 h-10 mx-auto mb-2 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center">
                      <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                      </svg>
                    </div>
                    <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Komunitas Developer</p>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Welcome Back Section for Authenticated Users -->
            <div v-else class="mb-8">
              <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-gray-700 dark:to-gray-600 rounded-2xl p-6 max-w-2xl mx-auto border border-green-100 dark:border-gray-600">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">
                  👋 Selamat datang kembali, {{ page.props.auth.user.name }}!
                </h2>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                  Siap melanjutkan perjalanan coding hari ini?
                </p>
                <Link
                  :href="route('dashboard')"
                  class="inline-flex items-center text-green-600 dark:text-green-400 font-semibold hover:text-green-700 dark:hover:text-green-300 transition-colors"
                >
                  Lanjut ke Dashboard
                  <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </Link>
              </div>
            </div>
            
            <div class="flex justify-center space-x-4">
              <Link 
                :href="route('tutorials')" 
                class="bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white px-8 py-3 rounded-lg text-lg font-semibold transition-colors"
              >
                Mulai Belajar
              </Link>
              <button class="border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 px-8 py-3 rounded-lg text-lg font-semibold hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                Join Newsletter
              </button>
            </div>
          </div>
        </div>
      </section>

    <!-- Categories Section -->
    <section class="py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
            Mau belajar apa hari ini?
          </h2>
          <p class="text-gray-600 dark:text-gray-400">
            Temukan tutorial berdasarkan minatmu.
          </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
          <!-- Basic Programming -->
          <div class="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-all duration-200">
            <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mb-6">
              <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                <path d="M8.5 6.5l-3 3 3 3m7-6l3 3-3 3M10 4l4 16"/>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Basic Programming</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
              Baca tutorial dasar-dasar pemrograman menggunakan C, C++, C#, 
              Java, Javascript, dan masih banyak lagi.
            </p>
            <Link 
              :href="route('category', 'pemrograman')" 
              class="text-blue-600 dark:text-blue-400 font-semibold hover:text-blue-700 dark:hover:text-blue-300 transition-colors"
            >
              Pelajari →
            </Link>
          </div>

          <!-- Web Programming -->
          <div class="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-all duration-200">
            <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center mb-6">
              <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 24 24">
                <path d="M3 3h18v18H3V3zm16 16V5H5v14h14zM11 7h2v2h-2V7zm0 4h2v2h-2v-2zm0 4h2v2h-2v-2zM7 7h2v2H7V7zm0 4h2v2H7v-2zm0 4h2v2H7v-2zm8-8h2v2h-2V7zm0 4h2v2h-2v-2zm0 4h2v2h-2v-2z"/>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Web Programming</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
              Baca tutorial cara membuat web. Mulai dari HTML, CSS, JS, PHP, 
              MySQL, Codeigniter, React, dan masih banyak lagi.
            </p>
            <Link 
              :href="route('category', 'web')" 
              class="text-green-600 dark:text-green-400 font-semibold hover:text-green-700 dark:hover:text-green-300 transition-colors"
            >
              Pelajari →
            </Link>
          </div>

          <!-- Tutorial Lainnya -->
          <div class="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-all duration-200">
            <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center mb-6">
              <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Tutorial Lainnya</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4">
              Baca tutorial dalam kategori lainnya seperti Mobile programming, 
              Game programming, IoT, Blockchain, dan masih banyak lagi.
            </p>
            <Link 
              :href="route('categories')" 
              class="text-purple-600 dark:text-purple-400 font-semibold hover:text-purple-700 dark:hover:text-purple-300 transition-colors"
            >
              Pelajari →
            </Link>
          </div>
        </div>
      </div>
    </section>

    <!-- Latest Articles Section -->
    <section class="py-16 bg-white dark:bg-gray-800 transition-colors duration-200">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
            Apa yang baru di Web Learning Hub? 🔥
          </h2>
          <p class="text-gray-600 dark:text-gray-400">
            Baca artikel terbaru yang masih fresh dan hangat.
          </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          <!-- Sample Article Cards -->
          <article v-for="article in latestArticles" :key="article.id" class="group">
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg overflow-hidden mb-4">
              <img 
                :src="article.image" 
                :alt="article.title"
                class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
              >
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
              <Link :href="route('article', article.slug)">
                {{ article.title }}
              </Link>
            </h3>
            <p class="text-gray-600 dark:text-gray-400 mb-4 leading-relaxed">
              {{ article.excerpt }}
            </p>
            <div class="flex items-center text-sm text-gray-500 dark:text-gray-500">
              <span>{{ article.date }}</span>
              <span class="mx-2">•</span>
              <span>{{ article.category }}</span>
            </div>
          </article>
        </div>

        <div class="text-center mt-12">
          <Link 
            :href="route('articles')" 
            class="inline-flex items-center text-blue-600 dark:text-blue-400 font-semibold hover:text-blue-700 dark:hover:text-blue-300 transition-colors"
          >
            Lihat Semua Artikel
            <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z"/>
            </svg>
          </Link>
        </div>
      </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-16 bg-blue-600 dark:bg-blue-700 transition-colors duration-200">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">
          Biar gak ketinggalan update..
        </h2>
        <p class="text-blue-100 dark:text-blue-200 mb-8 text-lg">
          Subscribe Newsletter Web Learning Hub agar kamu bisa dapat info dan tips belajar 
          coding langsung dikirim ke emailmu?
        </p>
        <div class="max-w-md mx-auto flex">
          <input 
            type="email" 
            placeholder="Masukkan email kamu..."
            class="flex-1 px-4 py-3 rounded-l-lg border-0 focus:ring-2 focus:ring-blue-300 focus:outline-none bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
          >
          <button class="bg-white dark:bg-gray-200 text-blue-600 dark:text-blue-700 px-6 py-3 rounded-r-lg font-semibold hover:bg-gray-50 dark:hover:bg-gray-300 transition-colors">
            Subscribe
          </button>
        </div>
      </div>
    </section>
    </div>
  </PublicLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3'
import PublicLayout from '@/layouts/PublicLayout.vue'

// Receive data from controller
const props = defineProps({
  latestArticles: Array,
  testimonials: Array
})

// Get user authentication status
const page = usePage()
</script>
