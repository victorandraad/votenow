<button {{ $attributes->merge(['type' => 'submit', 'class' => 'flex items-center w-full p-4 bg-green-500 justify-center border border-transparent rounded-md text-xl text-white text-center font-bold tracking-wide hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
