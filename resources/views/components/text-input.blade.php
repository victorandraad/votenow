@props(['disabled' => false])

<input id="caixaTexto" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 py-3 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm text-lg']) !!}>
