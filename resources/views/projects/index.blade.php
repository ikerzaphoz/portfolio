<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectos</title>
</head>
<body>
    <h1>Proyectos</h1>
    @foreach ($projects as $project)
        <div>
            <h2>{{ $project->title }}</h2>
            <p>{{ $project->description }}</p>
            <a href="{{ route('projects.show', $project->slug) }}">Ver caso de estudio →</a>
        </div>
    @endforeach
    {{ $projects->links() }}
</body>
</html>
