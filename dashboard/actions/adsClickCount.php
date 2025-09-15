<?php
session_start();
require_once '../../connect/connectDb/config.php';
if (!isset($_SESSION['userFullName'])) {
     header('location: ../');
}

if (isset($_POST['adsId'])) {
     $j = 1;
     $adsId = $_POST['adsId'];
     $userUniCode = $_POST['userUniCode'];
     $currentAds = $_POST['currentAds'];
     $addedUserClicked = $_SESSION['thisUserAdsClicked'] + 1;

     $adsArrayName = "Ads" . $currentAds;
     $addedClicks = $_SESSION[$adsArrayName][11] + 1;

     $queryAddClick = "UPDATE `78000_channels` SET `clicks`='$addedClicks' WHERE campaignId = '$adsId'";
     mysqli_query($link, $queryAddClick);

     $queryAddUserCickedCount = "UPDATE `78000_channels` SET `channelUserAdsClickCount`='$addedUserClicked' WHERE channelUser = '$userUniCode'";
     mysqli_query($link, $queryAddUserCickedCount);;

     $_SESSION['thisUserAdsClicked'] = $_SESSION['thisUserAdsClicked'] + 1;
     $_SESSION[$adsArrayName][11] = $addedClicks;
}
