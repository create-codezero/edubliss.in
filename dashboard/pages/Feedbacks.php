<?php
session_start();
require_once "../../connect/connectDb/config.php";
require_once "../../connect/function/timeago.php";

?>

<div class="flex flex-d-column e-c m-t-20">

     <?php
     $videoId = $_GET['videoId'];
     $fecthingAllFeedbacks = "SELECT * FROM `78000_video_feedbacks` WHERE videoId = '$videoId'";
     $fireFectchingAllFeedbacks = mysqli_query($link, $fecthingAllFeedbacks);

     if (mysqli_num_rows($fireFectchingAllFeedbacks) > 0) {
          while ($feedbacksRow = mysqli_fetch_assoc($fireFectchingAllFeedbacks)) {
     ?>
               <div class="box flex p-y-20 flex-y-center m-20 mob-flex-column overflow-hidden pos-relative" style="justify-content: space-between;" id="ad-preview">
                    <!-- <span class="pos-absolute fc-primary fw-700 fs-10" style="background-color: #ffff00; padding: 2px 5px; border-radius: 0 0 3px 0; top: 0; left: 0;">Ad</span> -->
                    <div class="flex flex-y-center">
                         <div class="ad-logo m-x-20 flex e-c" style="max-width: 50px;">
                              <a href="<?php echo $feedbacksRow['userChannelLink']; ?>" target="_blank">
                                   <img src="../data/user/channellogo/<?php echo $feedbacksRow['userChannelLogo']; ?>" alt="<?php echo $feedbacksRow['userChannelName']; ?> logo" class="img-fluid border-radius-100per">
                              </a>
                         </div>
                         <div class="ad-content m-r-10">
                              <a href="<?php echo $feedbacksRow['userChannelLink']; ?>" target="_blank">
                                   <p class="fc-dark-blue fs-20 fw-600"><?php echo $feedbacksRow['userChannelName']; ?></p>
                              </a>
                              <p class="fc-primary fw-500" style="font-size: 12px;">Full Name : <?php echo $feedbacksRow['fullName']; ?> • <?php echo time_elapsed_string($feedbacksRow['feedbackTime']); ?></p>
                              <p class="fc-dark-blue font-poppins" style="font-size: 15px;">Feedback : <?php echo $feedbacksRow['message']; ?></p>
                         </div>
                    </div>
               </div>
     <?php
          }
     } else {
          echo '<p class="tx-center fs-30 fw-500 m-y-40">This video doesn' . "'" . 't got any feedback yet!';
     }
     ?>



</div>