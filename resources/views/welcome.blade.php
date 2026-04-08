@extends('layouts.app')

@section('title', 'Iker — Arquitecto de Soluciones Web PHP')
@section('meta_description', 'Arquitecto de soluciones web robustas y escalables. Transformo lógica de negocio compleja en aplicaciones de alto rendimiento utilizando el ecosistema moderno de PHP.')

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
                <span class="text-slate-400 text-sm font-mono">Disponible para proyectos freelance</span>
            </div>

            {{-- Headline --}}
            <div class="space-y-2">
                <h1 class="text-5xl md:text-7xl font-bold leading-[1.05] tracking-tight">
                    <span class="text-slate-100">Arquitecto de</span><br>
                    <span class="gradient-text">soluciones web</span><br>
                    <span class="text-slate-100">en PHP.</span>
                </h1>
            </div>

            {{-- UVP --}}
            <p class="text-slate-400 text-xl leading-relaxed max-w-2xl">
                Transformo lógica de negocio compleja en aplicaciones de
                <span class="text-slate-300 font-medium">alto rendimiento</span>.
                Código limpio, bases de datos optimizadas y arquitecturas orientadas a resultados.
            </p>

            {{-- Stack inline --}}
            <div class="flex flex-wrap items-center gap-2">
                @foreach(['PHP 8.3', 'Laravel 11', 'PostgreSQL', 'Redis', 'Docker', 'Tailwind'] as $tech)
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
            @foreach([['3+', 'Años de experiencia'], ['20+', 'Proyectos entregados'], ['70%', 'Mejora de rendimiento'], ['100%', 'Código con tests']] as [$stat, $label])
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
            title="Qué construyo"
        />

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
                ['icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10', 'title' => 'APIs & Microservicios', 'desc' => 'RESTful APIs robustas, autenticación JWT/Sanctum y arquitecturas desacopladas que escalan sin fricciones.'],
                ['icon' => 'M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4', 'title' => 'Optimización de BD', 'desc' => 'PostgreSQL con índices optimizados, consultas eficientes, Redis para caché y colas de trabajo de alto rendimiento.'],
                ['icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'title' => 'Plataformas SaaS', 'desc' => 'Arquitecturas multi-tenant, sistemas de suscripción, paneles de control y lógica de negocio compleja.'],
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
