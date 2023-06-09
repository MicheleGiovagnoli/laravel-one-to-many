<?php

namespace App\Http\Controllers\Admin;

use App\http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $validated_data = $request->all();

        $validated_data['slug'] = Project::generateSlug($request->title);

        $checkProject = Project::where('slug', $validated_data['slug'])->first();
        if ($checkProject) {
            return back()->withInput()->withErrors(['slug' => 'Impossibile creare lo slug per questo Project, cambia il titolo']);
        }
        $newPost = Project::create($validated_data);
        return redirect()->route('admin.projects.index', ['project' => $newPost->slug])->with('status', 'Post creato con successo!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        return view('admin.projects.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $validated_data = $request->all();

        $validated_data['slug'] = Project::generateSlug($request->title);

        $checkProject = Project::where('slug', $validated_data['slug'])->where('id', '<>', $project->id)->first();
        if ($checkProject) {
            return back()->withInput()->withErrors(['slug' => 'Impossibile creare lo slug per questo Project, cambia il titolo']);
        }

        $project->update($validated_data);
        return redirect()->route('admin.projects.index', ['project' => $project->slug])->with('status', 'Post modificato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index');
    }
}
