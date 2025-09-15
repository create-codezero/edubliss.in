<?php
session_start();
require_once '../../connect/connectDb/config.php';
$errors = array();
if (isset($_POST['Upload_Calculator'])) {
     //this is for simple text upload

     $name = mysqli_real_escape_string($link, $_POST['Name']);
     $description = mysqli_real_escape_string($link, $_POST['Description']);
     $calcLink = mysqli_real_escape_string($link, $_POST['Link']);

     $adminId = $_SESSION['adminId'];
     $adminName = $_SESSION['adminName'];

     $currId = 1;

     $lastRow = "SELECT * FROM `78000_calculators`  ORDER BY `calculatorId` DESC LIMIT 1";
     $fireLasRow = mysqli_query($link, $lastRow);
     if(mysqli_num_rows($fireLasRow) > 0){
        while($rowDetail = mysqli_fetch_assoc($fireLasRow)){
            $currId = $rowDetail['calculatorId'];
        }

        $currId = $currId + 1;

     }else{
        $lastId = 0;
        $currId = $lastId + 1;
     } 

    //  Calculator Thumbnail

    $thumbnail_name = $_FILES['Calculator_Thumbnail']['name'];
    $thumbnail_tempname = $_FILES['Calculator_Thumbnail']['tmp_name'];

    $temp = explode(".", $_FILES["Calculator_Thumbnail"]["name"]);
    $thumbnail_name = md5($currId) . "." . end($temp);

    $thumbnail_folder = "../../data/calculator/thumbnail/" . $thumbnail_name;

    $thumbnail = $thumbnail_name;
    move_uploaded_file($thumbnail_tempname, $thumbnail_folder);


     //TIME AND DATE 
	 date_default_timezone_set('Asia/Calcutta');
	 $date = date("Y-m-d");
	 $time = date("H:i:s");

	 $dateTime = $date . " " . $time;

     //from here the inserting php is starts

     $q = " INSERT INTO `78000_calculators`(`calculatorName`,`calculatorDescription`, `calculatorLink`, `calculatorThumbnail`, `calculatorStatus`, `addedBy`, `addedByName`, `addedOn`) VALUES ('$name','$description','$calcLink','$thumbnail','Admin','$adminId','$adminName','$dateTime') ";

     //firing the query 

     mysqli_query($link, $q);

     header('location: ../');
}
