@php
$page = 'dashboard';
@endphp
@include('include.appstaff')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
* {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

body {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    margin: 0;
    padding: 0;
}

.az-content-body {
    padding-top: 30px;
    min-height: 100vh;
}

/* Header Section */
.page-header {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 20px;
    padding: 25px 30px;
    margin-bottom: 30px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.page-header h4 {
    color: #2d3748;
    font-weight: 600;
    margin: 0;
    font-size: 1.5rem;
}

.back-btn {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border: none;
    border-radius: 12px;
    padding: 12px 20px;
    font-weight: 500;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.back-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    color: white;
}

.upload-btn {
    background: linear-gradient(135deg, #48bb78, #38a169);
    color: white;
    border: none;
    border-radius: 12px;
    padding: 12px 24px;
    font-weight: 500;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(72, 187, 120, 0.3);
}

.upload-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(72, 187, 120, 0.4);
    color: white;
}

/* Drive Container */
.drive-container {
    padding: 0;
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 24px;
    justify-content: start;
}

/* Drive Items */
.drive-item {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-radius: 20px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.2);
    text-align: center;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    position: relative;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    padding: 24px 20px;
    height: 260px;
    overflow: hidden;
}

.drive-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #667eea, #764ba2);
    border-radius: 20px 20px 0 0;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.drive-item:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    background: rgba(255, 255, 255, 1);
}

.drive-item:hover::before {
    opacity: 1;
}

.drive-item .icon-wrapper {
    flex-grow: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 16px;
}

.folder-item i.fimg {
    font-size: 64px;
    color: #667eea;
    transition: all 0.3s ease;
}

.file-item i.fimg {
    font-size: 64px;
    color: #718096;
    transition: all 0.3s ease;
}

.drive-item:hover .folder-item i.fimg {
    color: #764ba2;
    transform: scale(1.1);
}

.drive-item:hover .file-item i.fimg {
    color: #667eea;
    transform: scale(1.1);
}

