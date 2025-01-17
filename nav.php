<style>
     .LOGGED{
        font-size: 20px;
    }
    .navbar{
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000; /* Ensure navbar is always on top */
    transition: top 0.5s;
}

.navbar-transparent {
    background-color: rgba(200, 234, 179, 0);
  }

  .navbar-hidden {
    top: -80px; /* Adjust based on your navbar height */
  }

  .navbar:hover {
    top: 0;
  }
    
  
  body{
    padding-top: 100px;
  }
</style>
<nav class="navbar navbar-expand-lg navbar-light fs-5" style="background-color: #84eab3;">
    <div class="container-fluid">
        <a class="navbar-brand" href="Record_List_Page.php">Record List Tracker</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="Dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Statistics.php">Statistics</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="To-Do-List.php">Plan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Settings.php">Settings</a>
                </li>
            </ul>
            <div class="d-flex">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <span class="me-3 text-dark LOGGED"> <?php echo $user['username']; ?></span>
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#LogoutModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 21 21">
                            <g fill="none" fill-rule="evenodd" transform="translate(4 1)">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.5 2.5h2v14h-2a2 2 0 0 1-2-2v-10a2 2 0 0 1 2-2M7.202.513l4 1.5A2 2 0 0 1 12.5 3.886v11.228a2 2 0 0 1-1.298 1.873l-4 1.5A2 2 0 0 1 4.5 16.614V2.386A2 2 0 0 1 7.202.513" />
                                <circle cx="6.5" cy="9.5" r="1" fill="currentColor" />
                            </g>
                        </svg>
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="LogoutModal" tabindex="-1" aria-labelledby="LogoutModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">Logout</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="text-center">Are you sure you want to logout?</div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="confirmLogout()">Logout</button>
      </div>
    </div>
  </div>
</div>

<script>
  function confirmLogout() {
    window.location.href = 'Homepage.php';
  }
</script>

<script>
    let lastScrollTop = 0;
  const navbar = document.querySelector('.navbar');

  window.addEventListener('scroll', function() {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > lastScrollTop) {
      // Scrolling down
      navbar.classList.add('navbar-hidden');
    } else {
      // Scrolling up
      navbar.classList.remove('navbar-hidden');
    }
    lastScrollTop = scrollTop;
  });

</script>
