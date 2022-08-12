<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <title>Edit Projects</title>
</head>
<body>
<h1 class="text-center mt-5">
    Edit Project(Admin)
</h1>
<a class="btn btn-outline-secondary" href="{{route('projects1.index')}}">Back</a>

<hr>
<div class="container justify-content-center">
    <form action="{{route('projects1.update',$project->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <img src="/images/{{$project->thumbnail}}" style="width: 30rem;" >
        </div>
        <div class="form-group m-2 p-2">
            <label for="image">Upload Image</label>
            <input class="form-control" type="file" name="thumbnail" >
        </div>
        <div class="form-group m-2 p-2">
            <label for="project_title">Project title</label>
            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title"  value="{{$project->title}}">
            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group m-2 p-2">
            <label for="project_title">Project Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" type="text" name="description" cols="30" rows="10">{{$project->description}} </textarea>
            @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group m-2 p-2">
            <label for="category_id">Category</label>
            <select class="form-control" name="category_id" id="category_id">
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group m-2 p-2">
            <label for="project_title">Skills</label>
            <textarea class="form-control @error('skills') is-invalid @enderror" type="text" name="skills" cols="30" rows="10" placeholder="Add Project Skills...">{{$project->skills}}</textarea>
            @error('skills')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <button class="btn btn-success" type="submit" value="submit">Update Project</button>
    </form>
</div>
</body>
</html>

