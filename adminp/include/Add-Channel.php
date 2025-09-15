<?php
session_start();
require_once "../../connect/connectDb/config.php";
$_SESSION['path'] = "Your-Channel";
?>
<div class="sector flex flex-column e-c m-y-30">

     <div class="flex e-c h-100per m-y-20 w-100per">
          <div class="form-box">
               <div class="main-box">
                    <form action="./actions/addChannel.php" enctype="multipart/form-data" method="POST">
                         <p class="fs-40 tx-center">Channel Details</p>


                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Channel Name</p>
                         <div class="input">
                              <input type="text" name="channelName" id="channelName" placeholder="Channel Name" required>
                         </div>

                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Channel Link</p>
                         <div class="input">
                              <input type="text" name="channelLink" id="channelLink" placeholder="Use Full Link" required>
                         </div>

                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Logo</p>

                         

                         <div class="w-100per flex e-c p-y-10">
                              <div class="flex e-c cursor-pointer" style="max-height:100px; height:100%; max-width:100px; width:100%; background-color: var(--clr-4); border-radius:100%;" onclick="triggerClick('newChannelLogo')">
                                    <img src="" alt="Channel Logo" class="none" style="height:100px; max-width:100px; width:100%; border-radius:100%;" id="channelLogoPreview">
                                    <i class="fa fa-camera fs-30 p-y-40 channelLogoIcon" id="upload-channelLogo-icon"></i>
                                    
                              </div>
                         </div>

                         <div class="input">
                              <input type="file" name="newChannelLogo" style="display:none;" id="newChannelLogo" onchange="displayImage(this)">
                         </div>

                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Description</p>
                         <div class="input">
                              <input type="text" name="channelDesc" id="channelDesc" placeholder="Short Description" required>
                         </div>

                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Category</p>
                         <div class="input">
                              <select name="category" id="category" placeholder="Category" required>
                                   <option value="Maths">Maths</option>
                                   <option value="Statistics">Statistics</option>
                                   <option value="English">English</option>
                                   <option value="Computational Thinking">Computational Thinking</option>
                                   <option value="Full Data Science">Full Data Science</option>
                              </select>
                         </div>

                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Total Subscribers</p>
                         <div class="input">
                              <input type="text" name="totalSubs" id="totalsubs" placeholder="Total Subscriber" required>
                         </div>


                         <p class="fs-10 tx-center m-20"> Enter your details and Click Update to Start Showing Your Ad. Logo Update may take some time & you can not change or update your channel link after making a channel. </p>

                         <button type="submit" class="btn btn-gra-purple cursor-pointer" style="margin: 25px auto 5px;" name="channel_submit">Update</button>




                    </form>
               </div>
          </div>
     </div>

</div>

<script>
     function displayImage(e) {
          if (e.files[0]) {
               var reader = new FileReader();
               reader.onload = function(e) {
                    document.querySelector('#channelLogoPreview').setAttribute('src', e.target.result);
                    document.querySelector('#upload-channelLogo-icon').setAttribute('class', "fa fa-camera fs-30 p-y-40 videoInputThumbnailFile none");
                    document.querySelector('#channelLogoPreview').setAttribute('class', "img-fluid");

               }
               reader.readAsDataURL(e.files[0]);
          }
     }
</script>