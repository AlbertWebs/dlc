@php
    $items = $items ?? [];
    if (empty($items)) {
        // Default breadcrumb based on current route
        $items = [
            ['label' => 'Home', 'url' => route('home')]
        ];
        
        if (request()->routeIs('about')) {
            $items[] = ['label' => 'About Us', 'url' => route('about')];
        } elseif (request()->routeIs('programs.*')) {
            $items[] = ['label' => 'Programs', 'url' => route('programs.index')];
            if (request()->routeIs('programs.show')) {
                $program = $program ?? null;
                if ($program) {
                    $items[] = ['label' => $program->title, 'url' => route('programs.show', $program->slug)];
                }
            }
        } elseif (request()->routeIs('contact')) {
            $items[] = ['label' => 'Contact', 'url' => route('contact')];
        } elseif (request()->routeIs('events.*')) {
            $items[] = ['label' => 'Events', 'url' => route('events.index')];
        } elseif (request()->routeIs('become-a-coach')) {
            $items[] = ['label' => 'Become a Coach', 'url' => route('become-a-coach')];
        } elseif (request()->routeIs('videos.*')) {
            $items[] = ['label' => 'Videos', 'url' => route('videos.index')];
        } elseif (request()->routeIs('coach.*')) {
            $items[] = ['label' => 'Coaches', 'url' => '#'];
            if (isset($coach)) {
                $items[] = ['label' => $coach->name, 'url' => route('coach.show', $coach->slug)];
            }
        }
    }
@endphp

<nav class="bg-gradient-to-r from-primary-50 via-white to-primary-50 border-b border-primary-100 py-4" aria-label="Breadcrumb">
    <div class="container mx-auto px-4">
        <ol class="flex items-center space-x-2 text-sm">
            @foreach($items as $index => $item)
                <li class="flex items-center">
                    @if($index > 0)
                        <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
                    @endif
                    @if($index === count($items) - 1)
                        <span class="text-primary-900 font-semibold flex items-center gap-2">
                            <i class="fas fa-circle text-accent-500 text-xs"></i>
                            {{ $item['label'] }}
                        </span>
                    @else
                        <a href="{{ $item['url'] }}" class="text-gray-600 hover:text-primary-600 transition-colors flex items-center gap-2 group">
                            @if($index === 0)
                                <i class="fas fa-home text-xs"></i>
                            @endif
                            <span class="group-hover:underline">{{ $item['label'] }}</span>
                        </a>
                    @endif
                </li>
            @endforeach
        </ol>
    </div>
</nav>
