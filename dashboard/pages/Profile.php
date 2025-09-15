<?php
session_start();
require_once "../../connect/connectDb/config.php";
require_once "../../connect/function/timeago.php";
$_SESSION['path'] = "Profile";

$userDetails = $_SESSION['userDetails'];
$verificationStatus = "";
$lastPost = 24;
?>

<div class="flex e-c m-auto m-t-20" style="width: 90%;">
     <div class="flex flex-d-column e-c" style="max-width: 700px; width:100%;">
          <div class="post flex flex-d-column w-100per" style="padding-bottom:20px;">

               <div class="flex flex-d-column e-c" style="background-color: var(--clr-4);">

                    <div class="w-100per pos-relative flex e-c" style="height:150px; overflow:hidden;">
                         <img src="../media/Images/coverphoto.png" alt="banner" class="pos-absolute w-100per" style="height: auto;">
                    </div>
                    <div class="pos-relative flex" style="width: 95%; height: 100px; overflow:hidden; top:100%; left:0; transform:translate( 0,-50%);  justify-content:space-between; align-items:flex-end; ">

                         <div style="max-width:80px; width:100%; border-radius:100%; height: 80px; border: 5px solid var(--clr-1);">
                              <img src="<?php
                                        if (!empty($_SESSION['userDetails'][9])) {
                                             echo '../data/user/userProfile/' . $_SESSION['userDetails'][9];
                                        } else {
                                             echo '../media/Images/img_user.png';
                                        }
                                        ?>" class="img-fluid" id="userLogo" alt="logo" style="border-radius:100%; background-color:var(--clr-1);">
                         </div>

                         <div class="flex">
                              <a href="javascript:void(0)" onclick="displaythis('#','verification-mode')" class="btn-profile-mode m-b-10"> Mode </a>
                              <a href="javascript:void(0)" onclick="dashboardLoad('Edit-Profile','inSidePage')" class="btn-profile-mode m-b-10 m-l-10"><i class="fa fa-pencil" aria-hidden="true"></i> Edit </a>
                         </div>



                    </div>

               </div>
               <div class="flex flex-d-column m-x-20">
                    <p class="sub-heading font-poppins "><?php echo $userDetails[1]; ?></p>
                    <p class=" font-poppins" style="font-size: 13px;">@<?php echo $userDetails[5]; ?></p>
                    <div class="flex m-t-10">
                         <div class="flex e-c">
                              <p class="fs-10"><i class="fas fa-envelope" style="color: #0080ff;"></i></p>
                              <p class=" font-poppins fs-10 fw-500" style="margin-left: 2px;"> <?php echo $userDetails[2]; ?> </p>
                         </div>

                         <?php
                         if ($userDetails[6] == 0) {
                              $cc = "red";
                              $verificationStatus = "Not Verified";
                         } else {
                              $cc = "#0080ff";
                              $verificationStatus = "Verified";
                         }
                         ?>

                         <div class="flex e-c m-l-20">
                              <p class="fs-10"><i class="fas fa-user-check" style="color: <?php echo $cc; ?>;"></i></p>
                              <p class="font-poppins fs-10 fw-500" style="margin-left: 2px;"> <?php echo $verificationStatus; ?> </p>
                         </div>

                    </div>

                    <div class="flex m-t-10">
                         <div class="flex e-c cursor-pointer" onclick="copyThis('refLink')">
                              <p class="fs-10"><i class="fas fa-link" style="color: #0080ff;"></i></p>
                              <p class=" font-poppins fs-10 fw-500" style="margin-left: 2px;" title="Click to copy" id="refLink">https://www.edubliss.in/ref/<?php echo $userDetails[5]; ?> </p>
                         </div>

                    </div>
                    <!-- <p class=" font-poppins m-t-10" style="font-size: 13px;"> * You will be able to edit your profile very soon. *</p> -->

               </div>

          </div>
     </div>
</div>
<!-- Post  -->

