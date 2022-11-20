@extends('admin.layouts.app')

@section('content')
    <div class="col-4 mt-4">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('post#create') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" value="{{ old('postTitle') }}" class="form-control" name="postTitle"
                            placeholder="Enter Name">
                        @error('postTitle')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" cols="30" rows="10" name="postDescription" placeholder="Enter Description">{{ old('postDescription') }}</textarea>
                        @error('postDescription')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" name="postImage" placeholder="Enter Name">
                        @error('postImage')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Category Name</label>
                        <select name="postCategory" class="form-control">
                            <option value="">Choose Category..</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category['category_id'] }}">{{ $category['title'] }}</option>
                            @endforeach
                        </select>
                        @error('postCategory')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-dark">Create</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-8 mt-4">
        {{-- Alert start --}}
        <div class="offset-8 col-4 mt-3">
            @if (Session::has('deleteSuccess'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span>{{ Session::get('deleteSuccess') }}</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
        {{-- Alert end --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Category List Page</h3>

                <div class="card-tools">
                    <form action="{{ route('category#search') }}" method="POST">
                        @csrf
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="categorySearchKey" class="form-control float-right"
                                placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                    <thead>
                        <tr>
                            <th>Post ID</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post['post_id'] }}</td>
                                <td>{{ $post['title'] }}</td>
                                <td><img class="rounded-sm" style="width: 100px"
                                        @if ($post['image'] == null) src="{{ asset('defaultImage/default-image.jpg') }}" @else src="{{ asset('postImage/' . $post->image) }}" @endif>
                                </td>
                                <td>
                                    <a href="{{ route('post#updatePage', $post['post_id']) }}">
                                        <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                                    </a>
                                    <a href="{{ route('post#delete', $post['post_id']) }}">
                                        <button class="btn btn-sm bg-danger text-white"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
