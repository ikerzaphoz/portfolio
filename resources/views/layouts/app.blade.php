<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Iker — Arquitecto de Soluciones Web')</title>
    <meta name="description" content="@yield('meta_description', 'Arquitecto de soluciones web robustas y escalables. PHP 8.3, Laravel, Tailwind, PostgreSQL.')">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                        mono: ['JetBrains Mono', 'Fira Code', 'monospace'],
                    },
                    colors: {
                        accent: {
                            DEFAULT: '#6366f1',
                            hover: '#4f46e5',
                            muted: '#6366f120',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Inter', system-ui, sans-serif; }
        .font-mono { font-family: 'JetBrains Mono', 'Fira Code', monospace; }
        .gradient-text {
            background: linear-gradient(135deg, #6366f1, #a78bfa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .nav-link {
            position: relative;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 1px;
            background: #6366f1;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0f172a; }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #6366f1; }
    </style>

    @yield('head')
</head>
<body class="bg-zinc-950 text-slate-300 antialiased min-h-screen flex flex-col">

    <!-- NAVBAR -->
    <header x-data="{ open: false, scrolled: false }"
            x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 20 })"
            :class="scrolled ? 'bg-zinc-950/95 backdrop-blur-md border-b border-slate-800/60 shadow-xl shadow-black/20' : 'bg-transparent'"
            class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
        <nav class="max-w-6xl mx-auto px-6 py-4">
            <div class="flex items-center justify-between">

                <!-- Logo iZ -->
                <a href="{{ route('home', [], false) }}" class="flex items-center gap-3 group">
                    <svg width="36" height="36" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 group-hover:scale-105 transition-transform duration-200">
                        <defs>
                            <linearGradient id="izGrad" x1="0" y1="0" x2="100" y2="100" gradientUnits="userSpaceOnUse">
                                <stop offset="0%" stop-color="#00f0ff"/>
                                <stop offset="100%" stop-color="#0080ff"/>
                            </linearGradient>
                        </defs>
                        <!-- i -->
                        <rect x="18" y="20" width="7" height="7" rx="1" fill="url(#izGrad)"/>
                        <rect x="18" y="32" width="7" height="48" rx="1" fill="url(#izGrad)"/>
                        <!-- Z -->
                        <rect x="30" y="20" width="52" height="7" rx="1" fill="url(#izGrad)"/>
                        <polygon points="82,27 30,73 30,80 82,80 82,73 38,73 82,27" fill="url(#izGrad)"/>
                    </svg>
                    <span class="font-semibold text-slate-100 group-hover:text-white transition-colors tracking-wide">
                        iker<span style="background: linear-gradient(135deg, #00f0ff, #0080ff); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">Z</span>
                    </span>
                </a>

                <!-- Desktop Nav -->
                <ul class="hidden md:flex items-center gap-8">
                    <li>
                        <a href="{{ route('home', [], false) }}" class="nav-link text-sm text-slate-400 hover:text-slate-100 transition-colors">
                            Inicio
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('projects.index', [], false) }}" class="nav-link text-sm text-slate-400 hover:text-slate-100 transition-colors">
                            Proyectos
                        </a>
                    </li>
                    <li>
                        <a href="#contacto" class="nav-link text-sm text-slate-400 hover:text-slate-100 transition-colors">
                            Contacto
                        </a>
                    </li>
                    <li>
                        <a href="https://github.com" target="_blank" rel="noopener noreferrer"
                           class="flex items-center gap-2 text-sm font-mono border border-slate-700 hover:border-indigo-500 hover:text-indigo-400 text-slate-400 px-4 py-1.5 rounded-md transition-all duration-200">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path></svg>
                            GitHub
                        </a>
                    </li>
                </ul>

                <!-- Mobile menu button -->
                <button @click="open = !open" class="md:hidden text-slate-400 hover:text-slate-100 transition-colors">
                    <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="open" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div x-show="open"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-2"
                 x-cloak
                 class="md:hidden mt-4 pb-4 border-t border-slate-800">
                <ul class="flex flex-col gap-1 pt-4">
                    <li><a href="{{ route('home', [], false) }}" class="block px-2 py-2 text-slate-400 hover:text-slate-100 hover:bg-slate-800/50 rounded-md transition-colors text-sm">Inicio</a></li>
                    <li><a href="{{ route('projects.index', [], false) }}" class="block px-2 py-2 text-slate-400 hover:text-slate-100 hover:bg-slate-800/50 rounded-md transition-colors text-sm">Proyectos</a></li>
                    <li><a href="#contacto" class="block px-2 py-2 text-slate-400 hover:text-slate-100 hover:bg-slate-800/50 rounded-md transition-colors text-sm">Contacto</a></li>
                    <li><a href="https://github.com" target="_blank" class="block px-2 py-2 text-slate-400 hover:text-slate-100 hover:bg-slate-800/50 rounded-md transition-colors text-sm">GitHub</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- MAIN CONTENT -->
    <main class="flex-1 pt-16">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer id="contacto" class="border-t border-slate-800 bg-zinc-950 mt-auto">
        <div class="max-w-6xl mx-auto px-6 py-16">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">

                <!-- Brand -->
                <div class="space-y-4">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 bg-indigo-600 rounded-md flex items-center justify-center text-white font-mono font-bold text-xs">IK</div>
                        <span class="font-semibold text-slate-100">Iker<span class="text-indigo-400">.</span>dev</span>
                    </div>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Arquitecto de soluciones web robustas y escalables. Transformando lógica compleja en aplicaciones de alto rendimiento.
                    </p>
                </div>

                <!-- Links -->
                <div class="space-y-4">
                    <h4 class="text-slate-300 font-medium text-sm uppercase tracking-wider">Navegación</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home', [], false) }}" class="text-slate-500 hover:text-indigo-400 text-sm transition-colors">Inicio</a></li>
                        <li><a href="{{ route('projects.index', [], false) }}" class="text-slate-500 hover:text-indigo-400 text-sm transition-colors">Proyectos</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="space-y-4">
                    <h4 class="text-slate-300 font-medium text-sm uppercase tracking-wider">Contacto</h4>
                    <div class="flex flex-col gap-3">
                        <a href="https://github.com" target="_blank" rel="noopener noreferrer"
                           class="flex items-center gap-2 text-slate-500 hover:text-indigo-400 transition-colors text-sm group">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path></svg>
                            GitHub
                        </a>
                        <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer"
                           class="flex items-center gap-2 text-slate-500 hover:text-indigo-400 transition-colors text-sm group">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            LinkedIn
                        </a>
                        <a href="mailto:iker@example.com"
                           class="flex items-center gap-2 text-slate-500 hover:text-indigo-400 transition-colors text-sm group">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            Email
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-slate-800/60 mt-12 pt-6 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-slate-600 text-xs font-mono">
                    © {{ date('Y') }} Iker. Construido con Laravel + Tailwind.
                </p>
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    <span class="text-slate-600 text-xs font-mono">Disponible para proyectos</span>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
