<?php
session_start();
require_once "../../connect/connectDb/config.php";
require_once "../../connect/function/timeago.php";

$_SESSION['path'] = "Watch-Area";

$lastVideo = 24;

$searchBoxValue = "";
$noChannel = 0;


     $selectingAllVideos = "SELECT * FROM `78000_videos` ";

     if (isset($_POST['query']) && !empty($_POST['query'])) {
          $query = mysqli_escape_string($link, htmlentities($_POST['query']));
          $searchBoxValue = mysqli_escape_string($link, htmlentities($_POST['query']));
          $selectingAllVideos .= "WHERE `videoTitle` LIKE '%" . $query . "%' OR `videoDescription` LIKE '%$query" . $query . "%' OR `videoTags` LIKE '%" . $query . "%' OR `videoCategory` LIKE '%" . $query . "%'";
     } else {
          $selectingAllVideos .= "";
     }

     $selectingAllVideos .= " LIMIT 0, $lastVideo";

     // SELECTING 20 PLAYLISTS

     $selectingAllPlaylists = "SELECT * FROM `78000_playlists` ";

     if (isset($_POST['query']) && !empty($_POST['query'])) {
          $query = mysqli_escape_string($link, htmlentities($_POST['query']));
          $searchBoxValue = mysqli_escape_string($link, htmlentities($_POST['query']));
          $selectingAllPlaylists .= "WHERE `playlistName` LIKE '%" . $query . "%' OR `playlistDescription` LIKE '%$query" . $query . "%' OR `playlistTags` LIKE '%" . $query . "%'";
     } else {
          $selectingAllPlaylists .= "";
     }

     $selectingAllPlaylists .= " LIMIT 0, $lastVideo";


     $fireSelectingAllVideos = mysqli_query($link, $selectingAllVideos);
     $fireSelectingAllPlaylists = mysqli_query($link, $selectingAllPlaylists);
