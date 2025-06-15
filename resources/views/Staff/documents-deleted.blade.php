@php
$page = 'deleted-files';
@endphp
@include('include.appstaff')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

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

  .drive-container {
    padding: 0;
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: flex-start;
  }

  .drive-item {
    width: 240px;
    height: 260px;
    border-radius: 16px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    text-align: center;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    position: relative;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    padding: 20px 16px;
    box-sizing: border-box;
    padding-bottom: 60px; 
  }

  .drive-item:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 16px 48px rgba(0, 0, 0, 0.15);
    background: rgba(255, 255, 255, 0.95);
  }

  .drive-item .icon-wrapper {
    flex-grow: 1;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .folder-item i.fimg {
    font-size: 80px;
    color: #667eea;
    transition: all 0.3s ease;
  }

  .file-item i.fimg {
    font-size: 80px; 
    color: #718096;
    transition: all 0.3s ease;
  }

  .drive-item:hover .folder-item i.fimg,
  .drive-item:hover .file-item i.fimg {
    color: #764ba2;
    transform: scale(1.1);
  }

  .status-icon {
    font-size: 22px;
    position: absolute;
    top: 16px;
    right: 16px;
    color: #718096;
    z-index: 10; 
  }

  .status-icon.text-success {
    color: #48bb78 !important;
  }

  .status-icon.text-warning {
    color: #ed8936 !important;
  }

  .top-star-icon {
    font-size: 20px; 
    color: #cbd5e0;
    background: transparent;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 0;
    margin: 0;
    line-height: 1;
    transition: all 0.3s ease;
    
    position: absolute; 
    top: 16px; 
    left: 16px; 
    z-index: 10; 

    width: 32px;
    height: 32px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 8px;
  }

  .top-star-icon.starred {
    color: #f6e05e;
  }

  .top-star-icon:hover {
    color: #f6e05e;
    background: rgba(246, 224, 94, 0.1);
  }

  .drive-title {
    font-size: 15px;
    font-weight: 600;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    margin-top: 12px;
    color: #2d3748;
    padding: 0 4px;
    line-height: 1.3;
    max-width: 100%;
  }

  .drive-details {
    font-size: 12px;
    color: #4a5568;
    font-weight: 500;
    margin-top: 3px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    padding: 0 4px;
    line-height: 1.2;
    max-width: 100%;
  }

  .actions-container {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 50px;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-top: 1px solid rgba(74, 85, 104, 0.1);
    border-radius: 0 0 16px 16px;
    box-sizing: border-box;
    z-index: 2;

    display: flex;
    justify-content: flex-end;
    align-items: center;
    padding: 0 16px;
  }

  .actions-container .delete-btn,
  .actions-container .rename-btn,
  .actions-container .restore-btn {
    width: 36px;
    height: 36px;
    
    display: flex;
    justify-content: center;
    align-items: center;

    font-size: 16px;
    color: #718096;
    background: transparent;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 0;
    margin-left: 8px;
    transition: all 0.3s ease;
    flex-shrink: 0;
    border-radius: 8px;
  }

  .actions-container button:first-child {
      margin-left: 0;
  }

  .actions-container .delete-btn:hover {
    color: #e53e3e;
    background: rgba(229, 62, 62, 0.1);
  }

  .actions-container .rename-btn:hover {
    color: #3182ce;
    background: rgba(49, 130, 206, 0.1);
  }

  .actions-container .restore-btn:hover {
    color: #48bb78;
    background: rgba(72, 187, 120, 0.1);
  }

  /* Deleted Items Styling */
  .deleted-item {
    background: rgba(248, 248, 248, 0.9) !important;
    backdrop-filter: blur(20px) !important;
    border: 2px solid rgba(160, 160, 160, 0.3) !important;
    opacity: 0.8;
    position: relative;
    height: 260px !important;
    padding: 20px 16px 60px 16px !important;
    display: flex !important;
    flex-direction: column !important;
    justify-content: space-between !important;
    box-shadow: 0 8px 32px rgba(160, 160, 160, 0.15) !important;
    cursor: default;
  }

  .deleted-item:hover {
    transform: translateY(-4px) scale(1.01) !important;
    background: rgba(245, 245, 245, 0.95) !important;
    box-shadow: 0 12px 40px rgba(160, 160, 160, 0.2) !important;
  }

  .deleted-item .icon-wrapper {
    flex-grow: 1;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .deleted-icon {
    color: #a0a0a0 !important;
    opacity: 0.7;
  }

  .deleted-overlay {
    position: absolute;
    top: 16px;
    right: 16px;
    z-index: 10;
  }

  .deleted-badge {
    background: linear-gradient(135deg, #a0a0a0, #808080);
    color: white;
    padding: 6px 12px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 12px rgba(160, 160, 160, 0.4);
    text-transform: uppercase;
  }

  .deleted-title {
    color: #4a5568 !important;
    opacity: 0.8 !important;
    font-size: 15px !important;
    font-weight: 600 !important;
    margin-top: 12px !important;
    padding: 0 4px !important;
    line-height: 1.3 !important;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    max-width: 100%;
  }

  .deleted-details {
    color: #4a5568 !important;
    opacity: 0.7 !important;
    font-size: 12px !important;
    font-weight: 500 !important;
    margin-top: 3px !important;
    padding: 0 4px !important;
    line-height: 1.2 !important;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    max-width: 100%;
  }

  .deleted-actions {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 50px;
    background: rgba(248, 248, 248, 0.95) !important;
    backdrop-filter: blur(20px);
    border-top: 1px solid rgba(160, 160, 160, 0.2);
    border-radius: 0 0 16px 16px;
    box-sizing: border-box;
    z-index: 2;
    display: flex;
    justify-content: center !important;
    align-items: center !important;
    padding: 0 16px;
  }

  .deleted-status-icon {
    color: #a0a0a0;
    font-size: 20px;
    opacity: 0.8;
  }

  /* List View Styles */
  #driveItemsContainer.list-view {
    flex-direction: column; 
    padding: 0; 
    gap: 8px; 
  }

  #driveItemsContainer.list-view .drive-item {
    width: 100%; 
    height: auto; 
    flex-direction: row; 
    align-items: center; 
    justify-content: flex-start; 
    padding: 16px 20px; 
    box-shadow: 0 4px 16px rgba(0,0,0,0.05); 
    margin-bottom: 0; 
    padding-bottom: 16px; 
    display: grid;
    grid-template-columns: auto 50px 1fr 1fr 1fr auto auto auto;
    gap: 16px;
    align-items: center;
  }

  #driveItemsContainer.list-view .drive-item .icon-wrapper {
    grid-column: 1;
    margin: 0;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  #driveItemsContainer.list-view .drive-item i.fimg {
    font-size: 32px; 
  }

  #driveItemsContainer.list-view .drive-item .top-star-icon {
    grid-column: 2;
    position: static;
    margin: 0;
    width: 30px;
    height: 30px;
    font-size: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  #driveItemsContainer.list-view .drive-item .drive-title {
    grid-column: 3;
    margin: 0; 
    font-size: 16px;
    font-weight: 600;
    text-align: left;
    padding: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    min-width: 0;
  }

  #driveItemsContainer.list-view .drive-item .drive-details:nth-of-type(1) {
    grid-column: 4;
    margin: 0; 
    font-size: 14px;
    color: #4a5568;
    font-weight: 500;
    text-align: left;
    padding: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    min-width: 0;
  }

  #driveItemsContainer.list-view .drive-item .drive-details:nth-of-type(2) {
    grid-column: 5;
    margin: 0; 
    font-size: 14px;
    color: #4a5568;
    font-weight: 500;
    text-align: left;
    padding: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    min-width: 0;
  }

  #driveItemsContainer.list-view .drive-item .status-icon {
    grid-column: 6;
    position: static;
    margin: 0;
    font-size: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 30px;
  }

  #driveItemsContainer.list-view .drive-item .actions-container {
    grid-column: 7 / 9;
    position: static; 
    margin: 0;
    padding: 0; 
    border: none; 
    height: auto; 
    background: transparent;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 8px; 
    width: auto;
  }

  #driveItemsContainer.list-view .actions-container .delete-btn,
  #driveItemsContainer.list-view .actions-container .rename-btn,
  #driveItemsContainer.list-view .actions-container .restore-btn {
    width: 36px; 
    height: 36px; 
    font-size: 16px;
    margin: 0;
  }

  /* List View Deleted Items */
  #driveItemsContainer.list-view .deleted-item {
    height: auto !important;
    opacity: 0.8;
    background: rgba(248, 248, 248, 0.9) !important;
    backdrop-filter: blur(20px) !important;
    border: 1px solid rgba(160, 160, 160, 0.3) !important;
    padding: 16px 20px !important;
    justify-content: flex-start !important;
    box-shadow: 0 4px 16px rgba(160, 160, 160, 0.1) !important;
  }

  #driveItemsContainer.list-view .deleted-item:hover {
    transform: translateY(-2px) !important;
    background: rgba(245, 245, 245, 0.95) !important;
    box-shadow: 0 6px 20px rgba(160, 160, 160, 0.15) !important;
  }

  #driveItemsContainer.list-view .deleted-item .icon-wrapper {
    margin-bottom: 0;
    padding-top: 0;
  }

  #driveItemsContainer.list-view .deleted-overlay {
    grid-column: 6;
    position: static;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  #driveItemsContainer.list-view .deleted-badge {
    font-size: 11px;
    padding: 6px 12px;
  }

  #driveItemsContainer.list-view .deleted-actions {
    grid-column: 7 / 9;
    position: static;
    bottom: auto;
    left: auto;
    transform: none;
    background: transparent !important;
  }

  #driveItemsContainer.list-view .deleted-title {
    margin: 0 !important;
    text-align: left;
  }

  #driveItemsContainer.list-view .deleted-details {
    margin: 0 !important;
    text-align: left;
  }

  /* Modern Form Styling */
  .form-control {
    border: 2px solid rgba(74, 85, 104, 0.1);
    border-radius: 12px;
    padding: 12px 16px;
    font-size: 15px;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(20px);
  }

  .form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    background: white;
  }

  .btn {
    border-radius: 12px;
    padding: 12px 24px;
    font-weight: 600;
    font-size: 15px;
    transition: all 0.3s ease;
    border: none;
  }

  .btn-primary {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    box-shadow: 0 4px 16px rgba(102, 126, 234, 0.3);
  }

  .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(102, 126, 234, 0.4);
  }

  .btn-secondary {
    background: rgba(74, 85, 104, 0.1);
    color: #4a5568;
    border: 2px solid rgba(74, 85, 104, 0.1);
  }

  .btn-secondary:hover {
    background: rgba(74, 85, 104, 0.2);
    transform: translateY(-1px);
  }

  .btn-outline-secondary {
    border: 2px solid rgba(74, 85, 104, 0.2);
    color: #4a5568;
    background: transparent;
  }

  .btn-outline-secondary:hover {
    background: rgba(74, 85, 104, 0.1);
    transform: translateY(-1px);
  }

  .btn-outline-secondary.active {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border-color: #667eea;
  }

  /* Success button for restore */
  .btn-success {
    background: linear-gradient(135deg, #48bb78, #38a169);
    color: white;
    box-shadow: 0 4px 16px rgba(72, 187, 120, 0.3);
  }

  .btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(72, 187, 120, 0.4);
  }

  /* Modal Styling */
  .modal {
    z-index: 99999 !important;
  }

  .modal-backdrop {
    z-index: 99998 !important;
    background-color: rgba(0, 0, 0, 0.5);
  }

  .modal.show {
    display: block !important;
  }

  .modal-dialog {
    z-index: 100000 !important;
    position: relative;
  }

  .modal-content {
    border-radius: 16px;
    border: none;
    box-shadow: 0 16px 48px rgba(0, 0, 0, 0.15);
    background: white !important;
    backdrop-filter: blur(20px);
    position: relative;
    z-index: 100001 !important;
  }

  .modal-header {
    border-bottom: 1px solid rgba(74, 85, 104, 0.1);
    border-radius: 16px 16px 0 0;
  }

  .modal-title {
    font-weight: 600;
    color: #2d3748;
  }

  .modal-footer {
    border-top: 1px solid rgba(74, 85, 104, 0.1);
    border-radius: 0 0 16px 16px;
  }

  .close {
    font-size: 1.5rem;
    font-weight: 300;
    color: #718096;
    opacity: 1;
  }

  .close:hover {
    color: #2d3748;
  }

  /* Input Group Styling */
  .input-group-append .btn {
    border-radius: 0 12px 12px 0;
    border: 2px solid rgba(74, 85, 104, 0.1);
    border-left: none;
  }

  /* Responsive Design */
  @media (max-width: 768px) {
    .drive-item {
      width: 180px;
      height: 200px;
    }
    
    .az-content {
      padding: 20px;
    }
    
    #driveItemsContainer.list-view .drive-item {
      padding: 12px 16px;
    }
  }
