<template>
  <div class="min-h-screen bg-slate-950 relative overflow-hidden">
    <!-- Enhanced background elements -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-blue-500/5 rounded-full mix-blend-multiply filter blur-3xl animate-pulse"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-purple-500/5 rounded-full mix-blend-multiply filter blur-3xl animate-pulse" style="animation-delay: 2s"></div>
    
    <!-- Floating accent elements -->
    <div class="absolute top-20 right-20 w-3 h-3 bg-blue-400/20 rounded-full animate-float"></div>
    <div class="absolute bottom-40 left-32 w-2 h-2 bg-purple-400/20 rounded-full animate-float-delayed"></div>
    <!-- Enhanced header -->
    <header class="bg-slate-900/80 backdrop-blur-xl border-b border-slate-800/50 shadow-2xl sticky top-0 z-50 relative">
      <!-- Animated gradient border -->
      <div class="absolute inset-0 bg-gradient-to-r from-blue-500/10 via-purple-500/10 to-pink-500/10 rounded-b-lg"></div>
      
      <div class="max-w-7xl mx-auto px-6 py-4 relative z-10">
        <div class="flex justify-between items-center">
          <div class="animate-fade-in">
            <div class="flex items-center space-x-3 mb-1">
              <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
              </div>
              <h1 class="text-3xl font-bold text-white tracking-tight bg-gradient-to-r from-white to-slate-300 bg-clip-text text-transparent">Panel de Control</h1>
            </div>
            <p class="text-slate-400 text-sm animate-fade-in" style="animation-delay: 0.1s">Gestión de usuarios</p>
          </div>
          <button
            @click="logout"
            class="px-4 py-2 text-slate-300 hover:text-white hover:bg-slate-800/50 rounded-lg transition-all font-medium flex items-center gap-2 backdrop-blur-sm border border-slate-700/50 hover:border-slate-600/50 animate-fade-in group"
            style="animation-delay: 0.2s"
          >
            <svg class="w-5 h-5 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            Cerrar sesión
          </button>
        </div>
      </div>
    </header>

    <!-- Main content -->
    <main class="max-w-7xl mx-auto px-6 py-8 relative z-10">
      <!-- Enhanced action button -->
      <div class="mb-8 animate-fade-in" style="animation-delay: 0.3s">
        <button
          @click="getUsers"
          :disabled="isLoading"
          class="inline-flex items-center gap-3 px-6 py-3 bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 hover:from-blue-700 hover:via-purple-700 hover:to-pink-700 text-white font-medium rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500/50 focus:ring-offset-2 focus:ring-offset-slate-950 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed shadow-lg hover:shadow-xl transform hover:scale-105 active:scale-95 group"
        >
          <svg v-if="!isLoading" class="w-5 h-5 group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
          </svg>
          <svg v-else class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
          </svg>
          <span>{{ isLoading ? 'Cargando...' : 'Cargar usuarios' }}</span>
        </button>
      </div>

      <!-- Enhanced users section -->
      <div class="bg-slate-900/80 backdrop-blur-xl rounded-xl shadow-2xl border border-slate-800/50 overflow-hidden animate-fade-in" style="animation-delay: 0.4s">
        <!-- Enhanced table header -->
        <div class="bg-gradient-to-r from-slate-800/50 to-slate-900/50 border-b border-slate-800/50 px-6 py-4 relative">
          <!-- Subtle gradient overlay -->
          <div class="absolute inset-0 bg-gradient-to-r from-blue-500/5 via-purple-500/5 to-pink-500/5"></div>
          
          <div class="flex items-center justify-between relative z-10">
            <div class="flex items-center space-x-3">
              <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                </svg>
              </div>
              <h2 class="text-lg font-semibold text-white">Usuarios registrados</h2>
            </div>
            <span class="text-sm font-medium text-slate-400 bg-slate-800/50 px-3 py-1 rounded-full border border-slate-700/50 backdrop-blur-sm">{{ users.length }} usuario{{ users.length !== 1 ? 's' : '' }}</span>
          </div>
        </div>

        <!-- Table or empty state -->
        <div v-if="users.length === 0" class="px-6 py-16 text-center">
          <svg class="w-16 h-16 text-slate-700 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292 4 4 0 010-5.292zM15 12H9m6 0h6M3 12h6m0 0a6 6 0 110 12 6 6 0 010-12z" />
          </svg>
          <p class="text-slate-400 text-base">No hay usuarios disponibles</p>
          <p class="text-slate-500 text-sm mt-1">Haz clic en "Cargar usuarios" para actualizar</p>
        </div>

        <!-- Table -->
        <div v-else class="overflow-x-auto">
          <table class="w-full">
            <thead>
              <tr class="border-b border-slate-800 bg-slate-800">
                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">ID</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Nombre</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Correo electrónico</th>
                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase tracking-wider">Estado</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-800/50">
              <tr v-for="(user, index) in users" :key="user.id" class="hover:bg-slate-800/30 transition-all duration-300 hover:shadow-lg hover:shadow-blue-500/10 animate-fade-in" :style="{ animationDelay: `${0.5 + index * 0.1}s` }">
                <td class="px-6 py-4">
                  <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-slate-800/50 text-slate-300 font-medium text-sm border border-slate-700/50">{{ user.id }}</span>
                </td>
                <td class="px-6 py-4">
                  <div class="flex items-center group">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-slate-700 to-slate-800 flex items-center justify-center text-white font-semibold mr-3 border border-slate-600/50 group-hover:border-blue-500/50 transition-colors">
                      {{ user.name.charAt(0).toUpperCase() }}
                    </div>
                    <span class="text-white font-medium group-hover:text-blue-400 transition-colors">{{ user.name }}</span>
                  </div>
                </td>
                <td class="px-6 py-4">
                  <span class="text-slate-400 flex items-center gap-2 group-hover:text-slate-300 transition-colors">
                    <svg class="w-4 h-4 text-slate-600 group-hover:text-blue-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    {{ user.email }}
                  </span>
                </td>
                <td class="px-6 py-4">
                  <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full bg-green-900/30 text-green-400 border border-green-800/50 hover:bg-green-800/50 hover:border-green-700/50 transition-all">
                    <span class="w-2 h-2 bg-green-400 rounded-full mr-2 mt-0.5 animate-pulse"></span>
                    Activo
                  </span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import api from '../services/api'

