@extends('admin.layouts.app')

@section('content')
    <div class="col-4 mt-4">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('category#update',$data['category_id']) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" class="form-control" value="{{ old('categoryName',$data['title']) }}" name="categoryName"
                            placeholder="Enter Name">
                        @error('categoryName')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Category Description</label>
                        <textarea class="form-control" cols="30" rows="10" name="categoryDescription" placeholder="Enter Description">{{ old('categoryDescription',$data['description']) }}</textarea>
                        @error('categoryDescription')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-dark">Update</button>
                    <a href="{{ route('admin#category') }}"><button type="button" class="btn btn-primary">Create</button></a>
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
                            <input type="text" name="categorySearchKey" class="form-control float-right" placeholder="Search">

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
                            <th>Category ID</th>
                            <th>Category Name</th>
                            <th>Category Description</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category['category_id'] }}</td>
                                <td>{{ $category['title'] }}</td>
                                <td>{{ $category['description'] }}</td>
                                <td>
                                    <a href="{{ route('category#editPage',$category['category_id']) }}">
                                        <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                                    </a>
                                    <a href="{{ route('category#delete',$category['category_id']) }}">
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
