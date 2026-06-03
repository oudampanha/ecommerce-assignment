@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>User Details</h5>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>

                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-4 text-center">
                                @if ($user->profile_image)
                                    <img src="{{ $user->profile_image_url }}" alt="User Avatar"
                                        class="img-thumbnail rounded-circle" width="100" height="100">
                                @else
                                    <img src="{{ asset('images/default-profile_image.png') }}"
                                        class="img-thumbnail rounded-circle" width="100" height="100">
                                @endif
                            </div>
                            <div class="col-md-8">
                                <h4>{{ $user->name }}</h4>
                                <p><strong>Username:</strong> {{ $user->username }}</p>
                                <p><strong>Email:</strong> {{ $user->email }}</p>
                                <p><strong>Role:</strong>
                                    @if ($user->role_id == 1)
                                        Admin
                                    @elseif($user->role_id == 2)
                                        User
                                    @else
                                        Unknown
                                    @endif
                                </p>
                                <p><strong>Status:</strong>
                                    @if ($user->status == 1)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" action="{{ route('users.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('#deleteForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            alert(response.success);
                            window.location.href = "{{ route('users.index') }}";
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        alert('An error occurred while deleting the user.');
                    }
                });
            });
        });
    </script>
@endpush
