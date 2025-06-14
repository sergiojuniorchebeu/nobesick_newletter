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
        },
        animation: {
          'float':         'float 3s ease-in-out infinite',
          'pulse-soft':    'pulse 2s cubic-bezier(0.4,0,0.6,1) infinite',
          'slide-up':      'slideUp 0.5s ease-out',
          'fade-in':       'fadeIn 0.6s ease-out',
          'modal-appear':  'modalAppear 0.3s ease-out',
          'backdrop-appear':'backdropAppear 0.3s ease-out'
        }
      }
    }
  }