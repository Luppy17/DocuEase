@php
$page = 'docviewapproval';
@endphp
@include('include.appfadmin')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<div class="az-content az-content-dashboard">
  <div class="container">
    <div class="az-content-body">
      <div class="az-dashboard-one-title mb-4">
      </div>
      <div class="row">
        

      <div style="width:100%; overflow:hidden; margin-bottom: 20px;">
    <h3 style="float:left; margin:0;">Document Viewing Approval</h3>
</div>
<div style="clear:both;"></div>




      <hr class="mg-y-30">

          <div class="table-responsive">
            <table class="table table-striped mg-b-0" id="usersTable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Filename</th>
                  <th>Requsted By</th>
                  <th>Requsted Dept</th>
                  <th>Requested At</th>
                  <th>File Owner</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($pendingApprovalViewDocument as $key => $doc)
                <tr>
                  <th scope="row">{{ ++$key }}</th>
                  <td>{{ $doc->document->document_title }}</td>
                  <td>{{ $doc->requester->name }}</td>
                  <td>{{ $doc->requester->department->dept_name }}</td>
                  <td>{{ $doc->created_at }}</td>
                  <td>{{ $doc->document->creator->name }}</td>
                  <td>{{ $doc->status }}</td>
                  <td>
                    <a class="btn btn-warning" href="files/viewAdmin/{{ $doc->document_id }}" target="_blank">View</a>

                    @if($doc->file_admin_approval_id == '')
                    <button class="btn btn-success apv" data-id="{{ $doc->filesharing_id }}">Approve</button>
                    <button class="btn btn-danger rej" data-id="{{ $doc->filesharing_id }}">Reject</button>
                    @endif

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


@include('include.footer')
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>


<script>
$('#usersTable').DataTable(); // Initialize DataTable

$(document).ready(function(){

$('.apv').click(function(){
  let id = $(this).data('id');
  Swal.fire({
    title: 'Are you sure to Approve this?',
    text: "This action cant be reverted!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, Approve it!',
    cancelButtonText: 'Cancel',
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire({ title: 'Approving...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
      
      $.ajax({
        url: 'files/request-approve/' + id,
        method: 'POST',
        data: {_token: '{{ csrf_token() }}'},
        success: function(response) {
          Swal.fire('Approved!', response.message, 'success');
          location.reload();
        },
        error: function(xhr) {
          Swal.fire('Error!', xhr.responseJSON.message || 'An error occurred.', 'error');
        }
      });
    }
  });
});


$('.rej').click(function(){
  let id = $(this).data('id');
  Swal.fire({
    title: 'Are you sure to Reject this?',
    text: "This action cant be reverted!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, Reject it!',
    cancelButtonText: 'Cancel',
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire({ title: 'Rejecting...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
      
      $.ajax({
        url: 'files/request-reject/' + id,
        method: 'POST',
        data: {_token: '{{ csrf_token() }}'},
        success: function(response) {
          Swal.fire('Rejected!', response.message, 'success');
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