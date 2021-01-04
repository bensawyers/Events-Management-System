<?php
require 'header.php';
include '../model/model.php';
include 'table.php';
$model = new Model();
$event_info = $model->displayOrgEvents();
$table = new Table($event_info);
?>
<!-- banner for the website. -->
<div class="">
  <img class="img-fluid" src="../images/website_images/websiteBanner.png" alt="">
</div>
<?php if (isset($_SESSION["u_user"])): ?>
 <!-- if the user is logged in display their events -->
<h1>Welcome <?=$_SESSION["u_user"]?></h1>
<h3 class="font-weight-light">Your Events</h3>
<?=$table->getBody()?>
<?php else: ?>
<div class="row justify-content-center">
    <h1>Check out our events!</h1>
</div>
<div class="row justify-content-center">
  <a class="btn btn-lg btn-primary" role="button" href="eventsPage.php">Events</a>
</div>
<?php endif; ?>
<? require 'footer.php';?>
