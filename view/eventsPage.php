<?php
require 'header.php';
include '../model/model.php';
include 'table.php';

//creates the table for the events.
$model = new Model();
$event_info = $model->displayEvents();
$table = new Table($event_info);
?>

<script src="js/filter.js" charset="utf-8"></script>
<h1 class="font-weight-light">Current Events</h1>

 <!-- the buttons to filter the events. -->
<div class="eventTable">
  <table id="filter-table" class="table-unstlyed">
    <tbody>
      <tr>
        <td>
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="categoryButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Category
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#" onclick="filter('Sport')">Sport</a>
                <a class="dropdown-item" href="#" onclick="filter('Culture')">Culture</a>
                <a class="dropdown-item" href="#" onclick="filter('Other')">Other</a>
              </div>
            </div>
        </td>
        <td>
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dateButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Date
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#" onclick="sortDateAsc()">Ascending</a>
                <a class="dropdown-item" href="#" onclick="sortDateDesc()">Descending</a>
              </div>
            </div>
        </td>
        <td>
            <div class="dropdown">
              <button class="btn btn-secondary" type="button" id="ratingButton" onclick="sortRating()">
              Rating
              </button>
            </div>
        </td>
        <?php if (isset($_SESSION["u_user"])): ?>

         <!-- if the user is logged in allow the to add events. -->
        <td>
          <div class="add">
            <a class="btn btn-primary" href="addEventPage.php" role="button">New Event</a>
          </div>
        </td>
        <?php endif ?>
      </tr>
    </tbody>
  </table>
   <!-- gets the tables and displays it on the page. -->
  <?=$table->getBody()?>
</div>
<?php require 'footer.php'; ?>
