<footer class="fixed bottom-0 left-0 z-20 flex p-3 py-4 justify-center w-full">
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
    </x-nav-link>
    <x-nav-link :href="route('rooms.index')" :active="request()->routeIs('rooms.index')">
        {{ __('My Rooms') }}
    </x-nav-link>
    <x-nav-link :href="route('rooms.create')" :active="request()->routeIs('rooms.create')">
        {{ __('Create Room') }}
    </x-nav-link>
</footer>