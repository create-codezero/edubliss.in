<?php
session_start();
require_once "../../connect/connectDb/config.php";
require_once "../../connect/function/timeago.php";
$_SESSION['path'] = "Home";

if (isset($_POST['fromVal']) && isset($_POST['loadCount']) && isset($_POST['sign'])) {
     $lastPost = $_POST['fromVal'];
     $loadCount = $_POST['loadCount'];
     $sign = $_POST['sign'];

     $selectingPost = "SELECT * FROM `78000_posts` WHERE `postVisibility` = 'public' AND `userUniqueCode` " . $sign . " '" . $_SESSION['userUniqueCode'] . "' ORDER BY postSrNo DESC LIMIT $lastPost, $loadCount";
     $fireSelectingPost = mysqli_query($link, $selectingPost);

     if (mysqli_num_rows($fireSelectingPost) > 0) {
          while ($postRow = mysqli_fetch_assoc($fireSelectingPost)) {

               $checkHeart = "SELECT * FROM `78000_postheart` WHERE `userUniqueCode` = '" . $_SESSION['userUniqueCode'] . "' AND `postId` = '" . $postRow['postSrNo'] . "'";
               $fireCheckHeart = mysqli_query($link, $checkHeart);
               if (mysqli_num_rows($fireCheckHeart) > 0) {
                    $heartClass = "fa-solid fa-heart fc-red";
               } else {
                    $heartClass = "fa-regular fa-heart";
               }
?>

               <!-- Post -->
               <div class="post w-100per flex flex-d-column" id="post<?php echo $postRow['postSrNo']; ?>">
                    <div class="post-top-bar flex pos-relative">
                         <div class="flex e-c m-b-10">
                              <div class=" flex e-c" style="max-width: 35px;">
                                   <a href="https://www.youtube.com/<?php echo $postRow['userChannelId']; ?>" target="_blank">
                                        <img src="../data/user/channellogo/<?php echo $postRow['userChannelLogo']; ?>" alt="<?php echo $postRow['userChannelLogo']; ?> logo" class="img-fluid border-radius-100per" style="margin-top: 3px;">
                                   </a>
                              </div>
                              <div class="m-l-10">
                                   <a href="https://www.youtube.com/<?php echo $postRow['userChannelId']; ?>" target="_blank">
                                        <p class="fc-dark-blue fw-600" style="font-size: 16px;"><?php echo $postRow['userChannelName']; ?></p>
                                   </a>
                                   <p class="fc-primary fw-500" style="font-size: 12px;">Full Name : <?php echo $postRow['userFullName']; ?> • <?php echo time_elapsed_string($postRow['postTime']); ?></p>
                              </div>
                         </div>
                         <?php

                         if ($sign == "=") {
                              echo '<div class="flex e-c pos-relative">
                                        <a href="javascript:void(0)" class="p-10 fs-20 hover-fc-primary" onclick="deletePost(this)" data-post="' . $postRow['postSrNo'] . '"> <i class="fa-solid fa-trash"></i> </a>
                                   </div>';
                         }

                         ?>
                    </div>
                    <div class="flex" style="margin:10px 20px;">
                         <pre style="text-align: left; margin:0; white-space: pre-wrap; white-space: -moz-pre-wrap; white-space: -pre-wrap white-space: -o-pre-wrap; word-wrap: break-word;"><p class="fc-dark-blue font-poppins" style="font-size: 15px;"><?php echo $postRow['postText']; ?></p></pre>
                    </div>

                    <?php
                    if ($postRow['postImage'] == "true") {
                         echo '<div class="m-x-20">
                                   <img src="../data/user/postimage/' . $postRow['imageName'] . '" class="img-fluid" alt="Post Image" style="border-radius: 10px;">
                              </div>';
                    }

                    if ($postRow['postRating'] == "true") {

                    ?>
                         <div class="m-x-20 fs-20 flex post-rating-show" style="justify-content: space-between;">
                              <?php
                              $totalStar = 5;
                              if ($postRow['totalRating'] == 0) {
                                   $e = 1;

                                   while ($e <= $totalStar) {
                                        echo '<i class="fa-regular fa-star m-10 p-10 ratingStar" id="ratingStar' . $postRow['postSrNo'] . $e . '" data-star="' . $e . '" data-postStar="' . $postRow['postSrNo'] . '" onmouseover="ratingMouseOver(this)" onmouseout="ratingMouseOut(this)" onclick="ratingClicked(this)"></i>';
                                        $e++;
                                   }
                              } else {


                                   $checkRating = "SELECT * FROM `78000_postratings` WHERE `postSrNo` = '" . $postRow['postSrNo'] . "' AND `userUniqueCode` = '" . $_SESSION['userUniqueCode'] . "'";
                                   $fireCheckRating = mysqli_query($link, $checkRating);
                                   if (mysqli_num_rows($fireCheckRating) > 0) {
                                        while ($ratedDetails = mysqli_fetch_assoc($fireCheckRating)) {
                                             $ratedStar = $ratedDetails['star'];
                                        }
                                   } else {
                                        $ratedStar = 0;
                                   }

                                   $e = $ratedStar + 1;
                                   if ($ratedStar != 0) {
                                        $j = 1;
                                        while ($j <= $ratedStar) {
                                             echo '<i class="fa-solid fa-star m-10 p-10 ratingStar" id="ratingStar' . $postRow['postSrNo'] . $j . '" data-star="' . $j . '" data-postStar="' . $postRow['postSrNo'] . '" onmouseover="ratingMouseOver(this)" onmouseout="ratingMouseOut(this)" onclick="ratingClicked(this)"></i>';
                                             $j++;
                                        }
                                   }
                                   while ($e <= $totalStar) {
                                        echo '<i class="fa-regular fa-star m-10 p-10 ratingStar" id="ratingStar' . $postRow['postSrNo'] . $e . '" data-star="' . $e . '" data-postStar="' . $postRow['postSrNo'] . '" onmouseover="ratingMouseOver(this)" onmouseout="ratingMouseOut(this)" onclick="ratingClicked(this)"></i>';
                                        $e++;
                                   }
                              }
                              ?>

                         </div>
                         <div class="m-x-20">
                              <p class="m-y-10 font-poppins fw-500" style="font-size: 15px;" id="ratingData<?php echo $postRow['postSrNo'] ?>"><i class="fa fa-star" aria-hidden="true"></i> <?php echo $postRow['ratingPoint']; ?> • <?php echo $postRow['totalRating']; ?> Ratings</p>
                         </div>

                         <div data-rating="<?php echo $ratedStar; ?>" id="rating<?php echo $postRow['postSrNo']; ?>"></div>

                    <?php
                    }

                    if ($postRow['postPoll'] == "true") {
                    ?>
                         <div class="flex flex-d-column m-x-20 post-poll-show" id="postPoll<?php echo $postRow['postSrNo']; ?>">

                              <?php
                              $pollText = explode("||||PS||||", $postRow['pollText']);

                              $pollPercent = explode("||PPS||", $postRow['pollPercent']);
                              $pollVote = explode("||PPS||", $postRow['pollVote']);
                              $i = 0;

                              $checkVotedOrNot = "SELECT * FROM `78000_pollvote` WHERE `postId` = '" . $postRow['postSrNo'] . "' AND `userUniqueCode` = '" . $_SESSION['userUniqueCode'] . "'";
                              $fireCheckVotedOrNot = mysqli_query($link, $checkVotedOrNot);

                              if (mysqli_num_rows($fireCheckVotedOrNot) > 0) {
                                   $voteStatus = "voted";
                                   while ($pollVoteData = mysqli_fetch_assoc($fireCheckVotedOrNot)) {
                                        $alreadyVotedPollNum = $pollVoteData['pollVoted'];
                                   }
                              } else {
                                   $voteStatus = "";
                              }
                              while ($i < $postRow['pollCount']) {
                              ?>

                                   <!-- POLL -->
                                   <div class="pos-relative poll" data-pollNum="<?php echo $i + 1; ?>" data-post="<?php echo $postRow['postSrNo']; ?>" onclick="votePoll(this)">
                                        <div class="progress pos-absolute <?php
                                                                           if ($alreadyVotedPollNum == ($i + 1)) {
                                                                                echo $voteStatus;
                                                                           } ?>" style="width:<?php echo $pollPercent[$i]; ?>%">
                                        </div>
                                        <div class=" poll-content flex">
                                             <p class="font-poppins fw-500 poll-main-text" title="<?php echo $pollText[$i]; ?>"><?php echo $pollText[$i]; ?></p>


                                             <p class="font-poppins fw-500 poll-percent"><?php echo $pollPercent[$i]; ?>%</p>
                                        </div>
                                   </div>

                              <?php
                                   $i++;
                              } ?>

                              <p class="m-y-10 font-poppins fw-500" style="font-size: 15px;"><?php echo $postRow['totalPolls']; ?> votes</p>

                         </div>
                    <?php
                    }
                    ?>





                    <div class="ad-content flex p-y-10" style="justify-content: space-between;">
                         <div class="m-x-20 cursor-pointer ">
                              <p class="font-poppins flex e-c">
                                   <i class="fs-20 <?php echo $heartClass; ?> postHeartIcon<?php echo $postRow['postSrNo']; ?> hover-fc-red" onclick="postLike(this)" id="<?php echo $postRow['postSrNo']; ?>" data-oldHeartCount="<?php echo $postRow['totalLike']; ?>"></i> <span class="m-l-10" id="postHeartCount<?php echo $postRow['postSrNo']; ?>"> <?php echo $postRow['totalLike']; ?></span>
                              </p>
                         </div>
                         <div class="m-r-20 cursor-pointer hover-fc-primary flex" onclick="showCommentTab('<?php echo $postRow['postSrNo'] ?>')">
                              <p class="font-poppins">Comments <i class="fa fa-angle-down"></i></p>
                         </div>
                    </div>

                    <div class="ad-content m-x-20 flex flex-d-column none" id="show-comment-<?php echo $postRow['postSrNo'] ?>" data-commentStatus="noComments">
                    </div>

                    <div class="ad-content comment-box m-x-20  flex p-y-10">
                         <div class="cursor-pointer w-100per  flex">
                              <input type="text" placeholder="Write Comment ..." id="commentInput-<?php echo $postRow['postSrNo']; ?>" class="comment-input">
                              <a href="javascript:void(0)" class="hover-fc-primary p-10" onclick="commentPost(this)" data-commentPost="<?php echo $postRow['postSrNo']; ?>">
                                   <p class="font-poppins"><i class="fa-solid fa-paper-plane"></i></p>
                              </a>

                         </div>
                    </div>
               </div>
               <!-- Post -->

     <?php
          }
     } else {
          echo 0;
     }

     ?>

<?php
} else {
     echo 0;
}
?>