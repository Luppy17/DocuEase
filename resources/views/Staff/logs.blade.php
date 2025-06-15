@php
$page = 'logs';
@endphp
@include('include.appstaff')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
  body {
    background: transparent;
  }

  .az-content-body {
    padding-top: 0;
  }

  .az-dashboard-one-title {
    margin-bottom: 32px;
  }

  .az-dashboard-one-title h2 {
    font-size: 32px;
    font-weight: 700;
    background: linear-gradient(135deg, #667eea, #764ba2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin: 0;
  }

  /* Modern Table Container */
  .modern-table-container {
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    padding: 32px;
    margin-bottom: 32px;
    border: 1px solid rgba(0, 0, 0, 0.08);
    overflow: hidden;
  }

  /* Modern DataTable Styling */
  .dataTables_wrapper {
    padding: 0;
  }

  .dataTables_length,
  .dataTables_filter {
    margin-bottom: 24px;
  }

  .dataTables_length label,
  .dataTables_filter label {
    font-weight: 600;
    color: #2d3748;
    font-size: 15px;
    margin-bottom: 8px;
    display: block;
  }

  .dataTables_length select,
  .dataTables_filter input {
    border: 2px solid rgba(0, 0, 0, 0.1);
    border-radius: 12px;
    padding: 12px 16px;
    font-size: 15px;
    transition: all 0.3s ease;
    background: #ffffff;
    margin-left: 8px;
  }

  .dataTables_length select:focus,
  .dataTables_filter input:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    background: white;
    outline: none;
  }

  .dataTables_filter input {
    width: 300px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23718096' viewBox='0 0 24 24'%3E%3Cpath d='M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'/%3E%3C/svg%3E");
    background-size: 20px;
    background-repeat: no-repeat;
    background-position: right 16px center;
    padding-right: 48px;
  }

  /* Modern Table Styling */
  .table {
    background: #ffffff;
    border-collapse: separate;
    border-spacing: 0;
    margin-bottom: 0;
  }

  .table thead th {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border: none;
    padding: 20px 24px;
    font-weight: 600;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    position: relative;
    vertical-align: middle;
  }

  .table thead th:first-child {
    border-radius: 16px 0 0 0;
  }

  .table thead th:last-child {
    border-radius: 0 16px 0 0;
  }

  .table tbody td {
    padding: 20px 24px;
    border: none;
    border-bottom: 1px solid rgba(0, 0, 0, 0.08);
    vertical-align: middle;
    background: #ffffff;
    font-size: 14px;
    color: #2d3748;
  }

  .table tbody tr {
    background: #ffffff;
    transition: all 0.3s ease;
    border-radius: 12px;
    overflow: hidden;
  }

  .table tbody tr:hover {
    background: #f8f9fa;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
  }

  .table tbody tr:hover td {
    background: #f8f9fa;
  }

  .table tbody tr:last-child td:first-child {
    border-radius: 0 0 0 16px;
  }

  .table tbody tr:last-child td:last-child {
    border-radius: 0 0 16px 0;
  }

  /* Modern Badge Styling */
  .badge {
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    border: none;
    position: relative;
    overflow: hidden;
  }

  .badge::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.5s;
  }

  .badge:hover::before {
    left: 100%;
  }

  .badge-success {
    background: linear-gradient(135deg, #48bb78, #38a169);
    color: white;
  }

  .badge-primary {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
  }

  .badge-danger {
    background: linear-gradient(135deg, #e53e3e, #c53030);
    color: white;
  }

  .badge-warning {
    background: linear-gradient(135deg, #ed8936, #dd6b20);
    color: white;
  }

  .badge-info {
    background: linear-gradient(135deg, #3182ce, #2c5aa0);
    color: white;
  }

  .badge-secondary {
    background: linear-gradient(135deg, #718096, #4a5568);
    color: white;
  }

  .badge-light {
    background: linear-gradient(135deg, #f7fafc, #edf2f7);
    color: #2d3748;
  }

  /* Modern Button Styling */
  .btn {
    border-radius: 12px;
    padding: 10px 20px;
    font-weight: 600;
    font-size: 13px;
    transition: all 0.3s ease;
    border: none;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .btn-primary {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    box-shadow: 0 4px 16px rgba(102, 126, 234, 0.3);
  }

  .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(102, 126, 234, 0.4);
    color: white;
  }

  .btn-sm {
    padding: 8px 16px;
    font-size: 12px;
  }

  /* Simple Minimalist Pagination */
  .dataTables_paginate {
    margin-top: 32px;
    text-align: center;
  }

  .dataTables_paginate .paginate_button {
    background: transparent;
    border: none;
    border-radius: 8px;
    padding: 8px 12px;
    margin: 0 2px;
    color: #718096;
    font-weight: 500;
    font-size: 14px;
    transition: all 0.2s ease;
    text-decoration: none;
    min-width: 36px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
  }

  .dataTables_paginate .paginate_button:hover {
    background: #f7fafc;
    color: #4a5568;
    text-decoration: none;
  }

  .dataTables_paginate .paginate_button.current {
    background: #667eea;
    color: white;
    font-weight: 600;
  }

  .dataTables_paginate .paginate_button.current:hover {
    background: #5a67d8;
    color: white;
  }

  .dataTables_paginate .paginate_button.disabled {
    color: #cbd5e0;
    cursor: not-allowed;
  }

  .dataTables_paginate .paginate_button.disabled:hover {
    background: transparent;
    color: #cbd5e0;
  }

  /* DataTable Info */
  .dataTables_info {
    color: #4a5568;
    font-weight: 500;
    margin-top: 32px;
    font-size: 14px;
  }

  /* Loading State */
  .dataTables_processing {
    background: #ffffff;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 16px 48px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(0, 0, 0, 0.08);
    color: #2d3748;
    font-weight: 600;
  }

  /* Action Icons */
  .action-icon {
    font-size: 16px;
    margin-right: 8px;
    opacity: 0.8;
  }

  /* Stats Cards */
  .stats-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 24px;
    margin-bottom: 32px;
  }

  .stat-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
  }

  .stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(135deg, #667eea, #764ba2);
  }

  .stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 16px 48px rgba(0, 0, 0, 0.15);
  }

  .stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    color: white;
    margin-bottom: 16px;
  }

  .stat-icon.primary {
    background: linear-gradient(135deg, #667eea, #764ba2);
  }

  .stat-icon.success {
    background: linear-gradient(135deg, #48bb78, #38a169);
  }

  .stat-icon.warning {
    background: linear-gradient(135deg, #ed8936, #dd6b20);
  }

  .stat-icon.danger {
    background: linear-gradient(135deg, #e53e3e, #c53030);
  }

  .stat-value {
    font-size: 32px;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 8px;
  }

  .stat-label {
    font-size: 14px;
    color: #4a5568;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  /* Responsive Design */
  @media (max-width: 768px) {
    .modern-table-container {
      padding: 20px;
      border-radius: 16px;
    }

    .dataTables_filter input {
      width: 100%;
      margin-top: 8px;
    }

    .table thead th,
    .table tbody td {
      padding: 12px 16px;
      font-size: 13px;
    }

    .stats-container {
      grid-template-columns: 1fr;
    }
  }
</style>

<div class="az-content-wrapper">
  <div class="az-content az-content-dashboard">
    <div class="container">
      <div class="az-content-body">
        <div class="az-dashboard-one-title mb-4">
          <h2>System Activity</h2>
        </div>

        <div class="mb-4 clearfix">
          <h3 class="float-left" style="color: #2d3748; font-weight: 600;">
            <i class="fas fa-clipboard-list" style="margin-right: 12px; color: #667eea;"></i>
            Activity Logs
          </h3>
        </div>

        <!-- Stats Cards -->
        <div class="stats-container">
          <div class="stat-card">
            <div class="stat-icon primary">
              <i class="fas fa-list-alt"></i>
            </div>
            <div class="stat-value">{{ count($document_logs->where('owner_id', auth()->id())) }}</div>
            <div class="stat-label">Total Activities</div>
          </div>
          
          <div class="stat-card">
            <div class="stat-icon success">
              <i class="fas fa-upload"></i>
            </div>
            <div class="stat-value">{{ count($document_logs->where('owner_id', auth()->id())->where('action', 'UPLOAD FILE')) }}</div>
            <div class="stat-label">File Uploads</div>
          </div>
          
          <div class="stat-card">
            <div class="stat-icon warning">
              <i class="fas fa-folder-plus"></i>
            </div>
            <div class="stat-value">{{ count($document_logs->where('owner_id', auth()->id())->where('action', 'CREATE FOLDER')) }}</div>
            <div class="stat-label">Folders Created</div>
          </div>
          
          <div class="stat-card">
            <div class="stat-icon danger">
              <i class="fas fa-trash-alt"></i>
            </div>
            <div class="stat-value">{{ count($document_logs->where('owner_id', auth()->id())->whereIn('action', ['DELETE FILE', 'DELETE FOLDER'])) }}</div>
            <div class="stat-label">Items Deleted</div>
          </div>
        </div>

        <!-- Modern Table Container -->
        <div class="modern-table-container">
          <div class="table-responsive">
            <table class="table table-hover" id="logsTable">
              <thead>
                <tr>
                  <th style="width: 60px;">
                    <i class="fas fa-hashtag action-icon"></i>#
                  </th>
                  <th style="width: 180px;">
                    <i class="fas fa-bolt action-icon"></i>Action
                  </th>
                  <th style="width: 200px;">
                    <i class="fas fa-file-alt action-icon"></i>Reference
                  </th>
                  <th style="width: 160px;">
                    <i class="fas fa-user action-icon"></i>Performed By
                  </th>
                  <th style="width: 180px;">
                    <i class="fas fa-clock action-icon"></i>Date & Time
                  </th>
                  <th style="width: 120px;">
                    <i class="fas fa-eye action-icon"></i>View File
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach($document_logs as $log)
                  @if($log->owner_id == auth()->id())
                  <tr>
                    <td>
                      <span style="font-weight: 600; color: #667eea;">{{ $loop->iteration }}</span>
                    </td>
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

                        $actionIcons = [
                          'UPLOAD FILE' => 'fas fa-upload',
                          'CREATE FOLDER' => 'fas fa-folder-plus',
                          'DELETE FOLDER' => 'fas fa-folder-minus',
                          'RENAME FOLDER' => 'fas fa-edit',
                          'DELETE FILE' => 'fas fa-trash-alt',
                          'FILE REQUESTED' => 'fas fa-share',
                          'UPDATE FILE TITLE' => 'fas fa-pencil-alt',
                          'FILE REPLACED' => 'fas fa-sync-alt',
                          'VIEW FILE' => 'fas fa-eye',
                        ][$log->action] ?? 'fas fa-circle';
                      @endphp
                      <span class="badge badge-{{ $badgeClass }}">
                        <i class="{{ $actionIcons }}" style="margin-right: 6px;"></i>
                        {{ $log->action }}
                      </span>
                    </td>
                    <td>
                      <span style="font-weight: 500;">{{ $log->reference ?? '-' }}</span>
                    </td>
                    <td>
                      @if($log->created_by != $log->owner_id)
                        <div style="display: flex; align-items: center;">
                          <div style="width: 32px; height: 32px; border-radius: 8px; background: linear-gradient(135deg, #667eea, #764ba2); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; margin-right: 8px; font-size: 12px;">
                            {{ substr(\App\Models\User::find($log->created_by)->name ?? 'S', 0, 1) }}
                          </div>
                          <span style="font-weight: 500;">{{ \App\Models\User::find($log->created_by)->name ?? 'System' }}</span>
                        </div>
                      @else
                        <div style="display: flex; align-items: center;">
                          <div style="width: 32px; height: 32px; border-radius: 8px; background: linear-gradient(135deg, #48bb78, #38a169); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; margin-right: 8px; font-size: 12px;">
                            <i class="fas fa-user"></i>
                          </div>
                          <span style="font-weight: 600; color: #48bb78;">You</span>
                        </div>
                      @endif
                    </td>
                    <td>
                      <div style="display: flex; flex-direction: column;">
                        <span style="font-weight: 600; color: #2d3748;">{{ \Carbon\Carbon::parse($log->created_at)->format('d M Y') }}</span>
                        <span style="font-size: 12px; color: #718096;">{{ \Carbon\Carbon::parse($log->created_at)->format('h:i A') }}</span>
                      </div>
                    </td>
                    <td>
                      @if($log->filepath)
                        <a href="viewfilestaff/{{ $log->logs_id }}" target="_blank" class="btn btn-sm btn-primary">
                          <i class="fas fa-external-link-alt" style="margin-right: 4px;"></i>
                          View
                        </a>
                      @else
                        <span style="color: #a0aec0; font-style: italic;">No file</span>
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
  </div>
</div>

@include('include.footer')

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
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
    'use strict'

    // Profile dropdown functionality
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

    // Menu functionality
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

    // Set active navigation
    const currentPage = '{{ $page ?? "" }}';
    $('.az-sidebar-nav .nav-link').removeClass('active');

    if (currentPage === 'logs') {
        $('.az-sidebar-nav .nav-link[href="/system-logs"]').addClass('active');
    } else if (currentPage) {
        $(`.az-sidebar-nav .nav-link[href$="/${currentPage}"]`).addClass('active');
    }

    // Initialize DataTable with modern styling
    $('#logsTable').DataTable({
        responsive: true,
        pageLength: 25,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        order: [[4, 'desc']], // Sort by date column (index 4) in descending order
        columnDefs: [
            { orderable: false, targets: [5] }, // Disable sorting for View File column
            { searchable: false, targets: [0, 5] }, // Disable search for # and View File columns
        ],
        language: {
            search: "Search activities:",
            lengthMenu: "Show _MENU_ activities per page",
            info: "Showing _START_ to _END_ of _TOTAL_ activities",
            infoEmpty: "No activities found",
            infoFiltered: "(filtered from _MAX_ total activities)",
            paginate: {
                first: "First",
                last: "Last",
                next: "Next",
                previous: "Previous"
            },
            processing: '<div style="display: flex; align-items: center; justify-content: center;"><i class="fas fa-spinner fa-spin" style="margin-right: 8px;"></i>Loading activities...</div>'
        },
        processing: true,
        drawCallback: function(settings) {
            // Add smooth animations for table rows
            $(this.api().table().node()).find('tbody tr').each(function(index) {
                $(this).css({
                    'animation': `fadeInUp 0.3s ease ${index * 0.05}s both`
                });
            });
        }
    });

    // Add custom CSS animations
    $('<style>')
        .prop('type', 'text/css')
        .html(`
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
        `)
        .appendTo('head');

    // Enhance stat cards with hover effects
    $('.stat-card').hover(
        function() {
            $(this).find('.stat-icon').css('transform', 'scale(1.1) rotate(5deg)');
        },
        function() {
            $(this).find('.stat-icon').css('transform', 'scale(1) rotate(0deg)');
        }
    );

    // Add loading state for external file links
    $('a[href*="viewfilestaff"]').on('click', function() {
        const $btn = $(this);
        const originalText = $btn.html();
        
        $btn.html('<i class="fas fa-spinner fa-spin" style="margin-right: 4px;"></i>Opening...');
        $btn.prop('disabled', true);
        
        // Reset button after 2 seconds
        setTimeout(() => {
            $btn.html(originalText);
            $btn.prop('disabled', false);
        }, 2000);
    });

    // Add keyboard shortcuts
    $(document).on('keydown', function(e) {
        // Ctrl/Cmd + F for search
        if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
            e.preventDefault();
            $('.dataTables_filter input').focus();
        }
    });

    // Initialize tooltips if needed
    $('[data-toggle="tooltip"]').tooltip();
});
</script>