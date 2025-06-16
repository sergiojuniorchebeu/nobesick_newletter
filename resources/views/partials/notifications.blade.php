{{-- resources/views/dashboard/partials/notification.blade.php --}}
<div x-show="showNotif" x-cloak
     class="fixed top-4 right-4 z-50 glass p-4 rounded-2xl shadow-lg border border-white/30 animate-slide-up">
  <div x-text="notifMsg" class="font-medium text-gray-800"></div>
</div>
