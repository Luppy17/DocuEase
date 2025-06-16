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
:root {
    --primary-color: #4f46e5;
    --primary-hover: #4338ca;
    --success-color: #10b981;
    --success-hover: #059669;
    --warning-color: #f59e0b;
    --danger-color: #ef4444;
    --text-primary: #1f2937;
    --text-secondary: #6b7280;
    --bg-primary: #ffffff;
    --bg-secondary: #f9fafb;
    --border-color: #e5e7eb;
    --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
    --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
}

* {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background: var(--bg-secondary);
    min-height: 100vh;
    color: var(--text-primary);
}

.az-content-body {
    padding: 2rem 0;
    min-height: 100vh;
}

/* Header Section */
.page-header {
    background: var(--bg-primary);
    border-radius: 1rem;
    padding: 1.5rem;
    margin-bottom: 2rem;
    box-shadow: var(--shadow);
    border: 1px solid var(--border-color);
}

.page-header h4 {
    color: var(--text-primary);
    font-weight: 600;
    font-size: 1.25rem;
    margin: 0;
}

.back-btn {
    background: var(--primary-color);
    color: white;
    border: none;
    border-radius: 0.5rem;
    padding: 0.75rem 1rem;
    font-weight: 500;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.back-btn:hover {
    background: var(--primary-hover);
    color: white;
    transform: translateY(-1px);
}

.upload-btn {
    background: var(--success-color);
    color: white;
    border: none;
    border-radius: 0.5rem;
    padding: 0.75rem 1rem;
    font-weight: 500;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.upload-btn:hover {
    background: var(--success-hover);
    color: white;
    transform: translateY(-1px);
}

/* Drive Container */
.drive-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.5rem;
    padding: 0;
}

/* Drive Items */
.drive-item {
    background: var(--bg-primary);
    border-radius: 1rem;
    box-shadow: var(--shadow);
    border: 1px solid var(--border-color);
    text-align: center;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    position: relative;
    transition: all 0.2s ease;
    padding: 1.5rem;
    height: 260px;
    overflow: hidden;
}

.drive-item:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
}

.drive-item .icon-wrapper {
    flex-grow: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1rem;
}

.folder-item i.fimg {
    font-size: 3rem;
    color: var(--primary-color);
    transition: all 0.2s ease;
}

.file-item i.fimg {
    font-size: 3rem;
    color: var(--text-secondary);
    transition: all 0.2s ease;
}

.drive-item:hover .folder-item i.fimg {
    color: var(--primary-hover);
    transform: scale(1.1);
}

.drive-item:hover .file-item i.fimg {
    color: var(--primary-color);
    transform: scale(1.1);
}

/* Status Icons */
.status-icon {
    font-size: 1.25rem;
    position: absolute;
    top: 1rem;
    right: 1rem;
    color: var(--text-secondary);
    z-index: 10;
    padding: 0.5rem;
    border-radius: 50%;
    background: var(--bg-primary);
    box-shadow: var(--shadow-sm);
}

.status-icon.text-success {
    color: var(--success-color) !important;
}

.status-icon.text-warning {
    color: var(--warning-color) !important;
}

/* Star Icon */
.top-star-icon {
    font-size: 1rem;
    color: var(--text-secondary);
    background: var(--bg-primary);
    border: none;
    outline: none;
    cursor: pointer;
    padding: 0.5rem;
    position: absolute;
    top: 1rem;
    left: 1rem;
    z-index: 10;
    width: 2.25rem;
    height: 2.25rem;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    box-shadow: var(--shadow-sm);
    transition: all 0.2s ease;
}

.top-star-icon.starred {
    color: #fbbf24;
}

.top-star-icon:hover {
    color: #fbbf24;
    transform: scale(1.1);
}

/* Text Elements */
.drive-title {
    font-size: 1rem;
    font-weight: 600;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    margin: 0.5rem 0;
    color: var(--text-primary);
}

