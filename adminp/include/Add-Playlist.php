<?php
session_start();
require_once "../../connect/connectDb/config.php";
$_SESSION['adminDPage'] = "Playlists";
?>
<div class="flex e-c p-y-40">
     <div class="form-box">
          <div class="main-box">
               <form class="m-t-20" enctype="multipart/form-data" method="POST" action="./actions/addPlaylist.php">
                    <p class="fs-20 tx-center">Playlist Details</p>
                    <p class="fw-400 tx-center m-t-20" style="font-size: 15px; color:red;"><?php if (isset($_SESSION['playlistAlreadyExist'])) {
                                                                                                    echo "Warning: " . $_SESSION['playlistAlreadyExist'];

                                                                                                    unset($_SESSION['playlistAlreadyExist']);
                                                                                               } ?></p>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Playlist Title</p>

                    <div class="input">
                         <input type="text" name="playlistTitle" id="Playlist-Title" placeholder="Playlist Title" class="" maxlength="100" title="Please a give title for your playlist." required>
                    </div>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Playlist Description</p>

                    <div class="input">
                         <textarea type="text" style="line-height:20px; margin-top:5px; border-radius: 0px;" name="playlistDescription" id="Playlist-Description" placeholder="Playlist Description" rows="5" class="" title="Please Write a short description about your playlist." maxlength="1000" required></textarea>
                    </div>

                    <p class=" fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Playlist Link</p>

                    <div class="input">
                         <input type="text" title="Paste your youtube playlist link" name="playlistLink" id="Playlist-Link" placeholder="PLDfna1ApN44rxNDZ0SNQfx--OF0VRCDa1" class="" required>
                    </div>

                    <p class=" fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Playlist Tags</p>

                    <div class="input">
                         <textarea type="text" style="line-height:20px; margin-top:5px; border-radius: 0px;" rows="3" name="playlistTags" id="Playlist-Tags" placeholder="Playlist Tags" maxlength="500" title="Copy & Paste your playlist tags from Youtube." required></textarea>
                    </div>

                    <p class=" fs-15 fw-500 playlistInputThumbnailFile" style="margin-top: 20px; margin-left: 2px;">Thumbnail File</p>

                    <div class="input playlistInputThumbnailFile pos-relative flex e-c cursor-pointer" onclick="triggerClick('Thumbnail-File')" title="Click to select your thumbnail Image.">
                         <i class="fa fa-camera fs-30 p-y-40 playlistInputThumbnailFile" id="upload-thumbnail-icon"></i>
                         <img src="" class="none playlistInputThumbnailFileView img-fluid" id="Thumbnail-Viewer">
                         <input type="file" name="thumbnailFile" onchange="displayImage(this)" id="Thumbnail-File" placeholder="Thumbnail File" accept="image/png, image/jpg, image/jpeg" style="display: none;" required>
                    </div>

                    <p class=" fs-10 tx-center m-t-10"> Your playlist will be public if you upload here. </p>


                    <button class="btn btn-gra-purple cursor-pointer" style="margin: 20px auto 10px;" type="submit" name="uploadPlaylist">Upload</button>
               </form>
          </div>
     </div>
</div>


<script>
     function displayImage(e) {
          if (e.files[0]) {
               var reader = new FileReader();
               reader.onload = function(e) {
                    document.querySelector('#Thumbnail-Viewer').setAttribute('src', e.target.result);
                    document.querySelector('#upload-thumbnail-icon').setAttribute('class', "fa fa-camera fs-30 p-y-40 playlistInputThumbnailFile none");
                    document.querySelector("#Thumbnail-Viewer").setAttribute('class', "playlistInputThumbnailFileView img-fluid");

               }
               reader.readAsDataURL(e.files[0]);
          }
     }
</script>