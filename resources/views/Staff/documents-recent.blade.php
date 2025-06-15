@php
$page = 'recent';
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

  /* Increase height for rejected items */
  .drive-item.rejected-item {
    height: 260px !important;
    padding-bottom: 60px !important;
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
  .actions-container .rename-btn {
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

  /* Rejected Items Styling */
  .rejected-item {
    background: rgba(255, 255, 255, 0.85) !important;
    backdrop-filter: blur(20px) !important;
    border: 2px solid rgba(229, 62, 62, 0.3) !important;
    opacity: 0.9;
    position: relative;
    height: 260px !important;
    padding: 20px 16px 60px 16px !important;
    display: flex !important;
    flex-direction: column !important;
    justify-content: space-between !important;
    box-shadow: 0 8px 32px rgba(229, 62, 62, 0.15) !important;
  }

  .rejected-item:hover {
    transform: translateY(-8px) scale(1.02) !important;
    background: rgba(255, 255, 255, 0.9) !important;
    box-shadow: 0 16px 48px rgba(229, 62, 62, 0.2) !important;
    cursor: not-allowed;
  }

  .rejected-item .icon-wrapper {
    flex-grow: 1;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .rejected-icon {
    color: #a0a0a0 !important;
    opacity: 0.8;
  }

  .rejected-overlay {
    position: absolute;
    top: 16px;
    right: 16px;
    z-index: 10;
  }

  .rejected-badge {
    background: linear-gradient(135deg, #e53e3e, #c53030);
    color: white;
    padding: 4px 8px;
    border-radius: 8px;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 12px rgba(229, 62, 62, 0.4);
    text-transform: uppercase;
  }

  .rejected-title {
    color: #4a5568 !important;
    opacity: 0.9 !important;
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

  .rejected-details {
    color: #4a5568 !important;
    opacity: 0.8 !important;
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

  .rejected-actions {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 50px;
    background: rgba(255, 255, 255, 0.95) !important;
    backdrop-filter: blur(20px);
    border-top: 1px solid rgba(229, 62, 62, 0.2);
    border-radius: 0 0 16px 16px;
    box-sizing: border-box;
    z-index: 2;
    display: flex;
    justify-content: center !important;
    align-items: center !important;
    padding: 0 16px;
  }

  .rejected-status-icon {
    color: #e53e3e;
    font-size: 20px;
    opacity: 0.9;
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
  #driveItemsContainer.list-view .actions-container .rename-btn {
    width: 36px; 
    height: 36px; 
    font-size: 16px;
    margin: 0;
  }

  /* List View Rejected Items */
  #driveItemsContainer.list-view .rejected-item {
    height: auto !important;
    opacity: 0.9;
    background: rgba(255, 255, 255, 0.85) !important;
    backdrop-filter: blur(20px) !important;
    border: 1px solid rgba(229, 62, 62, 0.3) !important;
    padding: 16px 20px !important;
    justify-content: flex-start !important;
    box-shadow: 0 4px 16px rgba(229, 62, 62, 0.1) !important;
  }

  #driveItemsContainer.list-view .rejected-item:hover {
    transform: translateY(-2px) !important;
    background: rgba(255, 255, 255, 0.9) !important;
    box-shadow: 0 6px 20px rgba(229, 62, 62, 0.15) !important;
    cursor: not-allowed;
  }

  #driveItemsContainer.list-view .rejected-item .icon-wrapper {
    margin-bottom: 0;
    padding-top: 0;
  }

  #driveItemsContainer.list-view .rejected-overlay {
    grid-column: 6;
    position: static;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  #driveItemsContainer.list-view .rejected-badge {
    font-size: 11px;
    padding: 6px 12px;
  }

  #driveItemsContainer.list-view .rejected-actions {
    grid-column: 7 / 9;
    position: static;
    bottom: auto;
    left: auto;
    transform: none;
    background: transparent !important;
  }

  #driveItemsContainer.list-view .rejected-title {
    margin: 0 !important;
    text-align: left;
  }

  #driveItemsContainer.list-view .rejected-details {
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
                    <h3 class="float-left" style="color: #2d3748; font-weight: 600;">Most Recent Files</h3>
                </div>

                <div class="row mb-3 align-items-center">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" class="form-control" id="searchDrive" placeholder="Search files and folders...">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="clearSearch">
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
                                
                    @foreach($folders as $folder)
                    <div class="drive-item folder-item">
                        <div class="icon-wrapper">
                            <i class="fa fa-folder fimg folder-item-btn" data-id="{{ $folder->df_id }}"></i>
                        </div>
                        <div class="drive-title">{{ $folder->folder_name }}</div>
                        <div class="drive-details">{{ $folder->creator->name }} | {{ $folder->creator->department->dept_name }}</div>
                        <div class="drive-details">{{ $folder->created_at->format('d M Y h:i A') }}</div>

                        @if(auth()->user() && auth()->user()->dept_id == $folder->creator->department->dept_id)
                        <div class="actions-container">
                            <button class="rename-btn rename-folder" data-id="{{ $folder->df_id }}"><i class="fa fa-pen"></i></button>
                            <button class="delete-btn delete-folder" data-id="{{ $folder->df_id }}"><i class="fa fa-trash"></i></button>
                        </div>
                        @endif
                    </div>
                    @endforeach

                    @foreach($documents as $doc)
                    <?php
                    $samedept = (auth()->user() && auth()->user()->dept_id == $doc->creator->department->dept_id) ? 1 : 0;

                    $filesharingrequest = null;
                    $isStarred = false;
                    if (auth()->user()) {
                        $filesharingrequest = DB::table('filesharing')
                        ->where('document_id', $doc->document_id)
                        ->where('requested_by', auth()->user()->id)
                        ->whereDate('filesharing_expiry_date', '>=', now())
                        ->whereIn('status',['Pending','Approved'])
                        ->first();
                        
                        $starredDoc = DB::table('starred_documents')
                            ->where('user_id', auth()->user()->id)
                            ->where('document_id', $doc->document_id)
                            ->first();
                        $isStarred = !empty($starredDoc);
                    }

                    $fileclass = '';
                    if ($samedept == 0 && !$filesharingrequest){
                        $fileclass = 'file-item-btn-request';
                    } else if ($samedept == 1){
                        $fileclass = 'file-item-btn';
                    } else if ($samedept == 0 && $filesharingrequest){
                        if($filesharingrequest->status == 'Approved'){
                            $fileclass = 'file-item-btn';
                        } else if($filesharingrequest->status == 'Pending'){
                            $fileclass = 'file-item-btn-pending';
                        } else {
                            $fileclass = 'file-item-btn-request';
                        }
                    }
                    ?>

                    @if($doc->status != 'Rejected')
                    <div class="drive-item file-item">
                        <div class="icon-wrapper">
                            <i class="fa fa-file fimg {{ $fileclass }}" data-id="{{ $doc->document_id }}"></i>
                        </div>

                        <button class="top-star-icon star-btn {{ $isStarred ? 'starred' : '' }}" data-id="{{ $doc->document_id }}">
                            <i class="fa-solid fa-star"></i>
                        </button>

                        <i class="fa {{ $doc->status == 'Approved' ? 'fa-check-circle text-success' : 'fa-clock text-warning' }} status-icon"></i>
                        <div class="drive-title">{{ $doc->document_title }}</div>
                        <div class="drive-details">{{ $doc->creator->name }} | {{ $doc->creator->department->dept_name }}</div>
                        <div class="drive-details">{{ $doc->updated_at->format('d M Y h:i A') }}</div>
                        <div class="actions-container">
                            @if($samedept == 1)
                            <button class="rename-btn rename-file" data-id="{{ $doc->document_id }}"><i class="fa fa-pen"></i></button>
                            <button class="delete-btn delete-file" data-id="{{ $doc->document_id }}"><i class="fa fa-trash"></i></button>
                            @endif
                        </div>
                    </div>
                    @else
                    <div class="drive-item file-item rejected-item">
                        <div class="icon-wrapper">
                            <i class="fa fa-file fimg rejected-icon"></i>
                        </div>
                        
                        <div class="rejected-overlay">
                            <span class="rejected-badge">REJECTED</span>
                        </div>
                        
                        <div class="drive-title rejected-title">{{ $doc->document_title }}</div>
                        <div class="drive-details rejected-details">{{ $doc->creator->name }} | {{ $doc->creator->department->dept_name }}</div>
                        <div class="drive-details rejected-details">{{ $doc->updated_at->format('d M Y h:i A') }}</div>
                        
                        <div class="actions-container rejected-actions">
                            <i class="fas fa-times-circle rejected-status-icon"></i>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createFolderModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Folder</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="text" id="folderName" class="form-control" placeholder="Folder Name">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" id="submitFolder">Create</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="uploadModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload File</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="uploadForm">
                        @csrf
                        <input type="text" class="form-control mb-2" name="document_title" placeholder="Document Title" required>
                        <input type="file" class="form-control" name="document_file" required>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" id="submitUpload">Upload</button>
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

        const profileDropdownToggle = document.getElementById('profileDropdownToggle');
        const profileDropdownMenu = document.getElementById('profileDropdownMenu');
        const closeDropdownBtn = document.getElementById('closeDropdownBtn');

        if (profileDropdownToggle && profileDropdownMenu) {
            profileDropdownToggle.addEventListener('click', function(e) {
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

        if (currentPage === 'recent') {
            $('.az-sidebar-nav .nav-link[href="/recent-files"]').addClass('active');
        } else if (currentPage) {
            $(`.az-sidebar-nav .nav-link[href$="/${currentPage}"]`).addClass('active');
        }

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

        searchInput.on('keyup', function() {
            const searchTerm = $(this).val().toLowerCase();
            $('.drive-item').each(function() {
                const title = $(this).find('.drive-title').text().toLowerCase();
                if (title.includes(searchTerm)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
            if (searchTerm.length > 0) {
                clearSearchBtn.show();
            } else {
                clearSearchBtn.hide();
            }
        }).trigger('keyup');

        clearSearchBtn.click(function() {
            searchInput.val('').trigger('keyup');
        });

        $('#createFolderBtn').click(() => $('#createFolderModal').modal('show'));

        $('#submitFolder').click(function() {
            const folder_name = $('#folderName').val();
            if (!folder_name) {
                Swal.fire('Error', 'Folder name is required', 'error');
                return;
            }
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

        $('.file-item-btn').click(function() {
            const id = $(this).data('id');
            window.open('/files/view/' + id, '_blank');
        });

        $('.file-item-btn-pending').click(function() {
            Swal.fire('Info', 'Your request is pending for Approval! Please wait.', 'info');
        });

        $('.file-item-btn-request').click(function() {
            const id = $(this).data('id');
            Swal.fire({
                title: 'Request for file sharing?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/files/request-view/',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            document_id: id
                        },
                        success: res => Swal.fire('Success!', res.message, 'success').then(() => location.reload()),
                        error: () => Swal.fire('Error', 'Request failed', 'error')
                    });
                }
            });
        });

        $('.folder-item-btn').click(function() {
            const folderId = $(this).data('id');
            window.location.href = '/drive/folder/' + folderId;
        });

        $('.delete-file').click(function(e) {
            e.preventDefault();
            e.stopPropagation();
            const id = $(this).data('id');
            Swal.fire({
                title: 'Delete file?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel'
            }).then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/files/delete/' + id,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: res => Swal.fire('Deleted!', res.message, 'success').then(() => location.reload()),
                        error: () => Swal.fire('Error', 'Deletion failed', 'error')
                    });
                }
            });
        });

        $('.delete-folder').click(function(e) {
            e.preventDefault();
            e.stopPropagation();
            const id = $(this).data('id');
            Swal.fire({
                title: 'Delete this folder and those file inside the folder?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel'
            }).then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/files/folder/delete/' + id,
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: res => Swal.fire('Deleted!', res.message, 'success').then(() => location.reload()),
                        error: () => Swal.fire('Error', 'Deletion failed', 'error')
                    });
                }
            });
        });

        $('.rename-folder').click(function(e) {
            e.stopPropagation();
            const folderId = $(this).data('id');

            Swal.fire({
                title: 'Rename Folder',
                input: 'text',
                inputPlaceholder: 'Enter new folder name',
                showCancelButton: true,
                confirmButtonText: 'Rename',
                preConfirm: (folderName) => {
                    if (!folderName) {
                        Swal.showValidationMessage('Folder name cannot be empty');
                        return;
                    }
                    return $.ajax({
                        url: '/files/folder/rename/' + folderId,
                        method: 'PUT',
                        data: {
                            folder_name: folderName,
                            _token: '{{ csrf_token() }}'
                        }
                    }).then(resp => {
                        Swal.fire('Renamed!', resp.message, 'success').then(() => location.reload());
                    }).catch(() => {
                        Swal.fire('Error', 'Rename failed', 'error');
                    });
                }
            });
        });

        let editMode = false;
        let currentFileId = null;

        $('#uploadFileBtn').click(() => {
            editMode = false;
            currentFileId = null;
            $('#uploadModal .modal-title').text('Upload File');
            $('#uploadForm')[0].reset();
            $('#uploadModal').modal('show');
        });

        $('.rename-file').click(function(e) {
            e.stopPropagation();
            editMode = true;
            currentFileId = $(this).data('id');

            $.get('/files/get/' + currentFileId, function(data) {
                $('#uploadModal .modal-title').text('Edit File');
                $('input[name="document_title"]').val(data.document_title);
                $('#uploadModal').modal('show');
            }).fail(() => Swal.fire('Error', 'Unable to fetch file data', 'error'));
        });

        $('#submitUpload').click(function() {
            const formData = new FormData($('#uploadForm')[0]);
            let url = editMode ? '/files/edit/' + currentFileId : '/files/upload';

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
                error: () => Swal.fire('Error', editMode ? 'Update failed' : 'Upload failed', 'error')
            });
        });

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

        $('.star-btn').click(function(e) {
            e.stopPropagation();
            const documentId = $(this).data('id');
            const button = $(this);
            const isCurrentlyStarred = button.hasClass('starred');
            const url = isCurrentlyStarred ? '/files/unstar/' + documentId : '/files/star/' + documentId;
            const method = isCurrentlyStarred ? 'DELETE' : 'POST';

            $.ajax({
                url: url,
                method: method,
                data: { _token: '{{ csrf_token() }}' },
                success: function(response) {
                    if (response.status === 'success') {
                        button.toggleClass('starred');
                        Swal.fire('Success!', response.message, 'success');
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                },
                error: function(xhr) {
                    let errorMessage = 'An error occurred.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    Swal.fire('Error', errorMessage, 'error');
                }
            });
        });
    });
</script>