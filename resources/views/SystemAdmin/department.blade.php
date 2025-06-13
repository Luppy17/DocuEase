@php
$page = 'department';
@endphp
@include('include.appsadmin')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">

<div class="az-content az-content-dashboard">
  <div class="container">
    <div class="az-content-body">
      <div class="clearfix mb-4">
        <h3 class="float-left">Department Management</h3>
        <button class="btn btn-primary float-right" id="createDeptBtn">Create Department</button>
      </div>

      <hr class="mg-y-30">

      <div class="table-responsive">
        <table class="table table-striped" id="departmentsTable">
          <thead>
            <tr>
              <th>ID</th>
              <th>Department Name</th>
              <th>Created At</th>
              <th>Last Updated</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($departments as $dept)
            <tr>
              <td>{{ $dept->dept_id }}</td>
              <td>{{ $dept->dept_name }}</td>
              <td>{{ $dept->created_at }}</td>
              <td>{{ $dept->updated_at }}</td>
              <td>
                <button class="btn btn-warning edit" data-id="{{ $dept->dept_id }}">Edit</button>
                <button class="btn btn-danger delete" data-id="{{ $dept->dept_id }}">Delete</button>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

<!-- Department Modal -->
<div class="modal fade" id="deptModal" tabindex="-1" role="dialog" aria-labelledby="deptModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deptModalLabel">Department Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="deptForm">
          @csrf
          <input type="hidden" id="dept_id" name="dept_id">
          <div class="form-group">
            <label for="dept_name">Department Name</label>
            <input type="text" class="form-control" id="dept_name" name="dept_name" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="submitDept">Save</button>
      </div>
    </div>
  </div>
</div>

@include('include.footer')
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function(){
  $('#departmentsTable').DataTable();

  function resetForm() {
    $('#deptForm')[0].reset();
    $('#dept_id').val('');
  }

  $('#createDeptBtn').click(function(){
    resetForm();
    $('#deptModalLabel').text('Create Department');
    $('#deptModal').modal('show');
  });

  $('#departmentsTable').on('click', '.edit', function(){
    resetForm();
    let id = $(this).data('id');
    $.get('/departments/' + id, function(data) {
      $('#deptModalLabel').text('Edit Department');
      $('#dept_id').val(data.dept_id);
      $('#dept_name').val(data.dept_name);
      $('#deptModal').modal('show');
    });
  });

  $('#submitDept').click(function(){
    let formData = $('#deptForm').serialize();
    let id = $('#dept_id').val();
    let url = id ? '/departments/update/' + id : '/departments/store';

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
        $('#deptModal').modal('hide');
        location.reload();
      },
      error: function(xhr) {
        Swal.fire('Error!', xhr.responseJSON.message || 'An error occurred.', 'error');
      }
    });
  });

  $('#departmentsTable').on('click', '.delete', function(){
    let id = $(this).data('id');
    Swal.fire({
      title: 'Are you sure?',
      text: "Department will be deleted permanently!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'Cancel',
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: '/departments/' + id,
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