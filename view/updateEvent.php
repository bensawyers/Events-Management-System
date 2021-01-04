<?php
include '../model/model.php';

$name_error = $date_error = $desc_error = $place_error = "";
$event_details = array();
$event_cred = array();
$model = new Model();
$errors = array();
$e_id = check_input($_GET["id"]);

// checks the form to see if the values entered are valid.
// And also checks to see if new information has been entered
// into the form.
// Sets the values in the form to the values in the database table.
if ($model->checkEvent($e_id)) {
  $event_cred = $model->getEvent($e_id);
  $date = str_replace(" ", "T", $event_cred["EventDate"]);

  switch ($event_cred["Category"]) {
      case "Sport":
          $output = '<option value="Sport">Sport</option>';
          $output .= '<option value="Culture">Culture</option>';
          $output .= '<option value="Other">Other</option>';
          break;
      case "Culture":
          $output = '<option value="Culture">Culture</option>';
          $output .= '<option value="Sport">Sport</option>';
          $output .= '<option value="Other">Other</option>';
          break;
      case "Other":
          $output = '<option value="Other">Other</option>';
          $output .= '<option value="Sport">Sport</option>';
          $output .= '<option value="Culture">Culture</option>';
          break;
  }

  if (isset($_POST["submit"])) {
    if (empty($_POST["name"])) {
      $name_error = "Please enter category name.";
    }
    else {
      $checked_name = check_input($_POST["name"]);
      if ($checked_name != $event_cred["E_Name"]) {
          $event_details["name"] = $checked_name;
      }
    }
    if (empty($_POST["description"])) {
      $desc_error = "Please enter a description.";
    }
    else {
      $checked_desc = check_input($_POST["description"]);
      if ($checked_desc != $event_cred["Description"]) {
        $event_details["desc"] = $checked_desc;
      }
    }
    if (empty($_POST["place"])) {
      $place_error = "Please enter a location.";
    }
    else {
      $checked_place = check_input($_POST["place"]);
      if ($checked_place != $event_cred["Place"]) {
        $event_details["place"] = $checked_place;
      }
    }

    $date = str_replace("T", " ", $_POST["date"]);
    $date = date_create($date);
    $current_date = date_create();
    date_timezone_set($current_date, timezone_open("Europe/London"));
    if ($date > $current_date) {
      $date = date_format($date, 'Y-m-d H:i:s');
      $checked_date = $date;
      if ($checked_date != $event_cred["EventDate"]) {
        $event_details["date"] = $checked_date;
      }
    }
    else {
      $date_error = "Please enter valid date.";
    }

    if ($_POST["category"] != $event_cred["Category"]) {
      $event_details["cat"] = $_POST["category"];
    }
    $event_details["id"] = $_GET["id"];

    // Updates the event details.
    $result = $model->updateEvent($event_details);
    if ($result["success"] == true) {
      header("Location: eventsPage.php");
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
