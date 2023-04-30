<x-admin-master>
    @section('content')
        <h1>Users</h1>

        @if (session('user-deleted'))
            <div class="alert alert-danger">{{session('user-deleted')}}</div>
        @endif
          <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Avatar</th>
                <th>Name</th>
                <th>Registered Date</th>
                <th>Updated profile date</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Avatar</th>
                <th>Name</th>
                <th>Registered Date</th>
                <th>Updated profile date</th>
                <th>Delete</th>
              </tr>
            </tfoot>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td><a href="{{route('user.profile.show', $user->id)}}">{{$user->username}}</a></td>
                    <td><img height="50px" src="{{$user->avatar}}" alt=""></td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->created_at->diffForHumans()}}</td>
                    <td>{{$user->updated_at->diffForHumans()}}</td>
                    <td>
                        <form action='{{route('user.destroy', $user->id)}}' method='post'>
                        @csrf
                        @method('DELETE')
                        <button type='submit' class='btn btn-danger'>Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
    @endsection
    @section('scripts')
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
    @endsection
</x-admin-master>