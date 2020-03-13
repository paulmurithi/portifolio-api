<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\ProjectCollection;
use App\Http\Requests\storeProject;

class ProjectController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api')->except(['index','show']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ProjectCollection(Project::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeProject $request)
    {
        $project =new Project;
        $project->title = $request->title;
        $project->image = $request->image;
        $project->github = $request->github;
        $project->website = $request->website;
        $project->save();
        return new ProjectResource($project);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ProjectResource(Project::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(storeProject $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->title = $request->title;
        $project->image = $request->image;
        $project->github = $request->github;
        $project->website = $request->website;
        $project->save();
        return new ProjectResource($project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

    }
}
