@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Edit User</h5>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>

                    <div class="card-body">
                        <form id="editUserForm" method="POST" action="{{ route('users.update', $user->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                        value="{{ $user->name }}" required autofocus>
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>
                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control" name="username"
                                        value="{{ $user->username }}" required>
                                    <span class="text-danger error-text username_error"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email Address</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                        value="{{ $user->email }}" required>
                                    <span class="text-danger error-text email_error"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password">
                                    <small class="form-text text-muted">Leave blank to keep current password</small>
                                    <span class="text-danger error-text password_error"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm
                                    Password</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation">
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="avatar" class="col-md-4 col-form-label text-md-right">Avatar</label>
                                <div class="col-md-6">
                                    @if ($user->avatar)
                                        <img src="{{ asset('storage/avatars/' . $user->avatar) }}"
                                            class="img-thumbnail mb-2" width="100">
                                    @endif
                                    <input id="profile_image" type="file" class="form-control" name="profile_image">
                                    <span class="text-danger error-text profile_image_error"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="role_id" class="col-md-4 col-form-label text-md-right">Role</label>
                                <div class="col-md-6">
                                    <select id="role_id" class="form-control" name="role_id" required>
                                        <option value="">Select Role</option>
                                        <option value="1" {{ $user->role_id == 1 ? 'selected' : '' }}>Admin</option>
                                        <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>User</option>
                                    </select>
                                    <span class="text-danger error-text role_id_error"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="status" class="col-md-4 col-form-label text-md-right">Status</label>
                                <div class="col-md-6">
                                    <select id="status" class="form-control" name="status" required>
                                        <option value="">Select Status</option>
                                        <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    <span class="text-danger error-text status_error"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update User
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('#editUserForm').on('submit', function(e) {
                e.preventDefault();

                // សម្អាតសារកំហុសពីមុន
                $('.error-text').text('');

                var formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST', // ប្រើ POST ជាមួយ _method=PUT សម្រាប់ Laravel
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            alert(response.success);
                            window.location.href = "{{ route('users.index') }}";
                        }
                    },
                    error: function(error) {
                        if (error.responseJSON.errors) {
                            $.each(error.responseJSON.errors, function(key, value) {
                                $('.' + key + '_error').text(value[0]);
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush
