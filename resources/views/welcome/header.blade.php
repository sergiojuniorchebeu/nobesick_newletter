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
  