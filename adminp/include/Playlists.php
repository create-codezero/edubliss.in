<?php
session_start();
require_once '../../connect/connectDb/config.php';
$_SESSION['adminDPage'] = "Playlists";
?>

<div class="flex e-c w-100per flex-d-column" style="min-height: 75vh;">

        <div class="flex flex-d-column e-c" style="max-width: 600px; width:95%;">
            <div class="control-bar flex tx-left w-100per">
                <div class="flex e-c bg-clr-4 m-10 border-radius-100per pos-relative" style="width: 45px; height:45px;">
                        <a href="javascript:void(0)" onclick="loadContent('Add-Playlist')" class="pos-absolute">
                            <p class="fs-20 p-10"><i class="fa fa-plus" aria-hidden="true"></i></p>
                        </a>
                </div>
            </div>
        </div>

     <div class="m-y-20">
          <h1 class="fs-40 tx-center font-poppins">Playlists</h1>
     </div>
     <div class="flex flex-d-column e-c" style="max-width: 600px; width:95%;">
          <?php

          $gettingAllPlaylists = "SELECT * FROM `78000_playlists`";
          $firegettingAllPlaylists = mysqli_query($link, $gettingAllPlaylists);

          if (mysqli_num_rows($firegettingAllPlaylists) > 0) {
               while ($playlistDetails = mysqli_fetch_assoc($firegettingAllPlaylists)) {
          ?>
                    <div class="testimonial-control-card font-poppins e-c bg-clr-4 flex tx-left p-y-10 w-100per m-y-10" style="border-radius: 10px;" id="playlistCard<?php echo $playlistDetails['playlistId']; ?>">
                         <a href="https://www.youtube.com/playlist?list=<?php echo $playlistDetails['playlistLink']; ?>" target="_blank" class="flex">
                         <div class="flex" style="justify-content:space-between; align-items:center; width:95%;">
                              <div class="flex flex-d-column m-10">
                                   <img src="../data/watch/playlistthumbnail/<?php echo $playlistDetails['playlistThumbnail']; ?>" style="max-width:200px; border-radius:5px;" alt="Thumbnail">
                              </div>
                              <div class="flex flex-d-column">
                                   <p class="m-t-10">Title: <?php echo $playlistDetails['playlistName']; ?></p>
                                   <p class="m-t-10">Description: <?php echo $playlistDetails['playlistDescription']; ?></p>
                              </div>

                              <div class="flex flex-d-column cursor-pointer m-10">
                                   <a href="javascript:void(0)">
                                        <p class="fs-30"><i class="fa fa-trash" aria-hidden="true"></i></p>
                                   </a>

                                   <a href="javascript:void(0)" class="m-t-10">
                                        <p class="fs-30"><i class="fa fa-pencil" aria-hidden="true"></i></p>
                                   </a>

                                   <a href="javascript:void(0)" class="m-t-10">
                                        <p class="fs-30"><i class="fa fa-check" aria-hidden="true"></i></p>
                                   </a>
                              </div>
                         </div>
                         </a>
                    </div>
          <?php
               }
          } else {
               echo "No Playlists Available to show.";
          }
          ?>



     </div>
</div>