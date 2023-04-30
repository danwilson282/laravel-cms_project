<x-admin-master>
    @section('content')

        <h1>Edit a post</h1>
        <form action="{{route('post.update', $posts->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" aria-describedby="" placeholder="Enter title" value="{{$posts->title}}">
            </div>
            <div class="form-group">
                <div><img height="100px" src="{{$posts->post_image}}" alt=""></div>
                <label for="post_image">File</label>
                <input type="file" name="post_image" id="post_image" class="form-control-file" aria-describedby="" placeholder="Select file">
            </div>
            <div class="form-group">
                <textarea name="body" class="form-control" id="body" cols="30" rows="10">{{$posts->body}}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @endsection
</x-admin-master>