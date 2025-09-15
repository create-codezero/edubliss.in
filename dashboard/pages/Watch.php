<?php
session_start();
require_once "../../connect/connectDb/config.php";
require_once "../../connect/function/timeago.php";

$videoId = $_GET['videoId'];

$findVideo = "SELECT * FROM `78000_videos` WHERE `videoUniCode` = '" . $videoId . "'";
$fireFindVideo = mysqli_query($link, $findVideo);

$videoTitle = "";
$videoDescription = "";
$videoTags = "";
$videoLink = "";
$videoUniCode = "";
$videoThumbnail = "";
$videoCategory = "";
$channelId = "";
$channelUniCode = "";
$channelName = "";
$channelLogo = "";
$videoUserUniCode = "";
$videoImpressions = "";
$videoViews = "";
$videoCtr = "";

if (mysqli_num_rows($fireFindVideo) > 0) {
     while ($rows = mysqli_fetch_assoc($fireFindVideo)) {
          $videoTitle = $rows['videoTitle'];
          $videoDescription = $rows['videoDescription'];
          $videoTags = $rows['videoTags'];
          $videoLink = $rows['videoLink'];
          $videoThumbnail = $rows['videoThumbnail'];
          $videoCategory = $rows['videoCategory'];
          $channelId = $rows['channelId'];
          $channelUniCode = $rows['channelUniCode'];
          $channelName = $rows['channelName'];
          $channelLogo = $rows['channelLogo'];
          $channelDesc = $rows['channelDesc'];
          $videoImpressions = $rows['videoImpressions'];
          $videoViews = $rows['videoViews'];
          $videoCtr = $rows['videoCtr'];
     }
} else {
     header('location: ../dashboard/');
}
?>


     <div class="flex m-20" style="justify-content: space-between; align-items:center;">


          <!-- <div class="flex" style="align-items: center;">
               <a href="javascript:void(0)" style="color: var(--clr-2);" title="Your Coins :" class="fw-60 font-poppins">
                    <p style="margin:10px 0;"><i class="fas fa-coins"></i> <span id="currentCoins" class="fw-500"></span></p>
               </a>
               <a href="javascript:void(0)" title="Upload" onclick="loadContent('Your-Videos')" class="fw-60 font-poppins m-x-10">
                    <i class="fa fa-upload" style="margin:10px 10px;"></i>
               </a>
               <a href="javascript:void(0)" onclick="loadContent('Your-Channel')" title="Your Channel" class="font-poppins">
                    <i class="fa fa-user" style="margin:10px 10px;"></i>
               </a>
          </div> -->

     </div>

     <div class="m-b-20" id="main-watch-box">

          <div class="flex m-10" id="watch-video-page">

               <div class="m-10" style="max-width: 70%; width:100%; ">

                    <div class="watch-video-box" id="video-player-div">
                         <div class="iframe-container">
                              <div id="player"></div>
                         </div>
                    </div>

                    <div class="flex m-t-30 cursor-pointer" style="justify-content: space-between;" onclick="displaythis('#', 'videoDescription')" title="View Description">
                         <div class="tx-left">
                              <p class="fw-500" style="font-size: 18px;"><?php echo $videoTitle; ?> </p>
                              <p class="fw-400" style="font-size: 10px; margin-top:2px;"><?php echo substr($videoDescription, 0, 24); ?> ... </p>
                         </div>
                         <a href="javascript:void(0)">
                              <div>
                                   <i class="fa fa-angle-down p-10"></i>
                              </div>
                         </a>

                    </div>

                    <!-- Description -->
                    <div class="flex m-t-10 none" style="justify-content: space-between;" id="videoDescription">
                         <div class="tx-left m-x-10">
                              <pre class="font-poppins m-t-10" style="text-align: left; margin:0; white-space: pre-wrap; white-space: -moz-pre-wrap; white-space: -pre-wrap white-space: -o-pre-wrap; word-wrap: break-word;"><p class="fw-400" style="font-size: 14px; text-align:start;"><?php echo $videoDescription ?></p></pre>
                         </div>
                    </div>

                    <!-- Channel -->
                    <!-- • -->

                    <div class="flex m-t-10 p-y-10" style="border-top: 2px solid var(--clr-4); border-bottom: 2px solid var(--clr-4); justify-content:space-between;">

                         <div class="flex w-100per">
                              <div class="flex e-c">

                                   <img src="../data/user/channellogo/<?php echo $channelLogo; ?>" alt="Channel logo" style="border-radius: 100%; max-height:45px; height:100%;">

                              </div>
                              <div class="flex tx-left m-l-10 flex-d-column" style="justify-content:center;">
                                   <p class="fw-600" style="font-size: 15px;"><?php echo $channelName; ?> </p>

                                   <p class="fw-400" style="font-size: 10px; margin-top:2px;"><?php echo substr($channelDesc, 0, 49); ?> ... </p>
                              </div>
                         </div>

                         <div class="flex e-c">
                              <a href="https://www.youtube.com/<?php echo $channelUniCode ?>" target="_blank" title="Go to Youtube" style="padding: 12px 25px; background-color:var(--clr-4); border-radius:100px;">Subscribe</a>
                         </div>

                    </div>

                    <!-- feedback -->
                    <div class="flex m-t-10 p-y-10" style="border-top: 2px solid var(--clr-4); border-bottom: 2px solid var(--clr-4);" id="your_feedback">

                         <div class="input">
                              <input type="text" name="feedback" id="feedback" placeholder="Your feedback" required>
                         </div>

                         <a href="javascript:void(0)" onclick="sendFeedback()" class="btn btn-gra-purple m-l-10">Send</a>
                    </div>

                    <div class="flex e-c m-y-10">
                         <p>Feedbacks will be shown here in next Update.</p>
                    </div>



               </div>

               <!-- Left side video recommendation -->



               <div class="m-10" style="max-width: 30%; width:100%;">

                    <!-- Video Recommendation -->
                    <?php
                    $selectingAllVideos = "SELECT * FROM `78000_videos` LIMIT 0,19";
                    $fireSelectingAllVideos = mysqli_query($link, $selectingAllVideos);
                    if (mysqli_num_rows($fireSelectingAllVideos) > 0) {
                         while ($row = mysqli_fetch_assoc($fireSelectingAllVideos)) {
                    ?>
                              <a href="./play-<?php echo $row['videoUniCode']; ?>" id="<?php echo $row['videoUniCode']; ?>">
                                   <div class="flex m-b-10">
                                        <div>
                                             <img src="../data/user/videothumbnail/<?php echo $row['videoThumbnail']; ?>" alt="<?php echo $row['videoTitle']; ?>" style="max-height:85px; height:100%;">
                                        </div>
                                        <div class="flex flex-d-column tx-left m-l-10">

                                             <p class="fw-500" style="font-size: 14px;" title="<?php echo $row['videoTitle']; ?>"><?php
                                                                                                                                  if (strlen($row['videoTitle']) > 69) {
                                                                                                                                       echo substr($row['videoTitle'], 0, 69) . "...";
                                                                                                                                  } else {
                                                                                                                                       echo $row['videoTitle'];
                                                                                                                                  } ?> </p>

                                             <p class="fw-400 m-t-10" style="font-size: 13px;"><?php echo $row['channelName']; ?> • <?php echo $row['videoViews']; ?> Views • <?php echo time_elapsed_string($row['uploadTime']); ?></p>

                                        </div>
                                   </div>
                              </a>
                    <?php
                         }
                    } else {
                         echo "No Videos Available Now!";
                    }
                    ?>



               </div>
          </div>



     </div>

     </div>

     <script>
          // 2. This code loads the IFrame Player API code asynchronously.
          var tag = document.createElement('script');

          tag.src = "https://www.youtube.com/iframe_api";
          var firstScriptTag = document.getElementsByTagName('script')[0];
          firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

          // 3. This function creates an <iframe> (and YouTube player)
          //    after the API code downloads.
          var player;

          function onYouTubeIframeAPIReady() {
               // STARTING THE LOADING SCREEN 
               $(`#loading`).toggleClass("none");
               player = new YT.Player('player', {
                    height: 'auto',
                    width: '100%',
                    videoId: '<?php echo $videoId; ?>',
                    playerVars: {
                         'playsinline': 1
                    },
                    events: {
                         'onReady': onPlayerReady,
                         'onStateChange': onPlayerStateChange
                    }
               });
          }

          // 4. The API will call this function when the video player is ready.
          function onPlayerReady(event) {
               // REMOVING THE LOADING SCREEN
               $(`#loading`).toggleClass("none");
               // event.target.playVideo();
          }

          // 5. The API calls this function when the player's state changes.
          //    The function indicates that when playing a video (state=1),
          //    the player should play for six seconds and then stop.
          var done = false;

          function onPlayerStateChange(event) {
               if (event.data == YT.PlayerState.PLAYING && !done) {
                    startTimerCount();
                    countAView();
                    done = true;
               }
          }

          function stopVideo() {
               player.stopVideo();
          }

          var oldSec;

          function startTimerCount() {
               var sec, min, totalSec = 1;
               var timer = setInterval(function() {
                    min = Math.floor(totalSec / 60);
                    sec = totalSec % 60;

                    totalSec++;
                    if (totalSec > 60) {

                         // Now telling that user Watched 1 min
                         // And adding one Coin to user Wallet
                         $.post('actions/watch.php', {
                              watchedMin: "set",
                              videoId: "<?php echo $videoId; ?>"
                         }, function(data) {
                              // Currently doing no change on one minute watch -- do changes here if you want to do any change on the page after the watch of one minute
                         });

                         oldSec = totalSec;
                         clearInterval(timer);
                         startExtraTimerCount();

                    }
               }, 1000);
          }

          function startExtraTimerCount() {
               var sec, min, totalSec = oldSec;
               var extratimer = setInterval(function() {
                    min = Math.floor(totalSec / 60);
                    sec = totalSec % 60;

                    totalSec++;
                    if (sec == 0) {
                         // Now telling that user Watched Another 1 min
                         // Removing coin from video Remaining Coin
                         $.post('actions/watch.php', {
                              watchedAnotherMin: "set",
                              videoId: "<?php echo $videoId; ?>"
                         }, function(data) {});

                    }
               }, 1000);
          }

          function sendFeedback() {
               let feedbackMessage = $("#feedback").val();

               // SENDING THE FEEDBACK MESSAGE TO PHP PAGE
               $.post('actions/watch.php', {
                    feedback: "set",
                    videoId: "<?php echo $videoId; ?>",
                    feedbackMessage: feedbackMessage,
                    videoChannelId: "<?php echo $channelId; ?>",
                    userFullName: "<?php echo $_SESSION['userFullName']; ?>",
                    userUniCode: "<?php echo $_SESSION['userUniqueCode']; ?>"
               }, function(data) {
                    $("#feedback").val("");
                    alert(data);
               });
          }

          function countAView() {
               $.post('actions/watch.php', {
                    countAView: "set",
                    type:"Playlist",
                    videoId: "<?php echo $videoId; ?>",
                    viewCount: "<?php echo $videoViews; ?>"
               });
          }
     </script>