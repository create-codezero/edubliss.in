<?php
session_start();
$_SESSION['adminDPage'] = "Material-categories";

if(!isset($_GET['course']) && !isset(($_GET['level']))){
    header("location: ./");
}

?>
<div class="flex e-c">

     <div class="form-box">
          <div class="main-box">
               <h1 class="fs-40 tx-center">Subject Details</h1>

               <form action="./actions/addMaterialSubject.php" class="e-center" method="POST" enctype="multipart/form-data">

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Subject Name</p>
                    <div class="input">
                         <input type="text" id="Name" name="Name" required>
                    </div>

                    <input type="text" name="Course" value="<?php echo $_GET['course']; ?>" style="display:none;">
                    <input type="text" name="Level" value="<?php echo $_GET['level']; ?>" style="display:none;">

                    <p style="font-size: 12px; font-weight: 500;" class="m-y-20 tx-center">This Subject will Available for All User.</p>

                    <button class="btn btn-gra-purple m-auto" type="submit" name="Upload_Subject">Upload</button>
               </form>


          </div>
     </div>

</div>