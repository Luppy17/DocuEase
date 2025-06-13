@php
$page = 'my-account';
@endphp
@include('include.appstaff')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    body {
        background-color: #f8f9fa;
    }
    .az-content-body {
        padding-top: 20px;
    }
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 30px; 
    }
    .card-header {
        background-color: #4e73df;
        color: white;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        font-weight: 600;
        padding: 15px 20px;
        font-size: 1.15rem; 
    }
    .card-header.bg-danger {
        background-color: #e74a3b !important; 
    }
    .form-group label {
        font-weight: 500;
        color: #5a5c69;
        margin-bottom: 0.5rem;
    }
    .form-control:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }
    .btn-primary {
        background-color: #4e73df;
        border-color: #4e73df;
        transition: background-color 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .btn-primary:hover {
        background-color: #2e59d9;
        border-color: #264aab;
    }
    .btn-danger {
        background-color: #e74a3b;
        border-color: #e74a3b;
        transition: background-color 0.2s ease, border-color 0.2s ease;
    }
    .btn-danger:hover {
        background-color: #cc0000;
        border-color: #ac0000;
    }
    .alert-danger ul {
        margin-bottom: 0;
        padding-left: 20px;
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

        // Sidebar active state logic (copy-pasted from your existing code)
        const profileDropdownToggle = document.getElementById('profileDropdownToggle');
        const profileDropdownMenu = document.getElementById('profileDropdownMenu');
        const closeDropdownBtn = document.getElementById('closeDropdownBtn');

        if (profileDropdownToggle && profileDropdownMenu) {
            profileDropdownToggle.addEventListener('click', function(e) {
                e.preventDefault();
                profileDropdownMenu.classList.toggle('show');
            });

            if (closeDropdownBtn) {
                closeDropdownBtn.addEventListener('click', function() {
                    profileDropdownMenu.classList.remove('show');
                });
            }

            document.addEventListener('click', function(e) {
                if (!profileDropdownToggle.contains(e.target) && !profileDropdownMenu.contains(e.target)) {
                    profileDropdownMenu.classList.remove('show');
                }
            });

            profileDropdownMenu.querySelectorAll('.action-item, .manage-account-btn, .footer-link').forEach(item => {
                item.addEventListener('click', function() {
                    profileDropdownMenu.classList.remove('show');
                });
            });
        }

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
    });
</script>