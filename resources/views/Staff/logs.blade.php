@php
$page = 'logs';
@endphp
@include('include.appstaff')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="az-content az-content-dashboard">
  <div class="container">
    <div class="az-content-body">
      <div class="clearfix mb-4">
        <h3 class="float-left">System Logs</h3>
      </div>

      <hr class="mg-y-30">

      <div class="table-responsive" style="padding-bottom: 100px;">
        <table class="table table-striped" id="logsTable" style="width: 1110px;">
          <thead>
            <tr>
              <th>#</th>
              <th>Action</th>
              <th>Reference</th>
              <th>Performed By</th>
              <th>Date & Time</th>
              <th>View File</th>
            </tr>
          </thead>
          <tbody>
            @foreach($document_logs as $log)
              @if($log->owner_id == auth()->id())
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                  @php
                    $badgeClass = [
                      'UPLOAD FILE' => 'success',
                      'CREATE FOLDER' => 'primary',
                      'DELETE FOLDER' => 'danger',
                      'RENAME FOLDER' => 'warning',
                      'DELETE FILE' => 'danger',
                      'FILE REQUESTED' => 'info',
                      'UPDATE FILE TITLE' => 'warning',
                      'FILE REPLACED' => 'secondary',
                      'VIEW FILE' => 'info',
                    ][$log->action] ?? 'light';
                  @endphp
                  <span class="badge badge-{{ $badgeClass }}">{{ $log->action }}</span>
                </td>
                <td>{{ $log->reference ?? '-' }}</td>
                <td>
                  @if($log->created_by != $log->owner_id)
                    {{ \App\Models\User::find($log->created_by)->name ?? 'System' }}
                  @else
                    You
                  @endif
                </td>
                <td>{{ \Carbon\Carbon::parse($log->created_at)->format('d M Y h:i A') }}</td>
                <td>
                  @if($log->filepath)
                  <a href="viewfilestaff/{{ $log->logs_id }}" target="_blank" class="btn btn-sm btn-primary">View File</a>
                  @else
                    -
                  @endif
                </td>
              </tr>
              @endif
            @endforeach
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

@include('include.footer')
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('lib/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('lib/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('lib/morris.js/morris.min.js') }}"></script>
<script src="{{ asset('lib/chart.js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('js/chart.morris.js') }}"></script>
<script src="{{ asset('js/chart.chartjs.js') }}"></script>
<script src="{{ asset('lib/ionicons/ionicons.js') }}"></script>

<script>
$(document).ready(function(){
  $('#logsTable').DataTable({
  });
});
</script>
