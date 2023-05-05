<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Birdboard</title>
    </head>
    <body>
        <h1>Birdboard</h1>
        <ul>
            <!-- foreach had to be changed to forelse, so we can account for no projects-->
            @forelse ($projects as $project)
                <li>
                    <a href="{{ $project->path() }}">{{ $project->title }}</a>
                </li>
            @empty
                <li>No projects yet.</li>
            @endforelse
        </ul>
    </body>
</html>

