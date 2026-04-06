<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-950 to-slate-900 flex items-center justify-center p-4 relative overflow-hidden">
    <!-- Enhanced background elements -->
    <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-pulse"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-pulse" style="animation-delay: 2s"></div>
    <div class="absolute top-1/2 left-1/4 w-64 h-64 bg-blue-500/5 rounded-full mix-blend-multiply filter blur-2xl animate-pulse" style="animation-delay: 4s"></div>
    <div class="absolute bottom-1/4 right-1/3 w-48 h-48 bg-purple-500/5 rounded-full mix-blend-multiply filter blur-2xl animate-pulse" style="animation-delay: 1s"></div>
    
    <!-- Floating particles -->
    <div class="absolute inset-0">
      <div class="absolute top-20 left-20 w-2 h-2 bg-white/20 rounded-full animate-float"></div>
      <div class="absolute top-40 right-32 w-1 h-1 bg-white/30 rounded-full animate-float-delayed"></div>
      <div class="absolute bottom-32 left-40 w-1.5 h-1.5 bg-white/25 rounded-full animate-float"></div>
      <div class="absolute bottom-20 right-20 w-1 h-1 bg-white/20 rounded-full animate-float-delayed"></div>
    </div>

    <div class="relative w-full max-w-md animate-fade-in-up">
      <!-- Card with glassmorphism effect -->
      <div class="bg-slate-800/80 backdrop-blur-xl rounded-2xl shadow-2xl overflow-hidden border border-slate-700/50 relative">
        <!-- Animated gradient border -->
        <div class="absolute inset-0 bg-gradient-to-r from-blue-500/20 via-purple-500/20 to-pink-500/20 rounded-2xl opacity-0 animate-border-glow"></div>
        
        <!-- Header gradient with animation -->
        <div class="h-1 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 animate-gradient-shift relative z-10"></div>
        
        <div class="p-10 relative z-10">
          <!-- Enhanced logo/title section -->
          <div class="mb-8 text-center">
            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl mx-auto mb-4 flex items-center justify-center shadow-lg animate-bounce-gentle">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
              </svg>
            </div>
            <h1 class="text-3xl font-bold text-white tracking-tight bg-gradient-to-r from-white to-slate-300 bg-clip-text text-transparent">Bienvenido</h1>
            <p class="text-slate-400 text-sm mt-2 animate-fade-in" style="animation-delay: 0.2s">Ingresa tus credenciales para continuar</p>
          </div>

          <!-- Form with enhanced styling -->
          <div class="space-y-6">
            <!-- Email Input with enhanced effects -->
            <div class="group animate-fade-in" style="animation-delay: 0.3s">
              <label class="block text-sm font-medium text-slate-300 mb-2 transition-colors group-focus-within:text-blue-400">Correo electrónico</label>
              <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-500/20 to-purple-500/20 rounded-lg opacity-0 group-focus-within:opacity-100 transition-opacity duration-300"></div>
                <input
                  v-model="email"
                  type="email"
                  placeholder="correo@ejemplo.com"
                  @keyup.enter="login"
                  class="relative w-full px-4 py-3 bg-slate-700/50 backdrop-blur-sm border border-slate-600 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all duration-300 hover:bg-slate-700/70"
                />
                <svg class="absolute right-3 top-3.5 w-5 h-5 text-slate-500 group-focus-within:text-blue-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
              </div>
            </div>

            <!-- Password Input with enhanced effects -->
            <div class="group animate-fade-in" style="animation-delay: 0.4s">
              <label class="block text-sm font-medium text-slate-300 mb-2 transition-colors group-focus-within:text-blue-400">Contraseña</label>
              <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-500/20 to-purple-500/20 rounded-lg opacity-0 group-focus-within:opacity-100 transition-opacity duration-300"></div>
                <input
                  v-model="password"
                  :type="showPassword ? 'text' : 'password'"
                  placeholder="••••••••"
                  @keyup.enter="login"
                  class="relative w-full px-4 py-3 bg-slate-700/50 backdrop-blur-sm border border-slate-600 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all duration-300 hover:bg-slate-700/70"
                />
                <button
                  type="button"
                  @click="showPassword = !showPassword"
                  class="absolute right-3 top-3.5 text-slate-500 hover:text-blue-400 transition-colors focus:outline-none"
                >
                  <svg v-if="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                  </svg>
                  <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-4.803m5.596-3.856a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.394 14.204l1.281-2.222M9.172 9.172L5.969 5.969m5.6 5.6l.707-.707m2.121-2.121l2.222-1.281" />
                  </svg>
                </button>
              </div>
            </div>

            <!-- Enhanced error message -->
            <transition name="fade-slide-up">
              <div v-if="error" class="p-4 bg-red-900/30 backdrop-blur-sm border border-red-800/50 rounded-lg animate-shake">
                <p class="text-red-400 text-sm flex items-center">
                  <svg class="w-4 h-4 mr-2 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                  </svg>
                  {{ error }}
                </p>
              </div>
            </transition>
          </div>

          <!-- Enhanced submit button -->
          <button
            @click="login"
            :disabled="isLoading"
            class="w-full mt-8 bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 hover:from-blue-700 hover:via-purple-700 hover:to-pink-700 text-white font-medium py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500/50 focus:ring-offset-2 focus:ring-offset-slate-900 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed shadow-lg hover:shadow-xl transform hover:scale-105 active:scale-95 animate-fade-in group"
            style="animation-delay: 0.5s"
          >
            <span v-if="!isLoading" class="flex items-center justify-center group-hover:animate-pulse">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
              </svg>
              Iniciar sesión
            </span>
            <span v-else class="flex items-center justify-center">
              <svg class="w-5 h-5 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
              </svg>
              Cargando...
            </span>
          </button>
        </div>
      </div>

      <!-- Enhanced footer -->
      <p class="text-center text-slate-400 text-sm mt-6 animate-fade-in opacity-0" style="animation-delay: 0.6s; animation-fill-mode: forwards">
        <span class="inline-flex items-center">
          <svg class="w-4 h-4 mr-1 text-green-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
          </svg>
          Acceso seguro a tu panel
        </span>
      </p>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import api from '../services/api'

