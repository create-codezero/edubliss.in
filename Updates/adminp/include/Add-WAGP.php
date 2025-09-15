<?php
session_start();
require_once "../../connect/connectDb/config.php";
$_SESSION['path'] = "WA-Groups";
?>
<div class="sector flex flex-column e-c m-y-30">

     <div class="flex e-c h-100per m-y-20 w-100per">
          <div class="form-box">
               <div class="main-box">
                    <form action="./actions/addWAGP.php" enctype="multipart/form-data" method="POST">
                         <p class="fs-40 tx-center">Group Details</p>


                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Group Name</p>
                         <div class="input">
                              <input type="text" name="wagpName" id="wagpName" placeholder="Group Name" required>
                         </div>

                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Group Link</p>
                         <div class="input">
                              <input type="text" name="wagpLink" id="wagpLink" placeholder="Use Full Link" required>
                         </div>

                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Logo</p>

                         <div class="w-100per flex e-c p-y-10">
                              <div class="flex e-c cursor-pointer" style="max-height:100px; height:100%; max-width:100px; width:100%; background-color: var(--clr-4); border-radius:100%;" onclick="triggerClick('newGroupLogo')">
                                    <img src="" alt="Group Logo" class="none" style="height:100px; max-width:100px; width:100%; border-radius:100%;" id="wagpLogoPreview">
                                    <i class="fa fa-camera fs-30 p-y-40 wagpLogoIcon" id="upload-wagpLogo-icon"></i>
                                    
                              </div>
                         </div>

                         <div class="input">
                              <input type="file" name="newGroupLogo" style="display:none;" id="newGroupLogo" onchange="displayImage(this)">
                         </div>

                         <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Description</p>
                         <div class="input">
                              <input type="text" name="wagpDesc" id="wagpDesc" placeholder="Short Description" required>
                         </div>


                         <p class="fs-10 tx-center m-20"> Once you submit this form this group details will be Public. </p>

                         <button type="submit" class="btn btn-gra-purple cursor-pointer" style="margin: 25px auto 5px;" name="Add_WAGP">Add Group</button>




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
                    document.querySelector('#wagpLogoPreview').setAttribute('src', e.target.result);
                    document.querySelector('#upload-wagpLogo-icon').setAttribute('class', "fa fa-camera fs-30 p-y-40 videoInputThumbnailFile none");
                    document.querySelector('#wagpLogoPreview').setAttribute('class', "img-fluid");

               }
               reader.readAsDataURL(e.files[0]);
          }
     }
</script>