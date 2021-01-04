<?php require 'header.php';
include 'register.php';

// checks that the user is not logged in to access the page.
if (empty($_SESSION["u_user"])) {?>
<p><?foreach ($errors as $value) {?>
    <?=$value?><br>
<?}?></p>
<div class="row justify-content-center">

  <!-- form to register -->
  <form class="registerForm" action="" method="post" id="reg_form">
    <h1 class="font-weight-light">Register</h1>
    <div class="form-group">
      <label for="org_name" class="col-form-label">Name:</label>
      <input type="text" name="fname" class="form-control" placeholder="Enter full name" id="org_name">
      <?=$name_error?>
    </div>
    <div class="form-group">
      <label for="org_email" class="col-form-label">Email:</label>
      <input type="text" name="email" class="form-control" placeholder="Enter email address" id="org_email">
      <?=$mail_error?>
    </div>
    <div class="form-group">
      <label for="org_num" class="col-form-label">Phone number:</label>
      <input type="text" name="pnum" class="form-control" placeholder="Enter phone number" id="org_num">
      <?=$number_error?>
    </div>
    <div class="form-group">
      <label for="org_pass" class="col-form-label">Password:</label>
      <input type="password" name="password" class="form-control" placeholder="Enter password" id="org_pass">
      <?=$password_error?>
    </div>
    <div class="form-group">
      <label for="org_pword" class="col-form-label">Re-enter Password:</label>
      <input type="password" name="pword" class="form-control" placeholder="Re-enter password" id="org_pword">
      <?=$pword_error?>
    </div>
    <button type="submit" class="btn btn-primary" name="submit" value="submit">Register</button>
  </form>
</div>
<?php }
else {
  // If the user is logged in redirect them to the home page.
  header('Location: homePage.php');
}
require 'footer.php';?>
