<?php
session_start();
$_SESSION['path'] = "Upload-Asset";
?>
<div class="flex e-c">

     <div class="form-box">
          <div class="main-box">
               <h1 class="fs-40 tx-center">Asset Detail</h1>

               <form action="./actions/assetUpload.php" class="e-center" method="POST" enctype="multipart/form-data">

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Asset Name</p>
                    <div class="input">
                         <input type="text" id="Name" name="Name" placeholder="Asset Name" required>
                    </div>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Description</p>
                    <div class="input">
                         <input type="text" id="Description" name="Description" placeholder="Asset Description" required>
                    </div>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Asset drive link</p>
                    <div class="input">
                         <input type="text" name="Download_link" id="Download_link" placeholder="https://drive.google.com/uc?id=1VbrQJx2Xj_SUddg1Zue68YvV5zLMtsVd&export=download" required>
                    </div>

                    <!-- <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Asset Thumbnail</p>
                    <div class="input">
                         <input type="file" id="Asset_thumbnail" name="Asset_thumbnail" required>
                    </div> -->

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Tags</p>
                    <div class="input">
                         <input type="text" id="Tags" name="Tags" placeholder="About asset" required>
                    </div>

                    <p style="font-size: 12px; font-weight: 600;" class="m-y-20 tx-center">This Asset will Available for All User <span style="color:red;">after the verification by the admin</span>.</p>

                    <button class="btn btn-gra-purple m-auto" type="submit" name="Upload_Asset">Upload</button>
               </form>


          </div>
     </div>

</div>