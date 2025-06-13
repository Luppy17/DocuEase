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

  .delete-btn,
  .rename-btn { 

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

  .delete-btn:hover {
    color: #dc3545;
  }

  .rename-btn:hover {
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
</style>


<div class="az-content az-content-dashboard">
  <div class="container">
    <div class="az-content-body">
      <div class="az-dashboard-one-title mb-4">
      </div>

      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <button class="btn btn-outline-secondary" id="backButton">
            <i class="fas fa-arrow-left mr-2"></i>Back
          </button>
          <h4 class="d-inline-block ml-3 mb-0">Current Folder: {{ $currentFolder->folder_name ?? 'My Drive' }}</h4>
        </div>
       
      </div>
       <button class="btn btn-primary" id="uploadFileBtn">Upload File</button>

      <hr>

      <h3 class="mb-3">My Drive</h3>

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

       <div class="drive-item file-item @if($doc->status == 'Rejected') rejected-file @endif" @if($doc->status == 'Rejected') style="background-color: #f0f0f0;" @endif>
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

          @if($doc->status == 'Rejected')
          <div class="actions-container">
            <span style="color:red; font-weight:bolder; font-size:14px; margin-right: auto; margin-left: auto;">REJECTED</span>
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


<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
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
  $(document).ready(function() {

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
      $('#uploadModal').modal('show');
    });

    $('.rename-file').click(function(e) {
      e.stopPropagation();
      editMode = true;
      currentFileId = $(this).data('id');

      $.get('../../files/get/' + currentFileId, function(data) {
        $('#uploadModalLabel').text('Edit File');
        $('#document_title').val(data.document_title);
        $('#document_file').prop('required', false);
        $('#uploadModal').modal('show');
      }).fail(() => Swal.fire('Error', 'Unable to fetch file data', 'error'));
    });

    // Corrected line: Removed the LaTeX math block
$('#submitUpload').click(function() {
  const formData = new FormData($('#uploadForm')[0]);

      if (editMode && !$('#document_file')[0].files.length) {
        formData.delete('document_file');
      }

      let url = editMode ? '../../files/edit/' + currentFileId : '../../files/upload';

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

    // Star/Unstar functionality for this page
    $('.star-btn').click(function(e) {
        e.stopPropagation(); // Prevent the main file click action
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

  });
</script>