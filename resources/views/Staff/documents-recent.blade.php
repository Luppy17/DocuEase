@php
$page = 'recent';
@endphp
@include('include.appstaff')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">


<style>
  body {
    background-color: #f8f9fa;
  }

  .az-content-body {
    padding-top: 20px;
  }

  .drive-container {
    padding: 20px;
    display: flex;
    flex-wrap: wrap;
    gap: 20px; 
    justify-content: flex-start; 
  }

  .drive-item {
    width: 200px; 
    height: 220px; 
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    text-align: center;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    justify-content: space-between; 
    position: relative;
    transition: all 0.2s ease;
    background-color: #ffffff;
    padding: 15px;
    box-sizing: border-box; 

    padding-bottom: 50px; 
  }

  .drive-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    background-color: #e9f0ff;
  }

  .drive-item .icon-wrapper {
    flex-grow: 1; 
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .folder-item i.fimg,
  .file-item i.fimg {
    font-size: 70px;
    color: #4e73df;
    transition: color 0.2s ease;
  }

  .file-item i.fimg {
    color: #6c757d;
  }

  .drive-item:hover .folder-item i.fimg,
  .drive-item:hover .file-item i.fimg {
    color: #3660d1;
  }


  .status-icon {
    font-size: 20px;
    position: absolute;
    top: 10px;
    right: 10px;
    color: #707070;
    z-index: 10; 
  }

  .status-icon.text-success {
    color: #28a745 !important;
  }

  .status-icon.text-warning {
    color: #ffc107 !important;
  }


  .top-star-icon {
    font-size: 18px; 
    color: #6c757d;
    background: transparent;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 0;
    margin: 0;
    line-height: 1;
    transition: color 0.2s ease;
    
    position: absolute; 
    top: 10px; 
    left: 10px; 
    z-index: 10; 

    width: 30px;
    height: 30px;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .top-star-icon.starred {
    color: #ffc107;
  }

  .top-star-icon:hover {
    color: #ffc107;
  }


  .drive-title {
    font-size: 16px;
    font-weight: 600;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    margin-top: 10px;
    color: #343a40;
  }

  .drive-details {
    font-size: 12px;
    color: #888;
    margin-top: 2px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }


  .actions-container {
    position: absolute; 
    bottom: 0; 
    left: 0; 
    width: 100%; 
    height: 45px; 
    background-color: #ffffff; 
    border-top: 1px solid #eee; 
    box-sizing: border-box; 
    z-index: 2; 

    display: flex; 
    justify-content: flex-end; 
    align-items: center; 
    padding: 0 10px; 
  }


  .actions-container .delete-btn,
  .actions-container .rename-btn {
    width: 35px; 
    height: 35px; 
    
    display: flex; 
    justify-content: center;
    align-items: center;

    font-size: 18px; 
    color: #6c757d;
    background: transparent;
    border: none; 
    outline: none; 
    cursor: pointer;
    padding: 0; 
    margin-left: 10px; 
    transition: color 0.2s ease;
    flex-shrink: 0; 
  }



  .actions-container button:first-child {
      margin-left: 0;
  }

  .actions-container .delete-btn:hover {
    color: #dc3545;
  }

  .actions-container .rename-btn:hover {
    color: #007bff;
  }

  .file-item[style*="lightgray"] {
    background-color: #f0f0f0 !important;
    cursor: not-allowed;
    box-shadow: none;
  }

  .file-item[style*="lightgray"]:hover {
    transform: none;
    box-shadow: none;
  }


  #driveItemsContainer.list-view {
    flex-direction: column; 
    padding: 0px 20px; 
  }

  #driveItemsContainer.list-view .drive-item {
    width: 100%; 
    height: auto; 
    flex-direction: row; 
    align-items: center; 
    justify-content: flex-start; 
    padding: 10px 15px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05); 
    margin-bottom: 10px; 
  }

  #driveItemsContainer.list-view .drive-item .icon-wrapper {
    flex-grow: 0;
    margin-right: 15px;
  }

  #driveItemsContainer.list-view .drive-item i.fimg {
    font-size: 40px; 
  }

  #driveItemsContainer.list-view .drive-item .drive-title {
    margin-top: 0;
    font-size: 16px;
    flex-basis: 30%; 
  }

  #driveItemsContainer.list-view .drive-item .drive-details {
    margin-top: 0;
    font-size: 13px;
    flex-basis: 20%; 
  }

  #driveItemsContainer.list-view .drive-item .status-icon {
    position: static; 
    margin-left: 10px;
    margin-right: auto; 
  }


  #driveItemsContainer.list-view .drive-item .top-star-icon {
    position: static; 
    order: -1; 
    margin-right: 10px; 
    margin-left: 0; 
  }

  #driveItemsContainer.list-view .drive-item .actions-container {
    position: static; 
    margin-top: 0;
    padding-top: 0;
    border-top: none;
    margin-left: auto; 
    height: auto; 
  }
</style>

<div class="az-content-wrapper">
    <div class="az-content az-content-dashboard">
        <div class="container">
            <div class="az-content-body">
                <div class="az-dashboard-one-title mb-4">
                </div>

                <div class="mb-4 clearfix">
                    <h3 class="float-left">Most Recent files</h3>
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
                        <button class="btn btn-outline-secondary" id="gridViewBtn" title="Grid View">
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
                    <div class="drive-item file-item" style="background-color: lightgray;">
                        <div class="icon-wrapper">
                            <i class="fa fa-file fimg" data-id="{{ $doc->document_id }}"></i>
                        </div>
                        <div class="drive-title">{{ $doc->document_title }}</div>
                        <div class="drive-details">{{ $doc->creator->name }} | {{ $doc->creator->department->dept_name }}</div>
                        <div class="drive-details">{{ $doc->updated_at->format('d M Y h:i A') }}</div>
                        <span style="color:red; font-weight:bolder;">REJECTED</span>
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