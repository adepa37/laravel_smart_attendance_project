<!-- Modal for Viewing Employee Details -->
<div class="modal fade" id="viewModel" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Employee Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <img id="image" src="" alt="Selected image" class="img-fluid rounded float-end" style="max-height: 180px;">
                    </div>
                    <div class="col-md-8">
                        <form>
                            <!-- Employee ID -->
                            <div class="mb-3">
                                <label for="employee_id" class="form-label">Employee ID</label>
                                <input type="text" id="employee_id" class="form-control" name="employee_id" value="" readonly>
                            </div>
                            <!-- First Name -->
                            <div class="mb-3">
                                <label for="firstname" class="form-label">First Name</label>
                                <input type="text" id="firstname" class="form-control" name="firstname" value="" required>
                            </div>
                            <!-- Last Name -->
                            <div class="mb-3">
                                <label for="lastname" class="form-label">Last Name</label>
                                <input type="text" id="lastname" class="form-control" name="lastname" value="" required>
                            </div>
                            <!-- Job Title -->
                            <div class="mb-3">
                                <label for="job_title" class="form-label">Job Title</label>
                                <input type="text" id="job_title" class="form-control" name="job_title" value="" required>
                            </div>
                            <!-- Department -->
                            <div class="mb-3">
                                <label for="department" class="form-label">Department</label>
                                <input type="text" id="department" class="form-control" name="department" value="" required>
                            </div>
                            <!-- Phone -->
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" id="phone" class="form-control" name="phone" value="" required>
                            </div>
                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" class="form-control" name="email" value="" required>
                            </div>
                            <!-- Birthday -->
                            <div class="mb-3">
                                <label for="birthday" class="form-label">Birthday</label>
                                <input type="date" id="birthday" class="form-control" name="birthday" value="" required>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- You can add a "Save Changes" button here if needed -->
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Lfnp7JATV4zl1jc+f8Fa0e0qcPaC6uMSkoz1J3Tk4gA5srdvJJyAuhG1aZbm0Ym9" crossorigin="anonymous"></script>
