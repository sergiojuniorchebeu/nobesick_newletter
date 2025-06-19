<div x-show="showLoginModal" x-cloak
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm px-4"
     @click.self="showLoginModal = false">
     
  <div x-show="showLoginModal" x-cloak
       x-transition:enter="transition ease-out duration-300"
       x-transition:enter-start="opacity-0 scale-95"
       x-transition:enter-end="opacity-100 scale-100"
       x-transition:leave="transition ease-in duration-200"
       x-transition:leave-start="opacity-100 scale-100"
       x-transition:leave-end="opacity-0 scale-95"
       class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 relative overflow-hidden"
       x-data="{
         email:'', password:'', loading:false, showPassword:false, errors:{},
         login(){
           this.errors={};
           if(!this.email)             { this.errors.email='Email requis'; return; }
           if(!this.email.includes('@')){ this.errors.email='Format invalide'; return; }
           if(!this.password)          { this.errors.password='Mot de passe requis'; return; }
           if(this.password.length<6)  { this.errors.password='Min. 6 caractères'; return; }
           this.loading=true;
           setTimeout(()=>{
             this.loading=false;
             showLoginModal=false;
             alert('Connexion réussie !');
           },1500);
         }
       }">
       
    <!-- Decorative elements -->
    <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-mustard to-yellow-500"></div>
    <div class="absolute top-4 right-4 w-16 h-16 bg-soft-blue/10 rounded-full -z-10"></div>
    <div class="absolute bottom-4 left-4 w-12 h-12 bg-mustard/10 rounded-full -z-10"></div>

    <button @click="showLoginModal=false"
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors duration-300">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
      </svg>
    </button>

    <div class="text-center mb-8">
      <div class="w-16 h-16 bg-gradient-to-r from-mustard to-yellow-500 rounded-2xl mx-auto mb-4 flex items-center justify-center shadow-lg">
        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
        </svg>
      </div>
      <h2 class="text-2xl font-bold text-gray-800 mb-2">Connexion Admin</h2>
      <p class="text-gray-600">Accédez à votre espace d'administration</p>
    </div>

    <form @submit.prevent="login" class="space-y-6">
      <div>
        <label for="modal-email" class="block text-sm font-medium text-gray-700 mb-1">Adresse email</label>
        <input id="modal-email" x-model="email" type="email" required
               :class="{'border-red-500': errors.email, 'focus:ring-mustard': !errors.email}"
               class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:outline-none transition-all duration-300"
               placeholder="admin@nobesick.com" />
        <p x-show="errors.email" class="text-red-600 text-sm mt-1" x-text="errors.email"></p>
      </div>

      <div>
        <label for="modal-password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
        <div class="relative">
          <input id="modal-password" x-model="password" :type="showPassword ? 'text' : 'password'" required
                 :class="{'border-red-500': errors.password, 'focus:ring-mustard': !errors.password}"
                 class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:outline-none transition-all duration-300"
                 placeholder="••••••••" />
          <button type="button" @click="showPassword = !showPassword"
                  class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-mustard">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path x-show="!showPassword" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
              <path x-show="!showPassword" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
              <path x-show="showPassword" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
            </svg>
          </button>
        </div>
        <p x-show="errors.password" class="text-red-600 text-sm mt-1" x-text="errors.password"></p>
      </div>

      <div class="flex items-center justify-between">
        <div class="flex items-center">
          <input id="remember-me" name="remember-me" type="checkbox" 
                 class="h-4 w-4 text-mustard focus:ring-mustard border-gray-300 rounded">
          <label for="remember-me" class="ml-2 block text-sm text-gray-700">Se souvenir de moi</label>
        </div>
        <a href="#" class="text-sm text-mustard hover:underline">Mot de passe oublié?</a>
      </div>

      <button type="submit" :disabled="loading"
              class="w-full py-3.5 bg-gradient-to-r from-mustard to-yellow-500 text-white font-medium rounded-xl hover:shadow-lg transition-all duration-300 hover:scale-[1.02] active:scale-95 flex items-center justify-center">
        <span x-show="!loading">Se connecter</span>
        <svg x-show="loading" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
      </button>
    </form>

    <div class="mt-6 text-center">
      <p class="text-sm text-gray-600">
        Pas encore de compte? 
        <button @click="showLoginModal = false; $nextTick(() => showRegisterModal = true)" class="text-mustard font-medium hover:underline">S'inscrire</button>
      </p>
    </div>
  </div>
</div>