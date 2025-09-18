<?php
session_start();
require_once "../../connect/connectDb/config.php";
require_once "../../connect/function/timeago.php";

$playlistId = $_GET['playlistId'];

$findPlaylist = "SELECT * FROM `78000_playlists` WHERE `playlistLink` = '" . $playlistId . "'";
$fireFindVideo = mysqli_query($link, $findPlaylist);

$playlistName = "";
$playlistDescription = "";
$playlistTags = "";
$playlistLink = "";
$playlistUniCode = "";
$playlistThumbnail = "";
$playlistViews = "";

if (mysqli_num_rows($fireFindVideo) > 0) {
     while ($rows = mysqli_fetch_assoc($fireFindVideo)) {
          $playlistName = $rows['playlistName'];
          $playlistDescription = $rows['playlistDescription'];
          $playlistTags = $rows['playlistTags'];
          $playlistLink = $rows['playlistLink'];
          $playlistThumbnail = $rows['playlistThumbnail'];
          $playlistViews = $rows['playlistViews'];
     }
} else {
     header('location: ../dashboard/');
}
?>


     <div class="flex m-20" style="justify-content: space-between; align-items:center;">

     </div>

     <div class="m-b-20" id="main-watch-box">

          <div class="flex m-10" id="watch-video-page">

               <div class="m-10" style="max-width: 70%; width:100%; ">

                    <div class="watch-video-box" id="video-player-div">
                         <div class="iframe-container" id="iframe-container">
                              <div id="player"></div>
                         </div>
                    </div>

                    <div class="flex m-t-30 cursor-pointer" style="justify-content: space-between;" onclick="displaythis('#', 'videoDescription')" title="View Description">
                         <div class="tx-left">
                              <p class="fw-500" style="font-size: 18px;"><?php echo $playlistName; ?> </p>
                              <p class="fw-400" style="font-size: 10px; margin-top:2px;"><?php echo substr($playlistDescription, 0, 24); ?> ... </p>
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
                              <pre class="font-poppins m-t-10" style="text-align: left; margin:0; white-space: pre-wrap; white-space: -moz-pre-wrap; white-space: -pre-wrap white-space: -o-pre-wrap; word-wrap: break-word;"><p class="fw-400" style="font-size: 14px; text-align:start;"><?php echo $playlistDescription ?></p></pre>
                         </div>
                    </div>

                    <!-- Channel -->
                    <!-- • -->

                    <div class="flex m-t-10 p-y-10" style="border-top: 2px solid var(--clr-4); border-bottom: 2px solid var(--clr-4); justify-content:space-between;">

                         <div class="flex w-100per">
                              <div class="flex e-c">

                                   <img src="../data/watch/playlist-icon.png" alt="Channel logo" style="border-radius: 100%; max-height:45px; height:100%;">

                              </div>
                              <div class="flex tx-left m-l-10 flex-d-column" style="justify-content:center;">
                                   <p class="fw-600" style="font-size: 15px;"><?php echo $playlistName; ?> </p>

                                   <p class="fw-400" style="font-size: 10px; margin-top:2px;"><?php echo substr($playlistDescription, 0, 49); ?> ... </p>
                              </div>
                         </div>

                         <div class="flex e-c">
                         <a href="https://www.youtube.com/playlist?list=<?php echo $playlistLink ?>" target="_blank" class="flex" title="Go to Youtube" style="padding: 12px 25px; background-color:var(--clr-4); border-radius:100px;"><i class="fas fa-youtube m-r-10" style="color:red;"></i> Youtube</a>
                         </div>

                    </div>



               </div>

               <div class="m-10 flex flex-d-column" style="max-width: 30%; width:100%;">

                    <!-- Left side video recommendation -->
                    <div id="playlistOtherVideosHeader">
                            <p class="fs-20 fw-600">Playlist Videos</p>
                    </div>
                    <div id="playlistOtherVideos" style="max-height:70vh; height:100%; overflow-y:auto;">
                        
                    </div>


                    <!-- Other Video Recommendation -->
                    <div class="m-t-10">

                            <!-- Video Recommendation -->
                            <?php
                            $selectingAllVideos = "SELECT * FROM `78000_videos` LIMIT 0,19";
                            $fireSelectingAllVideos = mysqli_query($link, $selectingAllVideos);
                            if (mysqli_num_rows($fireSelectingAllVideos) > 0) {
                                while ($row = mysqli_fetch_assoc($fireSelectingAllVideos)) {
                            ?>
                                    <a href="./play-<?php echo $row['videoUniCode']; ?>" class="suggCard" id="<?php echo $row['videoUniCode']; ?>">
                                        <div class="flex m-b-10">
                                                <div>
                                                    <img src="../data/user/videothumbnail/<?php echo $row['videoThumbnail']; ?>" alt="<?php echo $row['videoTitle']; ?>" style="max-height:85px; height:100%;" class="suggVidImg">
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

        //   first Video Link Variable
        var fVid;
        let preVid = "";
        countAView();

            var key = 'your_youtube_api_key';
            var playlistId = '<?php echo $playlistId;?>';
            var URL = 'https://www.googleapis.com/youtube/v3/playlistItems';


            var options = {
                part: 'snippet',
                key: key,
                maxResults: 500,
                playlistId: playlistId
            }

            loadVids();

            function loadVids() {
                $.getJSON(URL, options, function (data) {
                    var id = data.items[0].snippet.resourceId.videoId;
                    fVid = id;
                    resultsLoop(data);
                    
                    loadVideo(id);
                });
            }

            function loadNewVideo(i){
                
                document.getElementById("iframe-container").innerHTML = '<div id="player"></div>';

                loadVideo(i);
            }

            function loadVideo(e) {
                if(preVid == ""){
                    preVid = e;
                }else{
                    $(`#vidsugg-${preVid}`).toggleClass("nowPlaying");
                }
                preVid = e;
                $(`#vidsugg-${e}`).toggleClass("nowPlaying");
               // STARTING THE LOADING SCREEN 
               $(`#loading`).toggleClass("none");
               player = new YT.Player('player', {
                    height: 'auto',
                    width: '100%',
                    videoId: e,
                    events: {
                         'onReady': onPlayerReady,
                         'onStateChange': onPlayerStateChange
                    }
               });
          }

            
            function resultsLoop(data) {

                $.each(data.items, function (i, item) {

                    var thumb = item.snippet.thumbnails.medium.url;
                    var title = item.snippet.title;
                    var desc = item.snippet.description.substring(0, 60);
                    var vid = item.snippet.resourceId.videoId;


                    $('#playlistOtherVideos').append(`
                                    <div onclick="loadNewVideo('${vid}')" class="suggCard cursor-pointer" id="vidsugg-${vid}">
                                        <div class="flex">
                                                <div>
                                                    <img src="${thumb}" class="suggVidImg" alt="${title}" style="max-height:85px; height:100%;">
                                                </div>
                                                <div class="flex flex-d-column tx-left m-l-10">

                                                    <p class="fw-500" style="font-size: 14px;" title="${title}">${title.substring(0,69) + "..."}</p>

                                                    <p class="fw-400 m-t-10" style="font-size: 13px;">${desc}</p>

                                                </div>
                                        </div>
                                    </div>
                                `);
                });
            }

                // CLICK EVENT
            // $('main').on('click', 'article', function () {
            //     var id = $(this).attr('data-key');
            //     mainVid(id);
            // });

          

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
                    // write what to do when video is playing and not ended yet
                    done = true;
               }
          }

          function stopVideo() {
               player.stopVideo();
          }

          function countAView() {
               $.post('actions/watch.php', {
                    countAView: "set",
                    type:"Playlist",
                    playlistId: "<?php echo $playlistId; ?>",
                    viewCount: "<?php echo $playlistViews; ?>"
               });
          }

     </script>
