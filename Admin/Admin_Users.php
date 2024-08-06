<?php
session_start();

// Check if the user is logged in and is an admin
if (!(isset($_SESSION['user_id']) && isset($_SESSION['username']) && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1)) {
    header("Location: admin_login.php"); // Redirect if not an admin
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <?php include "../header.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="Admin.css">
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include "Sidebar.php"; ?>

<div class="height-100 bg-light">
    <div class="container mb-5">
        <div class="text-align-left">
            <h1>Admin Account</h1>
        </div>
    </div>

    <div class="container mb-5">
        <div class="text-align-left">
            <h1>Admin Account</h1>
        </div>
    </div>

    <div class="container mb-4">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#AddNewAcModal">Add New Account</button>
    </div>

    <div class="container mb-5">
        <label class="form-label"></label>
        <input type="text" name="username" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
    </div>

    <div class="container">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>User Level</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script src="Admin.js"></script>
<!-- Include Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!-- Modal -->
<div class="modal fade" id="AddNewAcModal" tabindex="-1" aria-labelledby="AddNewAcModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="AddNewAcModalLabel">Add New Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addAccountForm">
          <div class="mb-3">
            <label for="newUsername" class="form-label">Username</label>
            <input type="text" class="form-control" id="newUsername" name="newUsername" required>
          </div>
          <div class="mb-3">
            <label for="newPassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="newPassword" name="newPassword" required>
          </div>
          <div class="mb-3">
            <label for="newUserLevel" class="form-label">User Level</label>
            <select class="form-control" id="newUserLevel" name="newUserLevel" required>
              <option value="1">Super Admin</option>
              <option value="2">Admin</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="submitAddAccountForm()">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
  function submitAddAccountForm() {
    // Implement your form submission logic here
    // For example, you can use AJAX to submit the form data to a PHP script
    var form = document.getElementById('addAccountForm');
    if (form.checkValidity()) {
        // Perform AJAX request or form submission here
        console.log('Form is valid, submitting...');
    }
  }
</script>
