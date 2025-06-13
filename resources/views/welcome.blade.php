<!DOCTYPE html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="author" content="BootstrapDash">

    <title>DocuEase</title>

    <!-- vendor css -->
    <link href="../lib/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="../lib/typicons.font/typicons.css" rel="stylesheet">

    <!-- azia CSS -->
    <link rel="stylesheet" href="../css/azia.css">

    <link rel="icon" type="image/x-icon" href="app.png">

    <style>
      .az-column-signup-left{
        background-image: url("Lovepik_com-402697088-big-data-chip-storage-service.jpg");
        background-repeat:no-repeat;
background-size:cover;
      }

      .az-logo {
        text-transform: none !important;
      }
    </style>

    <!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function() {
        @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif

        @if(Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif
    });
</script>


  </head>
  <body class="az-body">

    <div class="az-signup-wrapper">
      <div class="az-column-signup-left">

      </div><!-- az-column-signup-left -->
      <div class="az-column-signup">
        <h1 class="az-logo"><img src="app.png" style="width:50px; height:auto;">&nbsp;DocuEase</h1>
        <div class="az-signup-header">
          <h2>Login</h2>
          <h4>Login Now to Access your Drive</h4>

          <form action="/login" method="POST">
            @csrf
            <div class="form-group">
              <label>Role</label>
              <select class="form-control" name="role" id="role" required>
                <option value="" selected disabled>-- Select Role --</option>
                <option value="System Admin">System Admin</option>
                <option value="Staff">Staff</option>
                <option value="File Admin">File Admin</option>
                <option value="Manager">Manager</option>
              </select>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="text" class="form-control" name="email" id="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
            </div>
            <button class="btn btn-az-primary btn-block">Login</button>
            <div class="row row-xs">
            </div>
          </form>
        </div>
        <div class="az-signup-footer">
        </div>
      </div>
    </div>

    <script src="../lib/jquery/jquery.min.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/ionicons/ionicons.js"></script>
    <script src="../js/jquery.cookie.js" type="text/javascript"></script>

    <script src="../js/azia.js"></script>
    <script>
      $(function(){
        'use strict'

      });
    </script>
  </body>
</html>
