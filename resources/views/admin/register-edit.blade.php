@extends('layouts.master')


@section('title')
Edit Registered | Staff Atendance
@endsection


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Role for Resigtered User</h3>
                </div>
                <div class="card-body">
                    <div class="orw">
                        <div class="col-md-8">
                            <form action="/role-register-update/{{ $users->id }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}

                                <div class="form-group">
                                    <div class="mb-3">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="username" value="{{ $users->name}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="mb-3">
                                        <label>Phone</label>
                                        <input type="text" class="form-control" name="phone" value="{{ $users->phone}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email" value="{{ $users->email}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="mb-3">
                                        <label>Give Role</label>
                                        <select name="usertype" class="form-control">
                                            <option value="{{ $users->usertype}}">{{ $users->usertype}}</option>
                                            <option value="admin">Admin</option>
                                            <option value="user">User</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">Update</button>
                                <a href="/role-register" class="btn btn-danger">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')

@endsection
