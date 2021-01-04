<?php
require 'header.php';
include 'addEvent.php';

// checks that the user is logged in to access the page.
if (isset($_SESSION["u_user"])) {
?>
<div class="row justify-content-center">

  <!-- form to add the event -->

  <form action="" method="post" enctype="multipart/form-data" id="event_form">
    <h1 class="font-weight-light">Add Event</h1>
    <div class="form-group">
      <label for="event_category" class="col-form-label">Category:</label>
        <select class="form-control" name="category">
          <option value="Sport">Sport</option>
          <option value="Culture">Culture</option>
          <option value="Other">Other</option>
        </select>
    </div>
    <div class="form-group">
      <label for="event_name" class="col-form-label">Event name:</label>
      <input type="text" class="form-control" name="name" id="event_name" placeholder="Enter the event name">
      <?=$name_error?>
    </div>
    <div class="form-group">
      <label for="event_date" class="col-form-label">Event date & time:</label>
      <input type="datetime-local" class="form-control" name="date" id="event_date">
      <?=$date_error?>
    </div>
    <div class="form-group">
      <label for="event_place" class="col-form-label">Event location:</label>
      <input type="text" class="form-control" name="place" id="event_name" placeholder="Enter the event location">
      <?=$place_error?>
    </div>
    <div class="form-group">
      <label for="event_desc" class="col-form-label">Description:</label>
      <textarea class="form-control" name="description" id="event_desc"></textarea>
      <?=$desc_error?>
    </div>
    <div class="form-group">
      <label for="event_image" class="col-form-label">Upload an image:</label>
      <input type="file" class="form-control" name="image1" accept="image/*" id="event_image1">
      <input type="file" class="form-control" name="image2" accept="image/*" id="event_image2">
      <input type="file" class="form-control" name="image3" accept="image/*" id="event_image3">
      <?=$image_error?>
    </div>
    <button type="submit" class="btn btn-primary" name="submit" value="submit">Add Event</button>
  </form>
</div>
<p><?phpforeach ($errors as $value) {?>
    <?=$value?><br>
    <?php}?></p>
<?php
}
else {
  // If the user is not logged in display this message.
  
  echo "You do not have permission to access this page.";
}
require 'footer.php';?>