/* Status Icons */
.status-icon {
    font-size: 20px;
    position: absolute;
    top: 20px;
    right: 20px;
    color: #a0aec0;
    z-index: 10;
    padding: 8px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.status-icon.text-success {
    color: #48bb78 !important;
    background: rgba(72, 187, 120, 0.1);
}

.status-icon.text-warning {
    color: #ed8936 !important;
    background: rgba(237, 137, 54, 0.1);
}

/* Star Icon */
.top-star-icon {
    font-size: 18px;
    color: #a0aec0;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border: none;
    outline: none;
    cursor: pointer;
    padding: 8px;
    margin: 0;
    line-height: 1;
    transition: all 0.3s ease;
    position: absolute;
    top: 20px;
    left: 20px;
    z-index: 10;
    width: 36px;
    height: 36px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.top-star-icon.starred {
    color: #f6e05e;
    background: rgba(246, 224, 94, 0.2);
}

.top-star-icon:hover {
    color: #f6e05e;
    background: rgba(246, 224, 94, 0.2);
    transform: scale(1.1);
}

/* Text Elements */
.drive-title {
    font-size: 16px;
    font-weight: 600;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    margin: 12px 0 8px 0;
    color: #2d3748;
    line-height: 1.4;
}

.drive-details {
    font-size: 13px;
    color: #718096;
    font-weight: 400;
    margin: 4px 0;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    line-height: 1.3;
}

/* Actions Container */
.actions-container {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 56px;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border-top: 1px solid rgba(226, 232, 240, 0.8);
    border-radius: 0 0 20px 20px;
    box-sizing: border-box;
    z-index: 2;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    padding: 0 20px;
    opacity: 0;
    transform: translateY(10px);
    transition: all 0.3s ease;
}

.drive-item:hover .actions-container {
    opacity: 1;
    transform: translateY(0);
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
    background: rgba(255, 255, 255, 0.8);
    border: 1px solid rgba(226, 232, 240, 0.6);
    border-radius: 10px;
    outline: none;
    cursor: pointer;
    padding: 0;
    margin-left: 8px;
    transition: all 0.3s ease;
    flex-shrink: 0;
    backdrop-filter: blur(10px);
}

.actions-container button:first-child {
    margin-left: 0;
}

.actions-container .delete-btn:hover {
    color: #e53e3e;
    background: rgba(229, 62, 62, 0.1);
    border-color: rgba(229, 62, 62, 0.3);
    transform: scale(1.05);
}

.actions-container .rename-btn:hover {
    color: #3182ce;
    background: rgba(49, 130, 206, 0.1);
    border-color: rgba(49, 130, 206, 0.3);
    transform: scale(1.05);
}

/* Rejected Items */
.rejected-file {
    background: rgba(255, 255, 255, 0.7) !important;
    border: 2px solid rgba(229, 62, 62, 0.3) !important;
    cursor: not-allowed !important;
    opacity: 0.8;
}

.rejected-file::before {
    background: linear-gradient(90deg, #e53e3e, #c53030) !important;
    opacity: 1 !important;
}

.rejected-file:hover {
    transform: none !important;
    box-shadow: 0 8px 32px rgba(229, 62, 62, 0.15) !important;
}

.rejected-file .fimg {
    color: #a0a0a0 !important;
    opacity: 0.7;
}

.rejected-file .actions-container {
    opacity: 1 !important;
    transform: translateY(0) !important;
    justify-content: center !important;
    background: rgba(229, 62, 62, 0.05) !important;
}

.rejected-badge {
    color: #e53e3e;
    font-weight: 700;
    font-size: 14px;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

/* Modal Styling */
.modal {
    z-index: 1050 !important;
}

.modal-backdrop {
    z-index: 1040 !important;
    background-color: rgba(0, 0, 0, 0.6);
}

.modal-dialog {
    z-index: auto !important;
    pointer-events: auto;
}

.modal-content {
    border-radius: 20px;
    border: none;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    background: white !important;
    backdrop-filter: blur(20px);
    overflow: hidden;
}

.modal-header {
    border-bottom: 1px solid rgba(226, 232, 240, 0.8);
    padding: 24px 30px 20px;
    background: linear-gradient(135deg, #f7fafc, #edf2f7);
}

.modal-title {
    font-weight: 600;
    color: #2d3748;
    font-size: 1.25rem;
}

.modal-body {
    padding: 30px;
}

.modal-footer {
    border-top: 1px solid rgba(226, 232, 240, 0.8);
    padding: 20px 30px 24px;
    background: #f7fafc;
}

.close {
    font-size: 1.5rem;
    font-weight: 300;
    color: #718096;
    opacity: 1;
    background: transparent;
    border: none;
    padding: 0;
    cursor: pointer;
    transition: all 0.3s ease;
}

.close:hover {
    color: #2d3748;
    opacity: 1;
    transform: scale(1.1);
}

/* Form Controls */
.form-group label {
    font-weight: 500;
    color: #4a5568;
    margin-bottom: 8px;
    font-size: 14px;
}

.form-control {
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    padding: 12px 16px;
    font-size: 15px;
    transition: all 0.3s ease;
    background: #f7fafc;
    color: #2d3748;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    background: white;
    outline: none;
}

.form-control-file {
    border: 2px dashed #e2e8f0;
    border-radius: 12px;
    padding: 20px;
    background: #f7fafc;
    transition: all 0.3s ease;
    cursor: pointer;
}

.form-control-file:hover {
    border-color: #667eea;
    background: rgba(102, 126, 234, 0.05);
}

.form-text {
    color: #718096;
    font-size: 12px;
    margin-top: 6px;
}

/* Button Styles */
.btn {
    border-radius: 12px;
    padding: 12px 24px;
    font-weight: 500;
    font-size: 15px;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    color: white;
}

.btn-secondary {
    background: #e2e8f0;
    color: #4a5568;
    border: 2px solid #e2e8f0;
}

.btn-secondary:hover {
    background: #cbd5e0;
    transform: translateY(-1px);
    color: #4a5568;
}

/* Responsive Design */
@media (max-width: 768px) {
    .drive-container {
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 16px;
        padding: 0 16px;
    }
    
    .drive-item {
        height: 240px;
        padding: 20px 16px;
    }
    
    .page-header {
        padding: 20px;
        margin: 0 16px 20px;
    }
    
    .az-content-body {
        padding-top: 20px;
    }
}

@media (max-width: 576px) {
    .drive-container {
        grid-template-columns: 1fr;
        gap: 12px;
    }
    
    .page-header {
        margin: 0 8px 16px;
        padding: 16px;
    }
    
    .page-header h4 {
        font-size: 1.25rem;
    }
}

/* Loading Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.drive-item {
    animation: fadeInUp 0.6s ease forwards;
}

.drive-item:nth-child(1) { animation-delay: 0.1s; }
.drive-item:nth-child(2) { animation-delay: 0.2s; }
.drive-item:nth-child(3) { animation-delay: 0.3s; }
.drive-item:nth-child(4) { animation-delay: 0.4s; }
.drive-item:nth-child(5) { animation-delay: 0.5s; }
.drive-item:nth-child(6) { animation-delay: 0.6s; }
</style>

<div class="az-content az-content-dashboard">
  <div class="container">
    <div class="az-content-body">
      <!-- Header Section -->
      <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
          <div class="d-flex align-items-center mb-2 mb-md-0">
            <button class="btn back-btn mr-3" id="backButton">
              <i class="fas fa-arrow-left mr-2"></i>Back
            </button>
            <h4>Current Folder: {{ $currentFolder->folder_name ?? 'My Drive' }}</h4>
          </div>
          <button class="btn upload-btn" id="uploadFileBtn">
            <i class="fas fa-upload mr-2"></i>Upload File
          </button>
        </div>
      </div>

      <!-- Drive Container -->
      <div class="drive-container">
        @foreach($documents as $doc)
        @php
        $samedept = auth()->user()->dept_id == $doc->creator->department->dept_id ? 1 : 0;

        $filesharingrequest = DB::table('filesharing')
          ->where('document_id', $doc->document_id)
          ->where('requested_by', auth()->user()->id)
          ->whereDate('filesharing_expiry_date', '>=', now())
          ->whereIn('status', ['Pending', 'Approved'])
          ->first();

        // Check if the file is starred by the current user
        $isStarred = false;
        if (auth()->user()) {
            $starredDoc = DB::table('starred_documents')
                ->where('user_id', auth()->user()->id)
                ->where('document_id', $doc->document_id)
                ->first();
            $isStarred = !empty($starredDoc);
        }

        $fileclass = '';
        if ($samedept == 0 && empty($filesharingrequest)) {
          $fileclass = 'file-item-btn-request';
        } else if ($samedept == 1) {
          $fileclass = 'file-item-btn';
        } else if ($samedept == 0 && !empty($filesharingrequest)) {
          if ($filesharingrequest->status == 'Approved') {
            $fileclass = 'file-item-btn';
          } else if ($filesharingrequest->status == 'Pending') {
            $fileclass = 'file-item-btn-pending';
          } else {
            $fileclass = 'file-item-btn-request';
          }
        }
        @endphp

        <div class="drive-item file-item @if($doc->status == 'Rejected') rejected-file @endif">
          <div class="icon-wrapper">
            <i class="fa fa-file fimg {{ $fileclass }}" data-id="{{ $doc->document_id }}"></i>
          </div>

          @if($doc->status != 'Rejected')
          <button class="top-star-icon star-btn {{ $isStarred ? 'starred' : '' }}" data-id="{{ $doc->document_id }}">
              <i class="fa-solid fa-star"></i>
          </button>
          @endif

          <i class="fa {{ $doc->status == 'Approved' ? 'fa-check-circle text-success' : ($doc->status == 'Rejected' ? 'fa-times-circle' : 'fa-clock text-warning') }} status-icon" style="{{ $doc->status == 'Rejected' ? 'color: #e53e3e !important;' : '' }}"></i>
          
          <div class="drive-title">{{ $doc->document_title }}</div>
          <div class="drive-details">{{ $doc->creator->name }} | {{ $doc->creator->department->dept_name }}</div>
          <div class="drive-details">{{ $doc->updated_at->format('d M Y h:i A') }}</div>

          @if($doc->status == 'Rejected')
          <div class="actions-container">
            <span class="rejected-badge">REJECTED</span>
          </div>
          @else
          <div class="actions-container">
            @if($samedept == 1)
            <button class="rename-btn rename-file" data-id="{{ $doc->document_id }}">
                <i class="fa fa-pen"></i>
            </button>
            <button class="delete-btn delete-file" data-id="{{ $doc->document_id }}">
                <i class="fa fa-trash"></i>
            </button>
            @endif
          </div>
          @endif
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>

<!-- Upload Modal -->
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
          <input type="hidden" class="form-control" name="document_folder" value="{{$id ?? ''}}" required>
          <div class="form-group">
            <label for="document_title">Document Title</label>
            <input type="text" class="form-control" id="document_title" name="document_title" placeholder="Enter document title" required>
          </div>
          <div class="form-group">
            <label for="document_file">Select File</label>
            <input type="file" class="form-control-file" id="document_file" name="document_file">
            <small class="form-text text-muted">Only PDF, Word, Excel, and image files are allowed.</small>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="submitUpload">Upload</button>
      </div>
    </div>
  </div>
</div>

@include('include.footer')

<script>
$(document).ready(function() {
    // Clean function to remove modal artifacts
    function cleanupModals() {
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
        $('.modal').removeClass('show').hide().attr('aria-hidden', 'true');
        $('body').css('padding-right', '');
        // Reset form when modal is closed
        $('#uploadForm')[0].reset();
    }

    // Initialize modal properly
    function showModal(modalId) {
        cleanupModals();
        setTimeout(function() {
            $(modalId).modal({
                backdrop: true,
                keyboard: true,
                focus: true,
                show: true
            });
        }, 50);
    }

    // Properly handle modal close events
    function closeModal() {
        $('#uploadModal').modal('hide');
        cleanupModals();
    }

    $('#backButton').click(function() {
        window.history.back();
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

        $.post('../../files/folder/create', {
            folder_name,
            _token: '{{ csrf_token() }}'
        }, function(resp) {
            Swal.fire('Success!', resp.message, 'success').then(() => location.reload());
        }).fail(() => Swal.fire('Error', 'Could not create folder.', 'error'));
    });

    $('.file-item-btn').click(function() {
        const id = $(this).data('id');
        window.open('../../files/view/' + id, '_blank');
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
                    url: '../../files/request-view/',
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
        window.location.href = '../../drive/folder/' + folderId;
    });

    $('.delete-file').click(function(e) {
        e.stopPropagation();
        const id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then(result => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../../files/delete/' + id,
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
        e.stopPropagation();
        const id = $(this).data('id');
        Swal.fire({
            title: 'Delete this folder and all its contents?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then(result => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../../folder/delete/' + id,
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
                    url: '../../files/folder/rename/' + folderId,
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
        $('#uploadModalLabel').text('Upload File');
        $('#uploadForm')[0].reset();
        $('#document_file').prop('required', true);
        showModal('#uploadModal');
    });

    $('.rename-file').click(function(e) {
        e.stopPropagation();
        editMode = true;
        currentFileId = $(this).data('id');

        $.get('../../files/get/' + currentFileId, function(data) {
            $('#uploadModalLabel').text('Edit File');
            $('#document_title').val(data.document_title);
            $('#document_file').prop('required', false);
            showModal('#uploadModal');
        }).fail(() => Swal.fire('Error', 'Unable to fetch file data', 'error'));
    });

    $('#submitUpload').click(function() {
        const formData = new FormData($('#uploadForm')[0]);

        if (editMode && !$('#document_file')[0].files.length) {
            formData.delete('document_file');
        }

        let url = editMode ? '../../files/edit/' + currentFileId : '../../files/upload';

        // Close modal first
        closeModal();

        Swal.fire({
            title: editMode ? 'Updating file...' : 'Uploading file...',
            didOpen: () => Swal.showLoading(),
            allowOutsideClick: false
        });

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: resp => Swal.fire('Success!', resp.message, 'success').then(() => location.reload()),
            error: (xhr) => {
                let errorMessage = 'An error occurred. Please try again.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                Swal.fire('Error', errorMessage, 'error');
            }
        });
    });

    // Star/Unstar functionality
    $('.star-btn').click(function(e) {
        e.stopPropagation();
        const documentId = $(this).data('id');
        const button = $(this);
        const isCurrentlyStarred = button.hasClass('starred');
        const url = isCurrentlyStarred ? '../../files/unstar/' + documentId : '../../files/star/' + documentId;
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

    // FIXED: Handle modal close button (X) click
    $('.close, [data-dismiss="modal"]').off('click').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        closeModal();
    });

    // FIXED: Handle cancel button click specifically
    $('button[data-dismiss="modal"], .btn-secondary').off('click').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        closeModal();
    });

    // FIXED: Handle modal cleanup on hide event
    $('#uploadModal').off('hidden.bs.modal').on('hidden.bs.modal', function (e) {
        cleanupModals();
    });

    // FIXED: Handle modal backdrop click
    $('#uploadModal').off('click').on('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Prevent modal from closing when clicking inside modal content
    $('.modal-dialog').off('click').on('click', function(e) {
        e.stopPropagation();
    });

    // FIXED: Handle escape key properly
    $(document).off('keydown.modal').on('keydown.modal', function(e) {
        if (e.key === 'Escape' && $('#uploadModal').hasClass('show')) {
            e.preventDefault();
            closeModal();
        }
    });

    // FIXED: Ensure form reset when modal is opened
    $('#uploadModal').off('show.bs.modal').on('show.bs.modal', function() {
        if (!editMode) {
            $('#uploadForm')[0].reset();
        }
    });
});
</script>