<!DOCTYPE html>
<html lang="fr" x-data="registrationForm()">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Inscription Admin - NOBESICK</title>

  <!-- Google Fonts - Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Tailwind CSS & custom config -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'pastel-blue':  '#E8F4FD',
            'soft-blue':    '#F8FAFC',
            'mustard':      '#F4D03F',
            'soft-mustard': '#F9E79F'
          },
          fontFamily: {
            poppins: ['Poppins','sans-serif']
          },
          animation: {
            'slide-up': 'slideUp 0.5s ease-out',
            'fade-in': 'fadeIn 0.6s ease-out',
            'pulse-soft': 'pulse 2s cubic-bezier(0.4,0,0.6,1) infinite'
          }
        }
      }
    };
  </script>

  <style>
    @keyframes slideUp {
      from { transform: translateY(20px); opacity: 0; }
      to   { transform: translateY(0);     opacity: 1; }
    }
    @keyframes fadeIn {
      from { opacity: 0; }
      to   { opacity: 1; }
    }
  </style>

  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script>
    function registrationForm() {
      return {
        name: '', email: '', password: '', password_confirmation: '',
        errors: {}, success: false,
        register() {
          this.errors = {};
          this.success = false;

          if (!this.name) {
            this.errors.name = 'Nom requis';
          }
          if (!this.email) {
            this.errors.email = 'Email requis';
          } else if (!/.+@.+\..+/.test(this.email)) {
            this.errors.email = 'Format email invalide';
          }
          if (!this.password) {
            this.errors.password = 'Mot de passe requis';
          }
          if (this.password && this.password_confirmation !== this.password) {
            this.errors.password_confirmation = 'Les mots de passe ne correspondent pas';
          }

          if (Object.keys(this.errors).length === 0) {
            // Simuler un succès
            this.success = true;
          }
        }
      }
    }
  </script>

</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-pastel-blue to-soft-blue font-poppins px-4">

  <div class="max-w-md w-full bg-white rounded-2xl p-8 shadow-lg">

    <!-- Message de succès -->
    <div
      x-show="success"
      x-transition:enter="animate-fade-in"
      x-transition:leave="transition-opacity duration-300"
      class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg animate-slide-up"
    >
      Inscription réussie, vous êtes désormais admin !
    </div>

    <!-- Erreur générique -->
    <template x-if="errors.register">
      <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg animate-slide-up" x-text="errors.register"></div>
    </template>

    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Inscription Admin</h2>

    <form @submit.prevent="register()" class="space-y-6">
      <!-- Nom -->
      <div>
        <label for="name" class="block text-gray-700 font-medium mb-1">Nom</label>
        <input id="name" type="text" x-model="name"
               class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-soft-blue"
               :class="errors.name ? 'border-red-300 focus:ring-red-300' : ''">
        <p x-show="errors.name" x-text="errors.name" class="text-red-600 text-sm mt-1"></p>
      </div>

      <!-- Email -->
      <div>
        <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
        <input id="email" type="email" x-model="email"
               class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-soft-blue"
               :class="errors.email ? 'border-red-300 focus:ring-red-300' : ''">
        <p x-show="errors.email" x-text="errors.email" class="text-red-600 text-sm mt-1"></p>
      </div>

      <!-- Mot de passe -->
      <div>
        <label for="password" class="block text-gray-700 font-medium mb-1">Mot de passe</label>
        <input id="password" type="password" x-model="password"
               class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-soft-blue"
               :class="errors.password ? 'border-red-300 focus:ring-red-300' : ''">
        <p x-show="errors.password" x-text="errors.password" class="text-red-600 text-sm mt-1"></p>
      </div>

      <!-- Confirmation mot de passe -->
      <div>
        <label for="password_confirmation" class="block text-gray-700 font-medium mb-1">Confirmer le mot de passe</label>
        <input id="password_confirmation" type="password" x-model="password_confirmation"
               class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-soft-blue"
               :class="errors.password_confirmation ? 'border-red-300 focus:ring-red-300' : ''">
        <p x-show="errors.password_confirmation" x-text="errors.password_confirmation" class="text-red-600 text-sm mt-1"></p>
      </div>

      <!-- Bouton soumettre -->
      <button type="submit"
              class="w-full py-3 bg-gradient-to-r from-mustard to-yellow-500 text-white font-semibold rounded-xl hover:from-yellow-500 hover:to-mustard animate-fade-in">
        S’inscrire
      </button>
    </form>
  </div>

</body>
</html>

  <!-- Registration Modal -->
  <div x-show="showRegisterModal" x-cloak
       x-transition:enter="animate-backdrop-appear" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
       x-transition:leave="transition-opacity duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
       class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm px-4"
       @click.self="showRegisterModal = false">
    <div x-show="showRegisterModal" x-cloak
         x-transition:enter="animate-modal-appear" x-transition:leave="transition-all duration-200"
         x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
         class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 relative"
         x-data="registrationForm()">
      <button @click="showRegisterModal=false"
              class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 bg-white rounded-full p-1">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
      <!-- Success -->
      <div x-show="success"
           x-transition:enter="animate-fade-in"
           x-transition:leave="transition-opacity duration-300"
           class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg animate-slide-up">
        Inscription réussie, vous êtes désormais admin !
      </div>
      <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Inscription Admin</h2>
      <form action="{{ route('register.submit') }}" method="POST" class="space-y-6">
        @csrf
      
        <div>
          <label for="reg-name">Nom</label>
          <input id="reg-name" name="name" type="text" required
                 class="w-full px-4 py-3 border rounded-xl"
                 placeholder="Votre nom" />
          @error('name') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>
      
        <div>
          <label for="reg-email">Email</label>
          <input id="reg-email" name="email" type="email" required
                 class="w-full px-4 py-3 border rounded-xl"
                 placeholder="votre.email@exemple.com" />
          @error('email') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>
      
        <div>
          <label for="reg-pass">Mot de passe</label>
          <input id="reg-pass" name="password" type="password" required
                 class="w-full px-4 py-3 border rounded-xl"
                 placeholder="••••••••" />
          @error('password') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>
      
        <div>
          <label for="reg-passc">Confirmez mot de passe</label>
          <input id="reg-passc" name="password_confirmation" type="password" required
                 class="w-full px-4 py-3 border rounded-xl"
                 placeholder="••••••••" />
        </div>
      
        <button type="submit"
                class="w-full py-3 bg-gradient-to-r from-mustard to-yellow-500 text-white rounded-xl">
          S’inscrire
        </button>
      </form>      
    </div>
  </div>