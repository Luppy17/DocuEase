@php
$page = 'department-documents';
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
          <h3 style="float:left; margin:0;">Department Documents</h3>
        </div>
        <div style="clear:both;"></div>

        <hr class="mg-y-30">

        <div class="table-responsive">
          <table class="table table-striped mg-b-0" id="documentsTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Document Title</th>
                <th>Folder</th>
                <th>Created By</th>
                <th>Department</th>
                <th>Created At</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($documents as $key => $document)
                <tr>
                  <th scope="row">{{ ++$key }}</th>
                  <td>{{ $document->document_title }}</td>
                  <td>{{ $document->folder->df_name ?? 'No Folder' }}</td>
                  <td>{{ $document->creator->name }}</td>
                  <td>{{ $document->department->dept_name }}</td>
                  <td>{{ $document->created_at }}</td>
                  <td>
                    <span class="badge bg-{{ $document->status === 'Approved' ? 'success' : ($document->status === 'Pending' ? 'warning' : 'danger') }}">
                      {{ $document->status }}
                    </span>
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
$('#documentsTable').DataTable(); // Initialize DataTable
</script>
