<?php
session_start();
require_once '../../connect/connectDb/config.php';
$errors = array();
if (isset($_POST['changeStatus'])) {

     $i = $_POST['i'];
     $w = $_POST['w'];
     if(isset($_POST['newn'])){
        $newn = $_POST['newn'];
     }
     

     if($w == "Question"){
 
        $q = "UPDATE `78000_questions` SET `questionStatus`='$newn' WHERE `questionId`='$i'";
        $fireq = mysqli_query($link, $q);

        if($fireq){
            echo "done";
        }

     }else if($w == "Subject"){

        $q = "UPDATE `78000_a_subjects` SET `aSubjectStatus`='$newn' WHERE `aSubjectId`='$i'";
        $fireq = mysqli_query($link, $q);

        if($fireq){
            echo "done";
        }

     }else if($w == "Assignment"){

        $q = "UPDATE `78000_a_week` SET `aWeekStatus`='$newn' WHERE `aWeekId`='$i'";
        $fireq = mysqli_query($link, $q);

        if($fireq){
            echo "done";
        }

     }else if($w == "Asset"){

        $q = "UPDATE `78000_assets` SET `assetStatus`='Public' WHERE `assetId`='$i'";
        $fireq = mysqli_query($link, $q);

        if($fireq){
            echo "done";
        }

   }else if($w == "Material-Course"){

      $q = "UPDATE `78000_courses` SET `courseStatus`='$newn' WHERE `courseId`='$i'";
      $fireq = mysqli_query($link, $q);

      if($fireq){
          echo "done";
      }

 }else if($w == "Course-Level"){

   $q = "UPDATE `78000_levels` SET `levelStatus`='$newn' WHERE `levelId`='$i'";
   $fireq = mysqli_query($link, $q);

   if($fireq){
       echo "done";
   }

}else if($w == "Level-Subject"){

   $q = "UPDATE `78000_subjects` SET `subjectStatus`='$newn' WHERE `subjectId`='$i'";
   $fireq = mysqli_query($link, $q);

   if($fireq){
       echo "done";
   }

}else if($w == "Calculator"){

   $q = "UPDATE `78000_calculators` SET `calculatorStatus`='$newn' WHERE `calculatorId`='$i'";
   $fireq = mysqli_query($link, $q);

   if($fireq){
       echo "done";
   }

}else if($w == "AssetUpdate"){

   $q = "UPDATE `78000_assets` SET `assetStatus`='$newn' WHERE `assetId`='$i'";
   $fireq = mysqli_query($link, $q);

   if($fireq){
       echo "done";
   }

}else{
        echo "error";
   }
}else{
   echo "error";
}
