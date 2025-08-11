
    // Efectos interactivos en los enlaces
    document.querySelectorAll('.nav-link').forEach(link => {
      link.addEventListener('click', function (e) {
        // Si es un enlace real -> no preventDefault, aquí solo manejamos classes
        document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
        this.classList.add('active');
      });
    });

    // Efecto en inputs de búsqueda
    document.querySelectorAll('.search-input').forEach(input => {
      input.addEventListener('focus', function () {
        this.style.transform = 'scale(1.02)';
      });

      input.addEventListener('blur', function () {
        this.style.transform = 'scale(1)';
      });
    });

    // Animación de entrada del navbar
    document.querySelectorAll('nav').forEach((navbar, index) => {
      navbar.style.opacity = '0';
      navbar.style.transform = 'translateY(-20px)';
      navbar.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
      setTimeout(() => {
        navbar.style.opacity = '1';
        navbar.style.transform = 'translateY(0)';
      }, index * 300);
    });

    // Abrir mapa en Google Maps (función usada en footer)
    function openMap(location) {
      const url = 'https://www.google.com/maps/search/?api=1&query=' + encodeURIComponent(location);
      window.open(url, '_blank');
    }