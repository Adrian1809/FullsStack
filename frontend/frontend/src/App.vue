<script setup>
import { provide, ref, onMounted } from 'vue'
import router from './router'

const isDark = ref(true)

onMounted(() => {
  const saved = localStorage.getItem('darkMode')
  if (saved !== null) {
    isDark.value = JSON.parse(saved)
  } else {
    isDark.value = true // Modo oscuro por defecto
  }
  updateDarkMode()
})

const toggleDarkMode = () => {
  isDark.value = !isDark.value
  updateDarkMode()
}

const updateDarkMode = () => {
  localStorage.setItem('darkMode', JSON.stringify(isDark.value))
  if (isDark.value) {
    document.documentElement.classList.add('dark')
  } else {
    document.documentElement.classList.remove('dark')
  }
}

provide('isDark', isDark)
provide('toggleDarkMode', toggleDarkMode)
</script>

<style>
.grain-bg {
  background-image: 
    radial-gradient(circle at 25% 25%, rgba(255,255,255,0.05) 1px, transparent 1px),
    radial-gradient(circle at 75% 75%, rgba(255,255,255,0.05) 1px, transparent 1px);
  background-size: 20px 20px;
  background-position: 0 0, 10px 10px;
  min-height: 100vh;
}
</style>

<template>
  <div class="grain-bg">
    <router-view />
  </div>
</template>
