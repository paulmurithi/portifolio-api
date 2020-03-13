<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Testimonial;
use App\Http\Resources\TestimonialResource;
use App\Http\Resources\TestimonialCollection;
use App\Http\Requests\storeTestimonial;

class TestimonialController extends Controller
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
        return new TestimonialCollection(Testimonial::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeTestimonial $request)
    {
        $testimonial = new Testimonial;
        $testimonial->author = $request->author;
        $testimonial->occupation = $request->occupation;
        $testimonial->company = $request->company;
        $testimonial->content = $request->content;
        $testimonial->save();
        return new TestimonialResource($testimonial);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new TestimonialResource(Testimonial::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(storeTestimonial $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->author = $request->author;
        $testimonial->occupation = $request->occupation;
        $testimonial->company = $request->company;
        $testimonial->content = $request->content;
        $testimonial->save();
        return new TestimonialResource($testimonial);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $testimonial->delete();
    }

}
