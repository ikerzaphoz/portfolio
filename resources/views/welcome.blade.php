@extends('layouts.app')

@section('title', 'Iker Zapata — Full-Stack Senior | PHP & E-commerce')
@section('meta_description', 'Programador Full-Stack Senior con más de 10 años transformando modelos de negocio tradicionales en plataformas e-commerce potentes. Especialista en PHP, PrestaShop, Laravel y arquitectura a medida.')

@section('content')

{{-- ===================== HERO ===================== --}}
<section class="relative min-h-screen flex items-center overflow-hidden">

    {{-- Background grid --}}
    <div class="absolute inset-0 bg-zinc-950">
        <div class="absolute inset-0 opacity-[0.03]"
             style="background-image: linear-gradient(rgba(99,102,241,0.8) 1px, transparent 1px), linear-gradient(90deg, rgba(99,102,241,0.8) 1px, transparent 1px); background-size: 64px 64px;">
        </div>
        {{-- Glow --}}
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-indigo-600/5 rounded-full blur-3xl pointer-events-none"></div>
    </div>

    <div class="relative max-w-6xl mx-auto px-6 py-32">
        <div class="max-w-3xl space-y-8">

            {{-- Badge --}}
            <div class="inline-flex items-center gap-2 border border-slate-700/60 bg-slate-900/60 backdrop-blur-sm rounded-full px-4 py-1.5">
                <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                <span class="text-slate-400 text-sm font-mono">Disponible · Granada, España</span>
            </div>

            {{-- Headline --}}
            <div class="space-y-2">
                <h1 class="text-5xl md:text-7xl font-bold leading-[1.05] tracking-tight">
                    <span class="text-slate-100">Iker Zapata,</span><br>
                    <span class="gradient-text">Full-Stack Senior</span><br>
                    <span class="text-slate-100">& E-commerce.</span>
                </h1>
            </div>

            {{-- UVP --}}
            <p class="text-slate-400 text-xl leading-relaxed max-w-2xl">
                Más de <span class="text-slate-300 font-medium">10 años</span> transformando modelos de negocio
                tradicionales en plataformas e-commerce potentes. Especialista en
                <span class="text-slate-300 font-medium">PHP y arquitectura a medida</span>,
                con foco en optimización de procesos e integración de sistemas.
            </p>

            {{-- Stack inline --}}
            <div class="flex flex-wrap items-center gap-2">
                @foreach(['PHP', 'PrestaShop', 'Laravel', 'Symfony', 'Vue.js', 'React', 'Docker', 'SQL'] as $tech)
                    <x-badge>{{ $tech }}</x-badge>
                @endforeach
            </div>

            {{-- CTAs --}}
            <div class="flex flex-col sm:flex-row gap-4 pt-2">
                <a href="{{ route('projects.index', [], false) }}"
                   class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-500 text-white font-medium px-6 py-3 rounded-lg transition-all duration-200 hover:shadow-lg hover:shadow-indigo-600/25">
                    Ver proyectos
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
                <a href="#contacto"
                   class="inline-flex items-center justify-center gap-2 border border-slate-700 hover:border-slate-600 text-slate-300 hover:text-slate-100 font-medium px-6 py-3 rounded-lg transition-all duration-200">
                    Contactar
                </a>
            </div>
        </div>

        {{-- Stats --}}
        <div class="mt-20 grid grid-cols-2 md:grid-cols-4 gap-8 pt-12 border-t border-slate-800/60">
            @foreach([['10+', 'Años de experiencia'], ['60%', 'Ventas generadas con mi plataforma B2B'], ['2', 'Empresas tech donde he liderado proyectos'], ['100%', 'Enfoque en resultados de negocio']] as [$stat, $label])
                <div class="space-y-1">
                    <p class="text-3xl font-bold text-indigo-400 font-mono">{{ $stat }}</p>
                    <p class="text-slate-500 text-sm">{{ $label }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===================== PROYECTOS DESTACADOS ===================== --}}
<section class="py-24 bg-zinc-950">
    <div class="max-w-6xl mx-auto px-6">

        <x-section-header
            label="// proyectos"
            title="Casos de estudio"
            description="Proyectos reales con problemas reales. Sin demos genéricas."
        />

        @forelse($projects as $project)
            <x-project-card :project="$project" />
        @empty
            <div class="col-span-full py-20 text-center space-y-4">
                <div class="text-slate-700 font-mono text-4xl">404</div>
                <p class="text-slate-500">No hay proyectos aún. Ejecuta <code class="font-mono bg-slate-800 text-indigo-400 px-1.5 py-0.5 rounded text-sm">php artisan db:seed</code></p>
            </div>
        @endforelse

        @if($projects->count() > 0)
            <div class="mt-12 text-center">
                <a href="{{ route('projects.index', [], false) }}"
                   class="inline-flex items-center gap-2 border border-slate-700 hover:border-indigo-500 text-slate-400 hover:text-indigo-400 px-6 py-3 rounded-lg transition-all duration-200 text-sm font-mono">
                    Ver todos los proyectos
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
            </div>
        @endif
    </div>
</section>

{{-- ===================== EXPERTISE ===================== --}}
<section class="py-24 border-t border-slate-800 bg-zinc-950">
    <div class="max-w-6xl mx-auto px-6">

        <x-section-header
            label="// expertise"
            title="En qué destaco"
        />

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
                ['icon' => 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z', 'title' => 'E-commerce & Marketplaces', 'desc' => 'Plataformas B2B con PrestaShop y WordPress a medida. Integración de pasarelas de pago, ERP y automatización de flujos operativos.'],
                ['icon' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4', 'title' => 'Backend PHP & APIs', 'desc' => 'Desarrollo con PHP, Laravel y Symfony. APIs RESTful, autenticación JWT y arquitecturas desacopladas diseñadas para escalar.'],
                ['icon' => 'M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z', 'title' => 'Frontend Moderno', 'desc' => 'Interfaces con Vue.js, React y Angular. HTML5, CSS3, JavaScript, jQuery y Ajax para experiencias de usuario fluidas y responsivas.'],
            ] as $item)
                <div class="group p-6 bg-slate-900 border border-slate-800 rounded-xl hover:border-indigo-500/40 transition-all duration-300 space-y-4">
                    <div class="w-10 h-10 bg-indigo-500/10 border border-indigo-500/20 rounded-lg flex items-center justify-center group-hover:bg-indigo-500/20 transition-colors">
                        <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $item['icon'] }}"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-slate-200 group-hover:text-indigo-300 transition-colors">{{ $item['title'] }}</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">{{ $item['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Logo --}}
<div class="flex justify-center mb-8">
    <img src="/images/logo.png" alt="Logo de Iker" class="h-24">
</div>

@endsection
