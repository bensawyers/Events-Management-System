<?php
require 'header.php';
include 'updateEvent.php';

// checks that the event exists.
if ($model->checkEvent($e_id)) {

  // checks that the user is logged in and that they are
  // editing their own event.
  if (isset($_SESSION["u_user"]) && $_SESSION["u_id"] == $event_cred["OrgId"]) {
?>
<div class="row justify-content-center">

  <!-- form to login -->
  <form action="" method="post" id="event_form">
    <h1 class="font-weight-light">Update Event</h1>
    <div class="form-group">
      <label for="event_category" class="col-form-label">Category:</label>
        <select class="form-control" name="category">
          <?=$output?>
        </select>
    </div>
    <div class="form-group">
      <label for="event_name" class="col-form-label">Event name:</label>
      <input type="text" class="form-control" name="name" id="event_name" value="<?=$event_cred["E_Name"]?>">
      <?=$name_error?>
    </div>
    <div class="form-group">
      <label for="event_date" class="col-form-label">Event date & time:</label>
      <input type="datetime-local" class="form-control" name="date" id="event_date" value=<?=$date?>>
      <?=$date_error?>
    </div>
    <div class="form-group">
      <label for="event_place" class="col-form-label">Event location:</label>
      <input type="text" class="form-control" name="place" id="event_name" value="<?=$event_cred["Place"]?>">
      <?=$place_error?>
    </div>
    <div class="form-group">
      <label for="event_desc" class="col-form-label">Description:</label>
      <textarea class="form-control" name="description" id="event_desc"><?=$event_cred["Description"]?></textarea>
      <?=$desc_error?>
    </div>
    <button type="submit" class="btn btn-primary" name="submit" value="submit">Update Event</button>
  </form>
</div>

 <!-- if there are errors print them out. -->
<p><?phpforeach ($errors as $value) {?>
    <?=$value?><br>
    <?php}?></p>
<?php
}
  else {
    echo "You do not have permission to access this page.";
  }
}
else {
  echo "The page you are looking for does not exist.";
}
require 'footer.php';?>
