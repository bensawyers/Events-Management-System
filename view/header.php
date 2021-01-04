<?php session_start(); ?>
<html>
<head>
<meta charset="UTF-8">
<title>Aston Events</title>

 <!-- scripts and links for bootstrap and glyphicons. -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
<style type="text/css">

 /* css for the forms. */

  #login_form {
    background-color: B0B0B0;
    border-radius: 8px;
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
    color: white;
    position: relative;
    transform: translateY(10%);
    max-width: 330px;
    padding: 15px;
    margin: 0 auto;
  }
  #event_form {
    background-color: B0B0B0;
    border-radius: 8px;
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
    color: white;
    position: relative;
    transform: translateY(10%);
    max-width: 330px;
    padding: 15px;
    margin: 0 auto;
  }
  #reg_form {
    background-color: B0B0B0;
    border-radius: 8px;
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
    color: white;
    position: relative;
    transform: translateY(10%);
    max-width: 330px;
    padding: 15px;
    margin: 0 auto;
  }
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-info navbar-static-top">
  <a class="navbar-brand" href="homePage.php">
    <img src="../images/website_images/aston_logo.png" width="60" height="30" alt="">Aston Events
  </a>
  <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbar">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="homePage.php">Home</a>
      </li>
      <?php if (empty($_SESSION["u_user"])): ?>
      <li class="nav-item">
        <a class="nav-link" href="eventsPage.php">Events</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="loginPage.php">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="registerPage.php">Register</a>
      </li>
      <?php else: ?>
       <!-- if the users is logged in allow them to add events and logout -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Events
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="eventsPage.php">Event List</a>
          <a class="dropdown-item" href="addEventPage.php">Add Event</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
      <?php endif; ?>
    </ul>
  </div>
</nav>
