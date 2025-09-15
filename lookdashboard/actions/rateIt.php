<?php
session_start();
require_once "../../connect/connectDb/config.php";

if (isset($_POST['rateThis'])) {
     $postId = $_POST['post'];
     $star = $_POST['star'];
     $userUniqueCode = $_SESSION['userUniqueCode'];

     //TIME AND DATE 
     date_default_timezone_set('Asia/Calcutta');
     $date = date("Y-m-d");
     $time = date("H:i:s");

     $dateTime = $date . " " . $time;

     $gettingThePostDetails = "SELECT * FROM `78000_posts` WHERE `postSrNo` = '$postId' AND `postRating` = 'true'";
     $fireGettingThePostDetails = mysqli_query($link, $gettingThePostDetails);

     if (mysqli_num_rows($fireGettingThePostDetails) > 0) {


          while ($postDetailRow = mysqli_fetch_assoc($fireGettingThePostDetails)) {


               $checkRatedOrNot = "SELECT * FROM `78000_postratings` WHERE `postSrNo` = '$postId' AND `userUniqueCode` = '$userUniqueCode'";
               $fireCheckRatedOrNot = mysqli_query($link, $checkRatedOrNot);

               if (mysqli_num_rows($fireCheckRatedOrNot) > 0) {

                    while ($ratingDetails = mysqli_fetch_assoc($fireCheckRatedOrNot)) {
                         $oldRating = $ratingDetails['star'];
                    }

                    // Already rated update

                    $nowTotalRating = $postDetailRow['totalRating'];
                    $nowTotalRatingStars = $postDetailRow['totalRatingStars'] - $oldRating + $star;
                    $nowRatingPoint = number_format(($nowTotalRatingStars) / ($nowTotalRating), 1);

                    $insertStage3 = "UPDATE `78000_posts` SET `ratingPoint`='$nowRatingPoint',`totalRatingStars`='$nowTotalRatingStars',`totalRating`='$nowTotalRating' WHERE postSrNo = '$postId'";
                    $fireInsertStage3 = mysqli_query($link, $insertStage3);

                    if ($fireInsertStage3) {
                         $insertNewRating = "UPDATE `78000_postratings` SET `star`='$star' WHERE `userUniqueCode` = '$userUniqueCode' AND `postSrNo` = '$postId'";
                         $fireInsertNewRating = mysqli_query($link, $insertNewRating);

                         if ($fireInsertNewRating) {
                              echo '<i class="fa fa-star" aria-hidden="true"></i> ' . $nowRatingPoint . " • " . $nowTotalRating . " Ratings";
                         }
                    }
               } else {
                    // Not rated yet Insert
                    $nowTotalRating = $postDetailRow['totalRating'] + 1;
                    $nowTotalRatingStars = $postDetailRow['totalRatingStars'] + $star;
                    $nowRatingPoint = number_format(($nowTotalRatingStars) / ($nowTotalRating), 1);

                    $insertStage3 = "UPDATE `78000_posts` SET `ratingPoint`='$nowRatingPoint',`totalRatingStars`='$nowTotalRatingStars',`totalRating`='$nowTotalRating' WHERE postSrNo = '$postId'";
                    $fireInsertStage3 = mysqli_query($link, $insertStage3);

                    if ($fireInsertStage3) {
                         $insertNewRating = "INSERT INTO `78000_postratings`(`postSrNo`, `userUniqueCode`, `star`, `rateDate`) VALUES ('$postId','$userUniqueCode','$star','$dateTime')";
                         $fireInsertNewRating = mysqli_query($link, $insertNewRating);

                         if ($fireInsertNewRating) {
                              echo '<i class="fa fa-star" aria-hidden="true"></i> ' . $nowRatingPoint . ' • ' . $nowTotalRating . " Ratings";
                         }
                    }
               }

               // 
          }
     }
}
