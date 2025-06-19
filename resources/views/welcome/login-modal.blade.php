<div x-show="showLoginModal" x-cloak
     x-transition:enter="animate-backdrop-appear" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm px-4"
     @click.self="showLoginModal = false">
  <div x-show="showLoginModal" x-cloak
       x-transition:enter="animate-modal-appear" x-transition:leave="transition-all duration-200"
       x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
       class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 relative"
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
    <button @click="showLoginModal=false"
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 bg-white rounded-full p-1">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M6 18L18 6M6 6l12 12"/>
      </svg>
    </button>
    <div class="text-center mb-8">
      <div class="w-16 h-16 bg-gradient-to-r from-mustard to-yellow-500 rounded-2xl mx-auto mb-4 flex items-center justify-center">
        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
        </svg>
      </div>
      <h2 class="text-2xl font-bold text-gray-800 mb-2">Connexion Admin</h2>
      <p class="text-gray-600">Accédez à votre espace d'administration</p>
    </div>
    <form action="{{ route('login.submit') }}" method="POST" class="space-y-6">
      @csrf
      <div>
        <label for="modal-email" class="block text-sm font-medium text-gray-700 mb-1">Adresse email</label>
        <input id="modal-email" name="email" type="email" required
               class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-soft-blue"
               placeholder="admin@nobesick.com" />
        @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>
      <div>
        <label for="modal-password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
        <input id="modal-password" name="password" type="password" required
               class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-soft-blue"
               placeholder="••••••••" />
        @error('password') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>
      <button type="submit"
              class="w-full py-3 bg-gradient-to-r from-mustard to-yellow-500 text-white rounded-xl">
        Se connecter
      </button>
    </form>
  </div>
</div>