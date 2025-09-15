<?php
require_once '../../connect/connectDb/config.php';
$id = $_POST['asset_id'];
$current_down = 0;

if (!empty($id)) {
     $q15 = "SELECT * FROM `78000_assets` WHERE assetId = $id";
     $fire = mysqli_query($link, $q15);
     while ($row_q15 = mysqli_fetch_assoc($fire)) {
          $q15_id = $row_q15['assetDownloadCount'];
          $current_down = $q15_id + 1;
          $q15 = "UPDATE `78000_assets` SET `assetDownloadCount` =$current_down where `assetId` = $id";
          $fire_q15 = mysqli_query($link, $q15);
          echo "Total Downloads : " . $current_down;
     }
}
