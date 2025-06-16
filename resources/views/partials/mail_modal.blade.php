{{-- resources/views/dashboard/partials/mail_modal.blade.php --}}
<div x-show="showMailModal" x-cloak
     class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 animate-fade-in"
     @click.self="closeMailModal()">
  <div x-transition
       class="glass m-4 rounded-3xl shadow-2xl w-full max-w-2xl p-8 animate-slide-up border border-white/30">
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-2xl font-bold text-gray-800">📧 Composer un message</h2>
      <button @click="closeMailModal()"
              class="w-10 h-10 rounded-full glass hover-scale flex items-center justify-center">✕</button>
    </div>
    <textarea x-model="mailContent"
              class="w-full h-48 p-4 glass rounded-2xl border border-white/30 focus:outline-none focus:ring-2 focus:ring-mustard resize-none"
              placeholder="Rédigez votre message..."></textarea>
    <div class="mt-6 flex justify-end gap-3">
      <button @click="closeMailModal()"
              class="px-6 py-3 glass rounded-xl hover-scale border border-white/30">Annuler</button>
      <button @click="performSend()"
              class="px-8 py-3 bg-gradient-to-r from-mustard to-yellow-400 text-white rounded-xl hover-scale shadow-lg font-medium">📤 Envoyer</button>
    </div>
  </div>
</div>
