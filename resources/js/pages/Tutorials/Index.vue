<template>
  <PublicLayout>
    <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <section class="bg-white border-b">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center">
          <h1 class="text-4xl font-bold text-gray-900 mb-4">
            Tutorial Programming
          </h1>
          <p class="text-xl text-gray-600">
            Koleksi tutorial lengkap berbagai bahasa pemrograman
          </p>
        </div>
      </div>
    </section>

    <!-- Tutorial Categories -->
    <section class="py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          <div v-for="tutorialCategory in categories" :key="tutorialCategory.id" 
               class="bg-white rounded-xl p-8 shadow-sm border hover:shadow-md transition-shadow group">
            
            <!-- Language Icon/Logo -->
            <div :class="`w-16 h-16 bg-${tutorialCategory.color}-100 rounded-lg flex items-center justify-center mb-6`">
              <div class="text-2xl font-bold" :class="`text-${tutorialCategory.color}-600`">
                {{ tutorialCategory.name.charAt(0) }}
              </div>
            </div>
            
            <!-- Content -->
            <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">
              Tutorial {{ tutorialCategory.name }}
            </h3>
            
            <p class="text-gray-600 mb-6 leading-relaxed">
              {{ tutorialCategory.description }}
            </p>
            
            <div class="flex items-center justify-between">
              <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-500">
                  {{ tutorialCategory.tutorial_count }} tutorial
                </span>
                <span :class="`bg-${tutorialCategory.color}-100 text-${tutorialCategory.color}-800 px-2 py-1 rounded-full text-xs font-semibold`">
                  {{ tutorialCategory.name }}
                </span>
              </div>
            </div>
            
            <div class="mt-6">
              <button 
                :class="`w-full bg-${tutorialCategory.color}-600 text-white py-3 rounded-lg font-semibold hover:bg-${tutorialCategory.color}-700 transition-colors`"
              >
                Mulai Belajar
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Featured Tutorials -->
    <section class="py-16 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold text-gray-900 mb-4">
            Tutorial Populer
          </h2>
          <p class="text-gray-600">
            Tutorial yang paling banyak dibaca dan dipelajari
          </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          <!-- Sample popular tutorials -->
          <div class="group">
            <div class="bg-gray-100 rounded-lg p-6 mb-4">
              <div class="flex items-center mb-3">
                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                  <span class="text-blue-600 font-bold text-sm">C</span>
                </div>
                <span class="text-blue-600 font-semibold">Bahasa C</span>
              </div>
              <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">
                Belajar C #01: Pengenalan Bahasa C
              </h3>
              <p class="text-gray-600 text-sm">
                Tutorial dasar untuk memahami bahasa pemrograman C
              </p>
            </div>
          </div>

          <div class="group">
            <div class="bg-gray-100 rounded-lg p-6 mb-4">
              <div class="flex items-center mb-3">
                <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                  <span class="text-yellow-600 font-bold text-sm">JS</span>
                </div>
                <span class="text-yellow-600 font-semibold">JavaScript</span>
              </div>
              <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">
                JavaScript Dasar untuk Pemula
              </h3>
              <p class="text-gray-600 text-sm">
                Memahami konsep dasar JavaScript dari nol
              </p>
            </div>
          </div>

          <div class="group">
            <div class="bg-gray-100 rounded-lg p-6 mb-4">
              <div class="flex items-center mb-3">
                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                  <span class="text-green-600 font-bold text-sm">Py</span>
                </div>
                <span class="text-green-600 font-semibold">Python</span>
              </div>
              <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">
                Python untuk Data Science
              </h3>
              <p class="text-gray-600 text-sm">
                Belajar Python khusus untuk analisis data
              </p>
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
