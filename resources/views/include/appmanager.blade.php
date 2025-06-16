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
</style>

</head>

<body>

<div class="az-header">
  <div class="container">
    <div class="az-header-left">
      <h5 style="font-size: 22px;" class="az-logo"><img src="app.png" style="width:40px; height:auto;">&nbsp;DocuEase</h5>
      <a href="" id="azMenuShow" class="az-header-menu-icon d-lg-none"><span></span></a>
    </div>
    <div class="az-header-menu">
      <div class="az-header-menu-header">
        <h5 style="font-size: 22px;" class="az-logo"><img src="app.png" style="width:40px; height:auto;">&nbsp;DocuEase</h5>
        <a href="" class="close">&times;</a>
      </div>
      <ul class="nav">
        <li class="nav-item @if($page == 'dashboard') active @endif">
          <a href="/dashboard-manager" class="nav-link"><i class="typcn typcn-chart-area-outline"></i> Dashboard</a>
        </li>
        <li class="nav-item @if($page == 'docapproval') active @endif">
          <a href="/docupdaprovalmanager" class="nav-link"><i class="typcn typcn typcn-input-checked"></i> Document Upload Approval</a>
        </li>
        <li class="nav-item @if($page == 'docviewapproval') active @endif">
          <a href="/docviewapprovalmanager" class="nav-link"><i class="typcn typcn typcn-dropbox"></i> Document Viewing Approval</a>
        </li>
        <li class="nav-item @if($page == 'logs') active @endif">
          <a href="/manager/logs" class="nav-link"><i class="typcn typcn typcn-clipboard"></i> Logs</a>
        </li>
      </ul>
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
            profileDropdownMenu.classList.toggle('show');
        });

        // Close dropdown when clicking the close button
        if (closeDropdownBtn) {
            closeDropdownBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                profileDropdownMenu.classList.remove('show');
            });
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!profileDropdownToggle.contains(e.target) && !profileDropdownMenu.contains(e.target)) {
                profileDropdownMenu.classList.remove('show');
            }
        });

        // Close dropdown when clicking menu items
        profileDropdownMenu.querySelectorAll('.action-item, .manage-account-btn').forEach(item => {
            item.addEventListener('click', function() {
                profileDropdownMenu.classList.remove('show');
            });
        });
    }
});
</script>
</body>
</html>
