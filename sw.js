const CACHE_NAME = "v1_cache_pwa";
const urlsToCache = [
    '/', // Página principal
    '/index.php',
    '/browse.php',
    '/streams.php',
    '/details.php',
    '/conexion.php',
    '/assets/css/animate.css',
    '/assets/css/bootstrap.min.css',
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
    '/assets/images/logo1024.png',
    '/assets/images/logo512.png',
    '/assets/images/logo384.png',
    '/assets/images/logo256.png',
    '/assets/images/logo192.png',
    '/assets/images/logo96.png',
    '/assets/images/logo64.png',
    '/assets/images/logo32.png',
    '/assets/images/logo16.png',
];



// Evento de instalación
self.addEventListener('install', (event) => {
    console.log('Service Worker instalado');
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            console.log('Archivos cacheados');
            return cache.addAll(urlsToCache);
        })
    );
});

// Evento de activación
self.addEventListener('activate', (event) => {
    const cacheWhitelist = [CACHE_NAME];
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames.map((cache) => {
                    if (!cacheWhitelist.includes(cache)) {
                        console.log('Eliminando caché antigua:', cache);
                        return caches.delete(cache);
                    }
                })
            );
        })
    );

    return self.clients.claim();
});

// Evento de fetch
self.addEventListener('fetch', (event) => {
    if (event.request.method === 'GET') {
        event.respondWith(
            caches.match(event.request).then((cachedResponse) => {
                if (cachedResponse) {
                    return cachedResponse; // Devuelve la respuesta en caché si existe
                }
                return fetch(event.request)
                    .then((networkResponse) => {
                        return caches.open(CACHE_NAME).then((cache) => {
                            cache.put(event.request, networkResponse.clone());
                            return networkResponse;
                        });
                    })
                    .catch(() => {
                        if (event.request.mode === 'navigate') {
                            return caches.match('./index.php'); // Página fallback
                        }
                    });
            })
        );
    }
});
