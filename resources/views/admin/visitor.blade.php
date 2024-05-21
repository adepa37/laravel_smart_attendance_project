@extends('layouts.master')


@section('title')
Employees | Staff Atendance
@endsection


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

                <h2 class="card-title">Visitors Table </h2>
                <!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Add</button>-->

                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <a href="/addEmployees" class="btn btn-primary float-right">Add</a><br>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display">
                        <thead class=" text-primary">
                            <th>Visitor ID</th>
                            <th>Fist Name</th>
                            <th>Last Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Reason For Visite</th>
                            <th>EDIT</th>
                            <th>DELETE</th>
                        </thead>
                        <tbody>

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
</script>

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

@endsection
