<?php
session_start();
require_once "../../connect/connectDb/config.php";
$_SESSION['adminDPage'] = "Edit-Assets";

if(!isset($_GET["assetId"])){
    header("location: ../");
}

$assetId = $_GET["assetId"];

$q = "SELECT * FROM `78000_assets` WHERE `assetId` = '$assetId'";
$fireq = mysqli_query($link, $q);

if(mysqli_num_rows($fireq) > 0){
    while($data = mysqli_fetch_assoc($fireq)){
        ?>

        
<div class="flex e-c">

     <div class="form-box">
          <div class="main-box">
               <h1 class="fs-40 tx-center">Asset Detail</h1>

               <form action="./actions/updateAsset.php" class="e-center" method="POST" enctype="multipart/form-data">

                    <input type="text" name="assetId" value="<?php echo $_GET["assetId"]; ?>" style="display:none;" required>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Asset Name</p>
                    <div class="input">
                         <input type="text" id="Name" value="<?php echo $data["assetName"] ?>" name="Name" required>
                    </div>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Description</p>
                    <div class="input">
                         <input type="text" id="Description" value="<?php echo $data["assetDescription"]; ?>" name="Description" required>
                    </div>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Asset Download link</p>
                    <div class="input">
                         <input type="text" name="Download_link" id="Download_link" value="<?php echo $data["assetFile"]; ?>" required>
                    </div>

                    <p class="fs-15 fw-500" style="margin-top: 20px; margin-left: 2px;">Tags</p>
                    <div class="input">
                         <input type="text" id="Tags" value="<?php echo $data["assetTags"]; ?>" name="Tags" required>
                    </div>

                    <p style="font-size: 12px; font-weight: 500;" class="m-y-20 tx-center">This Asset will Available for All User.</p>

                    <button class="btn btn-gra-purple m-auto" type="submit" name="Update_Asset">Update</button>
               </form>


          </div>
     </div>

</div>

<?php
    }
}

?>