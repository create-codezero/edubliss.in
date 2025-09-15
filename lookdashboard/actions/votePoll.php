<?php
session_start();
require_once "../../connect/connectDb/config.php";


if (isset($_POST['voteThis'])) {
     $postId = $_POST['post'];
     $pollNum = $_POST['pollNum'];
     $userUniqueCode = $_SESSION['userUniqueCode'];

     $outputHTML = '';

     //TIME AND DATE 
     date_default_timezone_set('Asia/Calcutta');
     $date = date("Y-m-d");
     $time = date("H:i:s");

     $dateTime = $date . " " . $time;

     $gettingThePostDetails = "SELECT * FROM `78000_posts` WHERE `postSrNo` = '$postId' AND `postPoll` = 'true'";
     $fireGettingThePostDetails = mysqli_query($link, $gettingThePostDetails);

     if (mysqli_num_rows($fireGettingThePostDetails) > 0) {
          while ($postDetailRow = mysqli_fetch_assoc($fireGettingThePostDetails)) {

               $nowPollVote = "";
               $nowPollPercent = "";
               $pollText = explode("||||PS||||", $postDetailRow['pollText']);
               $pollVote = explode("||PPS||", $postDetailRow['pollVote']);
               $pollPercent = explode("||PPS||", $postDetailRow['pollPercent']);

               // Checking whether user Already Voted OR not
               $checkVotedOrNot = "SELECT * FROM `78000_pollvote` WHERE `postId` = '$postId' AND `userUniqueCode` = '$userUniqueCode'";
               $fireCheckVotedOrNot = mysqli_query($link, $checkVotedOrNot);

               if (mysqli_num_rows($fireCheckVotedOrNot) > 0) {
                    $nowTotalPolls = $postDetailRow['totalPolls'];

                    while ($pollVoteData = mysqli_fetch_assoc($fireCheckVotedOrNot)) {
                         $alreadyVotedPollNum = $pollVoteData['pollVoted'];
                    }

                    $i = 0;
                    while ($i < $postDetailRow['pollCount']) {
                         if (($i + 1) == $pollNum) {
                              $increasedPollVote = $pollVote[$i] + 1;
                              $percentage = floor($increasedPollVote / $nowTotalPolls * 100);

                              // Creating New Values
                              if (($i + 1) == $postDetailRow['pollCount']) {
                                   $nowPollVote .= $increasedPollVote;
                                   $nowPollPercent .= $percentage;
                              } else {
                                   $nowPollVote .= $increasedPollVote . "||PPS||";
                                   $nowPollPercent .= $percentage . "||PPS||";
                              }

                              $outputHTML .= '<div class="pos-relative poll" data-pollNum="' . ($i + 1) . '" data-post="' . $postId . '" onclick="votePoll(this)">
                                                  <div class="progress pos-absolute voted" style="width:' . $percentage . '%">
                                                  </div>
                                                  <div class=" poll-content flex">
                                                       <p class="font-poppins fw-500 poll-main-text" title="' . $pollText[$i] . '">' . $pollText[$i] . '</p>


                                                       <p class="font-poppins fw-500 poll-percent">' . $percentage . '%</p>
                                                  </div>
                                             </div>';
                         } else if (($i + 1) == $alreadyVotedPollNum) {
                              $drecreasedVote = $pollVote[$i] - 1;
                              $percentage = floor($drecreasedVote / $nowTotalPolls * 100);

                              // Creating New Values
                              if (($i + 1) == $postDetailRow['pollCount']) {
                                   $nowPollVote .= $drecreasedVote;
                                   $nowPollPercent .= $percentage;
                              } else {
                                   $nowPollVote .= $drecreasedVote . "||PPS||";
                                   $nowPollPercent .= $percentage . "||PPS||";
                              }

                              $outputHTML .= '<div class="pos-relative poll" data-pollNum="' . ($i + 1) . '" data-post="' . $postId . '" onclick="votePoll(this)">
                                                  <div class="progress pos-absolute" style="width:' . $percentage . '%">
                                                  </div>
                                                  <div class=" poll-content flex">
                                                       <p class="font-poppins fw-500 poll-main-text" title="' . $pollText[$i] . '">' . $pollText[$i] . '</p>


                                                       <p class="font-poppins fw-500 poll-percent">' . $percentage . '%</p>
                                                  </div>
                                             </div>';
                         } else {
                              $percentage = floor($pollVote[$i] / $nowTotalPolls * 100);

                              // Creating New Values
                              if (($i + 1) == $postDetailRow['pollCount']) {
                                   $nowPollVote .= $pollVote[$i];
                                   $nowPollPercent .= $percentage;
                              } else {
                                   $nowPollVote .= $pollVote[$i] . "||PPS||";
                                   $nowPollPercent .= $percentage . "||PPS||";
                              }

                              $outputHTML .= '<div class="pos-relative poll" data-pollNum="' . ($i + 1) . '" data-post="' . $postId . '" onclick="votePoll(this)">
                                                  <div class="progress pos-absolute" style="width:' . $percentage . '%">
                                                  </div>
                                                  <div class=" poll-content flex">
                                                       <p class="font-poppins fw-500 poll-main-text" title="' . $pollText[$i] . '">' . $pollText[$i] . '</p>


                                                       <p class="font-poppins fw-500 poll-percent">' . $percentage . '%</p>
                                                  </div>
                                             </div>';
                         }
                         $i++;
                    }
               } else {
                    $nowTotalPolls = $postDetailRow['totalPolls'] + 1;

                    $i = 0;
                    while ($i < $postDetailRow['pollCount']) {
                         if (($i + 1) == $pollNum) {
                              $increasedPollVote = $pollVote[$i] + 1;
                              $percentage = floor($increasedPollVote / $nowTotalPolls * 100);

                              // Creating New Values
                              if (($i + 1) == $postDetailRow['pollCount']) {
                                   $nowPollVote .= $increasedPollVote;
                                   $nowPollPercent .= $percentage;
                              } else {
                                   $nowPollVote .= $increasedPollVote . "||PPS||";
                                   $nowPollPercent .= $percentage . "||PPS||";
                              }

                              $outputHTML .= '<div class="pos-relative poll" data-pollNum="' . ($i + 1) . '" data-post="' . $postId . '" onclick="votePoll(this)">
                                                  <div class="progress pos-absolute voted" style="width:' . $percentage . '%">
                                                  </div>
                                                  <div class=" poll-content flex">
                                                       <p class="font-poppins fw-500 poll-main-text" title="' . $pollText[$i] . '">' . $pollText[$i] . '</p>


                                                       <p class="font-poppins fw-500 poll-percent">' . $percentage . '%</p>
                                                  </div>
                                             </div>';
                         } else {
                              $percentage = floor($pollVote[$i] / $nowTotalPolls * 100);

                              // Creating New Values
                              if (($i + 1) == $postDetailRow['pollCount']) {
                                   $nowPollVote .= $pollVote[$i];
                                   $nowPollPercent .= $percentage;
                              } else {
                                   $nowPollVote .= $pollVote[$i] . "||PPS||";
                                   $nowPollPercent .= $percentage . "||PPS||";
                              }

                              $outputHTML .= '<div class="pos-relative poll" data-pollNum="' . ($i + 1) . '" data-post="' . $postId . '" onclick="votePoll(this)">
                                                  <div class="progress pos-absolute " style="width:' . $percentage . '%">
                                                  </div>
                                                  <div class=" poll-content flex">
                                                       <p class="font-poppins fw-500 poll-main-text" title="' . $pollText[$i] . '">' . $pollText[$i] . '</p>


                                                       <p class="font-poppins fw-500 poll-percent">' . $percentage . '%</p>
                                                  </div>
                                             </div>';
                         }
                         $i++;
                    }
               }
          }

          $insertStage4 = "UPDATE `78000_posts` SET `pollPercent`='$nowPollPercent',`totalPolls`='$nowTotalPolls', `pollVote`='$nowPollVote' WHERE postSrNo = '$postId'";
          $fireInsertStage4 = mysqli_query($link, $insertStage4);

          if ($fireInsertStage4) {
               if (mysqli_num_rows($fireCheckVotedOrNot) > 0) {
                    $insetInPollVote = "UPDATE `78000_pollvote` SET `pollVoted`='$pollNum' WHERE `postId` = '$postId' AND `userUniqueCode` = '$userUniqueCode' AND `userUniqueCode` = '$userUniqueCode'";
                    $fireInsertPollVote = mysqli_query($link, $insetInPollVote);
               } else {
                    $insetInPollVote = "INSERT INTO `78000_pollvote`(`postId`, `pollVoted`, `userUniqueCode`, `pollVoteTime`) VALUES ('$postId','$pollNum','$userUniqueCode','$dateTime')";
                    $fireInsertPollVote = mysqli_query($link, $insetInPollVote);
               }


               if ($fireInsertPollVote) {
                    $outputHTML .= '<p class="m-y-10 font-poppins fw-500" style="font-size: 15px;">' . $nowTotalPolls . ' votes</p>';
                    echo $outputHTML;
               } else {
                    echo "Not Voted! : Some Problem Occured!";
               }
          } else {
               echo "Invalid Post!";
          }

          // 
     } else {
          echo "Invalid Post!";
     }
}
