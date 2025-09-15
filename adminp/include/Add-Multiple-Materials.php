<?php
session_start();
$_SESSION['adminDPage'] = "Material-Categories";

$course = $_GET['course'];
$level = $_GET['level'];
$subject = $_GET['subject'];
$noOfMaterials = $_GET['noOfMaterials'];

?>
<div class="flex e-c">

     <div class="form-box">
          <div class="main-box">
               <h1 class="fs-40 tx-center">Asset Detail</h1>

               <form action="./actions/uploadMultipleMaterials.php" class="e-center" method="POST" enctype="multipart/form-data">

                    <?php
                        $n =1;
                        while($n <= $noOfMaterials){
                    ?>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Asset Name</p>
                    <div class="input">
                         <input type="text" id="Name<?php echo $n; ?>" name="Name<?php echo $n; ?>" required>
                    </div>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Description</p>
                    <div class="input">
                         <input type="text" id="Description<?php echo $n; ?>" name="Description<?php echo $n; ?>" required>
                    </div>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Asset Download link</p>
                    <div class="input">
                         <input type="text" name="Download_link<?php echo $n; ?>" id="Download_link<?php echo $n; ?>" placeholder="https://drive.google.com/uc?id=1VbrQJx2Xj_SUddg1Zue68YvV5zLMtsVd&export=download" required>
                    </div>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Asset Thumbnail</p>
                    <div class="input">
                         <input type="file" id="Material_Thumbnail<?php echo $n; ?>" name="Material_Thumbnail<?php echo $n; ?>">
                    </div>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Tags</p>
                    <div class="input">
                         <input type="text" id="Tags<?php echo $n; ?>" name="Tags<?php echo $n; ?>" required>
                    </div>

                    <div class="w-100per bg-dark-blue m-y-20" style="height:7px;"></div>
 
                    <?php
                    $n = $n+1;
                    }
                    ?>

                    

                    <input type="text" value="<?php echo $course; ?>" name="course" id="course" style="display:none;" required>
                    <input type="text" value="<?php echo $level; ?>" name="level" id="level" style="display:none;" required>
                    <input type="text" value="<?php echo $subject; ?>" name="subject" id="subject" style="display:none;" required>
                    <input type="text" value="<?php echo $noOfMaterials; ?>" name="noOfMaterials" id="noOfMaterials" style="display:none;" required>

                    <p style="font-size: 12px; font-weight: 500;" class="m-y-20 tx-center">This Asset will Available for All User.</p>

                    <button class="btn btn-gra-purple m-auto" type="submit" name="Upload_Multiple_Asset">Upload</button>
               </form>


          </div>
     </div>

</div>