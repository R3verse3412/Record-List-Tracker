<body id="body-pd">
<header class="header" id="header">
    <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
    <div>Welcome, <?php echo $_SESSION['username']; ?></div>
    <div class="header_img"> <img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>
</header>
<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <div>
            <a href="#" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">Record List Tracker</span> </a>
            <div class="nav_list">
                <a href="Admin.php" class="nav_link"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a>
                <a href="Admin_Users.php" class="nav_link"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Users</span> </a>
                <a href="CMS.php" class="nav_link"> <i class='bx bx-message-square-detail nav_icon'></i> <span class="nav_name">CMS</span> </a>
                <!--<a href="#" class="nav_link"> <i class='bx bx-bookmark nav_icon'></i> <span class="nav_name">Bookmark</span> </a>-->
                <a href="#" class="nav_link"> <i class='bx bx-folder nav_icon'></i> <span class="nav_name">File Management</span> 
                <a href="Admin_Statistic.php" class="nav_link"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span class="nav_name">Stats</span>
               </a>
            </div>
        </div>
        <a href="Admin_logout.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> </a>
    </nav>
</div>
