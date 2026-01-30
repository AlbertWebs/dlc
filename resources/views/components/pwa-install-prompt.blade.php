<!-- PWA Install Prompt -->
<div id="pwa-install-prompt" class="fixed bottom-4 left-4 right-4 md:left-auto md:right-4 md:w-96 z-50 hidden" style="display: none;">
    <div class="bg-gradient-to-br from-primary-900 to-primary-800 text-white rounded-xl shadow-2xl p-6 border-2 border-accent-500/50 backdrop-blur-sm">
        <div class="flex items-start gap-4">
            <!-- Icon -->
            <div class="flex-shrink-0 w-12 h-12 bg-accent-500/20 rounded-xl flex items-center justify-center border-2 border-accent-500/50">
                <i class="fas fa-mobile-alt text-accent-400 text-xl"></i>
            </div>
            
            <!-- Content -->
            <div class="flex-1 min-w-0">
                <h3 class="text-lg font-bold text-accent-400 mb-1">Install Our App</h3>
                <p class="text-sm text-gray-300 mb-4">
                    Install DLC Kenya for a better experience. Get faster access, offline support, and more!
                </p>
                
                <!-- Buttons -->
                <div class="flex gap-3">
                    <button id="pwa-install-button" 
                            class="flex-1 px-4 py-2 bg-gradient-to-r from-accent-500 to-accent-600 hover:from-accent-400 hover:to-accent-500 text-primary-900 font-bold rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl text-sm">
                        <i class="fas fa-download mr-2"></i>
                        Install Now
                    </button>
                    <button id="pwa-install-dismiss" 
                            class="px-4 py-2 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-lg transition-all duration-300 text-sm border border-white/20">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
