<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../css/app.css">
    <title>Create Projects</title>
</head>
<body>
<h1 class="text-center mt-5">
    Create Project(User)
</h1>
<a class="btn btn-outline-secondary" href="{{route('projects.index')}}">Back</a>
<hr>
<div class="container justify-content-center">
    <form action="{{route('projects.store')}}" method="post" id="form123" enctype="multipart/form-data">
        @csrf
        <div class="form-group m-2 p-2">
            <label for="image" class="control-label required">Upload Image</label>
           <p style="color: red"  role="alert" id="error"></p>
            <input class="form-control @error('thumbnail') is-invalid @enderror f_file" type="file" name="thumbnail" value="{{old('')}}">
            @error('thumbnail')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group m-2 p-2">
            <label for="project_title" class="control-label required">Project title</label>
            <textarea class="form-control @error('title') is-invalid @enderror " type="text" name="title" placeholder="Project Title">{{old('title')}}</textarea>
            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group m-2 p-2">
            <label for="project_title" class="control-label required">Project Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" type="text" name="description" placeholder="Add Project Description...">{{old('description')}}</textarea>
            @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group m-2 p-2">
            <label for="project_title" class="control-label required">Url</label>
            <textarea class="form-control @error('url') is-invalid @enderror" type="text" name="url" placeholder="Add Project Description...">{{old('url')}}</textarea>
            @error('url')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group m-2 p-2" class="control-label required">
            <label for="category_id">Category</label>
            <select class="form-control" name="category_id" id="category_id">
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group m-2 p-2">
            <label for="project_title" class="control-label required">Skills</label>
            <textarea class="form-control @error('skills') is-invalid @enderror" type="text" name="skills" cols="30" rows="10" placeholder="Add Project Skills...">{{old('skills')}}</textarea>
            @error('skills')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <button class="btn btn-success" id="submitasd" type="button"  >Add Project</button>
    </form>

    <script type="text/javascript">
            document.getElementById('submitasd').onclick = function (e) {
                let value = document.querySelector('.f_file').value;
                console.log(value)
                if (!value) {
                    console.log(1)
                    document.getElementById('error').append('Please choose  image')
                } else
                {
                    console.log(2)
                    let from = document.querySelector("#form123")
                    from.submit()
                }
            }
    </script>
</div>
</body>
</html>
