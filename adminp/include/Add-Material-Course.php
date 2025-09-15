<?php
session_start();
$_SESSION['adminDPage'] = "Material-Categories";
?>
<div class="flex e-c">

     <div class="form-box">
          <div class="main-box">
               <h1 class="fs-40 tx-center">Courses Details</h1>

               <form action="./actions/addMaterialCourse.php" class="e-center" method="POST" enctype="multipart/form-data">

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Course Name</p>
                    <div class="input">
                         <input type="text" id="Name" name="Name" required>
                    </div>

                    <p style="font-size: 12px; font-weight: 500;" class="m-y-20 tx-center">This Course will Available for All User.</p>

                    <button class="btn btn-gra-purple m-auto" type="submit" name="Upload_Course">Upload</button>
               </form>


          </div>
     </div>

</div>