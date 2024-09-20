@php
function renderNavItem($route, $label, $icon)
{
    $isActive = request()->routeIs($route);
    $textColorClass = $isActive ? 'text-green-500' : 'text-gray-700 hover:text-green-500';

    return "
    <a href=\"" . route($route) . "\" class=\"flex flex-col items-center justify-center {$textColorClass}\">
        <i class=\"{$icon} mb-1\"></i>
        <span class=\"text-xs\">" . __($label) . "</span>
    </a>
    ";
}
@endphp

<nav class="fixed bottom-0 left-0 right-0 m-3 bg-white border border-gray-200 rounded-3xl shadow-xl shadow-black/15">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-evenly h-16">
            {!! renderNavItem('dashboard', 'Dashboard', 'fas fa-home') !!}
            {!! renderNavItem('rooms.index', 'Minhas Salas', 'fas fa-building') !!}
            {!! renderNavItem('rooms.create', 'Criar Sala', 'fas fa-plus') !!}
            {!! renderNavItem('profile', 'Perfil', 'fas fa-user') !!}
        </div>
    </div>
</nav>