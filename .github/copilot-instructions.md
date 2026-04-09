# Instrucciones para GitHub Copilot Coding Agent

## Proyecto
Portfolio profesional Laravel 11 (PHP 8.3+). Backend API + Blade/Livewire frontend. PostgreSQL como base de datos.

## Stack obligatorio
- **PHP**: 8.3+ con `declare(strict_types=1)` en todos los archivos.
- **Framework**: Laravel 11.
- **Frontend**: Tailwind CSS + Blade (Livewire si hay interactividad).
- **Base de datos**: PostgreSQL.
- **Testing**: PHPUnit 10 (`vendor/bin/phpunit`). Los tests van en `tests/Unit/` y `tests/Feature/`.
- **Linting**: Laravel Pint (`vendor/bin/pint`).

## Arquitectura y patrones
- **Service Pattern**: toda la lógica de negocio va en `app/Services/`. Los controladores solo reciben la request, llaman al servicio y devuelven la respuesta.
- **Skinny Controllers**: un controlador no debe tener más de 5 métodos ni contener lógica de negocio.
- **Form Requests**: validación siempre en clases `app/Http/Requests/`, nunca en el controlador.
- **API Resources**: respuestas de API siempre con `JsonResource` en `app/Http/Resources/`.
- **Modelos**: sin lógica de negocio. Solo relaciones, scopes, casts y fillable.

## Base de datos
- Todas las migraciones deben incluir método `down()` con el rollback correspondiente.
- Las columnas usadas en `WHERE`, `JOIN` u `ORDER BY` frecuentes deben tener índice definido en la migración.
- Las Foreign Keys deben tener `->constrained()->cascadeOnDelete()` o `->nullOnDelete()` según corresponda.
- Los soft deletes (`deleted_at`) requieren un índice compuesto.
- No usar `VARCHAR(255)` de forma genérica; ajustar la longitud al dominio.

## Ramas y commits
- Rama de trabajo: crea siempre una rama descriptiva antes de hacer cambios. Nunca trabajes directamente en `main`.
- Prefijos de commit convencionales: `feat:`, `fix:`, `refactor:`, `perf:`, `test:`, `chore:`, `docs:`.
- No hagas `push` ni abras Pull Request sin confirmación explícita.

## Calidad
- Ejecuta `vendor/bin/phpunit` antes de dar por terminada cualquier tarea que modifique lógica.
- Ejecuta `vendor/bin/pint` para formatear el código antes de hacer commit.
- No uses `env()` directamente en código fuera de `config/`; usa `config('key')`.
- No dejes `dd()`, `dump()`, `var_dump()` ni código comentado en commits.
- No uses `SELECT *`; usa `->select([...])` explícito en consultas Eloquent costosas.

## Seguridad
- Nunca escribas contraseñas, tokens ni API keys en archivos rastreados por Git.
- Usa variables de entorno (`.env`) o GitHub Secrets para credenciales.
- Valida y sanitiza toda entrada de usuario en Form Requests antes de procesarla.
- No expongas rutas de administración sin middleware de autenticación.

## Lo que NO debes hacer
- Añadir dependencias de Composer o npm sin justificación explícita.
- Crear archivos de documentación (`.md`) salvo que se solicite expresamente.
- Hacer `git push --force`, `git reset --hard` ni borrar ramas sin confirmación.
- Modificar archivos de configuración de entorno (`.env`, `.env.example`) con valores reales.
