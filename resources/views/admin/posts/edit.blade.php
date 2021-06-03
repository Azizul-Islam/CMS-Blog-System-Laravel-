<x-admin-master>
    @section('content')
     <h1>Edit</h1>
     
     <form action="{{ route('post.update',$post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" value="{{ old('title',$post->title) }}" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Enter title" id="">
            @error('title')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <img src="{{ $post->post_image }}" width="200" alt=""><br>
            <label for="title">File</label>
            <input type="file" class="form-control-file @error('post_image') is-invalid @enderror" name="post_image"  id="">
            @error('post_image')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="title">Body</label>
            <textarea name="body" class="form-control @error('body') is-invalid @enderror" id="" cols="30" rows="10" placeholder="Enter body">{{ old('body',$post->body) }}</textarea>
            @error('body')
            <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <button class="btn btn-primary">Submit</button>
    </form>
    @endsection

</x-admin-master>