const email = ref('')
const password = ref('')
const error = ref('')
const isLoading = ref(false)
const showPassword = ref(false)

const login = async () => {
  if (!email.value || !password.value) {
    error.value = 'Por favor completa todos los campos'
    return
  }
  
  isLoading.value = true
  error.value = ''
  
  try {
    const res = await api.post('/login', {
      email: email.value,
      password: password.value
    })

    localStorage.setItem('token', res.data.access_token)
    setTimeout(() => {
      window.location.href = '/dashboard'
    }, 500)

  } catch (e) {
    error.value = 'Credenciales incorrectas. Por favor intenta de nuevo.'
    isLoading.value = false
  }
}
</script>

<style scoped>
/* Enhanced animations */
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

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
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

@keyframes borderGlow {
  0%, 100% {
    opacity: 0;
  }
  50% {
    opacity: 1;
  }
}

@keyframes bounceGentle {
  0%, 100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-5px);
  }
}

@keyframes shake {
  0%, 100% {
    transform: translateX(0);
  }
  25% {
    transform: translateX(-5px);
  }
  75% {
    transform: translateX(5px);
  }
}

@keyframes fadeSlideUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Animation classes */
.animate-fade-in {
  animation: fadeIn 0.6s ease-out forwards;
}

.animate-fade-in-up {
  animation: fadeInUp 0.8s ease-out forwards;
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

.animate-border-glow {
  animation: borderGlow 2s ease-in-out infinite;
}

.animate-bounce-gentle {
  animation: bounceGentle 2s ease-in-out infinite;
}

.animate-shake {
  animation: shake 0.5s ease-in-out;
}

/* Transition classes */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s, transform 0.3s;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: translateY(-10px);
}

.fade-slide-up-enter-active,
.fade-slide-up-leave-active {
  transition: opacity 0.4s, transform 0.4s;
}

.fade-slide-up-enter-from,
.fade-slide-up-leave-to {
  opacity: 0;
  transform: translateY(20px);
}
</style>
