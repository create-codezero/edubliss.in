<?php
session_start();
require_once '../../connect/connectDb/config.php';
$errors = array();
if (isset($_POST['Update-Thumbnail'])) {
     //this is for simple text upload

     $assetId = $_POST['assetId'];

     $thumbnailfile = "newThumbnail" . $assetId;

     //this is for the thumbnail upload

     $thumbnail_name = $_FILES[$thumbnailfile]['name'];
     $thumbnail_tempname = $_FILES[$thumbnailfile]['tmp_name'];
     $temp = explode(".", $_FILES[$thumbnailfile]['name']);

     //TIME AND DATE 
	 date_default_timezone_set('Asia/Calcutta');
	 $date = date("Y-m-d");
	 $time = date("H:i:s");

	 $dateTime = $date . "_" . $time;

     $thumbnail_name = md5($assetId) . "." . end($temp);

     $thumbnail_folder = "../../data/assets/thumbnail/" . $thumbnail_name;

     $thumbnail = "../data/assets/thumbnail/" . $thumbnail_name;

     $thumbnail = $thumbnail . "?i=" . $dateTime;

     move_uploaded_file($thumbnail_tempname, $thumbnail_folder);

     //from here the inserting php is starts

     $q = " UPDATE `78000_assets` SET `assetThumbnail`='$thumbnail' WHERE `assetId` = '$assetId' ";

     mysqli_query($link, $q);

     header('location: ../');
}
