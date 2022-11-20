@extends('admin.layouts.app')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Trend Posts Page</h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Post Title</th>
                            <th>Image</th>
                            <th>View Count</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post['post_id'] }}</td>
                                <td>{{ $post['title'] }}</td>
                                <td>
                                    <img class="rounded-sm" style="width: 100px"
                                        @if ($post['image'] == null) src="{{ asset('defaultImage/default-image.jpg') }}"
                                        @else src="{{ asset('postImage/' . $post->image) }}" @endif
                                    >
                                </td>
                                <td> {{ $post['post_count'] }} <i class="fa-solid fa-eye ml-1"></i></td>
                                <td>
                                    <a href="{{ route('admin#trendPostDetails', $post['post_id']) }}">
                                        <button class="btn btn-sm bg-dark text-white"><i
                                                class="fa-solid fa-file-lines"></i></button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- <div class="d-flex justify-content-end mt-3 mr-3">{{ $posts->links() }}</div> --}}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
