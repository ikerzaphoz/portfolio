{{-- Componente: badge.blade.php --}}
{{-- Uso: <x-badge>PHP 8.3</x-badge> --}}

<span {{ $attributes->merge(['class' => 'inline-block font-mono text-xs text-indigo-300/80 bg-indigo-500/10 border border-indigo-500/15 px-2 py-0.5 rounded']) }}>
    {{ $slot }}
</span>
