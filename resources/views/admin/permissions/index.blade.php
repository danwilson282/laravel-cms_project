<x-admin-master>
    @section('content')
    @if (Session::has('permission-deleted'))
    <div class="alert alert-danger">
        {{session('permission-deleted')}}
    </div>

    @endif
        <div class="row">

            <div class="col-sm-3">
                <form method="post" action="{{route('permissions.store')}}">
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
            <div class="col-sm-9">Permissions
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
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{$permission->id}}</td>
                                <td><a href={{route('permission.edit', $permission->id)}}>{{$permission->name}}</a></td>
                                <td>{{$permission->slug}}</td>
                                <td>
                                    <form method="post" action="{{route('permissions.destroy', $permission->id)}}">
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