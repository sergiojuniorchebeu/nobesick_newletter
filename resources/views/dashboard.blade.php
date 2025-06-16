<!DOCTYPE html>
<html lang="fr" x-data="adminDashboard()">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin – NOBESICK Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'pastel-blue': '#E8F4FD',
            'soft-blue': '#B8E0F5',
            'mustard': '#F4D03F',
            'soft-mustard': '#F9E79F'
          },
          fontFamily: { 'poppins': ['Poppins','sans-serif'] },
          animation: {
            'fade-in': 'fadeIn 0.3s ease-in-out',
            'slide-up': 'slideUp 0.3s ease-out'
          }
        }
      }
    }
  </script>
  <style>
    body { font-family: 'Poppins', sans-serif; }
    [x-cloak] { display: none !important; }
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    @keyframes slideUp { from { transform: translateY(20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
    .glass { backdrop-filter: blur(10px); background: rgba(255,255,255,0.9); }
    .hover-scale { transition: transform 0.2s; }
    .hover-scale:hover { transform: scale(1.02); }
  </style>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script>
    function adminDashboard(){
      return {
        subscribers: [
          {id:1, email:'dr.lefebvre@example.com', date:'2025-06-01', time:'09:12', status:'active'},
          {id:2, email:'medecin.dupont@clinique.fr', date:'2025-06-02', time:'11:45', status:'active'},
          {id:3, email:'sophie.navarro@hopital.net', date:'2025-06-03', time:'14:30', status:'pending'},
          {id:4, email:'alexandre.tremblay@sante.org', date:'2025-06-04', time:'16:05', status:'active'},
          {id:5, email:'julie.martin@cabinet.com', date:'2025-06-05', time:'08:20', status:'active'},
          {id:6, email:'pierre.bernard@medecin.fr', date:'2025-06-06', time:'10:50', status:'pending'},
          {id:7, email:'anne.leroy@clinique.fr', date:'2025-06-07', time:'13:15', status:'active'},
          {id:8, email:'thomas.robert@hopital.net', date:'2025-06-08', time:'15:40', status:'active'},
          {id:9, email:'marie.clerc@sante.org', date:'2025-06-09', time:'17:00', status:'pending'},
          {id:10, email:'laurent.garnier@cabinet.com', date:'2025-06-10', time:'09:55', status:'active'}
        ],
        searchTerm: '',
        selected: new Set(),
        showMailModal: false,
        mailMode: false,
        mailContent: '',
        showNotification: false,
        notificationMsg: '',

        get filtered() {
          return this.subscribers.filter(s =>
            s.email.toLowerCase().includes(this.searchTerm.toLowerCase())
          )
        },
        get stats() {
          return {
            total: this.subscribers.length,
            active: this.subscribers.filter(s => s.status === 'active').length,
            pending: this.subscribers.filter(s => s.status === 'pending').length,
            selected: this.selected.size
          }
        },
        get allSelected() {
          return this.filtered.length && this.filtered.every((_, i) => this.selected.has(i))
        },
        toggleAll() {
          if (this.allSelected) {
            this.selected.clear()
          } else {
            this.filtered.forEach((_, i) => this.selected.add(i))
          }
        },
        toggleOne(i) {
          this.selected.has(i) ? this.selected.delete(i) : this.selected.add(i)
        },
        openMailModal(toAll) {
          if (!toAll && this.selected.size === 0) {
            this.showNotification('⚠️ Veuillez sélectionner au moins un abonné.')
            return
          }
          this.mailMode = toAll
          this.mailContent = ''
          this.showMailModal = true
        },
        closeMailModal() {
          this.showMailModal = false
        },
        performSend() {
          let targets = this.mailMode ? this.filtered : Array.from(this.selected).map(i => this.filtered[i])
          if (!targets.length) {
            this.showNotification('❌ Aucun destinataire sélectionné.')
            this.closeMailModal()
            return
          }
          this.showNotification(`✅ Message envoyé à ${targets.length} destinataire(s) !`)
          this.closeMailModal()
          this.selected.clear()
        },
        showNotification(msg) {
          this.notificationMsg = msg
          this.showNotification = true
          setTimeout(() => this.showNotification = false, 3000)
        },
        deleteSelected() {
          if (this.selected.size === 0) {
            this.showNotification('⚠️ Aucun abonné sélectionné.')
            return
          }
          if (confirm(`Supprimer ${this.selected.size} abonné(s) ?`)) {
            const toDelete = Array.from(this.selected).map(i => this.filtered[i].id)
            this.subscribers = this.subscribers.filter(s => !toDelete.includes(s.id))
            this.selected.clear()
            this.showNotification('🗑️ Abonnés supprimés avec succès.')
          }
        }
      }
    }
  </script>
</head>

<body class="bg-gradient-to-br from-pastel-blue via-blue-50 to-soft-blue min-h-screen">
  <!-- Header -->
  <header class="glass sticky top-0 z-20 shadow-lg border-b border-white/20">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <div class="flex items-center space-x-4">
        <div class="w-10 h-10 bg-gradient-to-r from-mustard to-soft-mustard rounded-xl flex items-center justify-center">
          <span class="text-white font-bold text-lg">N</span>
        </div>
        <div>
          <h1 class="text-2xl font-bold text-gray-800">Admin Dashboard</h1>
          <p class="text-sm text-gray-600">Gestion des abonnés NOBESICK</p>
        </div>
      </div>
      <button onclick="window.location.href='index.html'"
              class="px-6 py-2 glass rounded-xl hover-scale shadow-md border border-white/30">
        ← Retour au site
      </button>
    </div>
  </header>

  <!-- Stats Cards -->
  <div class="max-w-7xl mx-auto px-6 py-6">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
      <div class="glass p-4 rounded-2xl shadow-lg border border-white/30 text-center hover-scale">
        <div class="text-2xl font-bold text-gray-800" x-text="stats.total"></div>
        <div class="text-sm text-gray-600">Total</div>
      </div>
      <div class="glass p-4 rounded-2xl shadow-lg border border-white/30 text-center hover-scale">
        <div class="text-2xl font-bold text-green-600" x-text="stats.active"></div>
        <div class="text-sm text-gray-600">Actifs</div>
      </div>
      <div class="glass p-4 rounded-2xl shadow-lg border border-white/30 text-center hover-scale">
        <div class="text-2xl font-bold text-orange-500" x-text="stats.pending"></div>
        <div class="text-sm text-gray-600">En attente</div>
      </div>
      <div class="glass p-4 rounded-2xl shadow-lg border border-white/30 text-center hover-scale">
        <div class="text-2xl font-bold text-blue-600" x-text="stats.selected"></div>
        <div class="text-sm text-gray-600">Sélectionnés</div>
      </div>
    </div>

    <!-- Actions -->
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
                  class="px-6 py-3 bg-gradient-to-r from-mustard to-yellow-400 text-white rounded-xl hover-scale shadow-lg font-medium">
            📧 Tous
          </button>
          <button @click="openMailModal(false)"
                  class="px-6 py-3 bg-gradient-to-r from-soft-mustard to-yellow-200 text-gray-800 rounded-xl hover-scale shadow-lg font-medium">
            📤 Sélectionnés
          </button>
          <button @click="deleteSelected()"
                  class="px-6 py-3 bg-gradient-to-r from-red-400 to-red-500 text-white rounded-xl hover-scale shadow-lg font-medium">
            🗑️ Supprimer
          </button>
        </div>
      </div>
    </div>

    <!-- Table -->
    <div class="glass rounded-2xl shadow-lg border border-white/30 overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
            <tr>
              <th class="p-4 text-left">
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
                  <span :class="sub.status === 'active' ? 'bg-green-100 text-green-800' : 'bg-orange-100 text-orange-800'"
                        class="px-3 py-1 rounded-full text-xs font-medium" x-text="sub.status === 'active' ? 'Actif' : 'En attente'"></span>
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
    </div>
  </div>

  <!-- Mail Modal -->
  <div x-show="showMailModal" x-cloak
       class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 animate-fade-in"
       @click.self="closeMailModal()">
    <div x-show="showMailModal" x-transition
         class="glass m-4 rounded-3xl shadow-2xl w-full max-w-2xl p-8 animate-slide-up border border-white/30">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">📧 Composer un message</h2>
        <button @click="closeMailModal()"
                class="w-10 h-10 rounded-full glass hover:bg-gray-100 flex items-center justify-center">
          ✕
        </button>
      </div>
      <textarea x-model="mailContent"
                class="w-full h-48 p-4 glass rounded-2xl border border-white/30 focus:outline-none focus:ring-2 focus:ring-mustard resize-none"
                placeholder="Rédigez votre message ici..."></textarea>
      <div class="mt-6 flex justify-end gap-3">
        <button @click="closeMailModal()"
                class="px-6 py-3 glass rounded-xl hover-scale border border-white/30">
          Annuler
        </button>
        <button @click="performSend()"
                class="px-8 py-3 bg-gradient-to-r from-mustard to-yellow-400 text-white rounded-xl hover-scale shadow-lg font-medium">
          📤 Envoyer
        </button>
      </div>
    </div>
  </div>

  <!-- Notification -->
  <div x-show="showNotification" x-cloak
       class="fixed top-4 right-4 z-50 glass p-4 rounded-2xl shadow-lg border border-white/30 animate-slide-up">
    <div x-text="notificationMsg" class="font-medium text-gray-800"></div>
  </div>
</body>
</html>