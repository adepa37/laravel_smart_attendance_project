@extends('layouts.master')


@section('title')
Employees | Staff Atendance
@endsection


@section('content')
<div class="modal fade" id="deleteModel" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('/role-delete') }}" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }} <!-- Use 'DELETE' method for RESTful deletion -->

                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="delete_user" id="delete_user">
                    <p>Are you sure you want to delete this user?</p>
                    <!-- <p><strong>User ID:</strong> <span id="user_id_placeholder"></span></p> -->
                    <!-- Additional user details can be displayed here -->
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal for Viewing Employee Details -->
<!-- Include the modal partial -->
@include('admin.employeesdetails')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">

                <h2 class="card-title">Employees Table </h2>
                <!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Add</button>-->

                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

            </div>
            <div class="card-body">
                <form action="{{ route('employeesearch.search') }}" method="GET" class="float-right">

                    <div class="input-group mb-3 ">
                        <!--<input type="text" name="search" placeholder="Search by name or ID" class="form-control">-->
                        <!-- <div class="input-group-append">
                            <button type="submit" class="btn btn-line-secondary float-right"><i class="fas fa-search"></i>Search for Employee</button>
                        </div> -->

                        <a href="/addEmployees" class="btn btn-primary ">Add</a><br>
                    </div>
                </form>
                <div class="table-responsive">
                    <table id="example" class="display">
                        <thead class=" text-primary">
                            <th>Employee ID</th>
                            <th>Fist Name</th>
                            <th>Last Name</th>
                            <th>Phone</th>
                            <th >Email</th>
                            <th >Job Title</th>
                            <th >DEPARTMENT</th>
                            <th >BIRTHBAY</th>
                            <th >Image</th>
                            <th>VIEW</th>
                            <th>EDIT</th>
                            <th>DELETE</th>

                        </thead>
                        <tbody>
                            @foreach($employee as $row)
                            <tr>
                                <td>{{ $row->employee_id}}</td>
                                <td>{{ $row->first_name}}</td>
                                <td>{{ $row->last_name}}</td>
                                <td>{{ $row->phone}}</td>
                                <td >{{ $row->email}}</td>
                                <td >{{ $row->job_title}}</td>
                                <td >{{ $row->department}}</td>
                                <td >{{ $row->birth_date}}</td>
                                <td >{{ $row->image}}</td>
                                <td>
                                    <!-- Button to trigger the modal -->
                                    <button type="button" class="btn viewUserBtn" data-bs-toggle="modal" data-bs-target="#viewModel" value="{{ $row->id }}" style="background-color: blue;">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                </td>
                                <td>
                                    <a href="/employee-edit/{{ $row->id }}" class="btn btn-success">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </td>
                                <td>

                                    <button type="button" class="btn btn-danger deleteUserBtn" value="{{ $row->id }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')

<!-- <script>
    const exampleModal = document.getElementById('exampleModal1')
    if (exampleModal) {
        exampleModal.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget
            // Extract info from data-bs-* attributes
            const recipient = button.getAttribute('data-bs-whatever')
            // If necessary, you could initiate an Ajax request here
            // and then do the updating in a callback.

            // Update the modal's content.
            const modalTitle = exampleModal.querySelector('.modal-title')
            const modalBodyInput = exampleModal.querySelector('.modal-body input')

            modalTitle.textContent = `New message to ${recipient}`
            modalBodyInput.value = recipient
        })
    }
</script> -->

<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "pagingType": "full_numbers",

        });
    });
</script>

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

<!-- <script>
    $(document).ready(function() {
        $('.viewUserBtn').click(function(e) {
            e.preventDefault();

            var user_id = $(this).val();
            $('#delete_user').val(user_id)
            $('#viewModel').modal('show');
        });

    });
</script> -->

<!-- JavaScript to show the modal when "View" button is clicked -->
<!-- <script>
    $(document).ready(function() {
        $('.viewUserBtn').click(function(e) {
            e.preventDefault();
            $('#viewModel').modal('show');
        });
    });
</script> -->

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
        // $('#viewModel').attr('src', "{{ asset('storage/images/') }}" + "/" + image);

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
        //$('#viewModel').find('#image').val(employee_data.image);

        // Show the modal
        $('#viewModel').modal('show');
    });
</script>


@endsection
