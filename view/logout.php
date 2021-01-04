<?php
session_start();
// checks to see if the user is logged in.
if (isset($_SESSION["u_user"])) {
  // removes the users information from the session.
  session_destroy();
  header('Location: homePage.php');
}
else {
  echo "You do not have permission to access this page.";
}
?>