</style>

<div class="az-content-wrapper">
    <div class="az-content az-content-dashboard">
        <div class="container">
            <div class="az-content-body">
                <div class="az-dashboard-one-title mb-4">
                </div>

                <div class="mb-4 clearfix">
                    <h3 class="float-left" style="color: #2d3748; font-weight: 600;">Deleted Files</h3>
                    <button class="btn btn-success float-right" id="restoreAllBtn">
                        <i class="fas fa-undo"></i> Restore All
                    </button>
                    <button class="btn btn-outline-secondary float-right mr-2" id="emptyBinBtn">
                        <i class="fas fa-trash-alt"></i> Empty Bin
                    </button>
                </div>

                <div class="row mb-3 align-items-center">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" class="form-control" id="searchDrive" placeholder="Search deleted files...">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="clearSearch" style="display: none;">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="btn btn-outline-secondary active" id="gridViewBtn" title="Grid View">
                            <i class="fas fa-th-large"></i>
                        </button>
                        <button class="btn btn-outline-secondary ml-2" id="listViewBtn" title="List View">
                            <i class="fas fa-list"></i>
                        </button>
                    </div>
                </div>

                <div id="driveItemsContainer" class="drive-container">

                    @forelse($documents as $doc)
                    <div class="drive-item file-item deleted-item">
                        <div class="icon-wrapper">
                            <i class="fa fa-file fimg deleted-icon" data-id="{{ $doc->document_id }}"></i>
                        </div>
                        
                        <div class="deleted-overlay">
                            <span class="deleted-badge">DELETED</span>
                        </div>
                        
                        <div class="drive-title deleted-title">{{ $doc->document_title }}</div>
                        <div class="drive-details deleted-details">{{ $doc->creator->name }} | {{ $doc->creator->department->dept_name }}</div>
                        <div class="drive-details deleted-details">Deleted: {{ $doc->deleted_at ? $doc->deleted_at->format('d M Y h:i A') : $doc->updated_at->format('d M Y h:i A') }}</div>
                        
                        <div class="actions-container deleted-actions">
                            <button class="restore-btn restore-file" data-id="{{ $doc->document_id }}" title="Restore File">
                                <i class="fas fa-undo"></i>
                            </button>
                            <button class="delete-btn permanently-delete-file" data-id="{{ $doc->document_id }}" title="Delete Permanently">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5">
                        <div style="opacity: 0.6;">
                            <i class="fas fa-trash-alt" style="font-size: 64px; color: #4a5568; margin-bottom: 24px;"></i>
                            <h4 style="color: #2d3748; font-weight: 600; margin-bottom: 12px;">Bin is empty</h4>
                            <p style="color: #4a5568; font-size: 16px;">Deleted files will appear here and can be restored within 30 days.</p>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Create Folder Modal -->
    <div class="modal fade" id="createFolderModal" tabindex="-1" role="dialog" aria-labelledby="createFolderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createFolderModalLabel">Create Folder</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" id="folderName" class="form-control" placeholder="Folder Name" maxlength="255">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="submitFolder">Create</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload File Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Upload File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="uploadForm">
                        @csrf
                        <input type="text" class="form-control mb-3" name="document_title" placeholder="Document Title" required maxlength="255">
                        <input type="file" class="form-control" name="document_file" required>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="submitUpload">Upload</button>
                </div>
            </div>
        </div>
    </div>
