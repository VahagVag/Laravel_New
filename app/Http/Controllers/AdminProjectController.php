<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminProjectController extends Controller
{

    public function index()
    {
        $projects = Project::all();
        return view('AdminProject.index',compact('projects'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('AdminProject.create_project', compact('categories'));
    }


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

        $project->save();

        return redirect()->route('projects1.index')->with('success','Project Created Successfully');

    }


    public function show($id)
    {

    }

    public function edit($id)
    {
        $project = Project::find($id);
        $categories = Category::all();
        return view('AdminProject.edit_project',compact('project','categories'));
    }


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
    public function destroy($id)
    {
        $project = Project::find($id);
        @unlink(public_path($project->thumbnail));
        $project->delete();
        return redirect()->route('projects1.index')->with('success','Project Deleted Successfully');
    }
}
