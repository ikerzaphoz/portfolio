<!DOCTYPE html>
<html>
<head>
    <title>Portfolio de Iker</title>
</head>
<body>
    <h1>Mis Proyectos Reales</h1>
    <hr>
    @forelse($projects as $project)
        <div style="margin-bottom: 20px; border: 1px solid #ccc; padding: 10px;">
            <h2>{{ $project->title }}</h2>
            <p><strong>Stack:</strong> {{ is_array($project->stack) ? implode(', ', $project->stack) : $project->stack }}</p>
            <p>{{ $project->description }}</p>
        </div>
    @empty
        <p>No hay proyectos en la base de datos. ¿Ejecutaste el seed?</p>
    @endforelse
</body>
</html>