<?php
session_start();
require_once "../../connect/connectDb/config.php";

if (!isset($_GET['videoId'])) {
     header('location: ../');
}

?>

<div class="flex e-c p-y-40">
     <div class="form-box">
          <div class="main-box">
               <?php
               $videoId = $_GET['videoId'];

               $fetchingAllVideoFields = "SELECT * FROM `78000_videos` WHERE videoUniCode = '$videoId'";
               $fireFetchingAllVideoFields = mysqli_query($link, $fetchingAllVideoFields);

               if (mysqli_num_rows($fireFetchingAllVideoFields) > 0) {
                    while ($videoFieldRow = mysqli_fetch_assoc($fireFetchingAllVideoFields)) {
               ?>

                         <form class="m-t-20" enctype="multipart/form-data" method="POST" action="./actions/watch.php">
                              <p class="fs-20 tx-center">Video Details</p>

                              <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Video Title</p>

                              <input type="text" value="<?php echo $videoFieldRow['videoUniCode']; ?>" style="display:none;" name="videoId">

                              <div class="input">
                                   <input type="text" name="videoTitle" id="Video-Title" value="<?php echo $videoFieldRow['videoTitle']; ?>" placeholder="Video Title" class="" maxlength="100" title="Please a give title for your video." required>
                              </div>

                              <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Video Description</p>

                              <div class="input">
                                   <pre style="text-align: left; margin:0; white-space: pre-wrap; white-space: -moz-pre-wrap; white-space: -pre-wrap white-space: -o-pre-wrap; word-wrap: break-word; width:94%;"><textarea type="text" style="line-height:20px; margin-top:5px; border-radius: 0px;" name="videoDescription" id="Video-Description" placeholder="Video Description" rows="5" class="" title="Please Write a short description about your video." maxlength="1000" required><?php echo $videoFieldRow['videoDescription']; ?></textarea></pre>
                              </div>

                              <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Category</p>
                              <div class="input" title="Select your video Category as You do in Youtube">
                                   <select name="videoCategory" id="Video-Category" placeholder="Category" required>
                                        <option value="<?php echo $videoFieldRow['videoCategory']; ?>"><?php echo $videoFieldRow['videoCategory']; ?></option>
                                        <option value="Autos & Vehicles">Autos & Vehicles</option>
                                        <option value="Comedy">Comedy</option>
                                        <option value="Education">Education</option>
                                        <option value="Entertainment">Entertainment</option>
                                        <option value="Film & Animation">Film & Animation</option>
                                        <option value="Gaming">Gaming</option>
                                        <option value="Howto & Style">Howto & Style</option>
                                        <option value="Music">Music</option>
                                        <option value="News & Politics">News & Politics</option>
                                        <option value="Nonprofits & Activism">Nonprofits & Activism</option>
                                        <option value="People & Blog">People & Blog</option>
                                        <option value="Pets & Animals">Pets & Animals</option>
                                        <option value="Science & Technology">Science & Technology</option>
                                        <option value="Sports">Sports</option>
                                        <option value="Travel & Events">Travel & Events</option>
                                   </select>
                              </div>

                              <p class=" fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Video Tags</p>

                              <div class="input">
                                   <pre style="text-align: left; margin:0; white-space: pre-wrap; white-space: -moz-pre-wrap; white-space: -pre-wrap white-space: -o-pre-wrap; word-wrap: break-word; width:94%;"><textarea type="text" style="line-height:20px; margin-top:5px; border-radius: 0px;" rows="3" name="videoTags" id="Video-Tags" placeholder="Video Tags" maxlength="500" title="Copy & Paste your video tags from Youtube." required><?php echo $videoFieldRow['videoTags']; ?></textarea></pre>
                              </div>

                              <p class=" fs-15 fw-500 videoInputThumbnailFile" style="margin-top: 20px; margin-left: 2px;">Thumbnail File</p>

                              <div class="input videoInputThumbnailFile pos-relative flex e-c cursor-pointer" onclick="triggerClick(this)" title="Click to select your thumbnail Image.">
                                   <img src="../data/user/videothumbnail/<?php echo $videoFieldRow['videoThumbnail']; ?>" class="videoInputThumbnailFileView img-fluid" id="Thumbnail-Viewer">
                                   <input type="file" name="thumbnailFile" onchange="displayImage(this)" id="Thumbnail-File" placeholder="Thumbnail File" accept="image/png, image/jpg, image/jpeg" style="display: none;">
                                   <input type="text" name="oldThumbnailFile" value="<?php echo $videoFieldRow['videoThumbnail']; ?>" style="display:none;">
                              </div>


                              <p class=" fs-10 tx-center m-t-10"> Your video will be public if you upload here. </p>


                              <button class="btn btn-gra-purple cursor-pointer" style="margin: 20px auto 10px;" type="submit" name="editVideo">Upload</button>
                         </form>
               <?php
                    }
               }
               ?>
          </div>
     </div>
</div>


<script>
     function triggerClick(e) {
          document.querySelector('#Thumbnail-File').click();
     }

     function displayImage(e) {
          if (e.files[0]) {
               var reader = new FileReader();
               reader.onload = function(e) {
                    document.querySelector('#Thumbnail-Viewer').setAttribute('src', e.target.result);
                    document.querySelector("#Thumbnail-Viewer").setAttribute('class', "videoInputThumbnailFileView img-fluid");

               }
               reader.readAsDataURL(e.files[0]);
          }
     }
</script>