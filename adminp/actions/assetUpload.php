<?php
session_start();
require_once '../../connect/connectDb/config.php';
$errors = array();
if (isset($_POST['Upload_Asset'])) {
     //this is for simple text upload

     $name = $_POST['Name'];
     $description = $_POST['Description'];
     $download_link = $_POST['Download_link'];
     $tags = $_POST['Tags'];

     $adminId = $_SESSION['adminId'];
     $adminName = $_SESSION['adminName'];

     $currId = 1;

     $lastRow = "SELECT * FROM `78000_assets` ORDER BY `assetId` DESC LIMIT 1";
     $fireLasRow = mysqli_query($link, $lastRow);
     if(mysqli_num_rows($fireLasRow) > 0){
        while($rowDetail = mysqli_fetch_assoc($fireLasRow)){
            $currId = $rowDetail['assetId'];
            echo $currId;
        }

        $currId = $currId + 1;

     }else{
        $lastId = 0;
        $currId = $lastId + 1;
     }

     echo $currId;

     //this is for the thumbnail upload

     $thumbnail_name = $_FILES['Asset_thumbnail']['name'];
     $thumbnail_tempname = $_FILES['Asset_thumbnail']['tmp_name'];
     $temp = explode(".", $_FILES['Asset_thumbnail']['name']);

     $thumbnail_name = md5($currId) . "." . end($temp);

     $thumbnail_folder = "../../data/assets/thumbnail/" . $thumbnail_name;

     $thumbnail = "../data/assets/thumbnail/" . $thumbnail_name;

     move_uploaded_file($thumbnail_tempname, $thumbnail_folder);

     //from here the inserting php is starts

     $q = " INSERT INTO `78000_assets`(`assetName`, `assetDescription`, `assetFile`, `assetThumbnail`, `assetTags`, `uploadedBy`, `uploaderId`, `uploaderName`,`assetStatus`) VALUES ('$name', '$description', '$download_link', '$thumbnail', '$tags','Admin','$adminId','$adminName','Public') ";

     mysqli_query($link, $q);

     header('location: ../');
}
