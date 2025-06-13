<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>DocuEase</title>

    <link href="{{ asset('lib/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/typicons.font/typicons.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/azia.css') }}">

    <link rel="icon" type="image/x-icon" href="{{ asset('app.png') }}">

    <style>
      .swal2-container{
          z-index: 9999999 !important;
      }
      footer{
        z-index: 9999 !important;
      }
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        body {
            font-family: 'Google Sans', 'Roboto', Arial, sans-serif;
            background-color: #f6f6f6;
            color: #333;
        }

        .app-container {
            display: flex;
            flex-direction: column;
            height: 100%;
            width: 100%;
        }

        .az-header {
            flex-shrink: 0;
            z-index: 1001;
            background-color: #202124 !important;
            color: white !important;
        }

        .app-body-wrapper {
            display: flex;
            flex-grow: 1;
            overflow: hidden;
            width: 100%;
        }

        .az-sidebar {
            width: 250px;
            background-color: #202124;
            color: #bdc1c6;
            padding: 10px 0;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            box-shadow: 2px 0 5px rgba(0,0,0,0.2);
            z-index: 1000;
        }

        .az-sidebar-header {
            padding: 20px 15px;
            display: flex;
            align-items: center;
        }

        .az-sidebar-header .az-logo {
            display: flex;
            align-items: center;
            color: #e8eaed;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none;
        }

        .az-sidebar-header .az-logo span {
            width: 24px;
            height: 24px;
            background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0iIzQyODVGNCYjM0I1MzY3JjIzNEE4NCI+PHBhdGggZD0iTTIgMTcuNUw0LjQ3IDEzLjIzIDIuNTggMTAuMjMgMEwxNy41IDBDMTguMjMgMCAxOC44OC4yIDE5LjQ2LjU4TDI0IDYuNTEgNy4yMSAyNCAwIDIxLjgzIDE1LjkgNy4xNkw3LjcxIDUuMzUgMiAxNy41eiIvPjwvc3ZnPg==');
            background-size: contain;
            background-repeat: no-repeat;
            margin-right: 10px;
        }


        .az-sidebar-loggedin {
            padding: 15px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            color: #bdc1c6;
        }

        .az-sidebar-loggedin .az-img-user {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 10px;
            flex-shrink: 0;
            background-color: #5f6368;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: white;
        }

        .az-sidebar-loggedin .az-img-user img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .az-sidebar-loggedin .az-loggedin-info h6 {
            margin: 0;
            font-size: 14px;
            color: #e8eaed;
        }

        .az-sidebar-loggedin .az-loggedin-info span {
            font-size: 12px;
            color: #bdc1c6;
        }

        .az-sidebar-nav {
            flex-grow: 1;
            padding: 10px 0;
        }

        .az-sidebar-nav .nav {
            flex-direction: column;
        }

        .az-sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            color: #bdc1c6;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.2s ease, color 0.2s ease;
            border-radius: 0 25px 25px 0;
            margin-right: 10px;
        }

        .az-sidebar-nav .nav-link i {
            font-size: 18px;
            margin-right: 15px;
            width: 24px;
            text-align: center;
        }

        .az-sidebar-nav .nav-link:hover {
            background-color: #3c4043;
            color: #e8eaed;
        }


        .az-sidebar-footer {
            padding: 15px;
            border-top: 1px solid rgba(255,255,255,0.1);
            text-align: center;
            flex-shrink: 0;
            color: #bdc1c6;
            font-size: 12px;
        }

        .az-sidebar-storage {
            margin-top: 15px;
            padding: 10px;
            background-color: #3c4043;
            border-radius: 8px;
        }

        .az-sidebar-storage p {
            margin: 10px 0 5px;
            font-size: 13px;
            color: #bdc1c6;
        }

        .az-sidebar-storage .az-storage-indicator {
            height: 6px;
            background-color: rgba(255,255,255,0.2);
            border-radius: 3px;
            overflow: hidden;
        }

        .az-sidebar-storage .az-storage-progress {
            height: 100%;
            background-color: #4285f4;
            border-radius: 3px;
        }

        .az-sidebar-storage .btn {
            width: 100%;
            padding: 8px;
            font-size: 13px;
            border-radius: 20px;
            border-color: #bdc1c6;
            color: #bdc1c6;
            background: transparent;
            transition: all 0.2s ease;
            margin-top: 10px;
        }

        .az-sidebar-storage .btn:hover {
            background-color: #bdc1c6;
            color: #202124;
        }
        
        .sidebar-new-button-section {
            padding: 10px 20px;
            margin-top: 10px;
        }

        .sidebar-new-button {
            background-color: #202124;
            color: #e8eaed;
            border: 1px solid #5f6368;
            border-radius: 20px;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
            width: 100%;
        }

        .sidebar-new-button:hover {
            background-color: #3e4042;
            box-shadow: 0 1px 6px rgba(0, 0, 0, 0.4);
        }

        .sidebar-new-button i {
            font-size: 20px;
            margin-right: 10px;
            color: #8ab4f8;
        }

        .az-content { 
            padding: 20px;
            max-height: 100px !important;
            overflow: scroll !important;
        }

        .drive-item {
          width: 180px;
          height: 210px;
          margin: 12px;
          border-radius: 10px;
          box-shadow: 0 3px 6px rgba(0,0,0,0.12);
          text-align: center;
          cursor: pointer;
          display: inline-block;
          position: relative;
          vertical-align: top;
          transition: all 0.2s ease;
          background-color: #ffffff;
        }

        .drive-item:hover {
          transform: scale(1.03);
          background-color: #f4f8ff;
        }

        .drive-item i.main-icon {
          font-size: 50px;
          margin-top: 20px;
          color: #4e73df;
        }

        .folder-item i.fimg{
          font-size: 80px;
          color: #4e73df;
          margin-top: 15px;
        }

        .file-item i.fimg{
          font-size: 80px;
          color:rgb(0, 0, 0);
          margin-top: 15px;
        }

        .status-icon {
          font-size: 24px;
          position: absolute;
          top: 8px;
          right: 8px;
        }

        .drive-title {
          margin-top: 10px;
          font-size: 15px;
          font-weight: 600;
          overflow: hidden;
          text-overflow: ellipsis;
          white-space: nowrap;
          padding: 0 8px;
        }

        .drive-details {
          font-size: 12px;
          color: #606060;
          margin-top: 5px;
          padding: 0 8px;
          overflow: hidden;
          text-overflow: ellipsis;
          white-space: nowrap;
        }

        .delete-btn {
          position: absolute;
          bottom: 8px;
          right: 8px;
          font-size: 16px;
          color: #dc3545;
          cursor: pointer;
          background: transparent;
          border: none;
        }

        .rename-btn {
          position: absolute;
          bottom: 8px;
          right: 40px;
          font-size: 18px;
          color: black;
          cursor: pointer;
          background: transparent;
          border: none;
        }

        .delete-btn:hover {
          color: #b02a37;
        }

        .delete-btn{
          font-size: 24px;
        }

        .list-view {
            display: block;
        }

        .list-view .drive-item {
            width: 1150px !important;
            height: auto;
            margin: 5px 0;
            display: flex;
            align-items: center;
            text-align: left;
            padding: 10px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            background-color: #ffffff;
        }

        .list-view .drive-item:hover {
          transform: none;
          background-color: #f4f8ff;
        }


        .list-view .drive-item .fimg,
        .list-view .drive-item .main-icon {
            font-size: 30px;
            margin-top: 0;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .list-view .drive-item .drive-title {
            margin-top: 0;
            font-size: 16px;
            flex-grow: 1;
            padding: 0;
            white-space: normal;
            text-overflow: ellipsis;
            overflow: hidden;
            max-width: 25%;
        }

        .list-view .drive-item .drive-details {
            margin-top: 0;
            flex-grow: 1;
            padding: 0 15px;
            max-width: 25%;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
            font-size: 13px;
        }

        .list-view .drive-item .status-icon {
            position: static;
            margin-left: auto;
            margin-right: 15px;
        }

        .list-view .drive-item .rename-btn,
        .list-view .drive-item .delete-btn {
            position: static;
            margin-left: 10px;
            font-size: 20px;
            bottom: auto;
            right: auto;
            flex-shrink: 0;
        }
        .list-view .drive-item .delete-btn {
            margin-right: 0;
        }

        .custom-profile-dropdown {
            position: relative;
            display: inline-block;
        }

        .custom-dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            z-index: 1000;
            display: none;
            min-width: 10rem;
            padding: 0;
            margin: .125rem 0 0;
            font-size: 1rem;
            color: #212529;
            text-align: left;
            list-style: none;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0,0,0,.15);
            border-radius: .25rem;
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.175);
        }

        .custom-dropdown-menu.show {
            display: block;
        }

        .google-style-menu {
            background-color: #202124;
            color: #e8eaed;
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
            width: 320px;
            min-width: 320px;
            max-width: 320px;
            overflow: hidden;
        }

        .google-profile-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .google-profile-header .email-address {
            font-size: 14px;
            color: #bdc1c6;
            flex-grow: 1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .google-profile-header .close-btn {
            background: none;
            border: none;
            color: #bdc1c6;
            font-size: 20px;
            cursor: pointer;
            padding: 0 5px;
            transition: color 0.2s;
        }

        .google-profile-header .close-btn:hover {
            color: #fff;
        }

        .google-profile-main-info {
            text-align: center;
            padding: 24px 16px 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .user-avatar-container {
            position: relative;
            width: 96px;
            height: 96px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 16px;
            background-color: #5f6368;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-main-avatar {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .user-avatar-container .camera-icon {
            position: absolute;
            bottom: 0;
            right: 0;
            background-color: #8ab4f8;
            color: #202124;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            border: 2px solid #202124;
            cursor: pointer;
        }

        .user-greeting {
            font-size: 20px;
            font-weight: 500;
            margin-bottom: 16px;
            color: #e8eaed;
        }

        .manage-account-btn {
            display: inline-block;
            padding: 8px 16px;
            border: 1px solid #5f6368;
            border-radius: 20px;
            color: #8ab4f8;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.2s, color 0.2s;
        }

        .manage-account-btn:hover {
            background-color: rgba(138, 180, 248, 0.1);
            color: #8ab4f8;
            text-decoration: none;
        }

        .google-menu-actions {
            padding: 8px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .action-item {
            display: flex;
            align-items: center;
            padding: 12px 24px;
            color: #bdc1c6;
            text-decoration: none;
            font-size: 15px;
            transition: background-color 0.2s;
        }

        .action-item i {
            margin-right: 20px;
            width: 24px;
            text-align: center;
            font-size: 18px;
            color: #bdc1c6;
        }

        .action-item:hover {
            background-color: #3c4043;
            color: #e8eaed;
            text-decoration: none;
        }

        .google-storage-info {
            display: flex;
            align-items: center;
            padding: 12px 24px;
            font-size: 13px;
            color: #bdc1c6;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .google-storage-info i {
            margin-right: 15px;
            font-size: 18px;
            color: #8ab4f8;
        }

        .google-menu-footer {
            padding: 12px 24px;
            text-align: center;
            font-size: 12px;
            color: #bdc1c6;
        }

        .footer-link {
            color: #bdc1c6;
            text-decoration: none;
            margin: 0 8px;
            transition: color 0.2s;
        }

        .footer-link:hover {
            color: #e8eaed;
            text-decoration: underline;
        }

        .dot-separator {
            color: #5f6368;
        }

        .az-dropdown-header, .az-header-profile {
        }

        .az-content-wrapper{
          min-width: 1000px !important;
        }
    </style>

</head>

<body>

    <div class="app-container">
        <div class="az-header">
            <div class="container">
                <div class="az-header-left">
                    <a href="" id="azMenuShow" class="az-header-menu-icon d-lg-none"><span></span></a>
                </div>
                <div class="az-header-menu">
                    <div class="az-header-menu-header">
                        <a href="" class="close">&times;</a>
                    </div>
                    <ul class="nav">
                    </ul>
                </div>
                <div class="az-header-right" style="margin-right: -110px;">
                    <div class="d-flex align-items-center">
                        <div class="pr-3 text-white d-none d-md-block">
                            {{ auth()->user()->name ?? 'Guest' }}
                        </div>
                    <div class="custom-profile-dropdown">
            <a href="#" id="profileDropdownToggle" class="az-img-user">
                <img src="{{ asset('10337609.png') }}" alt="">
            </a>
            <div id="profileDropdownMenu" class="custom-dropdown-menu google-style-menu">
                <div class="google-profile-header">
                    <span class="email-address">{{ auth()->user()->email ?? 'user@example.com' }}</span>
                    <button type="button" class="close-btn" aria-label="Close" id="closeDropdownBtn">
                        <i class="fas fa-times"></i> </button>
                </div>
                <div class="google-profile-main-info">
                    <div class="user-avatar-container">
                        <img src="{{ asset('10337609.png') }}" alt="User Avatar" class="user-main-avatar">
                        <span class="camera-icon"><i class="fas fa-camera"></i></span>
                    </div>
                    <h6 class="user-greeting">Hi, {{ auth()->user()->name ?? 'User' }}!</h6>
                    <a href="/my-account" class="manage-account-btn">Manage your Account</a>
                </div>

                <div class="google-menu-actions">
                    <a href="/logout" class="action-item sign-out-btn">
                        <i class="fas fa-sign-out-alt"></i> Sign out
                    </a>
                </div>


                <div class="google-menu-footer">
                </div>
            </div>
        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-body-wrapper">
            <div class="az-sidebar">
                <div class="az-sidebar-header">
                   <h4 style="font-size: 22px;"><img src="{{ asset('app.png') }}" style="width:40px; height:auto; text-transform:none;">&nbsp;DocuEase</h4>
                </div><div class="sidebar-new-button-section">
               
                </div>

                <div class="az-sidebar-nav">
                    <nav class="nav">
<a href="/dashboard-staff" class="nav-link">
    <i class="fas fa-home"></i> Home
</a>

<div class="sub-nav">
    <a href="/uploaded-by-me" class="nav-link">
        <i class="fas fa-upload"></i> Uploaded by me
    </a>
    <a href="/recent-files" class="nav-link">
        <i class="fas fa-history"></i> Recent
    </a>
    <a href="/starred-files" class="nav-link">
        <i class="fas fa-star"></i> Starred
    </a>
    <a href="/approved-files" class="nav-link">
        <i class="fas fa-check-circle"></i> Approved documents
    </a>
    <a href="/rejected-files" class="nav-link">
        <i class="fas fa-times-circle"></i> Rejected documents
    </a>
    <a href="/deleted-files" class="nav-link">
        <i class="fas fa-trash-alt"></i> Bin
    </a>
</div>

<a href="/system-logs" class="nav-link">
    <i class="fas fa-clipboard-list"></i> Logs
</a>
                    </nav>
                </div></div>