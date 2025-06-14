<!DOCTYPE html>
<html lang="fr" x-data="adminDashboard()">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin – NOBESICK Dashboard</title>

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
          }
        }
      }
    }
  </script>

  <style>
    body { font-family:'Poppins',sans-serif; }
    header { backdrop-filter:blur(10px); -webkit-backdrop-filter:blur(10px); background:rgba(255,255,255,0.8); }
    table th, table td { white-space: nowrap; }
    [x-cloak] { display:none !important; }
  </style>

  <!-- Alpine.js -->
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script>
    function adminDashboard(){
      return {
        // Données fictives
        subscribers: [
          {email:'dr.lefebvre@example.com',       date:'2025-06-01', time:'09:12'},
          {email:'medecin.dupont@clinique.fr',    date:'2025-06-02', time:'11:45'},
          {email:'sophie.navarro@hopital.net',    date:'2025-06-03', time:'14:30'},
          {email:'alexandre.tremblay@sante.org',  date:'2025-06-04', time:'16:05'},
          {email:'julie.martin@cabinet.com',      date:'2025-06-05', time:'08:20'},
          {email:'pierre.bernard@medecin.fr',     date:'2025-06-06', time:'10:50'},
          {email:'anne.leroy@clinique.fr',        date:'2025-06-07', time:'13:15'},
          {email:'thomas.robert@hopital.net',     date:'2025-06-08', time:'15:40'},
          {email:'marie.clerc@sante.org',         date:'2025-06-09', time:'17:00'},
          {email:'laurent.garnier@cabinet.com',   date:'2025-06-10', time:'09:55'}
        ],
        searchTerm: '',
        selected: new Set(),
        showMailModal: false,
        mailMode: false,      // true = tous, false = sélectionnés
        mailContent: '',

        get filtered() {
          return this.subscribers.filter(s =>
            s.email.toLowerCase().includes(this.searchTerm.toLowerCase())
          )
        },
        get allSelected() {
          return this.filtered.length
            && this.filtered.every((_, i) => this.selected.has(i))
        },
        toggleAll() {
          if (this.allSelected) {
            this.filtered.forEach((_, i) => this.selected.delete(i))
          } else {
            this.filtered.forEach((_, i) => this.selected.add(i))
          }
        },
        toggleOne(i) {
          this.selected.has(i) ? this.selected.delete(i) : this.selected.add(i)
        },
        openMailModal(toAll) {
          // si on veut envoyer aux sélectionnés sans en avoir → avertir
          if (!toAll && this.selected.size === 0) {
            alert("Veuillez sélectionner au moins un abonné.")
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
          let targets = this.mailMode
            ? this.filtered
            : Array.from(this.selected).map(i => this.filtered[i])

          if (!targets.length) {
            alert("Aucun destinataire.")
            this.closeMailModal()
            return
          }
          // Simulation d'envoi
          alert(`Message envoyé à ${targets.length} destinataire(s) :\n\n${this.mailContent}`)
          this.closeMailModal()
        }
      }
    }
  </script>
</head>

<body class="bg-gradient-to-br from-pastel-blue via-blue-50 to-soft-blue min-h-screen flex flex-col">

  <!-- Header -->
  <header class="sticky top-0 z-20 shadow">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
      <div class="flex items-center space-x-3">
        <img src="img/logo.jpeg" alt="Logo" class="w-8 h-8 rounded"/>
        <h1 class="text-2xl font-bold text-gray-800">Admin Dashboard</h1>
      </div>
      <button onclick="window.location.href='index.html'"
              class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded">Retour au site</button>
    </div>
  </header>

  <!-- Main -->
  <main class="flex-grow max-w-7xl mx-auto p-4">
    <!-- Actions + Recherche -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
      <div class="flex items-center space-x-3 w-full md:w-auto">
        <input type="text" x-model="searchTerm"
               placeholder="🔍 Rechercher par email..."
               class="flex-grow md:flex-none w-full md:w-64 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-soft-blue"/>
        <span class="text-gray-600">Affichés : <strong x-text="filtered.length"></strong></span>
      </div>
      <div class="flex space-x-2">
        <button @click="openMailModal(true)"
                class="px-4 py-2 bg-mustard text-white rounded hover:bg-yellow-400">
          Envoyer à tous
        </button>
        <button @click="openMailModal(false)"
                class="px-4 py-2 bg-soft-mustard text-gray-800 rounded hover:bg-yellow-200">
          Envoyer sélectionnés
        </button>
      </div>
    </div>

    <!-- Tableau -->
    <div class="overflow-x-auto bg-white rounded-lg shadow">
      <table class="w-full table-auto">
        <thead class="bg-gray-100">
          <tr>
            <th class="p-3">
              <input type="checkbox" @click="toggleAll()" :checked="allSelected"
                     class="h-4 w-4"/>
            </th>
            <th class="p-3 text-left">Email</th>
            <th class="p-3 text-left">Date</th>
            <th class="p-3 text-left">Heure</th>
          </tr>
        </thead>
        <tbody>
          <template x-for="(sub, idx) in filtered" :key="idx">
            <tr class="border-b hover:bg-gray-50">
              <td class="p-3">
                <input type="checkbox"
                       @click="toggleOne(idx)"
                       :checked="selected.has(idx)"
                       class="h-4 w-4"/>
              </td>
              <td class="p-3 text-gray-800" x-text="sub.email"></td>
              <td class="p-3 text-gray-600" x-text="sub.date"></td>
              <td class="p-3 text-gray-600" x-text="sub.time"></td>
            </tr>
          </template>
          <tr x-show="!filtered.length">
            <td colspan="4" class="p-6 text-center text-gray-500">Aucun abonné trouvé.</td>
          </tr>
        </tbody>
      </table>
    </div>
  </main>

  <!-- Modal de composition -->
  <div x-show="showMailModal" x-cloak
       class="fixed inset-0 z-30 flex items-center justify-center bg-black/50"
       @click.self="closeMailModal()">
    <div x-show="showMailModal" x-transition
         class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-6 relative">
      <button @click="closeMailModal()"
              class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
        ✕
      </button>
      <h2 class="text-xl font-bold mb-4">Rédiger le message à envoyer</h2>
      <textarea x-model="mailContent"
                class="w-full h-40 p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-soft-blue"
                placeholder="Votre texte ici..."></textarea>
      <div class="mt-4 flex justify-end space-x-2">
        <button @click="closeMailModal()"
                class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
          Annuler
        </button>
        <button @click="performSend()"
                class="px-4 py-2 bg-mustard text-white rounded hover:bg-yellow-400">
          Envoyer
        </button>
      </div>
    </div>
  </div>

</body>
</html>
