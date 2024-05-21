@extends('layouts.master')


@section('title')
Register Roles | Staff Atendance
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


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">User Register Table</h2>
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display">
                        <thead class=" text-primary">
                            <th>ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>User Type</th>
                            <th>EDIT</th>
                            <th>DELETE</th>
                        </thead>
                        <tbody>
                            @foreach($users as $row)
                            <tr>
                                <td>{{ $row->id}}</td>
                                <td>{{ $row->name}}</td>
                                <td>{{ $row->phone}}</td>
                                <td>{{ $row->email}}</td>
                                <td>{{ $row->usertype}}</td>
                                <td>
                                    <a href="/role-edit/{{ $row->id }}" class="btn btn-success">EDIT</a>
                                </td>
                                <td>

                                    <button type="button" class="btn btn-danger deleteUserBtn" value="{{ $row->id }}">DELETE</button>

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

<script>
    $(document).ready(function() {
        // Show delete modal when delete button is clicked
        $('.deleteUserBtn').click(function(e) {
            e.preventDefault();

            var user_id = $(this).val();
            $('#delete_user').val(user_id);
            $('#deleteModel').modal('show');
        });

        // Initialize DataTable
        $('#example').DataTable({
            "pagingType": "full_numbers"
        });
    });
</script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->

@endsection
