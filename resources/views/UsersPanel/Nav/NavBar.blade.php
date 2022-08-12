<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <div class="modal fade" id="deletemodal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                           </button>
                        </div>

                            <div class="modal-body">
                                <input type="hidden" name="delete_id" id="delete_id">
                                <h4>Do you want to delete this products ??</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                                <button type="submit" class="deleteproduct" class="btn btn-primary">YES!! Delete product</button>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <ul>
                    <a class="btn btn-success nav-item" href="{{route('projects.create')}}">Create New Project</a>
            </ul>

            <ul>

                    <h1>OR</h1>

            </ul>

        <ul>
            <button type="button" disabled = "true"  class="btn btn-danger deletebtn" id="btn">DELETE</button>
        </ul>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

            </ul>

            <ul>
                <div class="container">
                    <div class="search">
                        <input type="search" name="search" id="search" placeholder="Search product" class="form-control">
                    </div>
                </div>
            </ul>
        </div>

        <li class="nav-item" href="{{ route('login') }}"
            onclick="event.preventDefault()
                      document.getElementById('logout-form').submit()">
            <a class="nav-link" href="{{ __('Logout') }}">Logout</a>
        </li>

    </div>

</nav>
