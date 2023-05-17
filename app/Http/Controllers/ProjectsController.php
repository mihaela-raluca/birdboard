<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectsController extends Controller
{
    public function index() {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    public function store() {

        // validate
        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        // persist
        // validation on the owner_id is not required
        // this ensures the owner_id gets set automatically
        auth()->user()->projects()->create($attributes);


        // redirect
        return redirect('/projects');
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }
}
