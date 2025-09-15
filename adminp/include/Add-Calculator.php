<?php
session_start();
$_SESSION['adminDPage'] = "Calculators";
?>
<div class="flex e-c">

     <div class="form-box">
          <div class="main-box">
               <h1 class="fs-40 tx-center">Calculator Details</h1>

               <form action="./actions/addCalculator.php" class="e-center" method="POST" enctype="multipart/form-data">

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Calculator Name</p>
                    <div class="input">
                         <input type="text" id="Name" name="Name" required>
                    </div>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Description</p>
                    <div class="input">
                         <input type="text" id="Description" name="Description" required>
                    </div>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Link</p>
                    <div class="input">
                         <input type="text" id="Link" name="Link" required>
                    </div>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Asset Thumbnail</p>
                    <div class="input">
                         <input type="file" id="Calculator_Thumbnail" name="Calculator_Thumbnail">
                    </div>

                    <p style="font-size: 12px; font-weight: 500;" class="m-y-20 tx-center">This Calculator will Available for All User.</p>

                    <button class="btn btn-gra-purple m-auto" type="submit" name="Upload_Calculator">Upload</button>
               </form>


          </div>
     </div>

</div>