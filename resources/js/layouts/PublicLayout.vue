<template>
  <div class="min-h-screen flex flex-col bg-white dark:bg-gray-900 transition-colors duration-200">
    <!-- Navigation -->
    <nav class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700 sticky top-0 z-50 transition-colors duration-200">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
          <!-- Logo -->
          <div class="flex items-center">
            <Link :href="route('home')" class="flex items-center">
              <svg class="w-8 h-8 text-blue-600 dark:text-blue-400 mr-3" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
              </svg>
              <span class="text-xl font-bold text-gray-900 dark:text-white">Web Learning Hub</span>
            </Link>
          </div>

          <!-- Desktop Navigation -->
          <div class="hidden md:flex items-center space-x-8">
            <Link 
              :href="route('home')" 
              class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors font-medium"
              :class="{ 'text-blue-600 dark:text-blue-400': $page.component === 'Home' }"
            >
              Home
            </Link>
            <Link 
              :href="route('articles')" 
              class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors font-medium"
              :class="{ 'text-blue-600 dark:text-blue-400': $page.component.startsWith('Articles') }"
            >
              Artikel
            </Link>
            <Link 
              :href="route('tutorials')" 
              class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors font-medium"
              :class="{ 'text-blue-600 dark:text-blue-400': $page.component.startsWith('Tutorials') }"
            >
              Tutorial
            </Link>
            <Link 
              :href="route('categories')" 
              class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors font-medium"
              :class="{ 'text-blue-600 dark:text-blue-400': $page.component.startsWith('Categories') }"
            >
              Kategori
            </Link>
            
            <!-- Search -->
            <div class="relative">
              <input 
                type="text" 
                placeholder="Cari tutorial..."
                class="pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
              >
              <svg class="w-5 h-5 text-gray-400 dark:text-gray-500 absolute left-3 top-2.5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
              </svg>
            </div>

            <!-- Dark Mode Toggle -->
            <DarkModeToggle />
          </div>

          <!-- Mobile menu button -->
          <div class="md:hidden flex items-center space-x-2">
            <DarkModeToggle buttonClass="mr-2" />
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
              </svg>
            </button>
          </div>
        </div>

        <!-- Mobile Navigation -->
        <div v-show="mobileMenuOpen" class="md:hidden py-4 border-t border-gray-200 dark:border-gray-700">
          <div class="flex flex-col space-y-4">
            <Link :href="route('home')" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors font-medium">
              Home
            </Link>
            <Link :href="route('articles')" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors font-medium">
              Artikel
            </Link>
            <Link :href="route('tutorials')" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors font-medium">
              Tutorial
            </Link>
            <Link :href="route('categories')" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors font-medium">
              Kategori
            </Link>
            <div class="pt-2">
              <input 
                type="text" 
                placeholder="Cari tutorial..."
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400"
              >
            </div>
          </div>
        </div>
      </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1">
      <slot />
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 dark:bg-gray-950 text-white border-t border-gray-800 dark:border-gray-900">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid md:grid-cols-4 gap-8">
          <!-- About -->
          <div>
            <div class="flex items-center mb-4">
              <svg class="w-8 h-8 text-blue-400 dark:text-blue-300 mr-3" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
              </svg>
              <span class="text-xl font-bold">Web Learning Hub</span>
            </div>
            <p class="text-gray-300 dark:text-gray-400 text-sm leading-relaxed">
              Tempat belajar programming dan web development dengan tutorial yang mudah dipahami.
            </p>
          </div>

          <!-- Belajar -->
          <div>
            <h3 class="font-semibold mb-4">Belajar</h3>
            <ul class="space-y-2 text-sm text-gray-300 dark:text-gray-400">
              <li><Link :href="route('tutorials')" class="hover:text-white dark:hover:text-gray-200 transition-colors">Tutorial</Link></li>
              <li><Link :href="route('articles')" class="hover:text-white dark:hover:text-gray-200 transition-colors">Artikel</Link></li>
              <li><a href="#" class="hover:text-white dark:hover:text-gray-200 transition-colors">Buku</a></li>
              <li><a href="#" class="hover:text-white dark:hover:text-gray-200 transition-colors">Kelas</a></li>
            </ul>
          </div>

          <!-- Popular Tutorial -->
          <div>
            <h3 class="font-semibold mb-4">Popular Tutorial</h3>
            <ul class="space-y-2 text-sm text-gray-300 dark:text-gray-400">
              <li><a href="#" class="hover:text-white dark:hover:text-gray-200 transition-colors">Tutorial Bahasa C</a></li>
              <li><a href="#" class="hover:text-white dark:hover:text-gray-200 transition-colors">Tutorial Javascript</a></li>
              <li><a href="#" class="hover:text-white dark:hover:text-gray-200 transition-colors">Tutorial Java</a></li>
              <li><a href="#" class="hover:text-white dark:hover:text-gray-200 transition-colors">Tutorial PHP</a></li>
              <li><a href="#" class="hover:text-white dark:hover:text-gray-200 transition-colors">Tutorial Python</a></li>
            </ul>
          </div>

          <!-- Social Media -->
          <div>
            <h3 class="font-semibold mb-4">Social Media</h3>
            <div class="flex space-x-4">
              <a href="#" class="text-gray-300 dark:text-gray-400 hover:text-white dark:hover:text-gray-200 transition-colors">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                </svg>
              </a>
              <a href="#" class="text-gray-300 dark:text-gray-400 hover:text-white dark:hover:text-gray-200 transition-colors">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
              </a>
              <a href="#" class="text-gray-300 dark:text-gray-400 hover:text-white dark:hover:text-gray-200 transition-colors">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                </svg>
              </a>
              <a href="#" class="text-gray-300 dark:text-gray-400 hover:text-white dark:hover:text-gray-200 transition-colors">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                </svg>
              </a>
            </div>
          </div>
        </div>

        <!-- Bottom Footer -->
        <div class="border-t border-gray-800 dark:border-gray-900 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
          <p class="text-sm text-gray-400 dark:text-gray-500">
            © 2025 Web Learning Hub · Made with ❤️ using Laravel & Inertia.js
          </p>
          <div class="flex space-x-6 mt-4 md:mt-0 text-sm text-gray-400 dark:text-gray-500">
            <a href="#" class="hover:text-white dark:hover:text-gray-300 transition-colors">About</a>
            <a href="#" class="hover:text-white dark:hover:text-gray-300 transition-colors">FAQs</a>
            <a href="#" class="hover:text-white dark:hover:text-gray-300 transition-colors">Contact</a>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { ref } from 'vue'
import DarkModeToggle from '@/components/DarkModeToggle.vue'

const mobileMenuOpen = ref(false)
</script>
