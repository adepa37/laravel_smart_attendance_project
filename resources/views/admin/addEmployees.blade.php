@extends('layouts.master')


@section('title')
Edit Registered | Staff Atendance
@endsection


@section('content')
<div class="container" style="align-items: center;">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <!--<h3>Add New Employee</h3>-->
                </div>
                <div class="card-body" style="font-size: large;">
                    <div class="orw">

                        <div class="col-md-12">
                            <form action="/save-employees" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <h6>Add Employee Details</h6>

                                <div class="form-group">
                                    <div class="mb-6">
                                        <label>Employee ID</label>
                                        <input type="text" class="form-control" name="employee_id" value="" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="mb-6">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" name="firstname" value="" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="mb-3">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" name="lastname" value="" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="mb-3">
                                        <label>Job Title</label>
                                        <input type="text" class="form-control" name="job_title" value="" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="mb-3">
                                        <label>Department</label>
                                        <input type="text" class="form-control" name="department" value="" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="mb-3">
                                        <label>Phone</label>
                                        <input type="text" class="form-control" name="phone" value="" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" value="" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="mb-3">
                                        <label>Birthday</label>
                                        <input type="date" class="form-control" name="birthday" value="" required>
                                    </div>
                                </div>


                                <img id="blah" src="http://placehold.it/180" alt="Selected image" style="max-width:180px; max-height:180px; padding: 20px">
                                <div class="input-group mb-3">
                                    <label class="input-group-text" for="image">Select a passport size picture:</label>
                                    <input type="file" class="form-control" name="image" accept="image/*" onchange="readURL(this);" required>

                                </div>

                                <button type="submit" class="btn btn-success float-right">Save</button>
                                <a href="/employees" class="btn btn-danger float-right">Back</a>
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
