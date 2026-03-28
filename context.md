# Contexto de Desarrollo: Portfolio Senior PHP

## Perfil Profesional
- **Rol:** Arquitecto de Soluciones Web / Programador Backend PHP Senior.
- **Enfoque:** Código limpio, rendimiento, arquitecturas escalables (SaaS, APIs, Real-time).

## Stack Tecnológico Obligatorio
- **Lenguaje:** PHP 8.3+ (Strict types activo).
- **Framework:** Laravel 11 / Symfony 7 (Elige uno para empezar, recomiendo Laravel 11 por velocidad de desarrollo para este caso).
- **Frontend:** Tailwind CSS + Livewire (TALL Stack).
- **Base de Datos:** PostgreSQL con optimización de índices.
- **Calidad:** Pest para Testing, PHPStan para análisis estático.

## Estructura de Datos Requerida
1. **Projects:** id, title, slug, description (markdown), problem, solution, results, stack (json), github_url, live_url, cover_image.
2. **Posts:** id, title, slug, content (markdown), category, published_at.
3. **Leads:** id, name, email, message, ip_address, status (new/read).

## Reglas de Generación de Código
- Usar **Service Pattern** para la lógica de negocio.
- Controladores delgados (Skinny Controllers).
- Migraciones con claves foráneas e índices definidos.
- UI limpia, minimalista y profesional con Tailwind.
