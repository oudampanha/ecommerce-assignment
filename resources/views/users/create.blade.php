@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Create New User</h5>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to List</a>
                    </div>

                    <div class="card-body">
                        <form id="createUserForm" method="POST" action="{{ route('users.store') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" required
                                        autofocus>
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>
                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control" name="username" required>
                                    <span class="text-danger error-text username_error"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email Address</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" required>
                                    <span class="text-danger error-text email_error"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    <span class="text-danger error-text password_error"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm
                                    Password</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="profile_image" class="col-md-4 col-form-label text-md-right">Avatar</label>
                                <div class="col-md-6">
                                    <input id="profile_image" type="file" class="form-control" name="profile_image"
                                        accept="image/*">
                                    <span class="text-danger error-text profile_image_error"></span>
                                    <div class="mt-2">
                                        <img id="imagePreview" src="#" alt="Image Preview"
                                            style="max-width: 100px; max-height: 100px; display: none;"
                                            class="rounded-circle">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="role_id" class="col-md-4 col-form-label text-md-right">Role</label>
                                <div class="col-md-6">
                                    <select id="role_id" class="form-control" name="role_id" required>
                                        <option value="">Select Role</option>
                                        <option value="1">Admin</option>
                                        <option value="2">User</option>
                                    </select>
                                    <span class="text-danger error-text role_id_error"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="status" class="col-md-4 col-form-label text-md-right">Status</label>
                                <div class="col-md-6">
                                    <select id="status" class="form-control" name="status" required>
                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    <span class="text-danger error-text status_error"></span>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" id="submitBtn">
                                        <span class="btn-text">Create User</span>
                                        <span class="btn-loading d-none">
                                            <span class="spinner-border spinner-border-sm" role="status"
                                                aria-hidden="true"></span>
                                            Creating...
                                        </span>
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

@push('styles')
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush

@push('scripts')
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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

        $(function() {
            // Image preview functionality
            $('#profile_image').on('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview').attr('src', e.target.result).show();
                    };
                    reader.readAsDataURL(file);
                } else {
                    $('#imagePreview').hide();
                }
            });

            // Form submission
            $('#createUserForm').on('submit', function(e) {
                e.preventDefault();

                // Clear previous errors
                $('.error-text').text('');
                $('.form-control').removeClass('is-invalid');

                // Show loading state
                const submitBtn = $('#submitBtn');
                submitBtn.prop('disabled', true);
                submitBtn.find('.btn-text').addClass('d-none');
                submitBtn.find('.btn-loading').removeClass('d-none');

                var formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log('Success response:', response); // Debug log

                        if (response.success) {
                            // Show success toast
                            toastr.success(response.success || 'User created successfully!',
                                'Success');

                            // Redirect after a short delay to allow toast to show
                            setTimeout(function() {
                                window.location.href = "{{ route('users.index') }}";
                            }, 1500);
                        } else {
                            // Fallback success message
                            toastr.success('User created successfully!', 'Success');
                            setTimeout(function() {
                                window.location.href = "{{ route('users.index') }}";
                            }, 1500);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('Error response:', xhr.responseJSON); // Debug log

                        // Reset button state
                        submitBtn.prop('disabled', false);
                        submitBtn.find('.btn-text').removeClass('d-none');
                        submitBtn.find('.btn-loading').addClass('d-none');

                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            // Show validation errors
                            $.each(xhr.responseJSON.errors, function(key, value) {
                                $('.' + key + '_error').text(value[0]);
                                $('input[name="' + key + '"], select[name="' + key +
                                    '"]').addClass('is-invalid');
                            });

                            toastr.error('Please fix the validation errors.',
                                'Validation Error');
                        } else {
                            // Show general error
                            let errorMessage = 'An error occurred while creating the user.';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            }
                            toastr.error(errorMessage, 'Error');
                        }
                    }
                });
            });

            // Clear validation errors when user starts typing
            $('input, select').on('input change', function() {
                $(this).removeClass('is-invalid');
                const fieldName = $(this).attr('name');
                $('.' + fieldName + '_error').text('');
            });
        });
    </script>
@endpush
