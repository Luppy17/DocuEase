<!DOCTYPE html>
<html lang="en">

<head>

<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<title>DocuEase</title>

<!-- vendor css -->
<link href="../lib/fontawesome-free/css/all.min.css" rel="stylesheet">
<link href="../lib/ionicons/css/ionicons.min.css" rel="stylesheet">
<link href="../lib/typicons.font/typicons.css" rel="stylesheet">
<link href="../lib/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">

<!-- azia CSS -->
<link rel="stylesheet" href="../css/azia.css">

<link rel="icon" type="image/x-icon" href="app.png">

<style>
  .az-logo {
    text-transform: none !important;
  }
</style>

</head>

<body>

<div class="az-header">
  <div class="container">
    <div class="az-header-left">
      <h5 style="font-size: 22px;" class="az-logo"><img src="app.png" style="width:40px; height:auto;">&nbsp;DocuEase</h5>
      <a href="" id="azMenuShow" class="az-header-menu-icon d-lg-none"><span></span></a>
    </div><!-- az-header-left -->
    <div class="az-header-menu">
      <div class="az-header-menu-header">
        <h5 style="font-size: 22px;" class="az-logo"><img src="app.png" style="width:40px; height:auto;">&nbsp;DocuEase</h5>
        <a href="" class="close">&times;</a>
      </div><!-- az-header-menu-header -->
      <ul class="nav">
        <li class="nav-item @if($page == 'dashboard') active @endif">
          <a href="/dashboard-admin" class="nav-link"><i class="typcn typcn-chart-area-outline"></i> Dashboard</a>
        </li>
        <li class="nav-item @if($page == 'users') active @endif">
          <a href="/userslist" class="nav-link"><i class="typcn typcn typcn-user"></i> Users Management</a>
        </li>
        <li class="nav-item @if($page == 'department') active @endif">
          <a href="/departmentlist" class="nav-link"><i class="typcn typcn typcn-flow-merge"></i> Department Management</a>
        </li>
      </ul>
    </div>
    <div class="az-header-right">
    {{ auth()->user()->name }}
      <div class="dropdown az-profile-menu">
        <a href="" class="az-img-user"><img src="{{ asset('10337609.png') }}" alt=""></a>
        <div class="dropdown-menu">
          <div class="az-dropdown-header d-sm-none">
            <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
          </div>
          <div class="az-header-profile">
            <div class="az-img-user">
              <img src="{{ asset('10337609.png') }}" alt="">
            </div>
            <h6>{{ auth()->user()->name }}</h6>
            <span>{{ auth()->user()->role }}</span>
            {{-- <span style="font-weight: bold; font-size:10px;">{{ auth()->user()->department->dept_name }}</span> --}}
          </div>
          <a href="/logout" class="dropdown-item"><i class="typcn typcn-power-outline"></i> Sign Out</a>
        </div>
      </div>
    </div>
  </div>
</div>