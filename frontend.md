# Directrices de Frontend y UI (TALL Stack)

## Estilo Visual (Design System)
- **Tema:** Dark mode nativo y obligatorio. Fondos oscuros (`bg-slate-900` o `bg-zinc-950`), textos legibles (`text-slate-300`, `text-slate-400`).
- **Acentos:** Colores primarios sobrios y tecnológicos (Azul o Índigo).
- **Tipografía:** Sans-serif limpia para lectura (Inter o similar) y tipografía Monospace (JetBrains Mono, Fira Code) para etiquetas, stacks tecnológicos y bloques de código.
- **Componentes:** Bordes sutiles (`border-slate-800`), sombras suaves y transiciones limpias al hacer hover. Nada de animaciones recargadas.

## Arquitectura de Vistas (Blade + Tailwind)
1. **Layout Principal (`resources/views/layouts/app.blade.php`):**
   - Debe contener el `<header>` con una navegación minimalista (Logo/Nombre a la izquierda, links a la derecha).
   - Un `<footer>` simple con enlaces a GitHub, LinkedIn y correo.
   - Usar la directiva `@yield('content')` o `$slot`.
   - Incluir Alpine.js y Tailwind CSS.

2. **Componentes Reutilizables:**
   - Extraer elementos repetitivos a componentes Blade (ej: `resources/views/components/project-card.blade.php` o `badge.blade.php` para el stack).

3. **Páginas a generar:**
   - **Home (`welcome.blade.php`):** Hero section impactante con la propuesta de valor (UVP) + Grid de Proyectos Destacados.
   - **Detalle de Proyecto (`projects/show.blade.php`):** Estructura clara tipo "Caso de Estudio": Cabecera con el título y stack, secciones separadas para Problema, Solución, Arquitectura y Resultados Tangibles.