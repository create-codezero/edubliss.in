<?php
session_start();
require_once '../connect/connectDb/config.php';

if (isset($_GET)) {
     foreach ($_GET as $data => $val) {
          $refId = mysqli_real_escape_string($link, $data);
          $refId = str_replace('/', '', $refId);

          $_SESSION['refId'] = $refId;
     }
}
header('location: ../');
