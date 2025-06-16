@php
$page = 'logs';
@endphp
@include('include.appmanager')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap4.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="az-content az-content-dashboard">
  <div class="container">
    <div class="az-content-body">
      <div class="az-dashboard-one-title mb-4">
      </div>
      <div class="row">
        <div style="width:100%; overflow:hidden; margin-bottom: 20px;">
          <h3 style="float:left; margin:0;">Department Activity Logs</h3>
        </div>
        <div style="clear:both;"></div>

        <hr class="mg-y-30">

        <div class="table-responsive">
          <table class="table table-striped mg-b-0" id="logsTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>User</th>
                <th>Action</th>
                <th>Document</th>
                <th>Date & Time</th>
              </tr>
            </thead>
            <tbody>
              @foreach($document_logs as $key => $log)
                <tr>
                  <th scope="row">{{ ++$key }}</th>
                  <td>{{ $log->user_name }}</td>
                  <td>{{ $log->action }}</td>
                  <td>{{ $log->document_title }}</td>
                  <td>{{ $log->created_at }}</td>
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
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script>
$('#logsTable').DataTable({
    dom: 'Bfrtip',
    buttons: [
        {
            extend: 'pdf',
            text: 'Download PDF',
            className: 'btn btn-primary',
            title: 'Department Activity Logs',
            exportOptions: {
                columns: [0, 1, 2, 3, 4]
            }
        }
    ]
});
</script>
