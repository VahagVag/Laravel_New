<!DOCTYPE html>
<div lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{url('/css/app.css')}}" rel="stylesheet">
    <title>HomePage</title>
</head>
<h1 class="text-center mt-5">Users Panel of Projects Detail page</h1>
<hr>

<div class="container">
    <div class="row">
        <div class="col">

            <div class="card" class="ml- 5 mt-5 ml-5 p-2" style="width: 30rem;">
                <img src="/images/{{$project->thumbnail}}" class="card-img-top" alt="...">
                <div class="card-body">

                    <h3 class="card-title">{{$project->title}}</h3>

                    <h4 class="card-text"><b>Category-{{$project->category->name}}</b></h4>
                    <hr>

                    <p class="card-text">{{$project->description}}</p>
                    <hr>

                    <p class="card-text">{{$project->url}}</p>
                    <hr>


                    <p class="card-text">{{$project->skills}}</p>
                    <hr>
                </div>
            </div>
        </div>
        <div class="col">
            <h3>Skills</h3>
            <hr>
            <p class="card-title card-project-skills">{{$project->skills}}</p>
        </div>

        <div class="col">
            <h3>Description</h3>
            <hr>
            <p class="card-title card-project-description">{{$project->description}}</p>
        </div>
        <a class="btn btn-outline-secondary" href="{{route('projects.index')}}">Back</a>

    </div>
</div>



    </body>
</html>
