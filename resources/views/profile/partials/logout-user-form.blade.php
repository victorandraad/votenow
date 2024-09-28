<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Deslogar') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Uma vez que sua conta for deslogada, sua conta será desconectada') }}
        </p>
    </header>
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <x-danger-button>
            {{ __('Deslogar conta') }}
        </x-danger-button>
    </form>

</section>