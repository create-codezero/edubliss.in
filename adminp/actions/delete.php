<?php
session_start();
require_once "../../connect/connectDb/config.php";
// Checking admin
if (!isset($_SESSION['admin-panel'])) {
     header('location: ../admin-login.php');
}
if (!isset($_GET['id']) && !isset($_GET['db']) && empty($_GET['id']) && empty($_GET['bd'])) {
     header('location: ../');
} else {
     if ($_GET['db'] == "user") {
          $id = mysqli_escape_string($link, $_GET['id']);

          $q = "DELETE FROM `78000_user` WHERE `userId` = '$id'";
          $fireq = mysqli_query($link, $q);

          if ($q) {
               header('location: ../');
          } else {
               echo "Something went Wrong!";
          }
     } else if ($_GET['db'] == "contact") {
          $id = mysqli_escape_string($link, $_GET['id']);

          $q = "DELETE FROM `78000_contact_us` WHERE `contactId` = '$id'";
          $fireq = mysqli_query($link, $q);

          if ($q) {
               header('location: ../');
          } else {
               echo "Something went Wrong!";
          }
     } else {
          header('location: ../');
     }
}
header('location: ../');
