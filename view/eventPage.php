<?php
require 'header.php';
include '../model/model.php';
include 'carousel.php';

// check the query string is valid.
$e_id = check_input($_GET["id"]);
$model = new Model();
if ($model->checkEvent($e_id)) {
  // if the query string value is valid input the event information from the
  // database on the page.
  $event_info = $model->getEvent($e_id);
  $event_images = $model->getImage($e_id);
  $carousel = new Carousel($event_images);
  $date = date_create($event_info["EventDate"]);
  $date = date_format($date, "jS F Y H:i");
?>
<div class="jumbotron">
  <?php if (check_input($_GET["response"]) == false && isset($_GET["response"])): ?>
  <h2 class="text-danger">Unable to process request</h2>
  <?php endif; ?>
  <h1 class="display-3"><?=$event_info["E_Name"]?></h1>
  <p class="font-weight-light text-muted"><?=$event_info["Category"]?> | Created by <a data-toggle="collapse" href="#eventOrganiserInfo" aria-expanded="false" aria-controls="collapseExample"><?=$event_info["O_Name"]?></a></p>
  <div class="collapse" id="eventOrganiserInfo">
    <div class="card card-body">
      Email: <?=$event_info["Email"]?> | Phone number : <?=$event_info["PhoneNum"]?>
    </div>
  </div>
  <div>
    <table class="table-unstlyed">
      <tbody>
        <tr>
          <td>
            <i class="far fa-clock"></i>
          </td>
          <td><?=$date?></td>
        </tr>
        <tr>
          <td>
            <i class="far fa-map"></i>
          </td>
          <td><?=$event_info["Place"]?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="row">
    <div class="col">
      <?php if (empty($_SESSION["rating"])): ?>
      <a role="button" class="btn btn-light" href="likeEvent.php?id=<?=$_GET["id"]?>&lr=<?=$event_info["Rating"]?>"><i class="far fa-thumbs-up"></i> <?=$event_info["Rating"]?></a>
      <?php else: ?>
      <button type="button" class="btn btn-light" data-container="body" data-toggle="popover" data-content="You can only like an event once!"><i class="far fa-thumbs-up"></i> <?=$event_info["Rating"]?></button>
      <?php endif; ?>
      </div>
    <div class="col-md-auto">
      <?php if ($_SESSION["u_id"] == $event_info["OrgId"] && isset($_SESSION["u_id"])): ?>
      <a class="btn btn-light" href="updateEventPage.php?id=<?=$_GET["id"]?>" role="button">UPDATE</a>
      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">DELETE</button>
      <?php endif; ?>
    </div>
  </div>
</div>
<div class="container ml-4">
  <div class="row">
    <div class="col-6">
      <h1 class="font-weight-light">About</h1>
      <p><?=$event_info["Description"]?></p>
    </div>
    <div class="col">
      <?=$carousel->getBody()?>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Delete Event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this event?
      </div>
      <div class="modal-footer">
        <a class="btn btn-success" href="deleteEvent.php?id=<?=$_GET["id"]?>" role="button">Yes</a>
        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
<?php
}
else {
  echo "The page you are looking for does not exist.";
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
require 'footer.php';
?>
