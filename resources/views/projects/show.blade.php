<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $project->title }}</title>
</head>
<body>
    <h1>{{ $project->title }}</h1>
    <h2>Problema</h2>
    <p>{{ $project->problem }}</p>
    <h2>Solución</h2>
    <p>{{ $project->solution }}</p>
    <h2>Resultados</h2>
    <p>{{ $project->results }}</p>
    <h2>Stack</h2>
    <ul>
        @foreach ($project->stack as $tech)
            <li>{{ $tech }}</li>
        @endforeach
    </ul>
    <div>
        @foreach ($project->tags as $tag)
            <span>{{ $tag->name }}</span>
        @endforeach
    </div>
    <a href="{{ route('projects.index') }}">← Volver</a>
</body>
</html>
