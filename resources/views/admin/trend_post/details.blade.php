@extends('admin.layouts.app')

@section('content')
    <div class="col-10 offset-1 mt-5">
        <div class="card">
            <i class="fa-solid fa-arrow-left text-dark mt-3 ml-3"
               onclick="history.back()"
               style="font-size:20px"
            >
            </i>
            <div class="card-header">
                <img class="rounded mx-auto d-block w-50"
                    @if ($post['image'] == null) src="{{ asset('defaultImage/default-image.jpg') }}"
                    @else src="{{ asset('postImage/' . $post->image) }}" @endif
                >
            </div>
            <div class="card-body">
                <h3 class="mt-2">{{ $post['title'] }}</h3>
                <p class="mt-3">{{ $post['description'] }}</p>
            </div>
        </div>
        <!-- /.card -->
        <button class="">Back</button>
    </div>
@endsection
