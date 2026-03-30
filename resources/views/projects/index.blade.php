@extends('layouts.app')

@section('title', 'Proyectos — Iker')

@section('content')

<section class="relative pt-32 pb-20 overflow-hidden">
    <div class="absolute inset-0 bg-zinc-950">
        <div class="absolute inset-0 opacity-[0.025]"
             style="background-image: linear-gradient(rgba(99,102,241,0.8) 1px, transparent 1px), linear-gradient(90deg, rgba(99,102,241,0.8) 1px, transparent 1px); background-size: 64px 64px;"></div>
    </div>

    <div class="relative max-w-6xl mx-auto px-6">

        {{-- Header --}}
        <div class="mb-16 space-y-4">
            <span class="text-xs font-mono text-indigo-400 uppercase tracking-widest">// proyectos</span>
            <h1 class="text-4xl md:text-6xl font-bold text-slate-100 leading-tight">Casos de estudio</h1>
            <p class="text-slate-400 text-xl max-w-2xl leading-relaxed">
                Proyectos reales con problemas reales. Cada caso documenta el reto, la arquitectura empleada y los resultados obtenidos.
            </p>
        </div>

        {{-- Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($projects as $project)
                <x-project-card :project="$project" />
            @empty
                <div class="col-span-full py-20 text-center space-y-4">
                    <div class="text-slate-700 font-mono text-4xl">[]</div>
                    <p class="text-slate-500 text-sm">No hay proyectos todavía.</p>
                </div>
            @endforelse
        </div>

        {{-- Paginación --}}
        @if($projects->hasPages())
            <div class="mt-12">
                {{ $projects->links() }}
            </div>
        @endif
    </div>
</section>

@endsection

