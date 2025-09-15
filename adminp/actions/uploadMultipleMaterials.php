<?php
session_start();
require_once '../../connect/connectDb/config.php';
$errors = array();
if (isset($_POST['Upload_Multiple_Asset'])) {

    $noOfMaterials = mysqli_real_escape_string($link, $_POST['noOfMaterials']);

    // COMMON DETAILS FOR ALL QUESTIONS

    $course = mysqli_real_escape_string($link, $_POST['course']);
    $level = mysqli_real_escape_string($link, $_POST['level']);
    $subject = mysqli_real_escape_string($link, $_POST['subject']);

    // Admin Details
    $adminId = $_SESSION['adminId'];
    $adminName = $_SESSION['adminName'];


   //TIME AND DATE 
    date_default_timezone_set('Asia/Calcutta');
    $date = date("Y-m-d");
    $time = date("H:i:s");

    $dateTime = $date . " " . $time;

    $n = 1;

    while($n <= $noOfMaterials){

        $currMaterialName = "Name" . $n;
        $currMaterialDescription = "Description" . $n;
        $currMaterialTags = "Tags" . $n;
        $currMaterialDownload_Link = "Download_link" . $n;
        $currMaterialMaterial_Thumbnail = "Material_Thumbnail" . $n;


        //this is for simple text upload

        $name = mysqli_real_escape_string($link, $_POST[$currMaterialName]);
        $name = strtoupper($name);
        $description = mysqli_real_escape_string($link, $_POST[$currMaterialDescription]);
        $download_link = mysqli_real_escape_string($link, $_POST[$currMaterialDownload_Link]);
        $tags = mysqli_real_escape_string($link, $_POST[$currMaterialTags]);

        $adminId = $_SESSION['adminId'];
        $adminName = $_SESSION['adminName'];

        //this is for the thumbnail upload
        $thumbnail = "";

        if(($_FILES[$currMaterialMaterial_Thumbnail]['name'] != "") && ($_FILES[$currMaterialMaterial_Thumbnail]['size'] != 0)){
            $thumbnail_name = $_FILES[$currMaterialMaterial_Thumbnail]['name'];
            $thumbnail_tempname = $_FILES[$currMaterialMaterial_Thumbnail]['tmp_name'];

            $currId = 1;

            $lastRow = "SELECT * FROM `78000_assets` ORDER BY `assetId` DESC LIMIT 1";
            $fireLasRow = mysqli_query($link, $lastRow);
            if(mysqli_num_rows($fireLasRow) > 0){
                while($rowDetail = mysqli_fetch_assoc($fireLasRow)){
                    $currId = $rowDetail['assetId'];
                }

                $currId = $currId + 1;

            }else{
                $lastId = 0;
                $currId = $lastId + 1;
            }

            //this is for the thumbnail upload
            $temp = explode(".", $_FILES[$currMaterialMaterial_Thumbnail]['name']);


            $thumbnail_name = md5($currId) . "." . end($temp);

            $thumbnail_folder = "../../data/assets/thumbnail/" . $thumbnail_name;
            $thumbnail = "../data/assets/thumbnail/" . $thumbnail_name;
            move_uploaded_file($thumbnail_tempname, $thumbnail_folder);
        }else{
            $thumbnail = "";
        }

        //from here the inserting php is starts

        $q = " INSERT INTO `78000_assets`(`assetName`, `assetDescription`, `assetFile`, `assetThumbnail`, `assetTags`, `uploadedBy`, `uploaderId`, `uploaderName`, `course`, `level`, `subject`, `assetStatus`) VALUES ('$name', '$description', '$download_link', '$thumbnail', '$tags','Admin','$adminId','$adminName','$course','$level','$subject','Public') ";

        //firing the query 

        mysqli_query($link, $q);

        $n = $n+1;

    }

    // UPADATING THE TOTALMATERIALS COUNT IN COURSES TABLE
    $q2 = "SELECT `totalMaterials` from `78000_courses` WHERE `courseId` = '$course'";
     $q2val = mysqli_query($link, $q2);

     if(mysqli_num_rows($q2val) > 0){
        while($q2vall = mysqli_fetch_assoc($q2val)){
            $q2value = $q2vall['totalMaterials'];
        }
     }

     $newq2val = intval($q2value) + $noOfMaterials;

     $q3 = "UPDATE `78000_courses` SET `totalMaterials`='$newq2val' WHERE `courseId` = '$course'";
     $fireq3 = mysqli_query($link, $q3);




    // UPADATING THE TOTALMATERIALS COUNT IN LEVEL TABLE
    $q2 = "SELECT `totalMaterials` from `78000_levels` WHERE `levelId` = '$level'";
     $q2val = mysqli_query($link, $q2);

     if(mysqli_num_rows($q2val) > 0){
        while($q2vall = mysqli_fetch_assoc($q2val)){
            $q2value = $q2vall['totalMaterials'];
        }
     }

     $newq2val = intval($q2value) + $noOfMaterials;

     $q3 = "UPDATE `78000_levels` SET `totalMaterials`='$newq2val' WHERE `levelId` = '$level'";
     $fireq3 = mysqli_query($link, $q3);




    // UPADATING THE TOTALMATERIALS COUNT IN SUBJECT TABLE
    $q2 = "SELECT `totalMaterials` from `78000_subjects` WHERE `subjectId` = '$subject'";
     $q2val = mysqli_query($link, $q2);

     if(mysqli_num_rows($q2val) > 0){
        while($q2vall = mysqli_fetch_assoc($q2val)){
            $q2value = $q2vall['totalMaterials'];
        }
     }

     $newq2val = intval($q2value) + $noOfMaterials;

     $q3 = "UPDATE `78000_subjects` SET `totalMaterials`='$newq2val' WHERE `subjectId` = '$subject'";
     $fireq3 = mysqli_query($link, $q3);

     

     header('location: ../');
}
