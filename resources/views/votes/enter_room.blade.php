<x-guest-layout>
    <div class="grow flex flex-col justify-center items-center">
        <h2 class="text-3xl font-bold mb-10">Enter Voting Room</h2>
        <form method="POST" action="{{ route('votes.join') }}">
            @csrf
                <x-text-input id="code" class="block mt-1 w-full text-center !py-2" type="text" name="code" :value="old('code')" placeholder="ENTER ROOM CODE" required
                    autofocus />
                <x-input-error :messages="$errors->get('code')" class="mt-2 text-center" />
                <x-primary-button class="mt-2 py-3">
                    {{ __('Enter Room') }}
                </x-primary-button>
        </form>
    </div>
</x-guest-layout>