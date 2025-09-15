<?php
session_start();
require_once "../../connect/connectDb/config.php";
require_once "../../connect/function/timeago.php";
$_SESSION['path'] = "Home";
$lastPost = 24;
?>
<div class="flex e-c m-auto" style="width: 95%;">
     <div class="flex flex-d-column e-c pos-relative" style="max-width: 700px; width:100%;">
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

               $selectingPost = "SELECT * FROM `78000_posts` WHERE `postVisibility` = 'public' ORDER BY postSrNo DESC LIMIT 0,$lastPost";
               $fireSelectingPost = mysqli_query($link, $selectingPost);

               if (mysqli_num_rows($fireSelectingPost) > 0) {
                    while ($postRow = mysqli_fetch_assoc($fireSelectingPost)) {
                              $heartClass = "fa-regular fa-heart";
               ?>

                         <!-- Post -->
                         <div class="post w-100per flex flex-d-column" id="post<?php echo $postRow['postSrNo']; ?>">
                              <div class="post-top-bar flex pos-relative">
                                   <div class="flex e-c m-b-10">
                                        <div class=" flex e-c" style="max-width: 35px;">
                                             <a href="javascript:void(0)">
                                                  <img src="../data/user/userProfile/<?php echo $postRow['userLogo']; ?>" alt="<?php echo $postRow['userLogo']; ?> logo" class="img-fluid border-radius-100per" style="margin-top: 3px; max-width:50px;">
                                             </a>
                                        </div>
                                        <div class="m-l-10">
                                             <a href="javascript:void(0)">
                                                  <p class="fc-dark-blue fw-600" style="font-size: 16px;"><?php echo $postRow['userFullName']; ?></p>
                                             </a>
                                             <p class="fc-primary fw-500" style="font-size: 12px;"><?php echo time_elapsed_string($postRow['postTime']); ?></p>
                                        </div>
                                   </div>
                                   <div class=" flex e-c pos-relative">

                                        <?php

                                        if($postRow['postByUserStatus'] == "verified_user"){

                                        ?>

                                        <div class="flex e-c">
                                        <div class="p-5" style="border-radius:100%; background-color:var(--clr-3);">
                                             <i class="fas fa-star"></i>
                                             
                                        </div>
                                        <p class="font-poppins" style="margin-left:7px;">Verified</p>
                                        </div>

                                        <?php
                                             }
                                        ?>


                                        

                                        <!-- <a href="javascript:void(0)" class="p-10 fs-20" onClick="displaythis('#','postMenu')"> <i class="fas fa-ellipsis-v"></i> </a>

                                        <div class="flex flex-d-column pos-absolute none" style="top: 20px; right:30px;" id="postMenu">
                                             <div class="fs-20 font-poppins cursor-pointer m-y-10" style="padding:10px 20px; background-color:var(--clr-1);border: 2px solid var(--clr-9); border-radius:10px; box-shadow: 0 0 10px 0 var(--shadow-clr); margin:2px 0;">Report</div>
                                        </div> -->
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


                                             
                                             $ratedStar = 0;

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

                                        
                                        $voteStatus = "";
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
                                   sign: "!="
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

     function newPost() {
          if (notTopNewPost == "False") {
               $("#Write-post-Top").load('./component/write-post.html', function() {
                    $("#notTop").toggleClass('none');
                    notTopNewPost = "True";
               });
          } else {
               $("#Write-post-Top").html("");
               $("#notTop").toggleClass('none');
               notTopNewPost = "False";
          }
     }
</script>