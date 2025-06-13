@php
$page = 'users';
@endphp
@include('include.appsadmin')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">


<div class="az-content az-content-dashboard">
  <div class="container">
    <div class="az-content-body">
      <div class="az-dashboard-one-title mb-4">
      </div>
      <div class="row">
        

      <div style="width:100%; overflow:hidden; margin-bottom: 20px;">
    <h3 style="float:left; margin:0;">Users Management</h3>
    <button class="btn btn-primary" id="createUserBtn" style="float:right;">Create User</button>
</div>
<div style="clear:both;"></div>




      <hr class="mg-y-30">

          <div class="table-responsive">
            <table class="table table-striped mg-b-0" id="usersTable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Department</th>
                  <th>Last Update</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $key => $user)
                <tr>
                  <th scope="row">{{ ++$key }}</th>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->role }}</td>
                  <td>{{ $user->department->dept_name }}</td>
                  <td>{{ $user->updated_at }}</td>
                  <td>
                    <button class="btn btn-warning edit" data-id="{{ $user->id }}">Edit</button>
                    <button class="btn btn-danger delete" data-id="{{ $user->id }}">Delete</button>
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

<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="userModalLabel">User Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="userForm">
          @csrf
          <input type="hidden" id="user_id" name="user_id">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="form-group" id="passwordGroup">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>
          <div class="form-group">
            <label for="role">Role</label>
            <select class="form-control" id="role" name="role" required>
              <option value="Staff">Staff</option>
              <option value="File Admin">File Admin</option>
              <option value="Manager">Manager</option>
            </select>
          </div>
          <div class="form-group">
            <label for="dept_id">Department</label>
            <select class="form-control" id="dept_id" name="dept_id" required>
              @foreach($departments as $dept)
                <option value="{{ $dept->dept_id }}">{{ $dept->dept_name }}</option>
              @endforeach
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="submitUser">Save</button>
      </div>
    </div>
  </div>
</div>


@include('include.footer')
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>


<script>
$('#usersTable').DataTable(); // Initialize DataTable

$(document).ready(function(){
  function resetForm() {
    $('#userForm')[0].reset();
    $('#user_id').val('');
    $('#passwordGroup').show();
  }

  $('#createUserBtn').click(function(){
    resetForm();
    $('#userModalLabel').text('Create User');
    $('#userModal').modal('show');
  });

  $('.edit, .view').click(function(){
    resetForm();
    let id = $(this).data('id');
    let action = $(this).hasClass('view') ? 'View' : 'Edit';

    $.get('/users/' + id, function(data) {
      $('#userModalLabel').text(action + ' User');
      $('#user_id').val(data.id);
      $('#name').val(data.name);
      $('#email').val(data.email);
      $('#role').val(data.role);
      $('#dept_id').val(data.dept_id);
      $('#passwordGroup').toggle(action === 'Edit');
      $('#submitUser').toggle(action !== 'View');
      $('#userModal').modal('show');
    });
  });

  $('#submitUser').click(function(){
    let formData = $('#userForm').serialize();
    let id = $('#user_id').val();
    let url = id ? '/users/update/' + id : '{{ route("users.store") }}';

    Swal.fire({
      title: 'Processing...',
      allowOutsideClick: false,
      didOpen: () => Swal.showLoading()
    });

    $.ajax({
      url: url,
      method: id ? 'PUT' : 'POST',
      data: formData,
      success: function(response) {
        Swal.fire('Success!', response.message, 'success');
        $('#userModal').modal('hide');
        location.reload();
      },
      error: function(xhr) {
        Swal.fire('Error!', xhr.responseJSON.message || 'An error occurred.', 'error');
      }
    });
  });

  // Edit Button Click
$('.edit').click(function(){
  resetForm();
  let id = $(this).data('id');

  $.get('/users/' + id, function(data) {
    $('#userModalLabel').text('Edit User');
    $('#user_id').val(data.id);
    $('#name').val(data.name);
    $('#email').val(data.email);
    $('#role').val(data.role);
    $('#dept_id').val(data.dept_id);
    $('#passwordGroup').hide();
    $('#submitUser').show();
    $('#userModal').modal('show');
  });
});

// Delete Button Click
$('.delete').click(function(){
  let id = $(this).data('id');
  Swal.fire({
    title: 'Are you sure?',
    text: "User will be deleted permanently!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete it!',
    cancelButtonText: 'Cancel',
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire({ title: 'Deleting...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
      
      $.ajax({
        url: '/users/' + id,
        method: 'DELETE',
        data: {_token: '{{ csrf_token() }}'},
        success: function(response) {
          Swal.fire('Deleted!', response.message, 'success');
          location.reload();
        },
        error: function(xhr) {
          Swal.fire('Error!', xhr.responseJSON.message || 'An error occurred.', 'error');
        }
      });
    }
  });
});

});
</script>