.drive-details {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin: 0.25rem 0;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* Actions Container */
.actions-container {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 3.5rem;
    background: var(--bg-primary);
    border-top: 1px solid var(--border-color);
    border-radius: 0 0 1rem 1rem;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    padding: 0 1rem;
    opacity: 0;
    transform: translateY(10px);
    transition: all 0.2s ease;
}

.drive-item:hover .actions-container {
    opacity: 1;
    transform: translateY(0);
}

.actions-container .delete-btn,
.actions-container .rename-btn {
    width: 2.25rem;
    height: 2.25rem;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 1rem;
    color: var(--text-secondary);
    background: var(--bg-primary);
    border: 1px solid var(--border-color);
    border-radius: 0.5rem;
    outline: none;
    cursor: pointer;
    margin-left: 0.5rem;
    transition: all 0.2s ease;
}

.actions-container .delete-btn:hover {
    color: var(--danger-color);
    border-color: var(--danger-color);
    background: #fee2e2;
}

.actions-container .rename-btn:hover {
    color: var(--primary-color);
    border-color: var(--primary-color);
    background: #eef2ff;
}

/* Rejected Items */
.rejected-file {
    background: #fef2f2 !important;
    border-color: var(--danger-color) !important;
    cursor: not-allowed !important;
}

.rejected-file .fimg {
    color: var(--text-secondary) !important;
    opacity: 0.7;
}

.rejected-file .actions-container {
    opacity: 1 !important;
    transform: translateY(0) !important;
    justify-content: center !important;
    background: #fee2e2 !important;
}

.rejected-badge {
    color: var(--danger-color);
    font-weight: 600;
    font-size: 0.875rem;
    text-transform: uppercase;
    padding: 0.25rem 0.75rem;
    border-radius: 0.375rem;
    background: #fee2e2;
}

/* Modal Styling */
.modal-content {
    border-radius: 1rem;
    border: none;
    box-shadow: var(--shadow-lg);
}

.modal-header {
    border-bottom: 1px solid var(--border-color);
    padding: 1.5rem;
    background: var(--bg-primary);
}

.modal-title {
    font-weight: 600;
    color: var(--text-primary);
    font-size: 1.25rem;
}

.modal-body {
    padding: 1.5rem;
}

.modal-footer {
    border-top: 1px solid var(--border-color);
    padding: 1.5rem;
    background: var(--bg-secondary);
}

/* Form Controls */
.form-group label {
    font-weight: 500;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
}

.form-control {
    border: 1px solid var(--border-color);
    border-radius: 0.5rem;
    padding: 0.75rem 1rem;
    font-size: 0.875rem;
    transition: all 0.2s ease;
    background: var(--bg-primary);
    color: var(--text-primary);
}

.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    outline: none;
}

.form-control-file {
    border: 2px dashed var(--border-color);
    border-radius: 0.5rem;
    padding: 1.25rem;
    background: var(--bg-secondary);
    transition: all 0.2s ease;
    cursor: pointer;
}

.form-control-file:hover {
    border-color: var(--primary-color);
    background: #eef2ff;
}

.form-text {
    color: var(--text-secondary);
    font-size: 0.75rem;
    margin-top: 0.375rem;
}

/* Button Styles */
.btn {
    border-radius: 0.5rem;
    padding: 0.75rem 1rem;
    font-weight: 500;
    font-size: 0.875rem;
    transition: all 0.2s ease;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-primary {
    background: var(--primary-color);
    color: white;
}

.btn-primary:hover {
    background: var(--primary-hover);
    color: white;
    transform: translateY(-1px);
}

.btn-secondary {
    background: var(--bg-secondary);
    color: var(--text-primary);
    border: 1px solid var(--border-color);
}

.btn-secondary:hover {
    background: var(--border-color);
    color: var(--text-primary);
}

/* Responsive Design */
@media (max-width: 768px) {
    .drive-container {
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 1rem;
        padding: 0 1rem;
    }

    .drive-item {
        height: 240px;
        padding: 1.25rem;
    }

    .page-header {
        padding: 1.25rem;
        margin: 0 1rem 1.5rem;
    }

    .az-content-body {
        padding: 1.5rem 0;
    }
}

@media (max-width: 576px) {
    .drive-container {
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    .page-header {
        margin: 0 0.5rem 1rem;
        padding: 1rem;
    }

    .page-header h4 {
        font-size: 1.125rem;
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

<div class="az-content az-content-dashboard" style="width: 100%;">
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
          <button class="btn upload-btn ml-3" id="uploadFileBtn">
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