<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <title>Create Projects</title>
</head>
<body>

<h1 class="text-center mt-5">Create Skill (Admin)</h1>
<hr>

<div class="container justify-content-center">

    <form action="{{route('admin.skills.store')}}" method="post" >
        @csrf

        <div class="form-group m-2 p-2">
            <label for="skill_title">Skill Name</label>
            <input type="text" name="technology" placeholder="Technology">
        </div>

        <div class="form-group m-2 p-2">
            <label for="skill_title">Skills Score</label>
            <input type="text" name="score" placeholder="Score">
        </div>

        <button class="btn btn-success" type="submit" value="submit">Add Skill</button>

    </form>

</div>
</body>
</html>
