{{-- resources/views/welcome/header.blade.php --}}
<header class="fixed top-0 w-full z-50 glass-effect bg-transparent shadow-sm transition-all duration-300">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 md:py-3 flex justify-between items-center">
      <div class="flex items-center space-x-3 group">
        <img src="{{ asset('img/logo.jpeg') }}" alt="Logo NOBESICK" 
             class="w-10 h-10 rounded-lg shadow-md group-hover:rotate-[-5deg] transition-transform duration-300">
        <span class="text-xl font-bold text-gray-800 group-hover:text-customred transition-colors duration-300">NOBESICK</span>
      </div>
  
      <div class="hidden md:flex space-x-6 items-center">
        <a href="#newsletter" class="text-gray-600 hover:text-customred font-medium transition-colors duration-300 relative after:content-[''] after:absolute after:bottom-[-2px] after:left-0 after:w-0 after:h-0.5 after:bg-customred after:transition-all after:duration-300 hover:after:w-full">Newsletter</a>
        <a href="#about"    class="text-gray-600 hover:text-customred font-medium transition-colors duration-300 relative after:content-[''] after:absolute after:bottom-[-2px] after:left-0 after:w-0 after:h-0.5 after:bg-customred after:transition-all after:duration-300 hover:after:w-full">À propos</a>
        <a href="#contact"  class="text-gray-600 hover:text-customred font-medium transition-colors duration-300 relative after:content-[''] after:absolute after:bottom-[-2px] after:left-0 after:w-0 after:h-0.5 after:bg-customred after:transition-all after:duration-300 hover:after:w-full">Contact</a>
        <button @click="showLoginModal = true" class="px-4 py-2 rounded-xl bg-gradient-to-r from-customred to-red-500 text-white font-medium hover:shadow-lg transition-all duration-300 hover:scale-[1.02] active:scale-95">Connexion</button>
      </div>
  
      <!-- Mobile menu -->
      <div class="md:hidden flex items-center" x-data="{ mobileMenuOpen: false }">
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-600 hover:text-customred p-2 rounded-lg focus:outline-none">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            <path x-show="mobileMenuOpen"  stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" class="hidden"/>
          </svg>
        </button>
  
        <div
          x-show="mobileMenuOpen"
          @click.away="mobileMenuOpen = false"
          x-transition:enter="transition ease-out duration-300"
          x-transition:enter-start="opacity-0 scale-95"
          x-transition:enter-end="opacity-100 scale-100"
          x-transition:leave="transition ease-in duration-200"
          x-transition:leave-start="opacity-100 scale-100"
          x-transition:leave-end="opacity-0 scale-95"
          class="absolute top-full left-0 right-0 bg-white shadow-lg rounded-b-lg p-4 space-y-4 glass-effect"
        >
          <a href="#newsletter" @click="mobileMenuOpen = false" class="block px-4 py-2 text-gray-600 hover:text-customred hover:bg-gray-50 rounded-lg transition-colors duration-300">Newsletter</a>
          <a href="#about"    @click="mobileMenuOpen = false" class="block px-4 py-2 text-gray-600 hover:text-customred hover:bg-gray-50 rounded-lg transition-colors duration-300">À propos</a>
          <a href="#contact"  @click="mobileMenuOpen = false" class="block px-4 py-2 text-gray-600 hover:text-customred hover:bg-gray-50 rounded-lg transition-colors duration-300">Contact</a>
          <button @click="showLoginModal = true; mobileMenuOpen = false" class="w-full px-4 py-2 rounded-lg bg-gradient-to-r from-customred to-red-500 text-white font-medium hover:shadow-lg transition-all duration-300">Connexion</button>
        </div>
      </div>
    </nav>
  </header>
  