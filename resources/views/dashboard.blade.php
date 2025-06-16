{{-- resources/views/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="fr" x-data='adminDashboard(@json($subscribers))'>
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
            'soft-blue':   '#F8FAFC',
            'mustard':     '#F4D03F',
            'soft-mustard':'#F9E79F'
          },
          fontFamily: { 'poppins': ['Poppins','sans-serif'] },
          animation: {
            'fade-in': 'fadeIn 0.3s ease-in-out',
            'slide-up':'slideUp 0.3s ease-out'
          }
        }
      }
    }
  </script>
  <style>
    body { font-family: 'Poppins', sans-serif; }
    [x-cloak] { display: none !important; }
    @keyframes fadeIn  { from { opacity: 0 } to { opacity: 1 } }
    @keyframes slideUp { from { transform: translateY(20px); opacity:0 } to { transform: translateY(0); opacity:1 } }
    .glass { backdrop-filter: blur(10px); background: rgba(255,255,255,0.9); }
    .hover-scale { transition: transform .2s }
    .hover-scale:hover { transform: scale(1.02) }
  </style>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script>
  function adminDashboard(initialSubs) {
    return {
      subscribers: initialSubs.map(s => ({
        id:    s.id,
        email: s.email,
        date:  new Date(s.created_at).toLocaleDateString('fr-FR'),
        time:  new Date(s.created_at).toLocaleTimeString('fr-FR',{hour:'2-digit',minute:'2-digit'}),
        // ← On force “active” pour tout le monde
        status: 'active'
      })),
      searchTerm: '', selected: new Set(),
      showMailModal: false, mailMode: false, mailContent: '',
      showNotif: false, notifMsg: '',
        get filtered() {
          return this.subscribers.filter(s =>
            s.email.toLowerCase().includes(this.searchTerm.toLowerCase())
          )
        },
        get stats() {
          return {
            total:    this.subscribers.length,
            active:   this.subscribers.filter(s=>s.status==='active').length,
            pending:  this.subscribers.filter(s=>s.status==='pending').length,
            selected: this.selected.size
          }
        },
        get allSelected() {
          return this.filtered.length && this.filtered.every((_, i) => this.selected.has(i))
        },
        toggleAll() {
          if (this.allSelected) this.selected.clear()
          else this.filtered.forEach((_,i)=> this.selected.add(i))
        },
        toggleOne(i) {
          this.selected.has(i) ? this.selected.delete(i) : this.selected.add(i)
        },
        openMailModal(toAll) {
          if (!toAll && this.selected.size===0) {
            return this.notify('⚠️ Sélectionnez au moins un abonné.')
          }
          this.mailMode = toAll; this.mailContent = ''; this.showMailModal = true
        },
        closeMailModal() {
          this.showMailModal = false
        },
        performSend() {
          let targets = this.mailMode
            ? this.filtered
            : Array.from(this.selected).map(i=>this.filtered[i])
          if (!targets.length) {
            this.notify('❌ Aucun destinataire.')
            this.closeMailModal()
            return
          }
          this.notify(`✅ Message envoyé à ${targets.length} abonné(s).`)
          this.closeMailModal()
          this.selected.clear()
        },
        deleteSelected() {
          if (!this.selected.size) {
            return this.notify('⚠️ Aucun abonné sélectionné.')
          }
          if (!confirm(`Supprimer ${this.selected.size} abonné(s) ?`)) return
          let ids = Array.from(this.selected).map(i=>this.filtered[i].id)
          this.subscribers = this.subscribers.filter(s=>!ids.includes(s.id))
          this.selected.clear()
          this.notify('🗑️ Abonnés supprimés.')
        },
        notify(msg) {
          this.notifMsg = msg; this.showNotif = true
          setTimeout(()=> this.showNotif = false, 3000)
        }
      }
    }
  </script>
</head>

<body class="bg-gradient-to-br from-pastel-blue to-soft-blue min-h-screen">

  @include('partials.header')

  <div class="max-w-7xl mx-auto px-6 py-6">
    @include('partials.stats')
    @include('partials.action_and_table')
  </div>

  @include('partials.mail_modal')
  @include('partials.notifications')

</body>
</html>
