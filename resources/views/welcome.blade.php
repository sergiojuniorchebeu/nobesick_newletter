<!DOCTYPE html>
<html lang="fr" x-data="{ showLoginModal: false }">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Newsletter NOBESICK</title>

  <!-- Google Fonts - Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Tailwind CSS & config -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'pastel-blue':  '#E8F4FD',
            'soft-blue':    '#B8E0F5',
            'mustard':      '#F4D03F',
            'soft-mustard': '#F9E79F'
          },
          fontFamily: {
            'poppins': ['Poppins','sans-serif']
          },
          animation: {
            'float':         'float 3s ease-in-out infinite',
            'pulse-soft':    'pulse 2s cubic-bezier(0.4,0,0.6,1) infinite',
            'slide-up':      'slideUp 0.5s ease-out',
            'fade-in':       'fadeIn 0.6s ease-out',
            'modal-appear':  'modalAppear 0.3s ease-out',
            'backdrop-appear':'backdropAppear 0.3s ease-out'
          }
        }
      }
    }
  </script>

  <style>
    /* Modal & backdrop keyframes */
    @keyframes modalAppear {
      from { opacity: 0; transform: scale(0.95) translateY(-10px); }
      to   { opacity: 1; transform: scale(1)    translateY(0); }
    }
    @keyframes backdropAppear {
      from { opacity: 0; }
      to   { opacity: 1; }
    }
    /* Core keyframes */
    @keyframes float {
      0%,100% { transform: translateY(0); }
      50%     { transform: translateY(-10px); }
    }
    @keyframes slideUp {
      from { transform: translateY(20px); opacity: 0; }
      to   { transform: translateY(0);     opacity: 1; }
    }
    @keyframes fadeIn {
      from { opacity: 0; }
      to   { opacity: 1; }
    }
    /* Utilities */
    body { font-family:'Poppins',sans-serif; scroll-behavior:smooth; }
    header { transition: background-color .3s, opacity .3s; }
    [x-cloak] { display:none !important; }
    .glass-effect { backdrop-filter:blur(10px); -webkit-backdrop-filter:blur(10px); }
    .gradient-border { background:linear-gradient(45deg,#F4D03F,#B8E0F5); padding:2px; border-radius:12px; }
    .gradient-border > div { background:white; border-radius:10px; }
  </style>

  <!-- Alpine.js -->
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="flex flex-col min-h-screen bg-gradient-to-br from-pastel-blue via-blue-50 to-soft-blue font-poppins">
  <!-- Header -->
  <header class="fixed top-0 w-full z-50 glass-effect bg-white/80 shadow-sm">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
      <div class="flex items-center space-x-3">
        <img src="img/logo.jpeg" alt="Logo NOBESICK" class="w-10 h-10 rounded-lg shadow-md">
        <span class="text-xl font-bold text-gray-800">NOBESICK</span>
      </div>
      <div class="hidden md:flex space-x-6">
        <a href="#newsletter" class="text-gray-600 hover:text-mustard font-medium">Newsletter</a>
        <a href="#about"      class="text-gray-600 hover:text-mustard font-medium">À propos</a>
        <a href="#contact"    class="text-gray-600 hover:text-mustard font-medium">Contact</a>
        <button @click="showLoginModal = true" class="text-gray-600 hover:text-mustard font-medium">Connexion</button>
      </div>
      <!-- Mobile menu -->
      <div class="md:hidden" x-data="{ mobileMenuOpen: false }">
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-600 hover:text-mustard">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>
        <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false"
             class="absolute top-full left-0 right-0 bg-white shadow-lg rounded-b-lg p-4 space-y-2">
          <a href="#newsletter" class="block text-gray-600 hover:text-mustard font-medium">Newsletter</a>
          <a href="#about"      class="block text-gray-600 hover:text-mustard font-medium">À propos</a>
          <a href="#contact"    class="block text-gray-600 hover:text-mustard font-medium">Contact</a>
          <button @click="showLoginModal = true; mobileMenuOpen = false"
                  class="block w-full text-left text-gray-600 hover:text-mustard font-medium">Connexion</button>
        </div>
      </div>
    </nav>
  </header>

  <!-- Login Modal -->
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
             if(!this.email)            { this.errors.email='Email requis'; return; }
             if(!this.email.includes('@')){ this.errors.email='Format invalide'; return; }
             if(!this.password)         { this.errors.password='Mot de passe requis'; return; }
             if(this.password.length<6) { this.errors.password='Min. 6 caractères'; return; }
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
      <form @submit.prevent="login()" class="space-y-6">
        <div>
          <label for="modal-email" class="block text-sm font-medium text-gray-700 mb-2">Adresse email</label>
          <div class="relative">
            <input id="modal-email" type="email" x-model="email" placeholder="admin@nobesick.com"
                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-soft-blue transition"
                   :class="errors.email ? 'border-red-300 focus:ring-red-200' : ''"/>
            <p x-show="errors.email" x-text="errors.email" class="text-red-600 text-sm mt-1"></p>
          </div>
        </div>
        <div>
          <label for="modal-password" class="block text-sm font-medium text-gray-700 mb-2">Mot de passe</label>
          <div class="relative">
            <input id="modal-password" :type="showPassword ? 'text':'password'" x-model="password" placeholder="••••••••"
                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-soft-blue pr-12 transition"
                   :class="errors.password ? 'border-red-300 focus:ring-red-200' : ''"/>
            <button type="button" @click="showPassword = !showPassword"
                    class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-gray-600">
              <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
              </svg>
              <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242"/>
              </svg>
            </button>
            <p x-show="errors.password" x-text="errors.password" class="text-red-600 text-sm mt-1"></p>
          </div>
        </div>
        <button type="submit" :disabled="loading"
                class="w-full py-3 bg-gradient-to-r from-mustard to-yellow-500 text-white font-semibold rounded-xl hover:from-yellow-500 hover:to-mustard transition disabled:opacity-50 shadow-lg">
          <span x-show="!loading">Se connecter</span>
          <span x-show="loading" class="flex items-center justify-center">
            <svg class="animate-spin h-5 w-5 mr-2 text-white" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"/>
            </svg>Connexion...
          </span>
        </button>
        <div class="text-center">
          <a href="#" class="text-sm text-mustard hover:underline">Mot de passe oublié ?</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Main content -->
  <main class="flex-grow pt-20 pb-16 relative floating-elements">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <!-- Hero -->
      <div class="text-center mb-16 animate-fade-in">
        <h1 class="text-5xl md:text-6xl font-bold text-gray-800 mb-6 leading-tight">
          Boostez votre cabinet, <br>
          <span class="bg-gradient-to-r from-mustard to-yellow-500 bg-clip-text text-transparent">
            simplifiez votre quotidien
          </span>
        </h1>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
          NOBESICK accompagne les médecins avec la gestion des rendez-vous, l'assurance intégrée et bien plus, sur une seule plateforme.
        </p>
      </div>

      <!-- Newsletter section -->
      <section id="newsletter" class="mb-20">
        <div class="gradient-border max-w-5xl mx-auto">
          <div class="grid grid-cols-1 lg:grid-cols-2 overflow-hidden">
            <!-- Form -->
            <div class="p-8 lg:p-12" x-data="{
              email:'', submitted:false, loading:false, errors:{},
              submit(){
                this.errors={};
                if(!this.email){ this.errors.email='Email requis'; return; }
                if(!this.email.includes('@')||!this.email.includes('.')){
                  this.errors.email='Format invalide'; return;
                }
                this.loading=true;
                setTimeout(()=>{ this.submitted=true; this.loading=false },1200);
              }
            }">
              <h2 class="text-4xl font-bold text-gray-800 mb-4">Newsletter <span class="text-mustard">NOBESICK</span></h2>
              <p class="text-lg text-gray-600 mb-8">
                Inscrivez-vous pour découvrir comment gérer vos rendez-vous, assurances et autres fonctionnalités de NOBESICK.
              </p>
              <template x-if="!submitted">
                <form @submit.prevent="submit()" class="space-y-6 animate-slide-up">
                  <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Adresse email *</label>
                    <input id="email" type="email" x-model="email" required
                           placeholder="votre.email@exemple.com"
                           class="mt-1 w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-soft-blue transition"
                           :class="errors.email?'border-red-300':''"/>
                    <p x-show="errors.email" x-text="errors.email" class="text-red-600 text-sm mt-1"></p>
                  </div>
                  <button type="submit" :disabled="loading"
                          class="w-full py-4 bg-gradient-to-r from-mustard to-yellow-500 text-white font-semibold rounded-xl hover:from-yellow-500 hover:to-mustard transition disabled:opacity-50">
                    <span x-show="!loading">S'inscrire gratuitement</span>
                    <span x-show="loading" class="flex items-center justify-center">
                      <svg class="animate-spin h-5 w-5 mr-2 text-white" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"/>
                      </svg>En cours...
                    </span>
                  </button>
                </form>
              </template>
              <template x-if="submitted">
                <div class="text-center animate-slide-up">
                  <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-soft-mustard to-mustard rounded-full animate-pulse-soft mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                  </div>
                  <h3 class="text-3xl font-bold text-gray-800 mb-2">Merci !</h3>
                  <p class="text-gray-600">Vous recevrez bientôt nos contenus exclusifs.</p>
                </div>
              </template>
            </div>
            <!-- Illustration sans overlay -->
            <div class="hidden lg:flex relative w-full h-[500px] overflow-hidden">
              <!-- Image seule -->
              <img
                src="img/image.jpeg"
                alt="Santé et bien-être"
                class="absolute inset-0 w-full h-full object-cover"
              />
  >
            </div>            
          </div>
        </div>
      </section>

      <!-- Section Avantages -->
      <section id="about" class="mb-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-4xl font-bold text-gray-800 mb-4">Pourquoi passer à NOBESICK?</h2>
          <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Simplifiez la gestion de votre cabinet grâce à nos fonctionnalités clés.
          </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <!-- Gestion des rendez-vous -->
          <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-8 shadow-lg hover:shadow-xl transition-transform duration-300 hover:scale-105">
            <div class="w-12 h-12 bg-gradient-to-r from-mustard to-yellow-500 rounded-xl mb-6 flex items-center justify-center">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-4">Gestion des rendez-vous</h3>
            <p class="text-gray-600 leading-relaxed">
              Planifiez et suivez vos consultations en quelques clics.
            </p>
          </div>
          <!-- Assurance intégrée -->
          <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-8 shadow-lg hover:shadow-xl transition-transform duration-300 hover:scale-105">
            <div class="w-12 h-12 bg-gradient-to-r from-soft-blue to-blue-500 rounded-xl mb-6 flex items-center justify-center">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12h6m2 0a2 2 0 012 2v4a2 2 0 01-2 2H7a2 2 0 01-2-2v-4a2 2 0 012-2m0-4V5a2 2 0 012-2h4a2 2 0 012 2v3"/>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-4">Assurance intégrée</h3>
            <p class="text-gray-600 leading-relaxed">
              Gérez feuilles de soins et remboursements directement depuis la plateforme.
            </p>
          </div>
          <!-- Analytique avancée -->
          <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-8 shadow-lg hover:shadow-xl transition-transform duration-300 hover:scale-105">
            <div class="w-12 h-12 bg-gradient-to-r from-green-400 to-green-600 rounded-xl mb-6 flex items-center justify-center">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11 3.055A9 9 0 1020.945 13H11V3.055z"/>
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-4">Analytique avancée</h3>
            <p class="text-gray-600 leading-relaxed">
              Suivez vos indicateurs clés et optimisez vos performances.
            </p>
          </div>
        </div>
      </section>
    </div>
  </main>

  <!-- Footer -->
  <footer id="contact" class="bg-soft-blue text-gray-800">
    <div class="max-w-7xl mx-auto px-4 py-16 grid grid-cols-1 md:grid-cols-4 gap-8">
      <!-- Logo & desc -->
      <div class="md:col-span-2">
        <div class="flex items-center space-x-2 mb-6">
          <img src="img/logo.jpeg" alt="Logo NOBESICK" class="w-10 h-10 rounded-lg shadow-md">
          <span class="text-2xl font-bold">NOBESICK</span>
        </div>
        <p class="text-gray-700 leading-relaxed mb-6 max-w-md">
          Votre partenaire de confiance pour une vie plus saine. Nous rendons l'information santé accessible et compréhensible pour tous.
        </p>
        <div class="flex space-x-4">
          <!-- social icons -->
          <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-mustard transition-colors text-white">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-…z"/></svg>
          </a>
          <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-mustard transition-colors text-white">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22.46 6c-…z"/></svg>
          </a>
          <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-mustard transition-colors text-white">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554…z"/></svg>
          </a>
        </div>
      </div>
      <!-- Liens rapides -->
      <div>
        <h4 class="text-lg font-semibold mb-6">Liens rapides</h4>
        <ul class="space-y-3">
          <li><a href="#newsletter" class="hover:text-mustard transition-colors">Newsletter</a></li>
          <li><a href="#about"      class="hover:text-mustard transition-colors">À propos</a></li>
          <li><a href="#"           class="hover:text-mustard transition-colors">Blog</a></li>
          <li><a href="#"           class="hover:text-mustard transition-colors">Ressources</a></li>
        </ul>
      </div>
      <!-- Contact -->
      <div>
        <h4 class="text-lg font-semibold mb-6">Contact</h4>
        <ul class="space-y-3">
          <li class="flex items-start space-x-3">
            <svg class="w-5 h-5 text-mustard mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 8l7.89 4.26…"/>
            </svg>
            <span>contact@nobesick.com</span>
          </li>
          <li class="flex items-start space-x-3">
            <svg class="w-5 h-5 text-mustard mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17.657 16.657…"/>
            </svg>
            <span>Yaoundé, Cameroun</span>
          </li>
        </ul>
      </div>
    </div>
    <div class="border-t border-gray-300 mt-12 pt-8">
      <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center">
        <p class="text-gray-600 text-sm">© 2025 NOBESICK. Tous droits réservés.</p>
        <div class="flex space-x-6 mt-4 md:mt-0">
          <a href="#" class="text-gray-600 hover:text-mustard text-sm">Politique de confidentialité</a>
          <a href="#" class="text-gray-600 hover:text-mustard text-sm">Conditions d'utilisation</a>
          <a href="#" class="text-gray-600 hover:text-mustard text-sm">Mentions légales</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scroll to top -->
  <button onclick="window.scrollTo({top:0,behavior:'smooth'})"
          class="fixed bottom-8 right-8 w-12 h-12 bg-gradient-to-r from-mustard to-yellow-500 text-white rounded-full shadow-lg hover:scale-110 transition z-50"
          aria-label="Retour en haut">
    <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M5 10l7-7m0 0l7 7m-7-7v18"/>
    </svg>
  </button>

  <!-- Header opacity on scroll -->
  <script>
    const header = document.querySelector('header');
    window.addEventListener('scroll', () => {
      header.classList.toggle('bg-white/50', window.scrollY > 50);
      header.classList.toggle('bg-white/80', window.scrollY <= 50);
    });
  </script>
</body>
</html>
