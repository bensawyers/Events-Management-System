<?php
include '../model/model.php';

// checks the query string and deletes the information from the table.
$model = new Model();
$id = check_input($_GET["id"]);
$response = $model->deleteEvent($id);
if ($response) {
  //if the deletion was successful go to the events page.
  header("Location: eventsPage.php");
}
else {
  // if the deletion was not successful return back to that event page
  // and return the error.
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
