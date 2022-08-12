<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class HomePageController extends Controller
{

    public function index()
    {
        $projects = Auth::user()->projects;

        $skills = Skill::all();

        return view('UsersPanel.HomePage', compact('projects', 'skills'));
    }


    public function detail($id)
    {
        $project = Project::find($id);

        return view('UsersPanel.showDetails', compact('project'));

    }

    public function search(Request $request)
    {
        $output = "";

        $projects=Project::where('user_id',$request->user()->id)
            ->where(function ($query) use($request){
                $query->where('title','like', '%'.$request->search.'%');
                $query->orWhere('description','like','%'.$request->search.'%');
            })
            ->get();

        foreach ($projects as $project
    )
        {
            $output.=
            '<tr>
              <td> '.$project->title.' </td>
              <td> '.$project->description.' </td>
              <td> '.$project->url.' </td>
              <td><img src="/images/'.$project->thumbnail.'"width="90" height="60"></td>
              <td> '.$project->skills.' </td>
               <td><a href='.route('projects.detail', $project->id).' class="btn btn-success">Detail</a>,<a
                                class="btn btn-primary" href='.route('projects.edit' , ['id'=>$project->id]).'>Edit</a>
                        </td>
                        <td><a> <input class="form-check-input f_input_checkbox" type="checkbox" value=""
                                       onclick="enable()"  data-id='.$project->id.'></a></td>
              </tr>';

        }
        return response($output);
    }

    public function store(Request $request)
    {

        $this->validate($request, [

            'thumbnail' => 'required',
            'description'=>'required|min:5|max:10',
            'title' => 'required|min:5|max:10',
            'skills' => 'required|min:5|max:10',
            'url' => 'required|url',

        ]);

        $project = new Project;


        $file = $request->file('thumbnail');
        $name = time() . $file->getClientOriginalName();
        $file->move('images', $name);
        $project->thumbnail = $name;


        $project->title = $request->title;
        $project->description = $request->description;
        $project->skills = $request->skills;
        $project->category_id = $request->category_id;
        $project->user_id = $request->user()->id;
        $project->url = $request->url;
        $project->save();

        return redirect()->route('projects.index')->with('success', 'Project Created Successfully');

    }

    public function create()
    {

        $categories = Category::all();
        return view('UsersPanel.create', compact('categories'));

    }

    public function deleteProject(Request $request)

    {

        $this->validate($request,[
           'requestIds' => 'required'
        ]);

        $ids = $request['requestIds'];

        foreach ($ids as $id)
        {
            $project = Project::find($id);

            $imageName = $project->thumbnail;

            $this->destroyImage($imageName);
        }

        Project::whereIn('id',$ids)->delete();

    }

    /**
     * @param string $imageName
     * @return void
     */
    public function destroyImage(string $imageName):void
    {
        if (!File::exists(public_path('images/' . $imageName))) {
            return ;
        }

        File::delete('images/' . $imageName);

    }

    public function edit($id)
    {
        $project = Project::find($id);
        $categories = Category::all();
        return view('UsersPanel.edit',compact('project','categories'));
    }

    public function update(Request $request, $id)

    {
        $this->validate($request,[
            'title'=>'required|min:5|max:10',
            'description'=>'required|min:5|max:10',
            'skills'=>'required|min:5|max:10',
            'url' => 'required|url',
        ]);

        $project = Project::find($id);

        if($file = $request->file('thumbnail')){
            $name = time() . $file->getClientOriginalName();
            $file->move('images',$name);
            $project->thumbnail = $name;
        }

        $project->title = $request->title;
        $project->description = $request->description;
        $project->skills = $request->skills;
        $project->category_id = $request->category_id;
        $project->url = $request->url;

        $project->save();

        return redirect()->route('projects.index')->with('success','Project Updated Successfully');
    }


}