const users = ref([])
const isLoading = ref(false)

const getUsers = async () => {
  isLoading.value = true
  try {
    const res = await api.get('/users')
    users.value = res.data
  } catch (error) {
    console.error('Error al cargar usuarios:', error)
    users.value = []
  } finally {
    isLoading.value = false
  }
}

const logout = () => {
  localStorage.removeItem('token')
  setTimeout(() => {
    window.location.href = '/'
  }, 300)
}
</script>

<style scoped>
/* Enhanced animations */
@keyframes slideInDown {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes float {
  0%, 100% {
    transform: translateY(0px);
  }
  50% {
    transform: translateY(-10px);
  }
}

@keyframes floatDelayed {
  0%, 100% {
    transform: translateY(0px);
  }
  50% {
    transform: translateY(-15px);
  }
}

@keyframes gradientShift {
  0% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
  100% {
    background-position: 0% 50%;
  }
}

/* Animation classes */
.animate-fade-in {
  animation: fadeIn 0.6s ease-out forwards;
}

.animate-float {
  animation: float 3s ease-in-out infinite;
}

.animate-float-delayed {
  animation: floatDelayed 4s ease-in-out infinite;
  animation-delay: 1s;
}

.animate-gradient-shift {
  background-size: 200% 200%;
  animation: gradientShift 3s ease infinite;
}

/* Header animation */
header {
  animation: slideInDown 0.3s ease-out;
}

/* Main content animation */
main {
  animation: slideInDown 0.5s ease-out;
}
</style>
