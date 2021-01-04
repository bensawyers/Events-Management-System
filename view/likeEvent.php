<?php
session_start();
include '../model/model.php';
$model = new Model();
$id = check_input($_GET["id"]);
$like = check_input($_GET["lr"]);
$response = $model->likeEvent($id, $like);
if ($response) {
  // if the like was successful redirect the user back to the event page
  header("Location: eventPage.php?id=" . $id);
}
else {
  // if it was unsuccessful return the error
  header("Location: eventPage.php?id=" . $_GET["id"] . "&response=" . $response);
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
