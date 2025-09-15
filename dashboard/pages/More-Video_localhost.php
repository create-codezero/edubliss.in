<?php
session_start();
require_once "../../connect/connectDb/config.php";
require_once "../../connect/function/timeago.php";

$_SESSION['path'] = "Watch-Area";
if (isset($_POST['fromVal']) && isset($_POST['loadCount']) && isset($_POST['sign'])) {
     $lastVideo = $_POST['fromVal'];
     $loadCount = $_POST['loadCount'];
     $sign = $_POST['sign'];

     $noChannel = 0;
     $searchBoxValue = "";

     if (!isset($_SESSION['remainingCoin'])) {
          $remainingCoinQuery = "SELECT * FROM `78000_channels` WHERE channelUser = '" . $_SESSION['userUniqueCode'] . "'";
          $fireRemainingCoinQuery = mysqli_query($link, $remainingCoinQuery);

          if (mysqli_num_rows($fireRemainingCoinQuery) > 0) {
               while ($coinRow = mysqli_fetch_assoc($fireRemainingCoinQuery)) {
                    $_SESSION['remainingCoin'] = $coinRow['remainingCoin'];
               }
          } else {
               $noChannel = 1;
          }
     }
     if ($noChannel == 1) {
     } else {
          $selectingAllVideos = "SELECT * FROM `78000_videos` ";

          if (isset($_POST['query']) && !empty($_POST['query'])) {
               $query = mysqli_escape_string($link, htmlentities($_POST['query']));
               $searchBoxValue = mysqli_escape_string($link, htmlentities($_POST['query']));
               $selectingAllVideos .= "WHERE `videoTitle` LIKE '%" . $query . "%' OR `videoDescription` LIKE '%$query" . $query . "%' OR `videoTags` LIKE '%" . $query . "%' OR `videoCategory` LIKE '%" . $query . "%' AND";
          } else {
               $selectingAllVideos .= "WHERE";
          }

          $selectingAllVideos .= " `videoUserUniCode` " . $sign . " '" . $_SESSION['userUniqueCode'] . "' ORDER BY remainingCoins DESC LIMIT $lastVideo, $loadCount";
          $fireSelectingAllVideos = mysqli_query($link, $selectingAllVideos);

          if (mysqli_num_rows($fireSelectingAllVideos) > 0) {
               while ($row = mysqli_fetch_assoc($fireSelectingAllVideos)) {
?>

                    <!-- Watch Card -->
                    <div class="watch-card">
                         <a href="javascript:void(0)">
                              <div class="thumbnail" id="<?php echo $row['videoUniCode']; ?>" onclick="playVideo(this)">
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

                                        <p class="fw-400" style="font-size: 10px; margin-top:2px;"><?php echo $row['channelName']; ?> • <?php echo $row['videoViews']; ?> Views • <?php echo time_elapsed_string($row['uploadTime']); ?></p>
                                   </div>
                              </div>
                         </a>
                    </div>

<?php
               }
          } else {
               echo 0;
          }
     }
}
?>