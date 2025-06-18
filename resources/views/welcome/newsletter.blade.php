<section id="newsletter" class="mb-20">
  <div class="gradient-border max-w-5xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-2 overflow-hidden">
      <div class="p-8 lg:p-12">
        @if(session('success'))
          <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)"
               x-show="show" x-transition:enter="transition ease-out duration-300"
               x-transition:enter-start="opacity-0 transform scale-95"
               x-transition:enter-end="opacity-100 transform scale-100"
               class="text-center mb-8 animate-slide-up">
            <div class="inline-flex items-center justify-center w-16 h-16 
                        bg-gradient-to-r from-soft-mustard to-mustard rounded-full 
                        animate-pulse-soft mx-auto mb-4">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
              </svg>
            </div>
            <h3 class="text-3xl font-bold text-gray-800 mb-2">Merci !</h3>
            <p class="text-gray-600">{{ session('success') }}</p>
          </div>
        @endif

        <form action="{{ route('subscribe') }}" method="POST" class="space-y-6">
          @csrf
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Adresse email *</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required
                   placeholder="votre.email@exemple.com"
                   class="mt-1 w-full px-4 py-3 border-2 border-gray-200 rounded-xl 
                          focus:outline-none focus:ring-2 focus:ring-soft-blue transition" />
            @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
          </div>
            <button type="submit"
                class="w-full py-4 bg-customred  
                   text-white font-semibold rounded-xl hover:bg-red-600 transition">
            S’inscrire gratuitement
            </button>
        </form>
      </div>
      <div class="hidden lg:flex relative w-full h-[500px] overflow-hidden">
        <img src="img/image.jpeg" alt="Santé et bien-être"
             class="absolute inset-0 w-full h-full object-cover" />
      </div>
    </div>
  </div>
</section>
