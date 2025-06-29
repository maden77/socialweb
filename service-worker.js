
self.addEventListener('install', event => {
  event.waitUntil(
    caches.open('catatan-cache').then(cache => {
      return cache.addAll([
        '/',
        '/index.php',
        '/manifest.json',
        '/style.css'
      ]);
    })
  );
});

self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request).then(resp => {
      return resp || fetch(event.request);
    })
  );
});
