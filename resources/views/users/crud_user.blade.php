<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel 12 CRUD with Ajax and DataTables</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/datatables.net-bs4@1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" {{-- href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css"> --}} <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css"
        integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    @stack('styles')
</head>

<body>
    <div class="container-fluid mt-5">
        <h2>Laravel 12 User CRUD with Ajax and DataTables</h2>
        <div class="d-flex justify-content-end mb-3">
            <a href="javascript:void(0)" class="btn btn-info" id="create-new-user">Add New User</a>
        </div>
        <table class="table table-bordered table-striped" id="users-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Profile Image</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <!-- Modal for Create/Update -->
    <div class="modal fade" id="user-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="userModalTitle"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="userForm" class="form-horizontal" enctype="multipart/form-data">
                        <input type="hidden" name="user_id" id="user_id">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter Name" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Enter Username" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter Email" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                placeholder="Enter Phone">
                        </div>
                        <div class="form-group mb-3">
                            <label for="profile_image" class="form-label">Profile Image</label>
                            <input type="file" class="form-control" id="profile_image" name="profile_image"
                                accept="image/*">
                            <img id="image_preview" class="mt-2" style="max-width: 100px; display: none;"
                                alt="Profile Image">
                        </div>
                        <div class="form-group mb-3">
                            <label for="role_id" class="form-label">Role</label>
                            <select class="form-control" id="role_id" name="role_id" required>
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="suspended">Suspended</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" id="btn-save">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net@1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net-bs4@1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @stack('scripts')
    <script>
        // Configure Toastr options
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    </script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'profile_image',
                        name: 'profile_image',
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // Image preview
            $('#profile_image').change(function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image_preview').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(this.files[0]);
            });

            // Open modal for creating new user
            $('#create-new-user').click(function() {
                $('#userModalTitle').text('Add New User');
                $('#userForm').trigger('reset');
                $('#user_id').val('');
                $('#image_preview').hide();
                $('#user-modal').modal('show');
            });

            // Save or update user
            $('#userForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                var userId = $('#user_id').val();
                var url = userId ? '{{ url('users') }}/' + userId : '{{ route('users.store') }}';
                var type = userId ? 'POST' : 'POST'; // Use POST for multipart form
                if (userId) formData.append('_method', 'PUT');

                $.ajax({
                    url: url,
                    type: type,
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.error) {
                            alert(response.error.join('\n'));
                        } else {
                            $('#user-modal').modal('hide');
                            table.ajax.reload();
                            alert(response.success);
                        }
                    },
                    error: function(xhr) {
                        alert('Error: ' + xhr.responseJSON.message);
                    }
                });
            });

            // Edit user
            $('body').on('click', '.edit', function() {
                var id = $(this).data('id');
                $.get('{{ url('users') }}/' + id, function(data) {
                    $('#userModalTitle').text('Edit User');
                    $('#user_id').val(data.id);
                    $('#name').val(data.name);
                    $('#username').val(data.username);
                    $('#email').val(data.email);
                    $('#phone').val(data.phone);
                    $('#role_id').val(data.role_id);
                    $('#status').val(data.status);
                    if (data.profile_image) {
                        $('#image_preview').attr('src', '/storage/images/' + data.profile_image)
                            .show();
                    } else {
                        $('#image_preview').hide();
                    }
                    $('#user-modal').modal('show');
                });
            });

            // Delete user
            // $('body').on('click', '.delete-user', function() {
            //     if (confirm('Are you sure you want to delete this user?')) {
            //         var id = $(this).data('id');
            //         $.ajax({
            //             url: '{{ url('users') }}/' + id,
            //             type: 'DELETE',
            //             success: function(response) {
            //                 table.ajax.reload();
            //                 alert(response.success);
            //             },
            //             error: function(xhr) {
            //                 alert('Error: ' + xhr.responseJSON.message);
            //             }
            //         });
            //     }
            // });
            // Handle delete button click
            $('#users-table').on('click', '.delete-user', function() {
                userId = $(this).data('id');
                $('#deleteModal').modal('show');
            });

            // Handle delete confirmation
            $('#confirmDelete').click(function() {
                // Show loading state
                $(this).prop('disabled', true).html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Deleting...'
                );

                $.ajax({
                    url: `/users/${userId}`,
                    type: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#deleteModal').modal('hide');
                        table.ajax.reload();

                        // Show success toast
                        toastr.success(response.success || 'User deleted successfully!',
                            'Success');
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseJSON);

                        // Show error toast
                        let errorMessage = 'An error occurred while deleting the user.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        } else if (xhr.responseJSON && xhr.responseJSON.error) {
                            errorMessage = xhr.responseJSON.error;
                        }
                        toastr.error(errorMessage, 'Error');
                    },
                    complete: function() {
                        // Reset button state
                        $('#confirmDelete').prop('disabled', false).html('Delete');
                    }
                });
            });

            // Reset modal state when closed
            $('#deleteModal').on('hidden.bs.modal', function() {
                $('#confirmDelete').prop('disabled', false).html('Delete');
            });
        });
    </script>
</body>

</html>
