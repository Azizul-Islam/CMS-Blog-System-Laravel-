<x-admin-master>
    @section('content')
        <h1>Posts</h1>
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
                      <th>Owner</th>
                      <th>Title</th>
                      <th>Image</th>
                      <th>Created At</th>
                      <th>Updated At</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Owner</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                      @foreach($posts as $post)
                      <tr>
                          <td>{{ $post->id }}</td>
                          <td>{{ $post->user->name }}</td>
                          <td><a href="{{ route('post.edit',$post->id) }}">{{ $post->title }}</a></td>
                          <td>
                              <img src="{{ $post->post_image }}" height="40" alt="">
                          </td>
                          <td>{{ $post->created_at->diffForHumans() }}</td>
                          <td>{{ $post->updated_at->diffForHumans() }}</td>
                          <td>
                            @can('view',$post)
                            <form action="{{ route('post.destroy',$post->id) }}" onsubmit="return confirm('Are you sure?')" method="POST">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-outline-danger btn-sm">Delete</button>
                            </form>
                            @endcan
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
