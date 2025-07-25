import { ref, onMounted, watch } from 'vue'

const isDark = ref(false)

export function useDarkMode() {
  // Initialize dark mode state
  const initDarkMode = () => {
    // Check localStorage first
    const stored = localStorage.getItem('darkMode')
    if (stored !== null) {
      isDark.value = JSON.parse(stored)
    } else {
      // Fall back to system preference
      isDark.value = window.matchMedia('(prefers-color-scheme: dark)').matches
    }
    updateTheme()
  }

  // Update theme class on document
  const updateTheme = () => {
    if (isDark.value) {
      document.documentElement.classList.add('dark')
    } else {
      document.documentElement.classList.remove('dark')
    }
  }

  // Toggle dark mode
  const toggleDarkMode = () => {
    isDark.value = !isDark.value
  }

  // Set dark mode state explicitly
  const setDarkMode = (value: boolean) => {
    isDark.value = value
  }

  // Watch for changes and persist to localStorage
  watch(isDark, (newValue) => {
    localStorage.setItem('darkMode', JSON.stringify(newValue))
    updateTheme()
  })

  // Listen for system preference changes
  onMounted(() => {
    initDarkMode()
    
    const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)')
    const handleChange = (e: MediaQueryListEvent) => {
      // Only update if no user preference is stored
      if (localStorage.getItem('darkMode') === null) {
        isDark.value = e.matches
      }
    }
    
    mediaQuery.addEventListener('change', handleChange)
    
    // Cleanup listener when component unmounts
    return () => {
      mediaQuery.removeEventListener('change', handleChange)
    }
  })

  return {
    isDark,
    toggleDarkMode,
    setDarkMode
  }
}
