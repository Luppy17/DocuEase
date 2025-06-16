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
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        .swal2-container {
            z-index: 9999999 !important;
        }

        footer {
            z-index: 9999 !important;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        body {
            font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #1a1a1a;
            line-height: 1.6;
        }

        .app-container {
            display: flex;
            flex-direction: column;
            height: 100vh;
            width: 100%;
        }

        /* Modern Header Styling */
        .az-header {
            flex-shrink: 0;
            z-index: 1001;
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            color: #1a1a1a !important;
            transition: all 0.3s ease;
        }

        .az-header:hover {
            background: rgba(255, 255, 255, 0.98) !important;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .app-body-wrapper {
            display: flex;
            flex-grow: 1;
            overflow: hidden;
            width: 100%;
            min-height: 0;
        }

        /* Modern Sidebar Styling */
        .az-sidebar {
            width: 280px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 255, 255, 0.2);
            color: #4a5568;
            padding: 20px 0;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            box-shadow: 8px 0 32px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .az-sidebar:hover {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 12px 0 40px rgba(0, 0, 0, 0.15);
        }

        .az-sidebar-header {
            padding: 20px 24px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(74, 85, 104, 0.1);
            margin-bottom: 10px;
        }

        .az-sidebar-header h4 {
            display: flex;
            align-items: center;
            color: #2d3748;
            font-size: 24px;
            font-weight: 700;
            text-decoration: none;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            transition: all 0.3s ease;
            margin: 0;
        }

        .az-sidebar-header h4:hover {
            transform: scale(1.05);
        }

        .az-sidebar-header h4 img {
            width: 32px;
            height: 32px;
            margin-right: 12px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .az-sidebar-loggedin {
            padding: 20px 24px;
            border-bottom: 1px solid rgba(74, 85, 104, 0.1);
            display: flex;
            align-items: center;
            color: #4a5568;
            margin-bottom: 10px;
        }

        .az-sidebar-loggedin .az-img-user {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            overflow: hidden;
            margin-right: 16px;
            flex-shrink: 0;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 16px rgba(102, 126, 234, 0.3);
            transition: all 0.3s ease;
        }

        .az-sidebar-loggedin .az-img-user:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .az-sidebar-loggedin .az-img-user img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .az-sidebar-loggedin .az-loggedin-info h6 {
            margin: 0;
            font-size: 16px;
            font-weight: 600;
            color: #2d3748;
        }

        .az-sidebar-loggedin .az-loggedin-info span {
            font-size: 14px;
            color: #718096;
        }

        .az-sidebar-nav {
            flex-grow: 1;
            padding: 0 16px;
        }

        .az-sidebar-nav .nav {
            flex-direction: column;
            gap: 4px;
        }

        .az-sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            padding: 14px 16px;
            color: #4a5568;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            transition: all 0.3s ease;
            border-radius: 12px;
            margin: 2px 0;
            position: relative;
            overflow: hidden;
        }

        .az-sidebar-nav .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 0;
            background: linear-gradient(135deg, #667eea, #764ba2);
            transition: width 0.3s ease;
            z-index: -1;
        }

        .az-sidebar-nav .nav-link:hover::before {
            width: 100%;
        }

        .az-sidebar-nav .nav-link i {
            font-size: 18px;
            margin-right: 16px;
            width: 24px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .az-sidebar-nav .nav-link:hover {
            color: white;
            transform: translateX(4px);
            box-shadow: 0 4px 16px rgba(102, 126, 234, 0.3);
        }

        .az-sidebar-nav .nav-link.active {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            box-shadow: 0 4px 16px rgba(102, 126, 234, 0.3);
        }

        .az-sidebar-footer {
            padding: 20px 24px;
            border-top: 1px solid rgba(74, 85, 104, 0.1);
            text-align: center;
            flex-shrink: 0;
            color: #718096;
            font-size: 13px;
        }

        .sidebar-new-button-section {
            padding: 16px 24px;
            margin-bottom: 10px;
        }

        .sidebar-new-button {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 16px;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 16px rgba(102, 126, 234, 0.3);
            width: 100%;
        }

        .sidebar-new-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(102, 126, 234, 0.4);
        }

        .sidebar-new-button i {
            font-size: 20px;
            margin-right: 12px;
            color: white;
        }

        /* Content Area - FIXED */
        .az-content-wrapper {
            flex: 1;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border-radius: 24px 0 0 0;
            overflow-y: auto;
            min-height: 0;
        }

        .az-content {
            padding: 32px;
            height: auto;
            min-height: 100%;
            overflow: visible;
        }

        .drive-item {
            width: 200px;
            height: 230px;
            margin: 12px;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            text-align: center;
            cursor: pointer;
            display: inline-block;
            position: relative;
            vertical-align: top;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .drive-item:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.15);
            background: rgba(255, 255, 255, 0.95);
        }

        .drive-item i.main-icon {
            font-size: 50px;
            margin-top: 20px;
            color: #667eea;
            transition: all 0.3s ease;
        }

        .folder-item i.fimg {
            font-size: 80px;
            color: #667eea;
            margin-top: 15px;
            transition: all 0.3s ease;
        }

        .file-item i.fimg {
            font-size: 80px;
            color: #718096;
            margin-top: 15px;
            transition: all 0.3s ease;
        }

        .drive-item:hover .folder-item i.fimg,
        .drive-item:hover .file-item i.fimg {
            color: #764ba2;
            transform: scale(1.1);
        }

        .status-icon {
            font-size: 24px;
            position: absolute;
            top: 8px;
            right: 8px;
            transition: all 0.3s ease;
        }

        .drive-title {
            margin-top: 10px;
            font-size: 14px;
            font-weight: 600;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            padding: 0 12px;
            color: #2d3748;
            line-height: 1.3;
            max-width: 100%;
        }

        .drive-details {
            font-size: 11px;
            color: #4a5568;
            font-weight: 500;
            margin-top: 3px;
            padding: 0 12px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            line-height: 1.2;
            max-width: 100%;
        }

        .delete-btn {
            position: absolute;
            bottom: 8px;
            right: 8px;
            font-size: 16px;
            color: #718096;
            cursor: pointer;
            background: transparent;
            border: none;
            transition: all 0.3s ease;
            padding: 8px;
            border-radius: 8px;
        }

        .rename-btn {
            position: absolute;
            bottom: 8px;
            right: 40px;
            font-size: 18px;
            color: #718096;
            cursor: pointer;
            background: transparent;
            border: none;
            transition: all 0.3s ease;
            padding: 8px;
            border-radius: 8px;
        }

        .delete-btn:hover {
            color: #e53e3e;
            background: rgba(229, 62, 62, 0.1);
        }

        .rename-btn:hover {
            color: #3182ce;
            background: rgba(49, 130, 206, 0.1);
        }

        .delete-btn {
            font-size: 20px;
        }

        .list-view {
            display: block;
        }

        .list-view .drive-item {
            width: 100% !important;
            height: auto;
            margin: 5px 0;
            display: grid;
            grid-template-columns: auto 50px 1fr 1fr 1fr auto auto auto;
            gap: 16px;
            align-items: center;
            text-align: left;
            padding: 16px 20px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
            background: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
        }

        .list-view .drive-item:hover {
            transform: none;
            background: rgba(255, 255, 255, 0.95);
        }

        .list-view .drive-item .fimg,
        .list-view .drive-item .main-icon {
            grid-column: 1;
            font-size: 32px;
            margin: 0;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .list-view .drive-item .drive-title {
            grid-column: 3;
            margin: 0;
            font-size: 16px;
            font-weight: 600;
            padding: 0;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
            min-width: 0;
        }

        .list-view .drive-item .drive-details:nth-of-type(1) {
            grid-column: 4;
            margin: 0;
            font-size: 14px;
            color: #4a5568;
            font-weight: 500;
            padding: 0;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
            min-width: 0;
        }

        .list-view .drive-item .drive-details:nth-of-type(2) {
            grid-column: 5;
            margin: 0;
            font-size: 14px;
            color: #4a5568;
            font-weight: 500;
            padding: 0;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
            min-width: 0;
        }

        .list-view .drive-item .status-icon {
            grid-column: 6;
            position: static;
            margin: 0;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px;
        }

        .list-view .drive-item .rename-btn,
        .list-view .drive-item .delete-btn {
            grid-column: 7;
            position: static;
            margin: 0;
            font-size: 16px;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .list-view .drive-item .delete-btn {
            grid-column: 8;
        }

        /* Dropdown Menu Styles from appfadmin */
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
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.15);
        }

        .custom-dropdown-menu.show {
            display: block;
        }

        .google-style-menu {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            color: #2d3748;
            border: none;
            border-radius: 16px;
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.15);
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
            border-bottom: 1px solid rgba(74, 85, 104, 0.1);
        }

        .google-profile-header .email-address {
            font-size: 14px;
            color: #718096;
            flex-grow: 1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .google-profile-header .close-btn {
            background: none;
            border: none;
            color: #718096;
            font-size: 20px;
            cursor: pointer;
            padding: 0 5px;
            transition: color 0.2s;
            border-radius: 8px;
        }

        .google-profile-header .close-btn:hover {
            color: #2d3748;
            background: rgba(74, 85, 104, 0.1);
        }

        .google-profile-main-info {
            text-align: center;
            padding: 24px 16px 16px;
            border-bottom: 1px solid rgba(74, 85, 104, 0.1);
        }

        .user-avatar-container {
            position: relative;
            width: 96px;
            height: 96px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 16px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 24px rgba(102, 126, 234, 0.3);
        }

        .user-main-avatar {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .user-greeting {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 16px;
            color: #2d3748;
        }

        .manage-account-btn {
            display: inline-block;
            padding: 8px 16px;
            border: 2px solid rgba(102, 126, 234, 0.3);
            border-radius: 20px;
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .manage-account-btn:hover {
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
            text-decoration: none;
            transform: translateY(-1px);
        }

        .google-menu-actions {
            padding: 8px 0;
            border-bottom: 1px solid rgba(74, 85, 104, 0.1);
        }

        .action-item {
            display: flex;
            align-items: center;
            padding: 12px 24px;
            color: #4a5568;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .action-item i {
            margin-right: 20px;
            width: 24px;
            text-align: center;
            font-size: 18px;
            color: #718096;
        }

        .action-item:hover {
            background: rgba(74, 85, 104, 0.1);
            color: #2d3748;
            text-decoration: none;
        }

        .google-menu-footer {
            padding: 12px 24px;
            text-align: center;
            font-size: 12px;
            color: #718096;
        }

        .az-header .az-img-user {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            overflow: hidden;
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .az-header .az-img-user:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 16px rgba(102, 126, 234, 0.4);
        }

        .az-header .az-img-user img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .footer-link {
            color: #718096;
            text-decoration: none;
            margin: 0 8px;
            transition: color 0.2s;
        }

        .footer-link:hover {
            color: #2d3748;
            text-decoration: underline;
        }

        .dot-separator {
            color: #cbd5e0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .az-sidebar {
                width: 250px;
            }

            .drive-item {
                width: 160px;
                height: 190px;
            }

            .az-content {
                padding: 20px;
            }
        }
        </style>
    </head>
    <body>
        <div class="app-container">
            <div class="az-header">
                <div class="container">
                    <div class="az-header-left">
                        <a href="" id="azMenuShow" class="az-header-menu-icon d-lg-none">
                            <span></span>
                        </a>
                    </div>
                    <div class="az-header-menu">
                        <div class="az-header-menu-header">
                            <a href="" class="close">&times;</a>
                        </div>
                        <ul class="nav"></ul>
                    </div>
                    <div class="az-header-right" style="margin-right: -110px;">
                        <div class="d-flex align-items-center">
                            <div class="pr-3 d-none d-md-block" style="color: #2d3748; font-weight: 600;">
                                {{ auth()->user()->name ?? 'Guest' }}
                            </div>
                            <div class="custom-profile-dropdown">
                                <a href="#" id="profileDropdownToggle" class="az-img-user">
                                    <img src="{{ auth()->user()->profile_photo_url }}" alt="">
                                </a>
                                <div id="profileDropdownMenu" class="custom-dropdown-menu google-style-menu">
                                    <div class="google-profile-header">
                                        <span class="email-address">{{ auth()->user()->email ?? 'user@example.com' }}</span>
                                        <button type="button" class="close-btn" aria-label="Close" id="closeDropdownBtn">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                <div class="google-profile-main-info">
                                    <div class="user-avatar-container">
                                        <img src="{{ auth()->user()->profile_photo_url }}" alt="User Avatar" class="user-main-avatar">
                                    </div>
                                    <h6 class="user-greeting">Hi, {{ auth()->user()->name ?? 'User' }}!</h6>
                                    <a href="/my-account" class="manage-account-btn">Manage your Account</a>
                                </div>
                                <div class="google-menu-actions">
                                    <a href="/logout" class="action-item sign-out-btn">
                                    <i class="fas fa-sign-out-alt"></i> Sign out </a>
                                </div>
                                <div class="google-menu-footer"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-body-wrapper">
            <div class="az-sidebar">
            <div class="az-sidebar-header">
                <h4>
                <img src="{{ asset('app.png') }}" style="width:40px; height:auto; text-transform:none;">&nbsp;DocuEase
                </h4>
            </div>
            <div class="sidebar-new-button-section"></div>
            <div class="az-sidebar-nav">
                <nav class="nav">
                <a href="/dashboard-staff" class="nav-link">
                    <i class="fas fa-home"></i> Home </a>
                <div class="sub-nav">
                    <a href="/uploaded-by-me" class="nav-link">
                    <i class="fas fa-upload"></i> Uploaded by me </a>
                    <a href="/recent-files" class="nav-link">
                    <i class="fas fa-history"></i> Recent </a>
                    <a href="/starred-files" class="nav-link">
                    <i class="fas fa-star"></i> Starred </a>
                    <a href="/approved-files" class="nav-link">
                    <i class="fas fa-check-circle"></i> Approved documents </a>
                    <a href="/rejected-files" class="nav-link">
                    <i class="fas fa-times-circle"></i> Rejected documents </a>
                    <a href="/deleted-files" class="nav-link">
                    <i class="fas fa-trash-alt"></i> Bin </a>
                </div>
            </div>
            <div class="az-sidebar-footer"> Copyright © DocuEase 2025 </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const profileDropdownToggle = document.getElementById('profileDropdownToggle');
                const profileDropdownMenu = document.getElementById('profileDropdownMenu');
                const closeDropdownBtn = document.getElementById('closeDropdownBtn');

                // Toggle dropdown when clicking the profile picture
                if (profileDropdownToggle && profileDropdownMenu) {
                    profileDropdownToggle.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        // profileDropdownMenu.classList.toggle('show');
                        profileDropdownMenu.style.display = 'block';
                    });

                    // Close dropdown when clicking the close button
                    if (closeDropdownBtn) {
                        closeDropdownBtn.addEventListener('click', function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            profileDropdownMenu.style.display = 'none';
                        });
                    }

                    // Close dropdown when clicking outside
                    document.addEventListener('click', function(e) {
                        if (!profileDropdownToggle.contains(e.target) && !profileDropdownMenu.contains(e.target)) {
                            profileDropdownMenu.style.display = 'none';
                        }
                    });

                    // Close dropdown when clicking menu items
                    profileDropdownMenu.querySelectorAll('.action-item, .manage-account-btn').forEach(item => {
                        item.addEventListener('click', function() {
                            profileDropdownMenu.style.display = 'none';
                        });
                    });
                }
            });
        </script>
    </body>
</html>