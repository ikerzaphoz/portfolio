<!DOCTYPE html>
<html lang="es" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Iker Zapata — Programador Full-Stack Senior')</title>
    <meta name="description"
        content="@yield('meta_description', 'Programador Full-Stack Senior con más de 10 años transformando modelos de negocio tradicionales en potentes plataformas e-commerce. Especialista en PHP y arquitectura a medida.')">

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
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap"
        rel="stylesheet">

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Inter', system-ui, sans-serif;
        }

        .font-mono {
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
        }

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

        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #0f172a;
        }

        ::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #6366f1;
        }
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
                    <img src="{{ asset('images/logo.png') }}" alt="Logo"
                        class="h-24 flex-shrink-0 group-hover:scale-105 transition-transform duration-200">
                    <span class="font-semibold text-slate-100 group-hover:text-white transition-colors tracking-wide">
                </a>

                <!-- Desktop Nav -->
                <ul class="hidden md:flex items-center gap-8">
                    <li>
                        <a href="{{ route('home', [], false) }}"
                            class="nav-link text-sm text-slate-400 hover:text-slate-100 transition-colors">
                            Inicio
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('projects.index', [], false) }}"
                            class="nav-link text-sm text-slate-400 hover:text-slate-100 transition-colors">
                            Proyectos
                        </a>
                    </li>
                    <li>
                        <a href="#contacto"
                            class="nav-link text-sm text-slate-400 hover:text-slate-100 transition-colors">
                            Contacto
                        </a>
                    </li>
                    <li>
                        <a href="https://linkedin.com/in/ikerzaphoz" target="_blank" rel="noopener noreferrer"
                            class="flex items-center gap-2 text-sm font-mono border border-slate-700 hover:border-indigo-500 hover:text-indigo-400 text-slate-400 px-4 py-1.5 rounded-md transition-all duration-200">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                            </svg>
                            LinkedIn
                        </a>
                    </li>
                    <li>
                        <a href="https://github.com/ikerzaphoz/" target="_blank" rel="noopener noreferrer"
                            class="flex items-center gap-2 text-sm font-mono border border-slate-700 hover:border-indigo-500 hover:text-indigo-400 text-slate-400 px-4 py-1.5 rounded-md transition-all duration-200">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 .296c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 17.97 3.633 17.58 3.633 17.58c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.807 1.304 3.492.997.108-.775.418-1.305.762-1.605-2.665-.305-5.467-1.335-5.467-5.932 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23a11.5 11.5 0 013.003-.404c1.02.005 2.045.138 3.003.404 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.922.43.372.81 1.102.81 2.222 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.296c0-6.627-5.373-12-12-12" />
                            </svg>
                            GitHub
                        </a>
                    </li>
                </ul>

                <!-- Mobile menu button -->
                <button @click="open = !open" class="md:hidden text-slate-400 hover:text-slate-100 transition-colors">
                    <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="open" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div x-show="open" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2"
                x-cloak class="md:hidden mt-4 pb-4 border-t border-slate-800">
                <ul class="flex flex-col gap-1 pt-4">
                    <li><a href="{{ route('home', [], false) }}"
                            class="block px-2 py-2 text-slate-400 hover:text-slate-100 hover:bg-slate-800/50 rounded-md transition-colors text-sm">Inicio</a>
                    </li>
                    <li><a href="{{ route('projects.index', [], false) }}"
                            class="block px-2 py-2 text-slate-400 hover:text-slate-100 hover:bg-slate-800/50 rounded-md transition-colors text-sm">Proyectos</a>
                    </li>
                    <li><a href="#contacto"
                            class="block px-2 py-2 text-slate-400 hover:text-slate-100 hover:bg-slate-800/50 rounded-md transition-colors text-sm">Contacto</a>
                    </li>
                    <li><a href="https://linkedin.com/in/ikerzaphoz" target="_blank"
                            class="block px-2 py-2 text-slate-400 hover:text-slate-100 hover:bg-slate-800/50 rounded-md transition-colors text-sm">LinkedIn</a>
                    </li>
                    <li><a href="https://github.com/ikerzaphoz/" target="_blank" rel="noopener noreferrer"
                            class="block px-2 py-2 text-slate-400 hover:text-slate-100 hover:bg-slate-800/50 rounded-md transition-colors text-sm">GitHub</a>
                    </li>

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
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Programador Full-Stack Senior. Más de 10 años transformando negocios
                        tradicionales en plataformas e-commerce potentes.
                    </p>
                </div>

                <!-- Links -->
                <div class="space-y-4">
                    <h4 class="text-slate-300 font-medium text-sm uppercase tracking-wider">Navegación</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home', [], false) }}"
                                class="text-slate-500 hover:text-indigo-400 text-sm transition-colors">Inicio</a></li>
                        <li><a href="{{ route('projects.index', [], false) }}"
                                class="text-slate-500 hover:text-indigo-400 text-sm transition-colors">Proyectos</a>
                        </li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="space-y-4">
                    <h4 class="text-slate-300 font-medium text-sm uppercase tracking-wider">Contacto</h4>
                    <div class="flex flex-col gap-3">
                        <a href="tel:+34677874951"
                            class="flex items-center gap-2 text-slate-500 hover:text-indigo-400 transition-colors text-sm group">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.129a11.042 11.042 0 005.516 5.516l1.129-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            677 874 951
                        </a>

                        <a href="mailto:hola@ikerzaphoz.dev"
                            class="flex items-center gap-2 text-slate-500 hover:text-indigo-400 transition-colors text-sm group">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            hola@ikerzaphoz.dev
                        </a>
                        <a href="https://linkedin.com/in/ikerzaphoz" target="_blank" rel="noopener noreferrer"
                            class="flex items-center gap-2 text-slate-500 hover:text-indigo-400 transition-colors text-sm group">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                            </svg>
                            LinkedIn
                        </a>
                    </div>
                </div>
            </div>

            <div
                class="border-t border-slate-800/60 mt-12 pt-6 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-slate-600 text-xs font-mono">
                    &copy; {{ date('Y') }} Iker Zapata. Construido con Laravel + Tailwind.
                </p>
            </div>
        </div>
    </footer>

</body>

</html>