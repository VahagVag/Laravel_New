 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
            crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
            crossorigin="anonymous"></script>
    <link href="{{url('/css/app.css')}}" rel="stylesheet">
    <title>HomePage</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col card-info">
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th scope="col"> Place</th>
                    <th scope="col"> Skills</th>
                    <th scope="col"> Description</th>
                    <th scope="col">Url Page</th>
                    <th scope="col"> Image</th>
                </tr>
                </thead>
                <tbody class="alldata" id="Content">
                @forelse($purchased_products as $project)
                    <tr>
                        <td>{{$project->id}}</td>
                        <td>{{$project->title}}</td>
                        <td>{{$project->description}}</td>
                        <td>{{$project->url}}</td>
                        <td><img src="/images/{{$project->thumbnail}}" width="90" height="auto"></td>
                    </tr>
                @empty
                @endforelse
            </table>
        </div>
    </div>
</div>
<a class="btn btn-outline-secondary" href="{{route('projects.index')}}">Back</a>
</body>
</html>

