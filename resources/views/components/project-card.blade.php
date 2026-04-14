{{-- Componente: project-card.blade.php --}}
@props(['project'])

<article class="group relative flex flex-col bg-slate-900 border border-slate-800 rounded-xl overflow-hidden hover:border-indigo-500/50 transition-all duration-300 hover:shadow-xl hover:shadow-indigo-950/30 hover:-translate-y-0.5">

    <!-- Cover image o placeholder -->
    @if($project->cover_image)
        <div class="relative h-48 overflow-hidden bg-slate-800">
            <img src="{{ $project->cover_image }}"
                 alt="{{ $project->title }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-80 group-hover:opacity-100">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/20 to-transparent"></div>
        </div>
    @else
        <div class="h-48 bg-gradient-to-br from-slate-800 to-slate-900 flex items-center justify-center border-b border-slate-800">
            <div class="text-slate-700 font-mono text-xs select-none">
                <pre class="leading-relaxed opacity-60">
{
  "type": "project",
  "status": "{{ $project->status }}"
}
                </pre>
            </div>
        </div>
    @endif

    <div class="flex flex-col flex-1 p-6 gap-4">

        <!-- Header -->
        <div class="space-y-2">
            @if($project->is_featured)
                <span class="inline-flex items-center gap-1 text-xs font-mono text-indigo-400 bg-indigo-500/10 border border-indigo-500/20 px-2 py-0.5 rounded-md">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-400"></span>
                    Destacado
                </span>
            @endif
            <h3 class="text-slate-100 font-semibold text-lg leading-snug group-hover:text-indigo-300 transition-colors">
                {{ $project->title }}
            </h3>
        </div>

        <!-- Description -->
        <p class="text-slate-400 text-sm leading-relaxed flex-1 line-clamp-3">
            {{ $project->description }}
        </p>

        <!-- Stack badges -->
        @if(!empty($project->stack))
            @php $stack = (array) $project->stack; @endphp
            <div class="flex flex-wrap gap-1.5">
                @foreach(array_slice($stack, 0, 4) as $tech)
                    <x-badge>{{ $tech }}</x-badge>
                @endforeach
                @if(count($stack) > 4)
                    <span class="text-xs font-mono text-slate-600 self-center">+{{ count($stack) - 4 }}</span>
                @endif
            </div>
        @endif

        <!-- Footer links -->
        <div class="flex items-center justify-between pt-2 border-t border-slate-800">
            <a href="{{ route('projects.show', $project->slug, false) }}"
               class="flex items-center gap-1.5 text-sm font-medium text-indigo-400 hover:text-indigo-300 transition-colors group/link">
                Caso de estudio
                <svg class="w-4 h-4 group-hover/link:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
            <div class="flex items-center gap-3">
                @if($project->github_url)
                    <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer"
                       class="text-slate-600 hover:text-slate-400 transition-colors"
                       title="Ver código">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path></svg>
                    </a>
                @endif
                @if($project->live_url)
                    <a href="{{ $project->live_url }}" target="_blank" rel="noopener noreferrer"
                       class="text-slate-600 hover:text-slate-400 transition-colors"
                       title="Ver demo">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                @endif
            </div>
        </div>
    </div>
</article>
