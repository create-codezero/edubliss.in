<?php
session_start();
require_once "../../connect/connectDb/config.php";
 

if(!isset($_GET['channel'])){
    header("location: ../");
}


// CREATING GLOBAL VARIABLES
$channelId = "";
$channelUniCode = "";
$channelName = "";
$channelLogo = "";
$channelDesc = "";

// FETCHING FROM DATABASE
$channelDetailQuery = "SELECT * FROM `78000_channels` WHERE `channelId` = '" . $_GET['channel'] . "'";
$fireChannelDetailQuery = mysqli_query($link, $channelDetailQuery);

if (mysqli_num_rows($fireChannelDetailQuery) > 0) {
     while ($channelDetailRow = mysqli_fetch_assoc($fireChannelDetailQuery)) {
          $channelId = $channelDetailRow['channelId'];
          $channelUniCode = $channelDetailRow['channelLink'];
          $channelName = $channelDetailRow['channelName'];
          $channelLogo = $channelDetailRow['logoLink'];
          $channelDesc = $channelDetailRow['channelDesc'];
     }
} else {
     header('location: ../');
}
?>
<div class="flex e-c p-y-40">
     <div class="form-box">
          <div class="main-box">
               <form class="m-t-20" enctype="multipart/form-data" method="POST" action="./actions/addVideo.php">
                    <p class="fs-20 tx-center">Video Details</p>
                    <p class="fw-400 tx-center m-t-20" style="font-size: 15px; color:red;"><?php if (isset($_SESSION['videoAlreadyExist'])) {
                                                                                                    echo "Warning: " . $_SESSION['videoAlreadyExist'];

                                                                                                    unset($_SESSION['videoAlreadyExist']);
                                                                                               } ?></p>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Video Title</p>

                    <div class="input">
                         <input type="text" name="videoTitle" id="Video-Title" placeholder="Video Title" class="" maxlength="100" title="Please a give title for your video." required>
                    </div>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Video Description</p>

                    <div class="input">
                         <textarea type="text" style="line-height:20px; margin-top:5px; border-radius: 0px;" name="videoDescription" id="Video-Description" placeholder="Video Description" rows="5" class="" title="Please Write a short description about your video." maxlength="1000" required></textarea>
                    </div>

                    <p class=" fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Video Link</p>

                    <div class="input">
                         <input type="text" title="Paste your youtube video link" name="videoLink" id="Video-Link" placeholder="Video Link" class="" required>
                    </div>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Category</p>
                    <div class="input" title="Select your video Category as You do in Youtube">
                         <select name="videoCategory" id="Video-Category" placeholder="Category" required>
                                   <option value="Maths">Maths</option>
                                   <option value="Statistics">Statistics</option>
                                   <option value="English">English</option>
                                   <option value="Computational Thinking">Computational Thinking</option>
                                   <option value="Full Data Science">Full Data Science</option>
                         </select>
                    </div>

                    <p class=" fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Video Tags</p>

                    <div class="input">
                         <textarea type="text" style="line-height:20px; margin-top:5px; border-radius: 0px;" rows="3" name="videoTags" id="Video-Tags" placeholder="Video Tags" maxlength="500" title="Copy & Paste your video tags from Youtube." required></textarea>
                    </div>

                    <p class=" fs-15 fw-500 videoInputThumbnailFile" style="margin-top: 20px; margin-left: 2px;">Thumbnail File</p>

                    <div class="input videoInputThumbnailFile pos-relative flex e-c cursor-pointer" onclick="triggerClick('Thumbnail-File')" title="Click to select your thumbnail Image.">
                         <i class="fa fa-camera fs-30 p-y-40 videoInputThumbnailFile" id="upload-thumbnail-icon"></i>
                         <img src="" class="none videoInputThumbnailFileView img-fluid" id="Thumbnail-Viewer">
                         <input type="file" name="thumbnailFile" onchange="displayImage(this)" id="Thumbnail-File" placeholder="Thumbnail File" accept="image/png, image/jpg, image/jpeg" style="display: none;" required>
                    </div>

                    <input type="text" value="<?php echo $_GET['channel']; ?>" name="channel" style="display:none;">
                    <input type="text" value="<?php echo $channelUniCode; ?>" name="channelUniCode" style="display:none;">
                    <input type="text" value="<?php echo $channelName; ?>" name="channelName" style="display:none;">
                    <input type="text" value="<?php echo $logoLink; ?>" name="logoLink" style="display:none;">
                    <input type="text" value="<?php echo $channelDesc; ?>" name="channelDesc" style="display:none;">

                    <p class=" fs-10 tx-center m-t-10"> Your video will be public if you upload here. </p>


                    <button class="btn btn-gra-purple cursor-pointer" style="margin: 20px auto 10px;" type="submit" name="uploadVideo">Upload</button>
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
                    document.querySelector('#upload-thumbnail-icon').setAttribute('class', "fa fa-camera fs-30 p-y-40 videoInputThumbnailFile none");
                    document.querySelector("#Thumbnail-Viewer").setAttribute('class', "videoInputThumbnailFileView img-fluid");

               }
               reader.readAsDataURL(e.files[0]);
          }
     }
</script>