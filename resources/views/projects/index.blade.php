<!DOCTYPE html>
<html lang="en">
<head>
    <title>Birdboard</title>
</head>
<body>
    <ul>
        @foreach ($projects as $project)
            <li>{{ $project->title }}</li>
        @endforeach
    </ul>
</body>
</html>

