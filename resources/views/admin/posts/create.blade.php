<x-admin-master>
    @section('content')
     <h1>Create</h1>
     
     <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Enter title" id="">
            @error('title')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="title">File</label>
            <input type="file" class="form-control-file @error('post_image') is-invalid @enderror" name="post_image"  id="">
            @error('post_image')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="title">Body</label>
            <textarea name="body" class="form-control @error('body') is-invalid @enderror" id="" cols="30" rows="10" placeholder="Enter body"></textarea>
            @error('body')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <button class="btn btn-primary">Submit</button>
    </form>
    @endsection

</x-admin-master>