</div>

@include('include.footer')

<script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="{{ asset('lib/ionicons/ionicons.js') }}"></script>
<script src="{{ asset('lib/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('lib/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('lib/morris.js/morris.min.js') }}"></script>
<script src="{{ asset('lib/chart.js/Chart.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/chart.morris.js') }}"></script>
<script src="{{ asset('js/chart.chartjs.js') }}"></script>

<script>
    $(function(){
        'use strict'

        // Existing profile dropdown functionality
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

        if (currentPage === 'deleted-files') {
            $('.az-sidebar-nav .nav-link[href="/deleted-files"]').addClass('active');
        } else if (currentPage) {
            $(`.az-sidebar-nav .nav-link[href$="/${currentPage}"]`).addClass('active');
        }

        // View Toggle Functionality
        const driveItemsContainer = $('#driveItemsContainer');
        const searchInput = $('#searchDrive');
        const clearSearchBtn = $('#clearSearch');
        const gridViewBtn = $('#gridViewBtn');
        const listViewBtn = $('#listViewBtn');

        const preferredView = localStorage.getItem('driveView') || 'grid';

        function setView(view) {
            if (view === 'list') {
                driveItemsContainer.addClass('list-view');
                listViewBtn.addClass('active');
                gridViewBtn.removeClass('active');
            } else {
                driveItemsContainer.removeClass('list-view');
                gridViewBtn.addClass('active');
                listViewBtn.removeClass('active');
            }
            localStorage.setItem('driveView', view);
        }

        setView(preferredView);

        gridViewBtn.click(() => setView('grid'));
        listViewBtn.click(() => setView('list'));

        // Enhanced Search Functionality
        searchInput.on('keyup', function() {
            const searchTerm = $(this).val().toLowerCase().trim();
            const items = $('.drive-item:not(.empty-state)');

            if (searchTerm) {
                clearSearchBtn.show();
                let visibleCount = 0;
                
                items.each(function() {
                    const title = $(this).find('.drive-title').text().toLowerCase();
                    const details = $(this).find('.drive-details').text().toLowerCase();
                    
                    if (title.includes(searchTerm) || details.includes(searchTerm)) {
                        $(this).show();
                        visibleCount++;
                    } else {
                        $(this).hide();
                    }
                });

                // Show/hide empty state
                if (visibleCount === 0 && $('.search-empty-state').length === 0) {
                    $('#driveItemsContainer').append(`
                        <div class="col-12 text-center py-5 search-empty-state">
                            <div style="opacity: 0.6;">
                                <i class="fas fa-search" style="font-size: 64px; color: #4a5568; margin-bottom: 24px;"></i>
                                <h4 style="color: #2d3748; font-weight: 600; margin-bottom: 12px;">No results found</h4>
                                <p style="color: #4a5568; font-size: 16px;">Try adjusting your search terms or browse all files.</p>
                            </div>
                        </div>
                    `);
                } else if (visibleCount > 0) {
                    $('.search-empty-state').remove();
                }
            } else {
                clearSearchBtn.hide();
                items.show();
                $('.search-empty-state').remove();
            }
        }).trigger('keyup');

        clearSearchBtn.click(function() {
            searchInput.val('').trigger('keyup');
            searchInput.focus();
        });

        // Modal Management
        function clearModals() {
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');
            $('.modal').removeClass('show').hide();
        }

        // Folder Management
        $('#createFolderBtn').click(() => {
            clearModals();
            $('#folderName').val('');
            setTimeout(() => {
                $('#createFolderModal').modal({
                    backdrop: true,
                    keyboard: true,
                    focus: true,
                    show: true
                });
            }, 100);
        });

        $('#submitFolder').click(function() {
            const folder_name = $('#folderName').val().trim();
            if (!folder_name) {
                Swal.fire('Error', 'Folder name is required', 'error');
                return;
            }
            
            $('#createFolderModal').modal('hide');
            clearModals();
            
            Swal.fire({
                title: 'Creating Folder...',
                didOpen: () => Swal.showLoading()
            });

            $.post('/files/folder/create', {
                folder_name,
                _token: '{{ csrf_token() }}'
            }, function(resp) {
                Swal.fire('Success!', resp.message, 'success').then(() => location.reload());
            }).fail(() => Swal.fire('Error', 'Could not create folder.', 'error'));
        });

        // Restore File Actions
        $('.restore-file').click(function(e) {
            e.preventDefault();
            e.stopPropagation();
            const id = $(this).data('id');
            const fileName = $(this).closest('.drive-item').find('.drive-title').text();
            
            Swal.fire({
                title: 'Restore File?',
                text: `Are you sure you want to restore "${fileName}"?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Restore',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#48bb78'
            }).then(result => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Restoring...',
                        didOpen: () => Swal.showLoading()
                    });

                    $.ajax({
                        url: '/files/restore/' + id,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            Swal.fire('Restored!', res.message || 'File has been restored successfully.', 'success').then(() => location.reload());
                        },
                        error: function(xhr) {
                            let errorMessage = 'Restore failed.';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            }
                            Swal.fire('Error', errorMessage, 'error');
                        }
                    });
                }
            });
        });

        // Permanently Delete File Actions
        $('.permanently-delete-file').click(function(e) {
            e.preventDefault();
            e.stopPropagation();
            const id = $(this).data('id');
            const fileName = $(this).closest('.drive-item').find('.drive-title').text();
            
            Swal.fire({
                title: 'Permanently Delete?',
                text: `Are you sure you want to permanently delete "${fileName}"? This action cannot be undone.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete Forever',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#e53e3e'
            }).then(result => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Deleting...',
                        didOpen: () => Swal.showLoading()
                    });

                    $.ajax({
                        url: '/files/permanently-delete/' + id,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            Swal.fire('Deleted!', res.message || 'File has been permanently deleted.', 'success').then(() => location.reload());
                        },
                        error: function(xhr) {
                            let errorMessage = 'Deletion failed.';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            }
                            Swal.fire('Error', errorMessage, 'error');
                        }
                    });
                }
            });
        });

        // Restore All Files
        $('#restoreAllBtn').click(function() {
            const fileCount = $('.deleted-item').length;
            
            if (fileCount === 0) {
                Swal.fire('Info', 'No files to restore.', 'info');
                return;
            }

            Swal.fire({
                title: 'Restore All Files?',
                text: `Are you sure you want to restore all ${fileCount} deleted files?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Restore All',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#48bb78'
            }).then(result => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Restoring all files...',
                        didOpen: () => Swal.showLoading()
                    });

                    $.ajax({
                        url: '/files/restore-all',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            Swal.fire('Restored!', res.message || 'All files have been restored successfully.', 'success').then(() => location.reload());
                        },
                        error: function(xhr) {
                            let errorMessage = 'Restore failed.';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            }
                            Swal.fire('Error', errorMessage, 'error');
                        }
                    });
                }
            });
        });

        // Empty Bin
        $('#emptyBinBtn').click(function() {
            const fileCount = $('.deleted-item').length;
            
            if (fileCount === 0) {
                Swal.fire('Info', 'Bin is already empty.', 'info');
                return;
            }

            Swal.fire({
                title: 'Empty Bin?',
                text: `Are you sure you want to permanently delete all ${fileCount} files? This action cannot be undone.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Empty Bin',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#e53e3e'
            }).then(result => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Emptying bin...',
                        didOpen: () => Swal.showLoading()
                    });

                    $.ajax({
                        url: '/files/empty-bin',
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            Swal.fire('Emptied!', res.message || 'Bin has been emptied successfully.', 'success').then(() => location.reload());
                        },
                        error: function(xhr) {
                            let errorMessage = 'Operation failed.';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            }
                            Swal.fire('Error', errorMessage, 'error');
                        }
                    });
                }
            });
        });

        // File Upload/Edit (for compatibility)
        let editMode = false;
        let currentFileId = null;

        $('#uploadFileBtn').click(() => {
            clearModals();
            editMode = false;
            currentFileId = null;
            $('#uploadModal .modal-title').text('Upload File');
            $('#uploadForm')[0].reset();
            setTimeout(() => {
                $('#uploadModal').modal({
                    backdrop: true,
                    keyboard: true,
                    focus: true,
                    show: true
                });
            }, 100);
        });

        $('#submitUpload').click(function() {
            const formData = new FormData($('#uploadForm')[0]);
            let url = editMode ? '/files/edit/' + currentFileId : '/files/upload';

            $('#uploadModal').modal('hide');
            clearModals();

            Swal.fire({
                title: editMode ? 'Updating...' : 'Uploading...',
                didOpen: () => Swal.showLoading()
            });

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: resp => Swal.fire('Success!', resp.message, 'success').then(() => location.reload()),
                error: (xhr) => {
                    let errorMessage = 'An error occurred.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    Swal.fire('Error', errorMessage, 'error');
                }
            });
        });

        // Modal Event Handlers
        $('#createFolderModal, #uploadModal').on('hidden.bs.modal', function () {
            clearModals();
        });

        // Keyboard shortcuts
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape') {
                $('.modal').modal('hide');
                clearModals();
            }
            // Ctrl/Cmd + F for search
            if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
                e.preventDefault();
                searchInput.focus();
            }
        });

        // Sidebar new button
        $('#sidebarNewButton').click(function() {
            Swal.fire({
                title: 'Create New',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Upload File',
                cancelButtonText: 'Create Folder',
                showLoaderOnConfirm: false,
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#uploadFileBtn').click();
                } else if (result.isDismissed && result.dismiss === Swal.DismissReason.cancel) {
                    $('#createFolderBtn').click();
                }
            });
        });
    });
</script>