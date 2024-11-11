//asigar nombre y version de la cache
const cache_name = "v1_cache_pwa";

var urlsToCache = [
    './',
    './assets/images/logo1024.jpg',
    './assets/images/logo512.jpg',
    './assets/images/logo384.jpg',
    './assets/images/logo256.jpg',
    './assets/images/logo192.jpg',
    './assets/images/logo96.jpg',
    './assets/images/logo64.jpg',
    './assets/images/logo32.jpg',
    './assets/images/logo16.jpg',

]

self.addEventListener('install', (event) => {
    event.waitUntil(
      caches.open('my-dynamic-cache').then((cache) => {
        return cache.addAll([
          '/', // La página inicial
          '/assets/css/animate.css',
          '/assets/css/boostrap.min.css',
          '/assets/css/flex-slider.css',
          '/assets/css/fontawesome.css',
          '/assets/css/owl.css',
          '/assets/css/templatemo-cyborg-gaming.css',
          '/assets/js/custom.js',
          '/assets/js/isotope.js',
          '/assets/js/isotope.min.js',
          '/assets/js/owl-carousel.js',
          '/assets/js/popup.js',
          '/assets/js/tabs.js',
          '/assets/images/logo1024.jpg',
          '/assets/icons/logo512.jpg',
          '/index.php',
          '/conexion.php',
          '/details.php',
          '/browse.php',
          '/streams.php',
        ]);
      })
    );
  });
  
  self.addEventListener('fetch', (event) => {
    if (event.request.method === 'GET') {
      event.respondWith(
        caches.match(event.request).then((cachedResponse) => {
          if (cachedResponse) {
            return cachedResponse; // Si está en caché, devuelve la versión en caché
          }
  
          return fetch(event.request).then((response) => {
            return caches.open('my-dynamic-cache').then((cache) => {
              cache.put(event.request, response.clone()); // Almacena en caché la nueva respuesta
              return response;
            });
          }).catch(() => {
            // Fallback si la solicitud es de navegación y no hay conexión
            if (event.request.mode === 'navigate') {
              return caches.match('/index.php'); // Redirige a index.php en caso de fallos
            }
          });
        })
      );
    }
  });
  
