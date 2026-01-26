<!-- Mobile Bottom Navigation -->
<nav class="lg:hidden fixed bottom-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md border-t-2 shadow-2xl" style="border-top-color: rgba(248, 176, 22, 0.3);">
    <div class="flex items-center justify-around h-16 px-2 pb-safe">
        <a href="{{ route('home') }}" 
           class="flex flex-col items-center justify-center gap-1 flex-1 h-full transition-all duration-300 group relative {{ request()->routeIs('home') ? 'text-primary-600' : 'text-gray-600 hover:text-primary-600' }}">
            <div class="relative w-10 h-10 flex items-center justify-center rounded-full transition-all duration-300 {{ request()->routeIs('home') ? 'bg-primary-50 border-2' : 'hover:bg-gray-50 border-2 border-transparent' }}" style="{{ request()->routeIs('home') ? 'border-color: rgba(248, 176, 22, 0.4);' : '' }}">
                <i class="fas fa-home text-lg group-active:scale-90 transition-transform duration-300"></i>
            </div>
            <span class="text-[9px] font-semibold tracking-wide transition-all duration-300 {{ request()->routeIs('home') ? 'opacity-100' : 'opacity-70' }}">Home</span>
            @if(request()->routeIs('home'))
                <span class="absolute top-0 left-1/2 transform -translate-x-1/2 w-8 h-0.5 bg-accent-500 rounded-full"></span>
            @endif
        </a>

        <a href="{{ route('contact') }}" 
           class="flex flex-col items-center justify-center gap-1 flex-1 h-full transition-all duration-300 group relative {{ request()->routeIs('contact') ? 'text-primary-600' : 'text-gray-600 hover:text-primary-600' }}">
            <div class="relative w-10 h-10 flex items-center justify-center rounded-full transition-all duration-300 {{ request()->routeIs('contact') ? 'bg-primary-50 border-2' : 'hover:bg-gray-50 border-2 border-transparent' }}" style="{{ request()->routeIs('contact') ? 'border-color: rgba(248, 176, 22, 0.4);' : '' }}">
                <i class="fas fa-envelope text-lg group-active:scale-90 transition-transform duration-300"></i>
            </div>
            <span class="text-[9px] font-semibold tracking-wide transition-all duration-300 {{ request()->routeIs('contact') ? 'opacity-100' : 'opacity-70' }}">Contact</span>
            @if(request()->routeIs('contact'))
                <span class="absolute top-0 left-1/2 transform -translate-x-1/2 w-8 h-0.5 bg-accent-500 rounded-full"></span>
            @endif
        </a>

        <a href="{{ route('become-a-coach') }}" 
           class="flex flex-col items-center justify-center gap-1 flex-1 h-full transition-all duration-300 group relative {{ request()->routeIs('become-a-coach') ? 'text-primary-600' : 'text-gray-600 hover:text-primary-600' }}">
            <div class="relative w-10 h-10 flex items-center justify-center rounded-full transition-all duration-300 {{ request()->routeIs('become-a-coach') ? 'bg-primary-50 border-2' : 'hover:bg-gray-50 border-2 border-transparent' }}" style="{{ request()->routeIs('become-a-coach') ? 'border-color: rgba(248, 176, 22, 0.4);' : '' }}">
                <i class="fas fa-user-graduate text-lg group-active:scale-90 transition-transform duration-300"></i>
            </div>
            <span class="text-[9px] font-semibold tracking-wide transition-all duration-300 {{ request()->routeIs('become-a-coach') ? 'opacity-100' : 'opacity-70' }}">Become Coach</span>
            @if(request()->routeIs('become-a-coach'))
                <span class="absolute top-0 left-1/2 transform -translate-x-1/2 w-8 h-0.5 bg-accent-500 rounded-full"></span>
            @endif
        </a>

        <a href="{{ route('contact') }}?appointment=1" 
           class="flex flex-col items-center justify-center gap-1 flex-1 h-full transition-all duration-300 group relative {{ (request()->routeIs('contact') && request()->has('appointment')) ? 'text-primary-600' : 'text-gray-600 hover:text-primary-600' }}">
            <div class="relative w-10 h-10 flex items-center justify-center rounded-full transition-all duration-300 {{ (request()->routeIs('contact') && request()->has('appointment')) ? 'bg-primary-50 border-2' : 'hover:bg-gray-50 border-2 border-transparent' }}" style="{{ (request()->routeIs('contact') && request()->has('appointment')) ? 'border-color: rgba(248, 176, 22, 0.4);' : '' }}">
                <i class="fas fa-calendar-check text-lg group-active:scale-90 transition-transform duration-300"></i>
            </div>
            <span class="text-[9px] font-semibold tracking-wide transition-all duration-300 {{ (request()->routeIs('contact') && request()->has('appointment')) ? 'opacity-100' : 'opacity-70' }}">Schedule</span>
            @if(request()->routeIs('contact') && request()->has('appointment'))
                <span class="absolute top-0 left-1/2 transform -translate-x-1/2 w-8 h-0.5 bg-accent-500 rounded-full"></span>
            @endif
        </a>
    </div>
    
    <!-- Decorative top border accent -->
    <div class="absolute top-0 left-0 right-0 h-0.5 bg-gradient-to-r from-transparent via-accent-500/50 to-transparent"></div>
</nav>
