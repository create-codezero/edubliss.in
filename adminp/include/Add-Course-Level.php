<?php
session_start();
$_SESSION['adminDPage'] = "Material-categories";

if(!isset($_GET['course'])){
    header("location: ./");
}

?>
<div class="flex e-c">

     <div class="form-box">
          <div class="main-box">
               <h1 class="fs-40 tx-center">Level Details</h1>

               <form action="./actions/addMaterialLevel.php" class="e-center" method="POST" enctype="multipart/form-data">

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Level Name</p>
                    <div class="input">
                         <input type="text" id="Name" name="Name" required>
                    </div>

                    <input type="text" name="Course" value="<?php echo $_GET['course']; ?>" style="display:none;">

                    <p style="font-size: 12px; font-weight: 500;" class="m-y-20 tx-center">This Level will Available for All User.</p>

                    <button class="btn btn-gra-purple m-auto" type="submit" name="Upload_Level">Upload</button>
               </form>


          </div>
     </div>

</div>