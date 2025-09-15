<?php
session_start();
require_once "../../connect/connectDb/config.php";
$_SESSION['path'] = "Profile";



?>
<div class="sector flex flex-column e-c m-y-30">

     <p class="fs-30 tx-center m-10 fw-500 font-poppins">Edit Profile</p>

     <div class="flex e-c h-100per m-y-20 w-100per">
          <div class="form-box">
               <div class="main-box">
                    <form action="./actions/updateProfile.php" enctype="multipart/form-data" method="POST">
                         <p class="fs-40 tx-center">Your Details</p> 


                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Name</p>
                         <div class="input">
                              <input type="text" value="<?php if (isset($_SESSION['userDetails'])) {
                                                                 echo $_SESSION['userDetails'][1];
                                                            } ?>" name="userFullName" id="userFullName" placeholder="Full Name" required>
                         </div>

                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Profile Picture</p>

                         <?php
                         if($_SESSION['userDetails'][9] == "" or empty($_SESSION['userDetails'][9])){
                              $userProfile = "img_user.png";
                         }else{
                              $userProfile = $_SESSION['userDetails'][9];
                         }

                         if (isset($_SESSION['userDetails'])) {
                              $imageContent = '<img src="../data/user/userProfile/' . $userProfile . '" alt="Channel Logo" class="img-fluid" style="height:100px; max-width:100px; width:100%; border-radius:100%;" id="channelLogoPreview">';

                              $inputContent = '<input type="text" value="' . $userProfile . '" name="logoLink" style="display:none;" id="logoLink">';
                         } else {
                              $imageContent = '<img src="" alt="Channel Logo" class="none" style="height:100px; max-width:100px; width:100%; border-radius:100%;" id="channelLogoPreview">
                              <i class="fa fa-camera fs-30 p-y-40 channelLogoIcon" id="upload-channelLogo-icon"></i>';

                              $inputContent = '<input type="text" name="logoLink" style="display:none;" id="logoLink">';
                         }

                         ?>

                         <div class="w-100per flex e-c p-y-10">
                              <div class="flex e-c cursor-pointer" style="max-height:100px; height:100%; max-width:100px; width:100%; background-color: var(--clr-4); border-radius:100%;" onclick="triggerClick('newProfileLink')">
                                   <?php echo $imageContent; ?>
                              </div>
                         </div>

                         <div class="input" style="border:none;">
                              <?php echo $inputContent; ?>
                              <input type="file" name="newProfileLink" style="display:none;" id="newProfileLink" onchange="displayImage(this)">
                         </div>

                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Email</p>
                         <div class="input">
                              <input type="Email" value="<?php if (isset($_SESSION['userDetails'])) {
                                                                 echo $_SESSION['userDetails'][2];
                                                            } ?>" name="userEmail" id="userEmail" placeholder="Email" required>
                         </div>

                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Phone</p>
                         <div class="input">
                              <input type="number" value="<?php if (isset($_SESSION['userDetails'])) {
                                                                 echo $_SESSION['userDetails'][10];
                                                            } ?>" name="userPhone" maxlength="10" id="userPhone" placeholder="Phone" required>
                         </div>


                         <p class="fs-10 tx-center m-20"> Enter your details and Click Update to your Profile. </p>

                         <?php
                         $emailVerificationCheck = $_SESSION['userDetails'][6];

                         if ($emailVerificationCheck == 0) {
                              $v1 = '<a onclick="clickOn(';
                              $v2 = "'verification-pop')";
                              $v3 = '" class="btn btn-gra-purple cursor-pointer" style="margin: 25px auto 5px;" name="updateProfile">Update</a>';
                              echo $v1 . $v2 . $v3;
                         } else {
                              echo '<button type="submit" class="btn btn-gra-purple cursor-pointer" style="margin: 25px auto 5px;" name="updateProfile">Update</button>';
                         }
                         ?>




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
