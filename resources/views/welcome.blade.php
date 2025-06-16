{{-- resources/views/welcome.blade.php --}}
<!DOCTYPE html>
<html lang="fr"
      x-data="{ showLoginModal: false, showRegisterModal: false }"
      x-cloak
>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Newsletter NOBESICK</title>

  <!-- Google Fonts - Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- TailwindCSS -->
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
    };
  </script>

  <!-- Keyframes pour les animations -->
  <style>
    @keyframes modalAppear { from { opacity: 0; transform: scale(.95) translateY(-10px); } to { opacity:1; transform: scale(1) translateY(0);} }
    @keyframes backdropAppear { from { opacity:0; } to { opacity:1; } }
    @keyframes float { 0%,100%{ transform: translateY(0); } 50%{ transform: translateY(-10px); } }
    @keyframes slideUp { from { transform: translateY(20px); opacity:0; } to { transform: translateY(0); opacity:1; } }
    @keyframes fadeIn { from { opacity:0; } to { opacity:1; } }

    [x-cloak] { display:none!important; }
    body { font-family:'Poppins',sans-serif; scroll-behavior:smooth; }
    header { transition: background-color .3s, opacity .3s; }
    .glass-effect { backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); }
    .gradient-border { background: linear-gradient(45deg,#F4D03F,#B8E0F5); padding:2px; border-radius:12px; }
    .gradient-border > div { background:white; border-radius:10px; }
  </style>

  <!-- Alpine.js + ton helper registrationForm() -->
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script>
    function registrationForm(){
      return {
        name:'', email:'', password:'', password_confirmation:'',
        errors:{}, success:false,
        register(){
          this.errors={}; this.success=false;
          if(!this.name) this.errors.name='Nom requis';
          if(!this.email) this.errors.email='Email requis';
          else if(!/.+@.+\..+/.test(this.email)) this.errors.email='Format invalide';
          if(!this.password) this.errors.password='Mot de passe requis';
          if(this.password && this.password_confirmation!==this.password){
            this.errors.password_confirmation='Les mots de passe ne correspondent pas';
          }
          if(Object.keys(this.errors).length===0){
            // ici tu appelleras ton back-end…
            this.success = true;
          }
        }
      }
    }
  </script>
</head>

<body class="flex flex-col min-h-screen bg-gradient-to-br from-pastel-blue via-blue-50 to-soft-blue font-poppins">

  {{-- Header --}}
  @include('welcome.header')

  {{-- Modals --}}
  @include('welcome.login-modal')
  @include('welcome.register-modal')

  {{-- Contenu principal --}}
  <main class="flex-grow pt-20 pb-16 relative floating-elements">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      @include('welcome.hero')
      @include('welcome.newsletter')
      @include('welcome.about')
    </div>
  </main>

  {{-- Footer & Scroll-to-top --}}
  @include('welcome.footer')
  @include('welcome.scroll-to-top')

  <!-- Script pour l’opacité du header au scroll -->
  <script>
    const header = document.querySelector('header');
    window.addEventListener('scroll', () => {
      header.classList.toggle('bg-white/50', window.scrollY > 50);
      header.classList.toggle('bg-white/80', window.scrollY <= 50);
    });
  </script>
</body>
</html>