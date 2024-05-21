@extends('layouts.master')


@section('title')
Edit Registered | Staff Atendance
@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Employee</h3>
                </div>
                <div class="card-body">
                    <form action="/employees-update/{{ $employee->id }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="mb-6">
                            <label for="image" class="form-label">Employee Image</label>
                            <img id="image" src="{{ asset('storage/images/'.$employee->image) }}" alt="Selected image" class="img-fluid rounded mb-3" style="max-width: 200px;">
                            <!-- <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="readURL(this);" required> -->
                        </div>

                        <div class="mb-3">
                            <label for="employee_id" class="form-label">Employee ID</label>
                            <input type="text" id="employee_id" class="form-control" name="employee_id" value="{{ $employee->employee_id }}" readonly>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="firstname" class="form-label">First Name</label>
                                    <input type="text" id="firstname" class="form-control" name="firstname" value="{{ $employee->first_name }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="lastname" class="form-label">Last Name</label>
                                    <input type="text" id="lastname" class="form-control" name="lastname" value="{{ $employee->last_name }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="job_title" class="form-label">Job Title</label>
                            <input type="text" id="job_title" class="form-control" name="job_title" value="{{ $employee->job_title }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="department" class="form-label">Department</label>
                            <input type="text" id="department" class="form-control" name="department" value="{{ $employee->department }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" id="phone" class="form-control" name="phone" value="{{ $employee->phone }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" class="form-control" name="email" value="{{ $employee->email }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="birthday" class="form-label">Birthday</label>
                            <input type="date" id="birthday" class="form-control" name="birthday" value="{{ $employee->birth_date }}" required>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-success float-right">Update</button>
                            <a href="/employees" class="btn btn-danger float-right">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('scripts')
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('blah').src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>


@endsection
