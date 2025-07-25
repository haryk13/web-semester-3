import '../css/app.css';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import type { DefineComponent } from 'vue';
import { createApp, h } from 'vue';
import { ZiggyVue } from 'ziggy-js';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

// Initialize dark mode on page load
const initializeDarkMode = () => {
  // Check localStorage first
  const stored = localStorage.getItem('darkMode')
  let isDark = false
  
  if (stored !== null) {
    isDark = JSON.parse(stored)
  } else {
    // Fall back to system preference
    isDark = window.matchMedia('(prefers-color-scheme: dark)').matches
  }
  
  // Apply theme
  if (isDark) {
    document.documentElement.classList.add('dark')
  } else {
    document.documentElement.classList.remove('dark')
  }
}

createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    resolve: (name) => resolvePageComponent(`./pages/${name}.vue`, import.meta.glob<DefineComponent>('./pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

// Initialize dark mode on page load
initializeDarkMode();
