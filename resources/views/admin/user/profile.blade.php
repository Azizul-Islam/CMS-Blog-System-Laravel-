<x-admin-master>
    @section('content')
        <h1>User profile for: {{ $user->name }}</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Update Profile</h6>
                    </div>
                <div class="card-body">
                <form action="{{ route('user.profile.update',$user) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <div class="mb-4"><img class="img-profile rounded-circle" width="60" height="60" src="{{ $user->avatar }}"></div>
                        <input type="file" name="avatar">
                    </div>
                    <div class="form-group">
                        <label for="name">Username:</label>
                        <input type="text" name="username" class="form-control" value="{{ $user->username }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Email:</label>
                        <input type="text" name="email" class="form-control" value="{{ $user->email }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Password:</label>
                        <input type="password" name="password" class="form-control" placeholder="XXXXXX">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm password:</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="XXXXXX">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
            </div>
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                          <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
                        </div>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                              <thead>
                                <tr>
                                  <th>Option</th>
                                  <th>Id</th>
                                  <th>Role</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($roles as $item)
                                    <tr>
                                        <td>
                                            <input type="checkbox" 
                                            @foreach($user->roles as $user_role)
                                                @if($user_role->id == $item->id) checked @endif
                                            @endforeach
                                            >
                                        </td>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <form action="{{ route('user.attach.role',$user) }}" method="POST">
                                                @csrf 
                                                <input type="hidden" name="role" value="{{ $item->id }}" id="">
                                                <button class="btn btn-info btn-sm float-left mr-2"
                                                    @if($user->roles->contains($item)) disabled @endif
                                                >Attach</button>
                                            </form>
                                            <form action="{{ route('user.detach.role',$user) }}" method="POST">
                                                @csrf 
                                                <input type="hidden" name="role" value="{{ $item->id }}" id="">
                                                <button class="btn btn-danger btn-sm float-left"
                                                    @if(!$user->roles->contains($item)) disabled @endif
                                                >Detach</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                              <tfoot>
                                <tr>
                                    <th>Option</th>
                                    <th>Id</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                  </tr>
                              </tfoot>
                             
                            </table>
                          </div>
                        </div>
                      </div>
                </div>
        </div>
        
    @endsection
</x-admin-master>