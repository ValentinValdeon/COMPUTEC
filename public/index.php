<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FGM</title>
  <link rel="stylesheet" href="css/index.css">
  <!-- Tailwind y Flowbite -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Michroma&display=swap');
</style>

<body class="flex flex-col items-center w-full bg-cover bg-center bg-no-repeat bg-fixed"
  style="background-image: url('../assets/img/vishnu-mohanan-pfR18JNEMv8-unsplash.jpg');">
  <nav id="navbar" class="navbar px-6 py-4 w-full">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
      <!-- Logo -->
      <div class="flex items-center space-x-3">
        <div class="logo-icon w-fit h-fit rounded-lg flex items-center justify-center">
          <img src="../assets/img/pc.png" alt="Logo" class="w-12 h-12">
        </div>
        <span class="logo-text">INFORMÁTICA FGM</span>
      </div>

      <div class="flex items-center gap-4">
        <div class="hidden lg:flex lg:items-center lg:space-x-8">
          <a href="?page=main" class="nav-link">INICIO</a>
          <a href="#" class="nav-link">DESTACADO</a>
          <a href="?page=product" class="nav-link">DESCUENTOS</a>
          <a href="?page=shop" class="nav-link">SHOP</a>
        </div>

        <div class="hidden lg:block">
          <div class="relative">
            <input type="text" placeholder="Buscar..." class="search-input pl-10 pr-4 py-2 rounded-lg w-64">
            <svg class="search-icon absolute left-3 top-2.5 w-5 h-5" fill="none" stroke="currentColor"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
          </div>
        </div>

        <button data-collapse-toggle="navbar-menu" type="button"
          class="inline-flex items-center p-2 w-10 h-10 justify-center text-yellow-500 rounded-lg lg:hidden focus:outline-none"
          aria-controls="navbar-menu" aria-expanded="false">
          <svg class="w-6 h-6" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
      </div>
    </div>

    <div class="hidden px-6 pt-4 pb-6" id="navbar-menu">
      <div class="flex flex-col space-y-2">
        <a href="#" class="nav-link block py-2">INICIO</a>
        <a href="#" class="nav-link block py-2">DESTACADO</a>
        <a href="#" class="nav-link block py-2">DESCUENTOS</a>
        <a href="#" class="nav-link block py-2">SHOP</a>
      </div>

      <div class="mt-4">
        <div class="relative">
          <input type="text" placeholder="Buscar..." class="search-input pl-10 pr-4 py-2 rounded-lg w-full">
          <svg class="search-icon absolute left-3 top-2.5 w-5 h-5" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
        </div>
      </div>
    </div>
  </nav>
  <main class="flex flex-col items-center w-full bg-cover bg-center bg-no-repeat bg-fixed backdrop-brightness-50">
    <div class="w-full mx-auto">
      <?php
      $pagina = $_GET['page'] ?? 'main';

      $permitidas = ['main', 'shop', 'product'];
      if (in_array($pagina, $permitidas)) {
        include "$pagina.php";
      } else {
        include "main.php";
      }
      ?>
    </div>

    <footer class="footer-v2 p-8 w-full">
      <!-- Logo principal -->
      <div class="max-w-7xl mx-auto">
        <div class="flex items-center space-x-3 mb-8">
          <div class="logo-icon w-12 h-12 rounded-lg flex items-center justify-center">
            <img src="../assets/img/camara.png" alt="Logo" class="w-12 h-12">
          </div>
          <span class="logo-text">INFORMÁTICA FGM</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <!-- Columna Síguenos -->
          <div>
            <h3 class="section-title text-lg mb-4">SÍGUENOS</h3>
            <div class="flex space-x-4">
              <a href="#" class="social-icon w-10 h-10 rounded-lg flex items-center justify-center footer-link">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path
                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                </svg>
              </a>
              <a href="#" class="social-icon w-10 h-10 rounded-lg flex items-center justify-center footer-link">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path
                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                </svg>
              </a>
            </div>
          </div>

          <!-- Columna Contacto -->
          <div>
            <h3 class="section-title text-lg mb-4">CONTACTO</h3>
            <div class="space-y-3">
              <div class="flex items-center space-x-3">
                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                  </path>
                </svg>
                <span class="footer-text">info@computec.com</span>
              </div>
              <div class="flex items-center space-x-3">
                <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 24 24">
                  <path
                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                </svg>
                <span class="footer-text">+54 9 11 1234-5678</span>
              </div>
            </div>
          </div>

          <!-- Mapa -->
          <div>
            <h3 class="section-title text-lg mb-4">UBICACIÓN</h3>
            <div class="map-container w-full h-64">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d418.0025209244546!2d-65.62067056489715!3d-33.055935882109196!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2sar!4v1755026976605!5m2!1ses-419!2sar"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>

        </div>


        <div class="copyright">
          © 2024 COMPUTEC. Todos los derechos reservados.
        </div>
      </div>
    </footer>
  </main>
  <script src="js/index.js"></script>
</body>


</html>