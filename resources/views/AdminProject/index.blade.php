<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{url('/css/app.css')}}" rel="stylesheet">
    <title>Index</title>
</head>
<body>
<h1 class="text-center mt-5">Index(Admin) <a class="btn btn-primary" href="{{route('projects1.create')}}">Create</a></h1>

<br>
<br>

<button class="nav-item btn btn-outline-secondary" href="{{ route('login') }}"
    onclick="event.preventDefault()
       document.getElementById('logout-form').submit()">
    <a class="nav-link" href="{{ __('Logout') }}">Logout</a>
</button>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
<hr>
<table class="table">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Title</th>
        <th scope="col">Category</th>
        <th scope="col">Url Page</th>
        <th scope="col">Description</th>
        <th scope="col">Thumbnail</th>
        <th scope="col">Skills</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($projects as $project)
    <tr>
        <th scope="row">{{$project->id}}</th>
        <td>{{$project->title}}</td>
        <td>{{$project->category->name}}</td>
        <td>{{$project->url}}</td>
        <td>{{$project->description}}</td>
        <td><img style="height: 100px; width: 200px " src="/images/{{$project->thumbnail}}"/></td>
        <td>{{$project->skills}}</td>
        <td><a class="btn btn-primary" href="{{route('projects1.edit',$project->id)}}">Edit</a></td>
        <td>
            <form action="{{route('projects1.destroy',$project->id)}}" method="post">
                @csrf
                @method('DELETE')
                <input type="submit" value="Delete" class="btn btn-danger"/>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
{{--<span>{{ $projects->links() }}</span>--}}
</body>
</html>
