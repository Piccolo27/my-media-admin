@extends('admin.layouts.app')

@section('content')
    <div class="col-8 offset-3 mt-5">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <legend class="text-center">Change Password</legend>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            {{-- Alert start --}}
                            @if (Session::has('updateSuccess'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <span>{{ Session::get('updateSuccess') }}</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if (Session::has('fail'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <span>{{ Session::get('fail') }}</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            {{-- Alert end --}}
                            <form class="form-horizontal" method="post" action="{{ route('admin#changePassword') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="inputName" class="col-3 col-form-label">Old Password</label>
                                    <div class="col-9">
                                        <input type="password" name="oldPassword" class="form-control" id="inputName"
                                            placeholder="Old Password">

                                        @error('oldPassword')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-3 col-form-label">New Password</label>
                                    <div class="col-9">
                                        <input type="password" name="newPassword" class="form-control" id=""
                                            placeholder="New Password">

                                        @error('newPassword')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-3 col-form-label">Confirm Password</label>
                                    <div class="col-9">
                                        <input type="password" name="confirmPassword" class="form-control" id=""
                                            placeholder="Confirm Password">

                                        @error('confirmPassword')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-2 offset-10">
                                        <button type="submit" class="btn bg-dark text-white">Change</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
