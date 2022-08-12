<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $projects = Project::all();

        return view('AdminProject.index',compact('projects'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = Category::all();
        return view('AdminProject.create_project', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function store(Request $request)
    {

        $this->validate($request,[

            'thumbnail'=>'required',
            'title'=>'required|min:5|max:10',
            'description'=>'required|min:5|max:10',
            'url' => 'required|url',
            'skills'=>'required|min:5|max:10',
        ]);

        $project = new Project;


        if($file = $request->file('thumbnail')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images',$name);
            $project->thumbnail = $name;
        }

        $project->title = $request->title;
        $project->description = $request->description;
        $project->url = $request->url;
        $project->skills = $request->skills;
        $project->category_id = $request->category_id;
        $project->user_id = $request->user()->id;

        $project->save();

        return redirect()->route('projects1.index')->with('success','Project Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $project = Project::find($id);
        $categories = Category::all();
        return view('AdminProject.edit_project',compact('project','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title'=>'required|min:5|max:10',
            'description'=>'required|min:5|max:10',
            'url' => 'required|url',
            'skills'=>'required|min:5|max:10',
        ]);
        $project = Project::find($id);

        if($file = $request->file('thumbnail')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images',$name);
            $project->thumbnail = $name;
        }

        $project->title = $request->title;
        $project->description = $request->description;
        $project->url = $request->url;
        $project->skills = $request->skills;
        $project->category_id = $request->category_id;

        $project->save();

        return redirect()->route('projects1.index')->with('success','Project Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $project = Project::find($id);

        if(File::exists(public_path('images/'.$project->thumbnail)))
        {
            File::delete('images/'.$project->thumbnail);
        }

        $project->delete();

        return redirect()->route('projects1.index')->with('success','Project Deleted Successfully');
    }
}
