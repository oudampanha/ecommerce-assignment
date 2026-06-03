@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Users Management</h5>
                        <a href="{{ route('users.create') }}" class="btn btn-primary">Add New User</a>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="users-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Avatar</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
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
@endsection

@push('scripts')
    <script>
        $(function() {
            const table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.data') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'profile_image',
                        name: 'profile_image',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
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
                        data: 'role',
                        name: 'role_id'
                    },
                    {
                        data: 'status_label',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                // Optional: Add loading state for images
                drawCallback: function() {
                    // Add loading spinner while images load
                    $('.user-avatar').on('load', function() {
                        $(this).removeClass('loading');
                    });
                }
            });

            let userId;

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
@endpush
