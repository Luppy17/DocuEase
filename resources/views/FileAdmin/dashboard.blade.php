@php
$page = 'dashboard';
@endphp
@include('include.appfadmin')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

<style>
  .analytics-card {
    transition: box-shadow 0.3s;
    border-radius: 12px;
  }
  .analytics-card:hover {
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
  }
  .icon-container {
    width: 60px;
    height: 60px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 8px;
    margin-right: 15px;
  }
  .icon-container i {
    font-size: 24px;
    color: white;
  }
  .bg-primary {
    background-color: #4e73df !important;
  }
  .bg-purple {
    background-color: #6f42c1 !important;
  }
</style>

<div class="az-content az-content-dashboard">
  <div class="container">
    <div class="az-content-body">
      <div class="az-dashboard-one-title mb-4">
        <h2 class="az-dashboard-title">Hi {{ auth()->user()->name }}, Welcome Back!</h2>
      </div>
      <div class="row">
        <div class="col-lg-4 col-xl-3">
          <div class="card analytics-card">
            <div class="card-header bg-transparent border-bottom">
              <h6 class="card-title mb-0">Pending Document Upload Approval</h6>
            </div>
            <div class="card-body">
              <div class="d-flex align-items-center mb-3">
                <div class="icon-container bg-warning">
                <i class="fa-solid fa-check-double"></i>
                </div>
                <div>
                  <h4 class="mb-0">{{ $pendingApprovalDocument }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-xl-3">
          <div class="card analytics-card">
            <div class="card-header bg-transparent border-bottom">
            <h6 class="card-title mb-0">Pending Document View Approval</h6>
            </div>
            <div class="card-body">
              <div class="d-flex align-items-center mb-3">
                <div class="icon-container bg-primary">
                <i class="fa-solid fa-check-to-slot"></i>
                </div>
                <div>
                  <h4 class="mb-0">{{ $pendingApprovalViewDocument }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

@include('include.footer')