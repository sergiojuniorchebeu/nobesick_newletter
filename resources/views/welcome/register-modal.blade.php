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
    <div x-show="success" x-transition:enter="animate-fade-in"
         class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg animate-slide-up">
      Inscription réussie, vous êtes désormais admin !
    </div>
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Inscription Admin</h2>
    <form action="{{ route('register.submit') }}" method="POST" class="space-y-6">
      @csrf
      <div>
        <label for="reg-name" class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
        <input id="reg-name" name="name" type="text" required
               class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-soft-blue"
               placeholder="Votre nom" />
        @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>
      <div>
        <label for="reg-email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input id="reg-email" name="email" type="email" required
               class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-soft-blue"
               placeholder="votre.email@exemple.com" />
        @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>
      <div>
        <label for="reg-pass" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
        <input id="reg-pass" name="password" type="password" required
               class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-soft-blue"
               placeholder="••••••••" />
        @error('password') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>
      <div>
        <label for="reg-passc" class="block text-sm font-medium text-gray-700 mb-1">Confirmez mot de passe</label>
        <input id="reg-passc" name="password_confirmation" type="password" required
               class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-soft-blue"
               placeholder="••••••••" />
      </div>
      <button type="submit"
              class="w-full py-3 bg-gradient-to-r from-mustard to-yellow-500 text-white rounded-xl">
        S’inscrire
      </button>
    </form>
  </div>
</div>
