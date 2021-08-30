<x-admin-master>
    @section('content')
        <h1>All Users</h1>
        @if(session('warning'))
            <div class="alert alert-danger">{{ session('warning') }}</div>
            @elseif(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @elseif(session('info'))
            <div class="alert alert-info">{{ session('info') }}</div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Username</th>
                      <th>Avatar</th>
                      <th>Name</th>
                      <th>Registed Date</th>
                      <th>Updated Profile Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Id</th>
                      <th>Username</th>
                      <th>Avatar</th>
                      <th>Name</th>
                      <th>Registed Date</th>
                      <th>Updated Profile Date</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                      @foreach($users as $user)
                      <tr>
                          <td>{{ $user->id }}</td>
                          <td>{{ $user->username }}</td>
                          <td><img src="{{ $user->avatar }}" width="60" alt=""></td>
                          <td>{{ $user->name }}</td>
                          
                          <td>{{ $user->created_at->diffForHumans() }}</td>
                          <td>{{ $user->updated_at->diffForHumans() }}</td>
                          <td>
                            <form action="{{ route('user.destroy',$user->id) }}" onsubmit="return confirm('Are you sure?')" method="POST">
                               @csrf
                               @method('DELETE')
                               <button class="btn btn-outline-danger btn-sm">Delete</button> 
                            </form>
                          </td>
                          
                      </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
    @endsection

    @section('scripts')
        <!-- Page level plugins -->
        <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

        <!-- Page level custom scripts -->
        <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

    @endsection
</x-admin-master>
