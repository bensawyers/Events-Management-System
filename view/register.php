<?php
include '../model/model.php';

$name_error = $email_error = $number_error = $password_error = $pword_error = "";
$reg_details = array();
$errors = array();

//checks the form to see if the values entered are valid.

if (isset($_POST["submit"])) {
  if (empty($_POST["fname"])) {
    $name_error = "Please enter your full name.";
  }
  else {
    $checked_name = check_input($_POST["fname"]);
    $reg_details["name"] = $checked_name;
  }
  if (empty($_POST["email"])) {
    $mail_error = "Please enter your email address.";
  }
  else {
    $checked_email = check_input($_POST["email"]);
    if (!filter_var($checked_email, FILTER_VALIDATE_EMAIL)) {
      $mail_error = "Please enter a valid email.";
    }
    else {
      $reg_details["email"] = $checked_email;
    }
  }
  if (empty($_POST["pnum"])) {
    $number_error = "Please enter your contact number.";
  }
  else {
    $checked_num = check_input($_POST["pnum"]);
    if (!preg_match('/^[0-9]{11}$/', $checked_num)) {
      $number_error = "Please enter a valid phone number.";
    }
    else {
      $reg_details["number"] = $checked_num;
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
  }
  if (empty($_POST["pword"])) {
    $pword_error = "Please re-enter your password.";
  }
  else {
    if (isset($_POST["password"])) {
      $checked_pword = check_input($_POST["pword"]);
      if ($checked_pword != $checked_password) {
        $pword_error = "Passwords do not match.";
      }
      else {
        $reg_details["password"] = $checked_pword;
      }
    }
  }

  // checks that all required fields are filled out and adds the user to
  // the database.

  if (count($reg_details) ==4){
    $model = new Model();
    $result = $model->regOrganiser($reg_details);
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
