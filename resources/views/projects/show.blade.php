@extends('layouts.app')

@section('title', $project->title . ' — Caso de Estudio | Iker Zapata')
@section('meta_description', \Illuminate\Support\Str::limit($project->description ?: 'Caso de estudio real de Iker Zapata, Programador Full-Stack Senior especialista en PHP y e-commerce.', 160))
@section('canonical', route('projects.show', $project->slug))
@section('og_type', 'article')
@section('og_image', $project->cover_image ? asset($project->cover_image) : asset('images/logo.png'))
@section('og_image_alt', $project->title . ' — Caso de estudio por Iker Zapata')

@section('schema')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@graph": [
        {
            "@type": "BreadcrumbList",
            "itemListElement": [
                {
                    "@type": "ListItem",
                    "position": 1,
                    "name": "Inicio",
                    "item": "{{ url('/') }}"
                },
                {
                    "@type": "ListItem",
                    "position": 2,
                    "name": "Proyectos",
                    "item": "{{ route('projects.index') }}"
                },
                {
                    "@type": "ListItem",
                    "position": 3,
                    "name": {!! json_encode($project->title) !!},
                    "item": "{{ route('projects.show', $project->slug) }}"
                }
            ]
        },
        {
            "@type": "Article",
            "@id": "{{ route('projects.show', $project->slug) }}#article",
            "headline": {!! json_encode($project->title) !!},
            "description": {!! json_encode(\Illuminate\Support\Str::limit($project->description ?? '', 200)) !!},
            "url": "{{ route('projects.show', $project->slug) }}",
            "datePublished": "{{ $project->created_at->toIso8601String() }}",
            "dateModified": "{{ $project->updated_at->toIso8601String() }}",
            "author": {
                "@type": "Person",
                "name": "Iker Zapata",
                "url": "{{ url('/') }}"
            }@if($project->cover_image),
            "image": "{{ asset($project->cover_image) }}"@endif
        }
    ]
}
</script>
@endsection

@section('content')

{{-- ===================== CABECERA ===================== --}}
<section class="relative pt-32 pb-20 overflow-hidden">
    <div class="absolute inset-0 bg-zinc-950">
        <div class="absolute inset-0 opacity-[0.025]"
             style="background-image: linear-gradient(rgba(99,102,241,0.8) 1px, transparent 1px), linear-gradient(90deg, rgba(99,102,241,0.8) 1px, transparent 1px); background-size: 64px 64px;"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-indigo-600/5 rounded-full blur-3xl pointer-events-none"></div>
    </div>

    <div class="relative max-w-4xl mx-auto px-6">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm font-mono text-slate-600 mb-8">
            <a href="{{ route('home', [], false) }}" class="hover:text-slate-400 transition-colors">~</a>
            <span>/</span>
            <a href="{{ route('projects.index', [], false) }}" class="hover:text-slate-400 transition-colors">proyectos</a>
            <span>/</span>
            <span class="text-slate-400 truncate">{{ $project->slug }}</span>
        </nav>

        {{-- Título --}}
        <div class="space-y-6">
            @if($project->is_featured)
                <span class="inline-flex items-center gap-1.5 text-xs font-mono text-indigo-400 bg-indigo-500/10 border border-indigo-500/20 px-3 py-1 rounded-full">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-400"></span>
                    Proyecto Destacado
                </span>
            @endif

            <h1 class="text-4xl md:text-6xl font-bold text-slate-100 leading-tight tracking-tight">
                {{ $project->title }}
            </h1>

            <p class="text-slate-400 text-xl leading-relaxed max-w-2xl">
                {{ $project->description }}
            </p>
        </div>

        {{-- Stack --}}
        @php $stack = is_array($project->stack) ? $project->stack : []; @endphp
        @if(!empty($stack))
            <div class="mt-8 space-y-3">
                <p class="text-xs font-mono text-slate-600 uppercase tracking-wider">Stack tecnológico</p>
                <div class="flex flex-wrap gap-2">
                    @foreach($stack as $tech)
                        <span class="font-mono text-sm text-indigo-300 bg-slate-900 border border-slate-700 px-3 py-1.5 rounded-lg hover:border-indigo-500/50 transition-colors">
                            {{ $tech }}
                        </span>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Links --}}
        @if($project->github_url || $project->live_url)
            <div class="mt-8 flex flex-wrap gap-4">
                @if($project->github_url)
                    <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-2 border border-slate-700 hover:border-indigo-500 text-slate-400 hover:text-indigo-400 px-5 py-2.5 rounded-lg transition-all duration-200 text-sm font-medium">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path></svg>
                        Ver código
                    </a>
                @endif
                @if($project->live_url)
                    <a href="{{ $project->live_url }}" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-500 text-white px-5 py-2.5 rounded-lg transition-all duration-200 text-sm font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        Ver demo
                    </a>
                @endif
            </div>
        @endif

        {{-- Tags --}}
        @if($project->tags->count() > 0)
            <div class="mt-6 flex flex-wrap gap-2">
                @foreach($project->tags as $tag)
                    <span class="text-xs text-slate-500 bg-slate-800/60 px-2.5 py-1 rounded-md">
                        #{{ $tag->name }}
                    </span>
                @endforeach
            </div>
        @endif
    </div>
