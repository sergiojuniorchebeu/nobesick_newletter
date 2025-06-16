{{-- resources/views/dashboard/partials/stats.blade.php --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
    <template x-for="(label, key) in {Total:stats.total, Actifs:stats.active, 'En attente':stats.pending, Sélectionnés:stats.selected}" :key="key">
      <div class="glass p-4 rounded-2xl shadow-lg border border-white/30 text-center hover-scale">
        <div class="text-2xl font-bold text-gray-800" x-text="label"></div>
        <div class="text-sm text-gray-600" x-text="key"></div>
      </div>
    </template>
  </div>
  