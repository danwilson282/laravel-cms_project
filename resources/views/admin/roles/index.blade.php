<x-admin-master>
    @section('content')
    @if (Session::has('role-deleted'))
    <div class="alert alert-danger">
        {{session('role-deleted')}}
    </div>

    @endif
        <div class="row">

            <div class="col-sm-3">
                <form method="post" action="{{route('roles.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" id="name" type="text" class="form-control @error('name') is-invalid @enderror">
                        <div>
                            @error('name')
                                <span><strong>{{$message}}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Create</button>
                </form>
            </div>
            <div class="col-sm-9">Roles
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr> 
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Delete</th>
                      </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{$role->id}}</td>
                                <td><a href={{route('role.edit', $role->id)}}>{{$role->name}}</a></td>
                                <td>{{$role->slug}}</td>
                                <td>
                                    <form method="post" action="{{route('roles.destroy', $role->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
        
    @endsection
</x-admin-master>