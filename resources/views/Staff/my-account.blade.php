@php
$page = 'my-account';
@endphp
@if(auth()->user()->role == 'Staff')
    @include('include.appstaff')
@elseif(auth()->user()->role == 'Manager')
    @include('include.appmanager')
@elseif(auth()->user()->role == 'File Admin')
    @include('include.appfadmin')
@endif
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    :root {
        --primary-color: #4361ee;
        --primary-hover: #3a56d4;
        --primary-light: #eef2ff;
        --danger-color: #ef476f;
        --danger-hover: #d63d62;
        --danger-light: #fff5f5;
        --success-color: #10b981;
        --success-light: #ecfdf5;
        --text-primary: #1e293b;
        --text-secondary: #475569;
        --text-muted: #94a3b8;
        --bg-light: #f8fafc;
        --bg-white: #ffffff;
        --border-radius: 16px;
        --border-radius-sm: 8px;
        --box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --box-shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    body {
        background-color: var(--bg-light);
        color: var(--text-primary);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        line-height: 1.6;
    }

    .az-content-body {
        padding: 2.5rem 0;
    }

    .az-dashboard-one-title {
        margin-bottom: 2.5rem;
        position: relative;
    }

    .az-content-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.75rem;
        letter-spacing: -0.025em;
    }

    .az-content-text {
        font-size: 1.25rem;
        color: var(--text-secondary);
        font-weight: 500;
        margin-bottom: 2rem;
    }

    .card {
        border: none;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        margin-bottom: 2rem;
        transition: var(--transition);
        background: var(--bg-white);
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-4px);
        box-shadow: var(--box-shadow-lg);
    }

    .card-header {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
        color: white;
        border-top-left-radius: var(--border-radius);
        border-top-right-radius: var(--border-radius);
        font-weight: 600;
        padding: 1.5rem;
        font-size: 1.1rem;
        border: none;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .card-header i {
        font-size: 1.25rem;
        opacity: 0.9;
    }

    .card-header.bg-danger {
        background: linear-gradient(135deg, var(--danger-color), var(--danger-hover));
    }

    .card-body {
        padding: 2rem;
    }

    .form-group {
        margin-bottom: 1.75rem;
    }

    .form-group label {
        font-weight: 500;
        color: var(--text-secondary);
        margin-bottom: 0.75rem;
        font-size: 0.95rem;
        display: block;
    }

    .form-control {
        border: 2px solid #e2e8f0;
        border-radius: var(--border-radius-sm);
        padding: 0.875rem 1.25rem;
        font-size: 0.95rem;
        transition: var(--transition);
        background-color: var(--bg-white);
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px var(--primary-light);
        outline: none;
    }

    .form-control:read-only {
        background-color: var(--bg-light);
        cursor: not-allowed;
    }

    .btn {
        padding: 0.875rem 1.75rem;
        font-weight: 600;
        border-radius: var(--border-radius-sm);
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        letter-spacing: 0.025em;
    }

    .btn i {
        font-size: 1.1rem;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
        border: none;
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(67, 97, 238, 0.25);
    }

    .btn-danger {
        background: linear-gradient(135deg, var(--danger-color), var(--danger-hover));
        border: none;
        color: white;
    }

    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 71, 111, 0.25);
    }

    .profile-photo-container {
        position: relative;
        margin-bottom: 2.5rem;
        display: flex;
        justify-content: center;
    }

    .profile-photo {
        width: 180px;
        height: 180px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid white;
        box-shadow: var(--box-shadow-lg);
        transition: var(--transition);
    }

    .profile-photo:hover {
        transform: scale(1.02);
    }

    .photo-upload-btn {
        position: absolute;
        bottom: 0;
        right: calc(50% - 90px);
        background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
        color: white;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition);
        box-shadow: var(--box-shadow);
    }

    .photo-upload-btn:hover {
        transform: scale(1.1) rotate(5deg);
        box-shadow: var(--box-shadow-lg);
    }

    .danger-zone {
        background-color: var(--danger-light);
        border-radius: var(--border-radius);
        padding: 2rem;
        border: 1px solid rgba(239, 71, 111, 0.2);
    }

    .danger-zone p {
        color: var(--danger-color);
        margin-bottom: 1.75rem;
        font-size: 0.95rem;
        line-height: 1.7;
    }

    .alert-danger {
        background-color: var(--danger-light);
        border: 1px solid rgba(239, 71, 111, 0.2);
        color: var(--danger-color);
        border-radius: var(--border-radius-sm);
        padding: 1.25rem;
        margin-bottom: 1.5rem;
    }

    .alert-danger ul {
        margin-bottom: 0;
        padding-left: 1.5rem;
    }

    /* Custom Select Styling */
    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23475569' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 1rem;
        padding-right: 2.5rem;
    }

    /* Success Message Styling */
    .alert-success {
        background-color: var(--success-light);
        border: 1px solid rgba(16, 185, 129, 0.2);
        color: var(--success-color);
        border-radius: var(--border-radius-sm);
        padding: 1.25rem;
        margin-bottom: 1.5rem;
    }

    @media (max-width: 768px) {
        .az-content-body {
            padding: 1.5rem 0;
        }

        .card {
            margin-bottom: 1.5rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        .az-content-title {
            font-size: 1.75rem;
        }

        .profile-photo {
            width: 150px;
            height: 150px;
        }

        .photo-upload-btn {
            width: 40px;
            height: 40px;
            right: calc(50% - 75px);
        }
    }

    /* Animation for form elements */
    .form-control, .btn, .card {
        animation: fadeInUp 0.5s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="az-content-wrapper">
    <div class="az-content az-content-dashboard">
        <div class="container">
            <div class="az-content-body">
                <div class="az-dashboard-one-title mb-4">
                    <h2 class="az-content-title">Hi {{ $user->name ?? 'User' }}, Manage Your Account!</h2>
                </div>

                <div class="mb-4">
                    <h3 class="az-content-text">Account Settings</h3>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-10">


                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-user-circle mr-2"></i> Profile Information
                            </div>
                            <div class="card-body">
                                <div class="text-center mb-4">
                                    <div class="position-relative d-inline-block">
                                        <img src="{{ $user->profile_photo_url }}" alt="Profile Photo" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                                        <label for="profile_photo" class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-2" style="cursor: pointer;">
                                            <i class="fas fa-camera"></i>
                                        </label>
                                        <input type="file" id="profile_photo" name="profile_photo" class="d-none" accept="image/*">
                                    </div>
                                </div>
                                <form id="profileUpdateForm">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name ?? '' }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email ?? '' }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <input type="text" class="form-control" id="role" value="{{ $user->role ?? '' }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="department">Department</label>
                                        @if($user->role === 'Staff' || $user->role === 'Manager') {{-- Example: Only Staff/Manager can update department --}}
                                        <select class="form-control" id="dept_id" name="dept_id">
                                            <option value="">Select Department</option>
                                            @foreach($departments as $dept)
                                                <option value="{{ $dept->dept_id }}" {{ ($user->dept_id == $dept->dept_id) ? 'selected' : '' }}>
                                                    {{ $dept->dept_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @else
                                        <input type="text" class="form-control" id="department" value="{{ $user->department->dept_name ?? 'N/A' }}" readonly>
                                        <input type="hidden" name="dept_id" value="{{ $user->dept_id ?? '' }}">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="created_at">Member Since</label>
                                        <input type="text" class="form-control" id="created_at" value="{{ $user->created_at->format('d M Y h:i A') ?? 'N/A' }}" readonly>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-save mr-2"></i> Update Profile</button>
                                </form>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-lock mr-2"></i> Update Password
                            </div>
                            <div class="card-body">
                                <form id="passwordUpdateForm">
                                    @csrf
                                    <div class="form-group">
                                        <label for="current_password">Current Password</label>
                                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password">New Password</label>
                                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password_confirmation">Confirm New Password</label>
                                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-key mr-2"></i> Change Password</button>
                                </form>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-header bg-danger">
                                <i class="fas fa-exclamation-triangle mr-2"></i> Danger Zone
                            </div>
                            <div class="card-body">
                                <p class="card-text text-danger">
                                    Deleting your account is a permanent action. All your data, including documents you've uploaded, will be permanently removed. This action cannot be undone.
                                </p>
                                <button id="deleteAccountBtn" class="btn btn-danger"><i class="fas fa-trash-alt mr-2"></i> Delete My Account</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@include('include.footer')

{{-- Standard scripts are usually defined in app.blade.php or similar parent.
     Including them here for completeness if this is a standalone file. --}}
<script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{ asset('lib/ionicons/ionicons.js') }}"></script>
<script src="{{ asset('lib/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('lib/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('lib/morris.js/morris.min.js') }}"></script>
<script src="{{ asset('lib/chart.js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('js/chart.morris.js') }}"></script>
<script src="{{ asset('js/chart.chartjs.js') }}"></script>


<script>
    $(function(){
        'use strict';

        // Remove the duplicate dropdown code and keep only the menu-related code
        $('#azMenuShow').on('click', function(e){
            e.preventDefault();
            $('body').addClass('az-menu-show');
        });

        $('#azMenuHide').on('click', function(e){
            e.preventDefault();
            $('body').removeClass('az-menu-show');
        });

        $('.az-header-menu .nav-link').on('click', function(e){
            var subMenu = $(this).parent().find('.az-menu-sub');
            if(subMenu.length) {
                e.preventDefault();
                subMenu.toggleClass('show');
            }
        });

        const currentPage = '{{ $page ?? "" }}';
        $('.az-sidebar-nav .nav-link').removeClass('active');
        if (currentPage === 'dashboard') {
            $('.az-sidebar-nav .nav-link[href="/"]').addClass('active');
        } else if (currentPage) {
            $(`.az-sidebar-nav .nav-link[href$="/${currentPage}"]`).addClass('active');
        }

        // --- Profile Update Logic ---
        $('#profileUpdateForm').submit(function(e) {
            e.preventDefault(); // Prevent default form submission
            const formData = $(this).serialize(); // Serialize form data

            Swal.fire({
                title: 'Updating Profile...',
                didOpen: () => Swal.showLoading(),
                allowOutsideClick: false
            });

            $.ajax({
                url: '{{ route('update-my-profile') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    Swal.fire('Success!', response.message, 'success').then(() => {
                        // Optionally reload the page or update fields dynamically
                        location.reload();
                    });
                },
                error: function(xhr) {
                    let errorMessage = 'An error occurred during profile update.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    // Display validation errors if available
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let errors = '';
                        for (const key in xhr.responseJSON.errors) {
                            errors += `<li>${xhr.responseJSON.errors[key][0]}</li>`;
                        }
                        errorMessage = `<ul>${errors}</ul>`;
                    }
                    Swal.fire('Error!', errorMessage, 'error');
                }
            });
        });

        // --- Password Update Logic ---
        $('#passwordUpdateForm').submit(function(e) {
            e.preventDefault(); // Prevent default form submission
            const formData = $(this).serialize(); // Serialize form data

            Swal.fire({
                title: 'Changing Password...',
                didOpen: () => Swal.showLoading(),
                allowOutsideClick: false
            });

            $.ajax({
                url: '{{ route('update-my-password') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    Swal.fire('Success!', response.message, 'success').then(() => {
                        $('#passwordUpdateForm')[0].reset(); // Clear form fields
                    });
                },
                error: function(xhr) {
                    let errorMessage = 'An error occurred during password change.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    // Display validation errors if available
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let errors = '';
                        for (const key in xhr.responseJSON.errors) {
                            errors += `<li>${xhr.responseJSON.errors[key][0]}</li>`;
                        }
                        errorMessage = `<ul>${errors}</ul>`;
                    }
                    Swal.fire('Error!', errorMessage, 'error');
                }
            });
        });


        // --- Account Deletion Logic ---
        $('#deleteAccountBtn').click(function() {
            Swal.fire({
                title: 'Are you absolutely sure?',
                text: "This action cannot be undone. All your data will be permanently deleted.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete my account!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Deleting Account...',
                        didOpen: () => {
                            Swal.showLoading();
                            // Send AJAX request to delete account
                            $.ajax({
                                url: '{{ route('delete-my-account') }}', // Use named route for robustness
                                type: 'DELETE',
                                data: {
                                    _token: '{{ csrf_token() }}' // Laravel CSRF token
                                },
                                success: function(response) {
                                    Swal.fire(
                                        'Deleted!',
                                        'Your account has been successfully deleted.',
                                        'success'
                                    ).then(() => {
                                        window.location.href = '/login'; // Redirect to login page
                                    });
                                },
                                error: function(xhr) {
                                    let errorMessage = 'An error occurred during deletion.';
                                    if (xhr.responseJSON && xhr.responseJSON.message) {
                                        errorMessage = xhr.responseJSON.message;
                                    }
                                    Swal.fire(
                                        'Error!',
                                        errorMessage,
                                        'error'
                                    );
                                }
                            });
                        },
                        allowOutsideClick: false
                    });
                }
            });
        });

        // Profile photo upload
        $('#profile_photo').change(function() {
            const file = this.files[0];
            if (file) {
                const formData = new FormData();
                formData.append('profile_photo', file);
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    url: '{{ route("profile.photo.update") }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status === 'success') {
                            // Update all profile photos on the page
                            $('.user-main-avatar, .az-img-user img').attr('src', response.photo_url);
                            Swal.fire('Success!', response.message, 'success');
                            location.reload();
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Error!', xhr.responseJSON.message || 'An error occurred while uploading the photo.', 'error');
                    }
                });
            }
        });
    });
</script>
