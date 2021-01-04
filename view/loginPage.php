<?php require 'header.php';
include 'login.php';
// checks that the user is not logged in to access the page.
if (empty($_SESSION["u_user"])) {?>
  <p><?foreach ($errors as $value) {?>
      <?=$value?><br>
  <?}?></p>
  <div class="row justify-content-center">

    <!-- form to login -->
    <form action="" method="post" id="login_form">
      <h1 class="font-weight-light">Login</h1>
      <div class="form-group">
        <label for="org_email" class="col-form-label">Email:</label>
        <input type="text" name="email" class="form-control" placeholder="Enter email address" id="org_email">
        <?=$email_error?>
      </div>
      <div class="form-group">
        <label for="org_pword" class="col-form-label">Password:</label>
        <input type="password" name="password" class="form-control" placeholder="Enter password" id="org_pword">
        <?=$password_error?>
      </div>
      <button type="submit" class="btn btn-primary" name="submit" value="submit">Login</button>
    </form>
  </div>
<?php }
else {
  // If the user is logged in redirect them to the home page.
  header('Location: homePage.php');
}
require 'footer.php';?>
