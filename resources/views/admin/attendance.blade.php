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


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Recipient:</label>
                        <input type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send message</button>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">

                <h2 class="card-title">Attendance List </h2>
                <!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Add</button>-->

                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <!-- <a href="/addEmployees" class="btn btn-primary float-right">Add</a><br> -->
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display">
                        <thead class=" text-primary">
                            <th>Employee ID</th>
                            <th>Date</th>
                            <th>Check In</th>
                            <th>Check In Time</th>
                            <th>Check Out</th>
                            <th>Check Out Time</th>
                            <th>Hours Worked</th>
                            <th>Late</th>
                            <th>On Leave</th>
                        </thead>
                        <tbody>

                            @foreach($attendance as $row)

                            @php
                            // Convert check-in and check-out times to DateTime objects
                            $checkInTime = new DateTime($row->check_in_time);
                            $checkOutTime = new DateTime($row->check_out_time);

                            // Calculate the difference between check-out and check-in times
                            $hoursWorked = $checkOutTime->diff($checkInTime)->format('%h:%I:%S');
                            @endphp

                            <tr>
                                <td>{{ $row->employee_id}}</td>
                                <td>{{ $row->date}}</td>
                                <td>{{ $row->check_in}}</td>
                                <td>{{ $row->check_in_time}}</td>
                                <td>{{ $row->check_out}}</td>
                                <td>{{ $row->check_out_time}}</td>
                                <td>{{ $hoursWorked }}</td>
                                <td>{{ $row->late}}</td>
                                <td>{{ $row->on_leave}}</td>
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
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "pagingType": "full_numbers",

        });
    });
</script>
<!-- <script>
    const exampleModal = document.getElementById('exampleModal')
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
</script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>

@endsection