</section>

{{-- ===================== CASO DE ESTUDIO ===================== --}}
<section class="py-20 border-t border-slate-800">
    <div class="max-w-4xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">

            {{-- Contenido principal --}}
            <div class="lg:col-span-2 space-y-16">

                {{-- Problema --}}
                @if($project->problem)
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-red-500/10 border border-red-500/20 rounded-lg flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                            </div>
                            <h2 class="text-sm font-mono text-slate-500 uppercase tracking-wider">El Problema</h2>
                        </div>
                        <div class="pl-11">
                            <p class="text-slate-300 leading-relaxed text-lg">
                                {{ $project->problem }}
                            </p>
                        </div>
                    </div>
                @endif

                {{-- Solución --}}
                @if($project->solution)
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-indigo-500/10 border border-indigo-500/20 rounded-lg flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                </svg>
                            </div>
                            <h2 class="text-sm font-mono text-slate-500 uppercase tracking-wider">La Solución</h2>
                        </div>
                        <div class="pl-11">
                            <p class="text-slate-300 leading-relaxed text-lg">
                                {{ $project->solution }}
                            </p>
                        </div>
                    </div>
                @endif

                {{-- Resultados --}}
                @if($project->results)
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-green-500/10 border border-green-500/20 rounded-lg flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <h2 class="text-sm font-mono text-slate-500 uppercase tracking-wider">Resultados Tangibles</h2>
                        </div>
                        <div class="pl-11">
                            <div class="bg-slate-900 border border-slate-800 rounded-xl p-6 border-l-2 border-l-green-500/50">
                                <p class="text-slate-300 leading-relaxed text-lg">
                                    {{ $project->results }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="lg:col-span-1 space-y-8">

                {{-- Stack completo --}}
                @if(!empty($stack))
                    <div class="bg-slate-900 border border-slate-800 rounded-xl p-6 space-y-4">
                        <h3 class="text-xs font-mono text-slate-500 uppercase tracking-wider">Stack Completo</h3>
                        <ul class="space-y-2">
                            @foreach($stack as $tech)
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 shrink-0"></span>
                                    <span class="font-mono text-sm text-slate-300">{{ $tech }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Tags --}}
                @if($project->tags->count() > 0)
                    <div class="bg-slate-900 border border-slate-800 rounded-xl p-6 space-y-4">
                        <h3 class="text-xs font-mono text-slate-500 uppercase tracking-wider">Etiquetas</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($project->tags as $tag)
                                <span class="text-xs text-slate-400 bg-slate-800 px-2.5 py-1 rounded-md font-mono">
                                    {{ $tag->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Meta --}}
                <div class="bg-slate-900 border border-slate-800 rounded-xl p-6 space-y-4">
                    <h3 class="text-xs font-mono text-slate-500 uppercase tracking-wider">Datos</h3>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-xs text-slate-600 font-mono">Estado</dt>
                            <dd class="mt-0.5">
                                <span class="inline-flex items-center gap-1.5 text-xs font-mono">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $project->status === 'published' ? 'bg-green-400' : 'bg-yellow-400' }}"></span>
                                    <span class="text-slate-400">{{ ucfirst($project->status ?? 'draft') }}</span>
                                </span>
                            </dd>
                        </div>
                        @if($project->is_featured)
                            <div>
                                <dt class="text-xs text-slate-600 font-mono">Visibilidad</dt>
                                <dd class="mt-0.5 text-xs text-indigo-400 font-mono">Destacado</dd>
                            </div>
                        @endif
                    </dl>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===================== NAVEGACIÓN ===================== --}}
<section class="py-16 border-t border-slate-800 bg-zinc-950">
    <div class="max-w-4xl mx-auto px-6">
        <a href="{{ route('projects.index', [], false) }}"
           class="inline-flex items-center gap-2 text-slate-500 hover:text-indigo-400 transition-colors text-sm font-mono group">
            <svg class="w-4 h-4 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
            </svg>
            Volver a proyectos
        </a>
    </div>
</section>

@endsection

