<?php
session_start();
require_once '../../connect/connectDb/config.php';
if (!isset($_SESSION['userFullName'])) {
     header('location: ../');
}
if (isset($_POST['niche'])) {
     $niche = $_POST['niche'];
     $secNiche = $_POST['secNiche'];
     $contentTime = $_POST['contentTime'];
     $consumeMost = $_POST['consumeMost'];
     $favoriteChannel = $_POST['favoriteChannel'];
     $mainSkill = $_POST['mainSkill'];
     $channelName = $_POST['channelName'];

     //time and date
     date_default_timezone_set('Asia/Calcutta');
     $date = date("Y/m/d");
     $time = date("h:i:sa");

     $dateTime = $time . " " . $date;

     $userUniqueCode = $_SESSION['userUniqueCode'];

     $channelDataSaveQuery = "INSERT INTO `78000_user_channel_details`(`mainNiche`, `mainSkill`, `timeforContent`, `consumeMost`, `favoriteChannel`, `secondNiche`, `channelName`, `userUniqueCode`, `date`) VALUES ('$niche','$mainSkill','$contentTime','$consumeMost','$favoriteChannel','$secNiche','$channelName','$userUniqueCode','$dateTime')";
     mysqli_query($link, $channelDataSaveQuery);
}
