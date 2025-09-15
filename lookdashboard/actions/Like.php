<?php
session_start();
require_once '../../connect/connectDb/config.php';
if (isset($_POST['asset_id'])) {
     $asset_id = $_POST['asset_id'];
     $user_id = $_SESSION['userDetails'][0];
     $check = "SELECT * FROM `78000_assetheart` WHERE `userId` = '$user_id' AND `assetId` = '$asset_id'";
     $check_fire = mysqli_query($link, $check);
     if (mysqli_num_rows($check_fire) > 0) {
          $sql = "DELETE FROM `78000_assetheart` WHERE `userId` = '$user_id' AND `assetId` = '$asset_id'";
          $fire = mysqli_query($link, $sql);
     } else {
          $sql = "INSERT INTO `78000_assetheart`(`userId`, `assetId`) VALUES ('$user_id','$asset_id')";
          $fire = mysqli_query($link, $sql);
     }

     $count = "SELECT * FROM `78000_assetheart` WHERE `assetId` = '$asset_id'";
     $count_fire = mysqli_query($link, $count);
     echo mysqli_num_rows($count_fire);
}
