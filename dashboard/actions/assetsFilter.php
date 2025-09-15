<?php

session_start();
require_once '../../connect/connectDb/config.php';

if(isset($_POST['course']) && !isset($_POST['level']) && !isset($_POST['subject'])){

    $course = $_POST['course'];

    $level = "SELECT * FROM `78000_levels` WHERE `levelCourse` = '$course'";
    $fireLevel = mysqli_query($link, $level);

    echo '<option value disabled selected>Level</option>';

    if(mysqli_num_rows($fireLevel) > 0){
        while($levelDetails = mysqli_fetch_assoc($fireLevel)){

            echo '<option value="'.$levelDetails['levelId'].'">'.$levelDetails['levelName'].'</option>';

        }
    }


}else if(isset($_POST['course']) && isset($_POST['level']) && !isset($_POST['subject'])){
    $course = $_POST['course'];
    $level = $_POST['level'];

    $subject = "SELECT * FROM `78000_subjects` WHERE `subjectCourse` = '$course' AND `subjectLevel` = '$level'";
    $fireSubject = mysqli_query($link, $subject);

    echo '<option value disabled selected>Subject</option>';

    if(mysqli_num_rows($fireSubject) > 0){
        while($subjectDetails = mysqli_fetch_assoc($fireSubject)){

            echo '<option value="'.$subjectDetails['subjectId'].'">'.$subjectDetails['subjectName'].'</option>';

        }
    }


}else if(isset($_POST['course']) && isset($_POST['level']) && isset($_POST['subject'])){

    // what to do after all three selections

}