<div class="flex e-c m-auto" style="width: 90%;">
     <div class="flex flex-d-column e-c" style="max-width: 700px; width:100%;">
          <div class="w-100per Write-post" id="Write-post" style="margin-bottom: 5px;">
               <form class="flex flex-d-column" id="writePostForm" method="POST" action="" enctype="multipart/form-data">
                    <div class="input" id="mainWriteBox">
                         <div id="ImageInputContainer">
                              <!-- IMAGE INPUT WILL BE PLACED HERE -->
                              <input type="file" style="display: none;" accept="image/png, image/jpg, image/jpeg" name="postImage" id="Upload-Post-Image" onchange="displayPostImage(this)">

                         </div>
                         <textarea name="postText" id="postText" rows="4" placeholder="Write Something .."></textarea>

                         <div class="pos-relative none" id="PostImageViewer">

                              <img src="" class="img-fluid" alt="Post Image" id="post-image-viewer" onclick="triggerClick('Upload-Post-Image')" title="Click to change the Image" style="cursor:pointer;">

                              <div class="flex e-c border-radius-100per overflow-hidden m-10 pos-absolute" style="background-color: #00000020; width: 40px; height:40px; top:0; right:0; z-index:0;" id="Remove-Post-Photo" onclick="removePostImage()">
                                   <i class="fas fa-times fs-20 cursor-pointer"></i>
                              </div>

                         </div>

                         <div class="pos-relative none" style="background-color: var(--clr-4);" id="WriteRatingPost">


                              <div id="ratingInputContainer">
                                   <!-- Rating input will be show here -->
                              </div>

                              <div class="flex e-c border-radius-100per overflow-hidden m-10 pos-absolute " style="background-color: #00000020; width: 40px; height:40px; top:0; right:0;" id="Remove-Post-Photo" onclick="postRemoveRating('WriteRatingPost')">
                                   <i class="fas fa-times fs-20 cursor-pointer"></i>
                              </div>
                         </div>

                         <div class="pos-relative none" style="background-color: var(--clr-4);" id="WritePollPost">
                              <div class="flex flex-d-column post-poll-show" style="margin:0 10px 5px 10px; padding-bottom:10px;">

                                   <div class="flex flex-d-column w-100per m-t-50" id="pollInputContainer">
                                        <!-- POLL INPUT WILL BE SHOWN HERE -->

                                   </div>

                                   <div class="flex e-c border-radius-100per overflow-hidden m-y-10" style="background-color: #00000020; width: 40px; height:40px;" id="Add-One-More-Poll" onclick="addMorePollInput()" data-pollNum="3">
                                        <i class="fas fa-plus fs-20 cursor-pointer"></i>
                                   </div>
                              </div>

                              <div class="flex e-c border-radius-100per overflow-hidden m-10 pos-absolute " style="background-color: #00000020; width: 40px; height:40px; top:0; right:0;" id="Remove-Post-Photo" onclick="postRemovePoll('WritePollPost')">
                                   <i class="fas fa-times fs-20 cursor-pointer"></i>
                              </div>
                         </div>


                    </div>

                    <div class="flex w-100per" style="justify-content: space-between; font-size:15px;">
                         <div class="flex">
                              <div class="p-y-10 input-btn cursor-pointer" id="Photo-Uploader-Btn" onclick="triggerClick('Upload-Post-Image')">
                                   <p class="font-poppins"> <i class="fas fa-image"></i> </p>
                              </div>
                              <div class="p-y-10 input-btn cursor-pointer m-l-10" id="Rating-Create-Btn" onclick="postCreateRating('WriteRatingPost')">
                                   <p class="font-poppins"> <i class="fa fa-star" aria-hidden="true"></i> </p>
                              </div>
                              <div class="p-y-10 input-btn cursor-pointer m-l-10" id="Poll-Create-Btn" onclick="postCreatePoll('WritePollPost')">
                                   <p class="font-poppins"> <i class="fas fa-poll"></i> </p>
                              </div>
                         </div>
                         <div class="p-y-10 input-btn cursor-pointer" id="submitPost" onclick="submitPost()">
                              <p class="font-poppins"><i class="fa-solid fa-paper-plane"></i> Post </p>
                         </div>

                    </div>
               </form>
          </div>






          <div class="show-post flex flex-d-column w-100per">
               <?php

               $selectingPost = "SELECT * FROM `78000_posts` WHERE `postVisibility` = 'public' AND `userUniqueCode` = '" . $_SESSION['userUniqueCode'] . "' ORDER BY postSrNo DESC LIMIT 0,$lastPost";
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
                                             <a href="javascript:void(0)" target="_blank">
                                                  <img src="../data/user/userProfile/<?php echo $postRow['userLogo']; ?>" alt="<?php echo $postRow['userLogo']; ?> logo" class="img-fluid border-radius-100per" style="margin-top: 3px; max-width:50px;">
                                             </a>
                                        </div>
                                        <div class="m-l-10">
                                             <a href="javascript:void(0)" target="_blank">
                                                  <p class="fc-dark-blue fw-600" style="font-size: 16px;"><?php echo $postRow['userFullName']; ?></p>
                                             </a>
                                             <p class="fc-primary fw-500" style="font-size: 12px;"><?php echo time_elapsed_string($postRow['postTime']); ?></p>
                                        </div>
                                   </div>
                                   <div class="flex e-c pos-relative">
                                        <a href="javascript:void(0)" class="p-10 fs-20 hover-fc-primary" onclick="deletePost(this)" data-post="<?php echo $postRow['postSrNo']; ?>"> <i class="fa-solid fa-trash"></i> </a>
                                   </div>
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
               }

               ?>
               <div id="End" class="p-y-10" style="display: block;"></div>


          </div>
     </div>
</div>



<script id="HomePageScript">
     $(document).ready(function() {
          let fromVal = <?php echo $lastPost; ?>;
          let postEnd = "False";
          const endContainer = document.getElementById('End');

          window.addEventListener('scroll', () => {
               const {
                    scrollHeight,
                    scrollTop,
                    clientHeight
               } = document.documentElement;

               if (scrollTop + clientHeight >= scrollHeight) {
                    if (postEnd == "False") {
                         $.post('./pages/More-Post.php', {
                                   fromVal: fromVal,
                                   loadCount: 49,
                                   sign: "="
                              },
                              function(data, status) {
                                   if (data == 0) {
                                        postEnd = "True";
                                        return;
                                   } else {
                                        endContainer.insertAdjacentHTML('beforebegin', data);
                                   }
                              });
                         fromVal = fromVal + 50;
                    }

               }
          });
     });

     function deletePost(e) {
          let post = e.getAttribute('data-post');
          const postUI = document.getElementById(`post${post}`);
          if (post == "" || post == null) {

          } else {
               $.post('./actions/deletePost.php', {
                         post: post
                    },
                    function(data, status) {
                         if (data == 1) {
                              alert("Deleted Successfully!");
                              postUI.remove();
                         }
                    });
          }
     }

     function copyThis(e) {
          let elmId = e;
          let value = $(`#${elmId}`).html();

          navigator.clipboard.writeText(value);
     }

</script>