?>



     <div class="flex flex-d-column w-100per">

          <div class="flex m-20" style="justify-content: space-between; align-items:center;">

               <div>
                    <a href="javascript:void(0)" title="Go Back">
                         <i class="fas fa-arrow-left" style="margin:10px 10px; "></i>
                    </a>
               </div>


               <div class="search-box m-10 mob-m-x20">
                    <div class=" flex">
                         <input type="text" name="query" placeholder="Search here ..." id="searchBox" value="<?php echo $searchBoxValue; ?>" required>
                         <button class="search-btn flex flex-y-center" title="Search" data-page="Watch-Area" onclick="search(this)">
                              <i class="fa fa-search fs-20 cursor-pointer" style="margin: 15px 30px;"></i>
                         </button>
                    </div>
               </div>


               <div class="flex" style="align-items: center;">
                    <!-- <a href="javascript:void(0)" title="Upload" onclick="loadContent('Your-Videos')" class="fw-60 font-poppins m-x-10">
                         <i class="fa fa-upload" style="margin:10px 10px;"></i>
                    </a>
                    <a href="javascript:void(0)" onclick="loadContent('Your-Channel')" title="Your Channel" class="font-poppins">
                         <i class="fa fa-user" style="margin:10px 10px;"></i>
                    </a> -->
               </div>

          </div>

          <div class="m-b-20" id="main-watch-box">

                    <p class="fs-30 fw-600 font-poppins m-x-20">Playlists</p>


                    <div class="grid grid-column-5 tab-grid-column-3 mob-grid-column-1  grid-gap-15 m-20 mob-m-10">

                    <?php
                    if (mysqli_num_rows($fireSelectingAllPlaylists) > 0) {
                         while ($row = mysqli_fetch_assoc($fireSelectingAllPlaylists)) {
                    ?>

                    <!-- Watch Card -->
                    <div class="watch-card">
                         <a href="javascript:void(0)">
                              <div class="thumbnail" id="<?php echo $row['playlistLink']; ?>" onclick="playPlaylist(this)">
                                   <img src="../data/watch/playlistthumbnail/<?php echo $row['playlistThumbnail']; ?>" alt="<?php echo $row['playlistName']; ?>" class="img-fluid">
                              </div>
                              <div class="metadata w-100per flex" style="margin:7px 10px;">
                                   <div>

                                        <a href="javascript:void(0)">
                                             <img src="../data/watch/playlist-icon.png" class="img-fluid" alt="Playlist logo" style="border-radius: 100%; max-height:35px; height:100%;">
                                        </a>

                                   </div>
                                   <div class="flex tx-left m-l-10 flex-d-column" style="justify-content: center;">
                                        <p class="fw-600" style="font-size: 13px;"><?php
                                                                                     if (strlen($row['playlistName']) > 49) {
                                                                                          echo substr($row['playlistName'], 0, 49) . "...";
                                                                                     } else {
                                                                                          echo $row['playlistName'];
                                                                                     } ?> </p>

                                        <p class="fw-400" style="font-size: 10px; margin-top:2px;"><?php echo "Playlist"; ?> • <?php echo $row['playlistViews']; ?> Views • <?php echo time_elapsed_string($row['addedOn']); ?></p>
                                   </div>
                              </div>
                         </a>
                    </div>

               <?php
                    }
               } else {
                    echo '<p class="tx-center m-auto">No Playlists Available Now!</p>';
               }
               ?>

               </div>

               <div class="flex e-c">
                    <div style="width:100%; height:2px; background-color:var(--clr-4);"></div>
               </div>

               <p class="fs-30 fw-600 font-poppins m-20">Videos</p>


               <div class="grid grid-column-5 tab-grid-column-3 mob-grid-column-1  grid-gap-15 m-20 mob-m-10">

                    <?php
                    if (mysqli_num_rows($fireSelectingAllVideos) > 0) {
                         while ($row = mysqli_fetch_assoc($fireSelectingAllVideos)) {
                    ?>

                              <!-- Watch Card -->
                              <div class="watch-card">
                                   <a href="javascript:void(0)">
                                        <div class="thumbnail" id="<?php echo $row['videoUniCode']; ?>" onclick="playVideo(this)">
                                             <img src="../data/user/videothumbnail/<?php echo $row['videoThumbnail']; ?>" alt="<?php echo $row['videoTitle']; ?>" class="img-fluid">
                                        </div>
                                        <div class="metadata w-100per flex" style="margin:7px 10px;">
                                             <div>

                                                  <a href="https://www.youtube.com/<?php echo $row['channelUniCode']; ?>" target="_blank">
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

                                                  <p class="fw-400" style="font-size: 10px; margin-top:2px;"><?php echo $row['channelName']; ?> • <?php echo $row['videoViews']; ?> Views • <?php echo time_elapsed_string($row['uploadTime']); ?></p>
                                             </div>
                                        </div>
                                   </a>
                              </div>

                    <?php
                         }
                    } else {
                         echo '<p class="tx-center m-auto">No Videos Available Now!</p>';
                    }
                    ?>

                    <div id="End"></div>

               </div>

          </div>

     <script>
          $(document).ready(function() {
               let fromVal = <?php echo $lastVideo; ?>;
               let videoEnd = "False";
               const endContainer = document.getElementById('End');
               let query = $("#searchBox").val();

               window.addEventListener('scroll', () => {
                    const {
                         scrollHeight,
                         scrollTop,
                         clientHeight
                    } = document.documentElement;

                    if (scrollTop + clientHeight >= scrollHeight) {
                         if (videoEnd == "False") {
                              if (query == "" || query == null) {
                                   $.post('./pages/More-Video.php', {
                                             fromVal: fromVal,
                                             loadCount: 49,
                                             sign: "!="
                                        },
                                        function(data, status) {
                                             if (data == 0) {
                                                  videoEnd = "True";
                                                  return;
                                             } else {
                                                  endContainer.insertAdjacentHTML('beforebegin', data);
                                             }
                                        });
                              } else {
                                   $.post('./pages/More-Video.php', {
                                             fromVal: fromVal,
                                             loadCount: 49,
                                             sign: "!=",
                                             query: query
                                        },
                                        function(data, status) {
                                             if (data == 0) {
                                                  videoEnd = "True";
                                                  return;
                                             } else {
                                                  endContainer.insertAdjacentHTML('beforebegin', data);
                                             }
                                        });
                              }

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

          function playPlaylist(element) {
               var playlistId = element.id;
               $(`#loading`).toggleClass("none");

               $(`#Content`).load(`./pages/Playlist.php?playlistId=${playlistId}`, function() {
                    $(`#loading`).toggleClass("none");

                    const state = {
                         'page_id': 1,
                         'user_id': 5
                    };
                    const title = '';
                    const url = `playlist_${playlistId}`;

                    history.pushState(state, title, url);
               });
          }
     </script>