<?php
session_start();
require_once '../../connect/connectDb/config.php';
$errors = array();
if (isset($_POST['Update_Asset'])) {
     //this is for simple text upload

     $assetId = $_POST['assetId'];
     $name = $_POST['Name'];
     $description = $_POST['Description'];
     $download_link = $_POST['Download_link'];
     $tags = $_POST['Tags'];

     //from here the inserting php is starts

     $q = " UPDATE `78000_assets` SET `assetName`='$name',`assetDescription`='$description',`assetFile`='$download_link',`assetTags`='$tags' WHERE `assetId` = '$assetId' ";

     mysqli_query($link, $q);

     header('location: ../');
}
