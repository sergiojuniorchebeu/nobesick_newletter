{{-- resources/views/dashboard/partials/actions_and_table.blade.php --}}
{{-- Actions --}}
<div class="glass p-6 rounded-2xl shadow-lg border border-white/30 mb-6">
    <div class="flex flex-col lg:flex-row gap-4 items-center">
      <div class="flex-1 relative">
        <input type="text" x-model="searchTerm"
               placeholder="🔍 Rechercher par email..."
               class="w-full px-4 py-3 pl-12 glass rounded-xl border border-white/30 focus:outline-none focus:ring-2 focus:ring-mustard"/>
        <span class="absolute left-4 top-3.5 text-gray-400">🔍</span>
      </div>
      <div class="flex gap-2">
        <button @click="openMailModal(true)"
                class="px-6 py-3 bg-gradient-to-r from-mustard to-yellow-400 text-white rounded-xl hover-scale shadow-lg font-medium">📧 Tous</button>
        <button @click="openMailModal(false)"
                class="px-6 py-3 bg-gradient-to-r from-soft-mustard to-yellow-200 text-gray-800 rounded-xl hover-scale shadow-lg font-medium">📤 Sélectionnés</button>
        <button @click="deleteSelected()"
                class="px-6 py-3 bg-gradient-to-r from-red-400 to-red-500 text-white rounded-xl hover-scale shadow-lg font-medium">🗑️ Supprimer</button>
      </div>
    </div>
  </div>
  
  {{-- Tableau --}}
  <div class="glass rounded-2xl shadow-lg border border-white/30 overflow-hidden">
    <table class="w-full">
      <thead class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
        <tr>
          <th class="p-4">
            <input type="checkbox" @click="toggleAll()" :checked="allSelected"
                   class="w-5 h-5 rounded border-gray-300 text-mustard focus:ring-mustard"/>
          </th>
          <th class="p-4 text-left font-semibold text-gray-700">Email</th>
          <th class="p-4 text-left font-semibold text-gray-700">Date</th>
          <th class="p-4 text-left font-semibold text-gray-700">Heure</th>
          <th class="p-4 text-left font-semibold text-gray-700">Statut</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100">
        <template x-for="(sub, idx) in filtered" :key="sub.id">
          <tr class="hover:bg-blue-50/50 transition-colors">
            <td class="p-4">
              <input type="checkbox" @click="toggleOne(idx)" :checked="selected.has(idx)"
                     class="w-5 h-5 rounded border-gray-300 text-mustard focus:ring-mustard"/>
            </td>
            <td class="p-4 font-medium text-gray-800" x-text="sub.email"></td>
            <td class="p-4 text-gray-600" x-text="sub.date"></td>
            <td class="p-4 text-gray-600" x-text="sub.time"></td>
            <td class="p-4">
              <span :class="sub.status==='active'? 'bg-green-100 text-green-800':'bg-orange-100 text-orange-800'"
                    class="px-3 py-1 rounded-full text-xs font-medium"
                    x-text="sub.status==='active'? 'Actif':'En attente'">
              </span>
            </td>
          </tr>
        </template>
        <tr x-show="!filtered.length" x-cloak>
          <td colspan="5" class="p-8 text-center text-gray-500">
            <div class="text-4xl mb-2">🔍</div>
            <div>Aucun abonné trouvé</div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  