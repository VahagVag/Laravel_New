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
@include('UsersPanel.Nav.NavBar')
<h1 class="text-center mt-5">{{Auth::user()->name}} Panel of Projects</h1>
<hr>
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
                    <th scope="col"> Category</th>
                    <th scope="col"> Image</th>
                    <th scope="col"> Any</th>
                    <th scope="col" width="2"></th>
                </tr>
                </thead>
                <tbody class="alldata" id="Content">
                @forelse($projects as $project)
                    <tr>
                        <td>{{$project->id}}</td>
                        <td>{{$project->title}}</td>
                        <td>{{$project->description}}</td>
                        <td>{{$project->url}}</td>
                        <td>{{$project->category->name}}</td>
                        <td><img src="/images/{{$project->thumbnail}}" width="90" height="auto"></td>
                        <td><a href="{{route('projects.detail', $project->id)}}" class="btn btn-success">Detail</a>,<a
                                class="btn btn-primary" href="{{route('projects.edit',['id'=>$project->id])}}">Edit</a>
                        </td>
                        <td><a> <input class="form-check-input f_input_checkbox" type="checkbox" value=""
                                       onclick="enable()"  data-id="{{ $project->id }}"></a></td>
                    </tr>
                @empty
                @endforelse
                </tbody>

                <tbody  class="searchdata">

                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.deletebtn').on('click',function () {
            $('#deletemodal').modal('show');
        });

        $('.deleteproduct').on('click',function (){
                let requestIds = [] ;
                document.querySelectorAll('.f_input_checkbox').forEach(element=>{
                    if(element.checked === true){
                        requestIds.push(element.getAttribute('data-id'));
                    }
                })

                $.ajax({
                    type:'DELETE',
                    url:"{{ route('projects.destroy') }}",
                    data: {'_token': "{{csrf_token()}}",requestIds:requestIds},
                    success:function(data){
                        console.log(data);
                    }

                });
            location.reload();
            }
        );
    });
    function enable(){
        document.querySelectorAll('.f_input_checkbox').forEach(element =>{
            var btn = document.getElementById('btn');

            if(element.checked){
                btn.removeAttribute('disabled');
            }
        });
    }
</script>

<script type="text/javascript">

    $('#search').on('keyup',function ()
    {
        $value = $(this).val();

        if($value)
        {
            $('.searchdata').show();
        }
        $.ajax({
            type:'get',
            url:'{{URL::to('search')}}',
            data:{'search':$value},

            success:function (data)
            {
                console.log(data);
                $('#Content').html(data);
            }
        })

    })
</script>
</body>
</html>
