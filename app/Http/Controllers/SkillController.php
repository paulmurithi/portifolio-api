<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Skill;
use App\Http\Resources\SkillResource;
use App\Http\Resources\SkillCollection;
use App\Http\Requests\storeSkill;

class SkillController extends Controller
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
        return new SkillCollection(Skill::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeSkill $request)
    {
        $skill = new Skill;
        $skill->name = $request->name;
        $skill->proficiency = $request->proficiency;
        $skill->save();

        return new SkillResource($skill);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new SkillResource(Skill::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(storeSkill $request, $id)
    {
        Skill::findOrFail($id);
        $skill->name = $request->name;
        $skill->proficiency = $request->proficiency;
        $skill->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();
    }
}
