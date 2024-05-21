<!-- Button to trigger modal -->
@extends('layouts.master')


@section('title')
Employees | Staff Atendance
@endsection


@section('content')

@section('content')
<div class="modal fade" id="deleteModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('/employees-delete') }}" method="post">
                {{ csrf_field() }}
                {{ method_field('Post') }}
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="exampleModalLabel">Delete Employee</h3>
                    <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
                </div>
                <div class="modal-body">
                    <input type="hidden" name="delete_user" id="delete_user">
                    <h5>Are you sure you want to delet this Employee ?</h5>
                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-primary" data-bs-dismiss="deleteModel">Close</button>-->
                    <button type="submit" class="btn btn-danger">Yes Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Include the modal partial -->
@include('admin.employeesdetails')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">

                <h2 class="card-title">Search Employees Table </h2>
                <!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Add</button>-->

                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

            </div>
            <div class="card-body">
                <form action="{{ route('employeesearch.search') }}" method="GET">

                    <div class="input-group mb-3">
                        <input type="text" name="search" placeholder="Search by name or ID" class="form-control" required>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-line-secondary"><i class="fas fa-search"></i></button>
                        </div>

                        <!--<a href="/addEmployees" class="btn btn-primary float-right">Add</a><br>-->
                    </div>
                </form>
                @if ($searchResults->isEmpty())
                <h1>No results found.</h1>
                @else
                <div class="table-responsive">
                    <table class="table">
                        <thead class="text-primary">
                            <tr>
                                <th>Employee ID</th>
                                <th>Fist Name</th>
                                <th>Last Name</th>
                                <th>Phone</th>
                                <th style="display: none;">Email</th>
                                <th style="display: none;">Job Title</th>
                                <td style="display: none;">DEPARTMENT</td>
                                <td style="display: none;">BIRTHBAY</td>
                                <th>VIEW</th>
                                <th>EDIT</th>
                                <th>DELETE</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($searchResults as $employee)
                            <tr>
                                <td>{{ $employee->employee_id}}</td>
                                <td>{{ $employee->first_name}}</td>
                                <td>{{ $employee->last_name}}</td>
                                <td>{{ $employee->phone}}</td>
                                <td style="display: none;">{{ $employee->email}}</td>
                                <td style="display: none;">{{ $employee->job_title}}</td>
                                <td style="display: none;">{{ $employee->department}}</td>
                                <td style="display: none;">{{ $employee->birth_date}}</td>
                                <td style="display: none;">{{ $employee->image}}</td>
                                <td>
                                    <button type="button" class="btn viewUserBtn" data-bs-toggle="modal" data-bs-target="#viewModel" value="{{ $employee->id }}" style="background-color: blue;">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                                <td>
                                    <a href="/employee-edit/{{ $employee->id }}" class="btn btn-success"> <i class="fas fa-pencil-alt"></i></a>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger deleteUserBtn" value="{{ $employee->id }}"> <i class="fas fa-trash-alt"></i></button>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.deleteUserBtn').click(function(e) {
            e.preventDefault();

            var user_id = $(this).val();
            $('#delete_user').val(user_id)
            $('#deleteModel').modal('show');
        });

    });
</script>

<script>
    $('.viewUserBtn').click(function(e) {
        e.preventDefault();

        var employee_id = $(this).val();
        var employee_row = $(this).closest('tr');

        // Get employee data from the row
        var employee_data = {
            employee_id: employee_row.find('td:eq(0)').text().trim(),
            first_name: employee_row.find('td:eq(1)').text().trim(),
            last_name: employee_row.find('td:eq(2)').text().trim(),
            job_title: employee_row.find('td:eq(5)').text().trim(),
            department: employee_row.find('td:eq(6)').text().trim(),
            phone: employee_row.find('td:eq(3)').text().trim(),
            email: employee_row.find('td:eq(4)').text().trim(),
            birth_date: employee_row.find('td:eq(7)').text().trim(),
            image: employee_row.find('td:eq(8)').text().trim()

        };

        // Set image source in the modal
        $('#viewModel').find('#image').attr('src', "{{ asset('storage/images/') }}" + "/" + employee_data.image);


        // Set employee data as data attributes on the modal
        $('#viewModel').find('#employee_id').val(employee_data.employee_id);
        $('#viewModel').find('#firstname').val(employee_data.first_name);
        $('#viewModel').find('#lastname').val(employee_data.last_name);
        $('#viewModel').find('#job_title').val(employee_data.job_title);
        $('#viewModel').find('#department').val(employee_data.department);
        $('#viewModel').find('#phone').val(employee_data.phone);
        $('#viewModel').find('#email').val(employee_data.email);
        $('#viewModel').find('#birthday').val(employee_data.birth_date);

        // Show the modal
        $('#viewModel').modal('show');
    });
</script>
@endsection