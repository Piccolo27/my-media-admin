@extends('admin.layouts.app')

@section('content')
    <div class="col-8 offset-3 mt-5">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <legend class="text-center">User Profile</legend>
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
                            {{-- Alert end --}}
                            <form class="form-horizontal" method="post" action="{{ route('admin#update') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="string" name="adminName" class="form-control" id="inputName"
                                            placeholder="Name" value="{{ old('adminName', $user->name) }}">

                                        @error('adminName')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="adminEmail" class="form-control" id=""
                                            placeholder="Email" value="{{ old('adminEmail', $user->email) }}">

                                        @error('adminEmail')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Phone</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="adminPhone" class="form-control" id=""
                                            placeholder="Phone Number" value="{{ $user->phone }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <textarea name="adminAddress" cols="30" rows="10" placeholder="Address" class="form-control">{{ $user->address }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 col-form-label">Gender</label>
                                    <div class="col-sm-10">
                                        <select name="adminGender" class="form-control">
                                            <option value="empty" selected>Choose your gender</option>
                                            <option value="male" @if ($user->gender == 'male') selected @endif>Male
                                            </option>
                                            <option value="female" @if ($user->gender == 'female') selected @endif>Female
                                            </option>
                                            <option value="other" @if ($user->gender == 'other') selected @endif>Other
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn bg-dark text-white">Update</button>
                                    </div>
                                </div>
                            </form>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <a href="{{ route('admin#changePasswordPage') }}">Change Password</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
