@props(['value'])

<label class="font-semibold" {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-500']) }}>
    {{ $value ?? $slot }}
</label>
