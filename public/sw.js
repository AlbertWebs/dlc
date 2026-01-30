// Service Worker for DLC Kenya PWA
const CACHE_NAME = 'dlc-kenya-v1';
const RUNTIME_CACHE = 'dlc-kenya-runtime-v1';

// Assets to cache on install
const STATIC_ASSETS = [
    '/',
    '/offline',
    '/css/app.css',
    '/js/app.js',
    '/images/logo.png',
    '/favicon.ico'
];

// Install event - cache static assets
self.addEventListener('install', (event) => {
    console.log('[Service Worker] Installing...');
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then((cache) => {
                console.log('[Service Worker] Caching static assets');
                return cache.addAll(STATIC_ASSETS.map(url => new Request(url, { cache: 'reload' })));
            })
            .catch((error) => {
                console.error('[Service Worker] Cache install failed:', error);
            })
    );
    self.skipWaiting();
});

// Activate event - clean up old caches
self.addEventListener('activate', (event) => {
    console.log('[Service Worker] Activating...');
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames
                    .filter((cacheName) => {
                        return cacheName !== CACHE_NAME && cacheName !== RUNTIME_CACHE;
                    })
                    .map((cacheName) => {
                        console.log('[Service Worker] Deleting old cache:', cacheName);
                        return caches.delete(cacheName);
                    })
            );
        })
    );
    return self.clients.claim();
});

// Fetch event - serve from cache, fallback to network
self.addEventListener('fetch', (event) => {
    const { request } = event;
    const url = new URL(request.url);
    
    // Skip non-GET requests
    if (request.method !== 'GET') {
        return;
    }
    
    // Skip admin and API routes
    if (url.pathname.startsWith('/admin') || url.pathname.startsWith('/api')) {
        return;
    }
    
    // Skip external URLs
    if (url.origin !== location.origin) {
        return;
    }
    
    event.respondWith(
        caches.match(request)
            .then((cachedResponse) => {
                // Return cached version if available
                if (cachedResponse) {
                    return cachedResponse;
                }
                
                // Fetch from network
                return fetch(request)
                    .then((response) => {
                        // Don't cache non-successful responses
                        if (!response || response.status !== 200 || response.type !== 'basic') {
                            return response;
                        }
                        
                        // Clone the response
                        const responseToCache = response.clone();
                        
                        // Cache the response
                        caches.open(RUNTIME_CACHE)
                            .then((cache) => {
                                cache.put(request, responseToCache);
                            });
                        
                        return response;
                    })
                    .catch(() => {
                        // Network failed, try to serve offline page for navigation requests
                        if (request.mode === 'navigate') {
                            return caches.match('/offline');
                        }
                        return new Response('Offline', { status: 503 });
                    });
            })
    );
});

// Background sync (optional - for future use)
self.addEventListener('sync', (event) => {
    console.log('[Service Worker] Background sync:', event.tag);
});

// Push notifications (optional - for future use)
self.addEventListener('push', (event) => {
    console.log('[Service Worker] Push notification received');
    if (event.data) {
        const data = event.data.json();
        const options = {
            body: data.body,
            icon: '/images/logo.png',
            badge: '/images/logo.png',
            vibrate: [200, 100, 200],
            tag: 'dlc-notification',
            requireInteraction: true
        };
        
        event.waitUntil(
            self.registration.showNotification(data.title, options)
        );
    }
});

// Notification click handler
self.addEventListener('notificationclick', (event) => {
    event.notification.close();
    event.waitUntil(
        clients.openWindow('/')
    );
});
