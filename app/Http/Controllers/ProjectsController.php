<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Project;

class ProjectController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('index');
    }

    public function index(){
        // returns all projects
        return Project::all();
        return view('index', $projects, compact('projects'));
    }

    public function store(Request $request){
        // creates a new project instance in the database
        $project = Project::create($this.validateData());
        // $project->title=$request->title;
        // $project->image=$request->image;
        // $project->github=$request->github;
        // $project->website=$request->website;
        $project-save();
    }

    public function update($id)
    {
        // updates a project instance
        $project = Project::findOrFail($id);
        $project->update(request()-validate());
    }
    public function destroy($id)
    {
        // deletes a project instance
    }
    protected function validateData(Request $request)
    {
        # validates request data
        return request()->validate([
            'title'=>'required',
            'website'=>'required',
            'website'=>'required',
            'website'=>'required'
        ]);
    }
}
