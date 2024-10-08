

<nav class="navbar navbar-expand-lg navbar-light justify-content-between fs-3 mb-5" style="background-color: #84eab3;">
  <div class="container-fluid">
  <span onclick="window.location.href='../../Record_List_Page.php'" class="navbar-brand mx-auto" style="cursor: pointer;">Record List Tracker</span>
 
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    
        <!-- If you need to add any additional links, add them here -->
      </ul>
 
        <div class="ml-0">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a class="btn btn-danger" href="../../logout.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 21 21">
                        <g fill="none" fill-rule="evenodd" transform="translate(4 1)">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                d="M2.5 2.5h2v14h-2a2 2 0 0 1-2-2v-10a2 2 0 0 1 2-2M7.202.513l4 1.5A2 2 0 0 1 12.5 3.886v11.228a2 2 0 0 1-1.298 1.873l-4 1.5A2 2 0 0 1 4.5 16.614V2.386A2 2 0 0 1 7.202.513" />
                            <circle cx="6.5" cy="9.5" r="1" fill="currentColor" />
                        </g>
                    </svg>
                </a>
        <?php else: ?>
            <!-- Add additional content here if needed -->
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>
