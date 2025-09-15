<?php
session_start();
require_once '../../connect/connectDb/config.php';


if (isset($_POST['addCoin']) && !empty($_POST['video']) && !empty($_POST['coin'])) {
     $videoId = $_POST['video'];
     $coin = $_POST['coin'];

     $gettingVideoDetails = "SELECT * FROM `78000_videos` WHERE `videoUserUniCode` = '" . $_SESSION['userUniqueCode'] . "' AND `videoSrNo` = '$videoId'";
     $fireGettingVideoDetails = mysqli_query($link, $gettingVideoDetails);

     if (mysqli_num_rows($fireGettingVideoDetails) > 0) {
          while ($detailRow = mysqli_fetch_assoc($fireGettingVideoDetails)) {
               $oldTotalCoin = $detailRow['totalCoins'];
               $oldRemainingCoin = $detailRow['remainingCoins'];

               $checkChannelDetails = "SELECT * FROM `78000_channels` WHERE `channelUser` = '" . $_SESSION['userUniqueCode'] . "'";
               $fireCheckChannelDetails = mysqli_query($link, $checkChannelDetails);

               if (mysqli_num_rows($fireCheckChannelDetails) > 0) {
                    while ($channelDetailsRow = mysqli_fetch_assoc($fireCheckChannelDetails)) {
                         $oldChannelTotalCoin = $channelDetailsRow['totalCoin'];
                         $oldChannelTotalCoinSpent = $channelDetailsRow['totalCoinSpent'];
                         $oldChannelRemainingCoin = $channelDetailsRow['remainingCoin'];

                         if ($coin <= $oldChannelTotalCoin) {
                              $newChannelTotalSpent = $oldChannelTotalCoinSpent + $coin;
                              $newTotalCoin = $oldTotalCoin + $coin;
                              $newRemainingCoin = $oldRemainingCoin + $coin;

                              $newChannelRemainingCoin = $oldChannelRemainingCoin - $coin;

                              // NOW UPDATING CHANNEL DETAILS
                              $channelQuery = "UPDATE `78000_channels` SET `totalCoinSpent`='$newChannelTotalSpent',`remainingCoin`='$newChannelRemainingCoin' WHERE channelUser = '" . $_SESSION['userUniqueCode'] . "'";
                              $fireChannelQuery = mysqli_query($link, $channelQuery);

                              if ($fireChannelQuery) {
                                   $videoQuery = "UPDATE `78000_videos` SET `totalCoins`='$newTotalCoin',`remainingCoins`='$newRemainingCoin' WHERE `videoUserUniCode` = '" . $_SESSION['userUniqueCode'] . "' AND `videoSrNo` = '$videoId'";

                                   $fireVideoQuery = mysqli_query($link, $videoQuery);

                                   if ($fireVideoQuery) {
                                        $_SESSION['remainingCoin'] = $newChannelRemainingCoin;
                                        echo 1;
                                   } else {
                                        echo 0;
                                   }
                              }
                         } else {
                              echo 0;
                         }
                    }
               } else {
                    echo 0;
               }
          }
     } else {
          echo 0;
     }
} else {
     echo 0;
}
