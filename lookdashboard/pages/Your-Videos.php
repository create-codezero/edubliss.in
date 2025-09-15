<?php
session_start();
require_once "../../connect/connectDb/config.php";
$_SESSION['path'] = "Your-Videos";

$noChannel = 0;
$lastVideo = 24;

if (!isset($_SESSION['remainingCoin']) || !isset($_SESSION['channelUniCode'])) {
     $channelDetailQuery = "SELECT * FROM `78000_channels` WHERE channelUser = '" . $_SESSION['userUniqueCode'] . "'";
     $fireChannelDetailQuery = mysqli_query($link, $channelDetailQuery);

     if (mysqli_num_rows($fireChannelDetailQuery) > 0) {
          while ($channelDetailRow = mysqli_fetch_assoc($fireChannelDetailQuery)) {
               $_SESSION['remainingCoin'] = $channelDetailRow['remainingCoin'];
               $_SESSION['channelUniCode'] = $channelDetailRow['channelUniCode'];
          }
     } else {
          $noChannel = 1;
     }
}

if ($noChannel == 1) {

?>
     <div class="flex flex-d-column e-c p-y-50">
          <p class="tx-center fw-500 fs-30 m-20">Please Make a Channel first then you will be able to use this feature.</p>
          <br>
          <button class="btn btn-gra-purple cursor-pointer" onclick="loadContent('Your-Channel')"> Make Channel </button>
     </div>


<?php
} else {
?>



     <div class="flex flex-d-column w-100per">

          <div class="flex m-30" style="justify-content: space-between; align-items:center;">

               <div>
                    <a href="javascript:void(0)" title="Go Back">
                         <i class="fas fa-arrow-left" style="margin:10px 10px; "></i>
                    </a>
               </div>


               <div class="flex" style="align-items: center;">
                    <a href="javascript:void(0)" style="color: var(--clr-2);" title="Your Coins : <?php echo $_SESSION['remainingCoin']; ?>" class="fw-60 font-poppins">
                         <p style="margin:10px 0;"><i class="fas fa-coins"></i> <span id="currentCoins" class="fw-500"><?php echo $_SESSION['remainingCoin']; ?></span></p>
                    </a>
                    <a href="javascript:void(0)" onclick="
                    <?php
                    if ($_SESSION['remainingCoin'] > 10) {
                         echo "loadContent('Video-Details')";
                    } else {
                         echo " alertThis(' Please Collect atleast 10 Coin to Upload video. ') ";
                    }
                    ?>" title="Upload" class="fw-60 font-poppins m-x-10">
                         <i class="fa fa-upload" style="margin:10px 10px;"></i>
                    </a>
                    <a href="javascript:void(0)" onclick="loadContent('Your-Channel')" title="Your Channel" class="font-poppins">
                         <i class="fa fa-user" style="margin:10px 10px;"></i>
                    </a>
               </div>

          </div>

          <p class="tx-center fs-30 font-poppins fw-500">Your Videos</p>

          <div class="m-b-20" id="main-watch-box">


               <div class="grid grid-column-5 tab-grid-column-3 mob-grid-column-1  grid-gap-15 m-20 mob-m-10">

                    <?php

                    $selectingAllVideos = "SELECT * FROM `78000_videos` WHERE channelUniCode = '" . $_SESSION['channelUniCode'] . "' ORDER BY videoSrNo DESC";
                    $fireSelectingAllVideos = mysqli_query($link, $selectingAllVideos);
                    if (mysqli_num_rows($fireSelectingAllVideos) > 0) {
                         while ($row = mysqli_fetch_assoc($fireSelectingAllVideos)) {
                    ?>

                              <!-- Watch Card -->
                              <div class="watch-card font-poppins">
                                   <a href="javascript:void(0)">
                                        <div class="thumbnail" id="<?php echo $row['videoUniCode']; ?>">
                                             <img src="../data/user/videothumbnail/<?php echo $row['videoThumbnail']; ?>" alt="<?php echo $row['videoTitle']; ?>" class="img-fluid">
                                        </div>
                                        <div class="metadata w-100per flex m-t-10">
                                             <div>

                                                  <a href="https://www.youtube.com/<?php echo $row['channelId']; ?>" target="_blank">
                                                       <img src="../data/user/channellogo/<?php echo $row['channelLogo']; ?>" alt="Channel logo" style="border-radius: 100%; max-height:35px; height:100%;">
                                                  </a>

                                             </div>
                                             <div class="flex tx-left m-l-10 flex-d-column" style="justify-content: center;">
                                                  <p class="fw-600" style="font-size: 13px;"><?php
                                                                                               if (strlen($row['videoTitle']) > 49) {
                                                                                                    echo substr($row['videoTitle'], 0, 49) . "...";
                                                                                               } else {
                                                                                                    echo $row['videoTitle'];
                                                                                               } ?> </p>

                                                  <p class="fw-500" style="font-size: 12px; margin-top:2px;"><?php echo $row['channelName']; ?> • <?php echo $row['videoViews']; ?> Views </p>

                                                  <p class="fw-500" style="font-size: 12px; margin-top:2px;">Watchtime : <?php echo $row['videoWatchtime']; ?> Min </p>

                                                  <p class="fw-500" style="font-size: 12px; margin-top:2px;">Coins : <?php echo $row['remainingCoins']; ?> <i class="fas fa-coins"></i> <a href="javascript:void(0)" class="fw-600" style="font-size: 15px; color: var(--primary);" data-video="<?php echo $row['videoSrNo'] ?>" onclick="addCoin(this)"> + Add</a> </p>
                                             </div>
                                        </div>
                                        <div class="flex m-t-10" style="border:2px solid var(--clr-4); border-top:none;">
                                             <a href="javascript:void(0)" class="w-100per tx-center video-action-btn" onclick="editVideo('<?php echo $row['videoUniCode']; ?>')">Edit</a>
                                             <div class="divider"></div>
                                             <a href="javascript:void(0)" class="w-100per tx-center video-action-btn" onclick="showFeedbacks('<?php echo $row['videoUniCode']; ?>')">Feedbacks</a>
                                        </div>
                                   </a>
                              </div>

                    <?php
                         }
                    } else {
                         echo '<pre class="tx-center m-auto pos-absolute font-poppins fs-20" style="width:95%;">You didn' . "'" . 't uploaded any video yet!</pre>';
                    }
                    ?>

                    <div id="End"></div>



               </div>

          </div>

     <?php
}
     ?>

     <!-- Add coin pop up -->

     <div class="sector z-2 pos-fixed flex e-c none flex-d-column h-100vh" id="addCoin-pop" style="top: 0; left:0; background-color: var(--shadow-clr);">


          <div class="form-box bg-clr-1 pop-up-box">
               <div class="main-box">
                    <div class="block tx-right w-100per" onclick="clickOn('addCoin-pop')">
                         <i class="fa fa-times fc-dark-blue fs-20 cursor-pointer hover-fc-primary" aria-hidden="true" style="padding: 15px 20px;"></i>
                         <hr class="bg-dark-blue">
                    </div>
                    <form class="m-t-20">
                         <?php
                         $userDetails = $_SESSION['userDetails'];
                         ?>
                         <p class="fs-20 tx-center" id="mailsentmsg">Add Coin</p>
                         <p class="fs-15 fw-500 mailsenthideit" style="margin-top: 20px; margin-left: 2px;">Enter Coin</p>
                         <div class="input mailsenthideit">
                              <input type="number" name="coin" id="coin" placeholder="Enter Number of Coin" class="mailsenthideit" required>
                         </div>

                         <p class="fs-10 tx-center m-t-10 mailsenthideit"> Enter how much coin you want to add. </p>


                         <a class="btn btn-gra-purple cursor-pointer mailsenthideit" style="margin: 20px auto 10px;" onclick="addCoinSubmit(this)" href="javascript:void(0)" id="addCoinSubmit" data-video="none">Add Coin</a>
                    </form>
               </div>
          </div>

     </div>

     <script>
          $(document).ready(function() {
               let fromVal = <?php echo $lastVideo; ?>;
               let videoEnd = "False";
               const endContainer = document.getElementById('End');

               window.addEventListener('scroll', () => {
                    const {
                         scrollHeight,
                         scrollTop,
                         clientHeight
                    } = document.documentElement;

                    if (scrollTop + clientHeight >= scrollHeight) {
                         if (videoEnd == "False") {
                              $.post('./pages/More-Video.php', {
                                        fromVal: fromVal,
                                        loadCount: 49,
                                        sign: "="
                                   },
                                   function(data, status) {
                                        if (data == 0) {
                                             videoEnd = "True";
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

          function playVideo(element) {
               var videoId = element.id;
               $(`#loading`).toggleClass("none");

               $(`#Content`).load(`./pages/Watch.php?videoId=${videoId}`, function() {
                    $(`#loading`).toggleClass("none");

                    const state = {
                         'page_id': 1,
                         'user_id': 5
                    };
                    const title = '';
                    const url = `play-${videoId}`;

                    history.pushState(state, title, url);
               });
          }

          function showFeedbacks(element) {
               var videoId = element;
               $(`#loading`).toggleClass("none");

               $(`#Content`).load(`./pages/Feedbacks.php?videoId=${videoId}`, function() {
                    $(`#loading`).toggleClass("none");

                    const state = {
                         'page_id': 1,
                         'user_id': 5
                    };
                    const title = '';
                    const url = `feedbacks-${videoId}`;

                    history.pushState(state, title, url);
               });
          }

          function editVideo(element) {
               var videoId = element;
               $(`#loading`).toggleClass("none");

               $(`#Content`).load(`./pages/Edit.php?videoId=${videoId}`, function() {
                    $(`#loading`).toggleClass("none");

                    const state = {
                         'page_id': 1,
                         'user_id': 5
                    };
                    const title = '';
                    const url = `edit-${videoId}`;

                    history.pushState(state, title, url);
               });
          }

          function addCoin(e) {
               let video = e.getAttribute('data-video');

               document.getElementById('addCoinSubmit').setAttribute('data-video', video);
               clickOn('addCoin-pop');
          }

          function addCoinSubmit(e) {
               let video = e.getAttribute('data-video');
               let value = $("#coin").val();
               let currentCoin = document.getElementById('currentCoins').innerHTML;

               if (value != "" && value != null) {
                    if (parseInt(value) <= currentCoin) {
                         $.post('./actions/addCoin.php', {
                                   addCoin: "set",
                                   video: video,
                                   coin: value
                              },
                              function(data, status) {
                                   if (data != 0) {
                                        alert("Coin Added!");
                                        dashboardLoad('Your-Videos', 'Side-Menu');
                                        clickOn('side-menu');
                                   } else {
                                        alert("Error!");
                                   }
                              });
                    } else {
                         alert("Value greater than wallet coins.");
                    }
               } else {
                    alert("Empty Input OR Alphabet In Input");
               }
          }
     </script>