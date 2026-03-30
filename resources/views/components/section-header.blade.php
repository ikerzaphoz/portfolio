{{-- Componente: section-header.blade.php --}}
{{-- Props: $label (texto pequeño), $title, $description (opcional) --}}

<div {{ $attributes->merge(['class' => 'space-y-3 mb-12']) }}>
    @if(isset($label))
        <span class="inline-block font-mono text-xs text-indigo-400 uppercase tracking-widest">
            {{ $label }}
        </span>
    @endif
    <h2 class="text-3xl md:text-4xl font-bold text-slate-100 leading-tight">
        {{ $title }}
    </h2>
    @if(isset($description))
        <p class="text-slate-400 text-lg leading-relaxed max-w-2xl">
            {{ $description }}
        </p>
    @endif
</div>
