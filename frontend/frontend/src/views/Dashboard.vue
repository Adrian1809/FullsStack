<template>
  <div class="min-h-screen bg-slate-950 relative overflow-hidden">
    <!-- Background elements -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-blue-500/5 rounded-full mix-blend-multiply filter blur-3xl animate-pulse"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-purple-500/5 rounded-full mix-blend-multiply filter blur-3xl animate-pulse" style="animation-delay: 2s"></div>
    
    <!-- Header -->
    <header class="bg-slate-900/80 backdrop-blur-xl border-b border-slate-800/50 shadow-2xl sticky top-0 z-50 relative">
      <div class="max-w-7xl mx-auto px-6 py-4 relative z-10">
        <div class="flex justify-between items-center">
          <div>
            <div class="flex items-center space-x-3 mb-1">
              <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
              </div>
              <h1 class="text-3xl font-bold text-white tracking-tight bg-gradient-to-r from-white to-slate-300 bg-clip-text text-transparent">Panel de Control</h1>
            </div>
            <p class="text-slate-400 text-sm">Gestión de usuarios</p>
          </div>
          <button
            @click="logout"
            class="px-4 py-2 text-slate-300 hover:text-white hover:bg-slate-800/50 rounded-lg transition-all font-medium flex items-center gap-2 backdrop-blur-sm border border-slate-700/50 hover:border-slate-600/50 group"
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
      <!-- Admin View: User Management -->
      <template v-if="isAdmin">
        <!-- Action buttons -->
        <div class="mb-8 flex gap-4">
          <button
            @click="showCreateModal = true"
            class="inline-flex items-center gap-3 px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-medium rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 active:scale-95"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Crear Usuario
          </button>
          <button
            @click="getUsers"
            :disabled="isLoading"
            class="inline-flex items-center gap-3 px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white font-medium rounded-xl transition-all duration-300 disabled:opacity-50 shadow-lg hover:shadow-xl transform hover:scale-105 active:scale-95"
          >
            <svg v-if="!isLoading" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
            <svg v-else class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
            {{ isLoading ? 'Cargando...' : 'Recargar' }}
          </button>
        </div>

        <!-- Error message -->
        <div v-if="errorMessage" class="mb-6 p-4 bg-red-900/30 border border-red-800 rounded-lg text-red-200">
          {{ errorMessage }}
        </div>

        <!-- Users table -->
        <div class="bg-slate-900/80 backdrop-blur-xl rounded-xl shadow-2xl border border-slate-800/50 overflow-hidden">
          <div class="bg-gradient-to-r from-slate-800/50 to-slate-900/50 border-b border-slate-800/50 px-6 py-4">
            <div class="flex items-center justify-between">
              <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                  <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                  </svg>
                </div>
                <h2 class="text-lg font-semibold text-white">Usuarios ({{ users.length }})</h2>
              </div>
            </div>
          </div>

          <!-- Empty state -->
          <div v-if="users.length === 0" class="px-6 py-16 text-center">
            <svg class="w-16 h-16 text-slate-700 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292 4 4 0 010-5.292zM15 12H9m6 0h6M3 12h6m0 0a6 6 0 110 12 6 6 0 010-12z" />
            </svg>
            <p class="text-slate-400 text-base">Sin usuarios</p>
          </div>

          <!-- Table -->
          <div v-else class="overflow-x-auto">
            <table class="w-full">
              <thead>
                <tr class="border-b border-slate-800 bg-slate-800">
                  <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase">ID</th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase">Nombre</th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase">Email</th>
                  <th class="px-6 py-4 text-left text-xs font-semibold text-slate-300 uppercase">Rol</th>
                  <th class="px-6 py-4 text-center text-xs font-semibold text-slate-300 uppercase">Acciones</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-800/50">
                <tr v-for="user in users" :key="user.id" class="hover:bg-slate-800/30 transition-all">
                  <td class="px-6 py-4">
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-slate-800/50 text-slate-300 font-medium text-sm">{{ user.id }}</span>
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex items-center">
                      <div class="w-10 h-10 rounded-full bg-gradient-to-br from-slate-700 to-slate-800 flex items-center justify-center text-white font-semibold mr-3">
                        {{ user.name.charAt(0).toUpperCase() }}
                      </div>
                      <span class="text-white font-medium">{{ user.name }}</span>
                    </div>
                  </td>
                  <td class="px-6 py-4 text-slate-400">{{ user.email }}</td>
                  <td class="px-6 py-4">
                    <span :class="[
                      'inline-flex px-3 py-1 text-xs font-medium rounded-full',
                      user.role === 'admin' 
                        ? 'bg-red-900/30 text-red-400 border border-red-800/50'
                        : 'bg-blue-900/30 text-blue-400 border border-blue-800/50'
                    ]">
                      {{ user.role === 'admin' ? '👑 Admin' : 'Usuario' }}
                    </span>
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex justify-center gap-2">
                      <button
                        @click="editUser(user)"
                        class="p-2 text-slate-400 hover:text-white hover:bg-slate-800/50 rounded-lg transition-all"
                        title="Editar"
                      >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                      </button>
                      <button
                        @click="deleteUser(user.id)"
                        class="p-2 text-slate-400 hover:text-red-400 hover:bg-slate-800/50 rounded-lg transition-all"
                        title="Eliminar"
                      >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                      </button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </template>

      <!-- User View: Personal Profile -->
      <template v-else>
        <div class="max-w-2xl">
          <!-- Profile Card -->
          <div class="bg-slate-900/80 backdrop-blur-xl rounded-xl shadow-2xl border border-slate-800/50 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 h-32"></div>
            
            <div class="px-6 pb-6">
              <!-- Profile Header -->
              <div class="flex items-end gap-4 -mt-16 mb-6">
                <div class="w-20 h-20 rounded-full bg-gradient-to-br from-slate-700 to-slate-800 flex items-center justify-center text-white font-bold text-2xl border-4 border-slate-900">
                  {{ currentUser?.name?.charAt(0)?.toUpperCase() }}
                </div>
                <div>
                  <h2 class="text-2xl font-bold text-white">{{ currentUser?.name }}</h2>
                  <p class="text-slate-400">Tu perfil personal</p>
                </div>
              </div>

              <!-- Profile Info -->
              <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                  <div class="bg-slate-800/50 rounded-lg p-4 border border-slate-700/50">
                    <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Nombre</label>
                    <p class="text-white font-medium mt-2">{{ currentUser?.name }}</p>
                  </div>
                  
                  <div class="bg-slate-800/50 rounded-lg p-4 border border-slate-700/50">
                    <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Correo</label>
                    <p class="text-white font-medium mt-2 break-all">{{ currentUser?.email }}</p>
                  </div>

                  <div class="bg-slate-800/50 rounded-lg p-4 border border-slate-700/50">
                    <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Rol</label>
                    <div class="mt-2">
                      <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full bg-blue-900/30 text-blue-400 border border-blue-800/50">
                        👤 Usuario Regular
                      </span>
                    </div>
                  </div>

                  <div class="bg-slate-800/50 rounded-lg p-4 border border-slate-700/50">
                    <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider">ID de Usuario</label>
                    <p class="text-white font-medium mt-2">{{ currentUser?.id }}</p>
                  </div>
                </div>

                <!-- Info Message -->
                <div class="bg-blue-900/20 border border-blue-800/50 rounded-lg p-4">
                  <p class="text-blue-300 text-sm">
                    <svg class="w-4 h-4 inline mr-2" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd" />
                    </svg>
                    Como usuario regular, solo puedes ver tu perfil personal. Solicita a un administrador si necesitas crear o gestionar otros usuarios.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </template>
    </main>

    <!-- Modal -->
    <div v-if="showCreateModal || showEditModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">
      <div class="bg-slate-900 border border-slate-800 rounded-xl shadow-2xl max-w-md w-full mx-4">
        <div class="bg-gradient-to-r from-slate-800/50 to-slate-900/50 border-b border-slate-800/50 px-6 py-4">
          <h3 class="text-xl font-semibold text-white">
            {{ showEditModal ? 'Editar Usuario' : 'Crear Usuario' }}
          </h3>
        </div>
        
        <div class="p-6">
          <!-- Error -->
          <div v-if="formError" class="mb-4 p-3 bg-red-900/30 border border-red-800 rounded text-red-200 text-sm">
            {{ formError }}
          </div>

          <!-- Form -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-slate-300 mb-2">Nombre</label>
              <input
                v-model="form.name"
                type="text"
                class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white focus:outline-none focus:border-blue-500"
                placeholder="Nombre completo"
              />
            </div>

            <div>
              <label class="block text-sm font-medium text-slate-300 mb-2">Email</label>
              <input
                v-model="form.email"
                type="email"
                class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white focus:outline-none focus:border-blue-500"
                placeholder="correo@ejemplo.com"
              />
            </div>

            <div v-if="!showEditModal">
              <label class="block text-sm font-medium text-slate-300 mb-2">Contraseña</label>
              <input
                v-model="form.password"
                type="password"
                class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white focus:outline-none focus:border-blue-500"
                placeholder="Mínimo 6 caracteres"
              />
            </div>

            <div>
              <label class="block text-sm font-medium text-slate-300 mb-2">Rol</label>
              <select
                v-model="form.role"
                class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-lg text-white focus:outline-none focus:border-blue-500"
              >
                <option value="user">Usuario</option>
                <option value="admin">Admin</option>
              </select>
            </div>
          </div>
        </div>

        <div class="bg-slate-800/50 border-t border-slate-800 px-6 py-4 flex gap-3 justify-end">
          <button
            @click="closeModal"
            class="px-4 py-2 text-slate-300 hover:text-white border border-slate-700 rounded-lg transition-all"
          >
            Cancelar
          </button>
          <button
            @click="saveUser"
            :disabled="isSaving"
            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-all disabled:opacity-50"
          >
            {{ isSaving ? 'Guardando...' : (showEditModal ? 'Actualizar' : 'Crear') }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import api from '../services/api'

const users = ref([])
const currentUser = ref(null)
const isLoading = ref(false)
const isSaving = ref(false)
const errorMessage = ref('')
const formError = ref('')
const showCreateModal = ref(false)
const showEditModal = ref(false)
const form = ref({
  name: '',
  email: '',
  password: '',
  role: 'user'
})
const editingUserId = ref(null)

// Obtener si es admin
const isAdmin = computed(() => {
  const user = JSON.parse(localStorage.getItem('user') || '{}')
  return user.role === 'admin'
})

// Obtener usuario actual
const getUserData = () => {
  const user = JSON.parse(localStorage.getItem('user') || '{}')
  currentUser.value = user
}

const getUsers = async () => {
  isLoading.value = true
  errorMessage.value = ''
  try {
    const res = await api.get('/users')
    users.value = res.data
  } catch (error) {
    errorMessage.value = 'Error al cargar usuarios'
    console.error('Error:', error)
  } finally {
    isLoading.value = false
  }
}

const editUser = (user) => {
  editingUserId.value = user.id
  form.value = {
    name: user.name,
    email: user.email,
    password: '',
    role: user.role
  }
  showEditModal.value = true
}

const saveUser = async () => {
  formError.value = ''
  
  // Validar
  if (!form.value.name.trim() || !form.value.email.trim()) {
    formError.value = 'Por favor completa todos los campos'
    return
  }

  if (!showEditModal.value && !form.value.password.trim()) {
    formError.value = 'La contraseña es requerida'
    return
  }

  isSaving.value = true
  try {
    if (showEditModal.value) {
      // Actualizar
      const data = {
        name: form.value.name,
        email: form.value.email,
        role: form.value.role
      }
      if (form.value.password.trim()) {
        data.password = form.value.password
      }
      await api.put(`/users/${editingUserId.value}`, data)
    } else {
      // Crear
      await api.post('/users', form.value)
    }
    closeModal()
    await getUsers()
  } catch (error) {
    formError.value = error.response?.data?.message || 'Error al guardar usuario'
    console.error('Error:', error)
  } finally {
    isSaving.value = false
  }
}

const deleteUser = async (id) => {
  if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
    try {
      await api.delete(`/users/${id}`)
      await getUsers()
    } catch (error) {
      errorMessage.value = 'Error al eliminar usuario'
      console.error('Error:', error)
    }
  }
}

const closeModal = () => {
  showCreateModal.value = false
  showEditModal.value = false
  editingUserId.value = null
  form.value = {
    name: '',
    email: '',
    password: '',
    role: 'user'
  }
  formError.value = ''
}

const logout = () => {
  localStorage.removeItem('token')
  localStorage.removeItem('user')
  setTimeout(() => {
    window.location.href = '/'
  }, 300)
}

// Load data on mount
getUserData()
getUsers()
</script>

<style scoped>
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

@keyframes float {
  0%, 100% {
    transform: translateY(0px);
  }
  50% {
    transform: translateY(-10px);
  }
}

.animate-float {
  animation: float 3s ease-in-out infinite;
}

header {
  animation: slideInDown 0.3s ease-out;
}

main {
  animation: slideInDown 0.5s ease-out;
}
</style>
