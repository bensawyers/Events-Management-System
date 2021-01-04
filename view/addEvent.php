<?php
include '../model/model.php';

$name_error = $date_error = $desc_error = $place_error = $image_error = "";
$event_details = array();
$errors = array();
$event_images = array();

//checks the form to see if the values entered are valid.

if (isset($_POST["submit"])) {
  if (empty($_POST["name"])) {
    $name_error = "Please enter category name.";
  }
  else {
    $checked_name = check_input($_POST["name"]);
    $event_details["name"] = $checked_name;
  }
  if (empty($_POST["description"])) {
    $desc_error = "Please enter a description.";
  }
  else {
    $checked_desc = check_input($_POST["description"]);
    $event_details["desc"] = $checked_desc;
  }
  if (empty($_POST["place"])) {
    $place_error = "Please enter a location.";
  }
  else {
    $checked_place = check_input($_POST["place"]);
    $event_details["place"] = $checked_place;
  }

  $date = str_replace("T", " ", $_POST["date"]);
  $date = date_create($date);
  $current_date = date_create();
  date_timezone_set($current_date, timezone_open("Europe/London"));
  //$current_date = date_format($current_date, 'Y-m-d H:i:s');
  if ($date > $current_date) {
    $date = date_format($date, 'Y-m-d H:i:s');
    $checked_date = $date;
    $event_details["date"] = $checked_date;
  }
  else {
    $date_error = "Please enter valid date.";
  }

  $event_details["cat"] = $_POST["category"];


  if ( $_FILES["image1"]["tmp_name"] != "") {
    if (preg_match('/image/', $_FILES["image1"]["type"])) {
      $image_name = basename($_FILES["image1"]["name"]);
      $event_images["$image_name"] = $_FILES["image1"]["tmp_name"];
    }
    else {
      $image_error = "file must be an image.";
    }
  }
  if ($_FILES["image2"]["tmp_name"] != "") {
    if (preg_match('/image/', $_FILES["image2"]["type"])) {
      $image_name = basename($_FILES["image2"]["name"]);
      $event_images["$image_name"] = $_FILES["image2"]["tmp_name"];
    }
    else {
      $image_error = "file must be an image.";
    }
  }
  if ($_FILES["image3"]["tmp_name"] != "") {
    if (preg_match('/image/', $_FILES["image3"]["type"])) {
      $image_name = basename($_FILES["image3"]["name"]);
      $event_images["$image_name"] = $_FILES["image3"]["tmp_name"];
    }
    else {
      $image_error = "file must be an image.";
    }
  }

// checks that all required fields are filled out and if so adds them
// to the database table.

  if (count($event_details) ==5){
    $model = new Model();
    $result = $model->addEvent($event_details);
    if ($result["success"] == true) {
	echo "working";
      if (count($event_images) >0) {
        $image_path = array();
        $event_id = $result["event"]["LAST_INSERT_ID()"];
        $path = "../images/" . $event_id;
        mkdir($path);
        foreach ($event_images as $key => $value) {
          $final_path = $path . "/" . $key;
          move_uploaded_file($value, $final_path);
          $image_path[] = $final_path;
        }
        $func_result = $model->addImage($image_path, $event_id);
        if ($func_result["success"] == true) {
          header("Location: eventsPage.php");
        }
        else {
          $errors = $func_result["errors"];
        }
      }
      header("Location: eventsPage.php");
    }
    else {
	foreach ($result as $key => $value){
	echo $key . ": " . $value[0];
	}
	
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
