<?php
include '../model/model.php';

$email_error = $password_error = "";
$login_cred = array();
$errors = array();

//checks the form to see if the values entered are valid.

if (isset($_POST["submit"])) {
  if (empty($_POST["email"])) {
    $mail_error = "Please enter your email address.";
  }
  else {
    $checked_email = check_input($_POST["email"]);
    if (!filter_var($checked_email, FILTER_VALIDATE_EMAIL)) {
      $mail_error = "Please enter a valid email.";
    }
    else {
      $login_cred["email"] = $checked_email;
    }
  }
  if (empty($_POST["password"])) {
    $password_error = "Please enter a password.";
  }
  else {
    $checked_password = check_input($_POST["password"]);
    if (!preg_match('/^[a-zA-z0-9]{6,20}$/', $checked_password)) {
      $password_error = "Password must be between 6-20 characters and contain letters and numbers.";
    }
    else {
      $login_cred["password"] = $checked_password;
    }
  }

  // checks that all required fields are filled out and checks the
  // database table to see if the user exists, if so logs them in.

  if (count($login_cred) ==2){
    $model = new Model();
    $result = $model->loginOrganiser($login_cred);
    if ($result["success"] == true) {
      header("Location: homePage.php");
    }
    else {
      $errors = $result["errors"];
    }
  }
}

/**
 * Sanatises the input information
 */
function check_input ($data)
{
  $data = trim($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
