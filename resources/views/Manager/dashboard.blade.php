@php $page = 'dashboard'; @endphp
@include('include.appmanager')

<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
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

  .bg-warning {
    background-color: #f6c23e !important;
  }

  .bg-success {
    background-color: #1cc88a !important;
  }

  .bg-info {
    background-color: #36b9cc !important;
  }

  .bg-danger {
    background-color: #e74a3b !important;
  }
</style>

<div class="az-content az-content-dashboard">
  <div class="container">
    <div class="az-content-body">

      <div class="az-dashboard-one-title mb-4">
        <h2 class="az-dashboard-title">
          Hi {{ auth()->user()->name }}, Welcome Back!
        </h2>
      </div>

      <div class="row">
        <div class="col-lg-4 col-xl-3 mb-4">
          <div class="card analytics-card">
            <div class="card-header bg-transparent border-bottom">
              <h6 class="card-title mb-0">Pending Upload Approval</h6>
            </div>
            <div class="card-body d-flex align-items-center">
              <div class="icon-container bg-warning">
                <i class="fa-solid fa-upload"></i>
              </div>
              <h4 class="mb-0">{{ $pendingApprovalDocument }}</h4>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-xl-3 mb-4">
          <div class="card analytics-card">
            <div class="card-header bg-transparent border-bottom">
              <h6 class="card-title mb-0">Pending View Approval</h6>
            </div>
            <div class="card-body d-flex align-items-center">
              <div class="icon-container bg-primary">
                <i class="fa-solid fa-eye-slash"></i>
              </div>
              <h4 class="mb-0">{{ $pendingApprovalViewDocument }}</h4>
            </div>
          </div>
        </div>
      </div>

      <div class="row mt-3">
        <div class="col-lg-4 col-xl-3 mb-4">
          <div class="card analytics-card text-center p-3">
            <div class="card-header bg-transparent border-bottom">
              <h6 class="card-title mb-0">Dept Logins</h6>
            </div>
            <div class="card-body">
              <h4 class="mb-0">{{ $loginCount }}</h4>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-xl-3 mb-4">
          <div class="card analytics-card text-center p-3">
            <div class="card-header bg-transparent border-bottom">
              <h6 class="card-title mb-0">Dept Logouts</h6>
            </div>
            <div class="card-body">
              <h4 class="mb-0">{{ $logoutCount }}</h4>
            </div>
          </div>
        </div>
      </div>

      <div class="row mt-3">
        <div class="col-md-6 mb-4">
          <div class="card analytics-card">
            <div class="card-header bg-transparent border-bottom">
              <h6 class="card-title mb-0">Recent Uploads</h6>
            </div>
            <ul class="list-group list-group-flush">
              @foreach($recentUploads as $log)
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>{{ \App\Models\User::find($log->created_by)?->name }}</span>
                <span>{{ $log->reference }}</span>
                <small class="text-muted">
                  {{ \Carbon\Carbon::parse($log->created_at)->format('M d, H:i') }}
                </small>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>


      <div class="row mt-5">
        <div class="col-md-6 mb-4">
          <div class="card analytics-card p-4">
            <h6 class="mb-3">Logins vs Logouts (7 days)</h6>
            <canvas id="loginLogoutChart" height="200"></canvas>
          </div>
        </div>

        <div class="col-md-6 mb-4">
          <div class="card analytics-card p-4">
            <h6 class="mb-3">Uploads by Staff</h6>
            <canvas id="uploadsUserChart" height="200"></canvas>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

@include('include.footer')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  new Chart(document.getElementById('loginLogoutChart'), {
    type: 'line',
    data: {
      labels: @json($chartLabels),
      datasets: [{
          label: 'Logins',
          data: @json($chartLogins),
          fill: false,
          tension: 0.3
        },
        {
          label: 'Logouts',
          data: @json($chartLogouts),
          fill: false,
          tension: 0.3
        }
      ]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 1,
            precision: 0
          }
        }
      }
    }
  });

  new Chart(document.getElementById('uploadsUserChart'), {
    type: 'bar',
    data: {
      labels: @json($uploadUserLabels),
      datasets: [{
        label: 'Uploads',
        data: @json($uploadUserData),
        borderRadius: 4
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 1,
            precision: 0
          }
        },
        x: {
          ticks: {
            autoSkip: false
          }
        }
      },
      plugins: {
        legend: {
          display: false
        }
      }
    }
  });
</script>