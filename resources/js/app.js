import './bootstrap';

// Scroll animation observer
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver(function(entries) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, observerOptions);

// Observe all elements with animate-on-scroll class
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        observer.observe(el);
    });
});

// Mobile menu toggle is handled in header.blade.php component
// Removed duplicate handler to prevent conflicts

// Service Worker Registration
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js')
            .then((registration) => {
                console.log('[Service Worker] Registered successfully:', registration.scope);
                
                // Check for updates
                registration.addEventListener('updatefound', () => {
                    const newWorker = registration.installing;
                    newWorker.addEventListener('statechange', () => {
                        if (newWorker.state === 'installed' && navigator.serviceWorker.controller) {
                            // New service worker available
                            console.log('[Service Worker] New version available');
                        }
                    });
                });
            })
            .catch((error) => {
                console.error('[Service Worker] Registration failed:', error);
            });
        
        // Listen for service worker updates
        navigator.serviceWorker.addEventListener('controllerchange', () => {
            window.location.reload();
        });
    });
}

// PWA Install Prompt
let deferredPrompt;
const installPrompt = document.getElementById('pwa-install-prompt');

window.addEventListener('beforeinstallprompt', (e) => {
    // Prevent the mini-infobar from appearing
    e.preventDefault();
    // Stash the event so it can be triggered later
    deferredPrompt = e;
    // Show the install prompt
    if (installPrompt) {
        installPrompt.style.display = 'block';
    }
});

// Handle install button click
const installButton = document.getElementById('pwa-install-button');
if (installButton) {
    installButton.addEventListener('click', async () => {
        if (!deferredPrompt) {
            return;
        }
        
        // Show the install prompt
        deferredPrompt.prompt();
        
        // Wait for the user to respond
        const { outcome } = await deferredPrompt.userChoice;
        console.log('[PWA] User response to install prompt:', outcome);
        
        // Clear the deferred prompt
        deferredPrompt = null;
        
        // Hide the install prompt
        if (installPrompt) {
            installPrompt.style.display = 'none';
        }
    });
}

// Handle install prompt dismiss
const installDismiss = document.getElementById('pwa-install-dismiss');
if (installDismiss) {
    installDismiss.addEventListener('click', () => {
        if (installPrompt) {
            installPrompt.style.display = 'none';
        }
        // Store dismissal in localStorage
        localStorage.setItem('pwa-install-dismissed', Date.now());
    });
}

// Check if user has already dismissed the prompt (within 7 days)
const dismissedTime = localStorage.getItem('pwa-install-dismissed');
if (dismissedTime && (Date.now() - parseInt(dismissedTime)) < 7 * 24 * 60 * 60 * 1000) {
    if (installPrompt) {
        installPrompt.style.display = 'none';
    }
}

// Hide prompt if app is already installed
window.addEventListener('appinstalled', () => {
    console.log('[PWA] App installed successfully');
    if (installPrompt) {
        installPrompt.style.display = 'none';
    }
    deferredPrompt = null;
});
